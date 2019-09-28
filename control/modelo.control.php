<?php  

require_once "model/Modelo.Model.php";
/**
 * 
 */

class ControladorModelo
{
	/*=============================================
					MOSTRAR MODELO
	=============================================*/
	static public function ctrMostrarModelo()
	{
		
		$oModelo_Model = new Modelo_Model;

        $respuesta = $oModelo_Model->GetModeloList();

        return $respuesta;
    }
}