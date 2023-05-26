<?php

if($_SESSION["role"] == "Usuario"){
  echo '<script>
    window.location = "inicio";
  </script>';
  return;
}

?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Administrar roles
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar roles</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarRole">
          Agregar roles
        </button>
      </div>
      <div class="box-body">
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        <thead>
         <tr>  
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Descripcion</th>
           <th>Acciones</th>
         </tr> 
        </thead>
        <tbody>
        <?php

          $item = null;
          $valor = null;
          $categorias = ControladorRole::ctrMostrarRole($item, $valor);

          foreach ($categorias as $key => $value) {
            echo ' <tr>
                    <td>'.($key+1).'</td>
                    <td>'.$value["nombre"].'</td>
                    <td>'.$value["descripcion"].'</td>

                    <td>
                      <div class="btn-group">';
                        if($_SESSION["role"] == "Administrador"){
                          echo '
                          <button class="btn btn-warning btnEditarRole"  idRole="'.$value["id_rol"].'" data-toggle="modal" data-target="#modalEditarRole"><i class="fa fa-pencil"></i></button>';
                        }
                      echo '</div>  
                    </td>
                  </tr>';
          }

        ?>
        </tbody>
       </table>
      </div>
    </div>
  </section>
</div>

<div id="modalAgregarRole" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" method="post">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar role</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">   

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoNombreRole" id="nuevoNombreRole" placeholder="Ingresar nombre" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoDescripcionRole" id="nuevoDescripcionRole" placeholder="Ingresar descripcion" required>
              </div>
            </div>
            
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar role</button>
        </div>
        <?php
          $crearCategoria = new ControladorRole();
          $crearCategoria -> ctrCrearRole();
        ?>
      </form>
    </div>
  </div>
</div>

<div id="modalEditarRole" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" method="post">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar role</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">   

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <input type="text" class="form-control input-lg" name="editarNombreRole" id="editarNombreRole" placeholder="Ingresar nombre" disabled>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <input type="text" class="form-control input-lg" name="editarDescripcionRole" id="editarDescripcionRole" placeholder="Ingresar descripcion" required>
              </div>
            </div>
            
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
      <?php
          $editarRole = new ControladorRole();
          $editarRole -> ctrEditarRole();
        ?> 
      </form>
    </div>
  </div>
</div>
<?php
  $borrarRole = new ControladorRole();
  $borrarRole -> ctrBorrarRole();
?>


