<?php


if (isset($_GET['term'])) 
{
    require_once("../model/conexion.php");
    $return_producto = array();
/* If connection to database, run sql statement. */
    if ($con) 
    {

        $fetch = mysqli_query($con, "SELECT t1.idProducto as t1_idProducto, t1.hash as t1_hash, t1.codigo as t1_codigo, t1.nombre as t1_nombre, t1.idModelo as t1_idModelo,t2.model as t2_descripcion, t1.pcompra as t1_pcompra, t1.pventa as t1_pventa FROM producto t1 INNER JOIN modelo t2 on t2.idModelo=t1.idModelo WHERE t1.nombre like '%".mysqli_real_escape_string($con, ($_GET['term']))."%' LIMIT 0 ,50"); 
    
    /* Retrieve and store in array the results of the query.*/
        while ($row = mysqli_fetch_array($fetch)) 
        {
            $codigo = $row['t1_codigo'];
            $nombre = $row['t1_nombre'];
            $co_y_nom = "".$nombre." Cod: ".$codigo."";
            $precioVenta = number_format($row['t1_pventa'],2);

            $idProducto = $row['t1_hash'];
            $row_array['value'] = $co_y_nom;
            $row_array['idproducto'] = $idProducto;
            $row_array['nombre'] = $row['t1_nombre'];
            $row_array['codigo'] = $row['t1_codigo'];
            $row_array['idmodelo'] = $row['t1_idModelo'];
            $row_array['modelo'] = $row['t2_descripcion'];
            $row_array['pcompra'] = $row['t1_pcompra'];
            $row_array['pventa'] = $precioVenta;
            array_push($return_producto, $row_array);
        }

    }

/* Free connection resources. */
    mysqli_close($con);

/* Toss back results as json encoded array. */
    echo json_encode($return_producto);

}

?>

