  <!--=====================================
    MODAL ELIMINAR Proveedor
    ======================================-->

<div id="modalEliminarProveedor" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-sm" role="document">

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#f56954; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Dar de Baja a Proveedor</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
          
            <!-- ENTRADA PARA INGRESO DE IDPROVEEDOR EN HASH -->

            <div class="form-group">

              <p>¿Estás seguro que quieres dar de baja al Proveedor?</p>

              <p class="text-warning">Esta acción se puede revertir activando el proveedor</p>

              <input type="hidden" class="form-control" id="eliminaridProveedor" name="eliminaridProveedor" value="" required>

            </div>
            

            <!-- FINAL DEL BODY DEL MODAL -->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-danger">Desactivar Proveedor</button>

        </div>

        <?php

          $eliminarProveedor = new ControladorProveedores();
          $eliminarProveedor -> ctrEliminarProveedor();


        ?>
      </form>

    </div>

  </div>

</div>