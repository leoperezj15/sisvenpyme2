<?php

if (isset($_SESSION["ObjetosValidos"])) 
{
  $objetos = $_SESSION["ObjetosValidos"];

  $contador = 0;

  for ($i=0; $i < count($objetos); $i++) 
  { 
    if ($objetos[$i]=="lista-compra") 
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


          <a href="nueva-compra" class="btn btn-warning">

            <i class="fa fa-plus-square" style=" width: 20px; height: 20px"></i>
          
            Nueva Compra

          </a>

        </div>
        
        <div class="box-body">

          <h3 class="box-title">Listado de Compras</h3>

          <div class="table-responsive">

            <table class="table table-bordered shadow-lg rounded table-striped dt-responsive datatable tablaCompras" width="100%">
         
            <thead>
             
             <tr>
               
               <th style="width:10px">#</th>
               <th>Fecha Ingreso</th>
               <th>Fecha Compra</th>
               <th>Proveedor</th>
               <th>Nit</th>
               <th>Usuario</th>
               <th>Monto Total</th>
               <th>Almacen</th>
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




