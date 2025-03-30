<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject; // Asegúrate de importar la interfaz JWTSubject
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\MongoAuditable;


class User extends Authenticatable implements JWTSubject // Implementa la interfaz JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes, MongoAuditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $dates = ['deleted_at'];
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
    ];

    // Implementación de los métodos requeridos por la interfaz JWTSubject

    /**
     * Obtener el identificador que se almacenará en el token JWT.
     * En este caso, el id del usuario.
     */
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Generalmente devuelve el 'id' del usuario
    }

    /**
     * Devuelve un array de claims personalizados que se añadirán al token JWT.
     * Si no necesitas añadir claims personalizados, retorna un array vacío.
     */
    public function getJWTCustomClaims()
{
    return [
        'rol' => $this->rol
    ];
}
}