<br>
<div class="row">
    <div class="col-lg-12">
        <div class="card ">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">VENTA TOTAL DIARIA</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body printableArea">


                            <div class="col-md-12">
                                <div class="table-responsive m-t-40" style="clear: both;">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>

                                                <th class="text-center">Nº FACTURA</th>
                                                <th class="text-center">FECHA</th>
                                                <th class="text-center">VALOR</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0 ; $i
                                            < count($objeto_final); $i++) <tr>
                                                <td class="text-center">{{ $objeto_final[$i][0] }}</td>
                                                <td class="text-center">{{ $objeto_final[$i][1] }}</td>
                                                <td class="text-right">$ {{ number_format($objeto_final[$i][6]) }}</td>
                                                </tr>
                                                @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="pull-right m-t-30 text-right">
                                        <h3><b>Total efectivo:</b> $ {{ number_format($total_venta_diaria_efectivo + $consulta_abonos_sistecredito) }}</h3>
                                        <h3><b>Total tarjeta:</b> $ {{ number_format($total_tarjetas + $total_pago_mixto_tarjeta) }}</h3>
                                        <h3><b>Total Sistecredito:</b> $ {{ number_format($total_sistecredito) }}</h3>
                                        <h3><b>Total Abonos Sistecredito:</b> $ {{ number_format($consulta_abonos_sistecredito) }}</h3>
                                        <h3><b>Total Apartados Efectivo:</b> $ {{ number_format($total_pago_efectivo_apartado) }}</h3>
                                        <h3><b>Total Apartados Tarjetas:</b> $ {{ number_format($total_pago_tarjeta_apartado) }}</h3>
                                        <h3><b>Consignacion:</b> $ {{ number_format($total_venta_diaria_consignacion) }}</h3>
                                        <h3><b>(devoluciones y cambios):</b> $ {{ number_format($total_venta_diaria_abono) }}</h3>
                                        <hr>
                                        <h3><b>Total :</b> $ {{ number_format($total_venta_diaria_efectivo + $total_tarjetas + $total_pago_tarjeta_apartado  + $total_pago_efectivo_apartado +$total_sistecredito + $total_pago_mixto_tarjeta + $total_venta_diaria_consignacion) }}</h3>
                                    </div>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <br>




            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">
                        <div class="card-header bg-info">
                            <h4 class="m-b-0 text-white">CAJA MENOR </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-body printableArea">



                                        <div class="col-md-12">
                                            <h5>ENTRADAS</h5>
                                            <div class="table-responsive m-t-40" style="clear: both;">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>

                                                            <th class="text-center">Nº FACTURA</th>
                                                            <th class="text-center">FECHA</th>
                                                            <th class="text-center">VALOR</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @for ($i = 0 ; $i
                                                        < count($consultaentradas); $i++) <tr>
                                                            <td class="text-center">CAJA MENOR</td>
                                                            <td class="text-center">{{ $consultaentradas[$i]['created_at'] }}
                                                            </td>
                                                            <td class="text-right">$ {{ $consultaentradas[$i]['entrada'] }}
                                                            </td>
                                                            </tr>
                                                            @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="pull-right m-t-30 text-right">
                                                <h3><b>Total Entradas :</b> $ {{ $totalentradas }}
                                                </h3>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>


                                        <div class="col-md-12">
                                            <h5>SALIDAS</h5>
                                            <div class="table-responsive m-t-40" style="clear: both;">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>

                                                            <th class="text-center">Nº FACTURA</th>
                                                            <th class="text-center">FECHA</th>
                                                            <th class="text-center">VALOR</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @for ($i = 0 ; $i
                                                        < count($consultasalidas); $i++) <tr>
                                                            <td class="text-center">CAJA MENOR</td>
                                                            <td class="text-center">{{ $consultasalidas[$i]['created_at'] }}
                                                            </td>
                                                            <td class="text-right">$ {{ $consultasalidas[$i]['salida'] }}
                                                            </td>
                                                            </tr>
                                                            @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="pull-right m-t-30 text-right">
                                                <h3><b>Total Salidas:</b> $ {{ $totalsalidas }}
                                                </h3>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>