@extends('layouts.admin') 

@section('contenido')
<div class="col-md-6">
    <div class="box box-default">
        <div class="box-header with-border">
            <div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i> Mensaje!</h4> Curso agregado correctamente
                
            </div>
            <a href="cursos"><button class="btn btn-primary">Continuar</button> </a>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
@endsection