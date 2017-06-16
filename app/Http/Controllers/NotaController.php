<?php

namespace elearning1\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Alert;
use elearning1\Matricula;
use elearning1\User;


class NotaController extends Controller
{
    //
  public function __construct(){
    	  
   }
  
  public function getNota($id = null) {
    if ($id == null) {
        $matriculas = Matricula::all(array('usuario', 'curso', 'promedio_final'));
    } else {
        $matriculas = Matricula::where('usuario', '=', $id)->get(array('usuario', 'curso', 'promedio_final'));
    }
    return response()->json(array(
                'error' => false,
                'notas' => $matriculas,
                'status_code' => 200
            ));
    }
   
}
