<style>
  .custom-scrollbar::-webkit-scrollbar {
  width: 8px;
  background-color: #f5f5f5;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
  background-color: #888;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background-color: #555;
}
</style>

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
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="
    padding-top: 10px;
">
            <i class="fa fa-bell"></i>
            <span class="badge label-danger" id="countNotify"></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="Listanotificaciones">

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
  <?php
// Obtener el valor de la variable de sesión
$idUsuario = $_SESSION["id_usuario"];
?>

<div id="token" style="display: none;" data-id="<?php echo $idUsuario; ?>"></div>
</header>

<div id="modalNotificaciones" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="FormEditarinventario" role="form" method="post">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Centro de Notificaciones</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">

            <ul class="list-group" id="ListamodalNotificaciones">
              <!-- Aquí se generan dinámicamente los elementos de la lista -->


              <!-- Fin de los elementos de la lista -->
            </ul>


          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        </div>

      </form>
    </div>
  </div>
</div>

        