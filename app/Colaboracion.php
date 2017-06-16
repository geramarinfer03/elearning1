<?php

namespace elearning1;

use Illuminate\Database\Eloquent\Model;

class Colaboracion extends Model
{
     protected $fillable = [
        'id_usuario_califica',
        'id_tipo_colaboracion',
        'id_entrega',
        'id_formulario',
        'respuestas',
        'nota',
        'comentario'
    ];
    
    protected $primaryKey = 'id_colaboracion';
    protected $table = "Colaboracion";
    public $timestamps = false;

}
