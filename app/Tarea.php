<?php

namespace elearning1;
use DateTime;

use Illuminate\Database\Eloquent\Model;
use elearning1\Formulario;
use elearning1\Entrega;

class Tarea extends Model
{
     protected $fillable = [
        'id_tarea',
        'id_recurso',
        'id_curso',
        'fech_limit_entrega',
        'fech_limit_evaluacion',
        'porcentaje'
    ];
    
    protected $primaryKey = 'id_tarea';
    protected $table = "Tarea";
    public $timestamps = false;

   public function recurso(){

        return $this->belogsTo(Recurso::class, 'id_recurso');

    }

    public function fech_limit_entrega(){
      $fecha=date("d- M -Y",strtotime($this->fech_limit_entrega)); 
        return $fecha;
    }

     public function fech_limit_evaluacion(){
      $fecha=date("d- M -Y",strtotime($this->fech_limit_evaluacion)); 
        return $fecha;
    }

    public function tareaEntregaUser(){
      $usuario = \Auth::user()->id;
      $nota = Entrega::where('Entrega.id_tarea', '=', $this->id_tarea)
                     ->where('Entrega.id_usuario', '=', $usuario)->first();
      if($nota){
        return $nota->nota;
      }
      return -1;
    }





   
}
