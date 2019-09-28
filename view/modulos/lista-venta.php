<?php

if (isset($_SESSION["ObjetosValidos"])) 
{
  $objetos = $_SESSION["ObjetosValidos"];

  $contador = 0;

  for ($i=0; $i < count($objetos); $i++) 
  { 
    if ($objetos[$i]=="lista-venta") 
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

      Panel de Compras

      <small>Gestionar Las Compras Realizadas</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

      <li class="active">Lista de Compras</li>

    </ol>

  </section>

  
  <section class="content">

    <div class="box box-danger">

      <div class="box-header with-border">


        <a href="nueva-venta" class="btn btn-warning">

          <i class="fa fa-plus-square" style=" width: 20px; height: 20px"></i>
        
          Nueva Venta

        </a>

      </div>
      
      <div class="box-body">

        <h3 class="box-title">Listado de Ventas de </h3>

        <div class="table-responsive">

          <table class="table table-bordered  dt-responsive datatable tablaVentas" width="100%">
       
          <thead>
           
           <tr>
             
             <th style="width:10px">#</th>
             <th>Cliente</th>
             <th>Nro Documento</th>
             <th>Tipo Cliente</th>
             <th>Usuario</th>
             <th>Almacen</th>
             <th>Fecha</th>
             <th>Monto Total</th>
             <th>Monto Total Descuento</th>
             <th>Estado</th>
             <th>Acciones</th>

           </tr> 

          </thead>

          

         </table>
          
        </div>

      </div>
 
      <div class="box-footer">

        Footer

      </div>

    </div>

  </section>

</div>