<?php

if (isset($_SESSION["ObjetosValidos"])) 
{
  $objetos = $_SESSION["ObjetosValidos"];

  $contador = 0;

  for ($i=0; $i < count($objetos); $i++) 
  { 
    if ($objetos[$i]=="nueva-compra") 
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

        <small>Ingresar Productos por Compras</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li class="active">Nueva Compra</li>

      </ol>

    </section>

    
    <section class="content">

      <!-- ADICIONAR UNA NUEVA FILA -->

      <div class="row">

        <div id="resultados"></div>

        <!-- PARTIENDO LA FILA EN DOS DE 6 Y DE 3 -->

        <div class="col-md-9">

          <!-- PRIMERA CAJA DE DATOS DE LA COMPRA -->
          
          <?php

          include "compra/add_new_compra.php";

          ?>

          <!-- FINALIZANDO LA CAJA DE DATOS DE COMPRA -->

        </div>

        <div class="col-md-3" style="padding-left:0px">
          
          <!-- INICIANDO CON EL CAJON DE AGREGAR PRODUCTOS -->

          <?php

          include "compra/add_producto_compra.php";

          ?>

        </div>
        
      </div>

    </section>

  </div>

<script>
$(function() {
  $("#add_nombre").autocomplete({
    source: "control/auto_producto.php",
    minLength: 2,
    select: function(event, ui) {
        event.preventDefault();
        $("#add_idproducto").val(ui.item.idproducto);
        $("#add_codigo").val(ui.item.codigo);
        $("#add_nombre").val(ui.item.nombre);
        $("#add_modelo").val(ui.item.modelo);
        $("#add_precio").val(ui.item.pcompra);
                                        
        
     }
  });
});
                    
$("#add_nombre" ).on( "keydown", function( event ) {
    if (event.keyCode== $.ui.keyCode.LEFT || 
    event.keyCode== $.ui.keyCode.RIGHT || 
    event.keyCode== $.ui.keyCode.UP || 
    event.keyCode== $.ui.keyCode.DOWN || 
    event.keyCode== $.ui.keyCode.DELETE || 
    event.keyCode== $.ui.keyCode.BACKSPACE )
    {
        $("#add_nombre").val("");
        $("#add_idproducto").val("");
        $("#add_codigo").val("");
        $("#add_modelo").val("");
        $("#add_precio").val("0.00");
        $("#add_cantidad").val("1");
                        
    }
    if (event.keyCode==$.ui.keyCode.DELETE){
        $("#add_idproducto").val("");
        $("#add_nombre").val("");
        $("#add_codigo").val("");
        $("#add_modelo").val("");
        $("#add_precio").val("0.00");
        $("#add_cantidad").val("1");
    }
});

$(function() {
        $("#nombre").autocomplete({
          source: "control/auto_proveedor.php",
          minLength: 2,
          select: function(event, ui) {
            event.preventDefault();
            $('#idProveedor').val(ui.item.idProveedor);
            $('#nombre').val(ui.item.nombre);
            $('#nit').val(ui.item.nit);
            $('#contacto').val(ui.item.contacto);
                            
            
           }
        });
      });
      
$("#nombre" ).on( "keydown", function( event ) {
  if (event.keyCode== $.ui.keyCode.LEFT ||
   event.keyCode== $.ui.keyCode.RIGHT || 
   event.keyCode== $.ui.keyCode.UP || 
   event.keyCode== $.ui.keyCode.DOWN || 
   event.keyCode== $.ui.keyCode.DELETE || 
   event.keyCode== $.ui.keyCode.BACKSPACE )
  {
    $("#idProveedor" ).val("");
    $("#nombre" ).val("");
    $("#nit" ).val("");
    $('#contacto').val("");
            
  }
  if (event.keyCode==$.ui.keyCode.DELETE){
    $("#nombre" ).val("");
    $("#idProveedor" ).val("");
    $("#nit" ).val("");
    $('#contacto').val("");
  }
  });


</script>


