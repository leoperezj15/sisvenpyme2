
<div class="box box-solid bg-light-blue-gradient ">

  <div class="box-header ">
    
    <i class="fa fa-list"></i>

    <h3 class="box-title">Datos de la Compra</h3>

    <div class="box-tools pull-right">

      <button type="button" class="btn btn-info btn-sm" data-widget="collapse">

        <i class="fa fa-minus"></i>
        
      </button>
      
    </div>

  </div>

  <div class="box-body">
    
    <form name="add_compra" id="add_compra">

      <h4 class="mb-3">Compra de Productos</h4>

          <h5>Datos del Proveedor</h5>
          
          <div class="row small">

              <div class="col-sm-3 mb-1">

                  <input type="hidden" name="compra_add_idproveedor" id="idProveedor">

                  <label for="nombre">Nombre</label>

                  <input type="text" class="form-control input-sm" id="nombre" placeholder="" required>

              </div>

              <div class="col-sm-3 mb-1" style="padding-left:0px">
                  
                  <label for="nit">Nit</label>

                  <input type="number" class="form-control input-sm" id="nit" placeholder="" value="" required readonly>

              </div>
              
              <div class="col-sm-3 mb-1" style="padding-left:0px">

                  <label for="contacto">Contacto</label>

                  <input type="text" class="form-control input-sm" id="contacto" placeholder="" value="" readonly required>
                 
              </div>

              <div class="col-md-3 mb-1" style="padding-left:0px">

                  <label for="nro-factura">Nro Factura</label>

                  <input type="number" class="form-control input-sm" name="compra_add_nrofactura" id="nro-factura" placeholder="" required>

              </div>

          </div>

          <h5>Datos de la Factura de Compra : Sucursal y Almacen a Ingresar</h5>

          <div class="row small">

              <div class="col-md-3 mb-1" >

                  <label for="fecha-compra">Fecha de la Compra</label>

                  <input type="date" class="form-control input-sm" name="compra_add_fechacompra" id="fecha-compra" placeholder="" required>

              </div>

              <div class="col-md-2 mb-2" style="padding-left:0px">

                  <label for="fecha-compra">Fecha de Ingreso</label>

                  <input type="text" class="form-control input-sm" name="compra_add_fecha_ingreso" id="fecha-ingreso" placeholder="" value="<?php echo date("d/m/Y");?>" readonly>

              </div>

              <div class="col-md-3 mb-2">

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
              
              <div class="col-md-3 mb-2" id="" style="padding-left:0px">

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

          </div>

      <hr class="mb-4">

      <!--<div id="resultados"></div>  Reciviendo datos de Ajax -->

      <!-- CAJON PARA LA TABLA DE PRODUCTOS AÑADIDOS -->

      <div class="box box-solid bg-light-blue-gradient">

        <div class="box-header">

          <i class="fa fa-shopping-cart"></i>
          
          <h3 class="box-title">Carrito</h3>

        </div>

        <!-- CUERPO DEL CAJO PARA EL LISTADO DE PRODUCTOS DEL CARRITO -->

        <div class="box-body no-padding">

          <div id="ctn-items">

            <!-- Reciviendo datos de Ajax -->
            
          </div>

          
          
        </div> 
        
      </div>
      <button type="button" class="btn btn-danger" id="btnBorrarListaProductos" >
            <i class="fa fa-trash"></i> Borrar lista</button>

      <hr class="mb-4">
      
      <button class="btn btn-success btn-lg btn-block" type="submit" name="btnSaveCompra" id="btnSaveCompra">Procesar Compra</button>

    </form>

    <!-- FINALISANDO EL FORMULARIO DE LA COMPRA -->

  </div>

  <!-- <div class="box-footer">
    

  </div> -->
  
</div>