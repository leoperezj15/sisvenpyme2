<div id="back"></div>

<div class="fakeLoader"></div>

<div class="login-box">

  <div class="login-logo">

    <a href="inicio"><b>Sistema de Ventas </b>PyME</a>

    <br>

  </div>

  <!-- /.login-logo -->

  <div class="login-box-body">

    <p class="login-box-msg">Ingresar al Sistema</p>

    <form method="POST">

      <div class="form-group has-feedback">

        <input type="text" id="user" name="user" class="form-control" placeholder="Usuario" required>

        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" id="pass" name="pass" class="form-control" placeholder="Contraceña" required>

        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

      </div>

      <div class="row">

        <!-- /.col -->

        <div class="col-xs-4">

          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>

        </div>

        <!-- /.col -->

      </div>

      <?php

        $login = new ControladorUsuarios();
        $login -> ctrIngresoUsuario();
        
      ?>

    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<div class="fakeLoader"></div>

<!-- Para edicion de la plantilla con js -->
<script src="view/js/login.js"></script>