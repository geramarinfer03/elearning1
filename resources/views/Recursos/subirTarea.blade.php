<div class="row">

  <!-- Blog Entries Column -->
 {!! Form::open(array('url'=>'/resource/store','method'=>'POST', 'files'=>true)) !!}
    <!--<form id="resourceForm" action="#" method="post"> -->
      <div class="col-md-8" id="reg-form">
    {{ csrf_field() }}


    <div class="about-section">
       <div class="text-content">
         <div class="span7 offset1">
            <div class="secure">Ruta de carga de archivo</div>

             <div class="control-group">
              <div class="controls">
              {!! Form::file('file') !!}
            </div>

       </div>
    </div>
    <button type="submit" class="btn btn-default">Guardar</button>
</div>
{!! Form::close() !!}

@extends('layouts.principal') @section('contenido')
</div>
<!-- /.row -->

<hr>