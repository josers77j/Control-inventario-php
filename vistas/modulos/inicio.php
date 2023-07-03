<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Tablero
      <small>Panel de Control</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Tablero</li>
    </ol>
  </section>

  <section class="content">

    <div class="row">
      <div class="col-lg-12">

        <?php
        if ($_SESSION["role"] == "Administrador" || $_SESSION["role"] == "Usuario") {
          echo '<div class="box box-success">
             <div class="box-header">
             <h1>Bienvenid@ ' . $_SESSION["nombres"] . ' (o´ω`o)ﾉ</h1>
             
             </div>
             </div>';
        }
        ?>


        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Reportes</h3>
          </div>
          <div class="panel-body">
            <form id="FormReporte">

              <div class="row">
                <div class="col-sm-6">
                  <!-- Select multiple-->
                  <div class="form-group">
                    <label>Selecciona el tipo de reporte</label>
                    <select multiple class="form-control" name="tipo-reporte">
                      <option value="1">Inventario actual</option>
                      <option value="2">Historial de entradas</option>
                      <option value="3">Historial de salidas</option>
                      <option value="4">Productos en baja existencia</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Seleccione uno</label>
                    <div class="radio">
                      <label>
                        <input type="radio" name="estado-registros" value="activo"> Registros con estado activo
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" name="estado-registros" value="inactivo" checked> Registros con estado inactivo
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" name="estado-registros" value="ambos" checked> Registros con ambos tipos de estado
                      </label>
                    </div>
                  </div>

                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="date-range">Rango de fecha:</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="date-range" name="rango-fecha" readonly>
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-calendar"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Generar reporte</button>
                  </div>
                </div>
              </div>
            </form>


          </div>

        </div>

      </div>
    </div>
  </section>

</div>