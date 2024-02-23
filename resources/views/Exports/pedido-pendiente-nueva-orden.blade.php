<table class="table table-light table-hover" style="font-size:10px;">
    <thead>
        <tr style="font-size:16px; text-align:center;">
            <th style="text-align:center;">N#</th>
            <th style="text-align:center;">Categoria</th>
            <th style="text-align:center;">RP Item#</th>
            <th style="text-align:center;">Paquetes</th>
            <th style="text-align:center;">Codigo Producto</th>
            <th style="text-align:center;">Item Description</th>
            <th style="text-align:center;">Sticks</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pedido_completo as $key => $pedido)

            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $pedido[0]->categorias }}</td>
                <td>{{ $pedido[0]->item }}</td>
                <td>{{ $pedido[0]->cant_paquetes }}</td>
                <td>{{ $pedido[0]->codigo_p }}</td>
                <td>{{ $pedido[0]->descripcion }}</td>
                @if (is_numeric($pedido[0]->unidades) && is_numeric($pedido[0]->cant_paquetes))
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($pedido as $value)
                        @php
                            $total += $value->unidades * $value->cant_paquetes;
                        @endphp
                    @endforeach

                    <td>{{ $total  }}</td>
                @else
                    <td>{{ 0 }}</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
