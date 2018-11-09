$('#apartado_tipo_pago').click(function(){
 var tipo = $('#apartado_tipo_pago').val();

 if(tipo == null || tipo == ""){
     $('#efectivo_apartado').val("");
     $('#efectivo_apartado').css({
         "display" : "none"
     });

     $('#apartado_tipo_tarjeta').val("");
     $('#apartado_tipo_banco').val("");
     $('#saldo_apartado_tarjeta').val("");
     $('#apartado_tipo_tarjeta').css({
         "display" : "none"
     });
     $('#apartado_tipo_banco').css({
         "display" : "none"
     });
     $('#saldo_apartado_tarjeta').css({
         "display" : "none"
     });
 }
 if(tipo == 1 || tipo == "1"){
     $('#efectivo_apartado_efectivo').css({
         "display" : "block"
     });

     $('#apartado_tipo_tarjeta').css({
         "display" : "none"
     });
     $('#apartado_tipo_banco').css({
         "display" : "none"
     });
     $('#saldo_apartado_tarjeta').css({
         "display" : "none"
     });

     $('#apartado_tipo_tarjeta_dos').css({
        "display" : "none"
    });
    $('#apartado_tipo_banco_dos').css({
        "display" : "none"
    });
    $('#saldo_apartado_tarjeta_dos').css({
        "display" : "none"
    });

 }
 if(tipo == 2 || tipo == "2"){
    $('#efectivo_apartado_efectivo').css({
        "display" : "none"
    });

     $('#apartado_tipo_tarjeta').css({
         "display" : "block"
     });
     $('#apartado_tipo_banco').css({
         "display" : "block"
     });
     $('#saldo_apartado_tarjeta').css({
         "display" : "block"
     });
     $('#apartado_tipo_tarjeta_dos').css({
        "display" : "none"
    });
    $('#apartado_tipo_banco_dos').css({
        "display" : "none"
    });
    $('#saldo_apartado_tarjeta_dos').css({
        "display" : "none"
    });
 }
 if(tipo == 3 || tipo == "3"){
    $('#efectivo_apartado_efectivo').css({
        "display" : "block"
    });

     $('#apartado_tipo_tarjeta').css({
         "display" : "block"
     })
     $('#apartado_tipo_banco').css({
         "display" : "block"
     })
     $('#saldo_apartado_tarjeta').css({
         "display" : "block"
     });


     $('#apartado_tipo_tarjeta_dos').css({
         "display" : "none"
     })
     $('#apartado_tipo_banco_dos').css({
         "display" : "none"
     })
     $('#saldo_apartado_tarjeta_dos').css({
         "display" : "none"
     })
 }
 if(tipo == 4 || tipo == "4"){
    $('#efectivo_apartado_efectivo').css({
        "display" : "none"
    });

     $('#apartado_tipo_tarjeta').css({
         "display" : "block"
     })
     $('#apartado_tipo_banco').css({
         "display" : "block"
     })
     $('#saldo_apartado_tarjeta').css({
         "display" : "block"
     });


     $('#apartado_tipo_tarjeta_dos').css({
         "display" : "block"
     })
     $('#apartado_tipo_banco_dos').css({
         "display" : "block"
     })
     $('#saldo_apartado_tarjeta_dos').css({
         "display" : "block"
     })
 }
});