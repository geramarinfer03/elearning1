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
}
