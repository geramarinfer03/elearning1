<?php

namespace elearning1\Http\Controllers;

use elearning1\Curso;
use elearning1\Semana;
use Alert;
use elearning1\Matricula;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Auth\Guard;

use DateTime;


class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        //todos los cursos
       //$cursos  = Curso::all();
       $hoy = date('Y-m-d H:i:s');
       $id =\Auth::user();

       if($id == null){
          $mat_curso = Curso::where('Curso.fecha_final', '>', $hoy)
                            ->where('Curso.estado', '=', 1)->get();  

       }else{
       //Si es Administrador muestra todos los cursos. 
       //si no lo es, muestra solo los cursos en los que no está matriculado y
       // aquellos con estado en 1
       if($id->id_rol == 1){
        $mat_curso = Curso::all();

       }else{

          $mat_curso = Curso::distinct()->select('Curso.id_curso', 'Curso.nombre', 'Curso.duracion', 'Curso.fecha_inicio', 'Curso.fecha_final', 'Curso.estado')->where('Curso.fecha_final', '>', $hoy)->where('Curso.estado', '=', 1)->leftJoin('Matricula',  function($join) use($id, $hoy){
          $join->on('Curso.id_curso', '=', 'Matricula.curso')->where('Matricula.usuario', '=', $id->id);
          })->whereNull('Matricula.curso')->paginate(6);


       }
      }
      $titulo = "Lista de Cursos";
       //return view('Cursos.index',['cursos'=>$mat_curso]);  
      return view('Cursos.index')->with('cursos', $mat_curso)
                                 ->with('titulo', $titulo);
   }

   public function misCursos(){

    $titulo = "Mis Cursos";
    $id =\Auth::user();

    $mat_curso = Curso::distinct()->select('Curso.id_curso', 'Curso.nombre', 'Curso.duracion', 'Curso.fecha_inicio', 'Curso.fecha_final', 'Curso.estado')->join('Matricula', 'Matricula.curso', 'Curso.id_curso')
                                         ->where('Matricula.usuario', '='. $id->id);



     return view('Cursos.index')->with('cursos', $mat_curso)
                                 ->with('titulo', $titulo);

   }




    /**
     * Show the form for creating a new course.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
       return view('Cursos.create');
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){


      
      $this->validate($request, [
        'nombre'=>'Required',
        //'duracion'=>'Required',
        'fecha_inicio'=>'Required',
        'fecha_final'=>'Required',
        'estado' => 'Required'
      ]);

         $nombre = $request->input('nombre');
          //$duracion = $request->input('duracion');
         $finicial = $request->input('fecha_inicio');
         $ffinal = $request->input('fecha_final');
         $estado = $request->input('estado');



         $f1 = new DateTime($finicial);
        $f2 = new DateTime($ffinal);

        $interval = date_diff($f2, $f1);

        $week = $interval->format('%a');

        $duracion =  round($week/7);
     





       Curso::create([
          'nombre' => $nombre,
          'duracion' => $duracion,
          'fecha_inicio' => $finicial,
          'fecha_final' => $ffinal,
          'estado' => $estado
        ]);




        
        $curso_id = Curso::all()->last()-> id_curso;


        $contador = 1;
        
        while($duracion > 0){
          $duracion = $duracion - 1;
           
            
            $titulo = "Semana #".$contador. "Curso".$curso_id;
            
            Semana::create([
                'tema' => $titulo,
                'visible'=> '1',
                'estado' => '1',
                'curso' => $curso_id,
                'secuencia' => $contador
            ]);
            
             $contador = $contador+1;
            
        }



           /*$curso = $request->all();
           Curso::create($curso);*/

           $mensaje = "Curso Agregado correctamente ";
           return view('Cursos.success',['mensaje'=> $mensaje]);

         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

      $curso= Curso::find($id);
      $semanas = $curso->semanas;
      $user = \Auth::user(); //Usuario puede ser NULL


      $profes = Matricula::join('Usuario', 'Usuario.id', '=', 'Matricula.usuario')
                         ->select('Usuario.nombre', 'Usuario.id', 'Matricula.rol')
                         ->where('Matricula.rol','=', '3')
                         ->where('Matricula.curso', '=', $id)->get();

      //rol 6 -> guess
      $miCurso = 6;

      if($user != NULL){
          $miCurso = Matricula::distinct()->where('Matricula.usuario', '=', $user->id)
                                          ->where('Matricula.curso', '=', $curso->id_curso)->select('Matricula.rol')->get();
          $rol = 6;
          foreach ($miCurso as $mat) {
            $rol = $mat->rol;
          }
          $miCurso = $rol;
      }
      
      
      return view('Cursos.detailAdmin')->with('curso', $curso)
                                       ->with('semanas', $semanas)
                                       ->with('profesores', $profes)
                                       ->with('isMatriculated', $miCurso);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


         $curso= Curso::find($id);

         return view('Cursos.edit', compact('curso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
         $this->validate($request, [
          'nombre'=>'Required',
          //'duracion'=>'Required',
          'fecha_inicio'=>'Required',
          'fecha_final'=>'Required',

          ]);

         $nombre = $request->input('nombre');
           //$duracion = $request->input('duracion');
         $finicial = $request->input('fecha_inicio');
         $ffinal = $request->input('fecha_final');
         $estado = $request->input('estado');

         $f1 = new DateTime($finicial);
         $f2 = new DateTime($ffinal);

         $interval = date_diff($f2, $f1);

         $week = $interval->format('%a');

         $duracion =  round($week/7);




         $curso = Curso::find($id);
        /* $cursoUpdate = $request->all();
        $curso->update($cursoUpdate);*/

        $curso->update([
         'nombre' => $nombre,
         'duracion' => $duracion,
         'fecha_inicio' => $finicial,
         'fecha_final' => $ffinal,
         'estado' => $estado
         ]);


        $mensaje = "Curso Modificado correctamente";

        return view('Cursos.success',['mensaje'=> $mensaje]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $curso = Curso::find($id);
          $curso->delete();

          $mensaje = "Curso Eliminado correctamente";
          return view('Cursos.success',['mensaje'=> $mensaje]);
    }
}
