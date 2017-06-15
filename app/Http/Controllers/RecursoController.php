<?php

namespace elearning1\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use elearning1\Semana;
use elearning1\Rol;
use elearning1\Recurso;
use elearning1\Curso;
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
    

    public function uploadTask($id_tarea,$id_curso){
        /* Metodo de carga de archivo*/



        ini_set('memory_limit', '-1');
  // obteniendo la informacion del archivo
        $ext = Input::file('file')->getClientOriginalExtension(); // obtiene la extension del archivo
        $originalName = Input::file('file')->getClientOriginalName(); //obtiene el nombre original del archivo
        $file = Input::file('file');
         Storage::put($file->getClientOriginalName(), $file);
         $filename = $file->store('recursos');
         $destinationPath = '/Applications/XAMPP/xamppfiles/htdocs/eLearning1/public/docs\\'; // upload path

                 if ($request->file('file')->isValid()) {
                     $pdf_name   = date('YmdHis'). ".$ext";
                     $upload_path = 'docs/';
                     $request->file('file')->move($upload_path, $pdf_name);
                     return view('Recursos.subirTarea')->with('id_tarea',$id_tarea)
                                            ->with('id_curso',$id_curso);
                                            
                 }
                 return false;


    }
    
    
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
    

}
