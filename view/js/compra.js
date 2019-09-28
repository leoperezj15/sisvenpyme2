/*================================================================
    CARGAR LA TABLA DINAMICA DE COMPRAS CON AJAX
=================================================================== */

// $.ajax({
//     url: "ajax/compra.ajax.php",
//     success: function(respuesta){
//         console.log('respuesta', respuesta);
//     }

// })
/*================================================================
    CARGAR LA TABLA DINAMICA DE COMPRAS CON AJAX
=================================================================== */

$(".tablaCompras").DataTable({
    "dom": "Bfrtip",
    "processing": true,
    "responsive": true,
    "ajax": "ajax/compra.ajax.php",
    "buttons": [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ],
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
/*================================================================
    CARGAR COMBO DE ALMACEN
=================================================================== */

function ListarAlmacenPorSucursal1(obj){

idSucursal = $(obj).val();
console.log("idSucursal", idSucursal);
$.ajax({
    type    : 'post',
    url     : 'control/x-fn.php',
    data    : 'fn=AlmacenPorSucursal&idSucursal=' + idSucursal,
    success : function (res){
        $("#cajon-almacen").html(res);
    }
})

};

/*================================================================
    BOTON PARA ADICIONAR PRODUCTOS A LA LISTA
=================================================================== */
$("#btnAdicionarProductos").click(function(){

    idproducto = $("#add_idproducto").val();
    nombre = $("#add_nombre").val();
    if(nombre=="")
    {
        document.getElementById('add_nombre').focus();

        swal({
            position: 'top',
            type: 'error',
            title: 'Al menos debe cargar un producto',
            showConfirmButton: false,
            timer: 1500
        });

        return false;
    }
    codigo = $("#add_codigo").val();
    idmodelo = $("#add_idmodelo").val();
    modelo = $("#add_modelo").val();
    cantidad = $("#add_cantidad").val();
    if (cantidad==0) 
    {
        document.getElementById('add_cantidad').focus();

        swal({
            position: 'top',
            type: 'error',
            title: 'La Cantidad no puede ser 0',
            showConfirmButton: false,
            timer: 1500
        });
        
        return false;
    }
    precio = $("#add_precio").val();
    if(precio=="0.00" || precio=="0")
    {
        document.getElementById('add_precio').focus();

        swal({
            position: 'top',
            type: 'error',
            title: 'El Precio no puede ser 0',
            showConfirmButton: false,
            timer: 1500
        });

        return false;
    }
    
    $.ajax({
        type    : 'post',
        url     : 'control/compra.control.php',
        data    : 'fn=AdicionarProductos&idproducto=' + idproducto + '&nombre=' + nombre + '&codigo='+ codigo +'&idmodelo=' + idmodelo +'&modelo=' +modelo+ '&cantidad=' +cantidad+ '&precio='+precio,
        success : function (res){
            $("#ctn-items").html(res);
        }
    })

});


/*================================================================
    ENVIAR DATOS PARA COMPLETAR LA VENTA
=================================================================== */
$("#add_compra").submit(function(event){
    var parametros = $(this).serialize();
      $.ajax({
              type: "POST",
              url: 'control/compra.control.php',
              data: "fn=SaveCompra&"+parametros,
              success: function(datos){
                  //alert(datos);
                console.log("Datos:", datos);

              $("#resultados").html(datos);
            }
      });
    event.preventDefault();
});
/*================================================================
    BORRANDO EL LISTADO DE PRODUCTOS
=================================================================== */

$("#btnBorrarListaProductos").click(function(){
        
        $.ajax({
            type    : 'post',
            url     : 'control/compra.control.php',
            data    : 'fn=BorrarListaProductos',
            success : function (res){
                $("#ctn-items").html(res);
            }
        })

    })


