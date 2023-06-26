<div class="content-wrapper">

  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab1" data-toggle="tab">Activos</a></li>
      <li><a href="#tab2" data-toggle="tab">Inactivos</a></li>
    </ul>
  </div>

  <section class="content-header">
    <h1>
      Administrar Inventario
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
      <li class="active">Administrar Inventario</li>
    </ol>
  </section>

  <div class="tab-content">
    
    <div class="tab-pane active" id="tab1">
    <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarInventario">
          Agregar Stock
        </button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive" width="100%" id="tabla-inventarios">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Producto</th>
              <th>Codigo de producto</th>
              <th>Cantidad Ingresada</th>
              <th>Fecha de Llegada del producto</th>
              <th>Fecha de emision</th>
              <th>Estado</th>
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

    <div class="tab-pane" id="tab2">
    <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarInventario">
          Agregar Stock
        </button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive" width="100%" id="tabla-inventarios-inactivos">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Producto</th>
              <th>Codigo de producto</th>
              <th>Cantidad Ingresada</th>
              <th>Fecha de Llegada del producto</th>
              <th>Fecha de emision</th>
              <th>Estado</th>
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
  </div>
 
</div>

<div id="modalAgregarInventario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="FormNuevainventario" method="POST" role="form">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Inventario</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoProductoInventario" id="nuevoProductoInventario">
                  <option selected value="">Selecciona un Producto</option>
                  <?php
                  $item = null;
                  $valor = null;
                  $orden = null;
                  $status = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
                  foreach ($status as $key => $value) {
                    echo '<option id="' . $value["nombre"] . '" value="' . $value["codigo_producto"] . '">' . $value["nombre"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>


            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="number" class="form-control input-lg" name="nuevoCantidadInventario" id="nuevoCantidadInventario" placeholder="Cantidad de reStock" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                <input type="date" class="form-control input-lg" name="nuevoFechallegadaInventario" placeholder="Ingresar fecha de vencimiento" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoStatusInventario">
                  <?php
                  $item = null;
                  $valor = null;
                  $status = ControladorStatus::ctrMostrarStatus($item, $valor);
                  foreach ($status as $key => $value) {
                    echo '<option id="' . $value["nombre"] . '" value="' . $value["id_status"] . '">' . $value["nombre"] . '</option>';
                  }
                  ?>
                </select>
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

<div id="modalEditarInventario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="FormEditarinventario" role="form" method="post">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Datos Detallados</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarProductoInventario" id="editarProductoInventario">
                  <option selected value="">Selecciona un Producto</option>
                  <?php
                  $item = null;
                  $valor = null;
                  $orden = null;
                  $status = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
                  foreach ($status as $key => $value) {
                    echo '<option id="' . $value["nombre"] . '" value="' . $value["codigo_producto"] . '">' . $value["nombre"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="editarCantidadInventario" id="editarCantidadInventario" placeholder="Ingresar descripcion" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                <input type="date" class="form-control input-lg" name="editarFechallegadaInventario" id="editarFechallegadaInventario" placeholder="Ingresar fecha de vencimiento" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                <input type="date" class="form-control input-lg" name="editarFechaemisionInventario" id="editarFechaemisionInventario" placeholder="Ingresar fecha de vencimiento" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" id="editarStatusInventario" name="editarStatusInventario">
                  <?php
                  $item = null;
                  $valor = null;
                  $status = ControladorStatus::ctrMostrarStatus($item, $valor);
                  foreach ($status as $key => $value) {
                    echo '<option id="' . $value["nombre"] . '" value="' . $value["id_status"] . '">' . $value["nombre"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        </div>

      </form>
    </div>
  </div>
</div>