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
         $dt = date('d-m-Y');
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
    public function alterEvent(){
        
        $horario = "2017-06-17 03:00:00";
        $frecuencia = "DAY";
        $intervalValue = "1";

        //$horaio = $request->horario;

        //$timestamp = strtotime($horario);
        echo $horario;
        echo "</br>";

        //$statement = "ALTER EVENT Actualizar_Estado_PDF ON SCHEDULE EVERY 1 DAY '" . date("Y-m-d H:i:s", $timestamp) . "'";
        //$statement = "ALTER EVENT Actualizar_Estado_PDF ON SCHEDULE EVERY 1 DAY STARTS '2017-06-17 01:00:00'  ";
        $statement = "ALTER EVENT Actualizar_Estado_PDF ON SCHEDULE EVERY ". $intervalValue ." " . $frecuencia . " STARTS ' " . $horario. "' ";
        //$statement = addslashes($statement);
        //$statement = mysql_escape_string($statement);
        echo $statement;
        //$result = DB::statement($statement);
        DB::connection()->getPdo()->exec($statement);
         //DB::select("ALTER EVENT Actualizar_Estado_PDF ON SCHEDULE EVERY 1 DAY STARTS '2017-06-17 01:00:00'");
        //return back();
    }
    public function alterEventPost(Request $request){
        
        $horario = $request->fecha . " " . $request->hora;
        $frecuencia = $request->frecuencia;
        $intervalValue = $request->intervalValue;

        //$horaio = $request->horario;

        //$timestamp = strtotime($horario);
       

        //$statement = "ALTER EVENT Actualizar_Estado_PDF ON SCHEDULE EVERY 1 DAY '" . date("Y-m-d H:i:s", $timestamp) . "'";
        //$statement = "ALTER EVENT Actualizar_Estado_PDF ON SCHEDULE EVERY 1 DAY STARTS '2017-06-17 01:00:00'  ";
        $statement = "ALTER EVENT Actualizar_Estado_PDF ON SCHEDULE EVERY ". $intervalValue ." " . $frecuencia . " STARTS ' " . $horario. "' ";
        //$statement = addslashes($statement);
        //$statement = mysql_escape_string($statement);
 
        //$result = DB::statement($statement);
        DB::connection()->getPdo()->exec($statement);
         //DB::select("ALTER EVENT Actualizar_Estado_PDF ON SCHEDULE EVERY 1 DAY STARTS '2017-06-17 01:00:00'");
        Alert::success("Ejecutado correctamente"); 
        return back();
    }
}
