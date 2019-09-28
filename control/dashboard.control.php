<?php

require_once "model/Venta.Model.php";

class ControladorDashboard
{
	/*=============================================
			CONTAR EL NRO DE VENTAS
	=============================================*/
	static public function ctrContarVentas($_username)
	{
		
		$oVenta = new Venta_Model;

        $respuesta = $oVenta->ContarVentas($_username);

        return $respuesta;
    }
    /*=============================================
			CONTAR EL TOTAL DE VENTAS
	=============================================*/
	static public function ctrSumarVentas($_username)
	{
		
		$oVenta = new Venta_Model;

        $respuesta = $oVenta->SumarVentas($_username);

        return $respuesta;
	}
}
?>