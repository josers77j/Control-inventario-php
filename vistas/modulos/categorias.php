
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <b>Administrar Categorias</b>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Categorias</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarCategorias">
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
    <div class="modal-content" style="border-radius: 10px;">
      <form id="FormNuevacategoria" method="POST" role="form">
        <div class="modal-header" style="background: linear-gradient(to right, #1c92d2, #3cb0fd); color: white; border-radius: 10px 10px 0 0;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Agregar Categoria</b></h4>
        </div>

        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <label for="nuevoNombreCategoria">Nombre de la categoría:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoNombreCategoria" id="nuevoNombreCategoria" placeholder="Ingresar nombre" required>
              </div>
            </div>

            <div class="form-group">
            <label for="nuevoDescripcionCategoria">Descripción:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoDescripcionCategoria" id="nuevoDescripcionCategoria" placeholder="Ingresar descripcion" required>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" id="nueva-categoria" style="background: linear-gradient(to right, #0BB218, #13D222); border: none;" class="btn btn-primary nueva-categoria"><b>Guardar</b></button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="modalEditarCategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 10px;">

      <form id="FormEditarcategoria" role="form" method="post">

        <div class="modal-header" style="background: linear-gradient(to right, #1c92d2, #3cb0fd); color: white; border-radius: 10px 10px 0 0;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Categoría</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
            <label for="editarNombreCategoria">Nombre de la categoría:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="editarNombreCategoria" id="editarNombreCategoria" placeholder="Ingresar nombre" required>
              </div>
            </div>

            <div class="form-group">
            <label for="editarDescripcionCategoria">Descripción:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="editarDescripcionCategoria" id="editarDescripcionCategoria" placeholder="Ingresar descripcion" required>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-warning actualizar-categoria"><b>Guardar cambios</b></button>
        </div>
     
      </form>
    </div>
  </div>
</div>
