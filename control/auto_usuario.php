<?php


if (isset($_GET['term'])) 
{
    require_once("../model/conexion.php");
    $return_usuario = array();
/* If connection to database, run sql statement. */
    if ($con) 
    {
        $fetch = mysqli_query($con, "SELECT
            t1.idusuario as t1_idUsuario,t1.hash as t1_hash,t1.username as t1_username,concat(t2.nombre,' ',t2.a_paterno,' ',t2.a_materno) as t2_empleado FROM `usuario` t1 INNER JOIN `empleado` t2 on t1.idEmpleado = t2.idEmpleado WHERE t2.nombre like '%".mysqli_real_escape_string($con, ($_GET['term']))."%' LIMIT 0 ,50"); 
    
    /* Retrieve and store in array the results of the query.*/
        while ($row = mysqli_fetch_array($fetch)) 
        {
            $idusuario = $row['t1_hash'];
            $username = $row['t1_username'];
            $empleado = $row['t2_empleado'];
            $usu_y_emple = "".$empleado." => ".$username."";

            $row_array['value'] = $usu_y_emple;
            $row_array['idusuario'] = $idusuario;
            $row_array['username'] = $username;

            array_push($return_usuario, $row_array);
        }

    }

/* Free connection resources. */
    mysqli_close($con);

/* Toss back results as json encoded array. */
    echo json_encode($return_usuario);

}

?>

