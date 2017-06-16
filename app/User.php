<?php

namespace elearning1;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use elearning1\Rol;
use elearning1\Entrega;
use elearning1\Colaboracion;

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

    public function matricula(){

        return $this->hasMany(Matricula::class, 'usuario');
        //$this->belongsTo(Matricula::class, 'usuario');
    }

    public function realizoEntrega($id_tarea){
        $entrega = Entrega::where('Entrega.id_tarea', '=', $id_tarea)
                          ->where('Entrega.id_usuario', '=', $this->id)->count();
        return $entrega;
    }

    public function cantidadEntregas($id_tarea){
        return Entrega::where('Entrega.id_tarea', '=', $id_tarea)->count();
    }

    public function colaboracionesHechas($id_tarea){

        $entrega = Entrega::where('Entrega.id_tarea', '=', $id_tarea)->first()->id_entrega;


        return Colaboracion::distinct()->select('Colaboracion.id_colaboracion')->join('Entrega', 'Entrega.id_entrega', 'Colaboracion.id_entrega')->join('Tarea', 'Tarea.id_tarea', 'Entrega.id_tarea')->where('Colaboracion.id_usuario_califica', '=', $this->id)->count();
    }

    public function tieneAutoEvaluacion(){

        $cant = Colaboracion::distinct()->select('Colaboracion.id_colaboracion')->join('Entrega', 'Entrega.id_entrega', 'Colaboracion.id_entrega')->join('Tarea', 'Tarea.id_tarea', 'Entrega.id_tarea')->where('Colaboracion.id_usuario_califica', '=', $this->id)->where('Colaboracion.id_tipo_colaboracion', '=', 1)->count();

        return $cant > 0;
        
    }
}
