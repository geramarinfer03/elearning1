<?php

namespace elearning1\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

use elearning1\User;
use elearning1\Rol;
use elearning1\Matricula;
use elearning1\Curso;
use DB;

class MatriculaController extends Controller
{
   public function __construct(Guard $auth){
    	  $this->middleware('auth');
   }

   public function  update(Request $request ){
   		$data=$request->all();
    	$id_matricula =$data["id_matricula"];
    	$id_usuario = $data["id_usuario"];

    	$mat=Matricula::find($id_matricula);


	    $mat->rol         =$data['rol_curso'];  

    	$resul= $mat->save();
	   
    	if($resul){       
      		return redirect('form_editar_usuario/'. $id_usuario);
    	}else{


    	}      

  }

  public function matriculaForm($id){
  	 	$usuario=User::find($id);
  	 	$hoy = date('Y-m-d H:i:s');


  	 	/**
		*	@var $mat_curso: Trae los cursos que aun no terminan y en los cuales el usuario
		*	no se encuentra matriculado.
		*
  	 	*/
  	 	//$mat_curso = DB::table('Curso')->distinct()->select('Curso.id_curso', 'Curso.nombre', 'Curso.duracion', 'Curso.fecha_inicio', 'Curso.fecha_final')->where('Curso.fecha_final', '>', $hoy)->where('Curso.estado', '=', 1)->leftJoin('Matricula',  function($join) use($id, $hoy){
  	 //			$join->on('Curso.id_curso', '=', 'Matricula.curso')->where('Matricula.usuario', '=', $id);
  	 //	})->whereNull('Matricula.curso')->get();

		$mat_curso = Curso::distinct()->select('Curso.id_curso', 'Curso.nombre', 'Curso.duracion', 'Curso.fecha_inicio', 'Curso.fecha_final')->where('Curso.fecha_final', '>', $hoy)->where('Curso.estado', '=', 1)->leftJoin('Matricula',  function($join) use($id, $hoy){
  	 			$join->on('Curso.id_curso', '=', 'Matricula.curso')->where('Matricula.usuario', '=', $id);
  	 	})->whereNull('Matricula.curso')->paginate(6);

		
		//$mat_curso->paginate(12);
		//dd($mat_curso);

  	 	/**
  	 	* @var rols_user: Roles del usuario
  	 	*/
  	 	$rols_user = Rol::where('id_rol','>=',$usuario->rol->id_rol)->get();

  	 	
  	 	//$mat_curso = DB::table('Matricula')->distinct()->select('Matricula.curso')->leftJoin('Curso', 'Matricula.curso', '=','Curso.id_curso')->get();

  	 	//$mat_curso = $cursos->diff($mat);
  	 	

  	 	return view('Usuarios.matricularUsuario')->with('usuario',$usuario)
  	 											 ->with('roles', $rols_user)
  	 											 ->with('cursosNoMat', $mat_curso);

  }

  public function store(Request $request){

       $hoy = date('Y-m-d H:i:s');

       $data=$request->all();
       $curso=Curso::find($data['curso_mat']);
       $id_usuario = $data['id_usuario'];

       $mes = date("m",strtotime($curso->fecha_final));

       $mes = is_null($mes) ? date('m') : $mes;
       $trim=floor(($mes-1) / 3)+1;

       $trim = round($trim);

         $matricula=new Matricula;

         $matricula->usuario =$data['id_usuario'];
         $matricula->curso   =$data['curso_mat'];
         $matricula->rol     =$data['roles'];
         $matricula->fecha_matricula = $hoy;
         $matricula->ano     = $hoy;
         $matricula->periodo =$trim;
       

         $result = $matricula->save();

         if($result){       
          return redirect('form_editar_usuario/'. $id_usuario);
         }else{


        }   

       

  }


}
