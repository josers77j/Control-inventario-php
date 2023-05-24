<div class="content-wrapper">
  <section class="content-header"> 
    <h1>
      Tablero
      <small>Panel de Control</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Tablero</li>
    </ol>
  </section>

  <section class="content">

     <div class="row">
         <div class="col-lg-12"> 

          <?php
          if($_SESSION["role"] == "Administrador" || $_SESSION["role"] == "Usuario"){
             echo '<div class="box box-success">
             <div class="box-header">
             <h1>Bienvenid@ ' .$_SESSION["nombres"].'</h1>
             </div>
             </div>';
          }
          ?>
          
         </div>
     </div>
  </section>
 
</div>
