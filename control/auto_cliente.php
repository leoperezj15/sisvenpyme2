
<?php
if (isset($_GET['term'])) {
    require_once("../model/conexion.php");
    $return_arr = array();
/* If connection to database, run sql statement. */
    if ($con) {
 
        $fetch = mysqli_query($con, "SELECT * from (
            SELECT t1.hash AS idCliente,
            CONCAT(t2.nombre, ' ',t2.ap_paterno, ' ' , t2.ap_materno) AS NombreCompleto, 
            t2.ci As NroDocumento , 
            t1.direccion Direccion, 
            'NATURAL' AS tipoCliente 
            FROM `cliente` t1
            INNER JOIN `cliente_natural` t2 on t1.idCliente = t2.idCliente
            WHERE t1.estado = 'Activo'
            UNION
            SELECT t4.hash AS idCliente, 
            t3.razon_social AS NombreCompleto, 
            t3.nit As NroDocumento , 
            t4.direccion AS Direccion, 
            'JURIDICO' AS tipoCliente 
            FROM `cliente` t4
            INNER JOIN `cliente_juridico` t3 on t4.idCliente = t3.idCliente
            WHERE t4.estado = 'Activo'
            ORDER BY `idCliente` ASC) AS ClienteGeneral
            WHERE ClienteGeneral.NombreCompleto LIKE '%".mysqli_real_escape_string($con, ($_GET['term']))."%' LIMIT 0,1000");
	/* Retrieve and store in array the results of the query.*/
        while ($row = mysqli_fetch_array($fetch)) {

            $nombre_completo = "".$row['NombreCompleto']." Nro. Doc: ".$row['NroDocumento']."";
            $idCliente = $row['idCliente'];
            $row_array['value'] = $nombre_completo;
            $row_array['idCliente'] = $idCliente;
            $row_array['nombre'] = $row['NombreCompleto'];
            $row_array['nrodocumento'] = $row['NroDocumento'];
            $row_array['direccion'] = $row['Direccion'];
            array_push($return_arr, $row_array);
        }

    }

/* Free connection resources. */
    mysqli_close($con);

/* Toss back results as json encoded array. */
    echo json_encode($return_arr);

}
?>