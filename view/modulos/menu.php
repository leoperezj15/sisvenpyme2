<?php

/**
 * @author      Leonardo Perez Justiniano
 * @copyright   2018
 */
$pagina = isset($_GET['mnu']) ? strtolower($_GET['mnu']) : 'inicio';


if ( !isset($_SESSION["ACL"]) )
{
    header("location: index.php");
}

$ACL = $_SESSION["ACL"];

$rol = $ACL["nombre"];

$listaModulos = $ACL["listaModulos"];

$content = "



        
      ";
$i = 0;
foreach($listaModulos as $item)
{
    $i++; 

    $modulo = $item["nombre"];

    $icono = $item["icono"];

    $listaObjetos   = $item["listaObjetos"];

    $cad2 = "";

    $content .= "

        <li class='treeview'>

            <a href='#'>

                <i class='". $icono ." text-aqua'></i>

                <span>". $modulo ."</span>

                <span class='pull-right-container'>

                    <i class='fa fa-angle-left pull-right'></i>

                </span>

            </a>

            <ul class='treeview-menu'>

        ";

    if ($i > 1)
    {
        $content .= "";
    }

    foreach($listaObjetos as $item2)
    {   
        $objeto = $item2["nombre"];

        $nombreControl = $item2["nombreControl"];
        //if ($cad2 != "") $cad2 .= "";//quitando <br>
        $cad2 .= "

                <li>

                    <a href='".$nombreControl."' id='".$nombreControl."'> 

                        <i class='fa fa-square-o'></i>

                        <span>". $objeto ."</span>

                    </a>

                </li>            

                ";
        
    }

    $content .= "".$cad2."
            </ul>

        </li>

    ";
}

$content .= "

            
";
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <ul class="sidebar-menu">

            <li class="header">MENU DE NAVEGACION</li>

            <li class="<?php echo $pagina == 'inicio' ? 'active' : ''; ?>">

                <a href="inicio" id="inicio">

                    <i class="fa fa-home"></i>

                    <span>Inicio</span>

                </a>

            </li>

            <?php

            echo $content;

            ?>

        </ul>

    </section>

</aside>