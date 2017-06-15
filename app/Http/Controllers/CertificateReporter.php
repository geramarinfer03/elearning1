<?php

namespace elearning1\Http\Controllers;

use Illuminate\Http\Request;

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
}
