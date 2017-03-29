<?php

namespace elearning1;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'Usuario';
    protected $primaryKey = 'email';
    
    protected $fillable = [
        'nombre', 'email', 'password', 'rol', 'genero', 'pais',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'ip', 'os', 'navegador', 'lenguaje', 'fecha_ultimo_ingreso' 
    ];
}
