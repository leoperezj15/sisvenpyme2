<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarEmpleado" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#f56954; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Empleados</h4>

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

                  <input type="hidden" class="form-control" id="editaridEmpleado" name="editaridEmpleado" value="" required>

                  <input type="text" class="form-control" id="editarNombre" name="editarNombre" value="" required>

                </div>

              </div>

              <div class="col-xs-7">
                
                <!-- ENTRADA PARA EL APELLIDO PATERNO -->

                 <div class="form-group">
                  
                  <label for="nuevoPaterno">Apellido Paterno</label>

                  <input type="text" class="form-control" id="editarPaterno" name="editarPaterno" value="" required>

                </div>

              </div>

            </div>

            <!-- SEGUNDA FILA PARA AP MATERNO Y FECHA DE NACIMIENTO -->

            <div class="row">

              <div class="col-xs-7">
                
                <!-- ENTRADA PARA EL APELLIDO MATERNO -->

                 <div class="form-group">
                  
                  <label for="nuevoMaterno">Apellido Materno</label>

                  <input type="text" class="form-control" id="editarMaterno" name="editarMaterno" value="" required>

                </div>

              </div>

              <div class="col-xs-5">

                <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->

                <div class="form-group">
                  
                  <label for="editarFecha">Fecha de Nacimiento</label>

                  <input type="date" class="form-control" id="editarFecha" name="editarFecha" value="" >

                </div>
                
              </div>

            </div>

            <!-- ENTRADA PARA INGRESO DE CEDULA DE IDENTIDAD -->

            <div class="form-group">
                  
              <label for="nuevoCI">Cédula de Identidad</label>

              <input type="number" min="1000000" max="99999999" class="form-control" id="editarCI" name="editarCI" value="" readonly required>

            </div>
            

            <!-- FINAL DEL BODY DEL MODAL -->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar Empleado</button>

        </div>

     <?php

          $editarEmpleado = new ControladorEmpleados();
          $editarEmpleado -> ctrEditarEmpleado();

        ?>

      </form>

    </div>

  </div>

</div>