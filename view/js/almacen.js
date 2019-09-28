/*==============================================================================
    CARGAR DATOS A MODAL EDITAR ALMACEN    
================================================================================*/

$('#modalEditarAlmacen').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idAlmacen = button.data('idalmacen')
  $('#editaridAlmacen').val(idAlmacen)

  var nombre = button.data('nombre') 
  $('#editarNombre').val(nombre)

  var sigla = button.data('sigla')
  $('#editarSigla').val(sigla)

  var sucursal = button.data('sucursal')
  $('#editarSucursal').val(sucursal)
 
})
/*==============================================================================
    CARGAR DATOS A MODAL ELIMINAR EMPLEADO    
================================================================================*/
$('#modalEliminarAlmacen').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idAlmacen = button.data('idalmacen')
  $('#eliminaridAlmacen').val(idAlmacen)
 
})

/*==============================================================================
    CARGAR DATOS A MODAL Activar EMPLEADO    
================================================================================*/
$('#modalActivarAlmacen').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idAlmacen = button.data('idalmacen')
  $('#activaridAlmacen').val(idAlmacen)
 
})
