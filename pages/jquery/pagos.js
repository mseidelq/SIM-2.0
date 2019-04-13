var saldo, valor_pagando, saldo, faltante, valor_pagado;
$("#valor_pagando, #numero_comprobante").keyup(function(){
  valor_pagando = $("#valor_pagando").val().replace(/,/g,"");
  //p_tarjeta= $("#pago_tarjeta").val().replace(/,/g,"");
  saldo = $("#valor_a_pagar").html().replace(/,/g,"");
  faltante = saldo - valor_pagando;
  $("#error_pago").hide();

  if(faltante<0){

    $("#error_pago").html("El valor a pagar no puede ser mayor al saldo").show();
    $(this).val("");
    valor_pagando = $("#valor_pagando").val().replace(/,/g,"");
    //saldo = $("#valor_a_pagar").html().replace(/,/g,"");
    faltante = saldo - valor_pagando;
  }
  $("#faltante_x_pagar").html(faltante);
  $(".moneda").priceFormat({ prefix: '', centsLimit: 0});

});

//================================================================================================================

$("#cancela_pago").click(function(){
  $(".panel_productos").show();
  $("#realizar_pago").show();
  $("#panel_pagos").hide();
});

$("#select_medio").change(function () {
  if($("#select_medio option:selected").html()=="EFECTIVO"){
    $("#comprobante").hide();
  }
  else {
    $("#comprobante").show();
  }
});

$("#ingresa_pago").click(function(){

    var sen=0; var numero_comprobante=$("#numero_comprobante").val();
    if($("#numero_comprobante").val()=="" && $("#select_medio option:selected").html()!="EFECTIVO")
    {
      $("#error_pago").html("El pago por tarjeta debe tener numero de comprobante").show();
      sen = 1;
    }
    if(valor_pagando<=0)
    {
      $("#error_pago").html("No se puede realizar pago por valor 0 (cero)").show();
      sen = 1;
    }
    if(sen==0){
      //METER EL PAGO
      //alert("ocupacion_id "+ ocupacion_id+ ", valor_pagando "+valor_pagando+ ", medio "+ $("#select_medio").val()+ ", comprobante "+ numero_comprobante+ ", turno "+ turno_id);
      $.ajax({
        type: 'POST',
        url: "sql/pagos.php",
        data: { "ocupacion_id": ocupacion_id, "valor_pagando":valor_pagando, "medio": $("#select_medio").val(), "comprobante": numero_comprobante, "turno": turno_id},
        success: function(data){
            alert(data);
            obj_admin_habitacion.muestra_tabla();
            $(".panel_productos").hide();
            $("#panel_pagos").show();
            $("#realizar_pago").hide();
        },
        async:false
      });
    }

});
