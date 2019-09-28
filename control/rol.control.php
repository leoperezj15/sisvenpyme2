<?php
require_once "model/Rol.Model.php";


/**
 * 
 */
class ControladorRol
{
	/*=============================================
					MOSTRAR ALMACENES
	=============================================*/
	static public function ctrMostrarRol()
	{
		
		$oRol_Model = new Rol_Model;

        $respuesta = $oRol_Model->GetList();

        return $respuesta;
	}
}