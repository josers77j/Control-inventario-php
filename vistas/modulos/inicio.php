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

<section class="content">
    <div class="row">
      <div class="col-lg-3">
        <a href="productos" style="text-decoration: none;">
          <div class="dashboard-card dashboard-card-red">
            <div class="dashboard-card-content">
              <h3>Productos</h3>   
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-3">
        <a href="categorias" style="text-decoration: none;">
          <div class="dashboard-card dashboard-card-green">
            <div class="dashboard-card-content">
              <h3>Categorías</h3>
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-3">
        <a href="usuarios" style="text-decoration: none;">
          <div class="dashboard-card dashboard-card-yellow">
            <div class="dashboard-card-content">
              <h3>Usuarios</h3>
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-3">
        <a href="programas" style="text-decoration: none;">
          <div class="dashboard-card dashboard-card-blue">
            <div class="dashboard-card-content">
              <h3>Programas</h3>
            </div>
          </div>
        </a>
      </div>
    </div>
    
  </section>
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


<style>
  .dashboard-card {
    height: 200px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 4px;
    overflow: hidden;
    position: relative;
    margin-bottom: 20px;
  }

  .dashboard-card:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    transform: translateY(10px);
    opacity: 0.8;
    transition: transform 0.3s, opacity 0.3s;
  }

  .dashboard-card:hover:before {
    transform: translateY(5px);
    opacity: 1;
  }

  .dashboard-card-content {
    position: relative;
    z-index: 1;
    color: #fff;
    padding: 20px;
    text-align: center;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
  }

  .dashboard-card-content h3 {
    margin: 0;
    font-size: 24px;
  }

  .dashboard-card-red:before {
    background: linear-gradient(to bottom, #e74c3c, #c0392b);
  }

  .dashboard-card-green:before {
    background: linear-gradient(to bottom, #2ecc71, #27ae60);
  }

  .dashboard-card-yellow:before {
    background: linear-gradient(to bottom, #f1c40f, #f39c12);
  }

  .dashboard-card-blue:before {
    background: linear-gradient(to bottom, #3498db, #2980b9);
  }

  .dashboard-card-purple:before {
    background: linear-gradient(to bottom, #9b59b6, #8e44ad);
  }
</style>




