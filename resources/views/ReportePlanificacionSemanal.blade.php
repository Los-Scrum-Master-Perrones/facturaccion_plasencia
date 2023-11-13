<table class="table table-light" style="font-size:10px;">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Presentacion</th>
            <th>Marca</th>
            <th>Nombre</th>
            <th>Vitola</th>
            <th>RG</th>
            <th>Capa R.</th>
            <th>Color</th>
            <th>Tamaño</th>
            <th>Pendiente</th>
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
                <th>{{ $fecha }}</th>
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
        @foreach ($pendientes as $pendiente)
            <tr>
                <td>{{ $pendiente->codigo }}</td>
                <td>{{ $pendiente->presentacion }}</td>
                <td>{{ $pendiente->marca }}</td>
                <td>{{ $pendiente->nombre }}</td>
                <td>{{ $pendiente->vitola }}</td>
                <td>{{ $pendiente->ring_real }}</td>
                <td>{{ $pendiente->capa }}</td>
                <td>{{ $pendiente->color }}</td>
                <td></td>
                <td>{{ $pendiente->restantes }}</td>
                @php
                    $producido_acumulado = $pendiente->restantes;
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
                    @endphp
                    <td>{{ $producido }}</td>
                @endfor
            </tr>
        @endforeach
    </tbody>
</table>
