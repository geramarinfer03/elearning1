@extends('layouts.admin') @section('contenido')


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Agregar un nuevo Curso</h3>
    </div>
    <div class="panel-body">

        <form role="form" action="cursos_store" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="box-body">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="nombre" required autofocus>
                </div>
                <div class="form-group">
                    <label for="duracion">Duración</label>
                    <input type="number" class="form-control" name="duracion" placeholder="duracion" required>
                </div>

                <div class="form-group">
                    <label>Fecha inicial:</label>

                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right" id="datepicker" name="finicial" placeholder="dd/mm/yyyy">
                    </div>
                    <!-- /.input group -->
                </div>

                <div class="form-group">
                    <label>Fecha final:</label>

                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right" id="datepicker2" name="ffinal" placeholder="dd/mm/yyyy">
                    </div>
                    <!-- /.input group -->
                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
        </form>
    </div>
</div>

@endsection
