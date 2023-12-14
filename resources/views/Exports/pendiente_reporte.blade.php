<table class="table table-light table-hover" style="font-size:10px;">
    <thead>
        <tr>
            <th>ITEM</th>
            <th>MARCA</th>
            <th>NOMBRE</th>
            <th>CAPA</th>
            <th>VITOLA</th>
            <th>EMPAQUE</th>
            <th>ENVIADAS (CAJAS)</th>
            <th>ENVIADAS (TABACO)</th>
            <th>PRECIO ($)</th>
            <th>ORDEN</th>
            <th>ORDEN (SISTEMA)</th>
            <th>FACTURA</th>
            <th>CONTENEDOR</th>
            <th>FECHA</th>
        </tr>
    </thead>
    <tbody>

        @foreach($productos as $producto)
        <tr>
            <td>{{$producto->codigo_item}}</td>
            <td>{{$producto->marca}}</td>
            <td>{{$producto->nombre}}</td>
            <td>{{$producto->capas}}</td>
            <td>{{$producto->vitola}}</td>
            <td>{{$producto->tipo_empaque}}</td>
            <td style="text-align: center">{{$producto->cantidad_cajas}}</td>
            <td style="text-align: center">{{(int)$producto->total_tabacos}}</td>
            <td style="text-align: end">{{$producto->total_precio_tabacos}}</td>
            <td>{{$producto->orden}}</td>
            <td style="text-align: center">{{$producto->orden_sistema}}</td>
            <td>{{$producto->num_factura}}</td>
            <td>{{$producto->contenedor}}</td>
            <td>{{$producto->fecha}}</td>
        </tr>

        @endforeach

    </tbody>
</table>
