<?php

namespace elearning1;

use Illuminate\Database\Eloquent\Model;
use elearning1\Formulario;

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

   
}
