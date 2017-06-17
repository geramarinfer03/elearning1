@extends('layouts.principal') @section('contenido')


<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Elearning - </b>Generación de Diplomas </a>
    </div>
    <div class="login-box-body">
       <div class="form-group has-feedback">
            <span style="font-size:25px"><i>El proceso automatizado se ejecuta a las: <b>{{$horario}}</b> </i></span>
       </div>

    

     <div class="row">
        <div class="col-md-12">
            <div class="row">
                
                    <form action="/createEvent" method="post" class="form-horizontal">
                    <div class="col-md-12">
                        <input type="hidden" name="_token" class="form-control" value="<?php echo csrf_token(); ?>"> 
                        {{--@unless(!Auth::check())
                        <input type="hidden" name="id_usuario" class="form-control" value="{{Auth::user()->id}}">
                        <input type="hidden" name="nombre_usuario" class="form-control" value="{{Auth::user()->nombre}}">  
                        @endunless--}}

                        <div class="form-group">
                            <label for="fecha">Empezando:</label>
                            <input name="fecha" class="form-control" style="width: 100%"> 
                        </div>
                        
                        <div class="form-group">
                            <label for="hora">A las:</label>
                            <select name="hora" class="form-control" style="width: 100%">
                                <option>01:00</option>
                                <option>02:00</option>
                                <option>03:00</option>
                                <option>04:00</option>
                                <option>05:00</option>
                                <option>06:00</option>
                                <option>07:00</option>
                                <option>08:00</option>
                                <option>09:00</option>
                                <option>10:00</option>
                                <option>12:00</option>
                                <option>11:00</option>
                                <option>13:00</option>
                                <option>14:00</option>
                                <option>15:00</option>
                                <option>16:00</option>
                                <option>17:00</option>
                                <option>18:00</option>
                                <option>19:00</option>
                                <option>20:00</option>
                                <option>21:00</option>
                                <option>22:00</option>
                                <option>23:00</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="frecuencia">Afrecuencia:</label>
                            <select name="frecuencia" class="form-control">
                                <option>DAY</option>
                                <option>WEEK</option>
                                <option>MONTH</option>
                                <option>YEAR</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="frecuencia">Intervalo:</label>
                            <select name="intervalValue" class="form-control"   >
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                            </select> 
                        </div> 

                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-info" style="width: 100%; font-weight: bold;">Editar</button>
                        </div> 
                    </div> 
                </form>                  

            </div>           
            
        </div>
        <div class="row">
            <div class="col-md-12">
            {!! Form::open(['url'=>'executeSP','method' => 'post','class'=>'form-horizontal']) !!}
                {!! Form::submit('Ejecutar ahora',  ['class'=>'btn btn-primary btn-block btn-flat']) !!}
            {!! Form::close() !!}                

            </div>

        </div>
    </div>


    </div>
</div>
<script type="text/javascript">
    
    $(function(){
        $('input[name="fecha"').datepicker({ dateFormat: 'yy-mm-dd' });

    });
</script>
    

          


@endsection
