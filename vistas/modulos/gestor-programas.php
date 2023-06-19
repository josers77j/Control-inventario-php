<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Gestionar Programas
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
      <li class="active">Administrar Inventario</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarGestorInventario">
          Nueva gestion de programa
        </button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive" width="100%" id="tabla-gestor-programas">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre del programa</th>
              <th>Total de costo de productos</th>
              <th>Total de productos agregados</th>
              <th>Fecha de Creacion</th>
              <th>Usuario encargado</th>
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

<div id="modalAgregarDetalleProducto" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header" style="background:#3c8dbc; color:white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar Productos al programa</h4>
      </div>

      <div class="modal-body">
        <div class="box-body">
        <form class="form-horizontal" id="FormAgregarDetalleProducto">
          <div class="box-header with-border">
            <button class="btn btn-primary" id="agregarDetalleProducto">
              Agregar Producto
            </button>
          </div>

         
            <div class="form-group">

              <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
                  <input type="text" class="form-control input-lg" name="buscarProducto" id="buscarProducto" placeholder="Buscar producto">
                </div>
              </div>

              <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-archive" aria-hidden="true"></i></span>
                  <select class="form-control input-lg" name="nuevoProductoInventario" id="nuevoProductoInventario">
                 
               
                  </select>
                </div>
              </div>

              <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-level-up" aria-hidden="true"></i></span>
                  <input type="number" class="form-control input-lg" name="nuevoCantidadInventario" id="nuevoCantidadInventario" placeholder="Cantidad" required>
                </div>
              </div>

            </div>

    
          </form>



          <table class="table table-bordered table-striped dt-responsive" width="100%" id="tabla-detalle">
            <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Nombre del producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Importe</th>

                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
       
      </div>

    </div>

  </div>
</div>



<div id="modalAgregarGestorProgramas" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="FormNuevagestorinventario" method="POST" role="form">
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
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                <input type="date" class="form-control input-lg" name="nuevoFechaemisionInventario" placeholder="Ingresar fecha de vencimiento" required>
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

<div id="modalInfoGestorProgramas" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="FormEditarinventario" role="form" method="post">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Datos Detallados</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">



          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        </div>

      </form>
    </div>
  </div>
</div>