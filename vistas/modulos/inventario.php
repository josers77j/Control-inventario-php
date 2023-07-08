<div class="content-wrapper">

<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#tab1"><b>Activos</b></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#tab2"><b>Inactivos</b></a>
    </li>
  </ul>

  <section class="content-header">
    <h1>
      <b>Administrar Inventario</b>
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
        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarInventario">
          <b>Agregar Stock</b>
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
        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarInventario">
          <b>Agregar Stock</b>
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
  <div class="modal-dialog ">
    <div class="modal-content" style="border-radius: 10px;">
      <form id="FormNuevainventario" method="POST" role="form">
        <div class="modal-header" style="background: linear-gradient(to right, #1c92d2, #3cb0fd); color: white; border-radius: 10px 10px 0 0;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Agregar Inventario</b></h4>
        </div>

        <div class="modal-body">
          <div class="box-body">
            <div class = "row">
              <div class = "col-sm-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select class="form-control input-lg" name="nuevoProductoInventario" id="nuevoProductoInventario">
                      <option selected value="">Seleccionar producto</option>
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
              </div>        
              <div class = "col-sm-6">        
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                    <input type="number" class="form-control input-lg" name="nuevoCantidadInventario" id="nuevoCantidadInventario" placeholder="Cantidad de reStock" required>
                  </div>
                </div>
              </div> 
            </div>
            
            <div class = "row"> 
              <div class = "col-sm-6"> 
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                      <input type="date" class="form-control input-lg" name="nuevoFechallegadaInventario" placeholder="Ingresar fecha de vencimiento" required>
                    </div>
                  </div>
              </div>

                <div class = "col-sm-6"> 
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
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" id="nueva-categoria" class="btn btn-primary nueva-categoria" style="background: linear-gradient(to right, #0BB218, #13D222); border: none;"><b>Guardar</b></button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="modalEditarInventario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 10px;">

      <form id="FormEditarinventario" role="form" method="post">

        <div class="modal-header" style="background: linear-gradient(to right, #1c92d2, #3cb0fd); color: white; border-radius: 10px 10px 0 0;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Datos Detallados</b></h4>
        </div>

        <div class="modal-body">
          <div class="box-body">
          <div class="row">
            <div class="col-sm-6">               
              <div class="form-group">
                <label for="editarProductoInventario">Producto:</label>
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
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="editarCantidadInventario">Cantidad:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-th"></i></span>
                  <input type="text" class="form-control input-lg" name="editarCantidadInventario" id="editarCantidadInventario" placeholder="Ingresar cantidad" required>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="editarFechallegadaInventario">Fecha de llegada:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                  <input type="date" class="form-control input-lg" name="editarFechallegadaInventario" id="editarFechallegadaInventario" placeholder="Ingresar fecha de llegada" required>
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="editarFechaemisionInventario">Fecha de emisión:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                  <input type="date" class="form-control input-lg" name="editarFechaemisionInventario" id="editarFechaemisionInventario" placeholder="Ingresar fecha de emisión" required>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="editarStatusInventario">Status:</label>
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
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

        </div>

      </form>
    </div>
  </div>
</div>