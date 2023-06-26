<div class="content-wrapper">
  <section class="content-header">
    <h1>Administrar productos</h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar productos</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">   
          Agregar producto
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
  <div class="modal-dialog">
    <div class="modal-content">
      
      <form role="form" method="post" enctype="multipart/form-data">
        
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar producto</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">					        
  
          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <select class="form-control input-lg" id="nuevaCategoria" name="nuevaIdCategoriaProducto" required>    
                  <option value="">Selecionar categoría</option>
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
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                <input type="text" class="form-control input-lg" id="nuevoCodigoProducto" name="nuevoCodigoProducto" placeholder="Ingresar código" readonly required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoNombreProducto" placeholder="Ingresar nombre" required>
              </div>
            </div> 

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                <input type="number" step="any" min="0" class="form-control input-lg" name="nuevoPrecioUnitarioProducto" placeholder="Ingresar precio unitario" required>
              </div>
            </div>

             <div class="form-group">              
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 
                <input type="number" class="form-control input-lg" name="nuevaCantidadProducto" min="0" placeholder="Stock" required>
              </div>
            </div>

            <div class="form-group">              
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                <input type="number" class="form-control input-lg" name="nuevoNumeroContratoProducto" min="0" placeholder="Numero de contrato" required>
              </div>
            </div>

            <div class="form-group">              
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                <input type="number" class="form-control input-lg" name="nuevoNumeroOfertaCompraProducto" min="0" placeholder="Numero de oferta de compra" required>
              </div>
            </div>

            <div class="form-group">              
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span> 
                <input type="date"  class="form-control input-lg" name="nuevaFechaRecepcionProducto" min="0" placeholder="Fecha de recepcion" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <select class="form-control input-lg" name="nuevaIdStatusProducto" id="nuevaIdStatusProducto">
                    <option value="">Selecionar status</option>
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
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar producto</button>
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
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar producto</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                  <select class="form-control input-lg" id="editarIdCategoriaProducto" name="editarIdCategoriaProducto" required>    
                    <option value="">Selecionar categoría</option>
                    <?php
                    $item = null;
                    $valor = null;
                    $categorias = ControladorCategoria::ctrMostrarCategoria($item, $valor);
                    foreach ($categorias as $key => $value) {
                      echo '<option id="'.$value["nombre"].'" value="'.$value["id_categoria"].'" >'.$value["nombre"].'</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                  <input type="text" class="form-control input-lg" id="editarCodigoProducto" name="editarCodigoProducto" placeholder="Ingresar código" readonly required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                  <input type="text" class="form-control input-lg" name="editarNombreProducto" id="editarNombreProducto" placeholder="Ingresar nombre" required>
                </div>
              </div> 

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-money"></i></span>
                  <input type="number" step="any" min="0" class="form-control input-lg" name="editarPrecioUnitarioProducto" id="editarPrecioUnitarioProducto" placeholder="Ingresar precio unitario" required>
                </div>
              </div>

              <div class="form-group">              
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-check"></i></span> 
                  <input type="number" class="form-control input-lg" name="editarCantidadProducto" id="editarCantidadProducto" min="0" placeholder="Stock" required>
                </div>
              </div>

              <div class="form-group">              
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                  <input type="number" class="form-control input-lg" name="editarNumeroContratoProducto" id="editarNumeroContratoProducto" min="0" placeholder="Numero de contrato" required>
                </div>
              </div>

              <div class="form-group">              
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                  <input type="number" class="form-control input-lg" name="editarNumeroOfertaCompraProducto" id="editarNumeroOfertaCompraProducto" min="0" placeholder="Numero de oferta de compra" required>
                </div>
              </div>

              <div class="form-group">              
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span> 
                  <input type="date"  class="form-control input-lg" name="editarFechaRecepcionProducto" id="editarFechaRecepcionProducto" placeholder="Fecha de recepcion" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                  <select class="form-control input-lg" name="editarIdStatusProducto" id="editarIdStatusProducto">
                      <option value="">Selecionar status</option>
                      <?php
                      $item = null;
                      $valor = null;
                      $status = ControladorStatus::ctrMostrarStatus($item, $valor);
                      echo "status: '.$status.'";

                      foreach ($status as $key => $value) {
                          echo '<option id="'.$value["nombre"].'" value="'.$value["id_status"].'" >'.$value["nombre"].'</option>';
                      }
                      ?>
                  </select>
                </div>
              </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
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



