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



