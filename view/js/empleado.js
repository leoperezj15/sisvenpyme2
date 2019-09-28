/*==============================================================================
        
================================================================================*/

$( "#add_empleado" ).submit(function( event ) {
  var parametros = $(this).serialize();
  //alert(parametros);
  //   $.ajax({
  //           type: "POST",
  //           url: "control/empleado.control.php",
  //           data: parametros,
  //            beforeSend: function(objeto){
  //               $("#resultados").html("Enviando...");
  //             },
  //           success: function(datos){
  //           $("#resultados").html(datos);
  //           load(1);
  //           $('#modalAgregarEmpleado').modal('hide');
  //         }
  //   });
  // event.preventDefault();
});


/*==============================================================================
    EDITAR EMPLEADO    
================================================================================*/

$(".btnEditarEmpleado").click(function(){

  var idEmpleado = $(this).attr("idempleado");
  //console.log("idEmpleado",idEmpleado);
  var datos = new FormData();

  datos.append("idEmpleado",idEmpleado);

  $.ajax({

    url: "ajax/empleados.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
      
      console.log("respuesta" ,respuesta);
    }

  });

})
/*==============================================================================
    CARGAR DATOS A MODAL EDITAR EMPLEADO    
================================================================================*/

$('#modalEditarEmpleado').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idEmpleado = button.data('idempleado')
  $('#editaridEmpleado').val(idEmpleado)

  var nombre = button.data('nombre') 
  $('#editarNombre').val(nombre)

  var paterno = button.data('paterno')
  $('#editarPaterno').val(paterno)

  var materno = button.data('materno')
  $('#editarMaterno').val(materno)

  var fecha = button.data('fecha')
  $('#editarFecha').val(fecha)
  
  var ci = button.data('ci')
  $('#editarCI').val(ci)
 
})
/*==============================================================================
    CARGAR DATOS A MODAL ELIMINAR EMPLEADO    
================================================================================*/
$('#modalEliminarEmpleado').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idEmpleado = button.data('idempleado')
  $('#eliminaridEmpleado').val(idEmpleado)
 
})

/*==============================================================================
    CARGAR DATOS A MODAL Activar EMPLEADO    
================================================================================*/
$('#modalActivarEmpleado').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idEmpleado = button.data('idempleado')
  $('#activaridEmpleado').val(idEmpleado)
 
})
