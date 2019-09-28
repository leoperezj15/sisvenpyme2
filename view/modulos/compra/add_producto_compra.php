<div class="box box-solid bg-green-gradient">

  <!-- CABECERA DEL CAJON -->
  
  <div class="box-header">
    
    <i class="fa fa-cart-arrow-down"></i>

    <h3 class="box-title">Adicionar Producto</h3>

    <div class="box-tools pull-right">

      <button type="button" class="btn btn-success btn-sm" data-widget="collapse">

        <i class="fa fa-minus"></i>
        
      </button>
      
    </div>

  </div>

  <!-- CUERPO DEL CAJON -->

  <div class="box-body">

    <!-- PRIMERA FILA DE NOMBRE DE PRODUCTO -->

    <div class="row">

      <div class="col-xs-12">
      
        <div class="form-group">

          <label for="add_nombre">Nombre</label>

          <input type="hidden" name="add_idproducto" id="add_idproducto" value="" required>

          <input class="form-control input-sm" type="text"  name="add_nombre" id="add_nombre" required>

        </div>

      </div>

    </div>

    <!-- SEGUNDA FILA DE CODIGO DE PRODUCTO -->

    <div class="row">

      <div class="col-xs-12">
      
        <div class="form-group">

          <label for="add_codigo">Código</label>

          <input type="text" id="add_codigo" class="form-control input-sm" required>

        </div>

      </div>

    </div>

    <!-- TERCERA FILA DE MODELO DE PRODUCTO -->

    <div class="row">

      <div class="col-xs-12">
      
        <div class="form-group">

          <label for="add_modelo">Modelo</label>

          <input type="text"  name="add_modelo" id="add_modelo" class="form-control input-sm" value="" required readonly>

        </div>

      </div>

    </div>

    <!-- 4TA FILA DE CANTIDAD DE PRODUCTO -->

    <div class="row">

      <div class="col-xs-12">
      
        <div class="form-group">

          <label for="add_cantidad">Cantidad</label>

          <input type="number" name="add_cantidad" id="add_cantidad" class="form-control input-sm" value="1" required>

        </div>

      </div>

    </div>

    <!-- 6TA FILA DE PRECIO DE PRODUCTO -->

    <div class="row">

      <div class="col-xs-12">
      
        <div class="form-group">

          <label for="add_precio">Precio</label>

        </div>

        <div class="input-group">

          <span class="input-group-addon"><i class="fa fa-dollar"></i></span>

          <input type="number" class="form-control input-sm" name="add_precio" id="add_precio" value="0.00" set="any"required readonly>

          <span class="input-group-addon"><i class="fa fa-ambulance"></i></span>

        </div>

      </div>

    </div>

  </div>

  <!-- PIE DEL CAJON -->

  <div class="box-footer">

    <form>

      <div class="row">

        <div class="col-xs-12">
          
          <button type="button" class="btn btn-warning btn-lg btn-block" id="btnAdicionarProductos" ><i class="fa fa-cart-plus"></i>   Adicionar</button>


        </div>

      </div>

    </form>
    

  </div>


</div>