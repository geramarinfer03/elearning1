<?php

namespace elearning1\Http\Controllers;


use elearning1\Curso;
use elearning1\Semana;
use elearning1\Tarea;
use elearning1\Formulario;
use elearning1\Recurso;
use elearning1\Colaboracion;
use DB;
use Input;
use Alert;
use elearning1\Matricula;
use elearning1\Rol;
use elearning1\Entrega;
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
                                                ->with('nombreTarea', $tarea)
                                                ->with('tipoColaboracion', 0)
                                                ->with('entregaID', 0)
                                                ->with('id_form', 0);

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

    public function showEntrega($id_tarea, $id_curso){

 
      $id_recurso = Tarea::find($id_tarea)->id_recurso;

      $recurso = Recurso::find($id_recurso);


      return view('Recursos.entrega')->with('curso',$id_curso)
                                     ->with('tarea_id', $id_tarea)
                                     ->with('tarea', $recurso);
     

    }

    protected function buscarEntrega($usuario, $tarea){
      $entrega = Entrega::where('Entrega.id_usuario', '!=', $usuario)
                        ->where('Entrega.id_tarea', '=', $tarea)
                        ->inRandomOrder()->first();
      return $entrega;

    }

    public function showFormColaboracion(Request $request){

      $idTarea = $request->input('tareaID');
      $tipoColaboracion = $request->input('tipoCola');

      $usuario_califica = \Auth::user()->id;
      $calificada = true;

      $cantidadEntregas  = Entrega::where('Entrega.id_usuario', '!=', $usuario_califica)
                        ->where('Entrega.id_tarea', '=', $idTarea)
                        ->inRandomOrder()->count();

      
     //va a buscar una entrega hasta que no hayan mas o hasta que no encuentre
     // una colaboracion realizada a esa entrega anteriormente

    if($tipoColaboracion != 1){

    if($cantidadEntregas > 0){
      do{

        $cantidadEntregas -= 1;
        $entrega = $this->buscarEntrega($usuario_califica, $idTarea);

        $colaboracion = Colaboracion::where('Colaboracion.id_usuario_califica', '=', $usuario_califica)->where('Colaboracion.id_entrega', '=', $entrega->id_entrega)->first();
     
      }while($colaboracion != null && $cantidadEntregas != 0);

      if($colaboracion == null){
        //no encontre ninguna, se procede a evaluar esta entrega
        $urlTarea = $entrega->url;
        $formulario = Formulario::where('Formulario.id_tarea', '=', $idTarea)->first();



        list($url, $exten) = explode(".", $urlTarea); 
  
    

        return view('Recursos.calificar')->with('tareaD',$urlTarea)
                                         ->with('estudiante', $entrega->id_usuario)
                                         ->with('tipoColaboracion', $tipoColaboracion)
                                         ->with('entregaID', $entrega->id_entrega)
                                         ->with('extension', $exten)
                                         ->with('formulario', $formulario);


      }
                                         
    }
    alert()->error("Nadie mas ha realizado la entraga de esta tarea", "Espera para poder realizar una calificacion");
    return back();


  }else{

        $entrega = Entrega::where('Entrega.id_usuario', '=', $usuario_califica)
                        ->where('Entrega.id_tarea', '=', $idTarea)->first();

        $formulario = Formulario::where('Formulario.id_tarea', '=', $idTarea)->first();

        return view('Recursos.calificar')->with('tareaD',null)
                                         ->with('estudiante', $usuario_califica)
                                         ->with('tipoColaboracion', $tipoColaboracion)
                                         ->with('entregaID', $entrega->id_entrega)
                                         ->with('extension', null)
                                         ->with('formulario', $formulario);

  }




        




        //Si no encuentra entregas hace autoevaluacion

    }



    public function uploadTask(Request $request){

       $file = Input::file('file');
       $id_curso = $request->input('curso');
       $tarea = $request->input('id_tarea');
       $usuario= \Auth::user()->id;

       $Matricula = Matricula::select('Matricula.id_matricula')
                             ->where('Matricula.curso', '=', $id_curso)
                             ->where('Matricula.usuario', '=', $usuario)->first();

        if($Matricula){

       $id_matricula = $Matricula->id_matricula;

       $extension = $file->getClientOriginalExtension();

       $nombreEntrega = date('YmdHis') . "." . $extension;

      
      
        if ($extension != "exe") {
                
          $destinationPath = $localRepo = realpath('../../../') . "/localRepository";

          $pathRecurso = $destinationPath . "/". $id_curso ."/Entregas/". $usuario . "/";
          $this->crearRuta($pathRecurso);


          $url =  $pathRecurso . $nombreEntrega;



          Input::file('file')->move($pathRecurso, $nombreEntrega);


           $result = Entrega::create([
              'id_tarea'=>$tarea,
              'id_usuario'=> $usuario,
              'id_matricula' => $id_matricula,
              'url' => $url,
              'nota' => 70
            ]);

           if($result){
              alert()->success("Tarea Entregada", "Ahora podrás evaluar otras tareas");
              return back();

           }else{
              alert()->error(":c", "¡Ups! NO se subio su tarea");
              return back();

           }



          }else{

            Alert::error("NO puedes subir exe >:/", "Intente con otro tipo de archivo")->persistent('Close');
            return redirect()->back();
        }
        }else{
         Alert::error("Matriculese como estudiante", "Aunque sea Admin NO puede subir tareas sin estar Matriculado")->persistent('Close');
              return redirect()->back();
        }
    }


    public function crearColaboracion(Request $request){

       $tipoColaboracion = $request->input('tipoColaboracion');
       $entrega_id = $request->input('entregaID');
       $id_form = $request->input('id_form');
       $usuario= \Auth::user()->id;
       $coments = $request->input('comentarios');

       $maxPuntos = $request->input('maxAct');
       $Form = Formulario::find($id_form);
       $id_tarea = $Form->id_tarea;

       $curso = Tarea::find($id_tarea)->id_curso;


       $totalPuntosForm = $Form->totalPuntos;

       $cantActiv = $totalPuntosForm / $maxPuntos;

       $respuestas = array();

       $totalPuntos = 0;
       for($i = 1; $i <= $cantActiv; $i++){
        $valor =  $request->input('puntos' . $i);
          array_push($respuestas, $valor);
          $totalPuntos += $valor;

       }

       $nota= ( $totalPuntos / $totalPuntosForm ) * 100;


        $result = Colaboracion::create([
          'id_usuario_califica'=>$usuario,
          'id_tipo_colaboracion'=> $tipoColaboracion,
          'id_entrega' => $entrega_id,
          'id_formulario' => $id_form,
          'respuestas' => json_encode($respuestas),
          'nota' => $nota,
          'comentario' => $coments
        ]);



       if($result){
          alert()->success("Gracias", "!Evaluación enviada con éxito!");
          return redirect('/cursos.show/' . $curso);
          
       }
       
      
    }




}



