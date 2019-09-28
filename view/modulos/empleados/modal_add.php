  <!--=====================================
    MODAL AGREGAR USUARIO
    ======================================-->

<div id="modalAgregarEmpleado" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST" name="add_empleado" id="add_empleado">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#f56954; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Empleado</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- UNA NUEVA FILA PARA NOMBRE Y AP PATERNO -->

            <div class="row">
              
              <div class="col-xs-5">
                
                <!-- ENTRADA PARA EL NOMBRE -->
                <div class="form-group">
                
                  <label for="nuevoNombre">Nombre</label>

                  <input type="text" class="form-control" id="nuevoNombre" name="nuevoNombre" placeholder="Ingresar nombre" required>

                </div>

              </div>

              <div class="col-xs-7">
                
                <!-- ENTRADA PARA EL APELLIDO PATERNO -->

                 <div class="form-group">
                  
                  <label for="nuevoPaterno">Apellido Paterno</label>

                  <input type="text" class="form-control" id="nuevoPaterno" name="nuevoPaterno" placeholder="Ingresar apellido Paterno" required>

                </div>

              </div>

            </div>

            <!-- SEGUNDA FILA PARA AP MATERNO Y FECHA DE NACIMIENTO -->

            <div class="row">

              <div class="col-xs-7">
                
                <!-- ENTRADA PARA EL APELLIDO MATERNO -->

                 <div class="form-group">
                  
                  <label for="nuevoMaterno">Apellido Materno</label>

                  <input type="text" class="form-control" id="nuevoMaterno" name="nuevoMaterno" placeholder="Ingresar apellido Materno" required>

                </div>

              </div>

              <div class="col-xs-5">

                <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->

                <div class="form-group">
                  
                  <label for="nuevaFecha">Fecha de Nacimiento</label>

                  <input type="date" class="form-control" id="nuevaFecha" name="nuevaFecha" placeholder="Ingresar su Fecha de Nacimiento" required>

                </div>
                
              </div>

            </div>

            <!-- ENTRADA PARA INGRESO DE CEDULA DE IDENTIDAD -->

            <div class="form-group">
                  
              <label for="nuevoCI">Cédula de Identidad</label>

              <input type="number" min="1000000" max="99999999" class="form-control" id="nuevoCI" name="nuevoCI" placeholder="Ingresar su Cédula de Identidad" required>

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

          $crearEmpleado = new ControladorEmpleados();
          $crearEmpleado -> ctrCrearEmpleado();

        ?>

      </form>

    </div>

  </div>

</div>