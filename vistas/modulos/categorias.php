<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Administrar Categorias
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Categorias</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategorias">
          Agregar Categoria
        </button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive" width="100%" id="tabla-categorias">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Descripcion</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
       
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

<div id="modalAgregarCategorias" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="FormNuevacategoria" method="POST" role="form">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Categoria</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoNombreCategoria" id="nuevoNombreCategoria" placeholder="Ingresar nombre" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoDescripcionCategoria" id="nuevoDescripcionCategoria" placeholder="Ingresar descripcion" required>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" id="nueva-categoria" class="btn btn-primary nueva-categoria">Guardar Categoria</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="modalEditarCategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="FormEditarcategoria" role="form" method="post">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Categoria</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="editarNombreCategoria" id="editarNombreCategoria" placeholder="Ingresar nombre" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="editarDescripcionCategoria" id="editarDescripcionCategoria" placeholder="Ingresar descripcion" required>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary actualizar-categoria">Guardar cambios</button>
        </div>
        <?php
        // $editarCategoria = new ControladorCategoria();
        // $editarCategoria->ctrEditarCategoria();
        ?>
      </form>
    </div>
  </div>
</div>
<?php
// $borrarCategoria = new ControladorCategoria();
// $borrarCategoria->ctrBorrarCategoria();
?>