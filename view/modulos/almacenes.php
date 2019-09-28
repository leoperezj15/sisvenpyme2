<?php

if (isset($_SESSION["ObjetosValidos"])) 
{
  $objetos = $_SESSION["ObjetosValidos"];

  $contador = 0;

  for ($i=0; $i < count($objetos); $i++) 
  { 
    if ($objetos[$i]=="almacenes") 
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

        Panel de Almacenes

        <small>Gestionar los almacenes</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li class="active">Almacenes</li>

      </ol>

    </section>

    
    <section class="content">

      <div class="box box-danger">

        <div class="box-header with-border">


          <button class="btn btn-warning" data-toggle="modal" data-target="#modalAgregarAlmacen">

            <i class="fa fa-plus-square" style=" width: 20px; height: 20px"></i>
          
            Agregar Almacen

          </button>

        </div>
        
        <div class="box-body">

          <h3 class="box-title">Listado de Almacenes</h3>

          <div class="table-responsive">
            
            <table class="table table-bordered shadow-lg rounded table-striped dt-responsive tablas" width="100%">
         
            <thead>
             
             <tr>
               
               <th style="width:10px">#</th>
               <th>Nombre</th>
               <th>Sigla</th>
               <th>Sucursal</th>
               <th>Estado</th>
               <th>Acciones</th>

             </tr> 

            </thead>

            <tbody>

            <?php

            $item = null;
            $valor = null;

            $almacenes = ControladorAlmacen::ctrMostrarAlmacenes();

           foreach ($almacenes as $key => $value)
           {
             
              echo ' <tr>
                      <td>'.($key+1).'</td>
                      <td>'.$value->nombre->GetValue().'</td>
                      <td>'.$value->sigla->GetValue().'</td>
                      <td>'.$value->Sucursal->Nombre->GetValue().'</td>'
                      ;

              if($value->estado->GetValue() == "Activo")
              {

                echo '<td><button class="btn btn-success btn-xs btnActivar" estadoUsuario="Activo">Activado</button></td>';

              }
              else
              {

                echo '<td><button class="btn btn-danger btn-xs btnActivar" data-idalmacen="'.$value->hash->GetValue().'" data-toggle="modal" data-target="#modalActivarAlmacen">Desactivado</button></td>';

              }             

              echo '
                <td>

                  <div class="btn-group">
                      
                    <button class="btn btn-warning btn-xs btnEditarAlmacen" data-toggle="modal" data-target="#modalEditarAlmacen"
                      data-idalmacen="'.$value->hash->GetValue().'"
                      data-nombre="'.$value->nombre->GetValue().'"
                      data-sigla="'.$value->sigla->GetValue().'"
                      data-sucursal="'.$value->Sucursal->hash->GetValue().'"><i class="fa fa-pencil"></i></button>

                    <button class="btn btn-danger btn-xs btnEliminarAlmacen" data-idalmacen="'.$value->hash->GetValue().'" data-toggle="modal" data-target="#modalEliminarAlmacen"><i class="fa fa-times"></i></button>

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

// INCLUYENDO MODAL DE AGREGAR Almacenes
include "almacenes/modal_add.php";

// INCLUYENDO MODAL DE EDITAR Almacenes
include "almacenes/modal_edit.php";

// INCLUYENDO MODAL DE EDITAR Almacenes
include "almacenes/modal_delete.php";

// INCLUYENDO MODAL DE EDITAR Almacenes
include "almacenes/modal_active.php";

?> 
<!-- Script del Empleado -->
<!-- <script src="view/js/empleado.js"></script> -->
