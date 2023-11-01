@php
    $pagina = 1;
    $por_pagina = 6;

    $lunes_e = 0;
    $martes_e = 0;
    $miercoles_e = 0;
    $jueves_e = 0;
    $viernes_e = 0;
    $sabado_e = 0;
    $e_suma_total = 0;
    $e_suma_total_precio = 0;

    $lunes_neto = 0;
    $martes_neto = 0;
    $miercoles_neto = 0;
    $jueves_neto = 0;
    $viernes_neto = 0;
    $sabado_neto = 0;
    $e_suma_neto_precio =0;

    $empleado = '';
    $marca = '';
    $medida = '';
    $precio = '';
@endphp
<tr>
    <td colspan="12" style='text-align: center; font-family: Cambria; font-size: 22'><i><u>TABACOS DE ORIENTE S. DE R.L - PARAISO</u></i></td>
</tr>
<tr>
    <td></td>
    <td colspan="6" style='text-align: center; font-family: Calibri; font-size: 11'><i><b>Planilla de Brocha Semana del 09/10/2023 al 15/10/2023</b></i></td>
</tr>
@foreach ($pendiente as $key => $pend)
    @php
            $e_suma_neto_precio += $pend->precio * $pend->suma_total;
    @endphp
    @if( $empleado == $pend->nombre_empleado)
        <tr>
            <td style="font-size: 7.5px">{{ $pend->marca }}</td>
            <td style="font-size: 7.5px">{{ $pend->vitola }}</td>
            <td>{{ $pend->precio }}</td>
            <td>{{ $pend->lunes }}</td>
            <td>{{ $pend->martes }}</td>
            <td>{{ $pend->miercoles }}</td>
            <td>{{ $pend->jueves }}</td>
            <td>{{ $pend->viernes }}</td>
            <td>{{ $pend->sabado }}</td>
            <td style="text-align: center">{{ $pend->suma_total }}</td>
            <td style="text-align: center">L. {{ number_format($pend->precio * $pend->suma_total,2,',','.') }}</td>
            <td></td>
        </tr>
        @php
                $lunes_e += $pend->lunes;
                $martes_e += $pend->martes;
                $miercoles_e += $pend->miercoles;
                $jueves_e += $pend->jueves;
                $viernes_e += $pend->viernes;
                $sabado_e += $pend->sabado;
                $e_suma_total += $pend->suma_total;
                $e_suma_total_precio += $pend->precio * $pend->suma_total;
        @endphp
    @else

        @if($empleado != '')
        <tr>
            <td><b></b></td>
            <td><b></b></td>
            <td><b></b></td>
            <td><b>{{ $lunes_e}}</b></td>
            <td><b>{{ $martes_e }}</b></td>
            <td><b>{{ $miercoles_e }}</b></td>
            <td><b>{{ $jueves_e }}</b></td>
            <td><b>{{ $viernes_e }}</b></td>
            <td><b>{{ $sabado_e }}</b></td>
            <td style="text-align: center"><b>{{ $e_suma_total }}</b></td>
            <td style="text-align: center;color: red"><b>L. {{ number_format($e_suma_total_precio,2,',','.') }}</b></td>
            <td><b></b></td>
        </tr>
            @php
                    $lunes_e = 0;
                    $martes_e = 0;
                    $miercoles_e = 0;
                    $jueves_e = 0;
                    $viernes_e = 0;
                    $sabado_e = 0;
                    $e_suma_total = 0;
                    $e_suma_total_precio = 0;
            @endphp
        @endif
        <tr></tr>
        @php
            $empleado = $pend->nombre_empleado;
            $marca = $pend->marca;
            $medida = $pend->vitola;
        @endphp
        <tr>
            <td style="width: 100px"><b>Tabacos de Oriente, S. De R. L.  - El Paraiso</b></td>
            <td colspan="11" style='text-align: center; font-family: ARIAL; font-size: 10'><b>{{ $pend->codigo_empleaado.' - '.$pend->nombre_empleado }}</b></td>
        </tr>
        <tr>
            <td></td>
            <td style="width: 90px;text-align: center"><b>Medida</b></td>
            <td style="width: 90px;text-align: center"><b>Precio</b></td>
            <td style="width: 90px;text-align: center"><b>L</b></td>
            <td style="width: 90px;text-align: center"><b>M</b></td>
            <td style="width: 90px;text-align: center"><b>M</b></td>
            <td style="width: 90px;text-align: center"><b>J</b></td>
            <td style="width: 90px;text-align: center"><b>V</b></td>
            <td style="width: 90px;text-align: center"><b>S</b></td>
            <td style="width: 90px;text-align: center"><b>A/T</b></td>
            <td style="width: 90px;text-align: center"><b>Total</b></td>
            <td style="width: 90px;text-align: center"><b>O. INGRESOS</b></td>
        </tr>
        <tr>
            <td style="font-size: 7.5px">{{ $pend->marca }}</td>
            <td style="font-size: 7.5px">{{ $pend->vitola }}</td>
            <td>{{ $pend->precio }}</td>
            <td>{{ $pend->lunes }}</td>
            <td>{{ $pend->martes }}</td>
            <td>{{ $pend->miercoles }}</td>
            <td>{{ $pend->jueves }}</td>
            <td>{{ $pend->viernes }}</td>
            <td>{{ $pend->sabado }}</td>
            <td style="text-align: center">{{ $pend->suma_total }}</td>
            <td style="text-align: center">L. {{ number_format($pend->precio * $pend->suma_total,2,',','.') }}</td>
            <td></td>
        </tr>

        @php
                $lunes_e += $pend->lunes;
                $martes_e += $pend->martes;
                $miercoles_e += $pend->miercoles;
                $jueves_e += $pend->jueves;
                $viernes_e += $pend->viernes;
                $sabado_e += $pend->sabado;
                $e_suma_total += $pend->suma_total;
                $e_suma_total_precio += $pend->precio * $pend->suma_total;
        @endphp
    @endif
    @if(count($pendiente) == ($key+1))
    <tr>
        <td><b></b></td>
        <td><b></b></td>
        <td><b></b></td>
        <td><b>{{ $lunes_e}}</b></td>
        <td><b>{{ $martes_e }}</b></td>
        <td><b>{{ $miercoles_e }}</b></td>
        <td><b>{{ $jueves_e }}</b></td>
        <td><b>{{ $viernes_e }}</b></td>
        <td><b>{{ $sabado_e }}</b></td>
        <td style="text-align: center"><b>{{ $e_suma_total }}</b></td>
        <td style="text-align: center;color: red"><b>L. {{ number_format($e_suma_total_precio,2,',','.') }}</b></td>
        <td><b></b></td>
    </tr>
        @php
                $lunes_e = 0;
                $martes_e = 0;
                $miercoles_e = 0;
                $jueves_e = 0;
                $viernes_e = 0;
                $sabado_e = 0;
                $e_suma_total = 0;
                $e_suma_total_precio = 0;
        @endphp

    @endif
@endforeach

<tr>
    <td style="color: red; font-size: 11px; text-align: center" colspan="12"><b>::::::::::Boletas::::::::::</b></td>
</tr>
<tr></tr>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td style="color: blue; font-size: 10px; font-family: Arial" colspan="3"><b>Total Ordinario Planilla</b></td>
    <td style="color: red; font-size: 10px; font-family: Arial"><b>L. {{ number_format($e_suma_neto_precio,2,',','.') }}</b></td>
    <td></td>
</tr>
<tr></tr>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td style="color: red; font-size: 10px; font-family: Arial;text-align: center"><b>G.T.</b></td>
    <td style="color: red; font-size: 10px; font-family: Arial;text-align: center"><b>L. {{ number_format($e_suma_neto_precio,2,',','.') }}</b></td>
</tr>

