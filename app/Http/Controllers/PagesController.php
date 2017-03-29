<?php

namespace elearning1\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){

    	return view('principal.index');
    }

     public function home(){

    	return view('home');
    }
}
