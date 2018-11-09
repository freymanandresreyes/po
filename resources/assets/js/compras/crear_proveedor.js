// FUNCION PARA ACTIVAR EL BOTON DE CREAR PROVEEDOR
$('#proveedor').click(function()
{
    $('#agregar_proveedor').prop('disabled',false);
});
// FIN FUNCION

// FUNCION PARA MOSTRAR Y CERRAR MODAL DE CREAR PROVEEDOR
$('#agregar_proveedor').click(function()
{
 $("#modal_crear_proveedor" ).addClass( "show" );
    $("#modal_crear_proveedor").css({
                "display": "block",
                "padding-right": "16px",
                "background": "rgba(0, 0, 0, 0.5)"
            });

    $('#cerrar_crear_proveedor').click(function()
    {
        $( "#cerrar_crear_proveedor" ).removeClass( "show" );
        $("#modal_crear_proveedor").css({
             "display": "none"
        }); 
        $('#nombre').val("");
                $('#nit').val("");
                $('#direccion').val("");
                $('#telefono').val("");
        
    });   
});
// FIN FUNCION

// FUNCION PARA GUARDAR UN PROVEEDOR NUEVO
$('#guardar_crear_proveedor').click(function()
{

    var nombre = $('#nombre').val();
    var nit = $('#nit').val();
    var direccion = $('#direccion').val();
    var telefono = $('#telefono').val();
    

    // FUNCION GLOBAL DE LA URL
    var url= URLdominio+'crear_proveedor';
    // FIN FUNCION GLOBAL

    if(nombre=="" || nit=="" || direccion=="" || telefono=="")
    {
        alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
    }
    else
    {
        $.ajax({
            url: url,
            type: 'GET',
            data: {
              nombre: nombre,
              nit: nit,
              direccion: direccion,
              telefono: telefono
            },
            dataType: 'json',
            success: function(respuesta){
                // console.log(respuesta);
             if(respuesta==0)
             {
                alertify.error("ESTE PROVEEDOR YA EXISTE.");
                return(false);
             }else{
                $('#proveedor').append('<option value="'+respuesta.id+'" selected="selected">'+respuesta.nombre+'</option>');
                alertify.success("PROVEEDOR CREADO EXITOSAMENTE.");

                $('#nombre').val("");
                $('#nit').val("");
                $('#direccion').val("");
                $('#telefono').val("");

                $( "#cerrar_crear_proveedor" ).removeClass( "show" );
                $("#modal_crear_proveedor").css({
                    "display": "none"
                });
             }
             
            }//fin del success
          });//fin de ajax
    }
});