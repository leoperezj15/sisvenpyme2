<?php

if (isset($_SESSION["ObjetosValidos"])) 
{
  $objetos = $_SESSION["ObjetosValidos"];

  $contador = 0;

  for ($i=0; $i < count($objetos); $i++) 
  { 
    if ($objetos[$i]=="lista-producto") 
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
      Panel de Productos
      <small>Gestionar Productos</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
      <li class="active">Lista de Productos</li>
    </ol>
  </section>
  <section class="content">
    
    <div id="alert"></div>

    <div class="box box-danger">
      <div class="box-header with-border">
        <button class="btn btn-warning" data-toggle="modal" data-target="#modalAgregarProducto">
          <i class="fa fa-plus-square" style=" width: 20px; height: 20px"></i>
          Nueva Producto
        </button>
      </div>

      <div class="box-body">
        <h3 class="box-title">Listado de Productos</h3>
        <div class="table-responsive">

          <table class="table table-bordered shadow-lg rounded table-striped dt-responsive datatable tablaProducto" width="100%">
            <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Código</th>
                <th style="width:30px">Nombre</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Peso</th>
                <th>Procedencia</th>
                <th>Compra</th>
                <th>Venta</th>
                <th>Sub Categoria</th>
                <th>Categoria</th>
                <th>UM</th>
                <th>OP</th>
              </tr> 
            </thead>
          </table>

        </div>
      </div>

    </div>
  </section>
</div>


<!-- Para incluir Listado de Productos -->
<script src="view/js/producto.js"></script>

<?php

//INCLUYENDO MODAL DE AGREGAR PRODUCTO
include "producto/modal_add.php";

//INCLUYENDO MODAL DE EDITAR PRODUCTOS
include "producto/modal_edit.php";

//INCLUYENDO MODAL DE ELIMINAR PRODUCTOS
include "producto/modal_delete.php";

//INCLUYENDO MODAL DE ACTIVAR PRODUCTOS
include "producto/modal_active.php";


?> 




