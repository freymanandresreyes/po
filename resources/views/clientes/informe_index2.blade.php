
<div class="card">
                <div class="card-body">
                    <div class="table-responsive m-t-40"> 
                        <table id="example23" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>tienda</th>
                                    <th>Total descuentos</th>
                                    <!-- <th>total facturado</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 0 ; $i < (count($final)); $i++)
                                <tr>
                                    <td>{{$final[$i][0]->slug}}</td>
                    
                                    <td>$ {{number_format($final[$i][0]->total)}}</td>
                    
                                    <!-- <td>$ {{number_format($final[$i][0]->total_suma)}}</td> -->
                                </tr>
                                @endfor
                            </tbody>
                            </table>
                     </div>
                </div>
            </div>
                            
                            
