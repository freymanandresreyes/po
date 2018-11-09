$('#acction_compras').on('click', function(){
    // 1 = COMPRAS
    // 2 = TRASLADOS
    var tipo = $("#acction_compras option:selected" ).attr("value");
    if(tipo == 1){
        $('#compras_uno').css({
            "display": "none"
        });
        $('#compras_dos').css({
            "display": "block"
        });
        $('#compras_tres').css({
            "display": "block"
        });
        $('#compras_cuatro').css({
            "display": "block"
        });
        $('#compras_cinco').css({
            "display": "block"
        });
        $('#compras_seis').css({
            "display": "block"
        });
    }else if(tipo == 2){
        $('#compras_uno').css({
            "display": "block"
        });
        $('#compras_dos').css({
            "display": "none"
        });
        $('#compras_tres').css({
            "display": "none"
        });
        $('#compras_cuatro').css({
            "display": "none"
        });
        $('#compras_cinco').css({
            "display": "none"
        });
        $('#compras_seis').css({
            "display": "none"
        });
    }
});