<!-- Primera caja para sacar reportes de venta por rango de fechas -->
<div class="box box-primary">

  <div class="box-header">

    <h3 class="box-title">Reportes de Venta por fecha</h3>

  </div>

<div class="box-body">

  <div class="row">

    <div class="col-xs-4">

      <div class="form-group">

        <label>Rango de Fechas:</label>

        <div class="input-group">

          <button type="button" class="btn btn-info pull-right" id="Ventas_por_fecha">

            <span>

              <i class="fa fa-calendar"></i> Selecione las fechas

            </span>

            <i class="fa fa-caret-down"></i>

          </button>

          <input type="hidden" id="rv_rangofechas" name="rv_rangofechas" value="" required>

        </div>

      </div>

    </div>

    <div class="col-xs-4">

      <div class="form-group">

        <label for="usuario">Por usuario:</label>

        <input class="form-control" id="usuario" name="usuario" type="text">

        <input type="hidden" name="rv_usuario" id="rv_usuario" value="">

      </div>

    </div>

    <div class="col-xs-4">

      <div class="form-group">

        <label for="">Por Cliente:</label>

        <input class="form-control" id="cliente" name="cliente" type="text">

        <input type="hidden" name="rv_cliente" id="rv_cliente" value="">

      </div>

    </div>

  </div>

  <div class="row">

    <div class="col-xs-6">

      <button id="btnReporteVentas" name="btnReporteVentas" class="btn btn-block btn-success">Consultar</button>

    </div>

    <div class="col-xs-6" id="button_response_RV">

      
      
    </div>

  </div>

</div>

</div>
<script>
$(function() {
  $("#cliente").autocomplete({
    source: "control/auto_cliente.php",
    minLength: 3,
    select: function(event, ui) {
      event.preventDefault();
      $('#rv_cliente').val(ui.item.idCliente);
      $('#cliente').val(ui.item.nombre); 
     }
  });
});
          
$("#cliente" ).on( "keydown", function( event ) {
  if (event.keyCode== $.ui.keyCode.LEFT || 
    event.keyCode== $.ui.keyCode.RIGHT || 
    event.keyCode== $.ui.keyCode.UP || 
    event.keyCode== $.ui.keyCode.DOWN || 
    event.keyCode== $.ui.keyCode.DELETE || 
    event.keyCode== $.ui.keyCode.BACKSPACE )
  {
    $("#rv_cliente").val("");
    $("#cliente").val("");
            
  }
  if (event.keyCode==$.ui.keyCode.DELETE){
    $("#cliente").val("");
    $("#rv_cliente").val("");
  }
});



$(function() {
  $("#usuario").autocomplete({
    source: "control/auto_usuario.php",
    minLength: 2,
    select: function(event, ui) {
      event.preventDefault();
      $('#rv_usuario').val(ui.item.idusuario);
      $('#usuario').val(ui.item.username);                     
      
     }
  });
});
          
$("#usuario" ).on( "keydown", function( event ) {
  if (event.keyCode== $.ui.keyCode.LEFT || 
      event.keyCode== $.ui.keyCode.RIGHT || 
      event.keyCode== $.ui.keyCode.UP || 
      event.keyCode== $.ui.keyCode.DOWN || 
      event.keyCode== $.ui.keyCode.DELETE || 
      event.keyCode== $.ui.keyCode.BACKSPACE )
  {
    $("#usuario" ).val("");
    $("#rv_usuario" ).val("");
            
  }
  if (event.keyCode==$.ui.keyCode.DELETE){
    $("#rv_usuario").val("");
    $("#usuario").val("");

  }
});   
</script>