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
    <h1>Administrar usuarios</h1>

    <ol class="breadcrumb"> 
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li> 
      <li class="active">Administrar usuarios</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">  
          Agregar usuario
        </button>
      </div>
      <div class="box-body">
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
          <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Role</th>
                <th>Estado</th>
                <?php
                  if($_SESSION["role"] == "Administrador"){
                    echo '<th>Acciones</th>';
                  }
                ?>
              </tr>
          </thead>
        <tbody>
        <?php

        $item = null;
        $valor = null;
        $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

       foreach ($usuarios as $key => $value){

          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["nombres"].'</td>
                  <td>'.$value["usuario"].'</td>
                  <td>'.$value["correo"].'</td>
                  <td>'.$value["telefono"].'</td>';

                  echo '<td>'.$value["role"].'</td>';

                  if($value["estado"] != 2){
                    echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id_usuario"].'" estadoUsuario="2">Activado</button></td>';
                  }else{
                    echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["id_usuario"].'" estadoUsuario="1">Desactivado</button></td>';
                  }  


                  if($_SESSION["role"] == "Administrador"){
                    echo '<td>
                    <div class="btn-group">';
                      if($_SESSION["id_usuario"] == $value["id_usuario"]){
                        echo '<button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["usuario"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>';
                      }if($_SESSION["id_usuario"] != $value["id_usuario"]){
                        echo '<button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["usuario"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id_usuario"].'" usuario="'.$value["usuario"].'"><i class="fa fa-times"></i></button>';
                      }
                    
                    echo '</div>
                  </td>';
                  }
                  
                echo '</tr>';
        }
        ?> 
        </tbody>
       </table>
      </div>
    </div>
  </section>
</div>
							
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar usuario</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">            
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>
              </div>
            </div>

            <div class="form-group"> 
              <div class="input-group"> 
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="email" class="form-control input-lg" name="nuevoCorreo" placeholder="Ingresar correo" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="number" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar telefono" required>
              </div>
            </div>

             <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 
                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <select class="form-control input-lg" name="nuevoRol" id="nuevoRol">
                    <option value="">Selecionar Role</option>
                    <option value="2" selected="selected">Usuario</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <select class="form-control input-lg" name="nuevoStatus" id="nuevoStatus">
                    <option value="">Selecionar status</option>
                    <?php
                    $item = null;
                    $valor = null;
                    $status = ControladorStatus::ctrMostrarStatus($item, $valor);
                    foreach ($status as $key => $value) {
                        echo '<option value="'.$value["id_status"].'">'.$value["nombre"].'</option>';
                    }
                    ?>
                </select>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar usuario</button>
        </div>
        
        <?php
          $crearUsuario = new ControladorUsuarios();
          $crearUsuario -> ctrCrearUsuario();
        ?>
      </form>
    </div>
  </div>
</div>

<div id="modalEditarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar usuario</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">            
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>
              </div>
            </div>

            <div class="form-group"> 
              <div class="input-group"> 
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="email" class="form-control input-lg" name="editarCorreo" id="editarCorreo"  placeholder="Ingresar correo" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="number" class="form-control input-lg" name="editarTelefono" id="editarTelefono" placeholder="Ingresar telefono" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 
                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">
                <input type="hidden" id="passwordActual" name="passwordActual">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <input type="text"  disabled="disabled" class="form-control input-lg" name="editarRol" id="editarRol">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <select class="form-control input-lg" name="editarStatus">
                    <?php
                    $item = null;
                    $valor = null;
                    $status = ControladorStatus::ctrMostrarStatus($item, $valor);
                    foreach ($status as $key => $value) {
                        echo '<option id="'.$value["nombre"].'" value="'.$value["id_status"].'">'.$value["nombre"].'</option>';
                    }
                    ?>
                </select>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Modificar usuario</button>
        </div>

     <?php
          $editarUsuario = new ControladorUsuarios();
          $editarUsuario -> ctrEditarUsuario();
        ?> 
      </form>
    </div>
  </div>
</div>

<?php
  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario -> ctrBorrarUsuario();
?> 


