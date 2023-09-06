<table>
    <thead>
        <tr>
            <th colspan="7" style="text-align:center;"><b>NOTA DE REMISION</b></th>
            <th colspan="1" style="text-align:center;"><b>N 00000</b></th>
        </tr>
        <tr>
        <th colspan="1" style="text-align:center;"><b>LUGAR Y FECHA </b></th>
        <th colspan="2" style="text-align:center;"><b>{{$fecha}} </b></th>
        </tr>
        <tr>
        <th colspan="1" style="text-align:center;"><b>DE:</b></th>
        <th colspan="2" style="text-align:center;"><b>PROCESO</b></th>
        </tr>
        <tr>
        <th colspan="1" style="text-align:center;"><b>PARA:</b></th>
        <th colspan="2" style="text-align:center;"><b>PRODUCTO TERMINADO(EMBARQUE)</b></th>
        </tr>
        <tr>

        </tr>
    <tr style="font-weight: bold;">
        <th><b>ORDEN</b></th>
        <th><b>CODIGO PRODUCTO</b></th>
        <th><b>CANTIDAD</b></th>
        <th style="text-align:center;"><b>MARCA</b></th>
        <th><b>VITOLA</b></th>
        <th><b>NOMBRE</b></th>
        <th><b>CAPA</b></th>
        <th><b>TIPO DE EMPAQUE</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($dato as $datos)
    @if($datos->sampler=='si')
    @php
    $sampler = DB::select('select vitola, marca, codigo_producto, nombre, capa, tipo_empaque from detalle_clase_productos
    inner join vitola_productos on vitola_productos.id_vitola = detalle_clase_productos.id_vitola
    inner join marca_productos on marca_productos.id_marca = detalle_clase_productos.id_marca
    inner join nombre_productos on nombre_productos.id_nombre = detalle_clase_productos.id_nombre
    inner join capa_productos on capa_productos.id_capa = detalle_clase_productos.id_capa
    inner join tipo_empaques on tipo_empaques.id_tipo_empaque = detalle_clase_productos.id_tipo_empaque
    where item= ?', [$datos->item]);
    $cantSample = DB::select('select count(*) as cant from detalle_clase_productos where item= ?', [$datos->item]);
    @endphp
    @foreach($sampler as $s)
        <tr>
            <td>{{ $datos->numero_orden}}</td>
            <td>{{ $s->codigo_producto }}</td>
            <td>{{ $datos->cantidad/$cantSample[0]->cant }}</td>
            <td>{{ $datos->marca.' '.$s->marca}}</td>
            <td>{{ $s->vitola }}</td>
            <td>{{ $s->nombre }}</td>
            <td>{{ $s->capa }}</td>
            <td>{{ $s->tipo_empaque }}</td>
        </tr>
        @endforeach
        @else
        <tr>
            <td>{{ $datos->numero_orden}}</td>
            <td>{{ $datos->codigo_producto }}</td>
            <td>{{ $datos->cantidad }}</td>
            <td>{{  $datos->marca}}</td>
            <td>{{ $datos->vitola }}</td>
            <td>{{ $datos->nombres }}</td>
            <td>{{ $datos->capa }}</td>
            <td>{{ $datos->tipoempaque }}</td>
        </tr>

        @endif

    @endforeach
    <tr>
    <td colspan="2"><b>TOTAL</b></td>
    <td><b>{{ $total }}</b></td>
    </tr>

    <tr></tr>
    <tr></tr>
    <tr>
        <td style="text-align:center;" colspan="3">________________________</td>
        <td style="text-align:center;" colspan="3"></td>
        <td style="text-align:center;" colspan="2">________________________</td>
        
    </tr>
    <tr>
        <td style="text-align:center;" colspan="3">Enviado por</td>
        <td style="text-align:center;" colspan="3"></td>
        <td style="text-align:center;" colspan="2">Recibido por</td>
        
    </tr>

    </tbody>
</table>