<?php

if (isset($_SESSION["ObjetosValidos"])) 
{
  $objetos = $_SESSION["ObjetosValidos"];

  $contador = 0;

  for ($i=0; $i < count($objetos); $i++) 
  { 
    if ($objetos[$i]=="reportes") 
    {
        $contador++;
      
    }
  }
  if ($contador==0) 
  {
      include "505.php";
      return;
  }
}

?>

<div class="content-wrapper">

  <section class="content-header">

  <h1>

    Panel de Reportes

    <small>Gestionar Reportes</small>

  </h1>

  <ol class="breadcrumb">

    <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

    <li class="active">Reportes</li>

  </ol>

  </section>

  <!-- Seccion del Contenido -->

  <section class="content">

    <div id="resultados"></div>

    <div class="row">

      <div class="col-md-12">
      <?php

        include "reportes/reporte_de_ventas.php";

      ?>

      </div>

    </div>
      
  </section>

</div>

<!-- Para incluir Reportes -->
<script src="view/js/reportes.js"></script>