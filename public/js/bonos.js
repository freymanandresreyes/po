//captura la direccion del servidor
function getAbsolutePath() {
    var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
  }
  var URLdominio = getAbsolutePath();

  $('#codigo').keypress(function(e){
      if(e.which==13)
      {
        var tag_factura = $('#codigo').val(); // captura el tag de la factura
        console.log(tag_factura);
      }
    
  });