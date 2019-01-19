$(document).ready(function () {


	$("#modalIniciarTurno").modal();


});

$("#modalIniciarTurno").on("show.bs.modal", function () {
	// HACER QUE CARGUE LOS DATOS DE LOS TURNOS SI LO ENCUENTRA
	//SI NO LO ENCUENTRA DARLE LA OPCION DE INICARLO

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
