<?php
if($_SESSION["role"] == "Usuario"){
  echo '<script>
    window.location = "inicio";
  </script>';
  return;
}

?>
<div class="content-wrapper">

<div class="nav-tabs">
    <ul class="nav nav-tabs">
      <li class="active">
        <a data-toggle="tab" href="#tab1"><b>Activos</b></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#tab2"><b>Inactivos</b></a>
      </li>
    </ul>
  </div>


  <section class="content-header">
    <h1><b>Administrar usuarios</b></h1>

    <ol class="breadcrumb"> 
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li> 
      <li class="active">Administrar usuarios</li>
    </ol>
  </section>

  <div class="tab-content">

<div class="tab-pane active" id="tab1">
<section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarUsuario">  
          <b>Agregar usuario</b>
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
                <th>Acciones</th>
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
                  if ($value["role"] == "Administrador") {
                    echo '<td><span class="badge label-success">Activo</span></td>';
                  }else{
                    if($value["estado"] != "Inactivo"){
                      echo '<td><button class="btn btn-success btn-xs btnActivar recargarPagina" idUsuario="'.$value["id_usuario"].'" estadoUsuario="2">Activado</button></td>';
                    }else{
                      echo '<td><button class="btn btn-danger btn-xs btnActivar recargarPagina" idUsuario="'.$value["id_usuario"].'" estadoUsuario="1" >Desactivado</button></td>';
                    }  
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


<div class="tab-pane" id="tab2">
<section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarUsuario">  
          <b>Agregar usuario</b>
        </button>
      </div>
      <div class="box-body">
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%" id="tabla-usuarioInactivo">
          <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Role</th>
                <th>Estado</th>
              </tr>
          </thead>
        <tbody>
        <?php

        $item = null;
        $valor = null;
        $usuarios = ControladorUsuarios::ctrMostrarUsuariosInactivos($item, $valor);

       foreach ($usuarios as $key => $value){

          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["nombres"].'</td>
                  <td>'.$value["usuario"].'</td>
                  <td>'.$value["correo"].'</td>
                  <td>'.$value["telefono"].'</td>';

                  echo '<td>'.$value["role"].'</td>';

                  if($value["estado"] != "Inactivo"){
                    echo '<td><button class="btn btn-success btn-xs btnActivar recargarPagina" idUsuario="'.$value["id_usuario"].'" estadoUsuario="2" >Activado</button></td>';
                  }else{
                    echo '<td><button class="btn btn-danger btn-xs btnActivar recargarPagina" idUsuario="'.$value["id_usuario"].'" estadoUsuario="1" >Desactivado</button></td>';
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



</div>
</div>				
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius: 10px;">
      <form role="form" method="post" enctype="multipart/form-data">
        
        <div class="modal-header" style="background: linear-gradient(to right, #1c92d2, #3cb0fd); color: white; border-radius: 10px 10px 0 0;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Agregar usuario</b></h4>
        </div>

        <div class="modal-body">
          <div class="box-body">            
            
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="nuevoNombre">Nombre:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                    <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group"> 
                  <label for="nuevoUsuario">Usuario:</label>
                  <div class="input-group"> 
                    <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                    <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" required>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="nuevoCorreo">Correo:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                    <input type="email" class="form-control input-lg" name="nuevoCorreo" placeholder="Ingresar correo" required>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="nuevoTelefono">Teléfono:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                    <input type="number" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" required>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="nuevoPassword">Contraseña:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span> 
                    <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="nuevoRol">Role:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                    <select class="form-control input-lg" name="nuevoRol" id="nuevoRol">
                      <option value="">Seleccionar Role</option>
                      <option value="2" selected="selected">Usuario</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary" style="background: linear-gradient(to right, #0BB218, #13D222); border: none;"><b>Guardar usuario</b></button>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius: 10px;">
      <form role="form" method="post" enctype="multipart/form-data">

        <div class="modal-header" style="background: linear-gradient(to right, #1c92d2, #3cb0fd); color: white; border-radius: 10px 10px 0 0;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Editar usuario</b></h4>
        </div>

        <div class="modal-body">
          <div class="box-body">            
            <div class = "row">
              <div class = "col-sm-6">
                <div class="form-group">
                  <label for="editarNombre">Nombre:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                    <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>
                  </div>
                </div>
              </div>

              <div class = "col-sm-6">          
                <div class="form-group"> 
                  <label for="editarUsuario">Usuario:</label>
                  <div class="input-group"> 
                    <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                    <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>
                  </div>
                </div>
              </div>
            </div>
            
            <div class = "row">
              <div class = "col-sm-6"> 
                <div class="form-group">
                  <label for="editarCorreo">Correo:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                    <input type="email" class="form-control input-lg" name="editarCorreo" id="editarCorreo"  placeholder="Ingresar correo" required>
                  </div>
                </div>
              </div>

              <div class = "col-sm-6">
                <div class="form-group">
                  <label for="editarTelefono">Teléfono:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                    <input type="number" class="form-control input-lg" name="editarTelefono" id="editarTelefono" placeholder="Ingresar teléfono" required>
                  </div>
                </div>
              </div>
            </div>
            
            <div class = "row">
              <div class = "col-sm-6">
                <div class="form-group">
                  <label for="editarPassword">Contraseña:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span> 
                    <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">
                    <input type="hidden" id="passwordActual" name="passwordActual">
                  </div>
                </div>
              </div>

              <div class = "col-sm-6">
                <div class="form-group">
                  <label for="editarRol">Rol:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                    <input type="text" disabled="disabled" class="form-control input-lg" name="editarRol" id="editarRol">
                  </div>
                </div>
              </div>
            </div>

            
            <div class="form-group">
              <label for="editarStatus">Status:</label>
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
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-warning"><b>Modificar usuario</b></button>
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


