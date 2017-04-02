<?php

namespace elearning1\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;

use Closure;
use Session;
class Admin
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
    public function handle($request, Closure $next)
    {
       // dd($this->auth->user());
        if($this->auth->user()->rol->id_rol != 1){
            return redirect()->to('PermisosError');
        }
        return $next($request);
    }
}
