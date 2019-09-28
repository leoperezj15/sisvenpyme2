/*==============================================================================
    CARGAR DATOS A MODAL EDITAR CLIENTE JURIDICO
================================================================================*/

$('#modalEditarClienteJuridico').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idcliente = button.data('idcliente')
  $('#editaridCliente').val(idcliente)

  var razonsocial = button.data('razonsocial') 
  $('#editarRazonSocial').val(razonsocial)

  var nit = button.data('nit')
  $('#editarNit').val(nit)

  var rptelegal = button.data('rptelegal')
  $('#editarRpteLegal').val(rptelegal)

  var zona = button.data('zona')
  $('#editarZona').val(zona)

  var direccion = button.data('direccion')
  $('#editarDireccion').val(direccion)

  var telcelular = button.data('telcelular')
  $('#editarTelCelular').val(telcelular)

  var telfijo = button.data('telfijo')
  $('#editarTelFijo').val(telfijo)

 
})
/*==============================================================================
    CARGAR DATOS A MODAL DAR DE BAJA CLIENTE JURIDICO 
================================================================================*/

$('#modalEliminarClienteJuridico').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idcliente = button.data('idcliente')
  $('#eliminaridCliente').val(idcliente)

 
})
/*==============================================================================
    CARGAR DATOS A MODAL ACTIVAR CLIENTE Juridico 
================================================================================*/

$('#modalActivarClienteJuridico').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idcliente = button.data('idcliente')
  $('#activaridCliente').val(idcliente)

 
})

