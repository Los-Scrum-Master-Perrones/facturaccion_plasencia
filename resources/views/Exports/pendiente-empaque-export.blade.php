<table class="table table-light table-hover" style="font-size:10px;" id="tabla_pendiente_empaque">
    <thead style="width:100px;">
        <tr>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">N#</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">CATEGORIA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">ITEM</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">CODIGO CAJA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"># ORDEN</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">PRESENTACIÓN</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">MES</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">ORDEN</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">MARCA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">VITOLA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">NOMBRE</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">CAPA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">TIPO DE EMPAQUE</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">ANILLO</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">CELLO</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">UPC</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">PENDIENTE</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">SALDO</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">CODIGO CAJA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">CODIGO PURO</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">CANT. CAJAS</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">CAJAS</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">CAJAS FALTANTES</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">PUROS NECESARIOS</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">PUROS</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">PUROS FALTANTES</th>
        </tr>
    </thead>
    <tbody name="bodyE" id="bodyE">
        @php
            $total_cajas = 0;
            $total_cajas_necesarias = 0;
            $total_cajas_faltantes = 0;

            $total_puros = 0;
            $total_puros_necesarias = 0;
            $total_puros_faltantes = 0;
        @endphp
        @foreach ($datos_pendiente_empaque as $i => $datos)
            <tr>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ ++$i }}</td>
                <td  style="text-align:center;font-size:12px;border: 1px solid #C00;width:100px; max-width: 400px;overflow-x:auto;">
                    {{ isset($datos->categoria) ? $datos->categoria : 'Sin categoria' }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ isset($datos->item) ? $datos->item : '' }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">
                    {{ isset($datos->codigo_caja) ? $datos->codigo_caja : '' }}
                </td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ isset($datos->orden_del_sitema) ? $datos->orden_del_sitema : '' }}</td>
                <td  style="text-align:center;font-size:12px;border: 1px solid #C00;width:100px;">{{ $datos->presentacion }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $datos->mes }}</td>

                <td  style="text-align:center;font-size:12px;border: 1px solid #C00;width:100px;">{{ $datos->orden }}</td>
                <td  style="text-align:center;font-size:12px;border: 1px solid #C00;width:100px;">{{ $datos->marca }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $datos->vitola }}</td>

                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $datos->nombre }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $datos->capa }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $datos->tipo_empaque }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $datos->anillo }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $datos->cello }}</td>

                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $datos->upc }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $datos->pendiente }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $datos->saldo }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $datos->codigo_caja }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $datos->codigo_productos }}</td>
                @php
                    $cajitas = 0;
                    if ($datos->sampler != 'si' && (explode(" ", $datos->tipo_empaque)[0] == 'CAJAS' || explode(" ", $datos->tipo_empaque)[0] == 'CAJA')) {
                        $cajitas = intval($datos->cant_cajas);
                    }
                @endphp
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{  $cajitas }}</td>

                @if(isset($cajas[$datos->codigo_caja]))
                    @php
                        $apartado = intval($cajas[$datos->codigo_caja]) - intval($datos->cant_cajas);
                        $cajasocupada = 0;
                        $cajasfaltantes = 0;
                        if ($apartado >= 0) {
                            $cajasocupada = intval($datos->cant_cajas);
                        }
                        if ($apartado < 0) {
                            $cajasocupada = intval($cajas[$datos->codigo_caja]);
                        }
                    @endphp

                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $cajasocupada }}</td>
                    @php
                        $cajas[$datos->codigo_caja] = intval($cajas[$datos->codigo_caja]) - intval($datos->cant_cajas);
                        if ($cajas[$datos->codigo_caja] < 0) {
                            $cajas[$datos->codigo_caja] = 0;
                        }

                        $total_cajas += $cajasocupada;
                        if ($datos->sampler != 'si' && (explode(" ", $datos->tipo_empaque)[0] == 'CAJAS' || explode(" ", $datos->tipo_empaque)[0] == 'CAJA')) {
                            $total_cajas_necesarias += intval($datos->cant_cajas);
                            $cajasfaltantes = intval($datos->cant_cajas) - $cajasocupada;

                            $total_cajas_faltantes += $cajasfaltantes ;
                        }

                    @endphp
                @else
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{  0 }}</td>
                @endif
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $cajasfaltantes }}</td>


                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $datos->saldo }}</td>
                @if(isset($puros[$datos->codigo_productos]))
                    @php
                        $apartado = intval($puros[$datos->codigo_productos]) - intval($datos->saldo);
                        $purosocupada = 0;
                        $purosfaltantes = 0;
                        if ($apartado >= 0) {
                            $purosocupada = intval($datos->saldo);
                        }
                        if ($apartado < 0) {
                            $purosocupada = intval($puros[$datos->codigo_productos]);
                        }
                    @endphp

                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $purosocupada }}</td>
                    @php
                        $puros[$datos->codigo_productos] = intval($puros[$datos->codigo_productos]) - intval($datos->saldo);
                        if ($puros[$datos->codigo_productos] < 0) {
                            $puros[$datos->codigo_productos] = 0;
                        }

                        $total_puros += $purosocupada;
                        $total_puros_necesarias += intval($datos->saldo);
                        $purosfaltantes = intval($datos->saldo) - $purosocupada;

                        $total_puros_faltantes += $purosfaltantes ;


                    @endphp
                        <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $purosfaltantes }}</td>
                @else
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ 0 }}</td>
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $datos->saldo }}</td>

                    @php
                        $total_puros_faltantes += $datos->saldo ;
                        $total_puros_necesarias += intval($datos->saldo);
                    @endphp
                @endif

            </tr>

        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"></th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"></th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"></th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"></th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"></th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"></th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"></th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"></th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"></th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"></th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"></th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"></th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"></th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"></th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"></th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"></th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"></th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"></th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"></th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"></th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">{{ $total_cajas_necesarias }}</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">{{ $total_cajas }}</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">{{ $total_cajas_faltantes }}</th>

            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">{{ $total_puros_necesarias }}</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">{{ $total_puros }}</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">{{ $total_puros_faltantes }}</th>
        </tr>
    </tfoot>
</table>
