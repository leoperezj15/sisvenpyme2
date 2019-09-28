<?php
session_start();
$contenido = "";

if(isset($_POST["fn"]))
{
    $fn = $_POST["fn"];
    switch ($fn) {
        case 'AddItem':
            addItem();
        break;
        case 'DeleteListItems':
            DeleteListItems();
        break;
        case 'SaveVenta':
            ProcesarVenta();
        break;

        case 'DeleteItem':
            DeleteItem();
        break;
        case 'VerificarStock':
            VerificarStock();
        break;
    }
}

function VerificarStock()
{
    require_once ("../model/Producto.Model.php");
    require_once ("../model/Inventario.Model.php");

    //RECOLECTANDO VAROBLES PARA VERIFICAR EL STOCK
    $idAlmacen = $_POST["idAlmacen"];
    $idProducto = $_POST["idProducto"];
    $cantidad = $_POST["cantidad"];


    $oProducto = new Producto_Model;
    //Verificando que id de prodcto es a partir del hash que hay en la lista venta como id producto
    $idProducto = $oProducto->GetProducto($idProducto);

    if ($idProducto != false) 
    {
        $oInventario_Model = new Inventario_Model;
        $osInventario = new Structure_Inventario;

        //adjuntando datos a la estructura de Inventario para realizar el descuento
        $osInventario->idAlmacen->SetValue($idAlmacen);
        $osInventario->idProducto->SetValue($idProducto);
        $osInventario->stock->SetValue($cantidad);
        $osInventario->estado->SetValue('Activo');

        $resultado = $oInventario_Model->Verifcar($osInventario);
        // echo "<pre>";
        // print_r("idAlmacen =".$idAlmacen." idProducto = ".$idProducto." cantidad = ".$cantidad." resultado = ".$resultado);
        // echo "</pre>";

        if($resultado != "Sin Stock")
        {
            if ($resultado >= $cantidad) 
            {

                $contenido = "si|".$resultado."";


            }
            else
            {
                $contenido = "Solo quedan estas Unidades|".$resultado."";

            }
            
        }
        else
        {
            //si es igual a falso se inserta
            $contenido = "Sin Stock|0";
        }
    }
    else
    {
        $contenido = "No coresponde a un Producto|0";
    }

    echo $contenido;

    
}

