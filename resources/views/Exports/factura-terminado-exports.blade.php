                <table class="table table-light" id="editable">
                    <thead style="position: static;">
                        <tr style="font-size:10px; text-align:center">
                            <th rowspan="2">Bulto<br>Package<br>No. </th>
                            <th rowspan="2">Cant.<br>Quant.  </th>
                            <th rowspan="2">Unidad<br>Unit. </th>
                            <th rowspan="2" style="background:#ddd;">Units<br> </th>
                            <th rowspan="2">Total<br>Tabacos<br>Cigars </th>
                            <th rowspan="2">Capa<br>Wrappar  </th>
                            <th rowspan="2">#</th>
                            <th rowspan="2">Clase<br>Class </th>
                            <th rowspan="2">CODIGO #<br>ITEM #  </th>
                            <th rowspan="2">YOUR<br>ITEM #   </th>
                            <th rowspan="2" style="background:#ddd;">YOUR<br>ORDER # </th>
                            <th rowspan="2">ORDER<br>AMOUNT </th>
                            <th rowspan="2">BACK<br>ORDER<br>AMOUNT </th>
                            <th  colspan="2" > Peso en Libras<br>Weigth in Pounds </th>
                            <th rowspan="2">Precio FOB<br>per 1000 ($) </th>
                            <th rowspan="2" style="background:#ddd;">Cost</th>
                            <th rowspan="2">Valor<br>Value ($)</th>
                        </tr>

                        <tr style="font-size:8px; ">
                        <th >Bruto Gross</th>
                        <th >Neto Net</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php  $bultos = 0;
                                $val_anterioir=0;
                               $val_actual=0 ?>

                        @foreach($detalles_venta as $detalles)
                        <tr style="font-size:10px;">
                            <?php
                            $val_anterioir= $bultos+1;
                            $bultos += $detalles->cantidad_puros;

                            $val_actual=$bultos ?>

                            @if ($val_actual == $val_anterioir)
                            <td>{{$val_actual}}</td>
                            @else
                            <td>{{$val_anterioir}} al
                                {{$val_actual}}</td>
                            @endif

                            <td>{{$detalles->cantidad_puros}}</td>
                            <td>{{$detalles->unidad}}</td>
                            <td><b>{{$detalles->cantidad_cajas}}</b></td>
                            <td>{{$detalles->total_tabacos}}</td>
                            <td>{{$detalles->capas}}</td>
                            <td>{{$detalles->cantidad_por_caja}}</td>
                            <td>{{$detalles->producto}}</td>
                            <td>{{$detalles->codigo}}</td>
                            <td>{{$detalles->codigo_item}}</td>
                            <td>{{$detalles->orden}}</td>
                            <td>{{$detalles->orden_total}}</td>
                            <td>{{$detalles->anterior}}</td>
                            <td>{{$detalles->total_bruto}}</td>
                            <td>{{$detalles->total_neto}}</td>
                            <td>{{$detalles->precio_producto}}</td>

                            <td>{{$detalles->costo}}</td>
                            <td>{{$detalles->valor_total}}</td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
