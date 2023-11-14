<table class="table table-light" style="font-size:10px;">
    <thead>
        <tr>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Codigo</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Presentacion</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Marca</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Nombre</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Vitola</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">RG</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;"h>Capa R.</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Color</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Tamaño</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Cant. Parejas</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Pendiente</th>
            @php
                $fecha = Carbon\Carbon::now()->format('Y-m-d');

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
                    }

                    if ($dia_de_semana == 0) {
                        $days_to_add = 1; // Número de días que deseas sumar

                        $fecha_timestamp = strtotime($fecha);
                        $nueva_fecha_timestamp = strtotime("+$days_to_add days", $fecha_timestamp);
                        $fecha = date('Y-m-d', $nueva_fecha_timestamp);
                    }
                @endphp
                <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">{{ $fecha }}</th>
                @php
                    $fecha_obj = new DateTime($fecha);
                    $days_to_add = 1;

                    $fecha_timestamp = strtotime($fecha);
                    $nueva_fecha_timestamp = strtotime("+$days_to_add days", $fecha_timestamp);
                    $fecha = date('Y-m-d', $nueva_fecha_timestamp);
                @endphp
            @endfor

        </tr>
    </thead>
    <tbody>
        @php
            $total_restante = 0;
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
                @php
                    $parejas += $pendiente->parejas;
                    $producido_acumulado = $pendiente->restantes;
                    $total_restante +=$pendiente->restantes;
                @endphp
                @for ($i = 0; $i < $dias; $i++)
                    @php
                        $producido = $pendiente->tarea_acumulada;

                        if($producido > $pendiente->restantes){
                            $producido = $pendiente->restantes;
                            $pendiente->restantes = 0;
                        }

                        if($producido_acumulado < $producido){
                            $producido = $producido_acumulado;
                        }
                        $producido_acumulado -= $producido;

                        $total_acumulados[$i] += $producido;
                    @endphp
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $producido }}</td>

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
            @foreach ($total_acumulados as $total)
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;"><b>{{ $total }}</b></td>
            @endforeach
        </tr>
    </tfoot>
</table>
