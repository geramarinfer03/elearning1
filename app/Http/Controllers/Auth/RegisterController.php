<?php

namespace elearning1\Http\Controllers\Auth;

use elearning1\User;
use elearning1\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('guest');
    }
    */
    public function __construct(Guard $auth){
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'getLogout']);
      
    }


    protected function showRegistrationForm(){
        return view("registro");
    }

    protected function register(Request $request){
       // dd($request->all());
        $this->validate($request, [
            'nombre' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);


        $data = $request;


        $user=new User;
        $user->nombre         =$data['nombre'];
        $user->email          =$data['email'];
        $user->password       =bcrypt($data['password']);
        $user->genero         =$data['genero'];
        $user->rol            =5;  
        $user->pais           =$data['pais'];
        $user->ip             =$data['ip'];
        $user->os             =$data['os'];
        $user->navegador      =$data['navegador'];
        $user->lenguaje       =$data['lenguaje'];



        if($user->save()){

             return "se ha registrado correctamente el usuario";
               
        }

        return "EROOR ERROR ERROR BIP BIP BIP BIP";
   

   

    }



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
