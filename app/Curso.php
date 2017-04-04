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
    
    protected $primaryKey = 'id_curso';
    protected $table = "Curso";
    public $timestamps = false;

    public function matr_user(){
        return $this->hasMany(Matricula::class);
    }
}
