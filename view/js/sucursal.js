// El código va aquí

/*==============================================================================
    CARGAR DATOS A MODAL EDITAR SUCURSAL  
================================================================================*/

$('#modalEditarSucursal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idsucursal = button.data('idsucursal')
  $('#editaridSucursal').val(idsucursal)

  var nombre = button.data('nombre') 
  $('#editarNombre').val(nombre)

  var ubicacion = button.data('ubicacion')
  $('#editarUbicacion').val(ubicacion)

  var descripcion = button.data('descripcion')
  $('#editarDescripcion').val(descripcion)

  var direccion = button.data('direccion')
  $('#editarDireccion').val(direccion)
  
  var ci = button.data('ci')
  $('#editarCI').val(ci)
 
})
/*==============================================================================
    CARGAR DATOS A MODAL ELIMINAR SUCURSAL  
================================================================================*/
$('#modalEliminarSucursal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idsucursal = button.data('idsucursal')
  $('#eliminaridSucursal').val(idsucursal)

})

/*==============================================================================
    CARGAR DATOS A MODAL ACTIVAR SUCURSAL  
================================================================================*/
$('#modalActivarSucursal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idsucursal = button.data('idsucursal')
  $('#activaridSucursal').val(idsucursal)

})


/*==============================================================================
    DATOS COMPLEMENTARIOS PARA VISUALIZACION CON LA API DE GOOGLE MAPS   
================================================================================*/

$(document).ready(function() {
  var map = null;
  var myMarker;
  var myLatlng;

  function initializeGMap(lat, lng) {
    myLatlng = new google.maps.LatLng(lat, lng);

    var myOptions = {
      zoom: 12,
      zoomControl: true,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    myMarker = new google.maps.Marker({
      position: myLatlng
    });
    myMarker.setMap(map);
  }

  // Reiniciar mapa antes de mostrar modal
  $('#modalVerSucursal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    initializeGMap(button.data('lat'), button.data('lng'));
    $("#location-map").css("width", "100%");
    $("#map_canvas").css("width", "100%");
  });

  // Se activa el evento de cambio de tamaño del mapa después de que se muestra el modal
  $('#modalVerSucursal').on('shown.bs.modal', function() {
    google.maps.event.trigger(map, "resize");
    map.setCenter(myLatlng);
  });
});