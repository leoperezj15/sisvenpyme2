/*=============================================
LOADER DE FAKELOADER
=============================================*/
// $(document).ready(function () {
//     $.fakeLoader({
//         bgColor: '#e74c3c',
//         spinner: 'spinner6'
//     });
// });
$("#btnSend").click(function()
{
    
    user = $("#user").val();
    pass = $("#password").val();
    
    $.ajax({
        type: "POST",
        url: "control/usuario.controlador.php",
        data: "fn=Login&user=" + user  + "&pass=" + pass,
        cache: false,
        success: function (res){
            
            data = res.split("|");
            alert(res);
            
            if (data[0] == "ok")
            {          
                //alert(data[1]);
                setTimeout("reloadPage()", 1000);
            }else{
                alert(data[1]);
                $("#user").focus();
            }
            
        }
    });
})
function reloadPage()
{
    location.reload();
}