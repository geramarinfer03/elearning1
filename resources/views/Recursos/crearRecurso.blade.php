
<div class="contenido_principal">
    <div class="body">
        <h2 style="text-align: center">Crear Recurso</h2>

    <div class="col-md-12">
    <div class="login-box-body">
        <div class="row">
            <div class="modal-body">
                <div class="tabbable"> <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs">
                <li class="active" id="litab1"><a id="atab1" href="#tab1" data-toggle="tab">Recursos</a></li>
                <li id="litab2"><a href="#tab2" id="atab2" data-toggle="tab">Subir Archivos</a></li>
                </ul>
                <div class="tab-content">

                <div class="tab-pane active col-md-12" id="tab1">
                {!! Form::open(['url'=>'recursos.store','method' => 'post','class'=>'form-horizontal', 'files'=>true]) !!}

                    <div class="row" style="margin: 5px;">
                        <br>
                        <div class="col-md-4">
                            <div class="form-group">
                               {!! Form::label('tipo', 'Tipo de Recurso') !!}
                               {{ Form::select('tipo',$tipo_recurso, null, ['placeholder' => 'Seleccione tipo Archivo', 'class'=>'form-control select2', 'required' => 'required', 'id' => 'tipoRecursoA', 'onchange'=> 'cambiarTipoRecurso()'])}}
                            </div>
                        </div>
                       
                        <div class="col-md-4">
                        </div>

                         <div class="col-md-4">
                            <div class="form-group">
                               {!! Form::label('rol', 'Rol') !!}
                               {{ Form::select('rol',$roles, null, ['class'=>'form-control select2'])}}
                            </div>
                        </div>
                        
                    </div>

                    <div class="row" style="margin: 5px;" >
                        <div class="col-md-12">

                            <div class="form-group has-feedback">
                                {!! Form::label('nombre', 'Nombre') !!} {!! Form::text('nombre', null, ['class'=>'form-control','placeholder'=>'Nombre']) !!}
                                <span class="fa fa-book form-control-feedback"></span> {!! $errors->has('nombre')?$errors->first('nombre'):'' !!}
                            </div>

                            <div class="form-group has-feedback  notasCR" style="display: none">
                                {!! Form::label('notas', 'Notas') !!} 
                                {!! Form::textarea('notas', null, ['class'=>'form-control','placeholder'=>'Notas', 'id'=>'notasCR']) !!}
                                <span class="fa fa-book form-control-feedback"></span> {!! $errors->has('notas')?$errors->first('notas'):'' !!}
                            </div>

                            <div class="form-group has-feedback urlCR" style="display: none">
                                {!! Form::label('url', 'Url') !!} 
                                {!! Form::text('url', null, ['class'=>'form-control','placeholder'=>'wwww.example@.com', 'id' => 'urlCR']) !!}
                                <span class="fa fa-book form-control-feedback"></span> {!! $errors->has('url')?$errors->first('url'):'' !!}
                            </div>



                            {!! Form::hidden('estado', '1') !!} 
                            {!! Form::hidden('visibl', '1') !!} 
                            {!! Form::hidden('recurso_padre', $padre) !!} 
                            {!! Form::hidden('semana', $semana) !!}
                            {!! Form::hidden('curso', $curso) !!}


                        </div>
                    </div>

                   

                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::submit('Guardar', ['class'=>'btn btn-primary btn-block btn-flat']) !!}
                        </div>
                    </div>

                        {!! Form::close() !!}



                </div>
                <div class="tab-pane" id="tab2">


                    {!! Form::open(['url'=>'archivos.upload','method' => 'POST','class'=>'form-horizontal', 'files'=>true]) !!}
                     <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 

                    <div class="row" style="margin: 5px;">
                        <br>
             
                        <div class="col-md-4">
                            <div class="form-group">
                               {!! Form::label('rolFile', 'Rol') !!}
                               {{ Form::select('rolFile',$roles, null, ['class'=>'form-control select2'])}}
                            </div>
                        </div>
                        
                    </div>

                    <div class="row" style="margin: 5px;" >
                        <div class="col-md-12">

                            <div class="form-group has-feedback">
                                {!! Form::label('nombreFile', 'Nombre') !!} 
                                {!! Form::text('nombreFile', null, ['class'=>'form-control','placeholder'=>'Nombre']) !!}
                                <span class="fa fa-book form-control-feedback"></span> {!! $errors->has('nombreFile')?$errors->first('nombreFile'):'' !!}
                            </div>

                             <div class="form-group has-feedback">
                                {!! Form::label('notasFile', 'Notas') !!} 
                                {!! Form::textarea('notasFile', null, ['class'=>'form-control','placeholder'=>'Notas']) !!}
                                <span class="fa fa-book form-control-feedback"></span> {!! $errors->has('notas')?$errors->first('notasFile'):'' !!}
                            </div>



                        </div>
                    </div>        



                  
                     <div class="row">
                        <div class="col-xs-6">



                         {!! Form::file('file', ['class'=>'fileupload', 'type'=>'file', 'id'=>'fileupload', 'required'=>'required']) !!}
                                 <p class="errors">{!!$errors->first('any')!!}</p>
                                 @if(Session::has('error'))
                                 <p class="errors">{!! Session::get('msg') !!}</p>
                                @endif
                                </span>

                           
                            </div>  
              
                         </div>
                


                        {!! Form::hidden('estadoF', '1') !!} 
                        {!! Form::hidden('visiblF', '1') !!} 
                        {!! Form::hidden('recurso_padreF', $padre) !!} 
                        {!! Form::hidden('semanaF', $semana) !!}
                        {!! Form::hidden('cursoF', $curso) !!}

                        <div class="row">
                        <div class="col-md-3">
                            {!! Form::submit('Subir', ['class'=>'btn btn-success btn-block btn-flat']) !!}
                        </div>
                        </div>

                     {!! Form::close() !!}

                </div>
                </div>
                </div>
            </div>
       </div>
     
   </div>
   </div>


   </div>
</div>

