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
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $material->cantidad_m }}</td>
        </tr>
        <?php
            $saldo += $material->cantidad_m;
        ?>
        @endforeach
        <tr>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="font-size:12px;border: 1px solid #C00;">Total:</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $saldo }}</td>
        </tr>
    </tbody>
</table>
