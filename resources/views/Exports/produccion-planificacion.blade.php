<table class="table table-hover table-sm">
    <thead>
        <tr>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;"><b>N#</b></th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;"><b>COD</b></th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;"><b>BONCHERO</b></th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;"><b>COD</b></th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;"><b>ROLERO</b></th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;"><b>ORDEN</b></th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;"><b>VITOLA</b></th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;"><b>MARCAS</b></th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;"><b>PEND.</b></th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;"><b>TAREA</b></th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;"><b>ESTIMADO</b></th>
        </tr>
    </thead>
    <tbody class="fs-7">
        @foreach ($modulo_empleado as $key => $emple)
        <tr>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ ++$key }}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $emple->codigo_empleaado }}</td>
            <td style="font-size:12px;border: 1px solid #C00;">{{ $emple->nombre_empleado }}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $emple->codigo_empleaado2 }}</td>
            <td style="font-size:12px;border: 1px solid #C00;">{{ $emple->nombre_empleado2 }}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $emple->orden_sistema }}</td>
            <td style="font-size:12px;border: 1px solid #C00;">{{ $emple->vitola.' '.$emple->nombre }}</td>
            <td style="font-size:12px;border: 1px solid #C00;">{{ $emple->marca }}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"><b>{{ $emple->restantes }}</b></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $emple->tareas }}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">
                @if($emple->tareas == 0 || is_null($emple->marca))
                    0
                @else
                    @php
                        $n = $emple->por_empleado / $emple->tareas;
                        $whole = floor($n); // 1
                        $fraction = $n - $whole; // .25
                    @endphp
                    {{ number_format($n , 0).'d y '. number_format(($fraction )*8, 0).'h' }}
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>



