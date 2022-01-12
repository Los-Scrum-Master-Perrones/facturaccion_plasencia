<table  id="editable" style="font-size:10px;">
                    <thead>
                        <tr style="text-align:center;">
                            <th># ORDEN</th>
                            <th style=" text-align:center;">ORDEN</th>
                            <th style=" text-align:center;">CODIGO</th>
                            <th style=" text-align:center;">MARCA</th>
                            <th style=" text-align:center;">VITOLA</th>
                            <th style=" text-align:center;">NOMBRE</th>
                            <th style=" text-align:center;">CAPA</th>
                            <th style=" text-align:center;">TIPO EMPAQUE</th>
                            <th style=" text-align:center;">ANILLO</th>
                            <th style=" text-align:center;">CELLO</th>
                            <th style=" text-align:center;">UPC</th>
                            <th style=" text-align:center;">SALDO</th>
                            <th style=" text-align:center;">SOLICITAR(CAJAS)</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detalles_provicionales as $detalle_provicional)
                        <tr>
                            <td>{{$detalle_provicional->numero_orden}}</td>
                            <td>{{$detalle_provicional->orden}}</td>
                            <td>{{$detalle_provicional->cod_producto}}</td>
                            <td>{{$detalle_provicional->marca}}</td>
                            <td>{{$detalle_provicional->vitola}}</td>
                            <td>{{$detalle_provicional->nombre}}</td>
                            <td>{{$detalle_provicional->capa}}</td>
                            <td>{{$detalle_provicional->tipo_empaque}}</td>
                            <td>{{$detalle_provicional->anillo}}</td>
                            <td>{{$detalle_provicional->cello}}</td>
                            <td>{{$detalle_provicional->upc}}</td>
                            <td>{{$detalle_provicional->saldo}}</td>


                      

                        <?php
                            $cajas_totales_en_progrmacion = DB::select('CALL `01_programacion_provisional_cajas`(?)', [$detalle_provicional->codigo_caja]);
                            $existencia_cajas = DB::select('SELECT codigo,existencia FROM lista_cajas WHERE lista_cajas.codigo = ?', [$detalle_provicional->codigo_caja]);

                            if(isset($cajas_totales_en_progrmacion[0]->total_cajas)){
                                if(isset($existencia_cajas[0]->existencia) ){

                                    if($existencia_cajas[0]->existencia< 0){

                                    echo '<td>Sobran '.($existencia_cajas[0]->existencia-$cajas_totales_en_progrmacion[0]->total_cajas).' cajas</td>' ;

                                    }else{

                                    echo '<td style="color:red;">Faltan '.($existencia_cajas[0]->existencia-$cajas_totales_en_progrmacion[0]->total_cajas).' cajas</td>' ;

                                    }

                                }else{
                                    echo '<td>No existe</td>' ;
                                }
                            }else{
                                echo '<td>N/A</td>' ;
                            }

                        ?>
                       
                        </tr>

                        @endforeach
                    </tbody>
                </table>