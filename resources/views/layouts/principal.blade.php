<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Elearning | UNA - Proyecto 1</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

   <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/principalLTE.css')}}">
    <link rel="stylesheet" href="{{asset('css/user_style.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

  </head>
  <!--@php
    $usuario = Auth::user();
  @endphp -->
  <body class="hold-transition skin-blue sidebar-mini">


    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
         <!-- <span class="logo-mini"><b>AD</b>V</span> -->
          <span class="logo-mini"><img src="{{asset('img/logo_mini.png')}}"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="{{asset('img/logo_mini.png')}}"><b>         E-learning</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->

<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container1">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          @if ($usuario != null && $usuario->rol->id_rol < 5)
           <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          @endif
          <a class="navbar-brand" href="#">E learning</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/">Home</a></li>
            <!--<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li> -->
         
            <li><a href="{{route('cursos.index')}}">Cursos</a></li>
            <li><a href="/cursos">Cursos</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            
          </ul>


          <div class="navbar-custom-menu">

          

  
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
@unless (!Auth::check())
             
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                  <!-- El nombre de usuario se pasa por parametro-->

                  <span class="hidden-xs">
                  {{$usuario->email or 'Default'}}
                  </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    
                    <p>
                     {{$usuario->rol->nombre or 'Default'}}
                      <!--<small>mensaje pequeño</small> -->
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Desconectar</a>
                    </div>
                  </li>
                </ul>
              </li>
 @endunless   <!-- este bloque hace lo de la caja de usurio -- >

             <!-- BLOQUE LOGIN Y REGISTRO -->   
                @unless (Auth::check())
                  <li>
                  <a href="login">Login</a>
                  </li>

                  <li>
                  <a href="registrarse">Registrarse</a>
                  </li>
                @endunless
                


            </ul>
          </div>


  

        </div><!--/.nav-collapse -->
      </div>
    </nav>


      




      </header>

      <!-- Left side column. contains the logo and sidebar -->
     <section>
     @if ($usuario != null && $usuario->rol->id_rol == 1)
        @include('menus.menuAdmin');
      @endif
    </section>




       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->

      <!--<div @if (1 === 2) class="content-wrapper" @else class="contenido2" @endif> -->
      <div @if (Auth::check() != null && $usuario->rol->id_rol < 5) class="content-wrapper" @else class="contenido2" @endif>
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <!-- <div class="box-header with-border"> 
                  <h3 class="box-title">Titulo 1</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div> -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
		                          <!--Contenido-->
                              @yield('contenido')
		                          <!--Fin Contenido-->
                           </div>
                        </div>
		                    
                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
         

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->

      <footer class= @if (1 === 1) "main-footer" 
                    @else
                                   "main-footer" 

      @endif>
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Universidad Nacional de Costa Rica -  2017</strong> 
        <p style="margin: 0 auto;">José Marin - Josue Valerio</p>
      </footer>

      
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>

     <script src="{{asset('js/scripts.js')}}"></script>
    
  </body>
</html>
