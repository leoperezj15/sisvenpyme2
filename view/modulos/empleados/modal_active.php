  <!--=====================================
    MODAL ELIMINAR EMPLEADO
    ======================================-->

<div id="modalActivarEmpleado" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-sm" role="document">

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Activar a Empleado</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
          
            <!-- ENTRADA PARA INGRESO DE CEDULA DE IDENTIDAD -->

            <div class="form-group">

              <p>¿Estás seguro que quieres Activar al Empleado?</p>

              <p class="text-warning">Esta acción se puede revertir activando el empleado</p>

              <input type="hidden" class="form-control" id="activaridEmpleado" name="activaridEmpleado" value="" required>

            </div>
            

            <!-- FINAL DEL BODY DEL MODAL -->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-success">Activar Empleado</button>

        </div>

        <?php

          $activarEmpleado = new ControladorEmpleados();
          $activarEmpleado -> ctrActivarEmpleado();

        ?>
      </form>

    </div>

  </div>

</div>