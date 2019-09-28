  <!--=====================================
    MODAL ELIMINAR CLIENTE NATURAL
    ======================================-->

<div id="modalEliminarClienteNatural" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-sm" role="document">

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        CABEZA DEL MODAL role="form" method="POST"
        ======================================-->

        <div class="modal-header" style="background:#f56954; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Dar de Baja a un Cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
          
            <!-- ENTRADA PARA INGRESO DE IDALMACEN EN HASH -->

            <div class="form-group">

              <p>¿Estás seguro que quieres dar de baja el Cliente?</p>

              <p class="text-warning">Esta acción se puede revertir activando el Cliente</p>

              <input type="hidden" class="form-control" id="eliminaridCliente" name="eliminaridCliente" value="" required>

            </div>
            

            <!-- FINAL DEL BODY DEL MODAL -->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-danger">Dar de Baja</button>

        </div>

        <?php

          $eliminarCliente = new ControladorNatural();
          $eliminarCliente -> ctrEliminarClienteNatural();


        ?>
      </form>

    </div>

  </div>

</div>