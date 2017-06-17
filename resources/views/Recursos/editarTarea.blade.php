<div class="contenido_principal">
    <div class="body">
        <h2 style="text-align: center">Editar Tarea</h2>


        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-box-body">
                        {!! Form::model($recurso,['url'=>'recursos.updateTarea', 'method'=>'POST', 'class'=>'form-horizontal']) !!}                    
                        {!! Form::hidden('id_recurso', $recurso->id_recurso) !!}
                        {!! Form::hidden('id_tarea', $tarea->id_tarea) !!}
                        {!! Form::hidden('recurso_padreF', $recurso->recurso_padre) !!} 
                        {!! Form::hidden('semanaF', $recurso->semana) !!}
                        {!! Form::hidden('cursoF', $tarea->id_curso) !!}
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
                                        {!! Form::hidden('visibl', '0') !!}
                                        {!! Form::label('visibl', 'Visibilidad') !!}
                                        {{ Form::checkbox('visibl', 1, null, ['class' => 'field']) }} 
                                        {!! $errors->has('visibl')?$errors->first('visibl'):'' !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="row" style="margin: 5px;">
                                <div class="col-md-3">
                                    <div class="form-group" style="margin-left: 25px;">
                                        {!! Form::hidden('estado', '0') !!}
                                        {!! Form::label('estado', 'Habilitado') !!}
                                        {{ Form::checkbox('estado', 1, null, ['class' => 'field']) }} 
                                        {!! $errors->has('estado')?$errors->first('estado'):'' !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin: 5px;">
                            <div class="col-md-12">
                                <div class="form-group has-feedback">
                                    {!! Form::label('nombre', 'Nombre') !!} 
                                    {!! Form::text('nombre', null, ['class'=>'form-control']) !!}
                                    <span class="fa fa-book form-control-feedback"></span> {!! $errors->has('nombreTarea')?$errors->first('nombreTarea'):'' !!}
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin: 5px;">
                            <div class="col-md-12">
                                <div class="form-group has-feedback" >
                                    {!! Form::label('notas', 'Notas') !!} 
                                    {!! Form::textarea('notas', null, ['class'=>'form-control']) !!} 
                                    <span class="fa fa-book form-control-feedback"></span> {!! $errors->has('notasTarea')?$errors->first('notasTarea'):'' !!}
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin: 5px;">
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    {!! Form::label('fecha_limite', 'Fecha Limite') !!}
                                    {!! Form::date('fecha_limite', $fech_limit,  ['class'=>'form-control', 'required'=>'required', 'min'=> $fech_limit]) !!}
                                    <span class="fa fa-clock-o form-control-feedback"></span>
                                    {!! $errors->has('fecha_limite')?$errors->first('fecha_limite'):'' !!}
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    {!! Form::label('fecha_limite_eval', 'Fecha Limite para Evaluar') !!}
                                    {!! Form::date('fecha_limite_eval', $fech_limit_eval,  ['class'=>'form-control', 'required'=>'required', 'min'=> $fech_limit_eval]) !!}
                                    <span class="fa fa-clock-o form-control-feedback"></span>
                                    {!! $errors->has('fecha_limite_eval')?$errors->first('fecha_limite_eval'):'' !!}
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin: 5px;">
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    {!! Form::label('porcentaje', 'Valor porcentual') !!}
                                    {!! Form::number('porcentaje', $tarea->porcentaje, ['min'=> 0,'max'=> 100]) !!}
                                    <span class="fa fa-percent form-control-feedback"></span>
                                    {!! $errors->has('porcentaje')?$errors->first('porcentaje'):'' !!}
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" style="margin: 5px;">
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    {!! Form::label('file', 'Archivo Instrucciones') !!}
                                    <br />
                                    {!! Form::label('file_anterior', 'Archivo Subido: ' . $url) !!}
                                    {!! Form::file('file', ['class'=>'fileupload', 'type'=>'file', 'id'=>'tareaupload']) !!}
                                    <p class="errors">{!!$errors->first('any')!!}</p>
                                        @if(Session::has('error'))
                                            <p class="errors">{!! Session::get('msg') !!}</p>
                                        @endif
                                </div>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-md-3">

                            <!--   <button id='btnCrearTarea' type='button' onclick='crearTarea()' class='btn btn-success btn-lg'>
                                                    <i class='fa fa-plus'></i> Crear Espacio Tarea
                            </button> -->
                            <!--<button id='btnCrearTarea' type='submit' class='btn btn-success btn-lg'>
                                            <i class='fa fa-plus'></i> Crear Espacio Tareas
                            </button> -->
                                {!! Form::submit('Guardar', ['class'=>'btn btn-primary btn-block btn-flat']) !!}    
                                <!--  {!! Form::submit('Crear Espacio Tarea', ['class'=>'btn btn-success btn-block btn-flat']) !!} -->
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
