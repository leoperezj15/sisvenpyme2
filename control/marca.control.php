<?php  

require_once "model/Marca.Model.php";

/**
 * 
 */

class ControladorMarca
{
	/*=============================================
					MOSTRAR MARCAS  
	=============================================*/
	static public function ctrMostrarMarca()
	{
		
		$oMarca_Model = new Marca_Model;

        $respuesta = $oMarca_Model->GetMarcaList();

        return $respuesta;
    }
}