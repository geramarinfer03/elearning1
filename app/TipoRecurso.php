<?php

namespace elearning1;

use Illuminate\Database\Eloquent\Model;

class TipoRecurso extends Model
{
    protected $fillable = [
        'id_tipo_recurso','nombre'
    ];

    protected $table = "Tipo_Recurso";
    protected $primaryKey = 'id_tipo_recurso';
    public $timestamps = false;

   
}
