<?php

namespace elearning1;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = [
        'nombre',
        'duracion',
        'fecha_inicio',
        'fecha_final',
        'estado'
    ];
    
    protected $table = "Curso";
    public $timestamps = false;
}
