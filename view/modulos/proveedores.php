<?php

if (isset($_SESSION["ObjetosValidos"])) 
{
  $objetos = $_SESSION["ObjetosValidos"];

  $contador = 0;

  for ($i=0; $i < count($objetos); $i++) 
  { 
    if ($objetos[$i]=="proveedores") 
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

        Panel de Proveedores

        <small>Gestionar proveedor</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li class="active">Proveedores</li>

      </ol>

    </section>

    
    <section class="content">

      <div class="box box-danger">

        <div class="box-header with-border">


          <button class="btn btn-warning" data-toggle="modal" data-target="#modalAgregarProveedor">

            <i class="fa fa-plus-square" style=" width: 20px; height: 20px"></i>
          
            Agregar Proveedor

          </button>

        </div>
        
        <div class="box-body">

          <h3 class="box-title">Listado de Proveedores</h3>

          <div class="table-responsive">
            
            <table class="table table-bordered shadow-lg rounded table-striped dt-responsive dataTable tablas" width="100%">
         
            <thead>
             
             <tr>
               
               <th style="width:10px">#</th>
               <th>Razón Social</th>
               <th>Nit</th>
               <th>Contacto</th>
               <th>Cargo</th>
               <th>Dirección</th>
               <th>Tel. Fijo</th>
               <th>Tel. Celular</th>
               <th>Estado</th>
               <th>Acciones</th>
               <th>Email</th>
               <th>Web</th>

             </tr> 

            </thead>

            <tbody>

            <?php

            $proveedores = ControladorProveedores::ctrMostrarProveedores();

           foreach ($proveedores as $key => $value)
           {
             
              echo ' <tr>
                      <td>'.($key+1).'</td>
                      <td><h6>'.$value->razon_social->GetValue().'</h6></td>
                      <td><h6><b>'.$value->nit->GetValue().'</b></h6></td>
                      <td><h6>'.$value->contacto->GetValue().'</h6></td>
                      <td><h6>'.$value->cargo_contacto->GetValue().'</h6></td>
                      <td><h6>'.$value->direccion->GetValue().'</h6></td>
                      <td><h6>'.$value->tel_fijo->GetValue().'</h6></td>
                      <td><h6>'.$value->tel_celular->GetValue().'</h6></td>
                      
                    ';

              if($value->estado->GetValue() == "Activo")
              {

                echo '<td><button class="btn btn-success btn-xs btnActivar" data-toggle="popover" title="Desactivar Proveedor" data-content="Desactive primero el campo">Activado</button></td>';

              }
              else
              {

                echo '<td><button class="btn btn-danger btn-xs btnActivar" data-idproveedor="'.$value->hash->GetValue().'" data-toggle="modal" data-target="#modalActivarProveedor">Desactivado</button></td>';

              }             

              echo '
                <td>

                  <center>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btn-xs btnEditarProvedor" data-toggle="modal" data-target="#modalEditarProveedor"
                        data-idproveedor="'.$value->hash->GetValue().'"
                        data-nit="'.$value->nit->GetValue().'"
                        data-razonsocial="'.$value->razon_social->GetValue().'"
                        data-contacto="'.$value->contacto->GetValue().'"
                        data-cargo="'.$value->cargo_contacto->GetValue().'"
                        data-direccion="'.$value->direccion->GetValue().'"
                        data-telfijo="'.$value->tel_fijo->GetValue().'"
                        data-telcelular="'.$value->tel_celular->GetValue().'"
                        data-correo="'.$value->correo->GetValue().'"
                        data-web="'.$value->web->GetValue().'"
                      ><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btn-xs btnEliminarProveedor" data-idproveedor="'.$value->hash->GetValue().'" data-toggle="modal" data-target="#modalEliminarProveedor"><i class="fa fa-times"></i></button>

                    </div>

                  </center>

                </td>
                <td><h6>'.$value->correo->GetValue().'</h6></td>
                <td><h6>'.$value->web->GetValue().'</h6></td>

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

//INCLUYENDO MODAL DE AGREGAR Proveedores
include "proveedores/modal_add.php";

//INCLUYENDO MODAL DE EDITAR Proveedores
include "proveedores/modal_edit.php";

//INCLUYENDO MODAL DE EDITAR Proveedores
include "proveedores/modal_delete.php";

//INCLUYENDO MODAL DE EDITAR Proveedores
include "proveedores/modal_active.php";


?> 

