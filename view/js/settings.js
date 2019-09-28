/**
* @parametros
*
*/
$().ready(function(){

	$("#FormChangePass").validate({
		rules: {
            new_pass: {
                required: true,
                minlength: 8,
                maxlength: 16
            },
            confir_new_pass: {
                required: true,
                minlength: 8,
                maxlength: 16,
                equalTo: "#new_pass"
            }	
		},
		messages: {
			new_pass: {
                required: "Este campo es requerido",
                minlength: "Debe introducir al menos 8 caracteres",
                maxlength: "Debes introducir como maximo solo 16 caracteres"
            },
            confir_new_pass: {
                required: "Este campo es requerido",
                minlength: "Debe introducir al menos 8 caracteres",
                maxlength: "Debes introducir como maximo solo 16 caracteres",
                equalTo: "Las contraseña no es igual a la ingresada"
            }
		},
        debug: true,
        errorElement: "p",
        errorClass: "text-red",
        submitHandler: function(form){

            username = $("#username").val();
        	old_pass = $("#old_pass").val();
        	new_pass = $("#new_pass").val();
        	confir_new_pass = $("#confir_new_pass").val();
        
            $("#alert").show();
            $("#alert").html("<img src='view/img/ajax-loader.gif' style='vertical-align:middle;margin:0 10px 0 0' /><strong>Enviando mensaje...</strong>");
            setTimeout(function() {
                $('#alert').fadeOut('slow');
            }, 50000);

            var formData = {
                fn : "ChangePass",
                username: username,
                old_pass: old_pass,
                new_pass: new_pass,
                confir_new_pass: confir_new_pass
            }
            $.ajax({
                type: "POST",
                url: "control/x-fn.php",
                data: formData,
                success: function(msg){
                    $("#alert").html(msg);

                    setTimeout(function() {
                        $('#alert').fadeOut('slow');
                    }, 5000);

                }
            });
        }
				
	});

});
