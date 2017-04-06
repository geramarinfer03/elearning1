@extends('layouts.principal')
 @section('contenido')

<section class="content">
<div class="row">  

  <div class="col-md-6">

        <div class="box box-primary">
                        
                        <div class="box-header">
                          <h3 class="box-title">Editar información del Usuario</h3>
                        </div><!-- /.box-header -->
       <!-- <div id="notificacion_resul_feu"></div>
      -->
          <div class="box-body ">
            <div class="col-xs-12">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label class="label1">Nombre: </label>
                  </div>
                  <div class="form-group col-md-9">
                   <label><?=$usuario->nombre?></label>
                  </div>
                </div>
            </div>
             <div class="col-xs-12">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label class="label1">Email: </label>
                  </div>
                  <div class="form-group col-md-9">
                   <label><?=$usuario->email?></label>
                  </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label class="label1">Género: </label>
                  </div>
                  <div class="form-group col-md-9">
                   <label><?=$usuario->genero?></label>
                  </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label class="label1">Ingreso: </label>
                  </div>
                  <div class="form-group col-md-9">
                   <label><?=$usuario->fecha_ultimo_ingreso?></label>
                  </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label class="label1">IP: </label>
                  </div>
                  <div class="form-group col-md-9">
                   <label><?=$usuario->ip?></label>
                  </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label class="label1">SO: </label>
                  </div>
                  <div class="form-group col-md-9">
                   <label><?=$usuario->os?></label>
                  </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label class="label1">Lenguaje: </label>
                  </div>
                  <div class="form-group col-md-9">
                   <label><?=$usuario->lenguaje?></label>
                  </div>
                </div>
            </div>
            
            <form  id="f_editar_usuario"  method="post"  action="/editar_usuario">                
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
              <input type="hidden" name="id_usuario" value="{{$usuario->id}}">   

            <div class="form-group col-xs-12">
             <div class="row">
                  <div class="form-group col-md-3">
                      <label class="label1" for="pais">Pais</label>
                  </div>               
                  <div class="form-group col-md-9">   
                    @php
                    $countries = app('countrylist')->all('es_CR');
                    @endphp         
                    <select id="pais" name="pais" class="form-control">
                      
                      @foreach($countries as $pais){
                       <option value="{{$pais}}"
                          @if($pais == $usuario->pais)
                            selected
                          @endif
                       >{{$pais}}</option>;
                      @endforeach
                                 
                    </select>
                  </div>
            </div>
           </div> 

           <div class="col-xs-12">
             <div class="row">
                  <div class="col-md-3">
                      <label class="label1" for="rol_user">Rol</label>
                  </div>               
                  <div class="col-md-9">   
                 
                    <select id="rol_user" name="rol_user" class="form-control">
                      @foreach($roles as $r){
                       <option value="{{$r->id_rol}}"
                          @if($r->id_rol == $usuario->rol->id_rol)
                            selected
                          @endif
                       >{{$r->nombre}}</option>;
                      @endforeach
                                 
                    </select>
                    <hr>
                  </div>
            </div>
           </div>

            <div class="box-footer">
                 <button type="submit" class="btn btn-primary">Actualizar Datos</button>
            </div>
            </form>


         </div> <!-- cierra box-body -->

        </div> <!-- cierra box box-primary-->
  </div> <!-- Cierra col-md 6 info usuario -->

  <div class="col-md-6">

      <div class="box box-primary">
                      <div class="box-header">
                        <div class="row">
                        <div class="col-md-12">
                          <h3 class="box-title">Cursos Matriculados</h3><hr>
                        </div>
                        </div>
                        <div class="row">
                          <div class="col-md-8">
                           <div class="input-group input-group-sm">
                              <input type="text" class="form-control" id="dato_buscado">
                              <span class="input-group-btn">
                                <!--Al buscar se le envia el usuario por parametro -->
                                <button class="btn btn-info btn-flat" type="button" onclick="buscarcurso();" >Buscar!</button>
                              </span>
                          </div>
                          </div>
                          <div class="col-md-4">
                            <button type="button" class="btn btn-primary" onclick="mostrarMatricula(<?= $usuario->id; ?>)" style="margin-bottom: 10px;">Matricular Curso</button>
                            <br>
                          </div>
                        
                      </div><!-- /.box-header -->


              <table id="tabla_usuarios" class="display table table-hover" cellspacing="0" width="100%">
                     
                      <thead>
                          <tr>
                             <th style="width:10px">Id</th>
                             <th>Nombre</th>
                             <th>Rol</th>
                             <th>Aplicar</th>
                          </tr>
                      </thead>
                    <tbody>
                    @foreach($matriculados as $mat)
                     <form  id="editar_matri{{$mat->id_matricula}}"  method="post"  action="/editar_matricula">      
                     <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                     <input type="hidden" name="id_matricula" value="{{$mat->id_matricula}}">
                     <input type="hidden" name="id_usuario" value="{{$usuario->id}}">     
                      <tr role="row" class="odd">
                        <td class="sorting_1">{{$mat->id_matricula}}</td>
                        <td>
                          <a href="cursos.curso">
                          <i class="fa fa-book"></i>
                          &nbsp;&nbsp;{{$mat->cursos->nombre}}
                          </a>
                        </td>
                        <td>
                          <select id="rol_curso{{$mat->id_matricula}}" onchange="cambio_rol({{$mat->id_matricula}})" name="rol_curso" class="form-control">
                            @foreach($rols_user as $r){
                              <option  value="{{$r->id_rol}}" 
                                @if($r->id_rol == $mat->rol)
                                  selected
                                @endif
                                >{{$r->nombre}}</option>;
                            @endforeach
                          </select>
                        </td>
                        <td>
                           <button id="btnMatriculaUsuarios_{{$mat->id_matricula}}" type="submit" class="btn_inv"></button>
                        </td>
                      </tr>
                      </form>
                    @endforeach
              </table>

              @php
                echo str_replace('/?', '?', $matriculados->render() )  ;
              @endphp
      <hr>

      </div>

  </div>    <!-- end col mod 6 -->



</div> <!-- end row -->
</section>
</div>
@include('modal_usuario')
</div>



<script>
/* function cargarpais(){
  //$('#pais option:eq(<?= $usuario->pais; ?>)').prop('selected', true);  
  $('#pais').val('<?= $usuario->pais; ?>');
}
 function cargarRol(){
  $('#rol_user').val('<?= $usuario->rol->id_rol; ?>');
 }

cargarpais();
cargarRol();
*/
</script>

@endsection