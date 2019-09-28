<?php

if (isset($_SESSION["ObjetosValidos"])) 
{
  $objetos = $_SESSION["ObjetosValidos"];

  $contador = 0;

  for ($i=0; $i < count($objetos); $i++) 
  { 
    if ($objetos[$i]=="sucursales") 
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

        Panel de Sucursales

        <small>Gestionar las Sucursales</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li class="active">Sucursales</li>

      </ol>

    </section>

    
    <section class="content">

      <div class="box box-danger">

        <div class="box-header with-border">


          <button class="btn btn-warning" data-toggle="modal" data-target="#modalAgregarSucursal">

            <i class="fa fa-plus-square" style=" width: 20px; height: 20px"></i>
          
            Agregar Sucursal

          </button>

        </div>
        
        <div class="box-body">

          <h3 class="box-title">Listado de Sucursales</h3>

          <div class="table-responsive">
            
            <table class="table table-bordered shadow-lg rounded table-striped dt-responsive dataTable tablas" width="100%">
         
            <thead>
             
             <tr>
               
               <th style="width:10px">#</th>
               <th>Nombre</th>
               <th>Ubicación</th>
               <th>Descripción</th>
               <th>Dirección</th>
               <th>Estado</th>
               <th>Acciones</th>

             </tr> 

            </thead>

            <tbody>

            <?php

            $item = null;
            $valor = null;

            $sucursales = ControladorSucursal::ctrMostrarSucursales();

           foreach ($sucursales as $key => $value)
           {
             
              echo ' <tr>
                      <td>'.($key+1).'</td>
                      <td>'.$value->Nombre->GetValue().'</td>
                      <td><center>
                        <button class="btn btn-info btn-xs" data-ubicacion="'.$value->Ubicacion->GetValue().'" data-toggle="modal" data-target="#modalVerSucursal" data-lat="-17.794015" data-lng="-63.187848"><i class="fa fa-globe"></i>  Ver Ubicación
                        </button>
                      </center></td>
                      <td>'.$value->Descripcion->GetValue().'</td>
                      <td>'.$value->Direccion->GetValue().'</td>'
                      ;

              if($value->estado->GetValue() == "Activo")
              {

                echo '<td><button class="btn btn-success btn-xs btnActivar">Activado</button></td>';

              }
              else
              {

                echo '<td><button class="btn btn-danger btn-xs btnActivar" data-idsucursal="'.$value->hash->GetValue().'" data-toggle="modal" data-target="#modalActivarSucursal">Desactivado</button></td>';

              }             

              echo '
                <td>

                  <div class="btn-group">
                      
                    <button class="btn btn-warning btn-xs btnEditarSucursal" data-toggle="modal" data-target="#modalEditarSucursal"
                      data-idsucursal="'.$value->hash->GetValue().'"
                      data-nombre="'.$value->Nombre->GetValue().'"
                      data-ubicacion="'.$value->Ubicacion->GetValue().'"
                      data-descripcion="'.$value->Descripcion->GetValue().'"
                      data-direccion="'.$value->Direccion->GetValue().'"
                    ><i class="fa fa-pencil"></i></button>

                    <button class="btn btn-danger btn-xs btnEliminarSucursal" data-idsucursal="'.$value->hash->GetValue().'" data-toggle="modal" data-target="#modalEliminarSucursal"><i class="fa fa-times"></i></button>

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

//INCLUYENDO MODAL DE AGREGAR Almacenes
include "sucursales/modal_add.php";

//INCLUYENDO MODAL DE EDITAR Almacenes
include "sucursales/modal_edit.php";

//INCLUYENDO MODAL DE EDITAR Almacenes
include "sucursales/modal_delete.php";

//INCLUYENDO MODAL DE EDITAR Almacenes
include "sucursales/modal_active.php";

//INCLUYENDO MODAL DE EDITAR Almacenes
include "sucursales/modal_view.php";

?> 

