<?php

namespace elearning1;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $fillable = [
        'id_matricula','periodo', 'ano', 'curso', 'usuario', 'rol', 'fecha_matricula', 'promedio_final'
    ];

    
    protected $table = "Matricula";
    protected $primaryKey = 'id_matricula';
    public $timestamps = false;

    public function user(){
    	return $this->belongsTo(User::class, 'usuario');
    }
    public function cursos(){
    	return $this->belongsTo(Curso::class,'curso');
    }

    

}