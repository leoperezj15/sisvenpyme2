<?php

session_start();

require_once "control/plantilla.control.php";
require_once "control/usuario.control.php";
require_once "control/empleado.control.php";
require_once "control/almacen.control.php";
require_once "control/sucursal.control.php";
require_once "control/proveedor.control.php";
require_once "control/natural.control.php";
require_once "control/juridico.control.php";
require_once "control/rol.control.php";
require_once "control/dashboard.control.php";
require_once "control/marca.control.php";
require_once "control/modelo.control.php";


$plantilla = new PlantillaControl();
$plantilla->ctrPlantilla();

?>