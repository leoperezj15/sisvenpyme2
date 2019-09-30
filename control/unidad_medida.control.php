<?php  

require_once "model/UnidadMedida.Model.php";

/**
 * 
 */

class ControladorUnidadMedida
{
	/*=============================================
					MOSTRAR UNIDADES DE MEDIDA
	=============================================*/
	static public function ctrMostrarUnidadMedida()
	{
		
		$oUnidadMedida_Model = new UnidadMedida_Model;

        $respuesta = $oUnidadMedida_Model->GetUnidadMedidaList();

        return $respuesta;
    }
}