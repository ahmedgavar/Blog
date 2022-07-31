<?php

namespace App\Http\Controllers\Api\Admin;

use Validator;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Traits\MainTrait;
use App\Http\Requests\ApiRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\RegisterRequest;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AuthController extends Controller
{
    use MainTrait;
    //


    public function admin_login(ApiRequest $request)
    {

        $credentials = $request->only(['email', 'password']);

        $admin = Admin::where(
            'email',
            '=',
            $request->input('email')
        )->first();
        if (!$token = auth('admin_api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $message = "successfully login";
        return $this->createNewToken($token, $admin, $message);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function admin_register(RegisterRequest  $request)
    {
        $credentials = array_merge(
            $request->validated(),
            [
                'password' => bcrypt($request->password),
                'password_confirmation' => bcrypt($request->password)
            ]
        );

        $admin = Admin::create($credentials);
        $token = JWTAuth::fromUser($admin);
        $message = "User created successfully";
        return $this->createNewToken($token, $admin, $message);
    }

    /**
     * Log the Admin out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function admin_logout()
    {

        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth()->user());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token, $user, $message)
    {

        return response()->json([
            'status' => 'success',
            'admin' => $user,
            'message' => $message,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
                'expires_in' => auth()->guard('admin_api')->factory()->getTTL() * 60

            ]
        ]);
    }
}
