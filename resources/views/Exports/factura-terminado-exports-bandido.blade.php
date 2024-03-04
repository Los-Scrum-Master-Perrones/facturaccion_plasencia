                <table class="table table-light table-hover" id="editable">
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="text-align:center; font-family: Tahoma;font-size:24px;"><b>CARIBBEAN CIGARS
                                COMPANY</b></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="font-family: Tahoma; font-size: 8"><b>Factura</b><br><b>Invoice</b></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="font-family: Tahoma; font-size: 8"><b>Address: Danli, El Paraiso,Honduras</b></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="font-family: Tahoma; font-size: 8; text-justify: auto"><b>E-Mail:
                                taosasanmarcos@plasenciatabaco.com</b></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="font-family: Tahoma; font-size: 8"><b>Contact: Samia Valladares</b></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="font-family: Tahoma; font-size: 8"><b>Phones: (504) 27632906 / (504) 27636981</b></th>
                    </tr>
                    <tr>
                        <td style="font-family: Arial; font-size: 8"><b>Vendido a</b></td>
                    </tr>
                    <tr>
                        <td style="font-family: Arial; font-size: 8"><b>Sold to</b></td>
                        <td style="font-family: Arial; font-size: 11; font-weight: bold" colspan="4">SCANDINAVIAN TOBACCO GROUP ESTELI S,A</td>
                        <td style="font-family: Arial; font-size: 8; font-weight: bold">Date</td>
                        <td style="font-family: Tahoma; font-size: 10; font-weight: bold" colspan="3">JUNIO DEL 2023</td>
                    </tr>
                    <tr>
                        <td style="font-family: Arial; font-size: 8"><b>Direccion</b></td>
                        <td style="font-family: Arial; font-size: 10" colspan="4">KM 145 CARRETERA PANAMERICANA, SALIDA SUR.</td>
                        <td style="font-family: Tahoma; font-size: 8; font-weight: bold">Su orden No.</td>
                    </tr>
                    <tr>
                        <td style="font-family: Arial; font-size: 8"><b>Address</b></td>
                        <td style="font-family: Arial; font-size: 10" colspan="4">RUC J0310000019797.</td>
                        <td style="font-family: Tahoma; font-size: 8;font-weight: bold">Your order No.</td>
                        <td style="font-family: Tahoma; font-size: 8;" colspan="3">FTT</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="font-family: Arial; font-size: 10" colspan="4">PHONE 505-2713-2661</td>
                        <td style="font-family: Tahoma; font-size: 8;font-weight: bold">Instrucciones de Embarque</td>
                    </tr>
                    <tr>
                        <td style="font-family: Arial; font-size: 8"><b>Condiciones</b></td>
                        <td style="font-family: Arial; font-size: 10" colspan="4">ZONA FRANCA-ESTELI</td>
                        <td style="font-family: Tahoma; font-size: 8; font-weight: bold">Shipping instruccitions</td>
                        <td style="font-family: Tahoma; font-size: 10; font-weight: bold" colspan="3">Scandinavian Tobacco Group</td>
                    </tr>
                    <tr>
                        <td style="font-family: Arial; font-size: 8"><b>Conditions</b></td>
                        <td style="font-family: Arial; font-size: 10" colspan="4">Ana.Palacios@st-group.com</td>
                        <td></td>
                        <td style="font-family: Tahoma; font-size: 10;" colspan="3">Kilometro 145, Carretera Panamericana</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="4"></td>
                        <td></td>
                        <td style="font-family: Tahoma; font-size: 10;" colspan="3">Salida Sur donde fue la Barranca</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="4"></td>
                        <td></td>
                        <td style="font-family: Tahoma; font-size: 10;" colspan="3">Esteli, Nicaragua</td>
                    </tr>
                    <thead style="position: static;">
                        <tr style="font-size:10px; text-align:center">
                            <th rowspan="2">Bulto<br>Package<br>No. </th>
                            <th rowspan="2">Cant.<br>Quant. </th>
                            <th rowspan="2">Unidad<br>Unit. </th>
                            <th rowspan="2">Total<br>Tabacos<br>Cigars </th>
                            <th rowspan="2">Capa<br>Wrappar </th>
                            <th rowspan="2">Clase<br>Class </th>
                            <th rowspan="2" style="background:#ddd;">N°<br>ORDER</th>
                            <th rowspan="2">Destino</th>
                            <th rowspan="2">SKU</th>
                            <th rowspan="2">GCC ITEM<br>NUMBER</th>
                            <th colspan="2">Peso en Libras<br>Weigth in Pounds </th>
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
                                        <td
                                            style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;overflow-x:auto;">
                                            {{ $val_actual }}</td>
                                    @else
                                        <td
                                            style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;overflow-x:auto;">
                                            {{ $val_anterioir }} al {{ $val_actual }}
                                        </td>
                                    @endif

                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;overflow-x:auto;">
                                        {{ $detalles->cantidad_puros }}</td>
                                    <td
                                        style="text-align:right;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;overflow-x:auto;">
                                        {{ $detalles->unidad }}</td>

                                    <td></td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;overflow-x:auto;">
                                        SEVERAL</td>
                                    <td
                                        style="text-align:left;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;overflow-x:auto;">
                                        <b>{{ strtoupper($sampler_nombre[0]->nom) }}</b> </td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;overflow-x:auto;">
                                        {{ $detalles->orden }}</td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;overflow-x:auto;">
                                    </td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;overflow-x:auto;">
                                        {{ $detalles->codigo_item }}</td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;overflow-x:auto;">
                                    </td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;overflow-x:auto;">
                                        {{ $detalles->total_bruto }}</td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;overflow-x:auto;">
                                        {{ $detalles->total_neto }}</td>
                                    <td
                                        style="text-align:right;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;overflow-x:auto;">
                                        {{ $detalles->precio_producto }}</td>

                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;overflow-x:auto;">
                                        -</td>



                                </tr>

                                @php

                                    $total_neto += $detalles->total_neto;
                                    $total_bruto += $detalles->total_bruto;

                                    $sampler_s = 0;
                                    $arreglo_detalles = DB::select('CALL `traer_detalles_productos_factura`(?, ?)', [$detalles->codigo_item, $sampler_s]);
                                @endphp



                                <tr style="font-size:10px;">

                                    <td style="overflow-x:auto;"></td>

                                    @php
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

                                    @endphp

                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                    </td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                    </td>
                                    <td
                                        style="text-align:right;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                        {{ $detalles->total_tabacos * (intval($unidades[0]->paquetes) / $total_paqutes[0]->total_pendiente) }}
                                    </td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                        {{ $arreglo_detalles[0]->capa }}</td>
                                    <td
                                        style="text-align:left;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                        {{ strtoupper($arreglo_detalles[0]->sampler) }}</td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                    </td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                    </td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                    </td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                        {{ $arreglo_detalles[0]->otra_descripcion }}</td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                    </td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                    </td>
                                    <td
                                        style="text-align:right;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                        {{ number_format($arreglo_detalles[0]->precio, 4) }}</td>
                                    <td
                                        style="text-align:right;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
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
                                    @php
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

                                    @endphp
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                    </td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                    </td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                    </td>
                                    <td
                                        style="text-align:right;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                        {{ $detalles->total_tabacos * (intval($unidades[0]->paquetes) / $total_paqutes[0]->total_pendiente) }}
                                    </td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                        {{ $arreglo_detalles[0]->capa }}</td>
                                    <td
                                        style="text-align:left;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                        {{ strtoupper($arreglo_detalles[0]->sampler) }}</td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                    </td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                    </td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                    </td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                        {{ $arreglo_detalles[0]->otra_descripcion }}</td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                    </td>
                                    <td
                                        style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                    </td>
                                    <td style="text-align:right;font-size:9px; height: 24px;border: 5px solid #C00;">
                                        {{ number_format($arreglo_detalles[0]->precio, 4) }}</td>
                                    <td style="text-align:right;font-size:9px; height: 24px;border: 5px solid #C00;">
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
                                <tr>


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
                                        <td
                                            style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                            {{ $val_actual }}</td>
                                    @else
                                        <td
                                            style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;overflow-x:auto;">
                                            {{ $val_anterioir }} al {{ $val_actual }}
                                        </td>
                                    @endif

                                    <td style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;">
                                        {{ $detalles->cantidad_puros }}</td>
                                    <td style="text-align:right;font-size:9px; height: 24px;border: 5px solid #C00;">
                                        {{ $detalles->unidad }}</td>
                                    <td style="text-align:right;font-size:9px; height: 24px;border: 5px solid #C00;">
                                        {{ $detalles->total_tabacos }}</td>
                                    <td style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;">
                                        {{ $detalles->capas }}</td>
                                    <td style="text-align:left;font-size:9px; height: 24px;border: 5px solid #C00;">
                                        {{ $detalles->producto }}</td>
                                    <td style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;">
                                        {{ $detalles->orden }}</td>
                                    <td style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;"></td>
                                    <td style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;">
                                        {{ $detalles->codigo_item }}</td>
                                    <td style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;">
                                        {{ $detalles->codigo }}</td>
                                    <td style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;">
                                        {{ $detalles->total_bruto }}</td>
                                    <td style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;">
                                        {{ $detalles->total_neto }}</td>
                                    <td style="text-align:center;font-size:9px; height: 24px;border: 5px solid #C00;">
                                        {{ $detalles->precio_producto }}</td>
                                    <td style="text-align:right;font-size:9px; height: 24px;border: 5px solid #C00;">
                                        {{ number_format($detalles->valor_total, 2) }}</td>
                                    @php
                                        $valor_factura += $detalles->valor_total;
                                    @endphp



                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td
                                style="text-align:right;font-size:12px; font-weight: bold; height: 24px;border: 5px solid #C00;">
                            </td>
                            <td
                                style="text-align:right;font-size:12px; font-weight: bold; height: 24px;border: 5px solid #C00;">
                                <b>{{ $val_actual }}</b></td>
                            <td
                                style="text-align:right;font-size:12px; font-weight: bold; height: 24px;border: 5px solid #C00;">
                            </td>
                            <td
                                style="text-align:right;font-size:12px; font-weight: bold; height: 24px;border: 5px solid #C00;">
                            </td>
                            <td
                                style="text-align:right;font-size:12px; font-weight: bold; height: 24px;border: 5px solid #C00;">
                                <b>{{ $total_puros_tabla }}</b></td>


                            <td
                                style="text-align:right;font-size:12px; font-weight: bold; height: 24px;border: 5px solid #C00;">
                            </td>
                            <td
                                style="text-align:right;font-size:12px; font-weight: bold; height: 24px;border: 5px solid #C00;">
                            </td>
                            <td
                                style="text-align:right;font-size:12px; font-weight: bold; height: 24px;border: 5px solid #C00;">
                            </td>
                            <td
                                style="text-align:right;font-size:12px; font-weight: bold; height: 24px;border: 5px solid #C00;">
                            </td>
                            <td
                                style="text-align:right;font-size:12px; font-weight: bold; height: 24px;border: 5px solid #C00;">
                            </td>
                            <td
                                style="text-align:right;font-size:12px; font-weight: bold; height: 24px;border: 5px solid #C00;">
                                <b>{{ number_format($total_bruto, 2) }}</b></td>
                            <td
                                style="text-align:right;font-size:12px; font-weight: bold; height: 24px;border: 5px solid #C00;">
                                <b>{{ number_format($total_neto, 2) }}</b></td>
                            <td
                                style="text-align:right;font-size:12px; font-weight: bold; height: 24px;border: 5px solid #C00;">
                            </td>
                            <td
                                style="text-align:right;font-size:12px; font-weight: bold; height: 24px;border: 5px solid #C00;">
                                <b>{{ number_format($valor_factura, 2) }}</b></td>
                        </tr>
                        <tr>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                        </tr>
                        <tr>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                        </tr>
                        <tr>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                        </tr>
                        <tr>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td
                                style="text-align:center;font-size:11px; height: 24px;border: 5px solid #C00; font-family: Calibri">
                                <b>CARIBBEAN CIGAR COMPANY</b></td>

                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                            <td style="text-align:center;font-size:8px; height: 24px;border: 5px solid #C00;"></td>
                        </tr>
                    </tbody>
                    <tr>
                        <td style="font-family: Thaoma; font-size: 8" colspan="6">
                            REMIT PAYMENT BY A CHECK OR WIRE TRANSFER TO:
                        </td>
                        <td style="font-family: Thaoma; font-size: 8" colspan="4">
                            COUNTRY OF ORIGEN: HONDURAS
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family: Thaoma; font-weight: bold; font-size: 8" colspan="6">
                            TERRABANK N. A. 3191 CORAL WAY, PENTHOUSE 1,MIAMI FL. 33145. TEL: 305 448 4898
                        </td>
                        <td style="font-family: Thaoma; font-weight: bold; font-size: 8" colspan="4">
                            Manufactured by Tabacos De Oriente, S. De RL.
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family: Thaoma; font-weight: bold; font-size: 8" colspan="6">
                            ABA N° 066012333 ,  SWIFT TBNAUS33
                        </td>
                        <td style="font-family: Thaoma; font-weight: bold; font-size: 8" colspan="4">
                            Apartado #33, Danli, El Paraiso Honduras, S.
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family: Thaoma; font-size: 8" colspan="6">
                            FOR DEPOSIT INTO: CARIBBEAN CIGAR COMPANY   ACCOUNT NO: 1270595006
                        </td>
                        <td style="font-family: Thaoma; font-size: 8" colspan="4">
                            NONE OF THE CONSTITUENT TOBACCOS ARE FROM CUBA
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family: Thaoma; font-size: 8" colspan="6">
                            ALL SALES AND PRICES ARE FOB HONDURAS / NICARAGUA
                        </td>
                        <td style="font-family: Thaoma; font-size: 8" colspan="4">
                            NONE OF THE CONSTITUENT TOBACCOS ARE FROM CUBA
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family: Thaoma; font-size: 8" colspan="6">
                            CALLE AQUILINO DE LA GUARDIA,PISO 9. TORRE BANCO GENERAL. MARBELLA,BELLA VISTA. PANAMA,PANAMA. TEL: 507 209 5900
                        </td>
                        <td style="font-family: Thaoma; font-size: 8" colspan="4">
                            NONE OF THE CONSTITUENT TOBACCOS ARE FROM CUBA
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family: Thaoma; font-size: 8" colspan="6">
                            ALL SALES AND PRICES ARE FOB HONDURAS / NICARAGUA
                        </td>
                        <td style="font-family: Thaoma; font-size: 8" colspan="4">
                            NONE OF THE CONSTITUENT TOBACCOS ARE FROM CUBA
                        </td>
                    </tr>
                </table>
