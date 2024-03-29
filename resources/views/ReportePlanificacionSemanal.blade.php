<table class="table table-light table-hover" style="font-size:10px;">
    <thead>
        <tr>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Codigo</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Presentacion</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Marca</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Nombre</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Vitola</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">RG</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Capa R.</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Color</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Tamaño</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Parejas</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Pendiente</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Global</th>
            @php
                $fecha = Carbon\Carbon::now()->format('Y-m-d');
                $fecha2 = Carbon\Carbon::now()->format('d');
            @endphp
            @for ($i = 0; $i < $dias; $i++)
                @php
                    $fecha_obj = new DateTime($fecha);

                    $dia_de_semana = $fecha_obj->format('w');

                    if ($dia_de_semana == 6) {
                        $days_to_add = 2; // Número de días que deseas sumar

                        $fecha_timestamp = strtotime($fecha);
                        $nueva_fecha_timestamp = strtotime("+$days_to_add days", $fecha_timestamp);
                        $fecha = date('Y-m-d', $nueva_fecha_timestamp);
                        $fecha2 = date('d', $nueva_fecha_timestamp);
                    }

                    if ($dia_de_semana == 0) {
                        $days_to_add = 1; // Número de días que deseas sumar

                        $fecha_timestamp = strtotime($fecha);
                        $nueva_fecha_timestamp = strtotime("+$days_to_add days", $fecha_timestamp);
                        $fecha = date('Y-m-d', $nueva_fecha_timestamp);
                        $fecha2 = date('d', $nueva_fecha_timestamp);
                    }
                @endphp
                <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">{{ $fecha2 }}</th>
                @php
                    $fecha_obj = new DateTime($fecha);
                    $days_to_add = 1;

                    $fecha_timestamp = strtotime($fecha);
                    $nueva_fecha_timestamp = strtotime("+$days_to_add days", $fecha_timestamp);
                    $fecha = date('Y-m-d', $nueva_fecha_timestamp);
                    $fecha2 = date('d', $nueva_fecha_timestamp);
                @endphp
            @endfor

        </tr>
    </thead>
    <tbody>
        @php
            $total_restante = 0;
            $total_restante_global = 0;
            $parejas = 0;
            $total_acumulados = array();

            for ($i=0; $i < $dias; $i++) {
                $total_acumulados[] = 0;
            }
        @endphp
        @foreach ($pendientes as $pendiente)
            <tr>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->codigo }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->presentacion }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->marca }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->nombre }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->vitola }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->ring_real }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->capa }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->color }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->parejas }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->restantes }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->restantes_global }}</td>
                @php
                    $parejas += $pendiente->parejas;
                    $producido_acumulado = $pendiente->restantes;
                    $producido_acumulado_global = $pendiente->restantes_global;
                    $total_restante +=$pendiente->restantes;
                    $total_restante_global +=$pendiente->restantes_global;

                    $total_produccio = 0;
                @endphp
                @for ($i = 0; $i < $dias; $i++)
                    @php
                        $producido = $pendiente->tarea_acumulada;

                        if($producido > $pendiente->restantes_global){
                            $producido = $pendiente->restantes_global;
                            $pendiente->restantes_global = 0;
                        }

                        if($producido_acumulado_global < $producido){
                            $producido = $producido_acumulado_global;
                        }
                        $producido_acumulado_global -= $producido;

                        $total_acumulados[$i] += $producido;
                    @endphp

                    @if ($total_produccio >= $producido_acumulado)
                        <td style="text-align:center;font-size:8px;border: 1px solid #C00;@if( $producido !=0 ) color:purple @else color:black @endif" >{{ $producido }}</td>
                    @elseif($total_produccio <= $producido_acumulado)
                        <td style="text-align:center;font-size:8px;border: 1px solid #C00;color:blue"><b>{{ $producido }}</b></td>
                    @endif

                    @php
                        $total_produccio += $producido;
                    @endphp
                @endfor
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"><b>{{ $parejas }}</b></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"><b>{{ $total_restante }}</b></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $total_restante_global }}</td>
            @foreach ($total_acumulados as $total)
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;"><b>{{ $total }}</b></td>
            @endforeach
        </tr>
    </tfoot>
</table>
