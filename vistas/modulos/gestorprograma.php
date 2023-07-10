<div class="content-wrapper">

  <div class="nav-tabs">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab1" data-toggle="tab"><b>Activos</b></a></li>
      <li><a href="#tab2" data-toggle="tab"><b>Inactivos</b></a></li>
    </ul>
  </div>


  <section class="content-header">
    <h1>
      <b>Gestionar Programas</b>
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
            <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarGestorPrograma">
              <b>Nueva gestion de programa</b>
            </button>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive" width="100%" id="tabla-gestorprogramas">
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

    <div class="tab-pane" id="tab2">
      <section class="content">
        <div class="box">
          <div class="box-header with-border">
            <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarGestorPrograma">
              <b>Nueva gestion de programa</b>
            </button>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive" width="100%" id="tabla-gestor-inactivo">
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
  </div>


</div>

<div id="modalAgregarDetalleProducto" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-header" style="background: linear-gradient(to right, #1c92d2, #3cb0fd); color: white; border-radius: 10px 10px 0 0;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>Agregar Productos al programa</b></h4>
      </div>

      <div class="modal-body">
        <div class="box-body">
          <form class="form-horizontal " id="FormAgregarDetalleProducto">
            <div class="container box-header">
              <div class="row">
                <div class="col-sm-8">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-2">
                        <p><b>Presupuesto:</b></p>
                        <span class="label label-primary " id="info3" style="font-size:15px;">$ 0.00 </span>
                      </div>
                      <div class="col-md-2">
                        <p><b>Costo unitario:</b></p>
                        <span class="label label-primary " id="info2" style="font-size:15px;">$ 0.00</span>
                      </div>
                      <div class="col-md-2">
                        <p><b>Cantidad en stock:</b></p>
                        <span class="label label-primary " id="info1" style="font-size:15px;">0</span>
                      </div>
                      <div class="col-sm-3">
                        <button class="btn btn-primary"  id="agregarDetalleProducto" style="background: linear-gradient(to right, #0BB218, #13D222); border: none;">
                          <b>Agregar Producto</b>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <b><hr></b>

            <div class="form-group">

              <div class="col-md-4">
              <label for="buscarProducto">Barra de busqueda:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
                  <input type="text" class="form-control input-lg" name="buscarProducto" id="buscarProducto" placeholder="Buscar producto">
                </div>
              </div>

              <div class="col-md-4">
              <label for="nuevoProductoInventario">Productos:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-archive" aria-hidden="true"></i></span>
                  <select class="form-control input-lg" name="nuevoProductoInventario" id="nuevoProductoInventario">


                  </select>
                </div>
              </div>

              <div class="col-md-4">
              <label for="nuevoCantidadInventario">Cantidad:</label>
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
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

      </div>

    </div>

  </div>
</div>



<div id="modalAgregarGestorPrograma" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 10px;">
      <form id="FormNuevagestorinventario" role="form">
        <div class="modal-header" style="background: linear-gradient(to right, #1c92d2, #3cb0fd); color: white; border-radius: 10px 10px 0 0;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Nuevo Gestor de Programa</b></h4>
        </div>


        <div class="modal-body">

          <div class="box-body">
            <div class="form-horizontal">
              <div class="form-group">

                <div class="col-md-6">
                <label for="buscarPrograma">Barra de busqueda:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control input-lg" name="buscarPrograma" id="buscarPrograma" placeholder="Buscar programa">
                  </div>
                </div>

                <div class="col-md-6">
                <label for="nuevoNombrePrograma">Programas:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-archive" aria-hidden="true"></i></span>
                    <select class="form-control input-lg" name="nuevoNombrePrograma" id="nuevoNombrePrograma">

                    </select>

                  </div>
                </div>

                <input type="hidden" name="hiddenusnid" value="<?php echo $_SESSION["id_usuario"]; ?>">
              </div>
            </div>




          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" id="nueva-categoria" class="btn btn-primary nueva-categoria" style="background: linear-gradient(to right, #0BB218, #13D222); border: none;">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="modalInfoGestorProgramas" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 10px;">

      <form id="FormEditarinventario" role="form" method="post">

        <div class="modal-header" style="background: linear-gradient(to right, #1c92d2, #3cb0fd); color: white; border-radius: 10px 10px 0 0;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Datos Detallados</b></h4>
        </div>

        <div class="modal-body">
          <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive" width="100%" id="tabla-info">
            <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Nombre del producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Importe</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

        </div>

      </form>
    </div>
  </div>
</div>

<div id="modalEditarGestorPrograma" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 10px;">

      <form id="FormEditarGestorProgramas" role="form" method="post">

        <div class="modal-header" style="background: linear-gradient(to right, #1c92d2, #3cb0fd); color: white; border-radius: 10px 10px 0 0;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Editar Gestor de programa</b></h4>
        </div>

        <div class="modal-body">
          <div class="box-body">


            <div class="form-group">
            <label for="editarNombrePrograma">Nombre:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-archive" aria-hidden="true"></i></span>
                <select class="form-control input-lg" name="editarNombrePrograma" id="editarNombrePrograma">
                </select>
              </div>
            </div>

            <div class="form-group">
            <label for="editarCantidadGestor">Cantidad:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="number" class="form-control input-lg" name="editarCantidadGestor" id="editarCantidadGestor" placeholder="Edita la cantidad,.. ejem: 0" required>
              </div>
            </div>

            <div class="form-group">
            <label for="editarCostoGestor">Costo:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="number" class="form-control input-lg" name="editarCostoGestor" id="editarCostoGestor" placeholder="Edita el Costo... ejem: 0.00" required>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
   
          <?php
        			if ($_SESSION["role"] == "Administrador") {
                echo '
                <button type="submit" id="editar-gestorprograma" class="btn btn-warning editar-gestorprograma"><b>Guardar Cambios</b></button>            		
                ';
              }
        ?>
        </div>
        

      </form>
    </div>
  </div>
</div>
