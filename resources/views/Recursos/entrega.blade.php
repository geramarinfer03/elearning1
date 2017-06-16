 {!! Form::open(['url'=>'entrega.tarea','method' => 'POST','class'=>'form-horizontal', 'files'=>true]) !!}
                     <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 

                    <div class="row" style="margin: 5px;">
                        <br><br>
             
                        
                        
                    </div>

                    <div class="row" style="margin: 5px;" >
                        <div class="col-md-12">
                            <h3 style="text-align: center;">Usted realizara la entrega a la tarea</h3>
                            <h3 style="font-weight: bold; text-align: center;">{{$tarea->nombre}}</h3>
                            
                        </div>
                    </div>
                     <hr>

                    <div class="row" style="margin: 5px;" >
                        <div class="col-md-12">
                        <br>
                            <label for="">Las instrucciones de la tarea eran las siguientes: </label>
                        <p style="font-size: 18px; text-align: justify; width: 95%; margin-left: auto; margin-right: auto;">{{$tarea->notas}}</p>
                        <br><br><br>

                            

                            <div class="form-group has-feedback">
                               {!! Form::file('file', ['class'=>'fileupload', 'type'=>'file', 'id'=>'fileupload', 'required'=>'required']) !!}
                                 <p class="errors">{!!$errors->first('any')!!}</p>
                                 @if(Session::has('error'))
                                 <p class="errors">{!! Session::get('msg') !!}</p>
                                @endif
                            </div>



                        </div>
                    </div>        

                        {!! Form::hidden('curso', $curso) !!}
                         {!! Form::hidden('id_tarea', $tarea_id) !!}

                        <div class="row">
                        <div class="col-md-3">
                            {!! Form::submit('Subir', ['class'=>'btn btn-success btn-block btn-flat']) !!}
                        </div>
                        </div>

                     {!! Form::close() !!}

                </div>
