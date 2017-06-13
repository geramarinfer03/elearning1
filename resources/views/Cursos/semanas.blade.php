
<div class="row">
    <div class="col-md-12">
        <div class="box collapsed-box">
            <div class="box-header with-border">

                @unless(!Auth::check())
                <!--button id="btn_activar_edicion" style="color:blue; margin:5px;" onclick="edicion()" class="btn btn-default"><i class="fa fa-edit"></i>Activar Edición</button-->
                @endunless
              <form method="post" id="cambiarNSemana{{$semana->id_semana}}"  action="/guardarNombreSemana">
                 <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                  <input type="hidden" name="id_semana" value="{{$semana->id_semana}}"> 
                 <input id="nombreSemana" name="nombreSemana" class="box-title inputS nombreSemana" onchange="cambiarNombreSemana({{$semana->id_semana}})" disabled="disabled" type="text" value="{{$semana->tema}}" /> 

                 <button id="btnCnameSemana_{{$semana->id_semana}}" type="submit" class="btn_inv"><i class="fa fa-save fa-2x"></i></button>
              </form>


                @unless(!Auth::check())
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->

                </div>
                @endunless
            </div>
            <!-- /.box-header -->
            <div style="display: none;" class="box-body">
                <div class="row">
                    <div class="col-md-12">


                        <table id="main_table" class="display table table-hover" style="border: 1px dotted red;">

                            <tbody id="sem{{$semana->id_semana}}_row0" class="main_table_seccion">

                                   <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                @foreach($semana->recursos as $recurso)
                                
                                    @if($recurso->tipo_recurso == 6)
                                      @if($recurso->isimage())
                                        <script type='text/javascript'>
                                          descargarImagen('{{$recurso->id_recurso}}', '{{$recurso->url}}');
                                        </script>
                                      @endif
                                    @endif

                                                                
        
                                
                
                                
                                       @if($recurso->tipo_recurso == 3 ||$recurso->tipo_recurso == 4  )
											<script type="text/javascript">
												tabular("<tr class='normal' id='{{$recurso->id_recurso}}'><td><p class='tituloP'>{{$recurso->nombre}}</p><p class='notesP'>{{$recurso->notas}}</p></td><td><button id='btn_activar_edicion' style='color:blue; margin:5px;' onclick='edicion(<?= $recurso->id_recurso; ?>)' class='tn btn-default hiddenclass'><i class='fa fa-edit'></i></button></td></tr>", {{$recurso->semana}}, {{$recurso->recurso_padre}});
											</script>
                                
                                        
											
                          				@endif

                          				@if($recurso->tipo_recurso == 1||$recurso->tipo_recurso == 5)
         									<script type="text/javascript">
												tabular("<tr class='normal' id='{{$recurso->id_recurso}}'><td><a style='text-decoration: underline;' href='{{$recurso->url}}' target='_blank'>{{$recurso->nombre}}</a><p class='notesP'>{{$recurso->notas}}</p></td><td><button id='btn_activar_edicion' style='color:blue; margin:5px;' onclick='edicion(<?= $recurso->id_recurso; ?>)' class='tn btn-default hiddenclass'><i class='fa fa-edit'></i></button></td></tr>",{{$recurso->semana}}, {{$recurso->recurso_padre}});                         					
                          					</script>
                          				@endif
                                
                                        @if($recurso->tipo_recurso == 2)
         									<script type="text/javascript">
												tabular("<tr class='normal' id='{{$recurso->id_recurso}}'><td><table id='mainmain_table_seccion_table{{$recurso->id_recurso}}' class='display table table-hover conB'><thead><tr><th><p class='tituloP'>{{$recurso->nombre}}</p><p class='notesP'>{{$recurso->notas}}</p></th><th><button id='btn_activar_edicion' style='color:blue; margin:5px;' onclick='edicion(<?= $recurso->id_recurso; ?>)' class='btn btn-default hiddenclass'><i class='fa fa-edit'></i></button><button id='btn_activar_edicion' style='color:blue; margin:5px;' onclick='crearRecurso({{$recurso->id_recurso}},{{$curso->id_curso}})' class='btn btn-default hiddenclass'><i class='fa fa-plus'></i></button></th></tr></thead><tbody id='sem{{$recurso->semana}}_row{{$recurso->id_recurso}}' class='main_table_seccion'></tbody></table></td></tr>",{{$recurso->semana}}, {{$recurso->recurso_padre}});                         					
                          					</script>
                          		        @endif
                                
                                
                                        @if($recurso->tipo_recurso== 6  )

											  <script type="text/javascript">
												tabular("<tr class='normal' id='{{$recurso->id_recurso}}'> <td> <p class='tituloP'>{{$recurso->nombre}}</p> <p class='notesP'>{{$recurso->notas}}</p> @if($recurso->isvideo())    <video onclick='Descargar(this,{{$recurso->id_recurso}})' onloadstart='CargarIcono(this)' poster='{{asset('img/down.png')}}' src='/storage/videos/{{$recurso->Curso()}}/{{$recurso->semana}}/{{$recurso->url}}' type='video/mp4' width='500' height='500' controls>   Your browser does not support the video tag. </video>   <input type='hidden' id='_token' name='_token' value='<?php echo csrf_token(); ?>'>  <input type='hidden' id='urlFiles_{{$recurso->id_recurso}}' name='urlFiles' value='{{$recurso->url}}'> <input type='hidden' id='semanaFile_{{$recurso->id_recurso}}' name='semanaFile' value='{{$recurso->semana}}'>  @elseif ($recurso->isimage()) <img src='/storage/{{$recurso->id_recurso}}/tmp{{$recurso->id_recurso}}.{{$recurso->extencion()}}' id='imagen{{$recurso->id_recurso}}' style='width: 30%;' /> <form action='/download' method='POST' id='formDownload'>  <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'> <input type='hidden' name='urlFiles' value='{{$recurso->url}}'> <input type='hidden' name='nameFile' value='{{$recurso->nombre}}'> <input type='hidden' name='extRec' value='{{$recurso->extencion()}}'> <div class='row'> <div class='col-md-1'> <button  style='margin: 10px; margin-left: 18px;' type='submit' class='btn btn-primary btn-block btn-flat'><i class='fa fa-download'></i></button> </div> <div class='col-md-4'> <p class='notesP' style='margin-top: 20px;'>{{$recurso->nombre}}</p> </div> </div> </form>  @else  @if($recurso->isaudio()) <img src='/img/miniaturas/xml.png' style='width: 80px; height: 80px; ' />  @else   <img src='/img/miniaturas/<?= $recurso->extencion(); ?>.png' style='width: 80px; height: 80px; ' />  <form action='/download' method='POST' id='formDownload'>  <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'> <input type='hidden' name='urlFiles' value='{{$recurso->url}}'> <input type='hidden' name='nameFile' value='{{$recurso->nombre}}'> <input type='hidden' name='extRec' value='{{$recurso->extencion()}}'> <div class='row'> <div class='col-md-1'> <button  style='margin: 10px; margin-left: 18px;' type='submit' class='btn btn-primary btn-block btn-flat'><i class='fa fa-download'></i></button> </div> <div class='col-md-4'> <p class='notesP' style='margin-top: 20px;'>{{$recurso->nombre}}</p> </div> </div> </form>  @endif @endif    </td> <td> <button id='btn_activar_edicion' style='color:blue; margin:5px;' onclick='edicionArchivo(<?= $recurso->id_recurso; ?>)' class='tn btn-default hiddenclass'><i class='fa fa-edit'></i>  </button> </td> </tr>", {{$recurso->semana}}, {{$recurso->recurso_padre}}); 
											</script>  
                                <!--@include('Recursos.archivo') -->
                          				@endif
                                
                                 @if($recurso->tipo_recurso== 7  ) <!-- Si es una tarea -->

                                    <!--@include('Recursos.archivo') <!-- Para montar la vista antes de pasarla a texto comprimido -->
                                    
                                    <!--
                                     <script type="text/javascript">
                                     tabular("", {{$recurso->semana}}, {{$recurso->recurso_padre}}); 
                                    </script>  
                                    -->

                                 @endif
                                


                                
                                
                                @if($recurso->estado==0)
                                <script type="text/javascript">
                                    estadoInactivo({{$recurso->id_recurso}});
                                </script>
                                @endif
                                
                                @if($recurso->visibl==0 && $recurso->rol <= $isMatriculated &&  Auth::user()->rol->id_rol != '1')
                                <script type="text/javascript">
                                    visibleInactivo({{$recurso->id_recurso}});
                                </script>
                                @endif
                                
                                @unless(!Auth::check())
                                @if($recurso->rol < $isMatriculated && Auth::user()->rol->id_rol != '1')
                                <script type="text/javascript">
                                    visibleInactivo({{$recurso->id_recurso}});
                                </script>
                                @endif
                                @endunless
                                

                                

                            @endforeach
                            </tbody>
                        </table>



                        <!--Fin Contenido-->
                    </div>

                   <!--
                    Sirve para abrir los form que se van a guardar...
                    --> 

                    @unless(!Auth::check())
                      @if(Auth::user()->rol->id_rol == 1 || $isMatriculated < 4 )
                       <a style="color:white; margin:5px 20px 5px 5px; float: right;" onclick="crearRecursoSemana({{$semana->id_semana}}, {{$curso->id_curso}})" class="btn btn-success"><i class="fa fa-plus"></i></a>
                       @endif

                  @endunless
                 </div>

            </div>
        </div>

    </div>
</div>
<!--FIN ROW  -->
