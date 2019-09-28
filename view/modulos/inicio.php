<!-- Content Wrapper. Contains page content -->
<div class="fakeLoader"></div>

<div class="content-wrapper" id="contenido">
    <!-- Content Header (Page header) -->
    <section class="content-header">

        <h1>
            Tablero
            <small>Panel de Control</small>
        </h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li class="active">Tablero</li>

      </ol>

    </section>

    <!-- Main content -->
   
    <!-- Contenido de la session -->
    
    <section class="content">

      <!-- INCLUYENDO SECCION DE CAJONES DE INFORMACIÓN  -->
      <?php include "dashboard/cajones_info.php"; ?>

      <!-- Default box -->
      <div class="box">

        <div class="box-header with-border">

          <h3 class="box-title">Datos de la Session</h3>

        </div>
        
        <div class="box-body">
          <?php

            echo "<pre>";
            print_r($_SESSION);
            echo "</pre>";

          ?>
        </div>

      </div>

    </section>

</div>

<div class="fakeLoader"></div>
