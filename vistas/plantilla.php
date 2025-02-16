<?php

session_start();

?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>INSAFORP</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="vistas/img/plantilla/icono-negro.png">
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">

  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
  <script src="vistas/dist/js/adminlte.min.js"></script>
  
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
  
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <script src="vistas/plugins/iCheck/icheck.min.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>

  <script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <script src="vistas/plugins/jqueryNumber/jquerynumber.min.js"></script>
  <script src="vistas/bower_components/moment/min/moment.min.js"></script>
  
  <script src="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="vistas/bower_components/raphael/raphael.min.js"></script>
  <script src="vistas/bower_components/morris.js/morris.min.js"></script>
  <script src="vistas/bower_components/Chart.js/Chart.js"></script>

</head>

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page"
style='background: rgb(73,109,119);
background: -moz-radial-gradient(circle, rgba(73,109,119,1) 23%, rgba(73,92,119,1) 76%);
background: -webkit-radial-gradient(circle, rgba(73,109,119,1) 23%, rgba(73,92,119,1) 76%);
background: radial-gradient(circle, rgba(73,109,119,1) 23%, rgba(73,92,119,1) 76%);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#496d77",endColorstr="#495c77",GradientType=1);'>
 
  <?php

  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){
   
    echo '<div class="wrapper">';
    include "modulos/cabezote.php";
    include "modulos/menu.php";

    if(isset($_GET["ruta"])){

      if($_GET["ruta"] == "inicio" ||
         $_GET["ruta"] == "usuarios" ||
         $_GET["ruta"] == "status" ||
         $_GET["ruta"] == "role" ||
         $_GET["ruta"] == "productos" ||
         $_GET["ruta"] == "programas" ||
         $_GET["ruta"] == "categorias" ||         
         $_GET["ruta"] == "inventario" ||                  
         $_GET["ruta"] == "gestorprograma" ||            
         $_GET["ruta"] == "detalle-programas" ||
         $_GET["ruta"] == "salir"){

        include "modulos/".$_GET["ruta"].".php";
        echo '<script src="vistas/js/' . $_GET["ruta"] . '.js"></script>';
      }else{
        include "modulos/404.php";
      }
    }else{
      include "modulos/inicio.php";
    }
    include "modulos/footer.php";
    echo '</div>';

  }else{
    include "modulos/login.php";
  }

  ?>
  
  <script src="vistas/js/plantilla.js"></script>
  <script src="vistas/js/cabezote.js"></script>


</body>
</html>
