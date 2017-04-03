<?php

namespace elearning1\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Auth\Guard;

use elearning1\User;


class UsuarioController extends Controller
{
    //
  public function __construct(Guard $auth){
    	  $this->middleware('admin');
   }


    public function index() {

       $usuarios  = User::all();
       return view('Usuarios.index',['usuarios'=>$usuarios]);  
   	}

   	public function listado_usuarios(){
       $usuarioactual=\Auth::user();
       $usuarios= User::paginate(12);  
       $paises = app('countrylist')->all('es_CR');
       return view('Usuarios.index')
       //->with("paises", $paises )
       ->with("usuarios", $usuarios )
       ->with("usuario_actual", $usuarioactual );     
	}
}
