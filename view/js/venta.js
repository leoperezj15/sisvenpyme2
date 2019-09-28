
/*================================================================
    FUNCION SIMPLE PARA MOSTRAR LA HORA
=================================================================== */
$(function() {
  function mostrarHora() {
    var fecha = new Date(), // nuevo objeto Fecha
        hora = fecha.getHours() + ":" + fecha.getMinutes() + ":" + fecha.getSeconds();
    $('#hora').text(hora);
  }
  setInterval(mostrarHora, 1000); // la función "mostrarHora" se ejecuta cada segundo
});
/*================================================================
    CARGAR LA TABLA DINAMICA DE COMPRAS CON AJAX
=================================================================== */

// $.ajax({
//     url: "ajax/venta.ajax.php",
//     success: function(respuesta){
//         console.log('respuesta', respuesta);
//     }

// })
/*================================================================
    CARGAR LA TABLA DINAMICA DE COMPRAS CON AJAX
=================================================================== */

$(".tablaVentas").DataTable({
    "dom": "Bfrtip",
    "processing": true,
    "responsive": true,
    "ajax": "ajax/venta.ajax.php",
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

/*======================================================================
		FUNCION PARA ELIMINAR PRODUCTOS DE LA LISTA
========================================================================*/
function deleteItem(id){
			
	$.ajax({
        type: "POST",
        url: "control/venta.control.php",
        data: "fn=DeleteItem&id="+id,
        success: function(datos){
		$("#ctn-items").html(datos);
		}
	});

};
/*======================================================================
		FUNCION PARA ELIMINAR LISTA DE PRODUCTOS DEL CARRO DE COMPRAS
========================================================================*/
function deleteList(id){
			
	$.ajax({
        type: "POST",
        url: "control/venta.control.php",
        data: "fn=DeleteListItems&id="+id,
        success: function(datos){
		$("#ctn-items").html(datos);
		}
	});

};
/*======================================================================
		FUNCION PARA LISTAR ALMACEN POR SUCURSAL
========================================================================*/
function ListarAlmacenPorSucursal1(obj){

    idSucursal = $(obj).val();
    $.ajax({
        type	: 'post',
        url     : 'control/x-fn.php',
        data    : 'fn=AlmacenPorSucursal&idSucursal=' + idSucursal,
        success : function (res){
            $("#cajon-almacen").html(res);
        }
    })
    
}

$(document).ready(function() {
	
    $("#btnAdd").click(function(){
    	//Para Verificar el Stock
    	idAlmacen = $("#cajon-almacen").val();
		if (idAlmacen=="") 
		{
			swal({
	            position: 'top',
	            type: 'error',
	            title: 'Al menos debe cargar el Almacen',
	            showConfirmButton: false,
	            timer: 1500
	        });

	        return false;
		}
        idProducto = $("#add_idproducto").val();
		nombre = $("#add_nombre").val();
		if(nombre=="")
		{
			document.getElementById('add_nombre').focus();
			swal({
                position: 'top',
                type: 'error',
                title: 'Selecione un producto',
                showConfirmButton: false,
                timer: 1500
            });
			return false;
		}
		codigo = $("#add_codigo").val();
		descripcion = $("#add_descripcion").val();
        modelo = $("#add_modelo").val();
        descuento = $("#add_descuento").val();
		cantidad = $("#add_cantidad").val();
		if (cantidad<1 || cantidad=="") 
		{
			document.getElementById('add_cantidad').focus();
			swal({
                position: 'top',
                type: 'error',
                title: 'La cantidad debe ser Mayor a 0',
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
                title: 'Selecione un producto',
                showConfirmButton: false,
                timer: 1500
            });
			return false;
		}
		$.ajax({
			type 	: 'post',
			url 	: 'control/venta.control.php',
			data    : 'fn=VerificarStock&idAlmacen='+idAlmacen+'&idProducto='+idProducto+'&cantidad='+cantidad,
			success	: function(ver){

				data = ver.split("|");
                        
    			if (data[0]=="si")
    			{
    				if(Number(data[1]) >= Number(cantidad))
    				{
    					$.ajax({
				            type	: 'post',
				            url		: 'control/venta.control.php',
				            data    : 'fn=AddItem&idProducto=' + idProducto + '&nombre=' + nombre + '&codigo='+ codigo +'&descripcion=' + descripcion +'&modelo=' +modelo+ '&cantidad=' +cantidad+ '&precio='+precio +'&descuento='+descuento+'&stock='+Number(data[1]),
				            success : function (res){
				                $("#ctn-items").html(res);
				            }
				        });

    				}
    				else
    				{
    					document.getElementById('add_cantidad').focus();
						swal({
			                position: 'top',
			                type: 'error',
			                title: 'La cantidad no debe ser Mayor al Stock, Quedan = '+data[1],
			                showConfirmButton: false,
			                timer: 1500
			            });
			            return false;
    				}   
    			}
    			else
    			{
                    document.getElementById('add_cantidad').focus();
					swal({
		                position: 'top',
		                type: 'error',
		                title: data[0]+' , Quedan = '+data[1],
		                showConfirmButton: false,
		                timer: 1500
		            });
		            return false;
    			}
			}
		});

	});

	$("#btnDeleteListItems").click(function(){
		
        $.ajax({
            type	: 'post',
            url		: 'control/venta.control.php',
            data    : 'fn=DeleteListItems',
            success : function (res){
                $("#ctn-items").html(res);
            }
        })

    });
	
})

$("#btnSaveVenta").click(function(){

	idCliente = $("#idCliente").val();
	if (idCliente=="") 
	{
		document.getElementById('nombre').focus();
		swal({
            position: 'top',
            type: 'error',
            title: 'Al menos debe cargar al cliente',
            showConfirmButton: false,
            timer: 1500
        });

        return false;
	}
	idAlmacen = $("#cajon-almacen").val();
	if (idAlmacen=="") 
	{
		swal({
            position: 'top',
            type: 'error',
            title: 'Al menos debe cargar el Almacen',
            showConfirmButton: false,
            timer: 1500
        });

        return false;
	}
	Monto_Total = $("#venta_add_montototal").val();
	if (Monto_Total==0) 
	{
		swal({
            position: 'top',
            type: 'error',
            title: 'No exiten productos para la Venta',
            showConfirmButton: false,
            timer: 1500
        });

        return false;
	}
	Monto_Total_Descuento = $("#venta_add_montototal_descuento").val();

	$.ajax({
        type	: 'post',
        url		: 'control/venta.control.php',
        data    : 'fn=SaveVenta&idCliente='+idCliente+'&idAlmacen='+idAlmacen+'&Monto_Total='+Monto_Total+'&Monto_Total_Descuento='+ Monto_Total_Descuento,
        success : function (res){
            $("#ctn-items").html(res);
        }
    });

	

    // $(".deleteItem").click(function() {
    // 	var campo = $(this).attr("campo");
    // 	if(campo=="")
	   //  {
	   //      swal({
	   //          position: 'top',
	   //          type: 'error',
	   //          title: 'No exite el campo',
	   //          showConfirmButton: false,
	   //          timer: 1500
	   //      });

	   //      return false;
	   //  }
	   //  $.ajax({
    //         type	: 'post',
    //         url		: 'control/venta.control.php',
    //         data    : 'fn=DeleteItem&campo='+campo,
    //         success : function (res){
    //             $("#ctn-items").html(res);
    //         }
    //     })

    // })
});

/*======================================================================
    FUNCION PARA MANDAR DATO HACIA LA FACTURA PARA IMPRIMIR LA VENTA
========================================================================*/
$(".tablaVentas").on("click", ".btnImprimirVenta", function(){
    var idVenta = $(this).attr("idVenta");
    var configuracion_ventana = "width=950,toolbar=NO,height=650,menubar=NO,location=NO,resizable=NO,scrollbars=NO,status=NO";
    window.open("sales/pdf/factura.php?mandante="+idVenta, "_blank", configuracion_ventana);
    //window.open('http://www.forosdelweb.com/','foforofos','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,width=screen.width,height=screen.height,top=0,left=0')
})


//copia

/*$("#add_venta").submit(function( event ) {

	event.preventDefault();
	
	var parametros = $(this).serialize();

	

	  $.ajax({
			  type: "POST",
			  url: "control/venta.control.php",
			  data: "fn=SaveVenta&"+parametros,
			  success: function(datos){
				  //alert(datos);
			  $("#resultados").html(datos);
			}
	  });
	
  });*/

 /*


 //EL ORIGINAL

 $(document).on('click', '#add_venta', function( event ) {

	event.preventDefault();

	var parametros = $(this).serialize();

	  $.ajax({
			  type: "POST",
			  url: "control/venta.control.php",
			  data: "fn=SaveVenta&"+parametros,
			  success: function(datos){
				  //alert(datos);
			  $("#resultados").html(datos);
			}
	  });
	
  });

  */

/*UNA OPCION DE ENVIO PARA ENVIAR CUANDO SOLO SE DE CLICK*/
/*$(document).on('click', '.validar', function (event) {

    event.preventdefault(); // siempre detener el submit

    $.ajax({
        ...
        success: function (response) {
            if(response.error==true){
                // no hacer nada
            } else {
                // enviar formulario
                $("#idDeTuFormulario").submit();
            }
        }
        ...
    });
});


<form method="POST" action="/submit.php" onsubmit="funcionSubmit(event)">
    <input type="text">
    <input type="submit">
</form>

function funcionSubmit(event){
    // esta linea detiene la ejecucion del submit
    event.preventDefault();

    // tu funcion ajax
    $.ajax({
                url: '/Desarrollo/admin/users/validar',
                data: parametros,
                type: 'post',
                dataType: "json",
                success: function (response) {
                    if(response.error==true){
                        // si error es true no hacemos nada porque ya detuvimos el submit
                    } else {
                        // si no hubo error volvemos a llamar el submit
                        // aquí no se si lo que quieres es hacer el submit nativo o uno tuyo propio
                        // submit nativo
                        event.target.submit();
                        // un submit propio seria con una llamada ajax o algo por el estilo
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                }
            });
}

btnImprimirVenta


*/


