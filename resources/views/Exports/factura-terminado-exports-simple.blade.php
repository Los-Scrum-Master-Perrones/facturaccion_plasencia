    <table class="table table-light table-hover" id="editable">
        <thead style="position: static;">
            <tr style="font-size:10px; text-align:center">
                <th rowspan="2">Bulto<br>Package<br>No. </th>
                <th rowspan="2">Cant.<br>Quant. </th>
                <th rowspan="2">Unidad<br>Unit. </th>
                <th rowspan="2">Total<br>Tabacos<br>Cigars </th>
                <th rowspan="2">Capa<br>Wrappar </th>
                <th rowspan="2">Clase<br>Class </th>
                <th rowspan="2">CODIGO #<br>ITEM # </th>
                <th rowspan="2" style="background:#ddd;">YOUR<br>ORDER # </th>
                <th rowspan="2">ORDER<br>AMOUNT </th>
                <th rowspan="2">BACK<br>ORDER<br>AMOUNT </th>
                <th colspan="2"> Peso en Libras<br>Weigth in Pounds </th>
                <th rowspan="2">Precio FOB<br>per 1000 ($) </th>
                <th rowspan="2">Valor<br>Value ($)</th>
            </tr>

            <tr style="font-size:8px; ">
                <th>Bruto Gross</th>
                <th>Neto Net</th>
            </tr>

        </thead>
        <tbody>


            @php
                $orden = '';
                $orden_actua = '';
                $total_saldo = 0;
                $item = '';
                $total_puros_tabla = 0;
                $total_ac = 0;
                $total_neto = 0;
                $total_bruto = 0;
                $valor_factura = 0;
                $sampler_s = 0;

            @endphp



            <?php
            $bultos = 0;
            $val_anterioir = 0;
            $val_actual = 0;
            ?>

            @foreach ($detalles_venta as $detalles)
                @php

                    $sampler = DB::select(
                        'SELECT sampler FROM clase_productos WHERE item =
                ?',
                        [$detalles->codigo_item],
                    );

                    $pendiente = DB::select(
                        'SELECT orden,mes FROM pendiente WHERE id_pendiente =
                ?',
                        [$detalles->id_pendiente],
                    );

                    $conteo_sampler = DB::select(
                        'SELECT COUNT(*) AS tuplas FROM pendiente WHERE item = ? AND orden
                = ? and mes = ?',
                        [$detalles->codigo_item, $pendiente[0]->orden, $pendiente[0]->mes],
                    );

                    $item_primero = DB::select(
                        'SELECT id_pendiente FROM pendiente WHERE item = ? AND mes = ? AND
                orden LIKE
                CONCAT("%",?,"%") limit 0,1',
                        [$detalles->codigo_item, $pendiente[0]->mes, $pendiente[0]->orden],
                    );

                    $total_pendiente = DB::select(
                        'SELECT sum(pendiente.saldo) AS
                total_saldo,sum(pendiente.pendiente) AS total_pendiente FROM pendiente WHERE item = ? AND orden
                = ? and mes = ?',
                        [$detalles->codigo_item, $pendiente[0]->orden, $pendiente[0]->mes],
                    );

                    if ($sampler[0]->sampler == 'si') {
                        $repartir = $detalles->total_tabacos / $conteo_sampler[0]->tuplas;
                    }

                @endphp

                @if ($sampler[0]->sampler == 'si' && $item_primero[0]->id_pendiente == $detalles->id_pendiente)
                    @php
                        $sampler_nombre = DB::select(
                            'SELECT concat((SELECT tipo_empaque_ingles FROM tipo_empaques WHERE
                    tipo_empaques.id_tipo_empaque = clase_productos.id_tipo_empaque)," ",descripcion_sampler) as nom
                    FROM clase_productos WHERE item = ?',
                            [$detalles->codigo_item],
                        );

                        $promedio = DB::select(
                            'SELECT AVG(precio) AS promedio FROM detalle_clase_productos WHERE item =
                    ?',
                            [$detalles->codigo_item],
                        );
                    @endphp


                    <tr style="font-size:10px;">
                        @php
                            $val_anterioir = $bultos + 1;
                            $bultos += $detalles->cantidad_puros;

                            $val_actual = $bultos;

                            $total_sampler_detalles = DB::select(
                                'SELECT SUM(cantidad_puros*unidad) AS salida FROM
                    detalle_factura WHERE facturado = "N" and id_pendiente = ?',
                                [$detalles->id_pendiente],
                            )[0]->salida;

                            $cantidad_sampler_empresa = DB::select(
                                'SELECT COUNT(pendiente.saldo) AS sampler_empresa
                    FROM pendiente WHERE item = ? AND orden
                    = ? and mes = ?',
                                [$detalles->codigo_item, $pendiente[0]->orden, $pendiente[0]->mes],
                            )[0]->sampler_empresa;

                            $cantidad_total_sampler_factura = DB::select(
                                'SELECT COUNT(pendiente.saldo) AS
                    sampler_factura
                    FROM pendiente WHERE item = ? AND orden
                    = ? and mes = ? AND pendiente != 0 AND saldo !=
                    0',
                                [$detalles->codigo_item, $pendiente[0]->orden, $pendiente[0]->mes],
                            )[0]->sampler_factura;

                            $total_ac = intval($total_pendiente[0]->total_saldo) - (intval($total_sampler_detalles) * intval($cantidad_total_sampler_factura)) / intval($cantidad_sampler_empresa);

                            $total_saldo_pendiente = DB::update(
                                'UPDATE detalle_factura SET anterior = ? WHERE
                    id_detalle =
                    ?',
                                [$total_ac, $detalles->id_detalle],
                            );
                        @endphp

                        @if ($val_actual == $val_anterioir)
                            <td style="overflow-x:auto;">{{ $val_actual }}</td>
                        @else
                            <td style="overflow-x:auto;">{{ $val_anterioir }} al {{ $val_actual }}
                            </td>
                        @endif

                        <td>{{ $detalles->cantidad_puros }}</td>
                        <td>{{ $detalles->unidad }}</td>
                        <td></td>
                        <td>SEVERAL</td>
                        <td><b>{{ strtoupper($sampler_nombre[0]->nom) }}</b> </td>
                        <td></td>
                        <td>{{ $detalles->orden }}</td>
                        <td>{{ $total_pendiente[0]->total_pendiente }}</td>
                        <td>{{ $total_ac }}</td>

                        <td>{{ $detalles->total_bruto }}</td>
                        <td>{{ $detalles->total_neto }}</td>
                        <td>{{ $detalles->precio_producto }}</td>
                        <td style="text-align: center">-</td>



                    </tr>

                    @php

                        $total_neto += $detalles->total_neto;
                        $total_bruto += $detalles->total_bruto;
                        $unidades = DB::select(
                            'SELECT item,orden,mes,paquetes FROM pendiente WHERE id_pendiente =
                                                    ?',
                            [$detalles->id_pendiente],
                        );
                        $total_unidades = 0;

                        $total_paqutes = DB::select(
                            'SELECT sum(paquetes) AS total_pendiente FROM pendiente
                            WHERE item = ? AND orden = ? and mes = ?',
                                            [$unidades[0]->item, $unidades[0]->orden, $unidades[0]->mes],
                                        );
                        $sampler_s = 0;
                        $arreglo_detalles = DB::select('CALL `traer_detalles_productos_factura`(?, ?)', [$detalles->codigo_item, $sampler_s]);
                    @endphp



                    <tr style="font-size:10px;">

                        <td style="overflow-x:auto;"></td>


                        <td></td>
                        <td></td>
                        <td>{{ $detalles->total_tabacos * (intval($unidades[0]->paquetes) / $total_paqutes[0]->total_pendiente) }}
                        </td>
                        <td>{{ $arreglo_detalles[0]->capa }}</td>
                        <td>{{ strtoupper($arreglo_detalles[0]->sampler) }}</td>
                        <td>{{ $arreglo_detalles[0]->otra_descripcion }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: right">{{ number_format($arreglo_detalles[0]->precio, 4) }}</td>
                        <td style="text-align: right">
                            {{ number_format(($detalles->total_tabacos * (intval($unidades[0]->paquetes) / $total_paqutes[0]->total_pendiente) * $arreglo_detalles[0]->precio) / 1000, 2) }}
                        </td>
                        @php
                            $valor_factura += ($detalles->total_tabacos * (intval($unidades[0]->paquetes) / $total_paqutes[0]->total_pendiente) * $arreglo_detalles[0]->precio) / 1000;
                        @endphp



                    </tr>


                    @php
                        $total_puros_tabla += $detalles->total_tabacos * (intval($unidades[0]->paquetes) / $total_paqutes[0]->total_pendiente);
                        $sampler_s++;
                    @endphp
                @elseif ($sampler[0]->sampler == 'si')
                    @php
                        $arreglo_detalles = DB::select('CALL `traer_detalles_productos_factura`(?, ?)', [$detalles->codigo_item, $sampler_s]);

                        $total_ac = intval($total_pendiente[0]->total_saldo) - intval($detalles->total_tabacos);

                        $total_saldo_pendiente = DB::update(
                            'UPDATE detalle_factura SET anterior = ? WHERE id_detalle =
                    ?',
                            [$total_ac, $detalles->id_detalle],
                        );
                    @endphp

                    <tr style="font-size:10px;">
                        <td style="overflow-x:auto;"></td>
                        <td></td>
                        <td></td>
                        <td>{{ $detalles->total_tabacos * (intval($unidades[0]->paquetes) / $total_paqutes[0]->total_pendiente) }}
                        </td>
                        <td>{{ $arreglo_detalles[0]->capa }}</td>
                        <td>{{ strtoupper($arreglo_detalles[0]->sampler) }}</td>
                        <td>{{ $arreglo_detalles[0]->otra_descripcion }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: right">{{ number_format($arreglo_detalles[0]->precio, 4) }}</td>
                        <td style="text-align: right">
                            {{ number_format(($detalles->total_tabacos * (intval($unidades[0]->paquetes) / $total_paqutes[0]->total_pendiente) * $arreglo_detalles[0]->precio) / 1000, 2) }}
                        </td>
                        @php
                            $valor_factura += ($detalles->total_tabacos * (intval($unidades[0]->paquetes) / $total_paqutes[0]->total_pendiente) * $arreglo_detalles[0]->precio) / 1000;
                        @endphp

                    </tr>

                    @php
                        $total_puros_tabla += $detalles->total_tabacos * (intval($unidades[0]->paquetes) / $total_paqutes[0]->total_pendiente);
                        $sampler_s++;
                    @endphp
                @else
                    @php
                        $total_puros_tabla += $detalles->total_tabacos;
                        $sampler_s = 0;
                    @endphp

                    <tr style="font-size:10px;">


                        <?php
                        $val_anterioir = $bultos + 1;
                        $bultos += $detalles->cantidad_puros;
                        $val_actual = $bultos;

                        $total_puros_salida = DB::select('SELECT SUM(cantidad_puros*unidad) AS salida FROM detalle_factura WHERE facturado = "N" and id_pendiente = ?', [$detalles->id_pendiente]);
                        $total_saldo_pendiente = DB::select('SELECT saldo FROM pendiente WHERE id_pendiente = ?', [$detalles->id_pendiente]);

                        $total_restante = intval($total_saldo_pendiente[0]->saldo) - intval($total_puros_salida[0]->salida);

                        $total_saldo_pendiente = DB::update('UPDATE detalle_factura SET anterior = ? WHERE id_detalle = ?', [$total_restante, $detalles->id_detalle]);

                        $total_neto += $detalles->total_neto;
                        $total_bruto += $detalles->total_bruto;
                        ?>

                        @if ($val_actual == $val_anterioir)
                            <td style="overflow-x:auto;">{{ $val_actual }}</td>
                        @else
                            <td style="overflow-x:auto;">{{ $val_anterioir }} al {{ $val_actual }}
                            </td>
                        @endif

                        <td>{{ $detalles->cantidad_puros }}</td>
                        <td>{{ $detalles->unidad }}</td>
                        <td>{{ $detalles->total_tabacos }}</td>
                        <td>{{ $detalles->capas }}</td>
                        <td>{{ $detalles->producto }}</td>
                        <td>{{ $detalles->codigo }}</td>
                        <td>{{ $detalles->orden }}</td>
                        <td>{{ $detalles->orden_total }}</td>
                        <td>{{ $total_restante }}</td>
                        <td>{{ $detalles->total_bruto }}</td>
                        <td>{{ $detalles->total_neto }}</td>
                        <td style="text-align: right">{{ $detalles->precio_producto }}</td>
                        <td style="text-align: right">{{ number_format($detalles->valor_total, 2) }}</td>
                        @php
                            $valor_factura += $detalles->valor_total;
                        @endphp



                    </tr>
                @endif
            @endforeach
            <tr style="font-size:10px;">
                <td></td>
                <td><b>{{ $val_actual }}</b></td>
                <td></td>
                <td><b>{{ $total_puros_tabla }}</b></td>

                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

                <td><b>{{ number_format($total_bruto, 2) }}</b></td>
                <td><b>{{ number_format($total_neto, 2) }}</b></td>

                <td></td>
                <td style="text-align: right"><b>{{ number_format($valor_factura, 2) }}</b></td>
            </tr>
            <tr style="font-size:10px;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size:10px;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size:10px;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size:9px;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>CARIBBEAN CIGAR COMPANY</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

        </tbody>
    </table>
