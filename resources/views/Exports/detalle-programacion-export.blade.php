<table class="table table-light table-hover" id="editable" style="font-size:10px;">
    <thead>
        <tr style="text-align:center;">
            <th># ORDEN</th>
            <th style=" text-align:center;">ORDEN</th>
            <th style=" text-align:center;">ITEM</th>
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
            <th style=" text-align:center;">SALDO(M)</th>
            <th style=" text-align:center;">EXISTENCIA(P)</th>
            <th style=" text-align:center;">SOB/FAL</th>
            <th style=" text-align:center;">CAJAS</th>
            <th style=" text-align:center;">EN EXISTENCIA(C)</th>
            <th style=" text-align:center;">SOB/FAL</th>
        </tr>
    </thead>
    <tbody>
        @php
            $existencia_actual = 0;
            $pendiente_restante = 0;

            $total_materiales = 0;
        @endphp
        @foreach($detalles_provicionales as $detalle_provicional)
        <tr>
            <td>{{$detalle_provicional->numero_orden}}</td>
            <td>{{$detalle_provicional->orden}}</td>
            <td>{{$detalle_provicional->item}}</td>
            <td>{{$detalle_provicional->cod_producto}}</td>
            <td>{{$detalle_provicional->marca}}</td>
            <td>{{$detalle_provicional->vitola}}</td>
            <td>{{$detalle_provicional->nombre}}</td>
            <td>{{$detalle_provicional->capa}}</td>
            <td>{{$detalle_provicional->tipo_empaque}}</td>
            <td>{{$detalle_provicional->anillo}}</td>
            <td>{{$detalle_provicional->cello}}</td>
            <td>{{$detalle_provicional->upc}}</td>
            <td>{{intval($detalle_provicional->saldo)}}</td>
            <td></td>
            <td>{{intval($detalle_provicional->existencia_puros)}}</td>
            @if (intval($detalle_provicional->cantidad_sobrante_puros) < 0)
                <td style="color: red">{{'Faltan '.intval($detalle_provicional->cantidad_sobrante_puros)}}</td>
            @endif
            @if (intval($detalle_provicional->cantidad_sobrante_puros) > 0)
                <td style="color: rgb(119, 0, 255)">{{'Sobran '.intval($detalle_provicional->cantidad_sobrante_puros)}}</td>
            @endif
            @if (intval($detalle_provicional->cantidad_sobrante_puros) == 0)
                <td>{{intval($detalle_provicional->cantidad_sobrante_puros)}}</td>
            @endif
            <td>{{intval($detalle_provicional->cant_cajas)}}</td>
            <td>{{intval($detalle_provicional->existencia_cajas)}}</td>
            @if (intval($detalle_provicional->cantida_sobrante) < 0)
                <td style="color: red">{{'Faltan '.intval($detalle_provicional->cantida_sobrante)}}</td>
            @endif
            @if (intval($detalle_provicional->cantida_sobrante) > 0)
                <td style="color: rgb(119, 0, 255)">{{'Sobran '.intval($detalle_provicional->cantida_sobrante)}}</td>
            @endif
            @if (intval($detalle_provicional->cantida_sobrante) == 0)
                <td>{{intval($detalle_provicional->cantida_sobrante)}}</td>
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
                    <th></th>
                    <th></th>
                    <th></th>
                    <td>{{ $materiale->cantidad_m }}</td>
                    <td>{{ $materiale->existencia_material  }}</td>
                    @if ($materiale->restante  < 0)
                        <td style="color: red">{{'Faltan '.$materiale->restante}}</td>
                    @endif
                    @if ($materiale->restante > 0)
                        <td style="color: rgb(119, 0, 255)">{{'Sobran '.$materiale->restante }}</td>
                    @endif
                    @if ($materiale->restante  == 0)
                        <td>{{$materiale->restante }}</td>
                    @endif
                    <th colspan="4"></th>
                </tr>

            @endforeach
        @endif

        @endforeach
    </tbody>
</table>
