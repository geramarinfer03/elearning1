<?php

namespace elearning1\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Contracts\Auth\Guard;
use elearning1\user;
use elearning1\Curso;
use elearning1\Matricula;

use Alert;

class IndexController extends Controller
{
     public function __construct(Guard $auth){
        $this->middleware('auth');
    }

    public function home(){
        	 
    	$id =\Auth::user();

    	$mat_curso = Curso::distinct()->select('Curso.id_curso', 'Curso.nombre', 'Curso.duracion', 'Curso.fecha_inicio', 'Curso.fecha_final', 'Curso.estado')->join('Matricula', 'Matricula.curso', 'Curso.id_curso')
                                          ->where('Matricula.usuario', '=', $id->id)->get();
      return view('home')->with("cursos",  $mat_curso);
    }
}
