<?php
session_start();
//Validacion para ver si se esta con la session abierta
if (isset($_SESSION["ObjetosValidos"])) 
{
  $objetos = $_SESSION["ObjetosValidos"];

  $contador = 0;

  for ($i=0; $i < count($objetos); $i++) 
  { 
    if ($objetos[$i]=="lista-venta") 
    {
        $contador++;
      
    }
  }
  if ($contador==0) 
  { 
    echo '
        <script>

            alert("Estimado usuario no ah iniciado session en la pagina no tiene acceso para ver el contenido");

        </script>

    ';
      header('Location: ../');
      return;
  }
}
else
{
    echo '
        <script>

            alert("Estimado usuario no ah iniciado session en la pagina no tiene acceso para ver el contenido");

        </script>

    ';
    header('Location: ../');
    return;
}
//validacion para ver si se mando un parametro get
if (isset($_GET['mandante']) || $_GET['mandante']!="") 
{
    ImprimirFactura();
}
else
{
    echo 'No cuenta con los parametros de la Venta';
}


function ImprimirFactura()
{

require_once "../../model/Venta.Model.php";

$idVenta = $_GET['mandante'];

$oVenta_Model = new Venta_Model;

$Venta = $oVenta_Model->GetDataVenta($idVenta);

$Nit = '7828330017';
$nroAutorizacion = '307401800058753';
$codigoControl = "A8-1F-58-B4-D1";

foreach ($Venta as $key => $value) 
{
    //Datos de Venta
    $nroVenta = $value->idVenta->GetValue();
    $fechaNatural = $value->fecha_hora->GetValue();
    $fecha = strtotime($value->fecha_hora->GetValue());
    //fecha para mostar en forma literar
    setlocale(LC_ALL,"es_ES");
    $fecha = ucwords(strftime("%A %d de %B del %Y", $fecha));

    //Convertir fecha de formato(YYYY-dd-mm H:i:s) formato(dd/mm/YYYY)
    $fechahora=explode(" ", $fechaNatural);
 
    $Fecha=$fechahora[0];
    $hora = $fechahora[1];
     
    $Fecha1=explode("-", $Fecha);
 
    $fechaNatural = "".$Fecha1[2]."/".$Fecha1[1]."/".$Fecha1[0]."";

    //Datos de Sucursal
    $idSucursal = $value->Almacen->Sucursal->idSucursal->GetValue();
    $Sucursal = $value->Almacen->Sucursal->Nombre->GetValue();
    $Direccion = $value->Almacen->Sucursal->Direccion->GetValue();

    //Datos del Cliente
    $idCliente = $value->Cliente->idCliente->GetValue();
    $Cliente = $value->Cliente->direccion->GetValue();
    $nroDocumento = $value->Cliente->zona->GetValue();

    //Datos del Usuario
    $username = $value->Usuario->username->GetValue();
}

//Instanciamos la clase a TCPDF
require_once('tcpdf_include.php');

//Creando el documento en pdf
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// Remover por defecto header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

//NUevo grupo de Páginas
$pdf->startPageGroup();

//Una nueva pagina
$pdf->AddPage();

//$pdf->Image('images/02.png', 8, 8, 40, '', '', '', '', false, 300);

//Bloque 1 de contenido HTML
$cabecera = <<<EOF

<table>
    <tr>
        <td style="width: 540px"></td>
    </tr>
</table>

<table>   
    <tr>
        <td style="width:120px; line-height:20px;">
            <img src="images/18.png">
        </td>

        <td style="background-color:white; width:170px">    
            <div style="font-size:7.5px; text-align:light; line-height:9px;"> 
                <br>
            SUCURSAL: $idSucursal - $Sucursal - 
            <BR>
            $Direccion
            </div>
            <div style="font-family: 'Times New Roman', Times, serif; font-size:12.5px; text-align:right; line-height:20px;">
                <br>
                FACTURA
            </div>
        </td>

        <td style="background-color:white; width:90px">            
            
        </td>

        <td style="background-color:white; width:160px; text-align:light; color:blue">
            <br>
            <br>
            NIT: $Nit       
            <div style="font-size:6.5px; text-align:light; color:black; line-height:10px;">
                
                <br>
                FACTURA: $nroVenta
                <br>
                AUTORIZACION: $nroAutorizacion

            </div>         
        </td>
    </tr>
</table>

EOF;

//Escribiendo lo del enmaquetado de HTML en el bloque 1
$pdf->writeHTML($cabecera,true,false,false,false,'');

$datos = <<<EOF
<table cellspacing="0" cellpadding="1" border="0" style="width:100%; font-family: 'Times New Roman', Times, serif; font-size:9.5px;">
  <tr>
    <th style="width: 70px; font-weight: bold;">Lugar y Fecha:</th>
    <th style="width: 470px;">Santa Cruz, $fecha</th>
  </tr>
  <tr>
    <th style="width: 60px; font-weight: bold;">Señor (es):</th>
    <th style="width: 300px;">$Cliente</th>
    <th style="width: 60px; font-weight: bold;">N.I.T / CI:</th>
    <th style="width: 120px;">$nroDocumento</th>
  </tr>
  <tr>
    <th style="width: 70px; font-weight: bold;">Cod. Cliente:</th>
    <th style="width: 290px;">$idCliente</th>
    <th style="width: 60px; font-weight: bold;">Vendedor:</th>
    <th style="width: 120px;">$username</th>
  </tr>
</table>

EOF;

$pdf->writeHTML($datos,true,false,false,false,'');


$datos1 = <<<EOF
<table cellspacing="0" cellpadding="1" border="0" style="width:100%; font-family: 'Times New Roman', Times, serif; font-size:10.5px; font-weight: bold;">
  <tr>
    <th style="width: 40px;">Cod.</th>
    <th style="width: 34px;">Cant.</th>
    <th style="width: 246px;">Concepto</th> 
    <th style="width: 108px; text-align:right">Precio</th>
    <th style="width: 54px; text-align:right">% Dto</th>
    <th style="width: 58px; text-align:right">Sub Total</th>
  </tr>
</table>

EOF;

$pdf->writeHTML($datos1,true,false,false,false,'');

require_once "../../model/DetalleVenta.Model.php";

$oDetalleVenta_Model = new DetalleVenta_Model;

$detalle = $oDetalleVenta_Model-> GetListDetalleVenta($nroVenta);


$total = 0;
$total_descuento = 0;
foreach ($detalle as $key => $items) 
{

$codigo = $items->Producto->codigo->GetValue();
$cantidad = $items->cantidad->GetValue();
$Concepto = "".$items->Producto->nombre->GetValue()." ".$items->Producto->Modelo->model->GetValue()."";
$precio = $items->precio->GetValue();
$descuento = $items->descuento->GetValue();
$descuento_porcentaje = $items->descuento_porcentaje->GetValue();

//Para Mostrar en la Tabla
$Precio = number_format($precio,2);
$Descuento = number_format($descuento,2);

//OPERACIONES MATEMATICAS
$subtotal = $cantidad * $precio;

$descontado = $subtotal * $descuento_porcentaje;

$subtotal = $subtotal - $descontado;

$SubTotal = number_format($subtotal,2);

$total += $subtotal;

$Total = number_format($total,2);

$total_descuento += $descontado;

$Total_Descuento = number_format($total_descuento,2);

$total_literal = number_format($total, 2, '.', '');



$bloque4 = <<<EOF
<table cellspacing="0" cellpadding="0" border="0" style="width:100%; font-family: 'Times New Roman', Times, serif; font-size:8.5px; ">
  <tr>
    <th style="width: 40px; ">$codigo</th>
    <th style="width: 34px; ">$cantidad</th>
    <th style="width: 246px;">$Concepto</th> 
    <th style="width: 108px; text-align:right">$Precio</th>
    <th style="width: 54px; text-align:right">$Descuento</th>
    <th style="width: 58px; text-align:right">$SubTotal</th>
  </tr>
</table>
EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}
require_once "../../model/Utilitario.Model.php";

$oUtilitario_model = new Utilitario_Model;

$literal = $oUtilitario_model->num2letras($total_literal);

$datos2 = <<<EOF

<table>
    <tr>
        <td style="width: 540px"></td>
    </tr>
</table>

<table cellspacing="0" cellpadding="0" border="0" style="width:100%; font-family: 'Times New Roman', Times, serif; font-size:8.5px; line-height:10px;">
  <tr>
    <th style="width: 40px; "></th>
    <th style="width: 34px; "></th>
    <th style="width: 246px;"></th> 
    <th style="width: 108px; text-align:right; font-weight: bold;">Total Descuento:</th>
    <th style="width: 54px; text-align:right"></th>
    <th style="width: 58px; text-align:right">$Total_Descuento</th>
  </tr>
  <tr>
    <th style="width: 40px; "></th>
    <th style="width: 34px; "></th>
    <th style="width: 246px;"></th> 
    <th style="width: 108px; text-align:right; font-weight: bold;">Total Bs:</th>
    <th style="width: 54px; text-align:right"></th>
    <th style="width: 58px; text-align:right">$Total</th>
  </tr>
  <tr>
    <th style="width: 40px; font-weight: bold;">Son: </th>
    <th style="width: 500px;">$literal</th>
  </tr>
</table>
EOF;

$pdf->writeHTML($datos2, false, false, false, false, '');

// set style for barcode
$estiloQR = array(
    'border' => 0,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);

$code = ''.$Nit.'|'.$nroVenta.'|'.$nroAutorizacion.'|'.$fechaNatural.'|'.$total_literal.'|'.$total_literal.'|'.$codigoControl.'|'.$nroDocumento.'';
// QRCODE,H : QR-CODE Best error correction
$pdf->write2DBarcode($code, 'QRCODE,H', 10, 230, 40, 40, $estiloQR, 'N');
$pdf->Text(20, 205, '');


// forzar el dialogo de impresion
$js = 'print(true);';

// incluyendo funcion javascript
$pdf->IncludeJS($js);

//Instrucción de Salida del Archivo
$pdf->Output('Factura nro.pdf', 'I');

}

?>
