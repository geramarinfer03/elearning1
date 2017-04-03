@extends('layouts.principal')
 @section('contenido')
	
  @php
  	 $countries = app('countrylist')->all('es_CR');
  @endphp
<div class="box box-primary">

<div class="box-header">
 <!--<h4 class="box-title">Buscar Usuarios</h4>
        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="dato_buscado">
                            <span class="input-group-btn">
                              <button class="btn btn-info btn-flat" type="button" onclick="buscarusuario();" >Buscar!</button>
                            </span>
        </div>
        <div>
        <select  id="select_filtro_pais"  onchange="buscarusuario();" >

        
        	<option value="General">General </option>
           @foreach ($countries as $pais)
              <option value="{{$pais}}">{{ $pais }}</option>
           @endforeach
        </select>
               
        </div>

       --> 

                 
</div>

<div class="box-body">              
 

@if( count($usuarios) >0)


<table id="tabla_usuarios" class="display table table-hover" cellspacing="0" width="100%">
       
        <thead>
            <tr>
             <th style="width:10px">Id</th>
                <th>Nombre</th>
                <th>E-mail</th>
                <th>Rol</th>
                <th>Genero</th>
                <th>País</th>
                <th>Ultimo Ingreso</th>
                <th>IP</th>
                <th>S.O</th>
                <th>Browser</th>
                <th>Lenguaje</th>
              <th>Acción</th>
            </tr>
        </thead>
 
        
       
<tbody>


 

   @foreach($usuarios as $usuario)


		 <tr role="row" class="odd">
		    <td class="sorting_1">{{$usuario->id}}</td>
		    <td class="mailbox-messages mailbox-name">
		    	<a href="javascript:void(0);" onclick="mostrarficha(<?= $usuario->id; ?>);"  style="display:block">
		    	<i class="fa fa-user"></i>
		    	&nbsp;&nbsp;{{$usuario->nombre}}
		    	</a>
		    </td>
		    <td> {{$usuario->email}}</td>
		    <td> {{$usuario->rol->nombre}}</td>
		    <td> {{$usuario->genero}}</td>
		    <td>
		    	<span class="label label-primary ">{{$usuario->pais}}</span>
		    </td>
	    
		    <td>{{$usuario->fecha_ultimo_ingreso}}</td>
		    <td> {{$usuario->ip}}</td>
		    <td> {{$usuario->os}}</td>
		    <td> {{$usuario->navegador}}</td>
		    <td> {{$usuario->lenguaje}}</td>
		    <td><button class="btn  btn-success btn-xs" onclick="mostrarficha();" ><i class="fa fa-fw fa-eye"></i>Ver</button></td>
		</tr>

	@endforeach


  
</table>
@php
echo str_replace('/?', '?', $usuarios->render() )  ;
@endphp

@endif
</div>
@include('modal_usuario')
</div>


 @endsection