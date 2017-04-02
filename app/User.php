<?php

namespace elearning1;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use elearning1\Rol;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'Usuario';
   // protected $primaryKey = 'username';
    
    protected $fillable = [
        'nombre', 'email', 'password', 'id_rol', 'genero', 'pais',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'ip', 'os', 'navegador', 'lenguaje', 'fecha_ultimo_ingreso' 
    ];

    public function rol(){
        return $this->belongsTo(Rol::class, 'id_rol');
    }
   /* public function rol(){
        return $this->hasOne(Rol::class);
    }*/
}
