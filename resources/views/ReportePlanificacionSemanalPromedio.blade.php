<table class="table table-light table-hover" style="font-size:10px;">
    <thead>
        <tr>
            <th rowspan="2" style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Codigo</th>
            <th rowspan="2" style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Presentacion</th>
            <th rowspan="2" style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Marca</th>
            <th rowspan="2" style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Nombre</th>
            <th rowspan="2" style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Vitola</th>
            <th rowspan="2" style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">RG</th>
            <th rowspan="2" style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Capa R.</th>
            <th rowspan="2" style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Color</th>
            <th colspan="3" style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Lunes</th>
            <th colspan="3" style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Martes</th>
            <th colspan="3" style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Miercoles</th>
            <th colspan="3" style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Jueves</th>
            <th colspan="3" style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Viernes</th>
        </tr>
        <tr>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">T</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">P</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">%</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">T</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">P</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">%</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">T</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">P</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">%</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">T</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">P</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">%</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">T</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">P</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">%</th>
        </tr>
    </thead>
    <tbody>
        @php
            $lunes_produccion = 0;
            $martes_produccion = 0;
            $miercoles_produccion = 0;
            $jueves_produccion = 0;
            $viernes_produccion = 0;


            $lunes_porcentaje = 0;
            $martes_porcentaje = 0;
            $miercoles_porcentaje = 0;
            $jueves_porcentaje = 0;
            $viernes_porcentaje = 0;

            $tarea_total = 0;
        @endphp

        @foreach ($pendientes as $pendiente)
            @php
                $tarea_total += $pendiente->tarea_acumulada;

            @endphp
            <tr>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->codigo }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->presentacion }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->marca }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->nombre }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->vitola }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->ring_real }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->capa }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->color }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->tarea_acumulada }}</td>
                @if(isset($produccion[$fecha_inicial][$pendiente->codigo][0]->total_producido))
                    @php
                        $lunes_produccion += $produccion[$fecha_inicial][$pendiente->codigo][0]->total_producido;
                    @endphp
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $produccion[$fecha_inicial][$pendiente->codigo][0]->total_producido }}</td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $produccion[$fecha_inicial][$pendiente->codigo][0]->total_producido/$pendiente->tarea_acumulada }}</td>
                @else
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
                @endif
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->tarea_acumulada }}</td>
                @php
                    $martes = Carbon\Carbon::parse($fecha_inicial)->addDay(1)->format('Y-m-d');
                @endphp
                @if(isset($produccion[$martes][$pendiente->codigo][0]->total_producido))
                    @php
                        $martes_produccion += $produccion[$martes][$pendiente->codigo][0]->total_producido;
                    @endphp
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $produccion[$martes][$pendiente->codigo][0]->total_producido }}</td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $produccion[$martes][$pendiente->codigo][0]->total_producido/$pendiente->tarea_acumulada }}</td>
                @else
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
                @endif
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->tarea_acumulada }}</td>
                @php
                    $miercoles = Carbon\Carbon::parse($fecha_inicial)->addDay(2)->format('Y-m-d');
                @endphp
                @if(isset($produccion[$miercoles][$pendiente->codigo][0]->total_producido))
                    @php
                        $miercoles_produccion += $produccion[$miercoles][$pendiente->codigo][0]->total_producido;
                    @endphp
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $produccion[$miercoles][$pendiente->codigo][0]->total_producido }}</td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $produccion[$miercoles][$pendiente->codigo][0]->total_producido/$pendiente->tarea_acumulada }}</td>
                @else
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
                @endif
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->tarea_acumulada }}</td>
                @php
                    $jueves = Carbon\Carbon::parse($fecha_inicial)->addDay(3)->format('Y-m-d');
                @endphp
                @if(isset($produccion[$jueves][$pendiente->codigo][0]->total_producido))
                    @php
                        $jueves_produccion += $produccion[$jueves][$pendiente->codigo][0]->total_producido;
                    @endphp
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $produccion[$jueves][$pendiente->codigo][0]->total_producido }}</td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $produccion[$jueves][$pendiente->codigo][0]->total_producido/$pendiente->tarea_acumulada }}</td>
                @else
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
                @endif
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pendiente->tarea_acumulada }}</td>
                @php
                    $viernes = Carbon\Carbon::parse($fecha_inicial)->addDay(4)->format('Y-m-d');
                @endphp
                @if(isset($produccion[$viernes][$pendiente->codigo][0]->total_producido))
                    @php
                        $viernes_produccion += $produccion[$viernes][$pendiente->codigo][0]->total_producido;
                    @endphp
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $produccion[$viernes][$pendiente->codigo][0]->total_producido }}</td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $produccion[$viernes][$pendiente->codigo][0]->total_producido/$pendiente->tarea_acumulada }}</td>
                @else
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
                @endif
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
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $tarea_total }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $lunes_produccion }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $tarea_total }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $martes_produccion }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $tarea_total }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $miercoles_produccion }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $tarea_total }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $jueves_produccion }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $tarea_total }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $viernes_produccion }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
        </tr>
    </tfoot>
</table>
