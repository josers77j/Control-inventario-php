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
            <form>


              <div class="row">
                <div class="col-sm-6">
                  <!-- Select multiple-->
                  <div class="form-group">
                    <label>Selecciona el tipo de reporte</label>
                    <select multiple class="form-control">
                      <option>Inventario actual</option>
                      <option>Historial de entradas</option>
                      <option>Historial de salidas</option>
                      <option>productos en baja existencia</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Seleccione uno</label>
                    <div class="radio">
                      <label>
                        <input type="radio" name="customRadio"> Registros con estado activo
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" name="customRadio" checked> Registros con estado inactivo
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" name="customRadio" checked> Registros con ambos tipo de estado
                      </label>
                    </div>
                  </div>

                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="date-range">Rango de fecha:</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="date-range" readonly>
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
          </div>



          </form>


        </div>

      </div>

    </div>
</div>
</section>

</div>