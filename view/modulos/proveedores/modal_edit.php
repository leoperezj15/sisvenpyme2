  <!--=====================================
    MODAL EDITAR PROVEEDOR
    ======================================-->

<div id="modalEditarProveedor" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#f56954; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Proveedor</h4>

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
                
                  <label for="editarRazonSocial">Razón Social</label>

                  <input type="hidden" id="editaridProveedor" name="editaridProveedor" value="">

                  <input type="text" class="form-control" id="editarRazonSocial" name="editarRazonSocial" value=""  required autofocus>

                </div>

              </div>

              <div class="col-xs-5">
                
                <!-- ENTRADA PARA LA NIT -->

                 <div class="form-group">
                  
                  <label for="editarNit">Nit</label>

                  <input type="text" data-inputmask='"mask": "9999999999"' data-mask class="form-control" id="editarNit" name="editarNit" value="" required>

                </div>

              </div>

              

            </div>

            <div class="row">

              <div class="col-xs-7">
                
                <!-- ENTRADA PARA LA DESCRIPCION -->

                 <div class="form-group">
                  
                  <label for="editarContacto">Contacto</label>

                  <input type="text" class="form-control" id="editarContacto" name="editarContacto" value="" required>

                </div>

              </div>

              <!-- ENTRADA PARA PERSONA DE CONTACTO -->

              <div class="col-xs-5">

                <div class="form-group">
                  
                  <label for="editarCargo">Cargo</label>

                  <input type="text" class="form-control" id="editarCargo" name="editarCargo" value="" required>

                </div>
                
              </div>

            </div>

            <div class="row">

              <div class="col-xs-6">

                <!-- ENTRADA PARA LA DIRECCION -->

                <div class="form-group">
                  
                  <label for="editarDireccion">Dirección</label>

                  <input type="text" class="form-control" id="editarDireccion" name="editarDireccion" value="" required>

                </div>
                
              </div>

              <div class="col-xs-3">

                <!-- ENTRADA PARA LA DIRECCION -->

                <div class="form-group">
                  
                  <label for="editarTelFijo">Tefóno Fijo</label>

                  <input type="text" data-inputmask='"mask": "(9) 999-999"' data-mask class="form-control" id="editarTelFijo" name="editarTelFijo" value="" required>

                </div>
                
              </div>

              <div class="col-xs-3">

                <!-- ENTRADA PARA LA DIRECCION -->

                <div class="form-group">
                  
                  <label for="editarTelCelular">Tefóno Celular</label>

                  <input type="text" data-inputmask='"mask": "999-99-999"' data-mask class="form-control" id="editarTelCelular" name="editarTelCelular" value="" required>

                </div>
                
              </div>
              
            </div> 

            <div class="row">
              
              <div class="col-xs-6">

                <!-- ENTRADA PARA CORREO -->

                <div class="form-group">
                  
                  <label for="editarCorreo">Email</label>

                  <input type="email" class="form-control" id="editarCorreo" name="editarCorreo" value="" required>

                </div>

              </div>

              <div class="col-xs-6">

                <!-- ENTRADA PARA LA DIRECCION -->

                <div class="form-group">
                  
                  <label for="editarWeb">Pagína Web</label>

                  <input type="url" class="form-control" id="editarWeb" name="editarWeb" value="" required>

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

          <button type="submit" class="btn btn-success">Modificar Proveedor</button>

        </div>

        <?php

          $editarProveedor = new ControladorProveedores();
          $editarProveedor -> ctrEditarProveedor();

        ?>

      </form>

    </div>

  </div>

</div>