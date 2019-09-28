<?php

require_once "../control/compra.control.php";
require_once "../model/Compra.Model.php";

class AjaxCompra
{
	public function mostrarTablaCompras()
	{
		$oCompra_model = new Compra_Model;

		$compras = $oCompra_model->GetListCompras();

		$datosJson = '

			{
				"data":	
				[';

			for ($i=0; $i < count($compras); $i++) 
			{ 
				$idCompra = "".$compras[$i]->idCompra->GetValue()."";
				$fecha_ingreso = "".$compras[$i]->fecha_ingreso->GetValue()."";
				$fecha_compra = "".$compras[$i]->fecha_compra->GetValue()."";
				$proveedor = "".$compras[$i]->Proveedor->razon_social->GetValue()."";
				$nit = "".$compras[$i]->Proveedor->nit->GetValue()."";
				$usuario = "".$compras[$i]->Usuario->username->GetValue()."";
				$monto_total = "".number_format($compras[$i]->monto_total->GetValue(),2)."";
				$almacen = "".$compras[$i]->Almacen->sigla->GetValue()."";
				$estado = "".$compras[$i]->estado->GetValue()."";
				$botones = "<div class='btn-group'><button class='btn btn-warning btn-xs' idUsuario='".$idCompra."' data-toggle='modal' data-target='#'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btn-xs' idCompra='".$idCompra."'><i class='fa fa-times'></i></button></div>";
				
				$botones2 = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm dropdown-toggle' data-toggle='dropdown' aria-expanded='true'><i class='fa fa-bars'></i></button><ul class='dropdown-menu pull-right'role='menu'><li><a href=''>Add new event</a></li><li><a href=''>Clear events</a></li><li class='divider'></li><li><a href=''>View calendar</a></li></ul></div>";

				$datosJson .= '
					[
						"'.($i+1).'",
						"'.$fecha_ingreso.'",
						"'.$fecha_compra.'",
						"'.$proveedor.'",
						"'.$nit.'",
						"'.$usuario.'",
						"'.$monto_total.'",
						"'.$almacen.'",
						"'.$estado.'",
						"'.$botones2.'"
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
$activarCompras = new AjaxCompra();
$activarCompras->mostrarTablaCompras();

