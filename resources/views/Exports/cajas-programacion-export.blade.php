<table style="font-size:10px; ">
    <thead>
        <tr style="font-size:16px; text-align:center;">
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;">
                Codigo Material
            </th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;">
                Descripción
            </th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;">
                Cajas
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
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $material->codigo_caja }}</td>
            <td style="font-size:12px;border: 1px solid #C00;">{{ $material->productoServicio }}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $material->Cajas_Necesarias }}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $material->existencia }}</td>
            @if( ($material->existencia - $material->Cajas_Necesarias) > 0)
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ 'Sobran '.abs(($material->existencia - $material->Cajas_Necesarias)) }}</td>
            @elseif (($material->existencia - $material->Cajas_Necesarias) < 0)
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ 'Faltan '.abs(($material->existencia - $material->Cajas_Necesarias)) }}</td>
            @else
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">0</td>
            @endif

        </tr>
        <?php
            $saldo += $material->Cajas_Necesarias;
        ?>
        @endforeach
        <tr>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>

            <td style="font-size:12px;border: 1px solid #C00;">Total:</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $saldo }}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
        </tr>
    </tbody>
</table>
