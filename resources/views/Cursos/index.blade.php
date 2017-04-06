@extends('layouts.principal') @section('contenido')

<!-- TO DO List -->

<section class="content-header">
  <h1>
    Lista de Cursos
</h1>

</section>
<br/>
<br/>

<div class="box box-primary">

<section class="content">
    <div class="row">



        @foreach($cursos as $curso)
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            @if ($curso->estado == 1)
            <div class="small-box bg-green">
            @endif

            @if ($curso->estado == 0)
            <div class="small-box ">
            @endif

              <div class="inner">
                  <p><b>{{$curso -> nombre}}</b></p>
                  <p>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $curso->fecha_inicio)->format('d/m/Y')}}
                   - {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $curso->fecha_final)->format('d/m/Y')}}</p>
              </div>
              <br/>

              <div class="icon">
                <i class="fa fa-book"></i>
            </div>
            <div class="small-box-footer">
                <div class="tools">
                    <a style="color:blue; margin:5px;" href="{{ route('cursos.show', $curso->id_curso) }}"><i class="fa fa-eye"></i></a>
                    <a style="color:#FFC107; margin:5px;"  href="{{ route('cursos.edit', $curso->id_curso) }}"><i class="fa fa-edit"></i></a>



                </div>
                <!--{!! Form::open(['method'=>'delete', 'route'=>['cursos.destroy', $curso->id_curso]]) !!}
                {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit','class'=>'btn btn-danger btn-sm' ,  'onclick'=> 'return confirm("Do you want to delete blog?")'])!!}
                {!! Form::close() !!}-->
            </div>

        </div>
         
    </div>    

    @endforeach
</div>
</section>





<!-- /.box-body -->
<div class="box-footer clearfix no-border">
    <a href="{{route('cursos.create')}}"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Agregar Curso</button></a>
</div>

</div>


@endsection
