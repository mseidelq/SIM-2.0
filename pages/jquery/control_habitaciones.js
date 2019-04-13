var lista_habitaciones;
var lista_precios;
var precios=[];
var no_hab;
var habitacion_id;
var conteo_intervalo;
var senal_sonido = 0;
var placas;
var placa=0;
var observacion2;
//CARGAR LAS Habitaciones
$(document).ready(function(){
  //$(".btnHabitacion").hide();

  $(".btnHabitacion").click(function(){
      var cod_hab   = $(this).val();
  		no_hab        = lista_habitaciones[cod_hab]["numero"];
      habitacion_id = lista_habitaciones[cod_hab]["habitacion_id"];
  		var tipo      = lista_habitaciones[cod_hab]["tipo_hab_id"];
  		// SI YA ESTA OCUPADA LA HABITACION
      if($('#btn'+no_hab).attr("data-target") == "#modal_administrar_habitacion"){
        ocupacion_id = $("#ocupacion"+no_hab).val();
        placa = $("#placa"+no_hab).html();
        observacion2 = $("#observaciones"+no_hab).html();

        obj_admin_habitacion.set_ocupacion(ocupacion_id);
        //obj_admin_habitacion.set_ocupacion(ocupacion_id);
  			$("#tituloModalAdmin").text("Administrar habitación "+no_hab);
        $('#placa2').val(placa);
        $('#observaciones2').val(observacion2);
        placas = traer_placas();
        placa=0;

        $("#placa2").autocomplete({
          source: placas,
        	select: function (event, item) {
						placa = item.item.id;
            //alert(placa);
  				}
        });
  		}
  		//SI NO ESTA OCUPADA LA HABITACION
      else{
        precios.length=0;
        $('#placa').val("");
        placas = traer_placas();
        placa=0;

        $("#placa").autocomplete({
          source: placas,
        	select: function (event, item) {
						placa = item.item.id;
            //alert(placa);
  				}
        });
        //$("#placa").attr('autocomplete', 'on');

        $('#select_servicio').empty();
  			//$('#placa').val("");
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
  						$("#select_servicio").append("<option value="+i+">"+val.descripcion+", Valor = $ "+val.valor_servicio+"</option>");
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

  $("#placa").change(function(){
    var valor_placa = $("#placa").val().toUpperCase();
    var tipo_vehiculo;
    if(placa == 0 && valor_placa.length > 2){
      if(confirm("La placa "+valor_placa+" es correcta ?")){
        if(confirm("Carro = Aceptar      Moto = Cancelar")) tipo_vehiculo = "CARRO";
        else tipo_vehiculo = "MOTO";
      }

    }
    $.ajax({
      type: 'POST',
      url: "sql/control_habitaciones.php",
      data: { "tipo_vehiculo": tipo_vehiculo, "placa": valor_placa },
      success: function(data){
          var p = JSON.parse(data);
          placa = p.ret_placa;


      },
      async:false
    });
  });


  $("#btn_ocupar").click(function(){

    var servicio = $("#select_servicio").val();
    var observacion = $("#observaciones").val().toUpperCase();
		var horas = precios[servicio]['cantidad'];
    var valor = precios[servicio]['valor_servicio'];
    var iva = precios[servicio]['valor_iva'];
    var id_precio_servicio = precios[servicio]['id_precio_servicio'];
    var descripcion = precios[servicio]['descripcion'];
		var ocupacion = []; var v0=0; var fecha;
    if(placa == 0) placa = 1;

    ocupacion.push(habitacion_id); ocupacion.push(horas); ocupacion.push(valor); ocupacion.push(turno_id); ocupacion.push(id_precio_servicio);
    ocupacion.push(iva); ocupacion.push(descripcion); ocupacion.push(observacion); ocupacion.push(placa);

    // GUARDAR LA OCUPACION
		$.post("sql/control_habitaciones.php", {"ocupacion":ocupacion} ,function(data){
      var ocupado = JSON.parse(data);
      if(!ocupado.resultado)
      {
        marca_ocupadas(ocupado); $('#btn'+no_hab).click();
      }
      else alert(ocupado.resultado+" - "+ocupado.mensaje);

		});

	});

});

function marca_ocupadas(ocupado) {
  var no = ocupado.numero;
  $('#btn'+no).attr("data-target","#modal_administrar_habitacion"); //SE CAMBIA EL MODAL

  if(ocupado.tiempo_faltante>'00:15:00') {
    if($('#tr'+no).attr("class")!="success") $('#tr'+no).attr("class","success"); // SE MARCA EN VERDE LA OCUPACION
  }else if(ocupado.tiempo_faltante>'00:00:00'){
    if($('#tr'+no).attr("class")!="warning"){
        $('#tr'+no).attr("class","warning");
        if(senal_sonido==1) $("#15left")[0].play();
    }

  }else{
    if($('#tr'+no).attr("class")!="danger"){
      $('#tr'+no).attr("class","danger");
      if(senal_sonido==1) $("#timeout")[0].play();
    }
    ocupado.tiempo_faltante = ocupado.tiempo_faltante.substr(1,8)
  }

  $("#ocupacion"+no).val(ocupado.ocupacion_id);
  $("#ingresoF"+no).html(ocupado.fecha_ingreso.substr(0,10));
  $("#ingresoH"+no).html("<strong>"+ocupado.fecha_ingreso.substr(10,14)+"</strong>");
  $("#salidaF"+no).html(ocupado.fecha_estimada.substr(0,10));
  $("#salidaH"+no).html("<strong>"+ocupado.fecha_estimada.substr(10,14)+"</strong>");
  $("#faltante"+no).html(ocupado.tiempo_faltante);
  $("#extra"+no).html(ocupado.horas_extras);
  $("#servicio"+no).html(ocupado.horas+" Horas");
  $("#total"+no).html(ocupado.valor_total); var saldo_ = (ocupado.valor_total-ocupado.valor_pagado)*1;
  $("#saldo"+no).html(saldo_);
  $("#observaciones"+no).html(ocupado.observacion);
  $("#placa"+no).html(ocupado.no_placa);
  $(".moneda").priceFormat({ prefix: '', centsLimit: 0});
}


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
			//$("#tr"+val["numero"]).append("<td style='width:90px; text-align:right'><div id='vlrServicio"+val["numero"]+"' class='moneda'></div></td>");
			//$("#tr"+val["numero"]).append("<td style='width:90px; text-align:right'><div id='vlrExtra"+val["numero"]+"' class='moneda'></div></td>");
			//$("#tr"+val["numero"]).append("<td style='width:130px; text-align:right'><div id='vlrConsumo"+val["numero"]+"' class='moneda'></div></td>");
			$("#tr"+val["numero"]).append("<td style='width:140px; text-align:right';><div id='total"+val["numero"]+"' class='moneda'></div></td>");
			$("#tr"+val["numero"]).append("<td style='width:140px; text-align:right';><div id='saldo"+val["numero"]+"' class='moneda'></div></td>");
			$("#tr"+val["numero"]).append("<td style='width:140px'><div id='placa"+val["numero"]+"'></td>");
			$("#tr"+val["numero"]).append("<td><div id='observaciones"+val["numero"]+"'></div></div><input type='hidden' id='ocupacion"+val["numero"]+"'></td>");
			//alert(_habitaciones[i].getParametros());

		});
    ocupadas();
    senal_sonido = 1;
    conteo();
  }
		//conteo();
}

