<div id="back"></div>
<div class="login-box">
  <div class="window">
    <div class="login-logo">
      <img src="vistas/img/inicio/logo-sobre-blanco.png" class="img-responsive" >
    </div>
      <h3 class="login-box-msg" style="color: aliceblue;">Ingresar al sistema</h3>
      <form method="post">
        <div class="form-group has-feedback">
        <label for="ingUsuario" style="color: aliceblue;">usuario:</label>
          <input type="text" style="border-radius: 10px;" class="form-control" placeholder="Usuario" name="ingUsuario" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
        <label for="ingPassword" style="color: aliceblue;">Contraseña:</label>
          <input type="password" style="border-radius: 10px;" class="form-control" placeholder="Contraseña" name="ingPassword" required>
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

<style scoped>
  .window{
  width:400px;
  height:400px;
  padding:40px;
  border-radius:20px;
  backdrop-filter:blur(50px) brightness(150%);
  display:relative;
  flex-direction:column;
  justify-content:center;
  align-items:center;
  color:white;
}
</style>
