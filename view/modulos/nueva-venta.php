<?php

if (isset($_SESSION["ObjetosValidos"])) 
{
  $objetos = $_SESSION["ObjetosValidos"];

  $contador = 0;

  for ($i=0; $i < count($objetos); $i++) 
  { 
    if ($objetos[$i]=="nueva-venta") 
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

        Panel de Registro de Ventas

        <small>Realice la Venta</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li class="active">Nueva Venta</li>

      </ol>

    </section>

    
    <section class="content">

      <!-- ADICIONAR UNA NUEVA FILA -->

      <div class="row">

        <div id="resultados"></div>

        <!-- PARTIENDO LA FILA EN DOS DE 6 Y DE 3 -->

        <div class="col-md-9">

          <!-- PRIMERA CAJA DE DATOS DE LA Venta -->

          <div class="box box-primary">

            <div class="box-header with-border">

              <i class="fa fa-list"></i>

              <h3 class="box-title">Proceso de Venta <span id="hora"></span></h3>

            </div>

            <!-- <form name="add_venta" id="add_venta"> -->

              <div class="box-body">

                <h5>Datos del Cliente</h5>

                <div class="row">
                  
                  <div class="col-xs-4">

                    <input type="hidden" name="venta_add_idcliente" id="idCliente">

                    <label for="nombre">Nombre</label>

                    <input type="text" class="form-control input-sm" id="nombre"  required>
                    
                  </div>

                  <div class="col-xs-4">

                    <label for="nrodocumento">Nro Documento</label>

                    <input type="number" class="form-control" id="nrodocumento" value="" required readonly>
                    
                  </div>

                  <div class="col-xs-4">

                    <label for="contacto">Direccion</label>

                    <input type="text" class="form-control" id="direccion" value="" readonly required>
                    
                  </div>

                </div>

                <h5>Sucursal y Almacen para la Venta</h5>

                <div class="row">
                  
                  <div class="col-xs-4">

                    <label for="sucursal">Sucursal</label>

                    <?php

                      $sucursales = ControladorSucursal::ctrMostrarSucursales();

                      $idSucursal = "";

                      $selectSucursal = "<select id='sucursal'  class='form-control input-sm' onchange='ListarAlmacenPorSucursal1(this)'>";
                      foreach ($sucursales as $item) {
                          if ($idSucursal == "") 
                          {
                              $idSucursal = $item->idSucursal->GetValue();
                          }

                          $selectSucursal .= "<option value='".$item->idSucursal->GetValue()."'>".$item->Nombre->GetValue()."</option>";
                      }
                      $selectSucursal .= "</select>";

                      echo $selectSucursal;

                    ?>
                    
                  </div>

                  <div class="col-xs-4">

                    
                    <label for="almacen">Almacen</label>

                    <?php

                      $almacenes = ControladorAlmacen::ctrMostrarAlmacenes();

                      $selectAlmacen = "<select name='compra_add_almacen' id='cajon-almacen'  class='form-control input-sm'>";

                      foreach ($almacenes as $item2) 
                      {
                          $selectAlmacen .= "<option value='".$item2->idAlmacen->GetValue()."'>".$item2->nombre->GetValue()."</option>";
                      }

                      $selectAlmacen .= "</select>";

                      echo $selectAlmacen;

                    ?>
                    
                  </div>

                  <div class="col-xs-4">

                    <label for="fecha_venta">Fecha de Venta</label>
                        <input type="text" class="form-control" name="" id="fecha_venta" placeholder="" value="<?php echo date("d/m/Y");?>" readonly>
                        
                    
                  </div>

                </div>

                <!-- TABLA DE LISTA DE PRODUCTOS -->

                <!-- <div class="table" id="ctn-items"></div> Reciviendo datos de Ajax -->

                <div class="row">
                  
                  <div class="col-xs-12">

                    <h4>Detalle de Venta</h4>

                    <hr>

                      <!-- <div class="table" id="ctn-items"></div>
 -->
                      <?php

                      if (isset($_SESSION["listaVenta"]) && $_SESSION["listaVenta"]!= "")
                      {
                          
                          $lista = $_SESSION['listaVenta'];

                          $contenido = "
                          <table class='table' id='ctn-items'>
                              
                              <thead class='table-dark'>

                                  <tr>

                                      <th>#</th>
                                      <th>Codigo</th>
                                      <th>Producto</th>
                                      <th>Cantidad</th>
                                      <th>Precio</th>
                                      <th>%</th>
                                      <th>Descuento</th>
                                      <th>Sub total</th>
                                      <th>Quitar</th>

                                  </tr>

                              </thead>

                              <tbody>

                          ";
                          /*=======================================================
                          SE DECLARAN VARIABLES AUXILIARES Y SE REALIZA LOS CALCULOS MATEMATICOS
                          ========================================================*/

                          $c = 0;
                          $total = 0;
                          $total_descuento = 0;
                          foreach($lista as $item)
                          {
                              $c++;
                              $itemPrecio=$item['precio'];
                              $itemCantidad=$item['cantidad'];
                              $itemPorcntje = $item['porcentaje'];
                              $itemPorcentaje=$item['descuento_porcentaje'];
                              $idProducto = "'".$item['idProducto']."'";

                              //SE VERIFICA SI NO SE HA HECHO UN DESCUENDO PARA APLICAR 0.00

                              if($itemPorcentaje=="SD")
                              {
                                  $itemPorcentaje = 0.00;
                              }

                              $subTotal = $itemPrecio * $itemCantidad;

                              $descontado = $subTotal * $itemPorcentaje;

                              $subTotal = $subTotal - $descontado;

                              $total += $subTotal;

                              $total_descuento += $descontado;
                              

                              $contenido.= '
                              
                                  <tr>
                                      <td>'.$c.'</td>
                                      <td><strong>'.$item["codigo"].'</strong></td>
                                      <td><strong>'.$item["nombre"].' '.$item['modelo'].'</strong></td>
                                      <td>'.$itemCantidad.'</td>
                                      <td>'.number_format($itemPrecio,2).'</td>
                                      <td>'.number_format($itemPorcntje,2).'</td>
                                      <td>'.number_format($descontado,2).'</td>
                                      <td>'.number_format($subTotal,2).'</td>
                                      <td><button onclick="deleteItem('.$idProducto.');" class="btn btn-danger btn-xs"><i class="fa fa-minus-circle"></i></button>
                                      </td>
                                  </tr>
                              ';
                              
                          }

                          $contenido.="
                              <tr>
                                  <td class='text-right' colspan=7><strong>TOTAL Bs<strong></td>
                                  <td class=''><input type='hidden' name='venta_add_montototal' id='venta_add_montototal' value='".$total."'>".number_format($total,2)."</td>
                                  <td></td>
                              </tr>

                              <tr>
                                  <td class='text-right' colspan=7><strong>TOTAL Descuento Bs<strong></td>
                                  <td class=''><input type='hidden' name='venta_add_montototal_descuento' id='venta_add_montototal_descuento' value='".$total_descuento."'>".number_format($total_descuento,2)."</td>
                                  <td></td>
                              </tr>
                              
                              ";
                          $contenido.= "
                              </tbody>
                          </table>";
                          
                          echo $contenido;
                          
                      }
                      else
                      {
                          $contenido = "
                              <table class='table' id='ctn-items'> 
                                <thead class='table-dark'>
                                  <tr>
                                      <th>#</th>
                                      <th>Codigo</th>
                                      <th>Producto</th>
                                      <th>Cantidad</th>
                                      <th>Precio</th>
                                      <th>%</th>
                                      <th>Descuento</th>
                                      <th>Sub total</th>
                                      <th>Quitar</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                      <td class='text-right' colspan=7><strong>TOTAL Bs<strong></td>
                                      <td class=''><input type='hidden' name='venta_add_montototal' id='venta_add_montototal' value='0'>0.00</td>
                                      <td></td>
                                  </tr>

                                  <tr>
                                      <td class='text-right' colspan=7><strong>TOTAL Descuento Bs<strong></td>
                                      <td class=''><input type='hidden' name='venta_add_montototal_descuento' id='venta_add_montototal_descuento' value='0'>0.00</td>
                                      <td></td>
                                  </tr>
                                </tbody>
                              </table>";
                          echo $contenido;

                      }

                      ?>
                    
                  </div>

                </div>

                
              </div>

              <div class="box-footer">

                <button type="button" class="btn btn-danger" onclick="deleteList('Eliminar')"><i class="fa fa-trash"></i> Borrar lista</button><!-- cambiando a modo onclick id="btnDeleteListItems" -->

                <hr class="mb-4">
                
                <button class="btn btn-primary btn-lg btn-block" type="submit" name="btnSaveVenta" id="btnSaveVenta">Procesar Venta</button>

              </div>

            <!-- </form> -->

          </div>
          
          

          <!-- FINALIZANDO LA CAJA DE DATOS DE Venta -->

        </div>

<!-- ======================================================================================
            SECCION PARA AGREGAR PRODUCTOS AL CARRITO                
=========================================================================================== -->

        <div class="col-md-3">
          
          <!-- INICIANDO CON EL CAJON DE AGREGAR PRODUCTOS -->
          <div class="box box-success">

            <div class="box-header with-border">

              <i class="fa fa-cart-arrow-down"></i>

              <h3 class="box-title">Cargar Productos</h3>

            </div>

            <div class="box-body">

              <div class="row">

                <div class="col-xs-12">
                
                  <div class="form-group">

                    <label for="add_nombre">Nombre</label>

                    <input type="hidden" name="add_idproducto" id="add_idproducto" value="" required>

                    <input class="form-control input-sm" type="text"  name="add_nombre" id="add_nombre" required>

                  </div>

                </div>

              </div>

              <!-- SEGUNDA FILA DE CODIGO DE PRODUCTO -->

              <div class="row">

                <div class="col-xs-12">
                
                  <div class="form-group">

                    <label for="add_codigo">Código</label>

                    <input type="text" name="add_codigo" id="add_codigo" class="form-control input-sm" required>

                  </div>

                </div>

              </div>

              <!-- TERCERA FILA DE MODELO DE PRODUCTO -->

              <div class="row">

                <div class="col-xs-12">
                
                  <div class="form-group">

                    <label for="add_modelo">Modelo</label>

                    <input type="hidden" name="add_idmodelo" id="add_idmodelo" value="" required>

                    <input type="text"  name="add_modelo" id="add_modelo" class="form-control input-sm" value="" required readonly>

                  </div>

                </div>

              </div>

              <!-- 4TA FILA DE CANTIDAD DE PRODUCTO -->

              <div class="row">

                <div class="col-xs-12">
                
                  <div class="form-group">

                    <label for="add_cantidad">Cantidad</label>

                    <input type="number" name="add_cantidad" id="add_cantidad" class="form-control input-sm" min="1" value="1" required>

                  </div>

                </div>

              </div>

              <!-- 6TA FILA DE DESCUENTO DE PRODUCTO -->

              <div class="row">

                <div class="col-xs-12">
                
                  <div class="form-group">

                    <label for="add_descuento">Descuento</label>

                    <select class="form-control input-sm" name="add_descuento" id="add_descuento">
                                    
                      <option value="SD">Sin Descuento</option>
                      <option value="0.05">5</option>
                      <option value="0.10">10</option>
                      <option value="0.15">15</option>
                      <option value="0.20">20</option>
                      <option value="0.25">25</option>
                      <option value="0.30">30</option>

                    </select>

                  </div>

                </div>

              </div>

              <!-- VER EL PRECIO DEL PRODUCTO -->

              <div class="row">

                <div class="col-xs-12">
                
                  <div class="form-group">

                    <label for="add_descuento">Precio</label>

                    <div class="input-group">

                      <span class="input-group-addon">$</span>

                      <input type="number" class="form-control input-sm" name="add_precio" id="add_precio" value="0.00" required readonly>

                      <span class="input-group-addon">.00</span>

                    </div>

                  </div>

                </div>

              </div>

              <!-- BOTON DE ENVIO DE DATOS -->

              <div class="row">

                <div class="col-xs-12">
                
                  <div class="form-group">

                  <form>
                    
                    <button type="button" class="btn btn-warning btn-lg btn-block" id="btnAdd" ><i class="fa fa-cart-plus"></i>   Agregar a la Lista</button>

                  </form> 

                  </div>

                </div>

              </div>

            </div>

          </div>

          
          <!-- FINALIZANDO CON EL CAJON DE AGREGAR PRODUCTOS -->

        </div>
        
      </div>

    </section>

  </div>

<script>
$(function() {
  $("#nombre").autocomplete({
    source: "control/auto_cliente.php",
    minLength: 2,
    select: function(event, ui) {
      event.preventDefault();
      $('#idCliente').val(ui.item.idCliente);
      $('#nombre').val(ui.item.nombre);
      $('#nrodocumento').val(ui.item.nrodocumento);
      $('#direccion').val(ui.item.direccion);
                      
      
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
    $("#idCliente").val("");
    $("#nombre").val("");
    $("#nrodocumento").val("");
    $("#direccion").val("");

            
  }
  if (event.keyCode==$.ui.keyCode.DELETE){
    $("#nombre").val("");
    $("#idCliente").val("");
    $("#nrodocumento").val("");
    $("#direccion").val("");

  }
});



$(function() {
  $("#add_nombre").autocomplete({
    source: "control/auto_producto.php",
    minLength: 2,
    select: function(event, ui) {
      event.preventDefault();
      $('#add_idproducto').val(ui.item.idproducto);
      $('#add_codigo').val(ui.item.codigo);
      $('#add_nombre').val(ui.item.nombre);
      $("#add_modelo").val(ui.item.modelo);
      $('#add_precio').val(ui.item.pventa);
                      
      
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
    $("#add_nombre" ).val("");
    $("#add_idproducto" ).val("");
    $("#add_codigo" ).val("");
    $('#add_modelo').val("");
    $('#add_precio').val("");
            
  }
  if (event.keyCode==$.ui.keyCode.DELETE){
    $("#add_idproducto").val("");
    $("#add_nombre").val("");
    $("#add_codigo").val("");
    $('#add_modelo').val("");
    $('#add_precio').val("");
  }
});   
</script>


