<?php

if (isset($_SESSION["ObjetosValidos"])) 
{
  $objetos = $_SESSION["ObjetosValidos"];

  $contador = 0;

  for ($i=0; $i < count($objetos); $i++) 
  { 
    if ($objetos[$i]=="juridico") 
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

        Panel de Cliente Juridico

        <small>Gestionar Clientes Jurídicos</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li class="active">Jurídico</li>

      </ol>

    </section>

    
    <section class="content">

      <div class="box box-danger">

        <div class="box-header with-border">


          <button class="btn btn-warning" data-toggle="modal" data-target="#modalAgregarClienteJuridico">

            <i class="fa fa-plus-square" style=" width: 10px; height: 20px"></i>
          
            Nuevo Cliente

          </button>

        </div>
        
        <div class="box-body">

          <h3 class="box-title">Listado de Clientes Jurídico</h3>

          <div class="table_respondive">
            
            <table class="table table-bordered shadow-lg rounded table-striped dt-responsive dataTable tablas" width="100%">
         
            <thead>
             
             <tr>
               
               <th style="width:10px">#</th>
               <th>Razon Social</th>
               <th>Nit</th>
               <th>Rpte Legal</th>
               <th>Dirección</th>
               <th>Zona</th>
               <th>Tel. Fijo</th>
               <th>Celular</th>
               <th>Estado</th>
               <th>Acciones</th>

             </tr> 

            </thead>

            <tbody>

            <?php

            $juridico = ControladorJuridico::ctrMostrarClienteJuridico();

            // echo "<pre>";
            // print_r($natural);
            // echo "</pre>";

           foreach ($juridico as $key => $value)
           {             
              echo ' <tr>
                      <td>'.($key+1).'</td>
                      <td><h6>'.$value->razon_social->GetValue().'</h6></td>
                      <td><h6><b>'.$value->nit->GetValue().'</b></h6></td>
                      <td><h6>'.$value->rpte_legal->GetValue().'</h6></td>
                      <td><h6>'.$value->Cliente->direccion->GetValue().'</h6></td>
                      <td><h6>'.$value->Cliente->zona->GetValue().'</h6></td>';
              if($value->Cliente->tel_fijo->GetValue() != "")
              {
                echo '<td><h6>'.$value->Cliente->tel_fijo->GetValue().'</h6></td>';
              }
              else
              {
                echo '<td><h6>No tiene</h6></td>';
              }
              echo '
                      <td><h6>'.$value->Cliente->tel_celular->GetValue().'</h6></td>  
                    ';

              if($value->Cliente->estado->GetValue() == "Activo")
              {

                echo '<td><button class="btn btn-success btn-xs btnActivar">Activado</button></td>';

              }
              else
              {

                echo '<td><button class="btn btn-danger btn-xs btnActivar" data-idcliente="'.$value->Cliente->hash->GetValue().'" data-toggle="modal" data-target="#modalActivarClienteJuridico" title="Activar">Desactivado</button></td>';

              }             

              echo '
                <td>

                  <center>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btn-xs btnEditarClienteNatural" data-toggle="modal" data-target="#modalEditarClienteJuridico"
                        data-idcliente="'.$value->Cliente->hash->GetValue().'"
                        data-razonsocial="'.$value->razon_social->GetValue().'"
                        data-rptelegal="'.$value->rpte_legal->GetValue().'"
                        data-nit="'.$value->nit->GetValue().'"
                        data-direccion="'.$value->Cliente->direccion->GetValue().'"
                        data-zona="'.$value->Cliente->zona->GetValue().'"
                        data-telfijo="'.$value->Cliente->tel_fijo->GetValue().'"
                        data-telcelular="'.$value->Cliente->tel_celular->GetValue().'"
                        title="Editar"
                      ><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btn-xs btnEliminarClienteJuridico" data-idcliente="'.$value->Cliente->hash->GetValue().'" data-toggle="modal" data-target="#modalEliminarClienteJuridico" title="Desactivar"><i class="fa fa-times"></i></button>

                    </div>

                  </center>

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

//INCLUYENDO MODAL DE AGREGAR CLIENTES JURIDICO
include "juridico/modal_add.php";

//INCLUYENDO MODAL DE EDITAR CLIENTES JURIDICO
include "juridico/modal_edit.php";

//INCLUYENDO MODAL DE Eliminar CLIENTES JURIDICO
include "juridico/modal_delete.php";

//INCLUYENDO MODAL DE ACTIVAR CLIENTES JURIDICO
include "juridico/modal_active.php";


?> 

