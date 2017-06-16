<?php

namespace elearning1\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Alert;

class CertificateReporter extends Controller
{
    public function generate(){
         $data= [];
         $dt = date('m-d-Y');
         $data = [
        'NOMBRE' => 'Alejandro Sanchez O.',
        'CURSO'   => 'Estructuras de datos',
        'NOTA'=> 88,
        'FECHA' => $dt,
        ];
        $pdf = \PDF::loadView('reporter.certificate',$data);
        return $pdf->download('test.pdf');
    }


    public function index(){
        $schedule = date('H:i:s'); // Bring this from DB field where indicates the schedule to run the process ]
        return view('reporter.createCertificates', ['horario'=>$schedule]);
   }

    public function generatePost(Request $request){
         $data= [];
         $dt = date('m-d-Y');
         $nota = $request->promedioFinal;
         $modalidad = ($nota<70)?"Aprovechamiento":"Participación";
         $data = [
        'NOMBRE' => $request->nombre_usuario,
        'CURSO'   => $request->cursoNombre,
        'NOTA'=> $nota,
        'FECHA' => $dt,
        'MODALIDAD'=>$modalidad,
        ];
        $pdf = \PDF::loadView('reporter.certificate',$data);
        return $pdf->download('Diploma.pdf');
    }


    public function executeStoreProcedure (){

       
         try {

             $result = DB::select("CALL pr_update_generate_certificate()");
              Alert::success("Ejecutado correctamente"); 
                   
            } catch (\Exception $e) {
              
              Alert::error('Error en el proceso');
            
            }
         
         return back();
    }

}
