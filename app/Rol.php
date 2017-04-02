<?php

namespace elearning1;

use Illuminate\Database\Eloquent\Model;
use elearning1\User;

class Rol extends Model
{
     protected $fillable = [
        'id_rol','nombre'
    ];

    protected $hidden = [
        'id_rol', 'estado' 
    ];

    
    protected $table = "Rol";
    protected $primaryKey = 'id_rol';
    public $timestamps = false;

    /*public function users(){

    	return $this->hasOne(User::class);
    }*/
   /*public function user(){

    	return $this->belogsTo(User);
    }*/
}
