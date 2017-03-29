@extends('layouts.admin') @section('contenido')

<!-- TO DO List -->
<div class="box box-primary">
    <div class="box-header">
        <i class="ion ion-clipboard"></i>

        <h3 class="box-title">Lista de Cursos</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <ul class="todo-list">
         @foreach($cursos as $curso)
            <li>
                <!-- todo text -->
                <span class="text">{{$curso -> nombre}}</span>

                <!-- General tools such as edit or delete-->
                <div class="tools">
                    <a href=""><i class="fa fa-eye"></i></a>
                    <a href=""><i class="fa fa-edit"></i></a>
                    <a href=""><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix no-border">
        <a href="cursos_create"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button></a>
    </div>
</div>


@endsection
