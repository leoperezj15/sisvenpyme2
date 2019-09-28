<!--=====================================
 MODAL AGREGAR ALMACEN
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#f56954; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title"><i class="fa  fa-user-plus"></i>   Agregar Nuevo Producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- UNA NUEVA FILA PARA NOMBRE, SIGLA Y SELECIONAR LA SUCURSAL -->

            <div class="row">
              
              <div class="col-xs-4">
                
                <!-- ENTRADA PARA EL NOMBRE -->
                <div class="form-group">
                
                  <label for="p_a_nombre">Nombre</label>

                  <input type="text" autofocus class="form-control UpperCase" id="p_a_nombre" name="p_a_nombre" placeholder="Nombre de Producto" required>

                  <!-- onkeyup="this.value = this.value.toUpperCase();" -->

                </div>

              </div>

              <div class="col-xs-4">
                
                <!-- ENTRADA PARA APELLIDO PATERNO -->

                 <div class="form-group">
                  
                  <label for="p_a_descripcion">Descripción</label>

                  <input type="text" class="form-control UpperCase" id="p_a_descripcion" name="p_a_descripcion" placeholder="Descripción de Producto" required>

                </div>

              </div>

              <div class="col-xs-4">
                
                <!-- ENTRADA PARA APELLIDO MATERNO -->

                <div class="form-group">
                  
                  <label for="nuevoApMaterno">Marca</label>

                  <?php

                    $marca = ControladorMarca::ctrMostrarMarca();

                    $idMarca = "";

                    $selectMarca = "<select id='marca'  class='form-control input-sm' onchange='ListarModeloPorMarca(this)'>";
                    foreach ($marca as $item) {
                        if ($idMarca == "") 
                        {
                            $idMarca = $item->idMarca->GetValue();
                        }

                        $selectMarca .= "<option value='".$item->idMarca->GetValue()."'>".$item->nombre->GetValue()."</option>";
                    }
                    $selectMarca .= "</select>";

                    echo $selectMarca;

                  ?>

                </div>

              </div>

            </div>

            <div class="row">

              <!-- ENTRADA PARA FECHA DE NACIMIENTO -->

              <div class="col-xs-4">
                
                <div class="form-group">
                  
                  <label for="nuevoFechaNac">Módelo</label>

                  <?php

                    $modelo = ControladorModelo::ctrMostrarModelo();

                    $idModelo = "";

                    $selectModelo = "<select id='cajon-modelo' name='modelo' class='form-control input-sm'>";
                    foreach ($modelo as $item) 
                    {
                      if ($idModelo == "") 
                      {
                        $idModelo = $item->idModelo->GetValue();
                      }

                      $selectModelo .= "<option value='".$item->idModelo->GetValue()."'>".$item->model->GetValue()."</option>";
                    }
                    $selectModelo .= "</select>";

                    echo $selectModelo;

                  ?>
                </div>

              </div>

              <!-- ENTRADA PARA CI -->

              <div class="col-xs-3">
                
                <div class="form-group">
                  
                  <label for="nuevoCi">Cédula</label>

                  <input type="text"  data-inputmask='"mask": "99999999"' data-mask class="form-control" id="nuevoCi" name="nuevoCi" placeholder="de Identidad" required>

                </div>

              </div>

              <!-- ENTRADA PARA DIRECCION -->

              <div class="col-xs-5">
                
                <div class="form-group">
                  
                  <label for="nuevoDireccion">Dirección</label>

                  <input type="text" class="form-control UpperCase" id="nuevoDireccion" name="nuevoDireccion" placeholder="Dirección" required>

                </div>

              </div>

            </div>

            <div class="row">
              
              <!-- ENTRADA Zona -->

              <div class="col-xs-4">
                
                <div class="form-group">
                  
                  <label for="nuevoZona">Zona</label>

                  <input type="text" class="form-control UpperCase" id="nuevoZona" name="nuevoZona" placeholder="Zona" required>

                </div>

              </div>

              <!-- ENTRADA TELEFONO FIJO -->

              <div class="col-xs-4">
                
                <div class="form-group">
                  
                  <label for="nuevoTelFijo">Teléfono Fijo</label>

                  <input type="text" data-inputmask='"mask": "(9) 999-999"' data-mask class="form-control" id="nuevoTelFijo" name="nuevoTelFijo" placeholder="Teléfono Fijo">

                </div>

              </div>

              <!-- ENTRADA TELEFONO CELULAR -->

              <div class="col-xs-4">
                
                <div class="form-group">
                  
                  <label for="nuevoTelCelular">Teléfono Celular</label>

                  <input type="text" data-inputmask='"mask": "999-99-999"' data-mask class="form-control" id="nuevoTelCelular" name="nuevoTelCelular" placeholder="Teléfono Celular" required>

                </div>

              </div>

            </div>

            <div class="row">

              <!-- ENTRADA GENERO -->

              <div class="col-xs-5">
                
                <div class="form-group">
                  
                  <label for="nuevoGenero">Género</label>

                  <select name="nuevoGenero" id="nuevoGenero" class="form-control">
                    
                    <option value="Masculino">Masculino</option>

                    <option value="Femenino">Femenino</option>

                    <option value="Otro">Otro</option>

                  </select>

                </div>

              </div>

            </div>
              
               

            <!-- FINAL DEL BODY DEL MODAL -->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn bg-teal btn-app pull-left" data-dismiss="modal"><i class="fa fa-reply"></i> Salir</button>

          <button type="submit" class="btn bg-orange btn-app"><i class="fa fa-save"></i> Guardar
              </button>

        </div>

        <?php

          $crearNatural = new ControladorNatural();
          $crearNatural -> ctrCrearClienteNatural();

        ?>

      </form>

    </div>

  </div>

</div>