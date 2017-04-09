<?php

namespace elearning1\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;

use Closure;
use Session;
use Alert;

class editor
{

    protected $auth;

    public function __construct(Guard $auth){
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){

        if($this->auth->user()->rol->id_rol > 2){

            Alert::error('No cuenta con los permisos para realizar esta accción', 'Contacte con uno de los administradores del sitio')->persistent("cerrar");
            return redirect()->home();
            //return redirect()->to('PermisosError');;
        }

        return $next($request);
    }
}
