<table id="editable" style="font-size:10px;">
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
            <th style=" text-align:center;">EXISTENCIA</th>
            <th style=" text-align:center;">SOB/FAL</th>
            <th style=" text-align:center;">EN EXISTENCIA</th>
            <th style=" text-align:center;">CAJAS</th>


        </tr>
    </thead>
    <tbody>
        @php
            $existencia_actual = 0;
            $pendiente_restante = 0;
        @endphp
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
            <td style="text-align: center">{{intval($detalle_provicional->saldo)}}</td>

            @php
                if ($detalle_provicional->cod_producto == null) {
                    $existe_puros = [];
                } else {
                    $existe_puros = DB::select('SELECT * FROM importar_existencias WHERE codigo_producto = ?', [$detalle_provicional->cod_producto]);
                }
            @endphp


            @if(count($existe_puros) > 0)
                @php
                    $pendiente_restante =  $existe_puros[0]->total - intval($detalle_provicional->saldo);
                    $anteriores_puros = DB::select('SELECT SUM(detalle_programacion_temporal.saldo) AS "anterioir"
                                                    FROM detalle_programacion_temporal
                                                    WHERE detalle_programacion_temporal.cod_producto = ?
                                                            AND id_detalle_programacion < ?',
                                                [$detalle_provicional->cod_producto,
                                                 $detalle_provicional->id]);

                    $pendiente_restante -= $anteriores_puros[0]->anterioir;
               @endphp
                    <td>{{$existe_puros[0]->total - $anteriores_puros[0]->anterioir}}</td>
                    @if ($pendiente_restante < 0)
                        <td style="color: red;text-align: center">{{'Faltan '.$pendiente_restante}}</td>
                    @endif
                    @if ($pendiente_restante > 0)
                        <td style="color: rgb(119, 0, 255);text-align: center">{{'Sobran '.$pendiente_restante}}</td>
                    @endif
                    @if ($pendiente_restante == 0)
                        <td style="text-align: center">{{$pendiente_restante}}</td>
                    @endif

            @else
                <td style="text-align: center">0</td>
                <td style="text-align: center">0</td>
            @endif


            @php
                if ($detalle_provicional->codigo_caja == null) {
                    $existe_caja = [];
                } else {
                    $existe_caja = DB::select('SELECT * FROM lista_cajas WHERE codigo = ?', [$detalle_provicional->codigo_caja]);
                }
            @endphp


            @if(count($existe_caja) > 0)
                @php
                    $existencia_actual = $existe_caja[0]->existencia - $detalle_provicional->cant_cajas_necesarias;
                    $anteriores = DB::select('SELECT SUM(detalle_programacion_temporal.cant_cajas) AS "anterioir"
                                                    FROM detalle_programacion_temporal
                                                    WHERE detalle_programacion_temporal.codigo_caja = ?
                                                            AND id_detalle_programacion < ?',
                                                [$detalle_provicional->codigo_caja,
                                                 $detalle_provicional->id]);

                    $existencia_actual -= $anteriores[0]->anterioir;
               @endphp
                    @if ($existencia_actual < 0)
                        <td style="color: red;text-align: center">{{'Faltan '.$existencia_actual}}</td>
                    @endif
                    @if ($existencia_actual > 0)
                        <td style="color: rgb(119, 0, 255);text-align: center">{{'Sobran '.$existencia_actual}}</td>
                    @endif
                    @if ($existencia_actual == 0)
                        <td style="text-align: center">{{$existencia_actual}}</td>
                    @endif


                <td style="text-align:center">
                    {{intval($detalle_provicional->cant_cajas_necesarias)}}
                </td>
            @else
                <td>N/D</td>

                <td style="text-align:center">0</td>
            @endif


            <td style="text-align:center">

            </td>

        </tr>
        @if($existencia)
            @php
                $detalles_materiale = DB::select('call traer_materiales_temporal(?)', [$detalle_provicional->id]);
            @endphp
            @foreach ($detalles_materiale as $materiale)
                <tr>
                    <th colspan="3"></th>
                    <td colspan="6">{{ '('.$materiale->codigo_material.') '.$materiale->des_material }}</td>
                    <th style="text-align: center">{{ $materiale->uxe }}</th>
                    <th style="text-align: center">{{ $materiale->cantidad }}</th>
                    @php
                        $total_orden = 0;

                        if ($materiale->uxe == 'NO') {

                            $total_orden = intval($detalle_provicional->saldo)/($materiale->cantidad / $materiale->cantidad );

                        }else if($materiale->uxe == 'SI') {

                            if(( intval($detalle_provicional->por_caja) % 3 ) == 0){
                                $total_orden = intval($detalle_provicional->saldo)/(120 / $materiale->cantidad );
                            }else{
                                $total_orden = intval($detalle_provicional->saldo)/(100 / $materiale->cantidad );
                            }

                        }

                    @endphp
                    <td style="text-align: center">{{ $total_orden }}</td>
                    <td style="text-align: center">{{ $materiale->saldo }}</td>
                    @php
                        $existencia_material_actual = $materiale->saldo - $total_orden;
                        $anteriores = DB::select('SELECT SUM(detalles_temporal_materiales.cantidad) AS "anterioir"
                                                        FROM detalles_temporal_materiales
                                                        WHERE detalles_temporal_materiales.id_material = ?
                                                                AND id < ?',
                                                    [$materiale->id_material,
                                                    $materiale->id_de_detalles]);

                        $existencia_material_actual -= $anteriores[0]->anterioir;
                    @endphp
                            @if ($existencia_material_actual < 0)
                                <td style="color: red;text-align: center">{{'Faltan '.$existencia_material_actual}}</td>
                            @endif
                            @if ($existencia_material_actual > 0)
                                <td style="color: rgb(119, 0, 255);text-align: center">{{'Sobran '.$existencia_material_actual}}</td>
                            @endif
                            @if ($existencia_material_actual == 0)
                                <td style="text-align: center">{{$existencia_material_actual}}</td>
                            @endif
                        @php


                        @endphp
                    <th colspan="2"></th>
                </tr>

            @endforeach
        @endif

        @endforeach
    </tbody>
</table>
