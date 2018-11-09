//Instancia para controlar visualizacion de apartados (Vista de impresion)
var app = new Vue({
  el: '#appVue',
  data: {
    apartados: '',
    loaderVue: false,
    subTotal: 0,
    ivaTotal: 0,
    precioTotal: 0,
    traslado: '',
    facturasCliente: '',
    documentoSistecredito: '',
    nombresClienteSistecredito: '',
    apellidosClienteSistecredito: '',
    telefonoClienteSistecredito: '',
    abonosFactura: '',
    valorAbonoFacturaSistecredito: '',
    formaPagoAbonoFacturaSistecredito: 0,
    errors: '',
    valorTotalAbonosFacturaSistecredito: [],
    tiendasZona: [],
    facturasReferencia: '',
  },
  methods:{
        buscaApartado(consecutivo){
         axios.post('visualizar_apartado', {
         consecutivo: consecutivo
      }).then(response => {
          this.subTotal = 0;
          this.ivaTotal = 0;
          this.precioTotal = 0;
          this.apartados = response.data;
          var i = 0;
          while(i < this.apartados.length) {
            this.subTotal += Math.round(this.apartados[i].codigoproducto.precio);
            this.ivaTotal += Math.round(this.apartados[i].codigoproducto.precio) * 0.19;
            this.precioTotal += Math.round(this.apartados[i].codigoproducto.precio) + (Math.round(this.apartados[i].codigoproducto.precio) * 0.19);
            i++;
          }
          Math.round(this.subTotal);
          Math.round(this.ivaTotal);
          Math.round(this.precioTotal);
      }).catch(error => {
          this.subTotal = 0;
          this.ivaTotal = 0;
          this.precioTotal = 0;
          $('#print_apartado').modal('hide');
          alertify.confirm('No se ha podido visualizar el apartado!<br>Contacte con el administrador.');      
      });
        },
        buscaTraslado(traslado_id){
         axios.post('visualizar_traslado', {
         traslado_id: traslado_id
      }).then(response => {
          this.traslado = response.data;
      }).catch(error => {
          $('#print_traslado').modal('hide');
           this.traslado = '';
          alertify.confirm('No se ha podido visualizar el traslado!<br>Contacte con el administrador.');      
      });
        },
       buscaFacturasCliente(){
          this.facturasCliente = '';
          this.nombresClienteSistecredito = '';
          this.apellidosClienteSistecredito = '';
          this.telefonoClienteSistecredito = '';
          this.abonosFactura = '';
          this.valorTotalAbonosFacturaSistecredito = [];
          this.loaderVue = true;
         axios.post('buscar_facturas_sistecredito', {
         cliente: this.documentoSistecredito
       }).then(response => {
          this.loaderVue = false;
          this.facturasCliente = response.data;
          if(this.facturasCliente.message){
            alertify.error(this.facturasCliente.message);
            return;
          }
          this.nombresClienteSistecredito = this.facturasCliente.cliente.nombres;
          this.apellidosClienteSistecredito = this.facturasCliente.cliente.apellidos;
          this.telefonoClienteSistecredito = this.facturasCliente.cliente.telefono;
          var i = 0;
          while(i < this.facturasCliente.facturas_cliente.length){
              this.totalAbonosFacturaSistecredito(this.facturasCliente.cliente.id,this.facturasCliente.facturas_cliente[i].n_factura,i);
              i++;
          }
          return;
      }).catch(error => {
          alertify.error('No se han podido visualizar las facturas del cliente!<br>Contacte con el administrador.'); 
          this.loaderVue = false;    
       });
      
        },
        buscaAbonosFactura(id_cliente, n_factura){
         this.abonosFactura = '';
         axios.post('buscar_abonos_factura_sistecredito', {
         id_cliente: id_cliente,
         n_factura: n_factura
      }).then(response => {
          this.abonosFactura = response.data;
           if(this.abonosFactura.total_abonos === null || this.abonosFactura.total_abonos === undefined || this.abonosFactura.total_abonos === ''){
              this.abonosFactura.total_abonos = 0;
          }
      }).catch(error => {
           this.abonosFactura = 0;
          alertify.confirm('No se han podido visualizar los abonos de la factura del cliente!<br>Contacte con el administrador.');      
       });
        },
        AbonaFacturaSistecredito(id_cliente,n_factura,index){
        if(confirm('¿Esta seguro de realizar el abono?')){ 
        axios.post('abonar_factura_sistecredito', {
         id_cliente: id_cliente,
         n_factura: n_factura,
         valor: this.valorAbonoFacturaSistecredito,
         forma_pago: this.formaPagoAbonoFacturaSistecredito
      }).then(response => {
          $('#modalAbonoFactura'+index).modal('hide');
          this.valorAbonoFacturaSistecredito = '';
          this.formaPagoAbonoFacturaSistecredito = 0;
          alertify.success('El abono se realizo satisfactoriamente!');
          this.buscaFacturasCliente();
      }).catch(error => {
           this.errors = error.response.data.errors;
          alertify.error('No se ha podido abonar a la factura!<br>Contacte con el administrador.');      
       });
          }
        },
        totalAbonosFacturaSistecredito(id_cliente,n_factura,index){
        axios.post('total_abonos_factura_sistecredito', {
         id_cliente: id_cliente,
         n_factura: n_factura
      }).then(response => {
         if(response.data === '' || response.data === undefined){
           this.valorTotalAbonosFacturaSistecredito.push(0);
         }else{
            this.valorTotalAbonosFacturaSistecredito.push(response.data);
         }
      }).catch(error => {
         this.valorTotalAbonosFacturaSistecredito.push(0);
       });
        },
        buscaTiendas(){
        axios.post('buscar_tienda_zona', {
         zona: $("#zonas").val(),
      }).then(response => {
            this.tiendasZona = response.data;
      }).catch(error => {
         alertify.error('No se ha podido cargar la lista de tiendas!<br>Contacte con el administrador.');
       });
        },
        buscaFacturasReferencia(){
          this.facturasReferencia = '';
          this.loaderVue = true;
          axios.post('informe_referencias', {
             referencia: $("#referencia").val(),
             desde: $("#desde").val(),
             hasta: $("#hasta").val(),
          }).then(response => {
                this.loaderVue = false;
                this.facturasReferencia = response.data;
                console.log(this.facturasReferencia);
          }).catch(error => {
             this.loaderVue = false;
             alertify.error('No se ha podido cargar la lista de facturas!<br>Contacte con el administrador.');
           });
        },
        print(){
        var facturaPrint = $(".facturaVue");
        $("body").html(facturaPrint);
        window.print();
           setTimeout(function () {
                location.reload();
            }, 100);
        },
        formatNumber(number){
          var format = new Intl.NumberFormat().format(number);
          return format;
        },
        formatNumberRound(number){
          var format = Math.round(new Intl.NumberFormat().format(number));
          return format;
        },
        iva(number){
          var iva = number * 0.19;
          return number + iva;
        },

  },
});