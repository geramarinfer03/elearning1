<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
         <!--  <h4 style="color: white; text-align: center;" class="header">{{Auth::user()->rol->nombre}}</h4> -->
            
             @if($usuario->rol->id_rol == 1)
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="/usuarios"><i class="fa fa-circle-o"></i> Listar </a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> Sub 2</a></li>
              </ul>
            </li>
            @endif
                     
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Cursos</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="/cursos"><i class="fa fa-circle-o"></i>Listar</a></li>
                <li><a href="/misCursos"><i class="fa fa-circle-o"></i> Mis Cursos</a></li>
                @if($usuario->rol->id_rol == 1)
                 <li><a href="/cursos/create"><i class="fa fa-circle-o"></i>Crear Curso</a></li>
                @endif
                     
              </ul>
            </li>
           <!-- <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Opcion 3</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> Sub 1</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> Sub 2</a></li>
              </ul>
            </li>
                       
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Opcion 4</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> Sub 1</a></li>
                
              </ul>
            </li>
             <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Opcion 5</span>
                <small class="label pull-right bg-red">123</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Opcion 6</span>
                <small class="label pull-right bg-yellow">:3</small>
              </a>
            </li> -->
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
