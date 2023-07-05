<div class="content-wrapper">

  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab1" data-toggle="tab">Activos</a></li>
      <li><a href="#tab2" data-toggle="tab">Inactivos</a></li>
    </ul>
  </div>

  <section class="content-header">
    <h1>
      Administrar Programas
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
      <li class="active">Administrar Programas</li>
    </ol>
  </section>

  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
      <section class="content">
        <div class="box">
          <div class="box-header with-border">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProgramas">
              Agregar Programa
            </button>
            <button class="btn btn-primary btnImprimirProgramas" style="float: right;">   
              Descargar reporte
            </button>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive" width="100%" id="tabla-programas">
              <thead>
                <tr>
                  <th style=" width:10px">#</th>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Presupuesto</th>
                  <th>Fecha de creacion</th>                  
                  <th>Estatus</th>
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
              Agregar Programa
            </button>
            <button class="btn btn-primary btnImprimirProgramasInactivos" style="float: right;">   
              Descargar reporte
            </button>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive" width="100%" id="tabla-programas-inactivos">
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

              </tbody>
            </table>
          </div>
        </div>
      </section>
    </div>
  </div>

</div>

<div id="modalAgregarProgramas" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" id="FormNuevaprograma">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Programa</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoNombrePrograma" id="nuevoNombrePrograma" placeholder="Ingresar nombre del programa" required>
              </div>
            </div>

          
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                <input type="number" class="form-control input-lg" name="nuevoPresupuestoPrograma" id="nuevoPresupuestoPrograma" placeholder="0.00" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-comment-o" aria-hidden="true"></i></span>
                <textarea class="form-control input-lg" style="resize: vertical; max-height: 200px;"name="nuevoDescripcionPrograma" id="nuevoDescripcionPrograma" cols="30" rows="10" required></textarea>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Programa</button>
        </div>
      
      </form>
    </div>
  </div>
</div>

<div id="modalEditarPrograma" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" id="FormEditarprograma">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Programa</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">

          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="editarNombrePrograma" id="editarNombrePrograma" placeholder="Ingresar nombre del programa" required>
              </div>
            </div>

          
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                <input type="number" class="form-control input-lg" name="editarPresupuestoPrograma" id="editarPresupuestoPrograma" placeholder="Ingresar Presupuesto" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-comment-o" aria-hidden="true"></i></span>
                <textarea class="form-control input-lg" style="resize: vertical; max-height: 200px;"name="editarDescripcionPrograma" id="editarDescripcionPrograma" cols="30" rows="10" required></textarea>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                <input type="date" class="form-control input-lg" id="editarfechaPrograma" name="editarfechaPrograma" placeholder="Ingresar fecha de vencimiento" disabled="disabled"  required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" disabled id="editarStatusPrograma" name="editarStatusPrograma">
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
          <button type="submit" class="btn btn-primary editar">Guardar cambios</button>
        </div>
 
      </form>
    </div>
  </div>
</div>
