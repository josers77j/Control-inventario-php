<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Administrar Programas
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Programas</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProgramas">
          Agregar Programa
        </button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Descripcion</th>
              <th>Presupuesto</th>
              <th>Fecha de creacion</th>
              <th>Acciones</th>
              
            </tr>
          </thead>
          <tbody>
            <?php

            $item = null;
            $valor = null;
            $programas = ControladorProgramas::ctrMostrarPrograma($item, $valor);

            foreach ($programas as $key => $value) {
              echo ' <tr>
                    <td>' . ($key + 1) . '</td>
                    <td>' . $value["nombre"] . '</td>
                    <td>' . $value["descripcion"] . '</td>
                    <td>' . $value["presupuesto"] . '</td>
                    <td>' . $value["fecha"] . '</td>

                    <td>
                      <div class="btn-group">
                        <button class="btn btn-warning btnEditarPrograma"  idPrograma="' . $value["id_programa"] . '" data-toggle="modal" data-target="#modalEditarPrograma"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnEliminarPrograma" idPrograma="' . $value["id_programa"] . '"><i class="fa fa-times"></i></button></div>  
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

<div id="modalAgregarProgramas" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Programa</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">
          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoNombrePrograma" id="nuevoNombrePrograma" placeholder="Ingresar nombre" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoDescripcionPrograma" id="nuevoDescripcionPrograma" placeholder="Ingresar descripcion" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="number" class="form-control input-lg" name="nuevoPresupuestoPrograma" id="nuevoPresupuestoPrograma" placeholder="Ingresar descripcion" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                <input type="date" class="form-control input-lg" id="nuevofechaPrograma" name="nuevofechaPrograma" placeholder="Ingresar fecha de vencimiento" required>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Programa</button>
        </div>
        <?php
        $crearPrograma = new ControladorProgramas();
        $crearPrograma->crtCrearPrograma();
        ?>
      </form>
    </div>
  </div>
</div>

<div id="modalEditarPrograma" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" method="post">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Programa</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="editarNombrePrograma" id="editarNombrePrograma" placeholder="Ingresar nombre" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="editarDescripcionPrograma" id="editarDescripcionPrograma" placeholder="Ingresar descripcion" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="number" class="form-control input-lg" name="editarPresupuestoPrograma" id="editarPresupuestoPrograma" placeholder="Ingresar descripcion" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                <input type="date" class="form-control input-lg" id="editarfechaPrograma" name="editarfechaPrograma" placeholder="Ingresar fecha de vencimiento" required>
              </div>
            </div>

<input type="hidden" name="idPrograma" id="idPrograma" >
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
        <?php
        $editarPrograma = new ControladorProgramas();
        $editarPrograma->ctrEditarPrograma();
        ?>
      </form>
    </div>
  </div>
</div>
<?php
$borrarPrograma = new ControladorProgramas();
$borrarPrograma->ctrBorrarPrograma();
?>