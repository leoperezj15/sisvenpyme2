  <!--=====================================
    MODAL EDITAR SUCURSAL
    ======================================-->

<div id="modalEditarSucursal" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#f56954; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Sucursal</h4>

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
                
                  <label for="editarNombre">Nombre</label>

                  <input type="hidden" id="editaridSucursal" name="editaridSucursal" value="" required>

                  <input type="text" class="form-control" id="editarNombre" name="editarNombre" value="" required>

                </div>

              </div>

              <div class="col-xs-4">
                
                <!-- ENTRADA PARA LA UBIACIÓN -->

                 <div class="form-group">
                  
                  <label for="editarUbicacion">Ubicación</label>

                  <input type="text" class="form-control" id="editarUbicacion" name="editarUbicacion" value="" required>

                </div>

              </div>

              <div class="col-xs-4">
                
                <!-- ENTRADA PARA LA DESCRIPCION -->

                 <div class="form-group">
                  
                  <label for="editarDescripcion">Descripción</label>

                  <input type="text" class="form-control" id="editarDescripcion" name="editarDescripcion" value=""required>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-xs-12">

                <div class="form-group">
                  
                  <label for="editarDireccion">Dirección</label>

                  <input type="text" class="form-control" id="editarDireccion" name="editarDireccion" value="" required>

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

          <button type="submit" class="btn btn-success">Modificar Sucursal</button>

        </div>

        <?php

          $editarSucursal = new ControladorSucursal();
          $editarSucursal -> ctrEditarSucursal();

        ?>

      </form>

    </div>

  </div>

</div>