function addItem()
{
    $idProducto = $_POST['idProducto'];
    $nombre = $_POST['nombre'];
    $codigo = $_POST['codigo'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $descuento_porcentaje = $_POST['descuento'];
    $cantidad = $_POST['cantidad'];
    $stock = $_POST["stock"];

    $porcentaje = 0.00;
    if ($descuento_porcentaje != "SD") 
    {
        $porcentaje = substr($descuento_porcentaje, 2);
    }
    

    $lista = array();

    $existe = false;

    if( isset($_SESSION['listaVenta']))
    {
        $lista = $_SESSION['listaVenta'];

        for($i = 0; $i < count($lista); $i++)
        {
            if($lista[$i]['idProducto'] == $idProducto)
            {
                $existe = true;

                $sum_can = $lista[$i]['cantidad'] + $cantidad;
                if ($stock >= $sum_can) 
                {
                    $lista[$i]['cantidad'] = $lista[$i]['cantidad'] + $cantidad;
                    $lista[$i]['descuento_porcentaje'] = $descuento_porcentaje;
                    $lista[$i]['porcentaje'] = $porcentaje;                    
                }
                
            }
        }
    }
    $descuento_sub = 0;
    if($existe == false)
    {
        
        $item = array("idProducto" => $idProducto, 
        "nombre" => $nombre, 
        "codigo" => $codigo, 
        "modelo" => $modelo,
        "cantidad" => $cantidad,
        "precio" => $precio,
        "porcentaje" => $porcentaje,
        "descuento_porcentaje" => $descuento_porcentaje
        );

        $lista[] = $item;
    }

    $_SESSION['listaVenta'] = $lista;

    $contenido = "
    <table class='table table-responsible small'>
        
        <thead class='table-dark'>

            <tr>

                <th>#</th>
                <th>Codigo</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>%</th>
                <th>Descuento</th>
                <th>Sub total</th>
                <th>Quitar</th>

            </tr>

        </thead>

        <tbody>

    ";
    $c = 0;
    $total = 0;
    $total_descuento = 0;
    foreach($lista as $item)
    {
        $c++;
        $itemPrecio=$item['precio'];
        $itemCantidad=$item['cantidad'];
        $itemPorcntje = $item['porcentaje'];
        $itemPorcentaje=$item['descuento_porcentaje'];
        $idProducto = "'".$item['idProducto']."'";

        if($itemPorcentaje=="SD")
        {
            $itemPorcentaje = 0.00;
        }

        $subTotal = $itemPrecio * $itemCantidad;

        $descontado = $subTotal * $itemPorcentaje;

        $subTotal = $subTotal - $descontado;

        $total += $subTotal;

        $total_descuento += $descontado;
        

        $contenido.= '
        
            <tr>
                <td>'.$c.'</td>
                    <td><strong>'.$item["codigo"].'</strong></td>
                    <td><strong>'.$item["nombre"].' '.$item['modelo'].'</strong></td>
                    <td>'.$itemCantidad.'</td>
                    <td>'.number_format($itemPrecio,2).'</td>
                    <td>'.number_format($itemPorcntje,2).'</td>
                    <td>'.number_format($descontado,2).'</td>
                    <td>'.number_format($subTotal,2).'</td>
                    <td><button onclick="deleteItem('.$idProducto.');" class="btn btn-danger btn-xs"><i class="fa fa-minus-circle"></i></button>
                    </td>
            </tr>
        ';
        

    }
    $contenido.="
        <tr>
        <td class='text-right' colspan=7><strong>TOTAL Bs<strong></td>
        <td class=''><input type='hidden' name='venta_add_montototal' id='venta_add_montototal' value='".$total."'>".number_format($total,2)."</td>
        <td></td>
        </tr>

        <tr>
        <td class='text-right' colspan=7><strong>TOTAL Descuento Bs<strong></td>
        <td class=''><input type='hidden' name='venta_add_montototal_descuento' id='venta_add_montototal_descuento' value='".$total_descuento."'>".number_format($total_descuento,2)."</td>
        <td></td>
        </tr>
        
        ";
    $contenido.= "
        </tbody>
    </table>";
    
    echo $contenido;
}


function DeleteListItems()
{
    $id = "Eliminar";

    if (isset($_POST['id'])) 
    {
        $id = $_POST['id'];
    }
    
    if ($id == "Eliminar") 
    {
        $_SESSION["listaVenta"] = null;

        $contenido = "
              <table class='table' id='ctn-items'> 
                <thead class='table-dark'>
                  <tr>
                      <th>#</th>
                      <th>Codigo</th>
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>%</th>
                      <th>Descuento</th>
                      <th>Sub total</th>
                      <th>Quitar</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                      <td class='text-right' colspan=7><strong>TOTAL Bs<strong></td>
                      <td class=''><input type='hidden' name='venta_add_montototal' id='venta_add_montototal' value='0'>0.00</td>
                      <td></td>
                  </tr>

                  <tr>
                      <td class='text-right' colspan=7><strong>TOTAL Descuento Bs<strong></td>
                      <td class=''><input type='hidden' name='venta_add_montototal_descuento' id='venta_add_montototal_descuento' value='0'>0.00</td>
                      <td></td>
                  </tr>
                </tbody>
              </table>";
            echo $contenido;
    }
    
}

function DeleteItem()
{
    /*=======================================================
        VERIFICAMOS QUE EXISTA SESSION DE LISTA VENTA
    ========================================================*/
    if (isset($_POST["id"])&& $_POST["id"]!= "") 
    {
        /*=======================================================
        CAPTURAMOS EL ID DE PRODUCTO A QUITAR
        ========================================================*/
        $id = $_POST["id"];

        if( isset($_SESSION['listaVenta']))
        {
            $lista = $_SESSION['listaVenta'];

            //REALIZAMOS UN RECORRIDO POR EL INDICE DE LOS PRODUCTOS EN LA LISTA

            for($i = 0; $i < count($lista); $i++)
            {
                if($lista[$i]['idProducto'] == $id)
                {
                    //PRODUCTO ENCONTRADO CON EL INDICE Y EL ID DE PRODUCTO SE QUITA
                    unset($_SESSION['listaVenta'][$i]);

                }
            }
        }
        /*=======================================================
        HACEMOS RECORRER DE NUEVO LA LISTA DE VENTA CON EL INDICE DESDE 0
        ========================================================*/

        $indice = array();

        if (isset($_SESSION['listaVenta'])) 
        {
            $newLista = $_SESSION['listaVenta'];

            foreach ($newLista as $item) 
            {
                $indice[] = $item;
            }
        }


        /*=======================================================
        BORRAMOS LO QUE TENIA LISTA VENTA Y REEMPLAZAMOS CON EL RECORRIDO REALIZADO
        ========================================================*/
        unset($_SESSION["listaVenta"]);

        $_SESSION["listaVenta"] = $indice;


        //Si despues que se quito todo los productos de la lista se comprueba que no exite nada se imprime un listado vacio 
        if (empty($_SESSION["listaVenta"])) 
        {
            $contenido = "
              <table class='table' id='ctn-items'> 
                <thead class='table-dark'>
                  <tr>
                      <th>#</th>
                      <th>Codigo</th>
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>%</th>
                      <th>Descuento</th>
                      <th>Sub total</th>
                      <th>Quitar</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                      <td class='text-right' colspan=7><strong>TOTAL Bs<strong></td>
                      <td class=''><input type='hidden' name='venta_add_montototal' id='venta_add_montototal' value='0'>0.00</td>
                      <td></td>
                  </tr>

                  <tr>
                      <td class='text-right' colspan=7><strong>TOTAL Descuento Bs<strong></td>
                      <td class=''><input type='hidden' name='venta_add_montototal_descuento' id='venta_add_montototal_descuento' value='0'>0.00</td>
                      <td></td>
                  </tr>
                </tbody>
              </table>";
            echo $contenido;
        }
        else
        {
            /*=======================================================
                SE REALIZA EL RECORRIDO DE LISTA PRODUCTO DE LO QUE QUEDO PARA LUEGO MOSTRAR EN LA VISTA
            ========================================================*/
            if (isset($_SESSION["listaVenta"]) && $_SESSION["listaVenta"]!= "")
            {
                
                $lista = $_SESSION['listaVenta'];

                $contenido = "
                <table class='table table-responsible small'>
                    
                    <thead class='table-dark'>

                        <tr>

                            <th>#</th>
                            <th>Codigo</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>%</th>
                            <th>Descuento</th>
                            <th>Sub total</th>
                            <th>Quitar</th>

                        </tr>

                    </thead>

                    <tbody>

                ";
                /*=======================================================
                SE DECLARAN VARIABLES AUXILIARES Y SE REALIZA LOS CALCULOS MATEMATICOS
                ========================================================*/

                $c = 0;
                $total = 0;
                $total_descuento = 0;
                foreach($lista as $item)
                {
                    $c++;
                    $itemPrecio=$item['precio'];
                    $itemCantidad=$item['cantidad'];
                    $itemPorcntje = $item['porcentaje'];
                    $itemPorcentaje=$item['descuento_porcentaje'];
                    $idProducto = "'".$item['idProducto']."'";

                    //SE VERIFICA SI NO SE HA HECHO UN DESCUENDO PARA APLICAR 0.00

                    if($itemPorcentaje=="SD")
                    {
                        $itemPorcentaje = 0.00;
                    }

                    $subTotal = $itemPrecio * $itemCantidad;

                    $descontado = $subTotal * $itemPorcentaje;

                    $subTotal = $subTotal - $descontado;

                    $total += $subTotal;

                    $total_descuento += $descontado;
                    

                    $contenido.= '
                    
                        <tr>
                            <td>'.$c.'</td>
                            <td><strong>'.$item["codigo"].'</strong></td>
                            <td><strong>'.$item["nombre"].' '.$item['modelo'].'</strong></td>
                            <td>'.$itemCantidad.'</td>
                            <td>'.number_format($itemPrecio,2).'</td>
                            <td>'.number_format($itemPorcntje,2).'</td>
                            <td>'.number_format($descontado,2).'</td>
                            <td>'.number_format($subTotal,2).'</td>
                            <td><button onclick="deleteItem('.$idProducto.');" class="btn btn-danger btn-xs"><i class="fa fa-minus-circle"></i></button>
                            </td>
                        </tr>
                    ';
                    
                }

                $contenido.="
                    <tr>
                        <td class='text-right' colspan=7><strong>TOTAL Bs<strong></td>
                        <td class=''><input type='hidden' name='venta_add_montototal' id='venta_add_montototal' value='".$total."'>".number_format($total,2)."</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td class='text-right' colspan=7><strong>TOTAL Descuento Bs<strong></td>
                        <td class=''><input type='hidden' name='venta_add_montototal_descuento' id='venta_add_montototal_descuento' value='".$total_descuento."'>".number_format($total_descuento,2)."</td>
                        <td></td>
                    </tr>
                    
                    ";
                $contenido.= "
                    </tbody>
                </table>";
                
                echo $contenido;
                
            }
            else
            {
                $contenido = "
                    <table class='table table-resposible small'>
                        
                        <thead class='table-dark'>

                            <tr>

                                <th>#</th>
                                <th>Codigo</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Descuento</th>
                                <th>Sub total</th>
                                <th>Quitar</th>

                            </tr>

                        </thead>

                        <tbody>
                            <tr><td colspan='6'>No hay nada en lista</td></tr>
                        </tbody>
                    </table>

                    ";
                echo $contenido;

            }

        }



    }
    

}
function ProcesarVenta()
{
    require_once ("../model/Usuario.Model.php");
    require_once ("../model/Venta.Model.php");
    require_once ("../model/DetalleVenta.Model.php");
    require_once ("../model/Inventario.Model.php");
    require_once ("../model/Producto.Model.php");
    require_once ("../model/Cliente.Model.php");
    
    // echo "<pre>";
    // print_r($_POST);
    // echo "<pre>";
    date_default_timezone_set('America/La_Paz');

    /*===========================================================================
    RECOLECTANDO LAS VARIABLES POST
    =============================================================================*/
    $monto_total = 0.00;
    $monto_descuento = 0.00;
    //elementos enviados desde la vista
    $idCliente = $_POST["idCliente"];
    $idAlmacen = $_POST["idAlmacen"];
    $monto_total = $_POST["Monto_Total"];
    $monto_descuento = $_POST["Monto_Total_Descuento"];

    //recoletacndo de la variabvle de session
    $usuarioActivo = $_SESSION["ACL"]["usuario_activo"];
    $idUsuario = $usuarioActivo["idUsuario"];

    //recolectando la fecha del sistemas segun el uso horario
    $fecha_hora= date("Y-m-d h:i:s");
    //Instaciamos hacia el Modelo de Cliente
    $oCliente = new Cliente_Model;
    //Verficamos si existe el hash en una id de Cliente
    $idCliente = $oCliente->GetCliente($idCliente);

    if ($idCliente == false) 
    {
        echo "
        <script>
            swal({
                position: 'top',
                type: 'error',
                title: 'El id de Cliente no coresponde a uno válido',
                showConfirmButton: false,
                timer: 1500
            });
        </script>";
        return;
        
    }

    //haciendo prueba de lo que recive de ajax post CON RUEDITAS
    // echo "<pre>";
    // print_r($_POST);
    // print_r($_SESSION["listaVenta"]);
    // print_r("idCliente = ".$idCliente);
    // echo "</pre>";

    //Verificando si exite algun producto en la lista
    if (isset($_POST["Monto_Total"]) && $monto_total==0) 
    {
        echo "
        <script>
            swal({
                position: 'top',
                type: 'error',
                title: 'No exite ningun producto para vender',
                showConfirmButton: false,
                timer: 1500
            });
        </script>";
        return;
        
    }

    if($monto_total!="")
    {
        //Instanciando hacia el Modelo de Ventas
        $oVenta_Model = new Venta_Model;
        //Instanciando hacia las Estrucutura de Ventas
        $osVenta = new Structure_Venta;
        
        //adjuntando variable a la estructura para enviar al modelo Ventas
        $osVenta->idVenta->SetValue(0);
        $osVenta->hash->SetValue("");
        $osVenta->idCliente->SetValue($idCliente);
        $osVenta->idUsuario->SetValue($idUsuario);
        $osVenta->idAlmacen->SetValue($idAlmacen);
        $osVenta->fecha_hora->SetValue($fecha_hora);
        $osVenta->monto_total->SetValue($monto_total);
        $osVenta->monto_descuento->SetValue($monto_descuento);
        $osVenta->estado->SetValue('Facturado');

        //Verificando que exita la session de lista Venta
        if (isset($_SESSION["listaVenta"]))
        {
            //Se procede a guardar la venta y devuelve ID VENTA para porceder a guardar 
            //los detalles de la venta
            $idVenta = $oVenta_Model->SaveVenta($osVenta);
            //obteniendo datos de session de lista venta
            $listaVenta = $_SESSION["listaVenta"];
            $contador = 0;
            //realisando el recorrido de listaVenta
            foreach($listaVenta as $item)
            {
                //recolectando variables por cada indice
                $idProducto = $item["idProducto"];
                $cantidad = $item["cantidad"];
                $precio = $item["precio"];
                $itemPorcntje = $item['porcentaje'];
                $descuento_porcentaje = $item["descuento_porcentaje"];
                //Instanciando al Modelo de Productos
                $oProducto = new Producto_Model;
                //Verificando que id de prodcto es a partir del hash que hay en la lista venta como id producto
                $idProducto = $oProducto->GetProducto($idProducto);

                if ($idProducto != false) 
                {
                   if($descuento_porcentaje == "SD")
                    {
                        $descuento_porcentaje = 0.00;
                    }
                    //instanciando al modelo de detalle de venta y su estructura
                    $oDetalleVenta_Model = new DetalleVenta_Model;
                    $osDetalleVenta = new Structure_DetalleVenta;
                    //adjuntando al objeto estructura de Detalle Venta
                    $osDetalleVenta->idProducto->SetValue($idProducto);
                    $osDetalleVenta->idVenta->SetValue($idVenta);
                    $osDetalleVenta->cantidad->SetValue($cantidad);
                    $osDetalleVenta->precio->SetValue($precio);
                    $osDetalleVenta->descuento->SetValue($itemPorcntje);
                    $osDetalleVenta->descuento_porcentaje->SetValue($descuento_porcentaje);
                    //Guardando lo que tiene la estructura y devolviendo un detalle en bool
                    $detalle = $oDetalleVenta_Model->SaveDetalleVenta($osDetalleVenta);
                    //Si la insercion de Detalle es corecto se procede a descontar el inventario de productos por almacen
                    if($detalle == true)
                    {
                        $oInventario_Model = new Inventario_Model;
                        $osInventario = new Structure_Inventario;

                        //adjuntando datos a la estructura de Inventario para realizar el descuento
                        $osInventario->idAlmacen->SetValue($idAlmacen);
                        $osInventario->idProducto->SetValue($idProducto);
                        $osInventario->stock->SetValue($cantidad);
                        $osInventario->estado->SetValue('Activo');

                        $resultado = $oInventario_Model->Verifcar($osInventario);

                        if($resultado != "Sin Stock" && $resultado > 0)
                        {
                            //si es diferente de falso se hace update a stock en inventario
                            $resultado = $resultado - $cantidad;

                            if ($resultado != 0) 
                            {
                                $osInventario->idAlmacen->SetValue($idAlmacen);
                                $osInventario->idProducto->SetValue($idProducto);
                                $osInventario->stock->SetValue($resultado - $cantidad);// restando
                                $osInventario->estado->SetValue('Sin Stock');

                                $actualizar = $oInventario_Model->Update($osInventario);
                                if($actualizar)
                                {
                                    $messages[] = "Venta exitosa! Su # de Venta es: ".$idVenta;
                                    DeleteListItems();
                                }
                            }
                            else
                            {
                                $osInventario->idAlmacen->SetValue($idAlmacen);
                                $osInventario->idProducto->SetValue($idProducto);
                                $osInventario->stock->SetValue($resultado - $cantidad);// restando
                                $osInventario->estado->SetValue('Sin Stock');

                                $actualizar = $oInventario_Model->Update($osInventario);
                                if($actualizar)
                                {
                                    $messages[] = "Venta exitosa! Su # de Venta es: ".$idVenta;
                                    DeleteListItems();
                                }

                            }                            
                        }
                        else
                        {
                            //si es igual a falso se inserta
                            $errors[] = "El producto ".$idProducto." no se puede vender por falta de Stock";
                        }
                    
                    }
                    else
                    {
                        $errors[]= "No se puedo guardar el detalle";
                    }
                }
                else
                {
                    $errors[]= "No corresponde a un idProducto Válido";
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
        ?>
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error!</strong> 
                <?php
                
                foreach ($errors as $error) 
                {
                    echo $error;
                }
                ?>
        </div>
        <?php
    }
    if (isset($messages))
    {
            
    ?>
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>¡Bien hecho!</strong>
        <?php
            foreach ($messages as $message) {
                    echo $message;
                }
            ?>
    </div>
    <?php
    }
       
}

// echo '<pre>';
        // print_r($indice);
        // echo '<pre>';
        // return;

?>