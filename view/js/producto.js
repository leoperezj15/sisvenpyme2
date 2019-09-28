/*================================================================
    CARGAR LA TABLA DINAMICA DE COMPRAS CON AJAX
=================================================================== */

$.ajax({
    url: "ajax/producto.ajax.php",
    success: function(respuesta){
        console.log('respuesta', respuesta);
    }

})

/*================================================================
    CARGAR LA TABLA DINAMICA DE PRODUCTOS CON AJAX
=================================================================== */

$(".tablaProducto").DataTable({
    "processing": true,
    "responsive": true,
    "ajax": "ajax/producto.ajax.php",
    "language": {

        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                    },
        "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera Ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera Descendente"
                }

    }
    

});
/*======================================================================
		FUNCION PARA LISTAR ALMACEN POR SUCURSAL
========================================================================*/
function ListarModeloPorMarca(obj){

    idMarca = $(obj).val();
    $.ajax({
        type	: 'post',
        url     : 'control/x-fn.php',
        data    : 'fn=ModeloPorMarca&idMarca=' + idMarca,
        success : function (res){
            $("#cajon-modelo").html(res);
        }
    })
    
}
