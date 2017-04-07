
    <div class="row">
        <div class="col-md-12">
            <div class="box collapsed-box">
                <div class="box-header with-border"> 
                  <input class="box-title inputS" type="text" value="{{$semana->tema}}"/>
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
                         <!--<ul id="menu" style="width: 300px;">
                             
                          	@foreach($semana->recursos as $recurso)
                          		 <li style="list-style: none; padding: 5px;margin: 3px 0;background: #000;"><a style="color: #fff" href="#">{{$recurso->nombre}}</a></li>
                          	@endforeach

                          </ul> -->

       						<table id="main_table" class="display table table-hover" style="border: 1px dotted red;">

       						<tbody id="sem{{$semana->id_semana}}_row0" class="main_table_seccion">

       					

         					@foreach($semana->recursos as $recurso)

                          				@if($recurso->tipo_recurso == 3)
											<script type="text/javascript">
												tabular("<tr><td><h1>{{$recurso->notas}}</h2></td></tr>", {{$recurso->semana}}, {{$recurso->recurso_padre}});
											</script>
											
                          				@endif

                          				@if($recurso->tipo_recurso == 2)
         									<script type="text/javascript">
												tabular("<tr><td><table id=\"main_table{{$recurso->id_recurso}}\" class=\"display table table-hover conB\"><thead><tr><th>{{$recurso->notas}}</th></tr></thead><tbody id=\"sem{{$recurso->semana}}_row{{$recurso->id_recurso}}\" class=\"main_table_seccion\"></table></td></tr>",{{$recurso->semana}}, {{$recurso->recurso_padre}});                         					
                          					</script>
                          				@endif
                          	
                          	@endforeach
                          	</table>
                        
                          <!--Fin Contenido-->
                        </div>
                    </div>
                                    
                </div>
            </div>

    	</div>
	</div> <!--FIN ROW  -->
