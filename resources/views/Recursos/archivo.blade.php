<!-- 	<td>
		<p class='tituloP'>{{$recurso->nombre}}</p>
		<p class='notesP'>{{$recurso->notas}}</p>
		@if($recurso->isvideo())



			<video onclick="Descargar(this,{{$recurso->id_recurso}})" onloadstart="CargarIcono(this)" poster="{{asset('img/down.png')}}"
             src="/storage/videos/{{$recurso->Curso()}}/{{$recurso->semana}}/{{$recurso->url}}" type="video/mp4" width="500" height="500" controls>
				
				
				Your browser does not support the video tag.
			</video>
				<input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>"> 

                <input type="hidden" id="urlFiles_{{$recurso->id_recurso}}" name="urlFiles" value="{{$recurso->url}}">
                <input type="hidden" id="semanaFile_{{$recurso->id_recurso}}" name="semanaFile" value="{{$recurso->semana}}">

        
        @elseif ($recurso->isimage())
            <img src="/storage/{{$recurso->id_recurso}}/tmp{{$recurso->id_recurso}}.{{$recurso->extencion()}}" id="imagen{{$recurso->id_recurso}}" style="width: 30%;" />
            <form action="/download" method="POST" id="formDownload">

            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
            <input type="hidden" name="urlFiles" value="{{$recurso->url}}">   
            <input type="hidden" name="nameFile" value="{{$recurso->nombre}}">
            <input type="hidden" name="extRec" value="{{$recurso->extencion()}}">      
            <div class="row">
            <div class="col-md-1">
            <button  style="margin: 10px; margin-left: 18px;" type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-download"></i></button>
            </div>
            <div class="col-md-4">
                <p class="notesP" style="margin-top: 20px;">{{$recurso->nombre}}</p>
            </div>
            </div>
            </form>
        
        @else
        
            @if($recurso->isaudio())
                <img src="/img/miniaturas/xml.png" style="width: 80px; height: 80px; " />
            
            @else

        
            <img src="/img/miniaturas/<?= $recurso->extencion(); ?>.png" style="width: 80px; height: 80px; " />

            <form action="/download" method="POST" id="formDownload">

            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
            <input type="hidden" name="urlFiles" value="{{$recurso->url}}">   
            <input type="hidden" name="nameFile" value="{{$recurso->nombre}}">
            <input type="hidden" name="extRec" value="{{$recurso->extencion()}}">      
            <div class="row">
            <div class="col-md-1">
            <button  style="margin: 10px; margin-left: 18px;" type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-download"></i></button>
            </div>
            <div class="col-md-4">
                <p class="notesP" style="margin-top: 20px;">{{$recurso->nombre}}</p>
            </div>
            </div>
            </form>

            @endif
        @endif

        

    </td>
    <td>
        <button id='btn_activar_edicion' style='color:blue; margin:5px;' onclick='edicionArchivo(<?= $recurso->id_recurso; ?>)' class='tn btn-default hiddenclass'><i class='fa fa-edit'></i>
            
        </button>
    </td>
</tr>

-->
<!-- Esto no se usa, solo para estructurar el codigo, luego se pasa comprimido al metodo de JS-->

@if($recurso->tarea != null)
<tr class='normal' id='{{$recurso->id_recurso}}'>

<td>

<div class="row">
    <div class="col-md-12">
        <div class="box collapsed-box box_tarea" id="tarea" >
            <div class="box-header with-border">

                <div class="col-md-7">
                     <h2 class="box-title nombreTarea">{{$recurso->nombre}}</h2>
                </div>

                <div class="col-md-1">
                     <h4 class="box-title">Fecha: </h4>
                </div>
                <div class="col-md-4">
                     <h5 class="box-title">{{$recurso->tarea->fech_limit_entrega()}}</h5>
                </div>
                                <div class="col-md-1">
                 <button id='btn_activar_edicion_tarea' style='color:blue; margin:5px;' onclick='edicion(<?= $recurso->id_recurso; ?>)' class='btn btn-default hiddenclass'><i class='fa fa-edit'></i>
                 </button>
                </div>

              <!-- @unless(Carbon\Carbon::today() > $recurso->tarea->fech_limit_entrega ) -->
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            
                </div>
              <!--  @endunless -->

            </div>

             <div style="display: none;" class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="h3Class">Intrucciones</h3>
                        <div class="tareaInst">
                            <p>{{$recurso->notas}}</p>
                        </div>
                        <br>
                        <div class="row">
                            <label style="margin-left: 5%; font-weight: bold;">Fecha limite de entrega: </label>
                            <label style="margin-left: 5px; font-weight: normal">{{$recurso->tarea->fech_limit_entrega()}}</label>
                        </div>
                        <div class="row">
                            <label style="margin-left: 5%; font-weight: bold;">Fecha limite para evaluar: </label>
                            <label style="margin-left: 5px; font-weight: normal">{{$recurso->tarea->fech_limit_evaluacion()}}</label>
                        </div>
                        <br>
                        <div class="row">
                            <label style="margin-left: 5%; font-weight: bold;">Valor: </label>
                            <label style="margin-left: 5px; font-weight: normal">{{$recurso->tarea->porcentaje}}%</label>
                        </div>
                        @if($recurso->url != null)
                        <div class="row" style="margin-left: 3%;">
                            <img src="/img/miniaturas/<?= $recurso->extencion(); ?>.png" style="width: 80px; height: 80px; " />
                            <br>
                            <label style="font-weight: bold;">
                            {{$recurso->nombre()}}</label>
                            <form action="/download" method="POST" id="formDownload">

                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                            <input type="hidden" name="urlFiles" value="{{$recurso->url}}">   
                            <input type="hidden" name="nameFile" value="{{$recurso->nombre}}">
                            <input type="hidden" name="extRec" value="{{$recurso->extencion()}}">      
                            <div class="row">
                            <div class="col-md-1">
                            <button  style="margin: 10px; margin-left: 18px;" type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-download"></i></button>
                            </div>

                             </div>
                            </form>
                        </div>
                        @endif

                         <div class="row" style="margin-top: 5%;">
                         <div class="col-md-12">
                             <button type="button" class="btn btn-success btn-lg" onclick="subirTarea({{$recurso->tarea->id_tarea}},{{$recurso->tarea->id_curso}})"><i class="fa fa-file" ></i>  Realizar Entrega</button>
                            
                         </div>
                         <div class="col-md-12">
                             <button type="button" class="btn btn-info btn-lg noMostar"><i class="fa fa-check"></i>  Evaluar   Tarea</button>
                            
                         </div>
                            
                         </div>
              

                       


                        


                    </div>
                </div>
            </div>
     


        </div>
    </div>
</div>
</td>
</tr>
@endif