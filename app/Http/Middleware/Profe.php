<?php

namespace elearning1\Http\Middleware;

use Closure;

class profe
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){

         if($this->auth->user()->rol->id_rol < 3){

            Alert::error('No cuenta con los permisos para realizar esta accción', 'Contacte con uno de los administradores del sitio')->persistent("cerrar");
            return redirect()->back()->with('errors', 'Usted no tiene permisos de Administrador');
            //return redirect()->to('PermisosError');;
        }
        return $next($request);
    }
}
