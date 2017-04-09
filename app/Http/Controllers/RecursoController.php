<?php

namespace elearning1\Http\Controllers;

use elearning1\Semana;
use elearning1\Recurso;
use Illuminate\Http\Request;

class RecursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function crearRecursoSemana($semana){
        return view('Recursos.crearRecurso')->with('padre',0)
                                             ->with('semana',$semana);
    }
    
    public function crearRecurso($id){
        
        $recurso = Recurso::find($id);
        
        $semana = $recurso -> semana;
         return view('Recursos.crearRecurso')->with('padre',$id)
                                             ->with('semana',$semana);
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
          'notas'=>'Required',
          'url' => 'Required',
          'estado' => 'Required',
          'visibl' => 'Required',
          'recurso_padre' => 'Required',
          'tipo' => 'Required',
          'semana' => 'Required' 
          
          ]);
        
          $nombre = $request->input('nombre');
          $notas = $request->input('notas');
          $url = $request->input('url');
          $vis = $request->input('visibl');
          $estado = $request->input('estado');
          $recurso_padre = $request->input('recurso_padre');
          $tipo_recurso = $request->input('tipo');
          $semana = $request->input('semana');
        
        
         $sem = Semana::find($semana);
        
        $contador = $sem -> secuencia;
        $contador= $contador +1;
        
        $result1= $sem->update([
            
            'secuencia' =>$contador
        ]);
 
        
       $result = Recurso::create([
          'nombre'=>$nombre,
          'notas'=> $notas,
          'url' => $url,
          'estado' => $estado,
          'visibl' => $vis,
          'recurso_padre' =>$recurso_padre,
          'tipo_recurso' =>$tipo_recurso,
          'secuencia' => $contador,
          'semana' => $semana
        ]);
        
       if($result && $result1){
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
        
        $recurso = Recurso::find($id);
        return view('Recursos.editarRecurso')->with('recurso',$recurso);
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
          'url' => 'Required' 
          
          ]);
        


          $nombre = $request->input('nombre');
          $notas = $request->input('notas');
          $url = $request->input('url');
          $vis = $request->input('visibl');
          $estado = $request->input('estado');
          $id = $request->input('id_recurso');
        
         $recurso = Recurso::find($id); 
        
         $result = $recurso->update([
             'nombre' => $nombre,
             'notas'=>$notas,
             'url' => $url,
             'visibl' => $vis,
             'estado' => $estado
             
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
    
    
    
    public function etiquetaTexto(){
        
        return view('Recursos.etiquetaTexto');
    }
}
