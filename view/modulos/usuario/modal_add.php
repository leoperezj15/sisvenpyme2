  <!--=====================================
    MODAL AGREGAR ALMACEN
    ======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form id="FormSaveUsuario" role="form" method="POST">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#f56954; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Usuario y nuevo Empleado</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div id="alert"></div>

            <!-- UNA NUEVA FILA PARA NOMBRE, SIGLA Y SELECIONAR LA SUCURSAL -->

            <!-- Datos para empleado -->

            <div class="box box-info">

              <div class="box-header with-border">

                <h3 class="box-title">Datos Del Empleado</h3>

              </div>

              <div class="box-body">

                <div class="row">
              
                  <div class="col-xs-4">
                    
                    <!-- ENTRADA PARA EL NOMBRE -->
                    <div class="form-group">
                    
                      <label for="nue_emple_nombre">Nombre</label>

                      <input type="text" class="form-control input-sm UpperCase" id="nue_emple_nombre" name="nue_emple_nombre" placeholder="Nombre De Empleado" 
                      minlength="3" required>

                    </div>

                  </div>

                  <div class="col-xs-4">
                    
                    <!-- ENTRADA PARA LA APELLIDO PATERNO -->

                     <div class="form-group">
                      
                      <label for="nue_emple_apaterno">A Paterno</label>

                      <input type="text" class="form-control input-sm UpperCase" id="nue_emple_apaterno" name="nue_emple_apaterno" placeholder="Apeliido Paterno" minlength="3" required>

                    </div>

                  </div>

                  <div class="col-xs-4">
                    
                    <!-- ENTRADA PARA APELLIDO MATERNO --> 

                     <div class="form-group">
                      
                      <label for="nue_emple_amaterno">A Materno</label>

                      <input type="text" class="form-control input-sm UpperCase" id="nue_emple_amaterno" name="nue_emple_amaterno" placeholder="Descripción" minlength="3" required>

                    </div>

                  </div>

                </div>

                <div class="row">
              
                  <div class="col-xs-6">
                    
                    <!-- ENTRADA PARA EL NOMBRE -->
                    <div class="form-group">
                    
                      <label for="nue_emple_fecha">Fecha</label>

                      <input type="date" class="form-control input-sm" id="nue_emple_fecha" name="nue_emple_fecha" placeholder=" de Nacimiento" required>

                    </div>

                  </div>

                  <div class="col-xs-6">
                    
                    <!-- ENTRADA PARA LA APELLIDO PATERNO -->

                     <div class="form-group">
                      
                      <label for="nue_emple_ci">CI</label>

                      <input type="number" class="form-control input-sm" id="nue_emple_ci" name="nue_emple_ci" placeholder="Cédula de Identidad" minlength="7" maxlength="8" required>

                    </div>

                  </div>

                </div>
       
              </div>

            </div>
            <!-- Datos para Usuario -->
            <div class="box box-success">

              <div class="box-header with-border">

                <h3 class="box-title">Datos Para el nuevo Usuario</h3>

              </div>

              <div class="box-body">

                <div class="row">
              
                  <div class="col-xs-6">
                    
                    <!-- ENTRADA PARA EL NOMBRE -->
                    <div class="form-group">
                    
                      <label for="nue_usu_username">Username</label>

                      <input type="text" class="form-control input-sm LowerCase" id="nue_usu_username" name="nue_usu_username" placeholder="Nombre de Usuario" 
                      minlength="8" required>

                    </div>

                  </div>

                  <div class="col-xs-6">
                    
                    <!-- ENTRADA PARA EL NOMBRE -->
                    <div class="form-group">
                    
                      <label for="nue_usu_alias">Alias</label>

                      <input type="text" class="form-control input-sm UpperCase" id="nue_usu_alias" name="nue_usu_alias" placeholder="Nuevo Alias" 
                      minlength="8" required>

                    </div>

                  </div>

                </div>

                <div class="row">

                  <div class="col-xs-6">
                    
                    <!-- ENTRADA PARA LA APELLIDO PATERNO -->

                     <div class="form-group">
                      
                      <label for="nue_usu_email">Correo</label>

                      <input type="email" class="form-control input-sm LowerCase" id="nue_usu_email" name="nue_usu_email" placeholder="Correo electronico" required>

                    </div>

                  </div>

                  <div class="col-xs-6">
                    
                    <!-- ENTRADA PARA APELLIDO MATERNO -->

                     <div class="form-group">
                      
                      <label for="nue_usu_rol">Rol</label>
                      <?php

                        $rol = ControladorRol::ctrMostrarRol();

                        $selectRol = "<select id='nue_usu_rol' name='nue_usu_rol'  class='form-control input-sm' onchange='Roles(this)'  required>";
                        foreach ($rol as $item) 
                        {

                            $selectRol .= "<option value='".$item->idRol->GetValue()."'>".$item->nombre->GetValue()."</option>";
                        }
                        $selectRol .= "</select>";

                        echo $selectRol;

                      ?>

                    </div>

                  </div>

                </div>

                
              </div>

            </div>

            <div class="box">

              <div class="box-body no-padding">

                <h4>Permisos por Rol</h4>

                <div id="cajon-roles"></div>
                
              </div>

            </div>

              

            <!-- FINAL DEL BODY DEL MODAL -->

          </div>

        </div>

        

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" id="btnSaveUsuario" class="btn btn-success">Guardar Sucursal</button><!--type="submit"-->

        </div>

        <?php

          // $crearSucursal = new ControladorSucursal();
          // $crearSucursal -> ctrCrearSucursal();

        ?>

      </form>

    </div>

  </div>

</div>

