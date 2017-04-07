@extends('layouts.principal') @section('contenido')


<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Elearning</b> Crear Curso</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
     {!! Form::model($curso, ['route'=>['cursos.update', $curso->id_curso], 'method'=>'PATCH', 'class'=>'form-horizontal']) !!}
     <div class="form-group has-feedback">
       {!! Form::label('nombre', 'Nombre') !!}
       {!! Form::text('nombre', null,  ['class'=>'form-control']) !!}
       <span class="fa fa-book form-control-feedback"></span>
       {!! $errors->has('nombre')?$errors->first('nombre'):'' !!}
     </div>

   <!--div class="form-group has-feedback">
       {!! Form::label('duracion', 'Duración') !!}
       {!! Form::number('duracion', null,  ['class'=>'form-control']) !!}
       <span class="fa fa-hourglass-half form-control-feedback"></span>
       {!! $errors->has('duracion')?$errors->first('duracion'):'' !!}
   </div-->

   <div class="form-group has-feedback">

       {!! Form::label('fecha_inicio', 'Fecha inicial') !!}
       {!! Form::date('fecha_inicio', \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $curso->fecha_inicio)->format('Y-m-d'),  ['class'=>'form-control']) !!}
       <span class="fa fa-clock-o form-control-feedback"></span>
       {!! $errors->has('fecha_inicio')?$errors->first('fecha_inicio'):'' !!}
   </div>

   <div class="form-group has-feedback">
       {!! Form::label('fecha_final', 'Fecha final') !!}
       {!! Form::date('fecha_final', \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $curso->fecha_final)->format('Y-m-d'),  ['class'=>'form-control']) !!}
       <span class="fa fa-clock-o form-control-feedback"></span>
       {!! $errors->has('fecha_final')?$errors->first('fecha_final'):'' !!}
   </div>


   <div class="form-group has-feedback">
        {!! Form::hidden('estado', '0') !!}
        {!! Form::label('estado', 'Estado') !!}
        {{ Form::checkbox('estado', 1, true, ['class' => 'field']) }}
        {!! $errors->has('estado')?$errors->first('estado'):'' !!}
   </div>

 

   <div class="row">
    <div class="col-xs-4">
        {!! Form::submit('Guardar',  ['class'=>'btn btn-primary btn-block btn-flat']) !!}
    </div>
    <!-- /.col -->
  </div>
{!! Form::close() !!}


</div>
<!-- /.login-box-body -->
</div>


@endsection
