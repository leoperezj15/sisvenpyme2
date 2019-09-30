<?php  

require_once "model/Categoria.Model.php";

/**
 * 
 */

class ControladorCategoria
{
	/*=============================================
					MOSTRAR Categorias 
	=============================================*/
	static public function ctrMostrarCategoria()
	{
		
		$oCategoria_Model = new Categoria_Model;

        $respuesta = $oCategoria_Model->GetCategoriaList();

        return $respuesta;
    }
}