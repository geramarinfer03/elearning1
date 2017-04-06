  <div class="contenido_principal">
      <div class="login-logo">
        <a href="/form_editar_usuario/{{$usuario->id}}" style="text-decoration: underline; color:#00008d"><b>{{$usuario->nombre}}</b></a>
      </div><!-- /.login-logo -->
      <div class="body">
        <h2 style="text-align: center">Matricular Curso</h2>
        
       <!-- <form action="login" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">   -->
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6">
                <div class="box box-primary">
                      <div class="box-header">
                        <div class="row">
                          <div class="col-md-12">
                            <h4>Cursos no matriculados</h4>
                          </div>
                        </div>
                      </div>
                      
                      <table id="tabla_cursos_no_mat" class="display table table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                             <th style="width:50px">Id</th>
                             <th>Nombre</th>
                             <th>Duracion</th>
                             <th>Inicio</th>
                             <th>Termina</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($cursosNoMat as $cur)
                           <!-- <a href="javascript:void(0);" onclick="seleccionCursoMat(<?= $cur->id_curso; ?>);"  style="display:block"> 
                           -->
                            <tr role="row" onclick="seleccionCursoMat(<?= $cur->id_curso; ?>)">
                            <td class="sorting_1">{{$cur->id_curso}}</td>
                            <td>
                            {{$cur->nombre}}
                             <!-- <a href="javascript:void(0);" onclick="seleccionCursoMat(<?= $cur->id_curso; ?>);"  style="display:block"><i class="fa fa-book"></i>&nbsp;&nbsp;{{$cur->nombre}}
                              </a> -->
                            </td>
                            <td>
                              {{$cur->duracion}}                              
                            </td>
                            <td>{{$cur->fecha_inicio}}</td>
                            <td>{{$cur->fecha_final}}</td>

                          
                            </tr>
 <!--</a> -->
                          @endforeach
                      </table>
                        @php
                         echo str_replace('/?', '?', $cursosNoMat->render() )  ;
                        @endphp
          
                </div> 
              </div> <!-- LISTA CURSOS CON BUSCAR (CURSOS EXISTENTES Y QUE NO TENGA EL USUARIO) -->
              

              <div class="col-md-6">
              <form action="/crearMatricula" method="post">
               <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
               <input type="hidden" name="id_usuario" value="{{$usuario->id}}">   
                  <div class="box box-primary">
                      <div class="box-header">
                          <div class="row">
                            <div class="col-md-12">
                            <h4>Matricular</h4>
                          </div>
                        </div>
                      </div>
                     
                    <div class="box"> 
                      <div class="row">
                      <div class="col-md-12">
                         <div class="col-md-12">
                          <label> Usuario: </label>
                          </div> 
                          <div class="col-md-12">
                           <input type="text" class="form-control" id="nombreUsuario" placeholder="{{$usuario->nombre}}" disabled="disabled">
                          </div>  
                        

                          
                       
                          <div class="col-md-12">
                            <label for="roles"> Rol </label> 
                          </div>
                          <div class="col-md-12">
                            <select id="roles" name="roles" class="form-control">
                            @foreach($roles as $r)
                              <option value="{{$r->id_rol}}">{{$r->nombre}}</option> 
                            @endforeach 
                            </select>
                          </div>


                          <div class="col-md-12">
                            <label for="curso_mat"> Curso: </label> 
                          </div>
                          <div class="col-md-12">
                            <input type="text" class="form-control" id="curso_mat" name="curso_mat" placeholder="Seleccione el curso">
                          </div>
                      </div>   
                      </div>
                 </div>
                 

                 <div class="col-md-4">
                          <button  style="margin-top: 20px;" type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>

                </form> 

              </div> <!-- FRORM MATRICULA -->
            </div>

          </div>




      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->