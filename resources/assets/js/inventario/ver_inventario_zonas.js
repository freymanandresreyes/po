
$('#cont_inventario .editar_inv').on('click', function () {
    // alert($(this).attr('name'));
    var id_producto = $(this).attr('name');

    var url = getAbsolutePath() + 'inventario_buscar';

    $.ajax({
        url: url,
        type: 'GET',
        data: {
            id_producto: id_producto
        },
        dataType: 'json',
        success: function (respuesta) {

            $('#editar_codigo').val(respuesta.codigo);
            $('#editar_id').val(respuesta.id);
            $('#editar_titulo').val(respuesta.titulo);
            $('#editar_descripcion').val(respuesta.descripcion);
            $('#editar_cantidad').val(respuesta.cantidad);
            $("#editar_costo").val(respuesta.precio_costo);
            $('#editar_detal').val(respuesta.precio);
            $('#editar_mayor').val(respuesta.Precio_mayorista);
            $('#editar_oferta').val(respuesta.descuentoOferta);
            $('#editar_categoria').val(respuesta.categoria_productos.id);

            if(respuesta.siyno != null){
            $("#editar_estado_oferta_producto").val(respuesta.siyno.id);
            }
            // console.log(respuesta.clasificacion);
            // return(false);
            if(respuesta.clasificacion != null){
                $("#editar_configuracion_producto").val(respuesta.clasificacion.id);
            }
            $("#editar_subcategoria").append('<option selected value=' + respuesta.subcategoria_productos.id + '>' + respuesta.subcategoria_productos.nombre_categoria + '</option>');

            $("#modal_inventario").addClass("show");

            $("#modal_inventario").css({
                "display": "block",
                "padding-right": "16px",
                "background": "rgba(0, 0, 0, 0.5)"
            });
        }//fin del success
    });//fin de ajax

});



$('#guardar_editar_producto').on('click', function () {
    // alert($(this).attr('name'));
    $("#guardar_editar_producto").prop('disabled',true);
    var id_producto = $(this).attr('name');

    var codigo = $('#editar_codigo').val();
    var id = $('#editar_id').val();
    var titulo = $('#editar_titulo').val();
    var descripcion = $('#editar_descripcion').val();
    var cantidad = $('#editar_cantidad').val();
    var costo = $("#editar_costo").val();
    var precio = $('#editar_detal').val();
    var precio_mayor = $('#editar_mayor').val();
    var descuento = $('#editar_oferta').val();
    var estado_oferta = $("#editar_estado_oferta_producto").val();
    var categoria = $('#editar_categoria').val()
    var subcategoria = $("#editar_subcategoria").val();
    var clasificacion = $("#editar_configuracion_producto").val();
    var url = getAbsolutePath() + 'inventario_guardar';

    if (codigo == "" || id == "" || titulo == "" || descripcion == "" || cantidad == "" || costo == "" || precio == "" || 
        precio_mayor == "" || descuento == "" || estado_oferta == "" || categoria == "" || subcategoria == "" || clasificacion == "") {
      alertify.error("Todos los campos son obligatorios.");
      $("#guardar_editar_producto").prop("disabled", false);
      return false;
    } else {
        clasificacion = parseFloat(clasificacion);
      $.ajax({
        url: url,
        type: "GET",
        data: {
          codigo: codigo,
          id: id,
          titulo: titulo,
          descripcion: descripcion,
          cantidad: cantidad,
          costo: costo,
          precio: precio,
          clasificacion: clasificacion,
          precio_mayor: precio_mayor,
          descuento: descuento,
          estado_oferta: estado_oferta,
          categoria: categoria,
          subcategoria: subcategoria
        },
        dataType: "json",
        success: function(respuesta) {
          //  console.log(respuesta);
          if (respuesta) {
            setTimeout(function() {
              location.reload();
            }, 100);
          }
        } //fin del success
      }); //fin de ajax
    }
});


$('#cerrar_editar_producto').click(function(){
    $("#modal_inventario").removeClass("show");

    $("#modal_inventario").css({
        "display": "none"
    });

    $('#editar_codigo').val("");
    $('#editar_id').val("");
    $('#editar_titulo').val("");
    $('#editar_descripcion').val("");
    $('#editar_cantidad').val("");
    $("#editar_costo").val("");
    $("#editar_estado_oferta").val("");
    $('#editar_detal').val("");
    $('#editar_mayor').val("");
    $('#editar_oferta').val("");
    $('#editar_categoria').val("");
    $("#editar_subcategoria").val("");
    $("#editar_estado_oferta_producto").val();
    $("#editar_configuracion_producto").val();
});

$('#editar_categoria').click(function(){
   var categoria = $('#editar_categoria').val();

   var url = getAbsolutePath() + 'inventario_buscar_subcategoria';

   $.ajax({
       url: url,
       type: 'GET',
       data: {
           categoria: categoria
       },
       dataType: 'json',
       success: function (respuesta) {
           //  console.log(respuesta);
           $('#editar_subcategoria').html(respuesta);
       }//fin del success
   });//fin de ajax
});
