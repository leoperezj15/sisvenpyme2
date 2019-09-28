  <!--=====================================
    MODAL ACTIVAR Proveedor
    ======================================-->

<div id="modalActivarProveedor" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-sm" role="document">

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Activar Proveedor</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
          
            <!-- ENTRADA PARA INGRESO DE ID -->

            <div class="form-group">

              <p>¿Estás seguro que quieres Activar el Proveedor?</p>

              <p class="text-warning">Esta acción se puede revertir desactivando el Proveedor</p>

              <input type="hidden" class="form-control" id="activaridProveedor" name="activaridProveedor" value="" required>

            </div>
            

            <!-- FINAL DEL BODY DEL MODAL -->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-success">Activar Proveedor</button>

        </div>

        <?php

          $activarProveedor = new ControladorProveedores();
          $activarProveedor -> ctrActivarProveedor();

        ?>
      </form>

    </div>

  </div>

</div>