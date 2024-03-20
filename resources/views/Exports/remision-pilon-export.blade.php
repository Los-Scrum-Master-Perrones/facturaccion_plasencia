<table>
    <thead>
        <tr>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">ID</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">Código</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">Fecha</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">Destino</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">Origen </th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">Descripción</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">Total (Lbs.)</th>
        </tr>
    </thead>
    <tbody>
        @forelse($remisionP as $key=> $remP)
            <tr>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ ++$key }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;"> {{ $remP->id_remision }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $remP->fecha_remision }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $remP->destino_remision }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $remP->origen_remision }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">
                    {{ $remP->descripcion1_remision }}
                    @if ($remP->descripcion2_remision == '')
                    @else
                        <br>
                        {{ $remP->descripcion2_remision }}
                    @endif

                    @if ($remP->descripcion3_remision == '')
                    @else
                        <br>
                        {{ $remP->descripcion3_remision }}
                    @endif

                    @if ($remP->descripcion4_remision == '')
                    @else
                        <br>
                        {{ $remP->descripcion4_remision }}
                    @endif

                    @if ($remP->descripcion5_remision == '')
                    @else
                        <br>
                        {{ $remP->descripcion5_remision }}
                    @endif
                </td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">
                    {{ $remP->cant_lbs_des_1 }}
                    @if ($remP->cant_lbs_des_2 == '')
                    @else
                        <br>
                        {{ $remP->cant_lbs_des_2 }}
                    @endif

                    @if ($remP->cant_lbs_des_3 == '')
                    @else
                        <br>
                        {{ $remP->cant_lbs_des_3 }}
                    @endif

                    @if ($remP->cant_lbs_des_4 == '')
                    @else
                        <br>
                        {{ $remP->cant_lbs_des_4 }}
                    @endif

                    @if ($remP->cant_lbs_des_5 == '')
                    @else
                        <br>
                        {{ $remP->cant_lbs_des_5 }}
                    @endif

                </td>
            </tr>
        @empty
        @endforelse
    </tbody>
</table>