function conteo(){
	var x = setInterval(ocupadas, 5000);
}

function ocupadas() {
  var ocupadas;
  $.ajax({
    type: 'POST',
    url: "sql/control_habitaciones.php",
    data: {"ocupadas": "traer"},
    success: function(data){
        ocupadas = JSON.parse(data);
        },

    async:false
  });

  if(ocupadas!=null){
    $.each(ocupadas, function(i, val){
      marca_ocupadas(val);
    });
  }
}

function traer_placas(){
  var placas_;
  $.ajax({
    type: 'POST',
    url: "sql/control_habitaciones.php",
    data: {"placas": "traer"},
    success: function(data){
        placas_ = JSON.parse(data);
        //placas_ = data;
        },

    async:false
  });
  return(placas_);
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
        $("#btn"+detectar.substr(5,3)).click();  //AQUI SE DEBE BUSCAR LA HABITACION POR CODIGO DE BARRAS
        sen = 0; detectar ="";
        //BUSCAR LA HABITACION Y/O PRODUCTO
      }else{
        if(sen == 1){
          detectar += String.fromCharCode(event.which);
        }
      }
  }

  $("#modal_administrar_habitacion").on("show.bs.modal", function () {
    $("#cantidad_producto").val("0");
    $("#productos").val(""); $("#productos").click();
  });

});


