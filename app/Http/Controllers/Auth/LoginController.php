<?php

namespace elearning1\Http\Controllers\Auth;

use elearning1\User;
use Alert;
use Validator;
use elearning1\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Session;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    protected $redirectTo = '/';


    protected $redirectAfterLogout = '/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct(Guard $auth){
        //$usuarioactual= null;
        //$usuarioactual=\Auth::user();
        //$this->auth = $auth;
        $this->middleware('guest', ['except' => 'logout']);
        //return view('/home');
    //   return view('/home')->with("usuario",$usuarioactual);
      
    }


    public function username()
    {
        return 'email';
    }


   //login

       protected function showLoginForm()
    {
        return view("auth.login");
    }


       

    public function login(Request $request){


      $credentials = $request->only('email', 'password');

       if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }



        if ($this->guard()->attempt($credentials, $request->has('remember'))){

          $usuarioactual=\Auth::user();
          alert()->success("Bienvenido");

         return redirect()->home();
        }

       //  alert()->error('Estos credenciales no son correctos', 'Intente de nuevo');

//////
        //return redirect()->home();      

    


        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);



    /*$credentials = $request->only('email', 'password');

    if ($this->auth->attempt($credentials, $request->has('remember')))
    {

        $usuarioactual=\Auth::user();
       return  redirect()->to()->back();//view('home')->with("usuario",  $usuarioactual);
    }*/

  /*  return "credenciales incorrectas";*/

    }


//login

    /*protected function logout(){
      /* $user = Auth::user(); 
        Log::info('User Logged Out. ', [$user]);
        Auth::logout();
        Session::flush();
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');*/
        /* $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
       // return redirect('login');
    }*/

        
    
}
