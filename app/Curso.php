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
        'evaluado',
        'estado'
    ];
    
    protected $primaryKey = 'id_curso';
    protected $table = "Curso";
    public $timestamps = false;

    public function matr_user(){
        return $this->hasMany(Matricula::class);
    }

    public function matricula(){

        return $this->hasMany(Matricula::class, 'curso');

    }
    public function semanas(){

        return $this->hasMany(Semana::class, 'curso');

    }

    public function porEvaluar(){
        return (100 - $this->evaluado);
    }
}
