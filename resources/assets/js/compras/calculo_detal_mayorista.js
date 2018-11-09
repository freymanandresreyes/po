$('#aplicar_iva').click(function(){
    var valor = $('#aplicar_iva').val();
    // console.log(valor);
    
    if(valor == "" || valor == null){
        $('#calculo_detal').prop('disabled',true);
        $('#calculo_mayor').prop('disabled',true);
    }else{
        $('#calculo_detal').prop('disabled',false);
        $('#calculo_mayor').prop('disabled',false);
        $('#calculo_detal').val('');
        $('#calculo_mayor').val('');
        $('#p_detal').val('');
        $('#p_mayor').val('');
    }
});

$('#calculo_detal').keyup(function(){
    var valor = $('#aplicar_iva').val();
    if (valor == 1 || valor == "1") {
        var a = $('#calculo_detal').val();
        var valor = a.split('.').join('');
    
        var neto = ((parseFloat(valor)/1.19));
    
        var iva = (parseFloat(neto)*19)/100;
        var suma = Math.round(iva) + parseFloat(neto);
    
        var valor_input = $('#p_detal').val(neto.toFixed(2));
        
    }else if(valor == 2 || valor == "2"){

        var a = $('#calculo_detal').val();
        var valor_input = $('#p_detal').val(a);
    }
});
$('#calculo_mayor').keyup(function(){

    var valor = $('#aplicar_iva').val();
    if (valor == 1 || valor == "1") {
      
        var a = $('#calculo_mayor').val();
        var valor = a.split('.').join('');
    
        var neto = ((parseFloat(valor)/1.19));
    
        var iva = (parseFloat(neto)*19)/100;
        var suma = Math.round(iva) + parseFloat(neto);
    
        var valor_input = $('#p_mayor').val(neto.toFixed(2));
        
    }else if(valor == 2 || valor == "2"){

        var a = $('#calculo_mayor').val();
        var valor_input = $('#p_mayor').val(a); 
    }
});