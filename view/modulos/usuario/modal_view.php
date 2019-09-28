  <!--=====================================
    MODAL ELIMINAR EMPLEADO
    ======================================-->

<div id="modalVerSucursal" class="modal fade" role="dialog">
  
  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->

      <div class="modal-header" style="background:#00a65a; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Ver ubicación en el Mapa</h4>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->

      <div class="modal-body">

        <div class="box-body">
          
          <div class="row">

            <div class="col-md-12 modal_body_content">

              <!-- Interacion con el mapa de google -->

            </div>

          </div>

          <div class="row">

            <div class="col-md-12 modal_body_map">

              <div class="location-map" id="location-map">

                <div style="width: 600px; height: 400px;" id="map_canvas"></div>

              </div>

            </div>

          </div>

          <div class="row">

            <div class="col-md-12 modal_body_end">

              <!-- Fin de Presentacion del mapa -->

            </div>

          </div>

        </div>

      </div>

      <!--=====================================
      PIE DEL MODAL
      ======================================-->

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

      </div>

    </div>

  </div>

</div>