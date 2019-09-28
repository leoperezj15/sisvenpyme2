<?php


class ControladorProducto
{
	/*=============================================
			MOSTRAR LISTA DE PRODUCTOS
	=============================================*/
	static public function ctrMostrarProducto()
	{
		
		$oProducto_Model = new Producto_Model;

        $respuesta = $oProducto_Model->GetListProducto();

        return $respuesta;
	}
}

?>