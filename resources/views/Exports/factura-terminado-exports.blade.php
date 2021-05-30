                <table class="table table-light" id="editable">
                    <thead style="position: static;">
                        <tr style="font-size:10px; text-align:center">
                            <th style="text-align:center;">Bulto<br>Package<br>No.
                            </th>
                            <th style="text-align:center;">Cant.<br>Quant.
                            </th>
                            <th style="text-align:center;">Unidad<br>Unit.
                            </th>
                            <th style="text-align:center;">Units<br>
                            </th>
                            <th style="text-align:center;">Total<br>Tabacos<br>Cigars
                            </th>
                            <th style="text-align:center;">Capa<br>Wrappar
                            </th>
                            <th style="text-align:center;">#
                            </th>
                            <th style="text-align:center;">Clase<br>Class
                            </th>
                            <th style="text-align:center;">CODIGO #<br>ITEM #
                            </th>
                            <th style="text-align:center;">YOUR<br>ITEM #
                            </th>
                            <th style="text-align:center;">YOUR<br>ORDER #
                            </th>
                            <th style="text-align:center;">ORDER<br>AMOUNT
                            </th>
                            <th style="text-align:center;">BACK<br>ORDER<br>AMOUNT
                            </th>
                            <th style="text-align:center;">Bruto<br>Gross
                            </th>
                            <th style="text-align:center;">Neto<br>Net
                            </th>
                            <th style="text-align:center;">Precio FOB<br>per 1000
                            </th>
                            <th style="text-align:center;">Cost
                            </th>
                            <th style="text-align:center;">Valor<br>Value
                            </th>
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
                            <td>{{$detalles->orden_restante}}</td>
                            <td>{{$detalles->total_bruto}}</td>
                            <td>{{$detalles->total_neto}}</td>
                            <td>{{$detalles->precio_producto}}</td>

                            <td>{{$detalles->costo}}</td>
                            <td>{{$detalles->valor_total}}</td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
   