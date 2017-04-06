  <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Elearning</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <h2 style="text-align: center">Ingrese al sistema</h2>
        
        <form action="login" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">   

          <div class="form-group has-feedback">
                
                <input type="email" class="form-control" name="email" placeholder="Usuario" >
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Contraseña">
            <span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
          </div>
         
          <div class="row">
            

            
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
            </div><!-- /.col -->
          </div>
        </form>


      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->