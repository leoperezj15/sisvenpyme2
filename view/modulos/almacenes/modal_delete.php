  <!--=====================================
    MODAL ELIMINAR EMPLEADO
    ======================================-->

<div id="modalEliminarAlmacen" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-sm" role="document">

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#f56954; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Dar de Baja a un Almacen</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
          
            <!-- ENTRADA PARA INGRESO DE IDALMACEN EN HASH -->

            <div class="form-group">

              <p>¿Estás seguro que quieres dar de baja el Almacen?</p>

              <p class="text-warning">Esta acción se puede revertir activando el almacen</p>

              <input type="hidden" class="form-control" id="eliminaridAlmacen" name="eliminaridAlmacen" value="" required>

            </div>
            

            <!-- FINAL DEL BODY DEL MODAL -->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-danger">Desactivar Almacen</button>

        </div>

        <?php

          $eliminarAlmacen = new ControladorAlmacen();
          $eliminarAlmacen -> ctrEliminarAlmacen();

        ?>
      </form>

    </div>

  </div>

</div>