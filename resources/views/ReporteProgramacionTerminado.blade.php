<table>
    <thead>
        <tr>
        <th colspan="11" style="text-align:center;">
            <b>Reporte Programacion Terminado</b>
        </th>
        </tr>

    <tr style="font-weight: bold;">
        <th><b>ORDEN</b></th>
        <th><b>H.O.N</b></th>
        <th><b>ITEM</b></th>
        <th><b>MARCA</b></th>
        <th><b>VITOLA</b></th>
        <th><b>NOMBRE</b></th>
        <th><b>CAPA</b></th>
        <th><b>T. EMPAQUE</b></th>
        <th><b>Cant. BULTOS</b></th>
        <th><b>SALDO</b></th>
        <th><b>LISTOS</b></th>
        <th><b>RESTANTE</b></th>
    </tr>
    </thead>
    <tbody>
        @php
        $saldo = 0;
        $listos = 0;
        $restante = 0;
        @endphp
    @foreach($dato as $datos)
        <tr>
            <td>{{ $datos->numero_orden}}</td>
            <td>{{ $datos->orden}}</td>
            <td>{{ $datos->item}}</td>
            <td>{{ $datos->marca}}</td>
            <td>{{ $datos->vitola}}</td>
            <td>{{ $datos->nombre}}</td>
            <td>{{ $datos->capa}}</td>
            <td>{{ $datos->tipo_empaque}}</td>
            <td>{{ Round($datos->saldo/$datos->cantidad_bultos,2)}}</td>
            <td>{{ $datos->saldo }}</td>
            <td>{{ $datos->listos  }}</td>
            @if($datos->saldo!=0)
            <td><b>{{$datos->saldo - $datos->listos}}</b></td>
            @else
            <td><b>N.A</b></td>
            @endif
            @php
            $saldo= $saldo+$datos->saldo;
            $listos= $listos+$datos->listos;
            $restante= $restante + ($datos->saldo - $datos->listos);
            @endphp
        </tr>
    @endforeach

        <tr>
            <td colspan="8" style="text-align:center;"><b>Total</b></td>
            <td><b> {{ $saldo   }} </b></td>
            <td><b> {{ $listos  }} </b></td>
            <td><b> {{ $saldo-$listos}}</b></td>
        </tr>
    </tbody>
</table>