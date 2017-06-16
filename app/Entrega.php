<?php

namespace elearning1;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
   protected $fillable = [
        'id_tarea',
        'id_usuario',
        'id_matricula',
        'url',
        'nota'
    ];
    
    protected $primaryKey = 'id_entrega';
    protected $table = "Entrega";
    public $timestamps = false;

   /*public function recurso(){

        return $this->belogsTo(Recurso::class, 'id_recurso');

    }
*/
}
