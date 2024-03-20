<table>
    <thead>
        <tr>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">ID</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">Fecha de proceso</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">Numero de remisión</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">Entradas y Salidas</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">Nombre Tabaco</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">Sub Total</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">Total libras</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">Total general</th>

        </tr>
    </thead>
    <tbody>
        @forelse($proPilones as $key=> $procP)
            <tr>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ ++$key }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;"> {{ $procP->fecha_proceso }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $procP->id_remision }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $procP->entradas_salidas }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $procP->nombre_tabaco }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;"> {{ $procP->subtotal }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $procP->total_libras }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $procP->total_remision }}</td>

            </tr>
        @empty
        @endforelse
    </tbody>
</table>
