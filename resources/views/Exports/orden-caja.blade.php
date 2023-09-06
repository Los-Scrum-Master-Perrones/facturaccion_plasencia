<table>
    <thead>
        <tr>
            <th colspan="8" style="text-align:center;"><b>TABACOS DE ORIENTE S.DE R.L.</b></th>
        </tr>
        <tr>
        <th colspan="2" style="text-align:center;">PARA:</th>
        <th colspan="2" style="text-align:center;">SR. MANUEL TERCERO / FABRICA CAJAS</th>
        </tr>
        <tr>
        <th colspan="2" style="text-align:center;">DE:</th>
        <th colspan="2" style="text-align:center;">SR. ROBERTO ALVAREZ</th>
        </tr>
        <tr>
        <th colspan="2" style="text-align:center;">CLIENTE:</th>
        <th colspan="2" style="text-align:center;">ROCKY PATEL PREMIUN</th>
        </tr>
        <tr>
        <th colspan="2" style="text-align:center;">FECHA:</th>
        <th colspan="2" style="text-align:center;">{{$fecha}}</th>
        </tr>
        <tr>
        <th colspan="8" style="text-align:center;"><b>ORDEN DE CAJAS DE MADERA {{$dato->first()->mes}}</b></th>
        </tr>
        <tr>
        <th colspan="8" style="text-align:center;"><b>ORDEN Nº 000</b></th>
        </tr>

        
        <tr>

        </tr>
    <tr style="font-weight: bold;">
        <th><b>#</b></th>
        <th><b>CODIGO CAJA</b></th>
        <th style="text-align:center;"><b>MARCA</b></th>
        <th><b>NOMBRE</b></th>
        <th><b>VITOLA</b></th>
        <th><b>CAPA</b></th>
        <th><b>TIPO DE EMPAQUE</b></th>
        <th><b>CANTIDAD</b></th>
    </tr>
    </thead>
    <tbody>
        @php
        $total=0;
        @endphp
    @foreach($dato as $datos)
        <tr>
            <td>{{ $datos->orden_del_sitema }}</td>
            <td>{{ $datos->caja }}</td>
            <td>{{ $datos->marca }}</td>
            <td>{{ $datos->nombres }}</td>
            <td>{{ $datos->vitola }}</td>
            <td>{{ $datos->capa }}</td>
            <td>{{ $datos->tipoempaque }}</td>
            <td>{{ $datos->pendiente / $datos->por_caja}}</td>
            @php
            $total= $total+$datos->pendiente / $datos->por_caja
            @endphp
        </tr>
    @endforeach
    <tr>
    <td colspan="7"><b>TOTAL</b></td>
    <td><b>{{ $total }}</b></td>
    </tr>

    </tbody>
</table>