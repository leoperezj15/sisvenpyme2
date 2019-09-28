<?php

$NroVenta = ControladorDashboard::ctrContarVentas($_SESSION['ACL']['usuario_activo']['idUsuario']);

$SumarVenta = ControladorDashboard::ctrSumarVentas($_SESSION['ACL']['usuario_activo']['idUsuario']);

?>
<div class="row">

    <div class="col-lg-3 col-xs-6">
        <!-- Cajón color agua -->
        <div class="small-box bg-aqua bg-aqua-gradient">

        <div class="inner">

            <h3><?php echo $NroVenta?></h3>

            <p>Nuevas Ventas</p>

        </div>

        <div class="icon">

            <i class="ion ion-bag"></i>

        </div>

        <a href="lista-venta" class="small-box-footer">
            Más información <i class="fa fa-arrow-circle-right"></i>
        </a>

        </div>

    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- Cajón color verde -->
        <div class="small-box bg-green-gradient">
        <div class="inner">
            <h3><?php echo number_format($SumarVenta, 2,",", ".");?></h3>

            <p>Suma de Ventas</p>
        </div>
        <div class="icon">
            <i class="ion ion-stats-bars"></i>
        </div>
        <a href="reportes" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- Cajón color Amarillo -->
        <div class="small-box bg-yellow-gradient">
        <div class="inner">
            <h3>44</h3>

            <p>Nuevos Clientes</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="natural" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- Cajon color Rojo -->
        <div class="small-box bg-red-gradient">
        <div class="inner">
            <h3>65</h3>

            <p>Unique Visitors</p>
        </div>
        <div class="icon">
            <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

</div>