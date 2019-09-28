<?php

require_once "../control/producto.control.php";
require_once "../model/Producto.Model.php";

class AjaxProducto
{
	public function mostrarTablaProductos()
	{
		$productos = ControladorProducto::ctrMostrarProducto();

		$datosJson = '

			{
				"data":	
				[';

			for ($i=0; $i < count($productos); $i++) 
			{ 
				$idProducto = "".$productos[$i]->idProducto->GetValue()."";
				$hash = "".$productos[$i]->hash->GetValue()."";
				$nombre = "".$productos[$i]->nombre->GetValue()."";
				$descripcion = "".$productos[$i]->descripcion->GetValue()."";
				$estado = "".$productos[$i]->estado->GetValue()."";
				$peso = "".$productos[$i]->peso->GetValue()."";
				$madein = "".$productos[$i]->madein->GetValue()."";
				$codigo = "".$productos[$i]->codigo->GetValue()."";
				$pcompra = "<p class='pull-right'>".number_format($productos[$i]->pcompra->GetValue(),2)."</p>";
				$pventa = "<p class='pull-right'>".number_format($productos[$i]->pventa->GetValue(),2)."</p>";
				$idModelo = "".$productos[$i]->idModelo->GetValue()."";
				$modelo = "".$productos[$i]->Modelo->model->GetValue()."";
				$idMarca = "".$productos[$i]->Modelo->Marca->idMarca->GetValue()."";
				$marca = "".$productos[$i]->Modelo->Marca->nombre->GetValue().""; 
				$idsubCategoria = "".$productos[$i]->idsubCategoria->GetValue()."";
				$subcategoria = "".$productos[$i]->SubCategoria->nombre->GetValue()."";
				$idCategoria = "".$productos[$i]->SubCategoria->Categoria->idCategoria->GetValue()."";
				$categoria = "".$productos[$i]->SubCategoria->Categoria->nombre->GetValue()."";
				$idunidadMedida = "".$productos[$i]->UnidadMedida->idunidadMedida->GetValue()."";
				$medida = "".$productos[$i]->UnidadMedida->abrev->GetValue()."";
				$botones = "<div class='btn-group'><button class='btn btn-xs btn-warning' idUsuario='".$hash."' data-toggle='modal' data-target='#'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger' idCompra='".$hash."'><i class='fa fa-times'></i></button></div>";

				$datosJson .= '
					[
						"'.($i+1).'",
						"'.$codigo.'",
						"'.$nombre.'",
						"'.$modelo.'",
						"'.$marca.'",
						"'.$peso.'",
						"'.$madein.'",
						"'.$pcompra.'",
						"'.$pventa.'",
						"'.$subcategoria.'",
						"'.$categoria.'",
						"'.$medida.'",
						"'.$botones.'"
					],';
			}

			$datosJson = substr($datosJson, 0, -1);

			$datosJson .= '		
				]
			}';

		echo $datosJson; 

	}

	
}

/*=============================================
ACTIVAR TABLA DE COMPRAS
=============================================*/
$activarProductos = new AjaxProducto();
$activarProductos->mostrarTablaProductos();