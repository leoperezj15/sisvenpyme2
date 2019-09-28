<!--=====================================
 MODAL EDITAR CLIENTE NATURAL
======================================-->

<div id="modalEditarClienteNatural" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#f56954; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title"><i class="fa  fa-user-edit"></i>   Editar Cliente Natural</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- FILA PARA EDITAR NOMBRE AP PATERNO Y AP MATERNO -->

            <div class="row">
              
              <div class="col-xs-4">
                
                <!-- ENTRADA PARA EL NOMBRE -->
                <div class="form-group">
                
                  <label for="editarNombre">Nombre</label>

                  <input type="hidden" id="editaridCliente" name="editaridCliente" value="" required>

                  <input type="text" autofocus class="form-control UpperCase" id="editarNombre" name="editarNombre" value="" required>

                  <!-- onkeyup="this.value = this.value.toUpperCase();" -->

                </div>

              </div>

              <div class="col-xs-4">
                
                <!-- ENTRADA PARA APELLIDO PATERNO -->

                 <div class="form-group">
                  
                  <label for="editarApPaterno">Apellido Paterno</label>

                  <input type="text" class="form-control UpperCase" id="editarApPaterno" name="editarApPaterno" value="" required>

                </div>

              </div>

              <div class="col-xs-4">
                
                <!-- ENTRADA PARA APELLIDO MATERNO -->

                <div class="form-group">
                  
                  <label for="editarApMaterno">Apellido Materno</label>

                  <input type="text" class="form-control UpperCase" id="editarApMaterno" name="editarApMaterno" value="" required>

                </div>

              </div>

            </div>

            <div class="row">

              <!-- ENTRADA PARA FECHA DE NACIMIENTO -->

              <div class="col-xs-4">
                
                <div class="form-group">
                  
                  <label for="editarFechaNac">Fecha</label>

                  <!-- data-inputmask="'alias': 'dd/mm/yyyy'" data-mask-->
                  <input type="text" class="form-control" id="editarFechaNac" name="editarFechaNac" placeholder="de Nacimiento" required data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>


                </div>

              </div>

              <!-- ENTRADA PARA CI -->

              <div class="col-xs-3">
                
                <div class="form-group">
                  
                  <label for="editarCi">Cédula</label>

                  <input type="text" class="form-control" id="editarCi" name="editarCi" value="" readonly required>

                </div>

              </div>

              <!-- ENTRADA PARA DIRECCION -->

              <div class="col-xs-5">
                
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

            <div class="row">

              <!-- ENTRADA GENERO -->

              <div class="col-xs-5">
                
                <div class="form-group">
                  
                  <label for="editarGenero">Género</label>

                  <select name="editarGenero" id="editarGenero" class="form-control" value="">
                    
                    <option value="Masculino">Masculino</option>

                    <option value="Femenino">Femenino</option>

                    <option value="Otro">Otro</option>

                  </select>

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

          <button type="submit" class="btn bg-orange btn-app"><i class="fa fa-save"></i> Modificar
              </button>

        </div>

        <?php

          $editarNatural = new ControladorNatural();
          $editarNatural -> ctrEditarClienteNatural();

        ?>

      </form>

    </div>

  </div>

</div>