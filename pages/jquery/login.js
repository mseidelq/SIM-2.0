$(document).ready(function(){
  var datos_usuario;
  $("#ingresar").on("click",function () {
    var usr = $("#input_usuario").val();
    var con = $("#input_contrasena").val();
    $.ajax({
  	  type: 'GET',
  	  url: "pages/sql/login.php",
  	  data: {'usr':usr, 'contrasena':con},
  	  success: function(data){
  				var data2 = JSON.parse(data);
  				datos_usuario = data2;
  				},

  	  async:false
  	});
    alert(datos_usuario);
  });
});
