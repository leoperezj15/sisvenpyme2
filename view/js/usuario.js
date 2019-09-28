/**
* @parametros
*
*/
$().ready(function(){

	$("#FormSaveUsuario").validate({
		rules: {
			
		},
		messages: {
			

		},
        debug: true,
        errorElement: "p",
        errorClass: "text-red",
        submitHandler: function(form){

        	nombre = $("#nue_emple_nombre").val();
        	apaterno = $("#nue_emple_apaterno").val();
        	amaterno = $("#nue_emple_amaterno").val();
        	fecha = $("#nue_emple_fecha").val();
        	ci = $("#nue_emple_ci").val();

        	username = $("#nue_usu_username").val();
        	alias = $("#nue_usu_alias").val();
        	email = $("#nue_usu_email").val();
        	rol = $("#nue_usu_rol").val();

        	var Empleado = "nombre="+nombre+"&apaterno="+apaterno+"&amaterno="+amaterno+"&fecha="+fecha+"&ci="+ci;
        	var Usuario = "username="+username+"&alias="+alias+"&email="+email+"&rol="+rol;
            $("#alert").show();
            $("#alert").html("<img src='view/img/ajax-loader.gif' style='vertical-align:middle;margin:0 10px 0 0' /><strong>Enviando mensaje...</strong>");
            setTimeout(function() {
                $('#alert').fadeOut('slow');
            }, 50000);
            $.ajax({
                type: "POST",
                url: "control/x-fn.php",
                data: "fn=SaveUsuario&"+Empleado+"&"+Usuario,
                success: function(msg){
                    $("#alert").html(msg);
                    // document.getElementById("name").value="";
                    // document.getElementById("email").value="";
                    // document.getElementById("message").value="";
                    setTimeout(function() {
                        $('#alert').fadeOut('slow');
                    }, 5000);

                }
            });
        }
				
	});

});

function CargarTabla()
{

}


function Roles(obj){

    idRol = $(obj).val();
    $.ajax({
        type	: 'post',
        url		: 'control/x-fn.php',
        data    : 'fn=PermisosRoles&idRol=' + idRol,
        success : function (res){
            $("#cajon-roles").html(res);
        }
    })
    
}