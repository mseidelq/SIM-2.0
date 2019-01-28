var lista_habitaciones;
var lista_precios;

//CARGAR LAS Habitaciones
$(document).ready(function(){

  $(".btnHabitacion").click(function(){

      var cod_hab = $(this).val();
  		var no_hab = lista_habitaciones[cod_hab]["Numero"];
  		var tipo = lista_habitaciones[cod_hab]["CodTipoHab"];
  		// SI YA ESTA OCUPADA LA HABITACION

  		//SI NO ESTA OCUPADA LA HABITACION


  			// VA A BUSCAR LA LISTA QUE ESTA ACTIVA EN EL MOMENTO
  			$.ajax({
  			  type: 'POST',
  			  url: "sql/control_habitaciones.php",
  			  data: {"lista_precios": "traer"},
  			  success: function(data){
              lista_precios = JSON.parse(data);
  						},

  			  async:false
  			});

  });

});

function cargar_habitaciones() {

  $.ajax({
	  type: 'GET',
	  url: "sql/control_habitaciones.php",
	  data: {"habitaciones": "traer"},
	  success: function(data){
        lista_habitaciones = JSON.parse(data);
				},

	  async:false
	});

	if(lista_habitaciones.length>0){

		$.each(lista_habitaciones, function(i, val){

			$("#tabla_control_habitaciones").append("<tr id='tr"+val["numero"]+"'></tr>");
      $("#tr"+val["numero"]).append("<td style='width:100px'><button type='button' class='btn btn-success btn-block btnHabitacion' id='btn"+val["numero"]+"' data-toggle='modal' data-target='#modalOcuparHabitacion' value="+i+">"+val["numero"]+"</button></td>");
			$("#tr"+val["numero"]).append("<td style='width:180px'><div>"+val["nombre_tipo"]+"</div></td>");
			$("#tr"+val["numero"]).append("<td style='width:100px; text-align:right' ><div id='ingresoF"+val["numero"]+"'></div></td>");
			$("#tr"+val["numero"]).append("<td style='width:100px; text-align:right'><div id='ingresoH"+val["numero"]+"'></div></td>");
			$("#tr"+val["numero"]).append("<td style='width:100px; text-align:right' ><div id='salidaF"+val["numero"]+"'></div></td>");
			$("#tr"+val["numero"]).append("<td style='width:100px; text-align:right'><div id='salidaH"+val["numero"]+"'></div></td>");
			$("#tr"+val["numero"]).append("<td style='width:80px; text-align:right'><div id='faltante"+val["numero"]+"'></div></td>");
			$("#tr"+val["numero"]).append("<td style='width:90px; text-align:right'><div id='extra"+val["numero"]+"'></div></td>");
			$("#tr"+val["numero"]).append("<td style='width:90px; text-align:right'><div id='servicio"+val["numero"]+"'></div></td>");
			$("#tr"+val["numero"]).append("<td style='width:90px; text-align:right'><div id='vlrServicio"+val["numero"]+"' class='moneda'></div></td>");
			$("#tr"+val["numero"]).append("<td style='width:90px; text-align:right'><div id='vlrExtra"+val["numero"]+"' class='moneda'></div></td>");
			$("#tr"+val["numero"]).append("<td style='width:130px; text-align:right'><div id='vlrConsumo"+val["numero"]+"' class='moneda'></div></td>");
			$("#tr"+val["numero"]).append("<td style='width:140px; text-align:right';><div id='total"+val["numero"]+"' class='moneda'></div></td>");
			$("#tr"+val["numero"]).append("<td style='width:140px; text-align:right';><div id='saldo"+val["numero"]+"' class='moneda'></div></td>");
			$("#tr"+val["numero"]).append("<td style='width:140px'><div id='placa"+val["numero"]+"'></td>");
			$("#tr"+val["numero"]).append("<td><div id='observaciones"+val["numero"]+"'></div></div><input type='hidden' id='ocupacion"+val["numero"]+"'></td>");
			//alert(_habitaciones[i].getParametros());

		});
  }
		//conteo();
}





$(document).keypress(function(event){
  if(event.which==51 && sen == 0){
    detectar = String.fromCharCode(event.which);
    sen = 1;
  }
  else{
      if(event.which == 13){
        alert(detectar); sen = 0; detectar ="";
        //BUSCAR LA HABITACION Y/O PRODUCTO
      }else{
        if(sen == 1){
          detectar += String.fromCharCode(event.which);
        }
      }
  }
});
