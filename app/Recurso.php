<?php

namespace elearning1;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $fillable = [
        'id_recurso','nombre', 'url', 'tipo_recurso', 'recurso_padre', 'visible', 'secuencia', 'notas', 'estado', 'semana',
    ];


    
    protected $table = "Recurso";
    protected $primaryKey = 'id_recurso';
    public $timestamps = false;

    public function semana(){

    	return $this->belongsTo(Semana::class,'semana');
    }

    /*public function tipo_recurso(){
    	return $this->belongsTo(Tipo_recurso::class,'tipo_recurso');
    }*/
}
