<tr></tr>
<tr></tr>
<table class="table table-light table-hover" style="font-size:10px;">
    <thead>
        <tr>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">ITEM</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">PRSENTACION</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">MARCA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">NOMBRE</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"h>CAPA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">VITOLA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">EMPAQUE</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">ENVIADAS (CAJAS)</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">ENVIADAS (TABACO)</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">PRECIO ($)</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">ORDEN</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">ORDEN (SISTEMA)</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">FACTURA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">CONTENEDOR</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">FECHA</th>
        </tr>
    </thead>
    <tbody>

        @foreach($productos as $producto)
        <tr>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{$producto->codigo_item}}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{$producto->presentacion}}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{$producto->marca}}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{$producto->nombre}}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{$producto->capas}}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{$producto->vitola}}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{$producto->tipo_empaque}}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;text-align: center">{{$producto->cantidad_cajas}}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;text-align: center">{{(int)$producto->total_tabacos}}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;text-align: end">{{$producto->total_precio_tabacos}}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{$producto->orden}}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;text-align: center">{{$producto->orden_sistema}}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{$producto->num_factura}}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{$producto->contenedor}}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{$producto->fecha}}</td>
        </tr>

        @endforeach

    </tbody>
</table>
