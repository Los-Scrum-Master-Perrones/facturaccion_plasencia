<tr>
    <th colspan="6" style="font-size: 18px">Tabacos De Oriente Paraiso</th>
</tr>
<tr>
    <th colspan="6" style="font-size: 18px">Inventario De Moldes</th>
</tr>
<tr>
    <th style="font-size: 8px">{{ 'FECHA '.Carbon\Carbon::now()->format('d/m/Y') }}</th>
    <th colspan="5" style="font-size: 18px"></th>
</tr>
<table class="table table-light table-hover" style="font-size:10px;">
    <thead>
        <tr>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">VITOLA</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">RING</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">FIGURA Y TIPO</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">MATERIAL</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">BUENOS</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">SALON</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">TOTAL</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total_buenos = 0;
            $total_buenos2 = 0;
            $total_salon = 0;
        @endphp
        @foreach ($moldes as $molde)
        @php
            $total_buenos += $molde->buenos;
            $total_buenos2 += $molde->buenos2;
            $total_salon += ($molde->buenos2 - $molde->buenos);
        @endphp
            <tr>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $molde->vitola }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $molde->ring }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $molde->figuraTipo }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $molde->material }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $molde->buenos }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $molde->buenos2 - $molde->buenos }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $molde->buenos2 }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $total_salon }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $total_buenos }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $total_buenos2 }}</td>
        </tr>
    </tfoot>
</table>