function Admin_habitacion() {

    // CONSTRUCTOR QUE TRAE LA OCUPACION Y LOS PRODUCTOS DE LA HABITACION ==============================================================================

	var _ocupacion, _productos, _servicios;
	var _valorTotalConsumos = 0, _pagado = 0, _saldo = 0, _valor_extras=0, _valor_servicios=0, _valor_productos = 0;
  var _valor_pagado = 0;
  this.pagos;
  this.muestra_tabla = mostrar_tabla_productos;
  this.traer_pagos = trae_pagos;

	this.set_ocupacion = function(ocupacion){
    _ocupacion = ocupacion;
    mostrar_tabla_productos();
  }

  function trae_pagos(){
    var _pagos;
    $.ajax({
      type: 'POST',
      url: "sql/pagos.php",
      data: { "traer_pagos": _ocupacion},
      success: function(data){
          _pagos = JSON.parse(data);
      },
      async:false
    });
    this.pagos = _pagos;
    return(_pagos);
  }

  function mostrar_tabla_productos(){
    $(".panel_productos").show();
    $("#panel_pagos").hide();
    $("#realizar_pago").show();

    _productos = trae_productos_habitacion(_ocupacion);
    _servicios = trae_servicios_habitacion(_ocupacion);

  	_valorTotalConsumos = 0; _pagado = 0; _saldo = 0; _valor_extras=0; _valor_servicios=0;
    _valor_productos = 0; _valor_extras=0; _valor_servicios = 0;

    $("#tablaProductosAgregados tbody>tr").remove();
  	$.each(_productos, function(i, val){
  		$("#tablaProductosAgregados").append("<tr><td><input type='hidden' id='tdetalle_id' val='"+val.producto_id+"'>"+val.descripcion+"</td><td class='moneda'>"+val.valor/val.cantidad+"</td><td id='tcantidad'>"+val.cantidad+"</td><td id='tValorVenta' class='moneda'>"+val.valor+"</td><td></td></tr>");
      _valor_productos += val.valor*1;
  	});

    $.each(_servicios, function(i, val){
  		$("#tablaProductosAgregados").append("<tr><td><input type='hidden' id='tdetalle_id' val='"+val.servicio_id+"'>"+val.descripcion+"</td><td class='moneda'>"+val.valor/val.cantidad+"</td><td id='tcantidad'>"+val.cantidad+"</td><td id='tValorVenta' class='moneda'>"+val.valor+"</td><td></td></tr>");
      if(val.descripcion=="HORAS EXTRAS") _valor_extras = val.valor*1
      else _valor_servicios = val.valor*1;
  	});
    _valorTotalConsumos = _valor_extras + _valor_servicios + _valor_productos;
    $("#vlrConsumos").html(_valorTotalConsumos);

    mostrar_tabla_pagos();
    _saldo = _valorTotalConsumos - _valor_pagado;
    $("#vlrServicio").html(_valor_servicios);
    $("#vlrExtra").html(_valor_extras);
    $("#vlrProductos").html(_valorTotalConsumos);
    $("#vlrPadicional").html("0")
    $("#vlrTotal").html(_valorTotalConsumos);
    $("#vlrPagado").html(_valor_pagado);
    $("#vlrSaldo").html(_saldo);
    $("#valor_a_pagar").html(_saldo);
    $("#faltante_x_pagar").html(_saldo);
    $("#valor_pagando").val("0");
    //_valorTotalConsumos -= (_valor_extras+_valor_servicios)*1;


    $(".moneda").priceFormat({ prefix: '', centsLimit: 0});
    $(".moneda").css("text-align","right");
  }



  this.agregar_producto = function(datosP){ //FUNCION AGREGAR PRODUCTOS
      var sen=0;
      var _valores;


      $.ajax({
        type: 'POST',
        url: "sql/manejo_productos.php",
        data: {"consumo":datosP, "ocupacion_id": _ocupacion, "turno":turno_id},
        success: function(data){
            _valores = JSON.parse(data);
            mostrar_tabla();
            //placas_ = data;
            },

        async:false
      });

    }

    function mostrar_tabla_pagos(){
      pagos = trae_pagos();
      $("#tabla_pagos_realizados tbody>tr").empty();
      _valor_pagado = parseInt(0*1);
      $.each(pagos, function(i, val){
        //alert("<tr><td>"+val.valor_pago+"</td><td>"+val.fecha_pago+"</td><td>"+val.medio+"</td></tr>");
          $("#tabla_pagos_realizados").append("<tr><td class='moneda'>"+val.valor_pago+"</td><td>"+val.fecha_pago+"</td><td>"+val.medio+"</td></tr>");
          //tempDouble = parseInt(val.valor_pago*1);
          _valor_pagado += val.valor_pago*1;
      });
      $("#total_pagado").html(_valor_pagado);
      $(".moneda").priceFormat({ prefix: '', centsLimit: 0});
      return(_valor_pagado);
    }
}

function trae_servicios_habitacion(ocupacion){
  var servicio_ocupacion;
  $.ajax({
    type: 'POST',
    url: "sql/manejo_productos.php",
    data: { "ocupacion": ocupacion, "detalle_ocupacion":"SERVICIOS"},
    success: function(data){
        servicio_ocupacion = JSON.parse(data);
    },
    async:false
  });
  return(servicio_ocupacion);
}

$("#realizar_pago").click(function () {
  //$("#modal_realizar_pago").modal();
  $(".panel_productos").hide();
  $("#panel_pagos").show();
  $("#select_medio").empty();
  $(this).hide();
  $.ajax({
    type: 'POST',
    url: "sql/pagos.php",
    data: { "medios_pago": "traer"},
    success: function(data){
        var medios = JSON.parse(data);
        $.each(medios, function(i, val) {
          $('#select_medio').append($('<option>', {
            value: val.medio_id,
            text: val.medio
          }));

        })
    },
    async:false
  });

});

$("#vlrSaldo").click(function () {
  $("#realizar_pago").click();
});
