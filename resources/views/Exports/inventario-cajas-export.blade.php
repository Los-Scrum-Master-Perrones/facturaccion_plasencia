<table class="table table-light table-hover" style="font-size:10px; ">
    <thead>
        <tr style="font-size:16px; text-align:center;">
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">N#</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">Código</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">Marca</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">Producto</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">Mal Estado</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">Faltante</th>
            <th  style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">Saldo</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">Saldo Neto</th>
        </tr>
    </thead>
    <tbody>
        @php
            $count = 1;
            $saldo = 0;
            $saldoNeto = 0;
            $saldoFaltante = 0;
            $saldoMalos = 0;
        @endphp

        @foreach ($listacajas as $material)
            <tr>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $count }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $material->codigo }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $material->marca }}</td>
                <td style="font-size:12px;border: 1px solid #C00;">{{ $material->productoServicio }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ number_format($material->mal_estado,0,'.','') }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ number_format($material->faltantes,0,'.','') }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ number_format($material->existencia,0,'.','') }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">
                    {{ number_format($material->mal_estado + $material->faltantes + $material->existencia, 0,'.','') }}</td>
            </tr>
            <?php
                $count++;
                $saldo += $material->existencia;
                $saldoNeto += $material->mal_estado + $material->faltantes + $material->existencia;
                $saldoFaltante += $material->faltantes;
                $saldoMalos += $material->mal_estado;
            ?>
        @endforeach
    </tbody>
</table>
