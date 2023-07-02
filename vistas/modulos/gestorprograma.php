<div class="content-wrapper">

  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab1" data-toggle="tab">Activos</a></li>
      <li><a href="#tab2" data-toggle="tab">Inactivos</a></li>
    </ul>
  </div>


  <section class="content-header">
    <h1>
      Gestionar Programas
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
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarGestorPrograma">
              Nueva gestion de programa
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
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarGestorPrograma">
              Nueva gestion de programa
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
    <div class="modal-content">

      <div class="modal-header" style="background:#3c8dbc; color:white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar Productos al programa</h4>
      </div>

      <div class="modal-body">
        <div class="box-body">
          <form class="form-horizontal " id="FormAgregarDetalleProducto">
            <div class="container box-header">
              <div class="row">
                <div class="col-sm-3">
                  <button class="btn btn-primary" id="agregarDetalleProducto">
                    Agregar Producto
                  </button>
                </div>

                <div class="col-sm-8">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-2">
                        <p>Presupuesto:</p>
                        <span class="label label-primary " id="info3" style="font-size:15px;">$ 0.00 </span>
                      </div>
                      <div class="col-md-2">
                        <p>Costo unitario:</p>
                        <span class="label label-primary " id="info2" style="font-size:15px;">$ 0.00</span>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
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



<div id="modalAgregarGestorPrograma" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="FormNuevagestorinventario" role="form">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nuevo Gestor de Programa</h4>
        </div>


        <div class="modal-body">

          <div class="box-body">
            <div class="form-horizontal">
              <div class="form-group">

                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control input-lg" name="buscarPrograma" id="buscarPrograma" placeholder="Buscar programa">
                  </div>
                </div>

                <div class="col-md-6">
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

<div id="modalEditarGestorPrograma" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="FormEditarGestorProgramas" role="form" method="post">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Gestor de programa</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">


            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-archive" aria-hidden="true"></i></span>
                <select class="form-control input-lg" name="editarNombrePrograma" id="editarNombrePrograma">
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="number" class="form-control input-lg" name="editarCantidadGestor" id="editarCantidadGestor" placeholder="Edita la cantidad,.. ejem: 0" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="number" class="form-control input-lg" name="editarCostoGestor" id="editarCostoGestor" placeholder="Edita el Costo... ejem: 0.00" required>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" id="editar-gestorprograma" class="btn btn-primary editar-gestorprograma">Guardar Cambios</button>
        </div>

      </form>
    </div>
  </div>
</div>
