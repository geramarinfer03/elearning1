<?php

namespace elearning1;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $fillable = [
        'id_recurso','nombre', 'url', 'tipo_recurso', 'recurso_padre', 'visibl', 'secuencia', 'notas', 'estado', 'semana','rol'
    ];


    
    protected $table = "Recurso";
    protected $primaryKey = 'id_recurso';
    public $timestamps = false;

    public function semana(){

    	return $this->belongsTo(Semana::class,'semana');
    }
    
    public function rol(){

    	return $this->belongsTo(Rol::class,'rol');
    }

    /*public function tipo_recurso(){
    	return $this->belongsTo(Tipo_recurso::class,'tipo_recurso');
    }*/
}
