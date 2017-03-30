<?php

namespace elearning1\Http\Controllers;



use elearning1\User;


class PagesController extends Controller
{
    public function index(){

    	return view('principal.index');
    }


}
