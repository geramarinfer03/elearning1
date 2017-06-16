@extends('layouts.principal') 

@section('contenido')

@if($tareaD != null)
<form action="/download" method="POST" id="formDownload">

            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/> 
            <input type="hidden" name="urlFiles" value="{{$tareaD}}">   
            <input type="hidden" name="nameFile" value="{{$estudiante}}">     
            <input type="hidden" name="extRec" value="{{$extension}}">   
            <div class="row">
            <div class="col-md-1">
            <button  style="margin: 10px; margin-left: 18px;" type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-download"></i></button>
            </div>
            <div class="col-md-4">
                <p class="notesP" style="margin-top: 20px;">Descargar Tarea que se calificara</p>
            </div>
            </div>
  </form>
@endif

<input type="text" hidden="hidden" id="tipoColaboracion2" value="{{$tipoColaboracion}}" /> 
<input type="text" hidden="hidden" id="entregaID2" value="{{$entregaID}}" /> 
<input type="text" hidden="hidden" id="id_form2" value="{{$formulario->id_formulario}}" /> 
<input type='hidden' name='_token' id="_tokenF2" value='<?php echo csrf_token(); ?>'>
                                
    <div class="row">
    	@php
			echo file_get_contents($formulario->url);
		@endphp

		<script type="text/javascript">
			cargarNuevosValoresColaboracion();
		</script>
    </div>










@endsection

