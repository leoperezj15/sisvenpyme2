<?php  


?>

<div class="content-wrapper">

    <section class="content-header">

      <h1>

        Panel de Compras

        <small>Gestionar Listado de Compras</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li class="active">Lista de Compras</li>

      </ol>

    </section>

    
    <section class="content">

      <div class="box box-danger">

        <div class="box-header with-border">


          <button class="btn btn-warning" data-toggle="modal" data-target="#modalAgregarClienteNatural">

            <i class="fa fa-plus-square" style=" width: 10px; height: 20px"></i>
          
            Nueva Compra

          </button>

        </div>
        
        <div class="box-body">

          <h3 class="box-title">Listado de Compras</h3>

          <!-- ========================================================
              LISTADO DE COMPRAS
            ========================================================== -->

          <div class='col-sm-4 pull-right'>

            <div id="custom-search-input">

                <div class="input-group col-md-12">

                    <input type="text" class="form-control" placeholder="Buscar"  id="q" onkeyup="load(1);" />

                    <span class="input-group-btn">

                        <button class="btn btn-info" type="button" onclick="load(1);">

                            <span class="glyphicon glyphicon-search">Buscar</span>

                        </button>

                    </span>

                </div>

            </div>

          </div>

          <div class='clearfix'></div>
          <hr>
          <div id="loader"></div><!-- Carga de datos ajax aqui -->
          <div id="resultados"></div><!-- Carga de datos ajax aqui -->
          <div class='outer_div'></div><!-- Carga de datos ajax aqui -->

          </div>
     
          <div class="box-footer">

          Footer

        </div>

      </div>

    </section>

  </div>

<script src="view/js/compra.js"></script>