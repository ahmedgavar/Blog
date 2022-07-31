<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


class CheckGuard extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $role = null)
    {
        try {
            //Resolve token role
            $token_role = $this->auth->parseToken()->getClaim('role');
        } catch (JWTException $e) {
            /**
             *Token parsing failed, indicating that there are no available tokens in the request.
             *In order to be used globally (requests that do not require a token can also be passed), let the request continue here.
             *Because the responsibility of this middleware is only to verify the role in the token.
             */
            return $next($request);
        }

        //Judge the token role.
        if ($token_role != $role) {
            throw new UnauthorizedHttpException('jwt-auth', 'User role error');
        }

        return $next($request);
    }
}
