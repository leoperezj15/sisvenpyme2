  <!--=====================================
    MODAL AGREGAR ALMACEN
    ======================================-->

<div id="modalAgregarSucursal" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#f56954; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Sucursal</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- UNA NUEVA FILA PARA NOMBRE, SIGLA Y SELECIONAR LA SUCURSAL -->

            <div class="row">
              
              <div class="col-xs-4">
                
                <!-- ENTRADA PARA EL NOMBRE DE SUCURSAL -->
                <div class="form-group">
                
                  <label for="nuevoNombre">Nombre</label>

                  <input type="text" class="form-control" id="nuevoNombre" name="nuevoNombre" placeholder="Nombre de Sucursal" required>

                </div>

              </div>

              <div class="col-xs-4">
                
                <!-- ENTRADA PARA LA UBIACIÓN -->

                 <div class="form-group">
                  
                  <label for="nuevoUbicacion">Ubicación</label>

                  <input type="text" class="form-control" id="nuevoUbicacion" name="nuevoUbicacion" placeholder="Ubicación" required>

                </div>

              </div>

              <div class="col-xs-4">
                
                <!-- ENTRADA PARA LA DESCRIPCION -->

                 <div class="form-group">
                  
                  <label for="nuevoDescripcion">Descripción</label>

                  <input type="text" class="form-control" id="nuevoDescripcion" name="nuevoDescripcion" placeholder="Descripción" required>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-xs-12">

                <div class="form-group">
                  
                  <label for="nuevoDireccion">Dirección</label>

                  <input type="text" class="form-control" id="nuevoDireccion" name="nuevoDireccion" placeholder="Dirección" required>

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

          <button type="submit" class="btn btn-success">Guardar Sucursal</button>

        </div>

        <?php

          $crearSucursal = new ControladorSucursal();
          $crearSucursal -> ctrCrearSucursal();

        ?>

      </form>

    </div>

  </div>

</div>