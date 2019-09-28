  <!--=====================================
    MODAL ACTIVAR CLIENTE NATURAL
    ======================================-->

<div id="modalActivarClienteNatural" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-sm" role="document">

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Activar Cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
          
            <!-- ENTRADA PARA INGRESO DE CEDULA DE IDENTIDAD -->

            <div class="form-group">

              <p>¿Estás seguro que quieres Activar el Cliente?</p>

              <p class="text-warning">Esta acción se puede revertir desactivando el cliente</p>

              <input type="hidden" class="form-control" id="activaridCliente" name="activaridCliente" value="" required>

            </div>
            

            <!-- FINAL DEL BODY DEL MODAL -->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-success">Activar Cliente</button>

        </div>

        <?php

          $activarCliente = new ControladorNatural();
          $activarCliente -> ctrActivarClienteNatural();
         ?>
      </form>

    </div>

  </div>

</div>