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
                    <h2 class="posicion-superior-izquierda text-bold" id="data1"></h2>
                    <h3 class="posicion-abajo-izquierda">Productos</h3>
                    <span class="card-icon"><i class="fa fa-archive" aria-hidden="true"></i></span>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3">
              <a href="categorias" style="text-decoration: none;">
                <div class="dashboard-card dashboard-card-green">
                  <div class="dashboard-card-content">
                    <h2 class="posicion-superior-izquierda text-bold" id="data2"></h2>
                    <h3 class="posicion-abajo-izquierda">Categorías</h3>
                    <span class="card-icon"><i class="fa fa-th-large" aria-hidden="true"></i></span>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3">
              <a href="usuarios" style="text-decoration: none;">
                <div class="dashboard-card dashboard-card-yellow">
                  <div class="dashboard-card-content">
                    <h2 class="posicion-superior-izquierda text-bold" id="data3"></h2>
                    <h3 class="posicion-abajo-izquierda">Usuarios</h3>
                    <span class="card-icon"><i class="fa fa-users" aria-hidden="true"></i></span>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3">
              <a href="programas" style="text-decoration: none;">
                <div class="dashboard-card dashboard-card-blue">
                  <div class="dashboard-card-content">
                    <h2 class="posicion-superior-izquierda text-bold" id="data4"></h2>
                    <h3 class="posicion-abajo-izquierda">Programas</h3>
                    <span class="card-icon"><i class="fa fa-tasks" aria-hidden="true"></i></span>
                  </div>
                </div>
              </a>
            </div>
          </div>

        </section>

        <div class="row">
          <div class="col-sm-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Reportes</h3>
              </div>
              <div class="panel-body">
                <form id="FormReporte">
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- Select multiple-->
                      <div class="form-group">
                        <label>Selecciona el tipo de reporte</label>
                        <select size="4" class="form-control" name="tipoReporte" id="tipoReporte">
                          <option value="1">Inventario actual</option>
                          <option value="2" selected>Historial de entradas</option>
                          <option value="3">Historial de salidas</option>
                          <option value="4">Productos en baja existencia</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="col-sm-6">
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
                          <!-- <div class="radio">
                            <label>
                              <input type="radio" name="estado-registros" value="ambos" checked> Registros con ambos tipos de estado
                            </label>
                          </div> -->
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="date-range">Rango de fecha:</label>
                          <div class="input-group">
                            <input type="text" class="form-control" id="dateRange" name="dateRange">
                            <span class="input-group-addon">
                              <i class="glyphicon glyphicon-calendar"></i>
                            </span>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="fecha-switch">Habilitar/Deshabilitar fecha:</label>
                          <label class="switch">
                            <input type="checkbox" id="fechaSwitch">
                            <span class="slider"></span>
                          </label>
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

          <div class="col-sm-6">

            <div class="product-box">
              <div class="box-header-list">
                <h4><b>Productos agotados</b></h4>
                <span class="box-toggle"><i class="fa fa-align-justify"></i></span>
              </div>
              <ul class="box-content" id="banner1">
              <li class="badge label-danger">Lapiceros | Cantidad : 10 </li>
              </ul>
            </div>



            <div class="product-box">
              <div class="box-header-list" id="float">
                <h4><b>Productos casi agotados</b></h4>
                <span class="box-toggle"><i class="fa fa-align-justify"></i></span>
              </div>
              <ul class="box-content" id="banner2">
                
              </ul>

            </div>


          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const boxToggles = document.querySelectorAll(".box-header-list");
    const boxContents = document.querySelectorAll(".box-content");

    for (let i = 0; i < boxToggles.length; i++) {
      boxToggles[i].addEventListener("click", function() {
        boxContents[i].classList.toggle("box-open");
      });
    }
  });
</script>

<style>
  .product-box {
    border-radius: 4px;
    width: 400px;
    overflow: hidden;
    margin-bottom: 20px;


  }

  #float {
    background: linear-gradient(to bottom, #f1c40f, #f39c12);
    position: relative;
  }

  .box-header-list {
    background: linear-gradient(to bottom, #e74c3c, #c0392b);
    color: white;
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
  }

  .box-header-list h4 {
    margin: 0;
  }

  .box-toggle {
    font-size: 16px;
  }

  .box-content {
    padding: 0;
    margin: 0;
    list-style: none;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
  }

  .box-content li {
    display: block;
    margin-bottom: 5px;
    padding: 10px;
    /* Removemos el color de fondo */
  }

  .box-content li:last-child {
    border-bottom: none;
  }

  .box-open {
    max-height: 200px;
  }



  .dashboard-card {
    height: 170px;
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
    opacity: 1;
    transition: transform 0.3s, opacity 0.3s;
  }

  .dashboard-card:hover:before {
    transform: translateY(5px);
    opacity: 0.9;
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
    padding-bottom: 10px;
  }

  .dashboard-card-content h2 {
    margin: 0;


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

  /* Iconos */
  .card-icon {
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
    opacity: 0.5;
  }


  .card-icon i {
    font-size: 90px;
    opacity: 0.3;
    margin-top: 50px;
    color: black;

  }

  .posicion-abajo-izquierda {
    align-self: flex-start;
  }

  .posicion-superior-izquierda {
    align-self: flex-start;
    margin-bottom: auto;
  }
</style>