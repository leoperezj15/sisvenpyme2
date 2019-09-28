<!--=====================================
 MODAL AGREGAR CLIENTE JURIDICO
======================================-->

<div id="modalAgregarClienteJuridico" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#f56954; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title"><i class="fa  fa-user-plus"></i>   Agregar Cliente Juridico</h4>

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
                
                  <label for="nuevoRazonSocial">Razón Social</label>

                  <input type="text" autofocus class="form-control UpperCase" id="nuevoRazonSocial" name="nuevoRazonSocial" placeholder="Nombre de Cliente" required>

                </div>

              </div>

              <div class="col-xs-6">
                
                <!-- ENTRADA PARA APELLIDO PATERNO -->

                 <div class="form-group">
                  
                  <label for="nuevoNit">NIT</label>

                  <input type="text"  data-inputmask='"mask": "9999999999"' data-mask class="form-control" id="nuevoNit" name="nuevoNit" placeholder="Número de Identificación Tributaria" required>

                </div>

              </div>

            </div>

            <div class="row">

              <!-- ENTRADA PARA FECHA DE NACIMIENTO -->

              <div class="col-xs-5">

                <div class="form-group">
                  
                  <label for="nuevoRpteLegal">Rpte Legal</label>

                  <input type="text" class="form-control UpperCase" id="nuevoRpteLegal" name="nuevoRpteLegal" placeholder="Representante Legal" required>

                </div>

              </div>

              <!-- ENTRADA PARA DIRECCION -->

              <div class="col-xs-7">
                
                <div class="form-group">
                  
                  <label for="nuevoDireccion">Dirección</label>

                  <input type="text" class="form-control UpperCase" id="nuevoDireccion" name="nuevoDireccion" placeholder="Dirección" required>

                </div>

              </div>

            </div>

            <div class="row">
              
              <!-- ENTRADA Zona -->

              <div class="col-xs-4">
                
                <div class="form-group">
                  
                  <label for="nuevoZona">Zona</label>

                  <input type="text" class="form-control UpperCase" id="nuevoZona" name="nuevoZona" placeholder="Zona" required>

                </div>

              </div>

              <!-- ENTRADA TELEFONO FIJO -->

              <div class="col-xs-4">
                
                <div class="form-group">
                  
                  <label for="nuevoTelFijo">Teléfono Fijo</label>

                  <input type="text" data-inputmask='"mask": "(9) 999-999"' data-mask class="form-control" id="nuevoTelFijo" name="nuevoTelFijo" placeholder="Teléfono Fijo">

                </div>

              </div>

              <!-- ENTRADA TELEFONO CELULAR -->

              <div class="col-xs-4">
                
                <div class="form-group">
                  
                  <label for="nuevoTelCelular">Teléfono Celular</label>

                  <input type="text" data-inputmask='"mask": "999-99-999"' data-mask class="form-control" id="nuevoTelCelular" name="nuevoTelCelular" placeholder="Teléfono Celular" required>

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

          $crearJuridico = new ControladorJuridico();
          $crearJuridico -> ctrCrearClienteJuridico();

        ?>

      </form>

    </div>

  </div>

</div>