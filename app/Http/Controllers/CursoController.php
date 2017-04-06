<?php

namespace elearning1\Http\Controllers;

use elearning1\Curso;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use DateTime;


class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $cursos  = Curso::all();
       return view('Cursos.index',['cursos'=>$cursos]);  
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
    public function show($id)
    {
        //

      return view('Cursos.detailAdmin');
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
