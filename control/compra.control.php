<?php  
/*==========================================
RECIVER DATOS DE AJAX
=============================================*/
session_start();
$contenido = "";


/*===========================================
RECIBIR DISTINTOS METODOS EJECUTADOS EN AJAX
=============================================*/
if(isset($_POST["fn"]))
{
    $fn = $_POST["fn"];

    switch ($fn) 
    {
        case 'AdicionarProductos':
            AdicionarProductos();
        break;
        case 'BorrarListaProductos':
            BorrarListaProductos();
        break;
        case 'SaveCompra':
            ProcesarCompra();
    break;
    }
}

function AdicionarProductos()
{
    $idproducto = $_POST['idproducto'];
    $nombre = $_POST['nombre'];
    $codigo = $_POST['codigo'];
    $idmodelo = $_POST['idmodelo'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    $lista_Productos = array();

    $existe = false;

    if( isset($_SESSION['lista_Productos']))
    {
        $lista_Productos = $_SESSION['lista_Productos'];

        for($i = 0; $i < count($lista_Productos); $i++)
        {
            if($lista_Productos[$i]['idproducto'] == $idproducto)
            {
                $existe = true;
                $lista_Productos[$i]['cantidad'] = $lista_Productos[$i]['cantidad'] + $cantidad;
            }
        }
    }
    
    if($existe == false)
    {
        $item = array("idproducto" => $idproducto, 
        "nombre" => $nombre, 
        "codigo" => $codigo, 
        "idmodelo" => $idmodelo,
        "modelo" => $modelo,
        "cantidad" => $cantidad,
        "precio" => $precio
    );

        $lista_Productos[] = $item;
    }

    $_SESSION['lista_Productos'] = $lista_Productos;

    $contenido = "

    <table class='table table-condensed bg-light-blue-gradient'>
        
        <tbody>

            <tr>

                <th>#</th>
                <th>Cod.</th>
                <th>Producto</th>
                <th>Cant.</th>
                <th>P.C.</th>
                <th>Sub total</th>
                <th> X </th>

            </tr>

    ";
    $c = 0;
    $total = 0;
    foreach($lista_Productos as $item)
    {
        $c++;
        $itemPrecio=$item['precio'];
        $itemCantidad=$item['cantidad'];

        $subTotal = $itemPrecio * $itemCantidad;
        $total += $subTotal;
        

        $contenido.= "
        
            <tr>
                <td><h6>".$c."</h6></td>
                <td><h6><strong>".$item['codigo']."</strong></h6></td>
                <td><h6><strong>".$item['nombre']." ".$item['modelo']."</h6></strong></td>
                <td><h6>".$itemCantidad."</h6></td>
                <td><h6>".number_format($itemPrecio,2)."</h6></td>
                <td><h6>".number_format($subTotal,2)."</h6></td>
                <td><h6><a href='#modalDeleteItemProducto' class='delete btn btn-xs btn-danger' data-toggle='modal'
                data-idproducto='".$item['idproducto']."'><i class='fa fa-trash-o'></i></a></h6></td>
            </tr>
        ";
    }

    $contenido.="
        
        <td class='text-right' colspan=5><strong>TOTAL Bs<strong></td>
        <td class=''><input type='hidden' name='compra_add_montototal' id='compra_add_montototal' value='".$total."'>".number_format($total,2)."</td>
        <td></td>
        
        ";
    $contenido.= "
        </tbody>
    </table>";
    
    echo $contenido;
}

function BorrarListaProductos()
{
    $_SESSION["lista_Productos"] = null;
    $_SESSION["TotalCompra"] = null;
    $contenido = "
    <table class='table table-resposible small'>
        
        <thead class='table-dark'>

            <tr>

                <th>#</th>
                <th>Cod.</th>
                <th>Producto</th>
                <th>Cant.</th>
                <th>P.C.</th>
                <th>Sub total</th>
                <th> X </th>

            </tr>

        </thead>

        <tbody>
            <tr><td colspan='6'>No hay nada en lista</td></tr>
        </tbody>
    </table>

    ";
    echo $contenido;
}
function ProcesarCompra()
{
    require_once ("../model/Empleado.Model.php");
    require_once ("../model/Compra.Model.php");
    require_once ("../model/DetalleCompra.Model.php");
    require_once ("../model/Inventario.Model.php");
    require_once ("../model/Producto.Model.php");
    
    date_default_timezone_set('America/La_Paz');

    /*=============================================================================

    RECOLECTANDO LOS DATOS DEL FORMULARIO DE COMPRAS

    ===============================================================================*/

    
    $idProveedor = $_POST["compra_add_idproveedor"];
    $nro_factura = $_POST["compra_add_nrofactura"];
    $fecha_compra = $_POST["compra_add_fechacompra"];
    $idAlmacen = $_POST["compra_add_almacen"];
    $monto_total = $_POST["compra_add_montototal"];
    $usuarioActivo = $_SESSION["ACL"]["usuario_activo"];
    $idUsuario = $usuarioActivo["idUsuario"];

    $fecha_ingreso = date("Y-m-d h:i:s");

    if($monto_total!="")
    {
        $oCompra_Model = new Compra_Model;
        $osCompra = new Structure_Compra;

        $osCompra->idCompra->SetValue(0);
        $osCompra->hash->SetValue("");
        $osCompra->fecha_ingreso->SetValue($fecha_ingreso);
        $osCompra->fecha_compra->SetValue($fecha_compra);
        $osCompra->idProveedor->SetValue($idProveedor);
        $osCompra->idUsuario->SetValue($idUsuario);
        $osCompra->monto_total->SetValue($monto_total);
        $osCompra->idAlmacen->SetValue($idAlmacen);
        $osCompra->nro_factura->SetValue($nro_factura);
        $osCompra->estado->SetValue("Activo");

        if (isset($_SESSION["lista_Productos"]))
        {
            $idCompra = $oCompra_Model->SaveCompra($osCompra);

            $lista = $_SESSION["lista_Productos"];
            $contador = 0;

            foreach($lista as $item)
            {
                $idProducto = $item["idproducto"];
                $cantidad = $item["cantidad"];
                $precio_compra = $item["precio"];

                $oProducto = new Producto_Model;

                $idProducto = $oProducto->GetProducto($idProducto);

                if($idProducto != false)
                {

                    $oDetalleCompra_Model = new DetalleCompra_Model;
                    $osDetalleCompra = new Structure_DetalleCompra;

                    $osDetalleCompra->idCompra->SetValue($idCompra);
                    $osDetalleCompra->idProducto->SetValue($idProducto);
                    $osDetalleCompra->cantidad->SetValue($cantidad);
                    $osDetalleCompra->precioCompra->SetValue($precio_compra);

                    $detalle = $oDetalleCompra_Model->Save($osDetalleCompra);

                    if($detalle == true)
                    {
                        $oInventario_Model = new Inventario_Model;
                        $osInventario = new Structure_Inventario;

                        $osInventario->idAlmacen->SetValue($idAlmacen);
                        $osInventario->idProducto->SetValue($idProducto);
                        $osInventario->stock->SetValue($cantidad);
                        $osInventario->estado->SetValue('Activo');

                        $stock = $oInventario_Model->Verifcar($osInventario);


                        if($stock != "Sin Stock")
                        {
                            //si es diferente de falso se hace update a stock en inventario
                            $osInventario->idAlmacen->SetValue($idAlmacen);
                            $osInventario->idProducto->SetValue($idProducto);
                            $osInventario->stock->SetValue($cantidad + $stock);// sumando
                            $osInventario->estado->SetValue('Activo');

                            $actualizar = $oInventario_Model->Update($osInventario);
                        }
                        else
                        {
                            //si es igual a falso se inserta
                            $insertar = $oInventario_Model->SaveInventario($osInventario);
                            $messages[] = "Se guardo con exito";
                        }
                    
                    }
                    else
                    {
                        $errors[]= "No se puedo guardar el detalle";
                    }
                }
                else
                {
                    $errors[]= "No corresponde a un idProducto Valido";
                }

                
            }

        }
        else
        {
            $errors[]= "Al menos debe de ingresar un producto al detalle";
        }


    }
    else
    {
        $errors[]= "Al menos debe de ingresar un producto al detalle";
    }
    if (isset($errors))
    {	
        
              echo '<script>

                    swal({

                        type: "error",
                        title: "¡La compra no se pudo guardar!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = "nueva-compra";

                        }

                    });
                

                    </script>';
        BorrarListaProductos();
    }
    if (isset($messages))
    {
        BorrarListaProductos();
        echo '<script>

            swal({

                type: "success",
                title: "¡La compra se guardo con exito!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"

            }).then(function(result){

                if(result.value){
                
                    window.location = "nueva-compra";

                }

            });
        

            </script>';
            
    
    }
       
}

?>

