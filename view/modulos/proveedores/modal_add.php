  <!--=====================================
    MODAL AGREGAR PROVEEDOR
    ======================================-->

<div id="modalAgregarProveedor" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">  <!-- id="add_proveedor" name="add_proveedor"-->

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#f56954; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Proveedor</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- UNA NUEVA FILA PARA NOMBRE, SIGLA Y SELECIONAR LA SUCURSAL -->

            <div class="row">
              
              <div class="col-xs-7">
                
                <!-- ENTRADA PARA EL RAZON SOCIAL -->
                <div class="form-group">
                
                  <label for="nuevoRazonSocial">Razón Social</label>

                  <input type="text" class="form-control UpperCase" id="nuevoRazonSocial" name="nuevoRazonSocial" placeholder="Razón Social" required autofocus>

                </div>

              </div>

              <div class="col-xs-5">
                
                <!-- ENTRADA PARA LA NIT -->

                 <div class="form-group">
                  
                  <label for="nuevoNit">Nit</label>

                  <input type="text" data-inputmask='"mask": "9999999999"' data-mask class="form-control" id="nuevoNit" name="nuevoNit" placeholder="Nit" required>

                </div>

              </div>

              

            </div>

            <div class="row">

              <div class="col-xs-7">
                
                <!-- ENTRADA PARA LA DESCRIPCION -->

                 <div class="form-group">
                  
                  <label for="nuevoContacto">Contacto</label>

                  <input type="text" class="form-control UpperCase" id="nuevoContacto" name="nuevoContacto" placeholder="Contacto" required>

                </div>

              </div>

              <!-- ENTRADA PARA PERSONA DE CONTACTO -->

              <div class="col-xs-5">

                <div class="form-group">
                  
                  <label for="nuevoCargo">Cargo</label>

                  <input type="text" class="form-control UpperCase" id="nuevoCargo" name="nuevoCargo" placeholder="Especificar el Cargo" required>

                </div>
                
              </div>

            </div>

            <div class="row">

              <div class="col-xs-6">

                <!-- ENTRADA PARA LA DIRECCION -->

                <div class="form-group">
                  
                  <label for="nuevoDireccion">Dirección</label>

                  <input type="text" class="form-control UpperCase" id="nuevoDireccion" name="nuevoDireccion" placeholder="Dirección" required>

                </div>
                
              </div>

              <div class="col-xs-3">

                <!-- ENTRADA PARA LA DIRECCION -->

                <div class="form-group">
                  
                  <label for="nuevoTelFijo">Tefóno Fijo</label>

                  <input type="text" data-inputmask='"mask": "(9) 999-999"' data-mask class="form-control" id="nuevoTelFijo" name="nuevoTelFijo" placeholder="Tefóno Fijo" required>

                </div>
                
              </div>

              <div class="col-xs-3">

                <!-- ENTRADA PARA LA DIRECCION -->

                <div class="form-group">
                  
                  <label for="nuevoTelCelular">Tefóno Celular</label>

                  <input type="text" data-inputmask='"mask": "999-99-999"' data-mask class="form-control" id="nuevoTelCelular" name="nuevoTelCelular" placeholder="Tefóno Celular" required>

                </div>
                
              </div>
              
            </div> 

            <div class="row">
              
              <div class="col-xs-6">

                <!-- ENTRADA PARA CORREO -->

                <div class="form-group">
                  
                  <label for="nuevoCorreo">Email</label>

                  <input type="email" class="form-control" id="nuevoCorreo" name="nuevoCorreo" placeholder="Email" required>

                </div>

              </div>

              <div class="col-xs-6">

                <!-- ENTRADA PARA LA DIRECCION -->

                <div class="form-group">
                  
                  <label for="nuevoWeb">Pagína Web</label>

                  <input type="url" class="form-control" id="nuevoWeb" name="nuevoWeb" placeholder="Pagína Web" required>

                </div>

              </div>

            </div>  

            <!-- FINAL DEL BODY DEL MODAL -->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit"  class="btn btn-success">Guardar Proveedor</button>

        </div>

        <?php

          $crearProveedor = new ControladorProveedores();
          $crearProveedor -> ctrCrearProveedor();

        ?>

      </form>

    </div>

  </div>

</div>