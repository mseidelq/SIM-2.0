var lista_habitaciones;
var lista_precios;
var precios=[];
var no_hab;

//CARGAR LAS Habitaciones
$(document).ready(function(){
  //$(".btnHabitacion").hide();
  $(".btnHabitacion").click(function(){

      var cod_hab = $(this).val();
  		no_hab = lista_habitaciones[cod_hab]["numero"];
  		var tipo = lista_habitaciones[cod_hab]["tipo_hab_id"];
  		// SI YA ESTA OCUPADA LA HABITACION
      if($('#btn'+no_hab).attr("data-target") == "#administrar_habitacion"){
  			$("#tituloModalAdmin").text("Administrar habitación "+no_hab);
  		}
  		//SI NO ESTA OCUPADA LA HABITACION
      else{
        precios.length=0;
        $('#select_servicio').empty();
  			$('#placa').val("");
  			$('#observaciones').val("");
  			$("#titulo_modal").text("Ocupar habitacion: "+no_hab);
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

        if(lista_precios.length>0){
				// VA A TRAER LOS SERVICIOS Y PRECIOS DE LA LISTA Y TIPO DE HABITACION SELECCIONADA
          $.ajax({
  				  type: 'POST',
  				  url: "sql/control_habitaciones.php",
  				  data: { "lista_activa": lista_precios[0]['lista_activa'], "tipo": tipo },
  				  success: function(data){
                precios = JSON.parse(data);
  							},

  				  async:false
  				});

  				if(precios.length>0){
  					$.each(precios, function(i, val){
  						$("#select_servicio").append("<option value="+i+">"+val.descripcion+", Valor = $ "+val.valor_servicio+" </option>");
  					});
  				}
  				else{
  					alert("No hay precios configurados para el tipo de habitacion");
  				}

  			}
  			else{
  				alert("No hay lista de precios activada para el dia de hoy");
  			}

      }

  });

  $("#btn_ocupar").click(function(){

		$('#btn'+no_hab).attr("data-target","#administrar_habitacion"); //SE CAMBIA EL MODAL
		$('#tr'+no_hab).attr("class","success"); // SE MARCA EN VERDE LA OCUPACION
		var servicio = $("#select_servicio").val();
		var horas = precios[servicio]['cantidad'];
		var ocupacion = []; var v0=0; var fecha;
		$('#btn'+no_hab).click();

		//TRAE LA HORA ACTUAL DEL SERVIDOR

		// MARCA GRAFICAMENTE DE VERDE LA OCUPACION

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
      $("#tr"+val["numero"]).append("<td style='width:100px'><button type='button' class='btn btn-success btn-block btnHabitacion' id='btn"+val["numero"]+"' data-toggle='modal' data-target='#modal_ocupar_habitacion' value="+i+" hidden>"+val["numero"]+"</button></td>");
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
        //alert();
        event.preventDefault();
        $("#btn"+detectar.substr(6,3)).click();
        sen = 0; detectar ="";
        //BUSCAR LA HABITACION Y/O PRODUCTO
      }else{
        if(sen == 1){
          detectar += String.fromCharCode(event.which);
        }
      }
  }
});
