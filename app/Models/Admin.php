<?php

namespace App\Models;

use App\Http\Requests\ApiRequest;
use App\Http\Traits\MainTrait;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable  implements JWTSubject
{
    use MainTrait;
    use HasApiTokens, HasFactory;
    protected $table = 'admins';

    /*

    Getjwtidentifier: to obtain the identifier that will
             be stored in the JWT declaration, in fact,
              we need to return the name of the primary key field
              of the user identification table. Here,
               the returned primary key ‘ID’,
    Getjwtcustomclaims: returns an array containing custom key
                value pairs to be added to the JWT declaration.
                Here, an empty array is returned without adding
                any custom information.
    */

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'role' => '1',
            'user' => Admin::where('email', $this->email)
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
