/*================================================================
    CARGAR LA TABLA DINAMICA DE COMPRAS CON AJAX
=================================================================== */

// $.ajax({
//     url: "ajax/producto.ajax.php",
//     success: function(respuesta){
//         console.log('respuesta', respuesta);
//     }

// })

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
        data    : 'fn=ModeloPorMarca&idMarca='+idMarca,
        success : function (res){
            console.log("modelopormarca", res);
            $("#cajon-modelo").html(res);
        }
    })
    
}

/*======================================================================
		FUNCION PARA LISTAR SUB CATEGORIAS POR CATEGORIAS
========================================================================*/
function ListarSubCategoriaPorCategoria(obj){

    idCategoria = $(obj).val();
    $.ajax({
        type	: 'post',
        url     : 'control/x-fn.php',
        data    : 'fn=SubCategoriaPorCategoria&idCategoria='+idCategoria,
        success : function (res){
            console.log("subcategoria_por_categoria", res);
            $("#cajon-subcategoria").html(res);
        }
    })
    
}

/*======================================================================
		DATOS DE LOS SELECT PARA FILTROS
========================================================================*/
$().ready(function(){

	$("#FormSaveProducto").validate({
		rules: {
            p_a_nombre: {
                required: true,
                minlength: 4,
                maxlength: 90
            },
            p_a_descripcion: {
                required: true,
                minlength: 4,
                maxlength: 45
            },
            p_a_marca: {
                selectcheck: true
            },
            p_a_modelo: {
                selectcheck: true
            },
            p_a_categoria: {
                selectcheck: true
            },
            p_a_sub_categoria: {
                selectcheck: true
            },
            p_a_pais: {
                required: true,
                minlength: 4,
                maxlength: 45
            },
            p_a_codigo: {
                required: true,
                minlength: 7,
                maxlength: 7,
                min: 1000000,
                max: 1009999
            },
            p_a_precio: {
                required: true,
                minlength: 3,
                maxlength: 7,
                min: 1,
                max: 9999999
            },
            p_a_incremento: {
                required: true,
                minlength: 1,
                maxlength: 9,
                min: 1,
                max: 9999999
            },
            p_a_unidad_medida: {
                selectcheck: true
            }
			
		},
		messages: {			

		},
        debug: true,
        errorElement: "p",
        errorClass: "text-red",
        submitHandler: function(form){

        	nombre = $("#p_a_nombre").val();
        	descripcion = $("#p_a_descripcion").val();
        	marca = $("#p_a_marca").val();
        	modelo = $("#p_a_modelo").val();
        	categoria = $("#p_a_categoria").val();
        	subcategoria = $("#p_a_sub_categoria").val();
        	origen = $("#p_a_origen").val();
        	codigo = $("#p_a_codigo").val();
            precio = $("#p_a_precio").val();
            pais = $("#p_a_pais").val();
            incremento = $("#p_a_incremento").val();
            um = $("#p_a_unidad_medida").val();
            peso = $("#p_a_peso").val();

        	var formData = {
                fn : "SaveProducto",
                nombre: nombre,
                descripcion: descripcion,
                marca: marca,
                modelo: modelo,
                categoria: categoria,
                subcategoria: subcategoria,
                origen: origen,
                codigo: codigo,
                precio: precio,
                pais: pais,
                incremento: incremento,
                um: um,
                peso: peso
            }

            $("#alert").show();
            $("#alert").html("<img src='view/img/ajax-loader.gif' style='vertical-align:middle;margin:0 10px 0 0' /><strong>Enviando mensaje...</strong>");
            setTimeout(function() {
                $('#alert').fadeOut('slow');
            }, 50000);
            $.ajax({
                type: "POST",
                url: "control/x-fn.php",
                data: formData,
                success: function(msg){
                    console.log("productos", msg);
                    $("#alert").html(msg);
                    setTimeout(function() {
                        $('#alert').fadeOut('slow');
                    }, 10000);
                    

                }
            });
        }
				
    });
    jQuery.validator.addMethod('selectcheck', function (value) {
        return (value != '0');
    }, "Seleccione una Opción válida");

});

/*======================================================================
		DATOS DE LOS SELECT PARA FILTROS
========================================================================*/
