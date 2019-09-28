  <!--=====================================
    MODAL AGREGAR ALMACEN
    ======================================-->

<div id="modalAgregarAlmacen" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#f56954; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Almacén</h4>

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

                  <input type="text" class="form-control" id="nuevoNombre" name="nuevoNombre" placeholder="Nombre para Almacén" required>

                </div>

              </div>

              <div class="col-xs-4">
                
                <!-- ENTRADA PARA LA SIGLA -->

                 <div class="form-group">
                  
                  <label for="nuevoSigla">Sigla</label>

                  <input type="text" class="form-control" id="nuevoSigla" name="nuevoSigla" placeholder="Sigla" required>

                </div>

              </div>

              <div class="col-xs-4">
                
                <!-- ENTRADA PARA LA SIGLA -->

                 <div class="form-group">
                  
                  <label for="nuevoSucursal">Sucursal</label>

                  <?php

                    $sucursal = ControladorSucursal::ctrMostrarSucursales();

                    echo '<select class="form-control" id="nuevoSucursal" name="nuevoSucursal">';

                    foreach ($sucursal as $key => $value) 
                    {
                      
                      if ($value->estado->GetValue() == "Activo") 
                      {
                        echo'
                              <option value="'.$value->hash->GetValue().'">'.$value->Nombre->GetValue().'</option>

                            ';
                      }

                    }

                    echo '</select>';

                  ?>

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

          <button type="submit" class="btn btn-success">Guardar Empleado</button>

        </div>

        <?php

          $crearAlmacen = new ControladorAlmacen();
          $crearAlmacen -> ctrCrearAlmacen();

        ?>

      </form>

    </div>

  </div>

</div>