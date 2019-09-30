<!--=====================================
 MODAL AGREGAR ALMACEN
======================================-->
<div id="modalAgregarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form id="FormSaveProducto"  method="POST" role="form">

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
              
              <div class="col-xs-6">
                
                <!-- ENTRADA PARA EL NOMBRE -->
                <div class="form-group">
                
                  <label for="p_a_nombre">Nombre</label>

                  <input type="text" autofocus class="form-control UpperCase input-sm" id="p_a_nombre" name="p_a_nombre" placeholder="Nombre de Producto" required>

                  <!-- onkeyup="this.value = this.value.toUpperCase();" -->

                </div>

              </div>

              <div class="col-xs-6">
                
                <!-- ENTRADA PARA APELLIDO PATERNO -->

                 <div class="form-group">
                  
                  <label for="p_a_descripcion">Descripción</label>

                  <input type="text" class="form-control UpperCase input-sm" id="p_a_descripcion" name="p_a_descripcion" placeholder="Descripción de Producto" required>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-xs-6">

                <div class="form-group">
                  
                  <label for="nuevoApMaterno">Marca</label>

                  <?php

                    $marca = ControladorMarca::ctrMostrarMarca();

                    $idMarca = "";

                    $selectMarca = "<select name='p_a_marca' id='p_a_marca'  class='form-control input-sm' onchange='ListarModeloPorMarca(this)'>
                                      <option value='0'>Selecione la Marca</option>
                    ";
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
              <div class="col-xs-6">
                
                <div class="form-group">

                  <div id="cajon-modelo">

                    <label for="">Módelo</label>

                    <select name="p_a_modelo" id="p_a_modelo" class="form-control input-sm">
                      <option value="0">Selecione la Marca</option>
                    </select>
                  </div>
                  
                </div>

              </div>

            </div>

            <div class="row">

              <!-- ENTRADA PARA CI -->

              <div class="col-xs-5">
                
                <div class="form-group">
                  
                  <label for="p_a_categoria">Categoría</label>

                  <?php

                    $categoria = ControladorCategoria::ctrMostrarCategoria();

                    $selectCategoria = "<select name='p_a_categoria' id='p_a_categoria'  class='form-control input-sm' onchange='ListarSubCategoriaPorCategoria(this)'>
                                      <option value='0'>Selecione la Categoria</option>
                    ";
                    foreach ($categoria as $item3) {

                        $selectCategoria .= "<option value='".$item3->idCategoria->GetValue()."'>".$item3->nombre->GetValue()."</option>";
                    }
                    $selectCategoria .= "</select>";

                    echo $selectCategoria;

                  ?>

                </div>

              </div>

              <!-- ENTRADA PARA DIRECCION -->

              <div class="col-xs-7">
                
                <div class="form-group">

                  <div id="cajon-subcategoria">
                  <label for='p_a_sub_categoria'>Sub Categoría</label>
            
                    <select name='p_a_sub_categoria' id='p_a_sub_categoria' class='form-control input-sm'>
                      <option value='0'>Selecione la Categoria</option>
                    </select>

                  </div>

                </div>

              </div>
                          
            </div>

            <div class="row">
              
              <!-- ENTRADA Zona -->

              <div class="col-xs-4">
                
                <div class="form-group">
                  
                  <label for="p_a_pais">Origen</label>

                  <input type="text" class="form-control UpperCase input-sm" id="p_a_pais" name="p_a_pais" placeholder="Zona" required>

                </div>

              </div>

              <!-- ENTRADA TELEFONO FIJO -->

              <div class="col-xs-4">
                
                <div class="form-group">
                  
                  <label for="p_a_codigo">Código</label>

                  <input type="text" class="form-control input-sm" id="p_a_codigo" name="p_a_codigo" placeholder="codigo" required minlength="7" maxlength="7" min="1000000" max="1009999">

                </div>

              </div>

              <!-- ENTRADA TELEFONO CELULAR -->

              <div class="col-xs-4">
                
                <div class="form-group">
                  
                  <label for="p_a_precio_compra">Precio</label>

                  <input type="text" class="form-control input-sm" id="p_a_precio_compra" name="p_a_precio_compra" placeholder="Precio de Compra" required>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-xs-5">
                
                <div class="form-group">
                  
                  <label for="p_a_incremento">Utilidad Bruta</label>
                  
                  <div class="input-group">

                    <span class="input-group-addon">%</span>

                    <input type="number" name="p_a_incremento" id="p_a_incremento" min="10.00" max="99.99" class="form-control input-sm">

                  </div>
                  
                </div>

              </div>

              <div class="col-xs-5">
                
                <div class="form-group">
                  
                  <label for="p_um">Unidad Medida Base</label>

                  <?php

                    $categoria = ControladorUnidadMedida::ctrMostrarUnidadMedida();

                    $selectUnidadMedida = "<select name='p_a_unidad_medida' id='p_a_unidad_medida'  class='form-control input-sm' >
                                      <option value='0'>Selecione la UM</option>
                    ";
                    foreach ($categoria as $item4) {

                        $selectUnidadMedida .= "<option value='".$item4->idunidadMedida->GetValue()."'>".$item4->nombre->GetValue()."</option>";
                    }
                    $selectUnidadMedida .= "</select>";

                    echo $selectUnidadMedida;

                  ?>

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

          <button type="submit" id="btnSaveProducto" class="btn bg-green btn-app">
            <i class="fa fa-save"></i> 
            Guardar
          </button>

        </div>

      </form>

    </div>

  </div>

</div>