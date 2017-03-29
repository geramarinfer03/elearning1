@extends('layouts.principal')

@section('contenido')

  <?php
      function getRealIP() {
          if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
                   
              if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
               
            return $_SERVER['REMOTE_ADDR'];
          }
      function detect(){
          $browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
          $os=array("WIN","MAC","LINUX");
               
          # definimos unos valores por defecto para el navegador y el sistema operativo
          $info['browser'] = "OTHER";
           $info['os'] = "OTHER";
               
          # buscamos el navegador con su sistema operativo
          foreach($browser as $parent){
            $s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
            $f = $s + strlen($parent);
            $version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
            $version = preg_replace('/[^0-9,.]/','',$version);
            if ($s){
              $info['browser'] = $parent;
              $info['version'] = $version;
            }
          }
               
          # obtenemos el sistema operativo
          foreach($os as $val){
            if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
            $info['os'] = $val;
            }
                 
            # devolvemos el array de valores
            return $info;
      }
      function getUserLanguage() {  
           $idioma =substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2); 
           return $idioma;  
      } 

             ?>
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Elearning</b> Registro</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
       
        <form action="registrarse" method="post">
      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">   
          
          <div class="form-group has-feedback">
            <label>Nombre</label>
            <input type="text" class="form-control" name="nombre" required="required" >
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>


           <div class="form-group has-feedback">
             <label>Email</label>
            <input type="email" class="form-control" name="email" required="required" >
            <span class="text glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
                <label>Contraseña</label>
            <input type="password" class="form-control" name="password" required="required" >
            <span class="fa fa-lock form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
                <label>Genero</label>
                <select class="form-control" name="genero">
                  <option value="Masculino">Masculino</option>
                  <option value="Femenino">Femenino</option>
                </select>
            <span class="fa fa-male form-control-feedback"></span>
          </div>
          
          <?php $countries = app('countrylist')->all('es_CR');
                $info=detect(); 
                $lenguaje = getUserLanguage();
           ?>


          <div class="form-group has-feedback">
                <label>Pais</label>
                <select class="form-control" name="pais">
                @foreach ($countries as $pais)
                    <option value="{{$pais}}">{{ $pais }}</option>
                @endforeach

                </select>
            <span class="fa fa-flag form-control-feedback"></span>
          </div>
 
      


           <input type="hidden" name="ip" value="<?php echo getRealIP(); ?>">
           <input type="hidden" name="os" value="<?php echo $info["os"]; ?>">
           <input type="hidden" name="navegador" value="<?php echo $info["browser"]; ?>">
           <input type="hidden" name="lenguaje" value="<?php echo $lenguaje; ?>">
           <br>

          <div class="row">
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
            </div><!-- /.col -->
          </div>

        </form>

     
       

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    <script>
      
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>

@endsection
