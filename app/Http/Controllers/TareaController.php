<?php

namespace elearning1\Http\Controllers;


use elearning1\Curso;
use elearning1\Semana;
use elearning1\Tarea;
use elearning1\Formulario;
use elearning1\Recurso;
use DB;
use Input;
use Alert;
use elearning1\Matricula;
use elearning1\Rol;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Auth\Guard;

use DateTime;


class TareaController extends Controller
{
    // Maneja la logica relacionada con Tareas, Evaluaciones y Formularios.
    public function __construct(Guard $auth){
        $this->middleware('auth');
    }

    public function crearFormulario(Request $request){


    	$formulario = $request->input('formulario');
        $suma = $request->input('suma');
        $tarea = $request->input('tarea');
        $curso = $request->input('curso');


        $fileName = rand(11111,99999);


        $destinationPath = $localRepo = realpath('../../../') . "/localRepository";
        $this->crearRuta($destinationPath);

        $pathRecurso = $destinationPath . "/". $curso ."/formularios/";
        $this->crearRuta($pathRecurso);

        //$url = Tarea::find($tarea)->id_recurso;

        //dd($url);
       
        $iscreated = 0;
       // try {
        
            $fp = fopen($pathRecurso . $fileName . ".blade.php", "w");
            fputs($fp, $formulario);
            fclose($fp);
            $iscreated = 1;

       //  } catch (\Exception $e) {}



        //if ($iscreated == 0) {
       //     Alert::error("Error >n<", "No se pudo crear el formulario")->persistent('Close');
       //     return redirect()->back();
      //  }
        

        $result = Formulario::create([
          'id_tarea'=>$tarea,
          'url'=> $pathRecurso . $fileName . ".blade.php",
          'totalPuntos' => $suma
        ]);


         if($result){

            return $formulario;
          //return ("<h1>HOLAA</h1>");


         }else{
            Alert::error("Error >n<", "No se pudo crear el formulario")->persistent('Close');
            return redirect()->back();

         }





	  

    }

    public function crearTarea(Request $request){

          $nombre = $request->input('nombreTarea');
          $notas = $request->input('notasTarea');
          $vis = $request->input('visbl');
          $estado = $request->input('estado');
          $recurso_padre = $request->input('recurso_padreF');
          $id_curso = $request->input('cursoF');
          $semana = $request->input('semanaF');
          $rol =  $request->input('rol');

          if($estado == null){
            $estado = 0;
          }
          if($vis == null){
            $vis = 0;
          }


          $porcentaje =  $request->input('porcentaje');
          $fecha_limite =  $request->input('fecha_limite');
          $fecha_limite_eval =  $request->input('fecha_limite_eval');



        ini_set('memory_limit', '-1');
        // obteniendo la informacion del archivo
         $file = Input::file('file');
        //$file = $request->file('tareaupload');
          $url = null;

        if($file){


                $url = $this->subirArchivosTarea($request);       

        }



        ///$sem = Semana::find($semana);
        
         $contador = Recurso::where('Recurso.semana', '=', $semana)->max('secuencia');
         $contador= $contador+1;

         $result = Recurso::create([
          'nombre'=>$nombre,
          'notas'=> $notas,
          'estado' => $estado,
          'visibl' => $vis,
          'url' => $url,
          'recurso_padre' =>$recurso_padre,
          'tipo_recurso' => 7,
          'secuencia' => $contador,
          'semana' => $semana,
          'rol' => $rol
        ]);

         $recurso = Recurso::all()->max('id_recurso');


          if($result){
             //sI SE LOGRA CREAR EL RECURSO SE CREA LA TAREA

            $result = Tarea::create([
              'id_recurso'=>$recurso,
              'id_curso'=> $id_curso,
              'fech_limit_entrega' => $fecha_limite,
              'fech_limit_evaluacion' => $fecha_limite_eval,
              'porcentaje' =>$porcentaje
            ]);
                if($result){
                      $tareaId = Tarea::all()->max('id_tarea');
                 
                     
/*
                       return view('Recursos.crearFormulario')
                                                              ->with('curso', $id_curso)
                                                              ->with('tareaId', $tareaId)
                                                              ->with('nombreTarea', $tarea);*/
                     $newUrl = "/showCrearForm/" . $id_curso . "/" . $tareaId;

                     alert()->success("Tarea Creada #" . $tareaId, 'Agregue un formulario de evaluacion')->persistent('Close');
;
                     return redirect($newUrl);

                     //return $tareaId; // Si lo hace con el script
                 }
                else{
                    alert()->success('Error al crear la Tarea');
                }


         }
        else{
            alert()->success('Error al crear recurso');
        }
         /*if($result){
             alert()->success('Recurso creado exitosamente ');
         }
        else{
            alert()->success('Error al crear recurso');
        }*/
        return back();

        
    }

    public function showCrearForm($id_curso, $tareaId){

        $tarea = Tarea::find($tareaId)->nombre;

         return view('Recursos.crearFormulario')
                                                ->with('curso', $id_curso)
                                                ->with('tareaId', $tareaId)
                                                ->with('nombreTarea', $tarea);

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


    /**
    * Se usa para saber si la tarea buscada existe y si esta ya tiene un formulario asignado
    return: boolean
    */
    public function formularioAsignado(Request $request){
    	   
        $id_tarea = $request->input('tareaAsig');

        //$tarea = Tarea::find($id_tarea);

        $tarea = Tarea::find($id_tarea);

         if(count($tarea)>0){
            //se encontro una tarea con ese codigo

            $formulario = Formulario::where('Formulario.id_tarea', '=', $id_tarea)->get();
            if(count($formulario)>0)
                return "1";
            return "0";


         }else{

            return "-1";
         }



        
      
        

      //  $form = Formulario::where('Formulario.id_tarea', '=', $id_tarea),

    }


}


//Falta metodo que retorne la vista del blade SubirEntrega.blade.php
//falta crear ese blade, ese blade se inyecta en la modal desde el script subirTarea()
//revisar metodo crearRecursoSemana en RecursoController a manera de ejemplo

//Este metodo se llama en el summit del form SubirEntrega
public function uploadTask($id_tarea,$id_curso){
        /* Metodo de carga de archivo*/

dd("!Tarea");


        ini_set('memory_limit', '-1');
  // obteniendo la informacion del archivo
        $ext = Input::file('file')->getClientOriginalExtension(); // obtiene la extension del archivo
        $originalName = Input::file('file')->getClientOriginalName(); //obtiene el nombre original del archivo
        $file = Input::file('file');


        //NO hace falta almacenarlo en stora solo en el localRepository (Gera)
         /*Storage::put($file->getClientOriginalName(), $file);
         $filename = $file->store('recursos');
*/


/*
         $destinationPath = '/Applications/XAMPP/xamppfiles/htdocs/eLearning1/public/docs\\'; // upload path

                 if ($request->file('file')->isValid()) {
                     $pdf_name   = date('YmdHis'). ".$ext";
                     $upload_path = 'docs/';
                     $request->file('file')->move($upload_path, $pdf_name);
                     return view('Recursos.subirTarea')->with('id_tarea',$id_tarea)
                                            ->with('id_curso',$id_curso);
                                            
                 }
                 return false;*/

          //Se puede subir cualquier tipo de archivo... como en Recursos,
                 //Revisar metodo upload del controlador UploadController.



    }
