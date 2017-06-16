<?php

namespace elearning1\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use elearning1\Semana;
use elearning1\Rol;
use elearning1\Recurso;
use elearning1\Curso;
use elearning1\Tarea;
use elearning1\TipoRecurso;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;
use Input;


class RecursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function crearRecursoSemana($semana, $curso){
        $usuario = \Auth::user();
        $rols_user = Rol::where('id_rol','>=',$usuario->rol->id_rol)->orderBy('id_rol', 'desc')->get()->pluck('nombre','id_rol');
      $tipo_recurso = TipoRecurso::all()->pluck('nombre', 'id_tipo_recurso');

        $evaluado = Curso::find($curso)->porEvaluar();

        return view('Recursos.crearRecurso')->with('padre',0)
                                            ->with('semana',$semana)
                                            ->with('roles',$rols_user)
                                            ->with('tipo_recurso', $tipo_recurso)
                                            ->with('curso', $curso)
                                            ->with('evaluado', $evaluado);
    }
    
    public function crearRecurso($id, $curso){
        $usuario = \Auth::user();

        $rols_user = Rol::where('id_rol','>=',$usuario->rol->id_rol)->orderBy('id_rol', 'desc')->get()->pluck('nombre','id_rol');
        
        $recurso = Recurso::find($id);
        
        $semana = $recurso ->semana;

        $tipo_recurso = TipoRecurso::all()->pluck('nombre', 'id_tipo_recurso');

        $evaluado = Curso::find($curso)->evaluado;


         return view('Recursos.crearRecurso')->with('padre',$id)
                                             ->with('semana',$semana)
                                             ->with('roles',$rols_user)
                                             ->with('tipo_recurso', $tipo_recurso)
                                             ->with('curso', $curso)
                                             ->with('evaluado', $evaluado);

    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request, [
          'nombre'=>'Required',
          'estado' => 'Required',
          'visibl' => 'Required',
          'recurso_padre' => 'Required',
          'tipo' => 'Required|not_in:0',
          'semana' => 'Required',
          'rol' => 'Required' 
          
          ]);


        
          $nombre = $request->input('nombre');
          $notas = $request->input('notas');
          $url = $request->input('url');
          $vis = $request->input('visibl');
          $estado = $request->input('estado');
          $recurso_padre = $request->input('recurso_padre');
          $tipo_recurso = $request->input('tipo');
          $semana = $request->input('semana');
          $rol =  $request->input('rol');
        
      
      

        
         $sem = Semana::find($semana);
        
         $contador = Recurso::where('Recurso.semana', '=', $semana)->max('secuencia');
         $contador= $contador+1;
        

        
       /* $contador = $sem -> secuencia;
        $contador= $contador +1;
        
        $result1= $sem->update([
            
            'secuencia' =>$contador
        ]);*/
 


       $result = Recurso::create([
          'nombre'=>$nombre,
          'notas'=> $notas,
          'url' => $url,
          'estado' => $estado,
          'visibl' => $vis,
          'recurso_padre' =>$recurso_padre,
          'tipo_recurso' =>$tipo_recurso,
          'secuencia' => $contador,
          'semana' => $semana,
          'rol' => $rol
        ]);

      
        
       if($result){
             alert()->success('Recurso creado exitosamente ');
         }
        else{
            alert()->success('Error al crear recurso');
        }


        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $usuario = \Auth::user();
        $rols_user = Rol::where('id_rol','>=',$usuario->rol->id_rol)->pluck('nombre','id_rol');
        $recurso = Recurso::find($id);
        
        return view('Recursos.editarRecurso')->with('recurso',$recurso)
                                             ->with('roles',$rols_user);
    }


    public function editTarea($id)
    {
        
        $usuario = \Auth::user();
        $tarea = Tarea::find($id);
        //$rols_user = Rol::where('id_rol','>=',$usuario->rol->id_rol)->pluck('nombre','id_rol');
        $rols_user = Rol::where('id_rol','>=',$usuario->rol->id_rol)->orderBy('id_rol', 'desc')->get()->pluck('nombre','id_rol');
        $recurso = Recurso::find($tarea->id_recurso);
        
        $fecha_limit = date('Y-m-d', strtotime($tarea->fech_limit_entrega));
        $fecha_limit_eval = date('Y-m-d', strtotime($tarea->fech_limit_evaluacion));

        $url = explode("/",$recurso->url);

        return view('Recursos.editarTarea')->with('recurso',$recurso)
                                             ->with('tarea',$tarea)
                                             ->with('roles',$rols_user)
                                             ->with('fech_limit',$fecha_limit)
                                             ->with('fech_limit_eval',$fecha_limit_eval)
                                             ->with('url',array_pop($url));
    }

    public function editArchivo($id)
    {



        $usuario = \Auth::user();
        $rols_user = Rol::where('id_rol','>=',$usuario->rol->id_rol)->pluck('nombre','id_rol');
        $recurso = Recurso::find($id);
        return view('Recursos.editarRecursoArchivo')->with('recurso',$recurso)
                                             ->with('roles',$rols_user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    
         $this->validate($request, [
          'nombre'=>'Required',
          'notas'=>'Required',
         /*'url' => 'Required' */
          'rol' => 'Required'
          
          ]);
        


          $nombre = $request->input('nombre');
          $notas = $request->input('notas');
          $url = $request->input('url');
          $vis = $request->input('visibl');
          $estado = $request->input('estado');
          $id = $request->input('id_recurso');
          $rol =  $request->input('rol');
        
         $recurso = Recurso::find($id); 
        
         $result = $recurso->update([
             'nombre' => $nombre,
             'notas'=>$notas,
             'url' => $url,
             'visibl' => $vis,
             'estado' => $estado,
             'rol' => $rol
             
         ]);
             

         if($result){
             alert()->success('Recurso modificado exitosamente');
         }
        else{
            alert()->success('Error al modificar recurso');
        }
                
         return back();
       
    }


/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateTarea(Request $request)
    {
    
        $this->validate($request, [
        'nombre'=>'Required',
        'notas'=>'Required',
        /*'url' => 'Required' */
        'rol' => 'Required',
        'porcentaje' => 'Required'
        
        ]);

     


        $nombre = $request->input('nombre');
        $notas = $request->input('notas');
        //$url = $request->input('url');
        $vis = $request->input('visibl');
        $estado = $request->input('estado');
        $id = $request->input('id_recurso');
        $id_tarea = $request->input('id_tarea');
        $rol =  $request->input('rol');
        $fecha_limit =  $request->input('fecha_limite');
        $fecha_limit_eval =  $request->input('fecha_limite_eval');
        $porcentaje = $request->input('porcentaje');
    
        $recurso = Recurso::find($id); 
        $tarea = Tarea::find($id_tarea); 

        ini_set('memory_limit', '-1');
        // obteniendo la informacion del archivo
         $file = Input::file('file');
        //$file = $request->file('tareaupload');
          $url = null;

        if($file){
            $url = $this->subirArchivosTarea($request);       
        }


        if($url){
            $result = $recurso->update([
             'nombre' => $nombre,
             'notas'=>$notas,
             'url' => $url,
             'visibl' => $vis,
             'estado' => $estado,
             'rol' => $rol
             
            ]);
        }
        else{
            $result = $recurso->update([
             'nombre' => $nombre,
             'notas'=>$notas,
             'visibl' => $vis,
             'estado' => $estado,
             'rol' => $rol
             
            ]);
        }
    
        
        $result2 = $tarea->update([
             'fech_limit_entrega' => $fecha_limit,
             'fech_limit_evaluacion'=>$fecha_limit_eval,
             'porcentaje' => $porcentaje
             
         ]); 

         if($result && $result2){
             alert()->success('Tarea modificada exitosamente');
         }
        else{
            alert()->success('Error al modificar tarea');
        }
                
         return back();
       
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setNameWeek(Request $request){
        $data=$request->all();
        $nombreSemana = $data['nombreSemana'];
        $id_semana = $data['id_semana'];

        $week = Semana::find($id_semana);

        $week->tema = $nombreSemana;

        $resultado = $week->save();

        if($resultado){
           alert()->success('Modificacion Correcta.', 'Guardando!');


        }else{

           alert()->error('Modificacion Incorrecta.', '¡Algo Ocurrio!');

        }

        return redirect()->back();


    }
    
    
    
    public function etiquetaTexto(){
        
        return view('Recursos.etiquetaTexto');
    }


    /*--------D R A G   A N D   D R O P*/
    /*public function updateDrag($r){


      


         
        /* $id = Input::get('id');
         $sec = Input::get('sec');

         
      
             
       /*  $rec = Recurso::find($id);
         
         alert()->success('Recurso creado exitosamente ');
        
          return view('home');
         
         
   }*/
    
    public function updateDrag(Request $request){



          $id = $request->input('id');
          $sec = $request->input('sec');
        
          $rec = Recurso::find($id);
          $rp= $rec->recurso_padre;
           
        
          if($rp!=0){
              $recursoPadre = Recurso::find($rp);
              $secP = $recursoPadre -> secuencia;
              $sec= $sec+$secP+1;
          }
        
          $result=   $rec->update([
             'secuencia' => $sec
          ]);
          

        if($result){
        
          return response()->json(['done']);
        }
        
        else{
             return response()->json(['fail']);
        }
         
         
   }

   public function tarea(Request $request){
      dd($request);

   }  


    protected function subirArchivosTarea(Request $request){

        $file = Input::file('file');
        $id_curso = $request->input('cursoF');
        $semana = $request->input('semanaF');
        $mime = $file->getMimeType();



        list($tipo, $exten) = explode("/", $mime);

        $extension = $file->getClientOriginalExtension();
        $originalName = $file->getClientOriginalName();

        $folderName = rand(11111,99999);

            if ($extension != "exe") {
                
                 $destinationPath = $localRepo = realpath('../../../') . "/localRepository";
                 $this->crearRuta($destinationPath);
                 $pathRecurso = $destinationPath . "/". $id_curso ."/tareas/". $folderName . "/";
                 $this->crearRuta($pathRecurso);


                $url =  $pathRecurso . $originalName;



                Input::file('file')->move($pathRecurso, $originalName);


                return $url;
             }else{

                  Alert::error("NO puedes subir exe >:/", "Intente con otro tipo de archivo")->persistent('Close');
                    return redirect()->back();
             }
    }

     protected function crearRuta($destinationPath){

        if (!file_exists($destinationPath)) {
        // Si el directorio no ha sido creado
            if (!file_exists($destinationPath)) {
                $iscreated = 0;
                try {
                //Intenta crearlo, con permisos de escritura
                   $iscreated = mkdir($destinationPath, 0700, true);
                } catch (\Exception $e) {
                }


                //Error de creacion de carpeta
                if ($iscreated == 0) {
                    Alert::error("Error de permisos", "No se pudo crear la carpeta")->persistent('Close');
                    return redirect()->back();
                }
            }
        }
    }

    

}
