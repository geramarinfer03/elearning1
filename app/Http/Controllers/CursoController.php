<?php

namespace elearning1\Http\Controllers;

use elearning1\Curso;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


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
    public function store(Request $request)
    {
        $nombre = $request->input('nombre');
        $duracion = $request->input('duracion');
        $finicial = $request->input('finicial');
        $ffinal = $request->input('ffinal');
        $estado = 1;
        
        Curso::create([
               'nombre' => $nombre,
               'duracion' => $duracion,
               'fecha_inicio' => $finicial,
               'fecha_final' => $ffinal,
               'estado' => $estado

            ]);

        $mensaje = "Curso Agregado correctamente";
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
