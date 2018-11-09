$('#tag_factura').on('click',function(){
    var tipo = $("#tag_factura option:selected" ).attr("name");
    
    if(tipo == 1){
        $('#mostrar_fecha').css({
            "display": "none"
        });
    }else if(tipo == 2){
        $('#mostrar_fecha').css({
            "display": "block"
        });
    }else if(tipo == 3){    
        $('#seleccionar_iva').css({
            "display": "block"
        });
    }
});