<div class="contenido_principal">
    <div class="body">
        <h2 style="text-align: center">Editar Recurso</h2>


        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-box-body">
                        {!! Form::model($recurso,['url'=>'recursos.updateArchivo', 'method'=>'POST', 'class'=>'form-horizontal','files'=>true]) !!}
                        
                        {!! Form::hidden('id_recurso', $recurso->id_recurso) !!}
                        <div class="form-group has-feedback">
                            {!! Form::label('nombre', 'Nombre') !!} {!! Form::text('nombre', null, ['class'=>'form-control','required'=>'required']) !!}
                            <span class="fa fa-book form-control-feedback"></span> {!! $errors->has('nombre')?$errors->first('nombre'):'' !!}
                        </div>

                        <div class="form-group has-feedback">
                            {!! Form::label('notas', 'Notas') !!} {!! Form::text('notas', null, ['class'=>'form-control']) !!}
                            <span class="fa fa-book form-control-feedback"></span> {!! $errors->has('notas')?$errors->first('url'):'' !!}
                        </div>

                        

                         <div class="row">
                            <div class="col-xs-6">
                                     {!! Form::file('file', ['class'=>'fileupload', 'type'=>'file', 'id'=>'fileupload']) !!}
                                    <p class="errors">{!!$errors->first('any')!!}</p>
                                    @if(Session::has('error'))
                                    <p class="errors">{!! Session::get('msg') !!}</p>
                                    @endif
                                    </span>

                            
                            </div>  
                            </div>
              


                        <div class="form-group has-feedback">
                            {!! Form::hidden('visibl', '0') !!}
                            {!! Form::label('visibl', 'Visible') !!} 
                            {{ Form::checkbox('visibl', 1, null, ['class' => 'field']) }} 
                            {!! $errors->has('visibl')?$errors->first('visibl'):'' !!}
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::hidden('estado', '0') !!}
                            {!! Form::label('estado', 'Estado') !!} 
                            {{ Form::checkbox('estado', 1, null, ['class' => 'field']) }} 
                            {!! $errors->has('estado')?$errors->first('estado'):'' !!}
                        </div>
                        
                        <div class="form-group">
                           {!! Form::label('rol', 'Rol') !!}
                           {{ Form::select('rol',$roles, null, ['class'=>'form-control select2'])}}
                        </div>






                        <div class="row">
                            <div class="col-xs-4">
                                {!! Form::submit('Guardar', ['class'=>'btn btn-primary btn-block btn-flat']) !!}
                            </div>
                            <!-- /.col -->
                        </div>
                        {!! Form::close() !!}


                    </div>
                </div>
                <!-- LISTA CURSOS CON BUSCAR (CURSOS EXISTENTES Y QUE NO TENGA EL USUARIO) -->



            </div>

        </div>




    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
