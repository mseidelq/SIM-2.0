$(document).ready(function(){

  var datos_usuario;
  $("#login_error").hide();

  $("#ingresar").on("click",function () {
      var usr = $("#input_usuario").val();
      var con = $("#input_contrasena").val();

      $.ajax({
    	  type: 'POST',
    	  url: "pages/sql/login.php",
    	  data: {'usr':usr, 'contrasena':con},
    	  success: function(data){
    				datos_usuario = JSON.parse(data);
    		},

    	  async:false
    	});
      if(datos_usuario.usuario){
        window.open('pages/principal.php','TITULO','width =max,height=max');
      }
      else{
        $("#login_error").html("<strong>Error: </strong>"+datos_usuario);
        $("#login_error").show();
      }
  });

  // OCULTA EL ERROR CUANDO SE FOCALIZA EL CAMPO PARA USUARIO O CONTRASEÑA
  $("#input_contrasena, #input_usuario").on("focus",function () {
    $("#login_error").hide();
  });
});
