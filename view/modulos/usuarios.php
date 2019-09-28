<?php

if (isset($_SESSION["ObjetosValidos"])) 
{
  $objetos = $_SESSION["ObjetosValidos"];

  $contador = 0;

  for ($i=0; $i < count($objetos); $i++) 
  { 
    if ($objetos[$i]=="usuarios") 
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
      
      Administrar usuarios
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar usuarios</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
          
          Agregar usuario

        </button>

        <h4>Aqui se muestra solo empleados con sus respectivos usuarios</h4>

      </div>

      <div class="box-body">

        <div class="table-responsive">
          
          <table class="table table-bordered table-striped dt-responsive dataTable tablas" width="100%">
         
            <thead>
             
             <tr>
               
               <th style="width:10px">#</th>
               <th>Usuario</th>
               <th>Email</th>
               <th>Rol</th>
               <th>Nombre</th>
               <th>Estado</th>
               <th>Operaciones</th>

             </tr> 

            </thead>

            <tbody>

            <?php

            $item = null;
            $valor = null;

            $usuarios = ControladorUsuarios::ctrMostrarUsuarios();

            // echo '<pre>';
            // print_r($usuarios);
            // echo '</pre>';


            foreach ($usuarios as $key => $value) 
            {
              echo '<tr>

                      <td>'.($key+1).'</td> 
                      <td>'.$value->username->GetValue().'</td>
                      <td>'.$value->email->GetValue().'</td>
                      <td>'.$value->Rol->nombre->GetValue().'</td>
                      <td>'.$value->Empleado->nombre->GetValue().' '.$value->Empleado->a_paterno->GetValue().' '.$value->Empleado->a_materno->GetValue().'</td>
                      ';
              if($value->estado->GetValue() != "Inactivo")
              {

                echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value->idUsuario->GetValue().'" estadoUsuario="Activo">Activo</button></td>';

              }else{

                echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value->idUsuario->GetValue().'" estadoUsuario="Inactivo">Inactivo</button></td>';

              }
              echo '
                      <td>

                        <div class="btn-group">

                          <button class="btn btn-info btn-xs btnVerUsuario" title="Ver Datos de Usuario" idUsuario="'.$value->idUsuario->GetValue().'"><i class="fa fa-eye "></i></button>

                          <button class="btn btn-success btn-xs btnEliminarUsuario" title="Cambiar contraseña" idUsuario="'.$value->idUsuario->GetValue().'"><i class="fa fa-edit "></i></button>
                            
                          <button class="btn btn-warning btn-xs btnEditarUsuario" title="Editar Usuario" idUsuario="'.$value->idUsuario->GetValue().'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>

                          <button class="btn btn-danger btn-xs btnEliminarUsuario" title="Dar de Baja a Usuario" idUsuario="'.$value->idUsuario->GetValue().'"><i class="fa fa-times"></i></button>



                        </div>  

                      </td>

                    </tr>';  
            }

            ?> 

            </tbody>

           </table>

        </div>

      </div>

    </div>

  </section>

</div>
<?php

// INCLUYENDO MODAL DE AGREGAR EMPLEADO
include "usuario/modal_add.php";

// INCLUYENDO MODAL DE EDITAR EMPLEADO
include "usuario/modal_edit.php";

// INCLUYENDO MODAL DE EDITAR EMPLEADO
include "usuario/modal_delete.php";

// INCLUYENDO MODAL DE EDITAR EMPLEADO
include "usuario/modal_active.php";

?> 
<!-- Script del Empleado -->
<!-- <script src="view/js/empleado.js"></script> -->

