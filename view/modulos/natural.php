<?php

if (isset($_SESSION["ObjetosValidos"])) 
{
  $objetos = $_SESSION["ObjetosValidos"];

  $contador = 0;

  for ($i=0; $i < count($objetos); $i++) 
  { 
    if ($objetos[$i]=="natural") 
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

        Panel de Cliente Natural

        <small>Gestionar Clientes Naturales</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li class="active">Naturales</li>

      </ol>

    </section>

    
    <section class="content">

      <div class="box box-danger">

        <div class="box-header with-border">


          <button class="btn btn-warning" data-toggle="modal" data-target="#modalAgregarClienteNatural">

            <i class="fa fa-plus-square" style=" width: 10px; height: 20px"></i>
          
            Nuevo Cliente

          </button>

        </div>
        
        <div class="box-body">

          <h3 class="box-title">Listado de Clientes Naturales</h3>

          <div class="table-responsive">
            
            <table class="table table-bordered table-bordered table-striped table-sm table-striped dt-responsive dataTable tablas" width="100%">
         
            <thead>
             
             <tr>
               
               <th style="width:10px">#</th>
               <th><small>Nombre</small></th>
               <th><small>Ci</small></th>
               <th><small>Nacimiento</small></th>
               <th><small>Dirección</small></th>
               <th><small>Zona</small></th>
               <th><small>Tel. Fijo</small></th>
               <th><small>Celular</small></th>
               <th><small>Estado</small></th>
               <th><small>Acciones</small></th>
               <th><small>Género</small></th>

             </tr> 

            </thead>

            <tbody>

            <?php

            $natural = ControladorNatural::ctrMostrarClienteNatural();

            // echo "<pre>";
            // print_r($natural);
            // echo "</pre>";

           foreach ($natural as $key => $value)
           {
              $fecha = $value->fecha_nac->GetValue();
              $fecha_nac = explode("-", $fecha);
              $fecha = "".$fecha_nac[2]."/".$fecha_nac[1]."/".$fecha_nac[0]."";
             
              echo ' <tr>
                      <td>'.($key+1).'</td>
                      <td><small>'.$value->nombre->GetValue().' '.$value->ap_paterno->GetValue().' '.$value->ap_materno->GetValue().'</small></td>
                      <td><small><b>'.$value->ci->GetValue().'</b></small></td>
                      <td><small>'.$fecha.'</small></td>
                      <td><small>'.$value->Cliente->direccion->GetValue().'</small></td>
                      <td><small>'.$value->Cliente->zona->GetValue().'</small></td>';
              if($value->Cliente->tel_fijo->GetValue() != "")
              {
                echo '<td><small>'.$value->Cliente->tel_fijo->GetValue().'</small></td>';
              }
              else
              {
                echo '<td><small>No tiene</small></td>';
              }
              echo '
                      <td><small>'.$value->Cliente->tel_celular->GetValue().'</small></td>  
                    ';

              if($value->Cliente->estado->GetValue() == "Activo")
              {

                echo '<td><button class="btn btn-success btn-xs btnActivar">Activado</button></td>';

              }
              else
              {

                echo '<td><button class="btn btn-danger btn-xs btnActivar" data-idcliente="'.$value->Cliente->hash->GetValue().'" data-toggle="modal" data-target="#modalActivarClienteNatural" title="Activar">Desactivado</button></td>';

              }             

              echo '
                <td>

                  <center>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btn-xs btnEditarClienteNatural" data-toggle="modal" data-target="#modalEditarClienteNatural"
                        data-idcliente="'.$value->Cliente->hash->GetValue().'"
                        data-nombre="'.$value->nombre->GetValue().'"
                        data-appaterno="'.$value->ap_paterno->GetValue().'"
                        data-apmaterno="'.$value->ap_materno->GetValue().'"
                        data-fechanac="'.$value->fecha_nac->GetValue().'"
                        data-ci="'.$value->ci->GetValue().'"
                        data-genero="'.$value->genero->GetValue().'"
                        data-direccion="'.$value->Cliente->direccion->GetValue().'"
                        data-zona="'.$value->Cliente->zona->GetValue().'"
                        data-telfijo="'.$value->Cliente->tel_fijo->GetValue().'"
                        data-telcelular="'.$value->Cliente->tel_celular->GetValue().'"
                        title="Editar"
                      ><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btn-xs btnEliminarClienteNatural" data-idcliente="'.$value->Cliente->hash->GetValue().'" data-toggle="modal" data-target="#modalEliminarClienteNatural" title="Desactivar"><i class="fa fa-times"></i></button>

                    </div>

                  </center>

                </td>';
              if ($value->genero->GetValue()== 'Masculino') 
              {
                  
                echo '<td><center><button class="btn btn-info btn-xs" title="Masculino"><i class="fa fa-male"></i></button></center></td>';

              }
              elseif ($value->genero->GetValue()== 'Femenino') 
              {
                echo '<td><center><button class="btn btn-warning btn-xs" title="Femenino"><i class="fa fa-female"></i></button></center></td>';
              }
              else
              {
                echo '<td><center><button class="btn btn-general btn-xs" title="Otro"><i class="fa fa-user-secret"></i></button></center></td>';
              }
                echo '

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

//INCLUYENDO MODAL DE AGREGAR CLIENTES NATURALES
include "natural/modal_add.php";

//INCLUYENDO MODAL DE EDITAR CLIENTES NATURALES
include "natural/modal_edit.php";

//INCLUYENDO MODAL DE Eliminar CLIENTES NATURALES
include "natural/modal_delete.php";

//INCLUYENDO MODAL DE ACTIVAR CLIENTES NATURALES
include "natural/modal_active.php";


?> 

