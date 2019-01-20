$(document).ready(function () {


	$("#modalIniciarTurno").modal();


});

$("#modalIniciarTurno").on("show.bs.modal", function () {
	// HACER QUE CARGUE LOS DATOS DE LOS TURNOS SI LO ENCUENTRA
	//SI NO LO ENCUENTRA DARLE LA OPCION DE INICARLO
	if(turno_usuario.length){
			$("#tablaTurnosAbiertos").append("<td>"+turno_usuario[0].fecha_inicio.substr(0,10)+"</td>");
			$("#tablaTurnosAbiertos").append("<td>"+turno_usuario[0].fecha_inicio.substr(11,12)+"</td>");
			$("#tablaTurnosAbiertos").append("<td><button>Continuar</button></td>");
	}

});

function verficiar_Turnos(){
  var turno;
  $.ajax({
	  type: 'GET',
	  url: "sql/manejoTurnos.php",
	  data: {'turnos':'consultar'},
	  success: function(data){
				turno = JSON.parse(data);
		},
	  async:false
	});
	return turno;
}
