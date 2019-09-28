<?php
session_start();
//sales/pdf/factura.php?mandante=".$hash."
require_once "../model/Venta.Model.php";

class AjaxVenta
{
	public function mostrarTablaVenta()
	{

		//recoletacndo de la variabvle de session
	    $usuarioActivo = $_SESSION["ACL"]["usuario_activo"];
	    $idUsuario = $usuarioActivo["idUsuario"];

		$oVenta_model = new Venta_Model;
		$ventas = $oVenta_model->GetListVenta($idUsuario);

		if ($ventas != false) 
		{
			$datosJson = '

				{
					"data":	
					[';

				for ($i=0; $i < count($ventas); $i++) 
				{ 
					$idVenta = "".$ventas[$i]->idVenta->GetValue()."";
					$hash = "".$ventas[$i]->hash->GetValue()."";
					$cliente = "".$ventas[$i]->Cliente->direccion->GetValue()."";
					$nro_documento = "<p class='pull-right'>".$ventas[$i]->Cliente->zona->GetValue()."</p>";
					$tipo_cliente = $ventas[$i]->Cliente->hash->GetValue();
					if ($tipo_cliente == "NATURAL") 
					{
						$tipoCliente ="<span data-toggle='tooltip' title='' class='badge bg-yellow' data-original-title='".$tipo_cliente."'>".$tipo_cliente."</span>";
					}
					else
					{
						$tipoCliente ="<span data-toggle='tooltip' title='' class='badge bg-light-blue' data-original-title='".$tipo_cliente."'>".$tipo_cliente."</span>";
					}
					$print = "onclick='print()'";
					$usuario = "".$ventas[$i]->Usuario->username->GetValue()."";
					$almacen = "".$ventas[$i]->Almacen->sigla->GetValue()."";
					$fecha_hora = "".$ventas[$i]->fecha_hora->GetValue()."";
					$monto_total = "<p class='pull-right'>".number_format($ventas[$i]->monto_total->GetValue(),2)."</p>";
					$monto_descuento = "<p class='pull-right'>".number_format($ventas[$i]->monto_descuento->GetValue(),2)."</p>";
					$estado = "".$ventas[$i]->estado->GetValue()."";
					$botones = "<div class='btn-group'><button class='btn btn-success btn-xs btnImprimirVenta' idVenta='".$hash."' ><i class='fa fa-print' ></i></button><button class='btn btn-warning btn-xs' idVenta='".$hash."' data-toggle='modal' data-target='#'><i class='fa fa-eye'></i></button><button class='btn btn-danger btn-xs' idVenta='".$hash."'><i class='fa fa-times'></i></button></div>";
					
					$botones2 = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm dropdown-toggle' data-toggle='dropdown' aria-expanded='true'><i class='fa fa-bars'></i></button><ul class='dropdown-menu pull-right'role='menu'><li><a href=''>Add new event</a></li><li><a href=''>Clear events</a></li><li class='divider'></li><li><a href=''>View calendar</a></li></ul></div>";

					$datosJson .= '
						[
							"'.($i+1).'",
							"'.$cliente.'",
							"'.$nro_documento.'",
							"'.$tipoCliente.'",
							"'.$usuario.'",
							"'.$almacen.'",
							"'.$fecha_hora.'",
							"'.$monto_total.'",
							"'.$monto_descuento.'",
							"'.$estado.'",
							"'.$botones.'"
						],';
				}

				$datosJson = substr($datosJson, 0, -1);

				$datosJson .= '		
					]
				}';

			echo $datosJson;
			
		}
		else
		{
			echo '{
					"data":	
					[
						[
							"No existen Datos",
							"",
							"",
							"",
							"",
							"",
							"",
							"",
							"",
							"",
							""
						]
					]
				}';
		}		 

	}
	
}

/*=============================================
ACTIVAR TABLA DE ventas
=============================================*/
$activarVenta = new AjaxVenta();
$activarVenta->mostrarTablaVenta();