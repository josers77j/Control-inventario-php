 <header class="main-header">
 	<a href="inicio" class="logo">
 		<span class="logo-mini">
 			<img src="vistas/img/plantilla/icono-blanco.png" class="img-responsive" style="padding:10px">
 		</span>
 		<span class="logo-lg">
 			<img src="vistas/img/plantilla/logo-blanco-lineal.png" class="img-responsive" style="padding:10px 0px">
 		</span>

 	</a>
 	<nav class="navbar navbar-static-top" role="navigation">
 		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
 			<span class="sr-only">Toggle navigation</span>
 		</a>
 		<div class="navbar-custom-menu">
 			<ul class="nav navbar-nav">
 				<li class="dropdown">
 					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
 						<i class="fa fa-bell"></i>
 						<span class="badge badge-warning">15</span>
 					</a>
					 <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					 
    <li>
      <a href="#">
        <div class="media">
          
          <div class="media-body">
            <h4 class="media-heading">
              Alerta
              <span class="text-success pull-right"><i class="fa fa-circle" aria-hidden="true"></i></span>
            </h4>
            <p>Niveles normales de stock</p>
            <p class="text-muted"><i class="fa fa-clock-o"></i> 4 Hours Ago</p>
          </div>
        </div>
      </a>
    </li>
    <li class="divider"></li>
    <li>
      <a href="#">
        <div class="media">
          
          <div class="media-body">
            <h4 class="media-heading">
              Alerta
              <span class="text-danger pull-right"><i class="fa fa-circle" aria-hidden="true"></i></span>
            </h4>
            <p>Niveles muy bajos de stock</p>
            <p class="text-muted"><i class="fa fa-clock-o"></i> 4 Hours Ago</p>
          </div>
        </div>
      </a>
    </li>
    <li class="divider"></li>
    <li>
      <a href="#">
        <div class="media">
          
          <div class="media-body">
            <h4 class="media-heading">
              Alerta
              <span class="text-warning pull-right"><i class="fa fa-circle" aria-hidden="true"></i></span>
            </h4>
            <p>Niveles bajos de stock</p>
            <p class="text-muted"><i class="fa fa-clock-o"></i> 4 Hours Ago</p>
          </div>
        </div>
      </a>
    </li>
    <li class="divider"></li>
    <li><a href="#" class="dropdown-footer">See All Messages</a></li>
  </ul>
 				</li>

 				<li class="dropdown user user-menu">
 					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
 						<?php
							echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image">';
							?>
 						<span class="hidden-xs"><?php echo $_SESSION["nombres"]; ?></span>
 					</a>
 					<ul class="dropdown-menu">
 						<li class="user-body">
 							<div class="pull-right">
 								<a href="salir" class="btn btn-default btn-flat">Salir</a>
 							</div>
 						</li>
 					</ul>
 				</li>
 			</ul>
 		</div>
 	</nav>
 </header>