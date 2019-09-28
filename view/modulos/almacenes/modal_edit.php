<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarAlmacen" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#f56954; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Almacen</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="box-body">

            <!-- UNA NUEVA FILA PARA NOMBRE, SIGLA Y SELECIONAR LA SUCURSAL -->

            <div class="row">
              
              <div class="col-xs-4">
                
                <!-- ENTRADA PARA EL NOMBRE -->
                <div class="form-group">
                
                  <label for="editarNombre">Nombre</label>

                  <input type="hidden" id="editaridAlmacen" name="editaridAlmacen" value="" required>

                  <input type="text" class="form-control" id="editarNombre" name="editarNombre" value=""  required>

                </div>

              </div>

              <div class="col-xs-4">
                
                <!-- ENTRADA PARA LA SIGLA -->

                 <div class="form-group">
                  
                  <label for="editarSigla">Sigla</label>

                  <input type="text" class="form-control" id="editarSigla" name="editarSigla" value="" required>

                </div>

              </div>

              <div class="col-xs-4">
                
                <!-- ENTRADA PARA LA SIGLA -->

                 <div class="form-group">
                  
                  <label for="editarSucursal">Sucursal</label>

                  <?php

                    $sucursal = ControladorSucursal::ctrMostrarSucursales();

                    echo '<select class="form-control"  id="editarSucursal" name="editarSucursal" value="">';

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

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar Almacen</button>

        </div>

     <?php

          $editarAlmacen = new ControladorAlmacen();
          $editarAlmacen -> ctrEditarAlmacen();

        ?>

      </form>

    </div>

  </div>

</div>