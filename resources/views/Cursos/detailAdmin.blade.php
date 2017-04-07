@extends('layouts.principal') @section('contenido')



<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                  

                    <h3 class="profile-username text-center">{{$curso->nombre}}</h3>
                    @php
                        $date = new DateTime($curso->fecha_inicio);
                        $fechaI = $date->format('d/m/Y H:i:s');
                        $date = new DateTime($curso->fecha_final);
                        $fechaF = $date->format('d/m/Y H:i:s');
                    @endphp


                    <h4>Profesores</h4>
                    <ul class="list-group list-group-unbordered">
                        @foreach($profesores as $profe)
                            <li class="list-group-item">
                            <a>{{$profe->nombre}}</a>
                        </li>
                        @endforeach
                        <br>
                        <li class="list-group-item">
                            <b>Fecha Inicio</b> <a class="pull-right">{{$fechaI}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Fecha Final</b> <a class="pull-right">{{$fechaF}}</a>
                        </li>
                    </ul>

                    <hr>
                    @if($isMatriculated == 6)
                     <button type="button" class="btn btn-block btn-info btn-lg" style="width: 100%; font-weight: bold;">Matricularme</button>
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">

                       <!-- <div class="post clearfix">
                            <div class="user-block">

                                <span class="username">
                                   <a href="#">Semana 1</a>
                                   <a href="#" class="pull-right btn-box-tool"><i class="fa fa-edit"></i></a>
                                </span>
                                <span class="description">Tema de la semana</span>
                            </div>
                            
                            <!-- RECURSOS  

                        </div> -->

                        <div class="row">
        <div class="col-md-12">
            <div class="box collapsed-box">
                <div class="box-header with-border"> 
                  <input class="box-title inputS" type="text" value="Esto es un tema"/>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>                    
                    <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                  </div> 
                </div>
                                            <!-- /.box-header -->
                <div style="display: none;" class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                          <!--Contenido-->
                          <h2>LALA</h2>
                          <h3>lolo</h3>
                          <h4>lulu</h4>
                          <!--Fin Contenido-->
                        </div>
                    </div>
                                    
                </div>
            </div>

        </div>
    </div> <!--FIN ROW  -->


                        @foreach($semanas as $semana)
                          @include('Cursos.semanas')
                        @endforeach

                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>



@endsection
