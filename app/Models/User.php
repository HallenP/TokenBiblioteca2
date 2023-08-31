<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{

    use HasApiTokens, HasFactory, Notifiable;

    // Este es el modelo User, el cual tendra los parametros de nombre, email y contraseña, para la generacion del token

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'password' => 'hashed',
    ];

    // ... //
    //nos ayudamos de esta funcion para la identificacion del JWT, debido a la documentacion de la libreria JWTAuth
    public function getJWTIdentifier()
    {
    	return $this->getKey();
    }
// en esta funcion de igual manera, es un metodo para la lista del JWt con la libreria del JWTAuth
    public function getJWTCustomClaims()
    {
    	return [];
    }
}
