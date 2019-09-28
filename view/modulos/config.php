<?php 

/**



*/

// if (isset($_SESSION["ObjetosValidos"])) 
// {
//   $objetos = $_SESSION["ObjetosValidos"];

//   $contador = 0;

//   for ($i=0; $i < count($objetos); $i++) 
//   { 
//     if ($objetos[$i]=="proveedores") 
//     {
//         $contador++;
      
//     }
//   }
//   if ($contador==0) 
//   {
//       include "505.php";
//       return;
//   }
// }

?>

<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Panel de Configuración de Usuario

      <small>Información</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

      <li class="active">Configuración Personal</li>

    </ol>

  </section>

    
  <section class="content">
    <div id="alert"></div>
  	<div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#information" data-toggle="tab" aria-expanded="true">Información Personal</a></li>
            <li class=""><a href="#change-pass" data-toggle="tab" aria-expanded="false">Cambiar Contraseña</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="information">
            	<!-- informacion a mostrar al usuario -->
              <?php

                include "config/info.php";

              ?>
            </div>
            <div class="tab-pane" id="change-pass">
              <!-- modificar la contraseña -->
              <?php

                include "config/change_pass.php";

              ?>
            </div>
          </div>
        </div>
      </div>
      
    </div>

  </section>

</div>

<!-- Para incluir objetos de Usuarios -->
<script src="view/js/settings.js"></script>