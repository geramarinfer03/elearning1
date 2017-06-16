@extends('layouts.principal') 

@section('contenido')
<div class="box box-primary">

<section class="content">
<div class="box-body">

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
 </div>

</section>





</div>

@endsection

