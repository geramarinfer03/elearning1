<?php

namespace elearning1\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

use elearning1\User;
use elearning1\Rol;
use elearning1\Matricula;

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


}
