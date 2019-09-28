<?php
if (isset($_GET['term'])) 
{
    require_once("../model/conexion.php");
    $return_arr = array();
/* If connection to database, run sql statement. */
    if ($con) 
    {

        $fetch = mysqli_query($con, "select `idProveedor`,  `nit`, `razon_social`, `contacto` from proveedor where `razon_social` like '%" . mysqli_real_escape_string($con, ($_GET['term'])) . "%' LIMIT 0 ,50"); 
	
	/* Retrieve and store in array the results of the query.*/
        while ($row = mysqli_fetch_array($fetch)) 
        {
            $razon_social = $row['razon_social'];
            $nit = $row['nit'];
            $ra_y_nit = "".$razon_social." Nit:".$nit."";

            $idProveedor = $row['idProveedor'];
            $row_array['value'] = $ra_y_nit;
            $row_array['idProveedor'] = $idProveedor;
            $row_array['nit'] = $row['nit'];
            $row_array['nombre'] = $row['razon_social'];
            $row_array['contacto'] = $row['contacto'];
            array_push($return_arr, $row_array);
        }

    }

/* Free connection resources. */
    mysqli_close($con);

/* Toss back results as json encoded array. */
    echo json_encode($return_arr);

}
?>