<?php

namespace elearning1\Http\Controllers;


use elearning1\Curso;
use elearning1\Semana;
use elearning1\Tarea;
use elearning1\Formulario;
use Alert;
use elearning1\Matricula;
use elearning1\Rol;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Auth\Guard;

use DateTime;


class TareaController extends Controller
{
    // Maneja la logica relacionada con Tareas, Evaluaciones y Formularios.
    public function __construct(Guard $auth){
        $this->middleware('auth');
    }

    public function crearFormulario(Request $request){


    	$formulario = $request->input('formulario');

	   	$fp = fopen("/var/www/html/Archivos/formulario.blade.php", "w");
	   	fputs($fp, $formulario);
	   	fclose($fp);

	   	return $formulario;

    }
}
