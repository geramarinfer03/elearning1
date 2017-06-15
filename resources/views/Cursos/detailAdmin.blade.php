@extends('layouts.principal') 

@section('contenido')



<!-- Main content -->
<section class="content">

    <div class="row">
    @include('modal_usuario')
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
                        @unless(!Auth::check())
                           @if(Auth::user()->rol->id_rol == 1)
                               <li class="list-group-item">
                                <b>Perfil en el curso</b> <a class="pull-right">Administrador</a>
                              </li>
                           @else
                              <li class="list-group-item">
                                <b>Perfil en el curso</b> <a class="pull-right">{{$nombreRol}}</a>
                              </li>
                           @endif
                        
                        @endunless

                        @if($conGeneradorDiploma)
                          <li class="list-group-item">
                            <form action="/generateReport" method="post">
                                 <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                                 @unless(!Auth::check())
                                 <input type="hidden" name="id_usuario" value="{{Auth::user()->id}}">
                                 <input type="hidden" name="nombre_usuario" value="{{Auth::user()->nombre}}">  
                                 @endunless
                                 <input type="hidden" name="curso_mat" value="{{$curso->id_curso}}">
                                 <input type="hidden" name="cursoNombre" value="{{$curso->nombre}}">
                                 <input type="hidden" name="promedioFinal" value="{{$matricula->promedio_final}}"> 
                                 <input type="hidden" name="roles" value="5"> 
                                <button type="submit" class="btn btn-block btn-info btn-lg" style="width: 100%; font-weight: bold;">Generar Diploma</button>
                             </form>
                          </li>
                        @endif
                         

                    </ul>

                    <hr>
                    @if($isMatriculated == 6)
                    <form action="/crearMatricula" method="post">
                         <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                         @unless(!Auth::check())
                         <input type="hidden" name="id_usuario" value="{{Auth::user()->id}}"> 
                         @endunless
                         <input type="hidden" name="curso_mat" value="{{$curso->id_curso}}"> 
                         <input type="hidden" name="roles" value="5"> 
                     <button type="submit" class="btn btn-block btn-info btn-lg" style="width: 100%; font-weight: bold;">Matricularme</button>
                     </form>
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



                  @if(Auth::check() && Auth::user()->rol->id_rol == 1)
                         <button type="button" style="margin-bottom: 15px;"  onclick="activarEdicion()" class="btn btn-primary btn-md pull-left"><i class="fa fa-edit"></i> Activar Edición</button>
                  @else

                    @if( $isMatriculated < 5)
                        <button type="button" style="margin-bottom: 15px;"  onclick="activarEdicion()" class="btn btn-primary btn-md pull-left"><i class="fa fa-edit"></i> Activar Edición</button>
                
                    @endif
                   
                  @endif
                
                    
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
