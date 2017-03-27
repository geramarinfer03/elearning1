<?php

namespace elearning1\Http\Controllers\Auth;
use elearning1\User;
use Validator;
use elearning1\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;


use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Session;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesUsers;


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'getLogout']);
      
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
   



 //registro   


        protected function showRegistrationForm(){
        return view("registro");
    }


        

    protected function register(Request $request){
    $this->validate($request, [
        'nombre' => 'required',
        'identificacion' => 'required',
        'password' => 'required',
    ]);


    $data = $request;


    $user=new User;
    $user->name=$data['name'];
    $user->email=$data['email'];
    $user->password=bcrypt($data['password']);


    if($user->save()){

         return "se ha registrado correctamente el usuario";
               
    }
   

   

}

//registro

protected function getLogout()
    {
        $this->auth->logout();

        Session::flush();

        return redirect('login');
    }






}
