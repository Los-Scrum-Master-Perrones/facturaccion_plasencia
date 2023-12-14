<tr></tr>
<tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th> </th>
    <th></th>
    <th></th>
    <th></th>
    <th style="width:100px; font-size: 16px; font-weight: bold">Pendiente por Producir {{ Carbon\Carbon::now()->format('Y-m-d') }}</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
</tr>
<tr></tr>
<table class="table table-light table-hover" style="font-size:9px;" id="tabla_pendiente">
    <thead>
        <tr>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">N#</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">EMPRESA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">CODIGO</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"># ORDEN</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">FECHA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">EN PROCESO</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">OBSERVACÓN</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">PRESENTACION</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">MES</th>
            <th style="width:200px;text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">MARCA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">NOMBRE</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">VITOLA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">CAPA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">COLOR</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">PRIORIDAD</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">PEND. PRIORIDAD</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">PENDIENTE</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">PRODUCIDO</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">%</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">RESTANTE</th>
        </tr>
    </thead>
    <tbody name="body" id="body">
        @php
            $sumaPendiente = 0;
            $sumaRestantes = 0;
            $sumaProducido = 0;
            $sumaPriodiad = 0;
            $sumaPriodiadRestantes = 0;


            $sumaprecio_dolar = 0;
            $moldes_nesarios_base10 = 0;
            $moldes_exitentea = 0;
            $moldes_sin_molde = 0;
        @endphp
        @foreach ($pendiente as $i => $detalle)
            <tr>
                @php
                $fecha_recibido = new DateTime($detalle->fecha_recibido);
                $fecha_actual = new DateTime();

                $intervalo = new DateInterval('P1D'); // Intervalo de 1 día
                $periodo = new DatePeriod($fecha_recibido, $intervalo, $fecha_actual);

                $dias_habiles = 0;

                foreach ($periodo as $fecha) {
                    $dia_semana = $fecha->format('N'); // 1 (lunes) a 7 (domingo)

                    // Excluir sábado (6) y domingo (7)
                    if ($dia_semana != 6 && $dia_semana != 7) {
                        $dias_habiles++;
                    }
                }
                $diferencia_dias = $dias_habiles;
            @endphp
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ ++$i }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->empresa }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->codigo }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->orden_sistema }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->fecha_recibido }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $diferencia_dias }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->observacion }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->presentacion }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->mes }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;width:200px">{{ $detalle->marca }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->nombre }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->vitola }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->capa }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->color }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00; text-align: center">{{ $detalle->prioridad }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00; text-align: center; text-align:right;color: red">
                    {{ $detalle->pendiente_prioridad <= 0 && $detalle->prioridad>0 ? 'Completado' : $detalle->pendiente_prioridad }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;text-align:right;">{{ $detalle->pendiente }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;text-align:right;">{{ $detalle->pendiente - $detalle->restantes }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;text-align:right;">
                    @php
                        $porcentaje = (($detalle->pendiente - $detalle->restantes) / $detalle->pendiente) * 100;
                    @endphp
                    {{ number_format($porcentaje, 0) }}%
                </td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;text-align:right;">{{ $detalle->restantes }}</td>
            </tr>

            @php
                $sumaPendiente += $detalle->pendiente;
                $sumaRestantes += $detalle->restantes;
                $sumaProducido += $detalle->pendiente - $detalle->restantes;
                $sumaPriodiad += $detalle->prioridad;
                $sumaPriodiadRestantes = $detalle->pendiente_prioridad;
            @endphp
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;width:200px"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $sumaPriodiad }}</td>
            <td style="font-size:12px;border: 1px solid #C00; text-align:right;color: red">{{ $sumaPriodiadRestantes }}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;text-align:right;">{{ $sumaPendiente }}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;text-align:right;">{{ $sumaProducido }}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;text-align:right;">
                @php
                    $porcentaje = (($sumaPendiente - $sumaRestantes) / $sumaPendiente) * 100;
                @endphp
                {{ number_format($porcentaje, 0) }}%
            </td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;text-align:right;">{{ $sumaRestantes }}</td>
        </tr>
    </tfoot>
</table>
