<table style="font-size:10px; ">
    <thead>
        <tr style="font-size:16px; text-align:center;">
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;">
                Factory Item
            </th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;">
                Codigo Material
            </th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;">
                Descripción
            </th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;">
                Cantidad
            </th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;">
                Existencia
            </th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;">
                Sobra/Falta
            </th>
        </tr>
    </thead>
    <tbody>
        @php
            $saldo = 0;
        @endphp

        @foreach($materiales as $material)
        <tr>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $material->factory_item }}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $material->codigo_material }}</td>
            <td style="font-size:12px;border: 1px solid #C00;">{{ $material->des_material }}</td>
            @if($material->factory_item == 'No Catalogo')
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">0</td>
            @else
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ ($material->cantidad_m) }}</td>

            @endif
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ ($material->saldo) }}</td>
            @if(($material->cantidad_m - $material->saldo) > 0)
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;color: red;">{{ 'Faltan '.number_format(abs($material->cantidad_m - $material->saldo)) }}</td>
            @else
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ number_format(abs($material->cantidad_m - $material->saldo)) }}</td>
            @endif

        </tr>
        @if($material->factory_item == 'No Catalogo')
            <?php
                $saldo += 0;
            ?>
        @else
            <?php

                $saldo += $material->cantidad_m;
            ?>
        @endif


        @endforeach
        <tr>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="font-size:12px;border: 1px solid #C00;">Total:</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $saldo }}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
        </tr>
    </tbody>
</table>
