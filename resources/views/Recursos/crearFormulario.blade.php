@extends('layouts.principal') 

@section('contenido')
<section class="content">

<div class="box box-primary">
                <div class="box-body box-profile">
                <a href="/cursos.show/{{$curso}}" class="btn btn-primary btn-flat"><i class="fa fa-arrow-left"></i>  Regresar</a>

                 <h2 style="text-align: center">Crear Formulario de Evaluación para tarea código: {{$tareaId}}</h2>

                 <h3 style="text-align: center">{{$nombreTarea}}</h3>


<div id="capa_modal_formulario" class="noMostar" style="margin-top: auto; margin-bottom: auto;"><br><h1 style="font-size: 60px; text-align: center;">Vista Previa</h1></div>
                <div class="" id="FormularioDiv">
 
                  
                  <div id='formularioEvaluacion' class="">
                          <div class='col-md-12'>
                            <div class='login-box-body'>
                                <div class='row'>

                             <form  id='formColaboracion'  method='post'  action='MetodoColaboracionStore'>                
                                <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>

                                <div class='row' style='margin: 5px;'>
                                   <div class='col-md-12'>
                                      <div class='form-group has-feedback'>
                                        <h2 class='noMostar' style='text-align: center;'>Formulario de Evaluación</h2>
                                        <label id='labelIndicaciones' for=''>Indicaciones</label>
                                        <textarea name='indicacionesF' id='indicacionesF' rows='8' style='width: 100%;' placeholder='Escriba las indicaciones generales en este apartado'></textarea>
                                        <p id='indicacionesText'></p>
                                      </div>
                                    </div>
                                </div>



                                <div class='row' style='margin: 5px;'>
                                    <div class='col-md-5'>
                                      <div class='form-group has-feedback'>
                                        <table id='tabla_criterios' class='table table-striped' cellspacing='0' width='100%'>
           
                                         <thead>
                                            <tr>
                                            <th style='width:10px;'>Puntaje</th>
                                            <th>Criterio</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                         <tr id='criterio1'>
                                            
                                            <td class='puntajeColumn columinput' style='width: 10px;'>
                                                 <input  min='0' type='number' class='inputPuntaje' name='puntaje1' id='puntaje1' />

                                            </td>
                                            <td class='criterioColumn columinput'>
                                                <textarea name='indicacionesF1'  id='indicacionesF1' rows='4' style='width: 100%;' placeholder='Escriba las indicaciones generales en este apartado'></textarea>
                                                
                                            </td>
                                        </tr>
                                        
                                        </tbody>
                                        </table>

                                        <div class='row' style='margin: 5px;'>
                                        <div class='col-md-2' style='float: right;'>
                                         <button id='formularioE' type='button' onclick='filaCriterio()' class='btn btn-info botonForm' style='float: right;'>
                                              <i class='fa fa-plus'></i> Fila
                                         </button>
                                        </div>
                                        <div class='col-md-2' style='float: right;'>
                                         <button id='EliminarformularioE' type='button' onclick='borrarUltimaFila()' class='btn btn-danger botonForm' style='float: right;'>
                                              <i class='fa fa-minus'></i> Fila
                                         </button>
                                        </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class='col-md-7'>
                                      <div class='form-group has-feedback'>
                                        <table id='tabla_actividades' class='table table-striped' cellspacing='0' width='100%'>
           
                                         <thead>
                                            <tr>
                                            <th>Actividades</th>
                                            <th style='width:10px;'>Puntos</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                         <tr id='actividad1'>

                                            <td class='criterioColumn columinput'>
                                                <textarea name='actividadesDesc1'  id='actividadesDesc1' rows='4' style='width: 100%;' placeholder='Describa la actividad  que se evaluara'></textarea>
                                                
                                            </td>
                                            
                                            <td class='puntajeColumn columinput' style='width: 10px;'>
                                                 <input disabled='disabled' min='0' type='number' class='inputPuntos' name='puntos1' id='puntos1' />

                                            </td>
                                            
                                        </tr>
                                        </tbody>
                                        </table>
                                        <div class='row' style='margin: 5px;'>
                                        <div class='col-md-2' style='float: right;'>
                                         <button id='formularioActividadesE' type='button' onclick='filaActividad()' class='btn btn-info botonForm' style='float: right;'>
                                              <i class='fa fa-plus'></i> Fila
                                         </button>
                                        </div>
                                        <div class='col-md-2' style='float: right;'>
                                         <button id='EliminarformularioActiv' type='button' onclick='borrarUltimaFilaActividad()' class='btn btn-danger botonForm' style='float: right;'>
                                              <i class='fa fa-minus'></i> Fila
                                         </button>
                                        </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class='row' style='margin: 5px;'>
                                   <div class='col-md-12'>
                                      <div class='form-group has-feedback'>
                                        <label for='comentarios' class='noMostar'>Comentarios</label>
                                        <textarea name='comentarios' id='Comentarios' class='noMostar' rows='8' style='width: 100%;' placeholder='Comentarios sobre esta entrega'></textarea>
                                      </div>
                                    </div>
                                </div>




                                </div>

                                <div class='row' style='margin: 5px;'>
                                   <div class='col-md-12'>
                                     <button id='summitForm' type='summit' class='btn btn-success btn-lg noMostar'>
                                              <i class='fa fa-commenting'></i>Enviar Evaluación
                                     </button>

                                   </div>
                                </div>


                            </form>
                            </div>
                            </div>
                            </div>

                            
                  </div>
                     {!! Form::open(['url'=>'tareas.formulario','method' => 'post', 'id'=>'formCrearForm']) !!}

                    

                       <textarea name="cuerpoForm" id="cuerpoForm" style="display: none;" rows="8" style="width: 100%;"></textarea>

                     <input type="text" hidden="hidden" id="cursoIDForm" value="{{$curso}}" /> 
                     <input type="text" hidden="hidden" id="tareaAsig" value="{{$tareaId}}" /> 
              
                     <div class="row" style="margin: 5px;">
                     <div class="col-md-12">
                       <!--{!! Form::submit('Subir', ['class'=>'btn btn-success btn-block btn-flat']) !!}-->
                        <button id="formularioGenerar" onclick="generarFormulario()" type="button" class="btn btn-success btn-lg">Generar Formulario</button>
                    </div>
                    </div>

    

                     {!! Form::close() !!} 



                </div>
                </div>
                </div>

</section>


@endsection