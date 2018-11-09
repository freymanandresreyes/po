$('#buscar_informe_compras').click(function()
{
    var fecha1=$('#fecha1').val();
    var fecha2=$('#fecha2').val();
    // console.log(numero_factura);
    // console.log(proveedor);
    // console.log(fecha);
    var url= URLdominio+'generar_informe_compras';

    if(fecha1=="" || fecha2=="")
    {
        alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
    }
    else
    {
    $.ajax({
      url:url,
      type: 'GET',
      data: {
         fecha1:fecha1,
         fecha2:fecha2
      },
      dataType: 'json',
      success: function(respuesta){
        $('#tabla_facturas_compras').html(respuesta);
        
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });    
      }
     });
    }
});