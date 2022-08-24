<style>
    th,td{
        font-size: 10px;
        border: 1px solid #C00;
    }
</style>
<table style="font-size:9px;" id="tabla_pendiente">
    <thead>
        <tr>
            <th>N#</th>
            <th>MES</th>
            <th>SISTEMA</th>
            <th>ORDEN</th>
            <th>ITEM</th>
            <th>Codigo</th>
            <th>CAPA</th>
            <th style="width:300px;"> DESCRIPCION</th>
            <th>PENDIENTE</th>
            <th>SALDO</th>
            <th>Cant</th>
            <th>Existencia</th>
            <th>Actual</th>
            <th>Ficha</th>
        </tr>
    </thead>
    <tbody name="body" id="body">
        @php
            $sumas = 0;
            $sumap = 0;
        @endphp

        @foreach($datos_pendiente as $i => $datos)
        <tr>
            <td>{{++$i}}</td>
            <td>{{$datos->mes}}</td>
            <td>{{$datos->orden_del_sitema}}</td>
            <td>{{$datos->orden}}</td>
            <td>{{$datos->item}}</td>
            <td>{{$datos->codigo_productos}}</td>
            <td>{{$datos->capa}}</td>
            <td>{{$datos->tipo_empaque.' '.$datos->marca.' '.$datos->nombre.' '.$datos->vitola}}</td>
            <td>{{$datos->pendiente}}</td>
            <td>{{$datos->saldo}}</td>
            <th></th>
            <th></th>
            <th></th>
        @php
            $detalles_materiale = DB::select('call traer_materiales_pendiente_empaque(?)', [$datos->id_pendiente]);
        @endphp

            @if(count($detalles_materiale)<=0)
                <td>Sin Ficha</td>
            @else
                <td>Con Ficha</td>
            @endif

        </tr>
        @forelse ($detalles_materiale as $materiale)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <th>{{ $materiale->codigo_material }}</th>
                <th>{{ $materiale->factory_item }}</th>
                <td>{{ $materiale->des_material }}</td>
                <td></td>
                <td></td>
                @if($materiale->cantidad_m == '')
                    <td>Sin Registro en el catalogo</td>
                @else
                    <td>{{ $materiale->cantidad_m }}</td>
                    <td>{{ $materiale->existencia_material  }}</td>
                @endif

                @if ($materiale->restante  < 0)
                    <td style="color: red">{{'Faltan '.$materiale->restante}}</td>
                @endif
                @if ($materiale->restante > 0)
                    <td style="color: blue">{{'Sobran '.$materiale->restante }}</td>
                @endif
                @if ($materiale->restante  == 0)
                    <td>{{$materiale->restante }}</td>
                @endif
            </tr>
        @empty
        @endforelse


        @php
            $sumas = $sumas + $datos->saldo;
            $sumap = $sumap + $datos->pendiente;
        @endphp

        @endforeach
    </tbody>
</table>
