/*==============================================================================
    CARGAR DATOS A MODAL EDITAR CLIENTE NATURAL 
================================================================================*/

$('#modalEditarClienteNatural').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idcliente = button.data('idcliente')
  $('#editaridCliente').val(idcliente)

  var nombre = button.data('nombre') 
  $('#editarNombre').val(nombre)

  var appaterno = button.data('appaterno')
  $('#editarApPaterno').val(appaterno)

  var apmaterno = button.data('apmaterno')
  $('#editarApMaterno').val(apmaterno)

  var fechanac = button.data('fechanac')
  $('#editarFechaNac').val(fechanac)

  var ci = button.data('ci')
  $('#editarCi').val(ci)
  
  var genero = button.data('genero')
  $('#editarGenero').val(genero)

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
    CARGAR DATOS A MODAL DAR DE BAJA CLIENTE NATURAL 
================================================================================*/

$('#modalEliminarClienteNatural').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idcliente = button.data('idcliente')
  $('#eliminaridCliente').val(idcliente)

 
})
/*==============================================================================
    CARGAR DATOS A MODAL ACTIVAR CLIENTE NATURAL 
================================================================================*/

$('#modalActivarClienteNatural').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idcliente = button.data('idcliente')
  $('#activaridCliente').val(idcliente)

 
})

