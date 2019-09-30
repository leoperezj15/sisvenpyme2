
/*=============================================
SideBar Menu
=============================================*/

$('.sidebar-menu').tree()

/*=============================================
Data Table
=============================================*/

$(".tablas").DataTable({

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

/*=============================================
HABILITAR FUNCION DE DATEINPUTMASK PARA VALIADAR ENTRADAS
=============================================*/
$(function(){

	$('[data-mask]').inputmask();

})
/*=============================================
CONVERTIR A MAYUSCULAS EN LAS CAJA DE TEXTOS
=============================================*/
$(document).ready(function(){
	$(".UpperCase").on("keypress", function(){
		$input=$(this);
		setTimeout(function () {
			$input.val($input.val().toUpperCase());
		},50);
	})
	$(".LowerCase").on("keypress", function(){
		$input=$(this);
		setTimeout(function () {
			$input.val($input.val().toLowerCase());
		},50);
	});
	
})
/*=============================================
PARA ACTIVAR LAS ANIMACIONES ENTRE PAGINAS	
=============================================*/
$(document).on('click','#search', function(e){
 pace.start(); 
});
/*=============================================
CONTROLAR EL SCROLL
=============================================*/
$('#sin-scroll').slimscroll({
	height: 'auto'
});
/*=============================================
CONTROLADOR DE SESSION	
=============================================*/

var base_url = 'fake_url';
var timeout;
document.onmousemove = function(){ 
    clearTimeout(timeout); 
    contadorSesion(); //aqui cargamos la funcion de inactividad
} 

function contadorSesion() {
   timeout = setTimeout(function () {
        $.confirm({
            title: 'Alerta de Inactividad!',
            content: 'La sesión esta a punto de expirar.',
            autoClose: 'expirar|10000',//cuanto tiempo necesitamos para cerrar la sess automaticamente
            type: 'red',
            icon: 'fa fa-spinner fa-spin',
            buttons: {
                expirar: {
                    text: 'Cerrar Sesión',
                    btnClass: 'btn-red',
                    action: function () {
                        salir();
                    }
                },
                permanecer: function () {
                    contadorSesion(); //reinicia el conteo
                    $.alert('La Sesión ha sido reiniciada!'); //mensaje
                    window.location.href = base_url + "dashboard";
                }
            }
        });
    }, 3000);//3 segundos para no demorar tanto 
}

function salir() {
    window.location.href = base_url + "auth/logout"; //esta función te saca
}



