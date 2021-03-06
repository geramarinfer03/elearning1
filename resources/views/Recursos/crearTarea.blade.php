<div class="col-md-12">
    <div class="login-box-body">
        <div class="row">
            <div class="modal-body">
                <div class="tabbable"> <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs">
                <li class="active" id="litabT1"><a id="atabT1" href="#tabT1" data-toggle="tab">Crear Espacio</a></li>
                <li id="litabT2"><a href="#tabT2" id="atabT2" data-toggle="tab">Crear Rubrica Evaluacion</a></li>

                </ul>
                <div class="tab-content">

                <div class="tab-pane active col-md-12" id="tabT1">
                      {!! Form::open(['url'=>'tareas.crearTarea', 'method' => 'post','class'=>'form-horizontal', 'id'=>'crearTareaForm', 'files'=>true]) !!}

                    <div class="row" style="margin: 5px;">
                        <br>
                       
                         <div class="col-md-4">
                            <div class="form-group">
                               {!! Form::label('rol', 'Rol') !!}
                               {{ Form::select('rol',$roles, null, ['class'=>'form-control select2'])}}
                            </div>
                        </div>

                        <div class="col-md-3">
                        <div class="row" style="margin: 5px;">
                            <div class="col-md-3">
                             <div class="form-group" style="margin-left: 25px;">
                                   {!! Form::label('visbl', 'Visibilidad') !!}
                                   {{ Form::checkbox('visbl', '1', true, ['style' => 'margin-left: 20px'])}}
                             </div>
                             </div>
                            
                        </div>

                        </div>

                        <div class="col-md-3">
                        <div class="row" style="margin: 5px;">
                            <div class="col-md-3">
                             <div class="form-group" style="margin-left: 25px;">
                                   {!! Form::label('estado', 'Habilitado') !!}
                                   {{ Form::checkbox('estado', '1', true)}}
                             </div>
                             </div>
                            
                        </div>

                        </div>
                        
                    </div>
                     <div class="row" style="margin: 5px;">
                        <div class="col-md-12">
                            <div class="form-group has-feedback">
                                {!! Form::label('nombreTarea', 'Nombre') !!} 
                                {!! Form::text('nombreTarea', null, ['class'=>'form-control','placeholder'=>'Nombre Tarea', 'required'=>'required']) !!}
                                <span class="fa fa-book form-control-feedback"></span> {!! $errors->has('nombreTarea')?$errors->first('nombreTarea'):'' !!}
                            </div>

                        </div>
                     </div>

                     <div class="row" style="margin: 5px;">
                        <div class="col-md-12">
                            <div class="form-group has-feedback" >
                                {!! Form::label('notasTarea', 'Notas') !!} 
                                {!! Form::textarea('notasTarea', null, ['class'=>'form-control','placeholder'=>'Instrucciones Generales', 'id'=>'notasTarea']) !!}
                                <span class="fa fa-book form-control-feedback"></span> {!! $errors->has('notasTarea')?$errors->first('notasTarea'):'' !!}
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin: 5px;">
                        <div class="col-md-4">

                            <div class="form-group has-feedback">
                                {!! Form::label('fecha_limite', 'Fecha Limite') !!}
                                {!! Form::date('fecha_limite', Carbon\Carbon::today()->toDateString(),  ['class'=>'form-control', 'required'=>'required', 'min'=> Carbon\Carbon::today()->toDateString()]) !!}
                                <span class="fa fa-clock-o form-control-feedback"></span>
                                {!! $errors->has('fecha_limite')?$errors->first('fecha_limite'):'' !!}
                            </div>
                        </div>
                         <div class="col-md-4">

                            <div class="form-group has-feedback">
                                {!! Form::label('fecha_limite_eval', 'Fecha Limite para Evaluar') !!}
                                {!! Form::date('fecha_limite_eval', Carbon\Carbon::today()->toDateString(),  ['class'=>'form-control', 'required'=>'required', 'min'=> Carbon\Carbon::today()->toDateString()]) !!}
                                <span class="fa fa-clock-o form-control-feedback"></span>
                                {!! $errors->has('fecha_limite_eval')?$errors->first('fecha_limite_eval'):'' !!}
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin: 5px;">
                        <div class="col-md-4">

                            <div class="form-group has-feedback">
                                {!! Form::label('porcentaje', 'Valor porcentual') !!}
                                {!! Form::number('porcentaje', $evaluado, ['min'=> 0,'max'=> $evaluado]) !!}
                                <span class="fa fa-percent form-control-feedback"></span>
                                {!! $errors->has('porcentaje')?$errors->first('porcentaje'):'' !!}
                            </div>
                        </div>
                    </div>

                     <div class="row" style="margin: 5px;">
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                              {!! Form::label('file', 'Archivo Instrucciones') !!}
                                {!! Form::file('file', ['class'=>'fileupload', 'type'=>'file', 'id'=>'tareaupload']) !!}
                                <p class="errors">{!!$errors->first('any')!!}</p>
                                    @if(Session::has('error'))
                                        <p class="errors">{!! Session::get('msg') !!}</p>
                                    @endif
                            </div>
                        </div>
                     </div> 


                        {!! Form::hidden('recurso_padreF', $padre) !!} 
                        {!! Form::hidden('semanaF', $semana) !!}
                       {!! Form::hidden('cursoF', $curso) !!}

                        <div class="row">
                        <div class="col-md-3">

                        <!--   <button id='btnCrearTarea' type='button' onclick='crearTarea()' class='btn btn-success btn-lg'>
                                              <i class='fa fa-plus'></i> Crear Espacio Tarea
                        </button> -->
 -
                                <button id='btnCrearTarea' type='submit' class='btn btn-success btn-lg'>
                                              <i class='fa fa-plus'></i> Crear Espacio Tareas
                                </button>
                          <!--  {!! Form::submit('Crear Espacio Tarea', ['class'=>'btn btn-success btn-block btn-flat']) !!} -->
                        </div>
                        </div>

                     {!! Form::close() !!}
 
                            

                </div>
                <div class="tab-pane" id="tabT2">
             
                  
                
                     <div id="codigoVerificar" class="row" style="margin: 5px;">
                     <div class="col-md-6" style="margin-bottom: 25px; margin-top: 25px;">

                        <label for="tareaAsig">Código de tarea</label>
                        
                        <input type="text" hidden="hidden" id="cursoIDForm" value="{{$curso}}" /> 

                         <input onkeyup="buscarTareaForm()"  min='0' type='text' class='' name='tareaAsig' id='tareaAsig' />
                         <button id="confirmarTarea" onclick="iraForm()" type="button" class="btn btn-info btn-flat noMostar" >Confirmar</button>
                          
                    </div>
                    </div>
           
                     
              
       

    



                </div>


                

                </div>
                </div>
            </div>
       </div>
     
   </div>
   </div>
