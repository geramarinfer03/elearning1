<?php

namespace elearning1\Http\Controllers\Auth;

use elearning1\User;
use Validator;
use elearning1\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct(Guard $auth){
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'getLogout']);
        return view('/home');
      
    }

    protected function showLoginForm(){
        return view("login");
    }

       

    public function login(Request $request){
        //dd($request->all());

        $this->validate($request, [
        'email' => 'required',
        'password' => 'required',
         ]);

        $credentials = $request->only('email', 'password');

   

        if ($this->auth->attempt($credentials, $request->has('remember')))
        {
            $usuarioactual=\Auth::user();
          /* return view('/principal/index')->with("usuario",  $usuarioactual);*/
           return view('/home');
        }

        return "credenciales incorrectas";

        }
        

}
