<div id="back"></div>
<div class="login-box">
  <div class="login-box-body" style="border-radius: 10px;" >
  <div class="login-logo">
    <img src="../img/inicio/logo-insaforp.jpg" class="img-responsive" style="padding:30px 100px 0px 100px">
  </div>
    <h3 class="login-box-msg">Ingresar al sistema</h3>
    <form method="post">
      <div class="form-group has-feedback">
      <label for="ingUsuario">usuario:</label>
        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
      <label for="ingPassword">Contraseña:</label>
        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-info btn-block"><b>Ingresar</b></button>
        </div>
      </div>

    </form>

    <?php
        $login = new ControladorUsuarios();
        $login -> ctrIngresoUsuario();
      ?>

  </div>

</div>
