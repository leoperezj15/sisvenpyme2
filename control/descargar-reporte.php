<?php

require "../model/Venta.Model.php";
require "../model/DetalleVenta.Model.php";

/**
 * 
 */
class Reportes_Control 
{

	function descargarReporteVentas($_fi,$_ff,$_usuario,$_cliente)
	{
		$oVenta = new Venta_Model;
		$oDetalle = new DetalleVenta_Model;

		/*=============================================
		CREAMOS EL ARCHIVO DE EXCEL
		=============================================*/
		$fecha = strtotime("now");
		$Name = "reporte_".$fecha.".xls";

		header('Expires: 0');
		header('Cache-control: private');
		header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
		header("Cache-Control: cache, must-revalidate"); 
		header('Content-Description: File Transfer');
		header('Last-Modified: '.date('D, d M Y H:i:s'));
		header("Pragma: public"); 
		header('Content-Disposition:; filename="'.$Name.'"');
		header("Content-Transfer-Encoding: binary");
	
		echo utf8_decode("<table border='0'> 
				<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>CODIGO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>NRO. DOCUMENTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL BS</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL DESCUENTO BS</td
					<td style='font-weight:bold; border:1px solid #eee;'>ALMACEN</td>
					<td style='font-weight:bold; border:1px solid #eee;'>SUCURSAL</td>			
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
				</tr>");

		$venta = $oVenta->ReportVentas($_fi,$_ff,$_usuario,$_cliente);

		// echo "<pre>";
		// print_r($venta);
		// echo "<pre>";
		
		if ($venta != false) 
		{
			foreach ($venta as $key => $VT) 
			{
				echo utf8_decode("
				<table border='0'> 
					<tr> 
						<td style='border:1px solid #eee;'>".$VT->idVenta->GetValue()."</td> 
						<td style='border:1px solid #eee;'>".$VT->Cliente->zona->GetValue()."</td>
						<td style='border:1px solid #eee;'>".$VT->Cliente->direccion->GetValue()."</td>
						<td style='border:1px solid #eee;'>".$VT->Usuario->username->GetValue()."</td>
						<td style='border:1px solid #eee;'>");

						$detalle = $oDetalle->GetListDetalleVenta($VT->idVenta->GetValue());

						foreach ($detalle as $key => $CAN) 
						{
							echo utf8_decode($CAN->cantidad->GetValue()."<br>");
						}
						echo utf8_decode("</td><td style='border:1px solid #eee;'>");
						foreach ($detalle as $key => $PRO) 
						{
							echo utf8_decode($PRO->Producto->nombre->GetValue()." ".$PRO->Producto->Modelo->model->GetValue()."<br>");
						}
					echo utf8_decode("</td>
						<td style='border:1px solid #eee;'>".number_format($VT->monto_total->GetValue(),2)."</td>
						<td style='border:1px solid #eee;'>".number_format($VT->monto_descuento->GetValue(),2)."</td>
						<td style='border:1px solid #eee;'>".$VT->Almacen->sigla->GetValue()."</td>
						<td style='border:1px solid #eee;'>".$VT->Almacen->Sucursal->Nombre->GetValue()."</td>
						<td style='border:1px solid #eee;'>".$VT->fecha_hora->GetValue()."</td>

					</tr>");
				
			}
			return true;
		}
		else
		{
			echo utf8_decode("<tr><td colspan='11' style='border:1px solid #eee;'>No hay Datos</td></tr>");
			return false;
		}

	}
}

if (isset($_GET['fi'])) 
{
	$descarga = new Reportes_Control;
	$descarga -> descargarReporteVentas($_GET['fi'],$_GET['ff'],$_GET['u'],$_GET['c']);
}

?>