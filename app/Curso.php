<?php

namespace elearning1;

use DateTime;

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

public function limiteCurso(){

      $datetime1 = date_create($this->fecha_final);
      $date1 = new DateTime("now");
      $interval = date_diff($date1, $datetime1);

      return $interval->format('%R%a') + 1;



    } 

}
