<?php

namespace elearning1\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Auth\Guard;

use elearning1\User;
use elearning1\Rol;
use elearning1\Matricula;


class UsuarioController extends Controller
{
    //
  public function __construct(Guard $auth){
    	  $this->middleware('admin');
   }


    public function index() {

       $usuarios  = User::all();
       return view('Usuarios.index',['usuarios'=>$usuarios]);  
   	}

   	public function listado_usuarios(){
       $usuarioactual=\Auth::user();
       $usuarios= User::paginate(12); 
       $paises = app('countrylist')->all('es_CR');
       return view('Usuarios.index')
       //->with("paises", $paises )
       ->with("usuarios", $usuarios )
       ->with("usuario_actual", $usuarioactual );     
	}

  public function form_editar_usuario($id){
    //funcion para cargar los datos de cada usuario en la ficha
    $roles = Rol::all();

    $usuario=User::find($id);
    $rols_user = Rol::where('id_rol','>=',$usuario->rol->id_rol)->get();
    $contador=count($usuario);
    $mat = Matricula::where('usuario', '=' , $id)->paginate(7);
    //$tiposusuario=TipoUsuario::all();
    
    if($contador>0){     
            return view("Usuarios.form_editar_usuario")->with("usuario",$usuario)
                                                       ->with("roles",$roles)
                                                       ->with("rols_user", $rols_user)
                                                       ->with("matriculados", $mat);
    }
    else
    {            
          //  return view("mensajes.msj_rechazado")->with("msj","el usuario con ese id no existe o fue borrado");  
    }
  }

  public function editar_usuario(Request $request){
    $data=$request->all();
    $idUsuario=$data["id_usuario"];
    $user=User::find($idUsuario);
   
    $user->id_rol         =$data['rol_user'];  
    $user->pais           =$data['pais'];
   
    $resul= $user->save();

    if($resul){       
      return redirect('usuarios');
    }else{


    }      

  }

}
