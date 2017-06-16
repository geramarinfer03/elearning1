@extends('layouts.principal') @section('contenido')


<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Elearning - </b>Generación de Diplomas </a>
    </div>
    <div class="login-box-body">
       <div class="form-group has-feedback">
            <span style="font-size:25px"><i>El proceso automatizado se ejecuta a las: <b>{{$horario}}</b> </i></span>
       </div>

     <div class="row">
        <div class="col-xs-4">
            {!! Form::submit('Editar',  ['class'=>'btn btn-primary btn-block btn-flat']) !!}
        </div>
        <div class="col-xs-7">
            {!! Form::open(['url'=>'executeSP','method' => 'post','class'=>'form-horizontal']) !!}
                {!! Form::submit('Ejecutar ahora',  ['class'=>'btn btn-primary btn-block btn-flat']) !!}
            {!! Form::close() !!}
        </div>
    </div>


    </div>
</div>

@endsection
