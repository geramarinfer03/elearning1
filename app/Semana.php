<?php

namespace elearning1;

use Illuminate\Database\Eloquent\Model;

class Semana extends Model
{
    protected $fillable = [
        'id_semana','tema', 'visible', 'estado', 'curso', 'secuencia',
    ];

    protected $table = "Semana";
    protected $primaryKey = 'id_semana';
    public $timestamps = false;

    public function curso_semana(){
    	return $this->belongsTo(Curso::class,'curso');
    }

}
