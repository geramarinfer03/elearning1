<tr class='normal' id='{{$recurso->id_recurso}}'>
	<td>
		<p class='tituloP'>{{$recurso->nombre}}</p>
		<p class='notesP'>{{$recurso->notas}}</p>
		@if($recurso->isvideo())
			<img src="/img/miniaturas/json.png" style="width: 80px; height: 80px; " />
		
		@elseif ($recurso->isimage())
			<script type="text/javascript">
				descargarImagen('{{$recurso->id_recurso}}', '{{$recurso->url}}');
			</script>

			<img src="/storage/{{$recurso->id_recurso}}/tmp{{$recurso->id_recurso}}.{{$recurso->extencion()}}" id="imagen{{$recurso->id_recurso}}" style="width: 50%; height: 50%; " />
		
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
		<button id='btn_activar_edicion' style='color:blue; margin:5px;' onclick='edicion(<?= $recurso->id_recurso; ?>)' class='tn btn-default hiddenclass'><i class='fa fa-edit'></i>
			
		</button>
	</td>
</tr>