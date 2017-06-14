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
}
