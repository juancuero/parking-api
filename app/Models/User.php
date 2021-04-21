<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
    ];

 

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



/* DOCUMENTATION  */    


/**
 * @OA\Schema(
 * schema="User",
    * description="<b> Register User model</b> <br>",
    * @OA\Property(title="Id",property="id",description="Id of the rol",type="integer",format="int64",example=1),
    * @OA\Property(title="Name",property="name",description="name user",type="string",example="Cuero Ortega"),
    * @OA\Property(title="Email",property="email",description="Email of the user",type="string",example="juan.cuero.pruebas@gmail.com"),
    * @OA\Property(title="User",property="username",description="Username",type="string",example="jcuero")
 * )
 */


 /**
 * @OA\Schema(
 *     schema="Login",
 *     description="<b> Login model</b> <br>",
 *     @OA\Property(title="Email or Username",property="email_or_username",description="Email or username of the user",type="string",example="juan.cuero"),
 *     @OA\Property(title="Password",property="password",description="Password of the user",type="string",example="juancuero123")
 * )
 */

}
