<?php

?>
<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-warning"></i> Atención!</h4>
    Para cambiar la contraseña debe cumplir con los siguientes requisitos
    <ol>
        <li>Puede contener Letras y Números</li>
        <li>Debe contener al menos 1 Número y 1 Letra</li>
        <li>Puede contener cualquiera de estos caracteres <code>!@#$%.</code> en la contraseña</li>
        <li>Debe tener una longitud 8-16 caracteres</li>
    </ol>
</div>
<form id="FormChangePass"  role="form" method="POST">
    <div class="form-horizontal invoice">
        <div class="form-group">
            <label for="old_pass" class="col-sm-3 control-label">Antigua Contraseña</label>

            <div class="col-sm-9">
                <input type="hidden" name="username" value="<?php echo $_SESSION['ACL']['usuario_activo']['usuario']; ?>">
                <input type="password" class="form-control" id="old_pass" name="old_pass" minlength="4" required>
            </div>
        </div>
        <div class="form-group">
            <label for="new_pass" class="col-sm-3 control-label">Nueva Contraseña</label>

            <div class="col-sm-9">
                <input type="password" class="form-control" id="new_pass" name="new_pass" minlength="8" required>
            </div>
        </div>
        <div class="form-group">
            <label for="confir_new_pass" class="col-sm-3 control-label">Confirme Contraseña</label>

            <div class="col-sm-9">
                <input type="password" class="form-control" id="confir_new_pass" name="confir_new_pass" minlength="8" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" id="btnUpdatePass" class="btn btn-danger">Cambiar Contraseña</button>
            </div>
        </div>
    </div>
</form>
