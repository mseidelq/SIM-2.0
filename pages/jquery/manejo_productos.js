var lista_productos;
var producto_a_vender;

$(document).ready(function(){

  // TRAER LISTA DE PRODUCTOS
  $.ajax({
    type: 'POST',
    url: "sql/manejo_productos.php",
    data: {"trae_productos": "traer"},
    success: function(data){
        lista_productos = JSON.parse(data);
    },
    async:false
  });

  $( "#productos" ).autocomplete({
    	source: lista_productos,
    	disabled: true,
    	select: function (event, item) {

  				var params = {
  					producto_id: item.item.id
  				};
  				$.get("sql/manejo_productos.php", params, function (response) {
            //alert(response);
            producto_encontrado(JSON.parse(response));
  				});
  		}
  });

  $("#productos").keyup(function(e){

		if(e.keyCode>=65 && e.keyCode<=90){
			$("#productos").autocomplete("enable");
		}
		else if(e.keyCode == 13 && $( "#productos" ).autocomplete( "option", "disabled" )){

			var params = {
				producto_cb: $("#productos").val()
			};

			$.get("sql/manejo_productos.php", params, function (response) {
        //alert(response);
        producto_encontrado(JSON.parse(response));
			});
			$("#productos").val("");
		}
		else if(e.keyCode == 8 && $("#productos").val()== ""){
			$("#productos").autocomplete("disable");
		}

	});

  function producto_encontrado(datosP){
		//datosProd = [];
		producto_a_vender = datosP;

    if(producto_a_vender.nombre_producto){
      $("#productos").val(producto_a_vender.nombre_producto+" ["+producto_a_vender.marca+"]");
      $("#valor_producto").html(producto_a_vender.valor_venta);

      //$("#valor_producto").priceFormat({ prefix: '', centsLimit: 0});
      $("#cantidad_producto").val("1");
      $("#valor_total_producto").html(producto_a_vender.valor_venta);
      $(".moneda").priceFormat({ prefix: '', centsLimit: 0});
      $("#cantidad_producto").focus();
    }
    else $("#productos").val("");
	}

  $("#cantidad_producto").on("keyup change",function(e){

    var cantidad = $("#cantidad_producto").val();
		producto_a_vender.cantidad = cantidad;
		$("#valor_total_producto").html(producto_a_vender.valor_venta * cantidad);
    $(".moneda").priceFormat({ prefix: '', centsLimit: 0});

    if(e.keyCode == 13){
			// INGRESARLO EN LA TABLA
			//objHabitacion.agregarProducto(datosProd[0]);
      obj_admin_habitacion.agregar_producto(producto_a_vender);

			$("#productos").click();
		}
    else {
      if(e.keyCode == 27){
        $("#cantidad_producto").val("0");
        $("#valor_producto").html("");
        $("#valor_total_producto").html("");
        $("#productos").val(""); $("#productos").click();
      }
    }
	});
});

$("#productos").click(function(){
  $("#productos").val(""); $("#cantidad_producto").val("");
  $("#valor_producto").html(""); $("#valor_total_producto").html("");
  $("#productos").autocomplete("disable");
  $("#productos").focus();
});

function trae_productos_habitacion(ocupacion){
  var prod_ocupacion;
  $.ajax({
    type: 'POST',
    url: "sql/manejo_productos.php",
    data: { "ocupacion": ocupacion, "detalle_ocupacion":"PRODUCTOS"},
    success: function(data){
        prod_ocupacion = JSON.parse(data);
    },
    async:false
  });
  return(prod_ocupacion);
}
