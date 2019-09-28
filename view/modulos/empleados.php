<?php

if (isset($_SESSION["ObjetosValidos"])) 
{
  $objetos = $_SESSION["ObjetosValidos"];

  $contador = 0;

  for ($i=0; $i < count($objetos); $i++) 
  { 
    if ($objetos[$i]=="empleados") 
    {
        $contador++;
      
    }
  }
  if ($contador==0) 
  {
      include "505.php";
      return;
  }
}

?>
<div class="content-wrapper">

    <section class="content-header">

      <h1>

        Panel de Empleados

        <small>Panel de Control</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li class="active">Empleados</li>

      </ol>

    </section>

    
    <section class="content">

      <div class="box box-danger">

        <div class="box-header with-border">


          <button class="btn btn-warning" data-toggle="modal" data-target="#modalAgregarEmpleado">

            <i class="fa fa-plus-square" style=" width: 20px; height: 20px"></i>
          
            Agregar Empleado

          </button>

        </div>
        
        <div class="box-body">

          <h3 class="box-title">Listado de Empleados</h3>

          <div class="table-responsive">
            
            <table class="table table-bordered shadow-lg rounded table-striped dt-responsive tablas" width="100%">
         
            <thead>
             
             <tr>
               
               <th style="width:10px">#</th>
               <th>Nombre Completo</th>
               <th>Fecha de Nacimiento</th>
               <th>Ci</th>
               <th>Estado</th>
               <th>Acciones</th>

             </tr> 

            </thead>

            <tbody>

            <?php

            $item = null;
            $valor = null;

            $empleados = ControladorEmpleados::ctrMostrarEmpleados();

           foreach ($empleados as $key => $value)
           {
             
              echo ' <tr>
                      <td>'.($key+1).'</td>
                      <td>'.$value->nombre->GetValue().' '.$value->a_paterno->GetValue().' '.$value->a_materno->GetValue().'</td>
                      <td>'.$value->fecha_nac->GetValue().'</td>
                      <td>'.$value->ci->GetValue().'</td>'
                      ;

              if($value->estado->GetValue() == "Activo")
              {

                echo '<td><button class="btn btn-success btn-xs btnActivar" estadoUsuario="Activo">Activado</button></td>';

              }
              else
              {

                echo '<td><button class="btn btn-danger btn-xs btnActivar" data-idempleado="'.$value->hash->GetValue().'" data-toggle="modal" data-target="#modalActivarEmpleado">Desactivado</button></td>';

              }             

              echo '
                <td>

                  <div class="btn-group">
                      
                    <button class="btn btn-warning btn-xs btnEditarEmpleado" title="Editar Empleado" data-toggle="modal" data-target="#modalEditarEmpleado"
                      data-idempleado="'.$value->hash->GetValue().'"
                      data-nombre="'.$value->nombre->GetValue().'"
                      data-paterno="'.$value->a_paterno->GetValue().'"
                      data-materno="'.$value->a_materno->GetValue().'"
                      data-fecha="'.$value->fecha_nac->GetValue().'"
                      data-ci="'.$value->ci->GetValue().'"><i class="fa fa-pencil"></i></button>

                    <button class="btn btn-info btn-xs btnAsignarUsuario" title="Asiganar Usuario" data-idempleado="'.$value->hash->GetValue().'" data-toggle="modal" data-target=""><i class="fa fa-level-up"></i></button>

                    <button class="btn btn-danger btn-xs btnEliminarEmpleado" title="Dar de Baja" data-idempleado="'.$value->hash->GetValue().'" data-toggle="modal" data-target="#modalEliminarEmpleado"><i class="fa fa-times"></i></button>



                  </div>  

                </td>

              </tr>';
              
            }


            ?> 

            </tbody>

           </table>

          </div>

        </div>
   
        <div class="box-footer">

          Footer

        </div>

      </div>

    </section>

  </div>

<?php

  // $borrarUsuario = new ControladorUsuarios();
  // $borrarUsuario -> ctrBorrarUsuario();

// INCLUYENDO MODAL DE AGREGAR EMPLEADO
include "empleados/modal_add.php";

// INCLUYENDO MODAL DE EDITAR EMPLEADO
include "empleados/modal_edit.php";

// INCLUYENDO MODAL DE EDITAR EMPLEADO
include "empleados/modal_delete.php";

// INCLUYENDO MODAL DE EDITAR EMPLEADO
include "empleados/modal_active.php";

?> 
<!-- Script del Empleado -->
<!-- <script src="view/js/empleado.js"></script> -->
