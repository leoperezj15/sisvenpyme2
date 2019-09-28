$( "#add_proveedor" ).submit(function( event ) {
  var parametros = $(this).serialize();
  alert(parametros);
	// $.ajax({
	// 		type: "POST",
	// 		url: "ajax/guardar_producto.php",
	// 		data: parametros,
	// 		 beforeSend: function(objeto){
	// 			$("#resultados").html("Enviando...");
	// 		  },
	// 		success: function(datos){
	// 		$("#resultados").html(datos);
	// 		load(1);
	// 		$('#addProductModal').modal('hide');
	// 	  }
	// });
  event.preventDefault();
});

/*==============================================================================
    CARGAR DATOS A MODAL EDITAR PROVEEDOR 
================================================================================*/

$('#modalEditarProveedor').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idproveedor = button.data('idproveedor')
  $('#editaridProveedor').val(idproveedor)

  var razonsocial = button.data('razonsocial') 
  $('#editarRazonSocial').val(razonsocial)

  var nit = button.data('nit')
  $('#editarNit').val(nit)

  var contacto = button.data('contacto')
  $('#editarContacto').val(contacto)

  var cargo = button.data('cargo')
  $('#editarCargo').val(cargo)

  var direccion = button.data('direccion')
  $('#editarDireccion').val(direccion)
  
  var telfijo = button.data('telfijo')
  $('#editarTelFijo').val(telfijo)

  var telcelular = button.data('telcelular')
  $('#editarTelCelular').val(telcelular)

  var correo = button.data('correo')
  $('#editarCorreo').val(correo)

  var web = button.data('web')
  $('#editarWeb').val(web)
 
})

/*==============================================================================
    CARGAR DATOS A MODAL ELIMINAR PROVEEDOR  
================================================================================*/
$('#modalEliminarProveedor').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idproveedor = button.data('idproveedor')
  $('#eliminaridProveedor').val(idproveedor)

})

/*==============================================================================
    CARGAR DATOS A MODAL ACTIVAR PROVEEDOR  
================================================================================*/
$('#modalActivarProveedor').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idproveedor = button.data('idproveedor')
  $('#activaridProveedor').val(idproveedor)

})