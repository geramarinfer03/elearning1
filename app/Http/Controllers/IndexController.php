<?php

namespace elearning1\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use elearning1\user;

class IndexController extends Controller
{
     public function __construct(Guard $auth){
        $this->middleware('auth');
    }

    public function home(){
        
       //$usuarioactual=\Auth::user();

      return view('home');/*->with("usuario",  $usuarioactual);*/
    }
}
