
<div class="card">
                <div class="card-body">
                    <div class="table-responsive m-t-40"> 
                        <table id="example23" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>tienda</th>
                                    <th>cantidad  al detal</th>
                                    <th>total al detal</th>
                                    <th>cantidad al mayor</th>
                                    <th>total al mayor</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 0 ; $i < (count($final)); $i++)
                                <tr>
                                    <td>{{$final[$i][0]->slug}}</td>
                    
                                    <td>
                                    @if($final[$i][0]->cant_detal==null)
                                    0
                                    @else
                                    {{$final[$i][0]->cant_detal}}
                                    @endif
                                    </td>
                    
                                    <td>
                                    @if($final[$i][0]->total_detal==null)
                                    $ 0
                                    @else
                                    $ {{number_format($final[$i][0]->total_detal)}}
                                    @endif
                                    </td>
                    
                                    <td>
                                    @if($final2[$i][0]->cant_mayor==null)
                                    0
                                    @else
                                    {{$final2[$i][0]->cant_mayor}}
                                    @endif
                                    </td>
                    
                                    <td>
                                    @if($final2[$i][0]->total_mayor==null)
                                    $ 0
                                    @else
                                    $ {{number_format($final2[$i][0]->total_mayor)}}
                                    @endif
                                    </td>
                                </tr>
                                @endfor
                            </tbody>
                            </table>
                     </div>
                </div>
            </div>
                            
                            
