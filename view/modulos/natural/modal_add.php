<!--=====================================
 MODAL AGREGAR ALMACEN
======================================-->

<div id="modalAgregarClienteNatural" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#f56954; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title"><i class="fa  fa-user-plus"></i>   Agregar Cliente Natural</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- UNA NUEVA FILA PARA NOMBRE, SIGLA Y SELECIONAR LA SUCURSAL -->

            <div class="row">
              
              <div class="col-xs-4">
                
                <!-- ENTRADA PARA EL NOMBRE -->
                <div class="form-group">
                
                  <label for="nuevoNombre">Nombre</label>

                  <input type="text" autofocus class="form-control UpperCase" id="nuevoNombre" name="nuevoNombre" placeholder="Nombre de Cliente" required>

                  <!-- onkeyup="this.value = this.value.toUpperCase();" -->

                </div>

              </div>

              <div class="col-xs-4">
                
                <!-- ENTRADA PARA APELLIDO PATERNO -->

                 <div class="form-group">
                  
                  <label for="nuevoApPaterno">Apellido Paterno</label>

                  <input type="text" class="form-control UpperCase" id="nuevoApPaterno" name="nuevoApPaterno" placeholder="Apellido Paterno" required>

                </div>

              </div>

              <div class="col-xs-4">
                
                <!-- ENTRADA PARA APELLIDO MATERNO -->

                <div class="form-group">
                  
                  <label for="nuevoApMaterno">Apellido Materno</label>

                  <input type="text" class="form-control UpperCase" id="nuevoApMaterno" name="nuevoApMaterno" placeholder="Apellido Materno" required>

                </div>

              </div>

            </div>

            <div class="row">

              <!-- ENTRADA PARA FECHA DE NACIMIENTO -->

              <div class="col-xs-4">
                
                <div class="form-group">
                  
                  <label for="nuevoFechaNac">Fecha</label>

                  <!-- data-inputmask="'alias': 'dd/mm/yyyy'" data-mask-->
                  <input type="text" class="form-control" id="nuevoFechaNac" name="nuevoFechaNac" placeholder="de Nacimiento" required data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>

                </div>

              </div>

              <!-- ENTRADA PARA CI -->

              <div class="col-xs-3">
                
                <div class="form-group">
                  
                  <label for="nuevoCi">Cédula</label>

                  <input type="text"  data-inputmask='"mask": "99999999"' data-mask class="form-control" id="nuevoCi" name="nuevoCi" placeholder="de Identidad" required>

                </div>

              </div>

              <!-- ENTRADA PARA DIRECCION -->

              <div class="col-xs-5">
                
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

            <div class="row">

              <!-- ENTRADA GENERO -->

              <div class="col-xs-5">
                
                <div class="form-group">
                  
                  <label for="nuevoGenero">Género</label>

                  <select name="nuevoGenero" id="nuevoGenero" class="form-control">
                    
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

          <button type="submit" class="btn bg-orange btn-app"><i class="fa fa-save"></i> Guardar
              </button>

        </div>

        <?php

          $crearNatural = new ControladorNatural();
          $crearNatural -> ctrCrearClienteNatural();

        ?>

      </form>

    </div>

  </div>

</div>