<?php

namespace elearning1;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
     protected $fillable = [
        'id_formulario',
        'id_tarea',
        'url',
        'totalPuntos'
    ];
    
    protected $primaryKey = 'id_formulario';
    protected $table = "Formulario";
    public $timestamps = false;
}
