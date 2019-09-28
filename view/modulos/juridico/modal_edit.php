<!--=====================================
 MODAL EDITAR CLIENTE JURIDICO
======================================-->

<div id="modalEditarClienteJuridico" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#f56954; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title"><i class="fa  fa-user-plus"></i>   Modificar Cliente Juridico</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- UNA NUEVA FILA PARA NOMBRE, SIGLA Y SELECIONAR LA SUCURSAL -->

            <div class="row">
              
              <div class="col-xs-6">
                
                <!-- ENTRADA PARA EL NOMBRE -->
                <div class="form-group">

                  <input type="hidden" name="editaridCliente" id="editaridCliente" value="" required>
                
                  <label for="editarRazonSocial">Razón Social</label>

                  <input type="text" autofocus class="form-control UpperCase" id="editarRazonSocial" name="editarRazonSocial" value="" required>

                </div>

              </div>

              <div class="col-xs-6">
                
                <!-- ENTRADA PARA APELLIDO PATERNO -->

                 <div class="form-group">
                  
                  <label for="editarNit">NIT</label>

                  <input type="text"  data-inputmask='"mask": "9999999999"' data-mask class="form-control" id="editarNit" name="editarNit" value="" required readonly>

                </div>

              </div>

            </div>

            <div class="row">

              <!-- ENTRADA PARA FECHA DE NACIMIENTO -->

              <div class="col-xs-5">

                <div class="form-group">
                  
                  <label for="editarRpteLegal">Rpte Legal</label>

                  <input type="text" class="form-control UpperCase" id="editarRpteLegal" name="editarRpteLegal" value="" required>

                </div>

              </div>

              <!-- ENTRADA PARA DIRECCION -->

              <div class="col-xs-7">
                
                <div class="form-group">
                  
                  <label for="editarDireccion">Dirección</label>

                  <input type="text" class="form-control UpperCase" id="editarDireccion" name="editarDireccion" value="" required>

                </div>

              </div>

            </div>

            <div class="row">
              
              <!-- ENTRADA Zona -->

              <div class="col-xs-4">
                
                <div class="form-group">
                  
                  <label for="editarZona">Zona</label>

                  <input type="text" class="form-control UpperCase" id="editarZona" name="editarZona" value="" required>

                </div>

              </div>

              <!-- ENTRADA TELEFONO FIJO -->

              <div class="col-xs-4">
                
                <div class="form-group">
                  
                  <label for="editarTelFijo">Teléfono Fijo</label>

                  <input type="text" data-inputmask='"mask": "(9) 999-999"' data-mask class="form-control" id="editarTelFijo" name="editarTelFijo" value="">

                </div>

              </div>

              <!-- ENTRADA TELEFONO CELULAR -->

              <div class="col-xs-4">
                
                <div class="form-group">
                  
                  <label for="editarTelCelular">Teléfono Celular</label>

                  <input type="text" data-inputmask='"mask": "999-99-999"' data-mask class="form-control" id="editarTelCelular" name="editarTelCelular" value="" required>

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

          <button type="button" class="btn bg-teal btn-app pull-left" data-dismiss="modal"><i class="fa fa-reply"></i> Salir</button>

          <button type="submit" class="btn bg-orange btn-app"><i class="fa fa-save"></i> Guardar
              </button>

        </div>

        <?php

          $editarJuridico = new ControladorJuridico();
          $editarJuridico -> ctrEditarClienteJuridico();

        ?>

      </form>

    </div>

  </div>

</div>