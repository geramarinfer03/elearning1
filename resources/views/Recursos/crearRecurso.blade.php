<div class="contenido_principal">
    <div class="body">
        <h2 style="text-align: center">Crear Recurso</h2>


        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-box-body">
                        {!! Form::open(['route'=>'recursos.store','method' => 'post','class'=>'form-horizontal']) !!}

                        <div class="form-group has-feedback">
                            {!! Form::label('nombre', 'Nombre') !!} {!! Form::text('nombre', null, ['class'=>'form-control','placeholder'=>'Nombre']) !!}
                            <span class="fa fa-book form-control-feedback"></span> {!! $errors->has('nombre')?$errors->first('nombre'):'' !!}
                        </div>

                        <div class="form-group has-feedback">
                            {!! Form::label('notas', 'Notas') !!} {!! Form::textarea('notas', null, ['class'=>'form-control','placeholder'=>'Notas']) !!}
                            <span class="fa fa-book form-control-feedback"></span> {!! $errors->has('notas')?$errors->first('notas'):'' !!}
                        </div>

                        <div class="form-group has-feedback">
                            {!! Form::label('url', 'Url') !!} {!! Form::text('url', null, ['class'=>'form-control','placeholder'=>'wwww.example@.com']) !!}
                            <span class="fa fa-book form-control-feedback"></span> {!! $errors->has('url')?$errors->first('url'):'' !!}
                        </div>

                        <div class="form-group">
                            <p class="tituloP">Tipo de Recurso</p>
                            <div class="radio">
                                <label>
                                    {{ Form::radio('tipo', 1, true, ['class' => 'field']) }} Pagina
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    {{ Form::radio('tipo', 2, true, ['class' => 'field']) }} Sección
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    {{ Form::radio('tipo', 3, true, ['class' => 'field']) }} Etiqueta
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    {{ Form::radio('tipo', 4, true, ['class' => 'field']) }} Texto
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    {{ Form::radio('tipo', 5, true, ['class' => 'field']) }} Enlace
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    {{ Form::radio('tipo', 6, true, ['class' => 'field']) }} Archivo
                                </label>
                            </div>

                        </div>


                        {!! Form::hidden('estado', '1') !!} {!! Form::hidden('visibl', '1') !!}
                        {!! Form::hidden('recurso_padre', $padre) !!} 
                        {!! Form::hidden('semana', $semana) !!} 
                        

                        



                        <div class="row">
                            <div class="col-xs-6">
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
