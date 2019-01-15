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
  				datos_usuario = JSON.parse(data);
          //alert(data);
  		},

  	  async:false
  	});
    if(datos_usuario.usuario) alert(datos_usuario.usuario);
    else alert(datos_usuario);
  });
  
});
