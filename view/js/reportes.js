/* Verificador de fechas */
$(function () {
    
  $('#Ventas_por_fecha').daterangepicker(
    {
      ranges   : {
        'Hoy'       : [moment(), moment()],
        'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Últimos 7 Días' : [moment().subtract(6, 'days'), moment()],
        'Últimos 30 Días': [moment().subtract(29, 'days'), moment()],
        'Este Mes'  : [moment().startOf('month'), moment().endOf('month')],
        'Últimos Mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#Ventas_por_fecha span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      $('#rv_rangofechas').html(start.format('YYYY-MM-DD') + '@' + end.format('YYYY-MM-DD'));

      var fecha_inicial = start.format('YYYY-MM-DD');
      var fecha_final = end.format('YYYY-MM-DD');

      console.log("fechas" , fecha_inicial+" @ "+fecha_final);

      $("#btnReporteVentas").click(function(){

        rango_fechas = fecha_inicial+"@"+fecha_final;
        if (rango_fechas=="") 
        {
          swal({
                  position: 'top',
                  type: 'error',
                  title: 'Seleciona el rango de fechas',
                  showConfirmButton: false,
                  timer: 2000
              });
            return false;
        }
        usuario = $("#rv_usuario").val();
        if (usuario == "") 
        {
          usuario = "No";
        }
        cliente = $("#rv_cliente").val();
        if (cliente == "") 
        {
          cliente = "No";
        }
        $.ajax({
          type  : 'post',
          url   : 'control/x-fn.php',
          data    : 'fn=ReporteVentas&rango_fechas='+rango_fechas+'&usuario='+usuario+'&cliente='+cliente,
          success : function(ver){
            // $("#resultados").html(ver);

            data = ver.split("|");

            if (data[0] == "ok")
            {          
             $("#button_response_RV").append(

                '<a href="control/descargar-reporte.php?fi='+data[1]+'&ff='+data[2]+'&u='+data[3]+'&c='+data[4]+'">'+
        
                  '<button class="btn btn-block btn-info">'+

                    '<i class="fa fa-download"></i>'+
                    'Descargar'+
                    
                  '</button>'+

                '</a>');




            }
            else
            {
              
            }
            
          }
        });
      })

    }
  )

})

