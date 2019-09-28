<?php
        
    
    /* ===============================================================
    INSTACIA HACIA EL OBJETO DEL USUARIO
    ==================================================================*/
    $idEmpleado = "";
    $nombre_completo = "";
    $fecha_nacimiento = "";
    $ci = "";
    $fecha_ingreso = "";
    $usuario = "";
    $correo = "";
    $rol = "";
    $antiguedad = "";
    
    if(isset($_SESSION["ACL"]["usuario_activo"]))
    {
        $idUsuario = $_SESSION["ACL"]["usuario_activo"]["idUsuario"];
        
        $info = ControladorUsuarios::ctrMostrarUsuario($idUsuario);

        foreach ($info as $key => $value) 
        {
            $idEmpleado = $value->Empleado->idEmpleado->GetValue();
            $nombre_completo = $value->Empleado->nombre->GetValue()." ".$value->Empleado->a_paterno->GetValue()." ".$value->Empleado->a_materno->GetValue();
            $fecha_nacimiento = $value->Empleado->fecha_nac->GetValue();
            $ci = $value->Empleado->ci->GetValue();
            $fecha_ingreso = $value->Empleado->fecha_ingreso->GetValue();

            $usuario = $value->username->GetValue();
            $correo = $value->email->GetValue();

            $rol = $value->Rol->nombre->GetValue();

            $fecha_ing = new DateTime(date("Y-m-d",strtotime($fecha_ingreso)));
            $fecha_hoy = new DateTime(date("Y-m-d",time()));

            $res = date_diff($fecha_hoy,$fecha_ing);

            $antiguedad = "{$res->format('%Y')} año ; {$res->format('%m')} mes y {$res->format('%d')} día ";


        }
    }
    else
    {
        echo "<p>Lo sentimos algo anda mal :(</p>";

    }
    

?>
<div class="form-horizontal invoice">
    <div class="form-group">
        <label for="codigo" class="col-sm-2 control-label">Cod. Empleado</label>

        <div class="col-sm-10">
        <input type="text" class="form-control" id="codigo" value="<?php echo $idEmpleado; ?>" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="nombre_completo" class="col-sm-2 control-label">Nombre Completo</label>

        <div class="col-sm-10">
        <input type="text" class="form-control" id="nombre_completo" value="<?php echo $nombre_completo; ?>" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="fecha_nacimiento" class="col-sm-2 control-label">Fecha de Nacimiento</label>

        <div class="col-sm-10">
        <input type="date" class="form-control" id="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="ci" class="col-sm-2 control-label">Cédula de Identidad</label>

        <div class="col-sm-10">
        <input type="number" class="form-control" id="ci" value="<?php echo $ci; ?>" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="fecha_ingreso" class="col-sm-2 control-label">Fecha de Ingreso</label>

        <div class="col-sm-10">
        <input type="date" class="form-control" id="fecha_ingreso" value="<?php echo $fecha_ingreso; ?>" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="antiguedad" class="col-sm-2 control-label">Antiguedad</label>

        <div class="col-sm-10">
        <input type="text" class="form-control" id="antiguedad" value="<?php echo $antiguedad; ?>" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="username" class="col-sm-2 control-label">Usuario</label>

        <div class="col-sm-10">
        <input type="text" class="form-control" id="username" value="<?php echo $usuario; ?>" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="correo" class="col-sm-2 control-label">Correo</label>

        <div class="col-sm-10">
        <input type="text" class="form-control" id="correo" value="<?php echo $correo; ?>" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="rol" class="col-sm-2 control-label">Rol</label>

        <div class="col-sm-10">
        <input type="text" class="form-control" id="rol" value="<?php echo $rol; ?>" readonly>
        </div>
    </div>
</div>