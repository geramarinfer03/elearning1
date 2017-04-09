<div class="row">
    <div class="col-md-12">
        <div class="box collapsed-box">
            <div class="box-header with-border">
                @unless(!Auth::check())
                <!--button id="btn_activar_edicion" style="color:blue; margin:5px;" onclick="edicion()" class="btn btn-default"><i class="fa fa-edit"></i>Activar Edición</button-->
                @endunless
                <input class="box-title inputS" type="text" value="{{$semana->tema}}" /> @unless(!Auth::check())
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



                        <!--Contenido-->
                        <!--<ul id="menu" style="width: 300px;">
                             
                          	@foreach($semana->recursos as $recurso)
                          		 <li style="list-style: none; padding: 5px;margin: 3px 0;background: #000;"><a style="color: #fff" href="#">{{$recurso->nombre}}</a></li>
                          	@endforeach

                          </ul> -->

                        <table id="main_table" class="display table table-hover" style="border: 1px dotted red;">

                            <tbody id="sem{{$semana->id_semana}}_row0" class="main_table_seccion">



                                @foreach($semana->recursos as $recurso)
                                
                                
                                
                                
                                

                                @if($recurso->estado==0||$recurso->visibl==0)
                                
                
                                
                                       @if($recurso->tipo_recurso == 3 ||$recurso->tipo_recurso == 4  )
											<script type="text/javascript">
												tabular("<tr class='opacity'><td><p class='tituloP'>{{$recurso->nombre}}</p><p class='notesP'>{{$recurso->notas}}</p></td><td><button id='btn_activar_edicion' style='color:blue; margin:5px;' onclick='edicion(<?= $recurso->id_recurso; ?>)' class='tn btn-default'><i class='fa fa-edit'></i></button></td></tr>", {{$recurso->semana}}, {{$recurso->recurso_padre}});
											</script>
                                
                                        
											
                          				@endif

                          				@if($recurso->tipo_recurso == 1||$recurso->tipo_recurso == 5)
         									<script type="text/javascript">
												tabular("<tr class='opacity'><td><a style='text-decoration: underline;' href='{{$recurso->url}}'>{{$recurso->nombre}}</a><p class='notesP'>{{$recurso->notas}}</p></td><td><button id='btn_activar_edicion' style='color:blue; margin:5px;' onclick='edicion(<?= $recurso->id_recurso; ?>)' class='tn btn-default'><i class='fa fa-edit'></i></button></td></tr>",{{$recurso->semana}}, {{$recurso->recurso_padre}});                         					
                          					</script>
                          				@endif
                                
                                        @if($recurso->tipo_recurso == 2)
         									<script type="text/javascript">
												tabular("<tr class='opacity'><td><table id='main_table{{$recurso->id_recurso}}' class='display table table-hover conB'><thead><tr><th><p class='tituloP'>{{$recurso->nombre}}</p><p class='notesP'>{{$recurso->notas}}</p></th><th><button id='btn_activar_edicion' style='color:blue; margin:5px;' onclick='edicion(<?= $recurso->id_recurso; ?>)' class='btn btn-default'><i class='fa fa-edit'></i></button><button id='btn_activar_edicion' style='color:blue; margin:5px;' onclick='' class='btn btn-default'><i class='fa fa-plus'></i></button></th></tr></thead><tbody id='sem{{$recurso->semana}}_row{{$recurso->id_recurso}}' class='main_table_seccion'></table></td></tr>",{{$recurso->semana}}, {{$recurso->recurso_padre}});                         					
                          					</script>
                          		        @endif
                                
                                
                                        @if($recurso->tipo_recurso== 6  )
											<script type="text/javascript">
												tabular("<tr class='opacity'><td><p class='tituloP'>{{$recurso->nombre}}</p><p class='notesP'>{{$recurso->notas}}</p><a href='{{$recurso->url}}' class='btn btn-primary'><i class='fa fa-download'></i></a></td><td><button id='btn_activar_edicion' style='color:blue; margin:5px;' onclick='edicion(<?= $recurso->id_recurso; ?>)' class='tn btn-default'><i class='fa fa-edit'></i></button></td></tr>", {{$recurso->semana}}, {{$recurso->recurso_padre}});
											</script>
                          				@endif
                                
                                @endif
                                
                                
                                
                                @if($recurso->estado==1 && $recurso->visibl==1)
                                
                
                                
                                       @if($recurso->tipo_recurso == 3 ||$recurso->tipo_recurso == 4  )
											<script type="text/javascript">
												tabular("<tr id='{{$recurso->id_recurso}}'><td><p class='tituloP'>{{$recurso->nombre}}</p><p class='notesP'>{{$recurso->notas}}</p></td><td><button id='btn_activar_edicion' style='color:blue; margin:5px;' onclick='edicion(<?= $recurso->id_recurso; ?>)' class='tn btn-default'><i class='fa fa-edit'></i></button></td></tr>", {{$recurso->semana}}, {{$recurso->recurso_padre}});
											</script>
                                
                                        
											
                          				@endif

                          				@if($recurso->tipo_recurso == 1||$recurso->tipo_recurso == 5)
         									<script type="text/javascript">
												tabular("<tr id='{{$recurso->id_recurso}}'><td><a style='text-decoration: underline;' href='{{$recurso->url}}'>{{$recurso->nombre}}</a><p class='notesP'>{{$recurso->notas}}</p></td><td><button id='btn_activar_edicion' style='color:blue; margin:5px;' onclick='edicion(<?= $recurso->id_recurso; ?>)' class='tn btn-default'><i class='fa fa-edit'></i></button></td></tr>",{{$recurso->semana}}, {{$recurso->recurso_padre}});                         					
                          					</script>
                          				@endif
                                
                                        @if($recurso->tipo_recurso == 2)
         									<script type="text/javascript">
												tabular("<tr id='{{$recurso->id_recurso}}'><td><table id='main_table{{$recurso->id_recurso}}' class='display table table-hover conB'><thead><tr><th><p class='tituloP'>{{$recurso->nombre}}</p><p class='notesP'>{{$recurso->notas}}</p></th><th><button id='btn_activar_edicion' style='color:blue; margin:5px;' onclick='edicion(<?= $recurso->id_recurso; ?>)' class='btn btn-default'><i class='fa fa-edit'></i></button><button id='btn_activar_edicion' style='color:blue; margin:5px;' onclick='crearRecurso({{$recurso->id_recurso}})' class='btn btn-default'><i class='fa fa-plus'></i></button></th></tr></thead><tbody id='sem{{$recurso->semana}}_row{{$recurso->id_recurso}}' class='main_table_seccion'></table></td></tr>",{{$recurso->semana}}, {{$recurso->recurso_padre}});                         					
                          					</script>
                          		        @endif
                                
                                
                                        @if($recurso->tipo_recurso== 6  )
											<script type="text/javascript">
												tabular("<tr id='{{$recurso->id_recurso}}'><td><p class='tituloP'>{{$recurso->nombre}}</p><p class='notesP'>{{$recurso->notas}}</p><a href='{{$recurso->url}}' class='btn btn-primary'><i class='fa fa-download'></i></a></td><td><button id='btn_activar_edicion' style='color:blue; margin:5px;' onclick='edicion(<?= $recurso->id_recurso; ?>)' class='tn btn-default'><i class='fa fa-edit'></i></button></td></tr>", {{$recurso->semana}}, {{$recurso->recurso_padre}});
											</script>
                          				@endif
                                
                                @endif
                                



                                
                                
                                
                                
                            @endforeach
                        </table>



                        <!--Fin Contenido-->
                    </div>

                    <a style="color:white; margin:5px 20px 5px 5px; float: right;" onclick="crearRecursoSemana({{$semana->id_semana}})" class="btn btn-success"><i class="fa fa-plus"></i></a>

                </div>

            </div>
        </div>
        @include('modal_usuario')
    </div>
</div>
<!--FIN ROW  -->
