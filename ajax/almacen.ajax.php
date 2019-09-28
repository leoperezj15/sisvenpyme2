<?php

require_once "../control/almacen.control.php";
require_once "../model/Almacen.Modelo.php";

class AjaxAlmacen
{

	/*=============================================
	EDITAR EMPLEADO
	=============================================*/	
	public $idSucursal;

	public function ajaxListaAlmacenPorSucursal()
	{

		$valor = $this->idSucursal;

		$respuesta = ControladorAlmacen::ctrAlmacenPorSucursal($valor);

		echo $respuesta;

	}

}

/*=============================================
EDITAR EMPLEADO DISPARADOR
=============================================*/
if(isset($_POST["idSucursal"]))
{

	$listar = new AjaxAlmacen();
	$listar->idSucursal = $_POST["idSucursal"];
	$listar->ajaxListaAlmacenPorSucursal();

}