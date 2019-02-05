$(document).ready(function () {

	$("#modal_IniciarTurno").modal();

});

$("#modal_IniciarTurno").on("show.bs.modal", function () {
	// HACER QUE CARGUE LOS DATOS DE LOS TURNOS SI LO ENCUENTRA
	//SI NO LO ENCUENTRA DARLE LA OPCION DE INICARLO
	if(turno_usuario!="NO"){
			$("#div_TurnoIniciado").show();
			$("#tabla_TurnosAbiertos").append("<td align='center'>"+turno_usuario[0].fecha_inicio.substr(0,10)+"</td>");
			$("#tabla_TurnosAbiertos").append("<td align='center'>"+turno_usuario[0].fecha_inicio.substr(11,12)+"</td>");
			$("#tabla_TurnosAbiertos").append("<td align='center'><button  data-dismiss='modal' type='button' class='btn btn-success'>Continuar</button></td>");
			turno_id = turno_usuario[0]['turno_id'];			
			// CREAR EN $_SESSION EL TURNO Y LA FECHA
	}
	else {
			$("#div_IniciarTurno").show();
	}

});

$("#btn_IniciarTurno").click(function() {
	var resultado = iniciar_turno();

	if(resultado.turno_id){
		alert("Turno iniciado exitosamente el turno el dia: "+resultado.fecha_inicio.substr(0,10)+ "	a la hora: "+resultado.fecha_inicio.substr(11,12));
		turno_id = resultado.turno_id;
		$("#modal_IniciarTurno .close").click();
	}
});

// FUNCION PARA INICIAR TURNO DE CAJA
function iniciar_turno() {
	var resultado;
	$.ajax({
	  type: 'POST',
	  url: "sql/manejo_turnos.php",
	  data: {'iniciar_turno':'iniciar'},
	  success: function(data){

				resultado = JSON.parse(data);
		},
	  async:false
	});
	return resultado;
}

function verficiar_Turnos(){
  var turno;
  $.ajax({
	  type: 'POST',
	  url: "sql/manejo_turnos.php",
	  data: {'turnos':'consultar'},
	  success: function(data){
				turno = JSON.parse(data);
		},
	  async:false
	});
	return turno;
}
