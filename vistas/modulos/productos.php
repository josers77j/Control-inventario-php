<div class="content-wrapper">
  <section class="content-header">
    <h1><b>Administrar productos</b></h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar productos</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarProducto">   
          <b>Agregar producto</b>
        </button>
        <button class="btn btn-primary btnImprimirProductos" style="float: right;">   
            Descargar reporte
          </button>
      </div>

      <div class="box-body">
       <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
        <thead>
         <tr>
           <th style="width:10px">#</th>
           <th>Codigo</th>
           <th>Nombre</th>
           <th>Precio</th>
           <th>Numero de contrato</th>
           <th>Numero de oferta compra</th>
           <th>Stock</th>
           <th>Fecha de recepcion</th>
           <th>Categoría</th>
           <th>Estado</th>
           <th>Acciones</th>
         </tr> 
        </thead>      
       </table>
       <input type="hidden" value="<?php echo $_SESSION["role"]; ?>" id="perfilOculto">
      </div>
    </div>
  </section>
</div>

<div id="modalAgregarProducto" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius: 10px;">
      
      <form role="form" method="post" enctype="multipart/form-data">
        
        <div class="modal-header" style="background: linear-gradient(to right, #1c92d2, #3cb0fd); color: white; border-radius: 10px 10px 0 0;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title "><b>Agregar producto</b></h4>
        </div>

        <div class="modal-body">
          <div class="box-body">					        
            <div class="row">
              <div class = "col-sm-6">
            <div class="form-group ">
              <label for="nuevaCategoria">Categoría:</label>
              <div class="input-group shadow">
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <select class="form-control input-lg" id="nuevaCategoria" name="nuevaIdCategoriaProducto" required>    
                  <option value="">Seleccionar categoría</option>
                  <?php
                  $item = null;
                  $valor = null;
                  $categorias = ControladorCategoria::ctrMostrarCategoria($item, $valor);
                  foreach ($categorias as $key => $value) {
                    echo '<option value="'.$value["id_categoria"].'">'.$value["nombre"].'</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
            </div>
            <div class = "col-sm-6">
            <div class="form-group">
              <label for="nuevoCodigoProducto">Código:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                <input type="text" class="form-control input-lg" id="nuevoCodigoProducto" name="nuevoCodigoProducto" placeholder="Ingresar código" readonly required>
              </div>
            </div>
            </div>
            </div>
            <div class="row">
              <div class = "col-sm-6">
                <div class="form-group">
                  <label for="nuevoNombreProducto">Nombre:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                    <input type="text" class="form-control input-lg" name="nuevoNombreProducto" placeholder="Ingresar nombre" required>
                  </div>
                </div> 
              </div> 

            <div class = "col-sm-6">
              <div class="form-group">
                <label for="nuevoPrecioUnitarioProducto">Precio unitario:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                    <input type="number" step="any" min="0" class="form-control input-lg" name="nuevoPrecioUnitarioProducto" placeholder="Ingresar precio unitario" required>
                  </div>
              </div>
            </div> 
            </div>   
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">              
                  <label for="nuevaCantidadProducto">Stock:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-check"></i></span> 
                    <input type="number" class="form-control input-lg" name="nuevaCantidadProducto" min="0" placeholder="Stock" required>
                  </div>
                </div>
              </div>
              
              <div class="col-sm-6">
                <div class="form-group">              
                  <label for="nuevoNumeroContratoProducto">Número de contrato:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                    <input type="number" class="form-control input-lg" name="nuevoNumeroContratoProducto" min="0" placeholder="Número de contrato" required>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">              
                  <label for="nuevoNumeroOfertaCompraProducto">Número de oferta de compra:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                    <input type="number" class="form-control input-lg" name="nuevoNumeroOfertaCompraProducto" min="0" placeholder="Número de oferta de compra" required>
                  </div>
                </div>
              </div>
              
              <div class="col-sm-6">
                <div class="form-group">              
                  <label for="nuevaFechaRecepcionProducto">Fecha de recepción:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span> 
                    <input type="date" class="form-control input-lg" name="nuevaFechaRecepcionProducto" placeholder="Fecha de recepción" required>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="nuevaIdStatusProducto">Status:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <select class="form-control input-lg" name="nuevaIdStatusProducto" id="nuevaIdStatusProducto">
                    <option value="">Seleccionar status</option>
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
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary " style="background: linear-gradient(to right, #0BB218, #13D222); border: none;"><b>Guardar producto</b></button>
        </div>

      </form>
      <?php
        $crearProducto = new ControladorProductos();
        $crearProducto -> ctrCrearProducto();
      ?>  
    </div>
  </div>
</div>

<div id="modalEditarProducto" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius: 10px;" >
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background: linear-gradient(to right, #1c92d2, #3cb0fd); color: white;  border-radius: 10px 10px 0 0;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Editar producto</b></h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="editarIdCategoriaProducto">Categoría:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                    <select class="form-control input-lg" id="editarIdCategoriaProducto" name="editarIdCategoriaProducto" required>    
                      <option value="">Seleccionar categoría</option>
                      <?php
                      $item = null;
                      $valor = null;
                      $categorias = ControladorCategoria::ctrMostrarCategoria($item, $valor);
                      foreach ($categorias as $key => $value) {
                        echo '<option id="'.$value["nombre"].'" value="'.$value["id_categoria"].'">'.$value["nombre"].'</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="editarCodigoProducto">Código:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                    <input type="text" class="form-control input-lg" id="editarCodigoProducto" name="editarCodigoProducto" placeholder="Ingresar código" readonly required>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="editarNombreProducto">Nombre:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                    <input type="text" class="form-control input-lg" name="editarNombreProducto" id="editarNombreProducto" placeholder="Ingresar nombre" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="editarPrecioUnitarioProducto">Precio unitario:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                    <input type="number" step="any" min="0" class="form-control input-lg" name="editarPrecioUnitarioProducto" id="editarPrecioUnitarioProducto" placeholder="Ingresar precio unitario" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="editarCantidadProducto">Stock:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-check"></i></span> 
                    <input type="number" class="form-control input-lg" name="editarCantidadProducto" id="editarCantidadProducto" min="0" placeholder="Stock" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="editarNumeroContratoProducto">Número de contrato:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                    <input type="number" class="form-control input-lg" name="editarNumeroContratoProducto" id="editarNumeroContratoProducto" min="0" placeholder="Numero de contrato" required>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="editarNumeroOfertaCompraProducto">Número de oferta de compra:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                    <input type="number" class="form-control input-lg" name="editarNumeroOfertaCompraProducto" id="editarNumeroOfertaCompraProducto" min="0" placeholder="Numero de oferta de compra" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="editarFechaRecepcionProducto">Fecha de recepción:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span> 
                    <input type="date" class="form-control input-lg" name="editarFechaRecepcionProducto" id="editarFechaRecepcionProducto" placeholder="Fecha de recepcion" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="editarIdStatusProducto">Status:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <select class="form-control input-lg" name="editarIdStatusProducto" id="editarIdStatusProducto">
                  <option value="">Selecionar status</option>
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
          <button type="submit" class="btn btn-warning" ><b>Guardar cambios</b></button>
        </div>
      </form>
      <?php
        $editarProducto = new ControladorProductos();
        $editarProducto -> ctrEditarProducto();
      ?>      
    </div>
  </div>
</div>



<?php

  $eliminarProducto = new ControladorProductos();
  $eliminarProducto -> ctrEliminarProducto();

?>      



