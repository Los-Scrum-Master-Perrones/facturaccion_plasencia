<table class="table table-light" style="font-size:10px; ">
    <thead>
        <tr style="font-size:16px; text-align:center;">
            <th style=" text-align:center;">
                Factory Item
            </th>
            <th style=" text-align:center;">
                Navision Item
            </th>
            <th style=" text-align:center;">
                Codigo Material
            </th>
            <th >
                Descripción
            </th>
            <th >
                Brand
            </th>
            <th>Linea</th>
            <th style=" text-align:center;">Saldo Minimo</th>
            <th style=" text-align:center;">Saldo</th>
        </tr>
    </thead>
    <tbody>
        @php
        $count = 1;
        $saldo = 0;
        @endphp

        @foreach($materiales as $material)
        <tr>
            <td style=" text-align:center;">{{ $material->factory_item }}</td>
            <td style=" text-align:center;">{{ $material->navision_item }}</td>
            <td style=" text-align:center;">{{ $material->codigo_material }}</td>
            <td>{{ $material->item_description }}</td>
            <td>{{ $material->brand }}</td>
            <td>{{ $material->linea }}</td>
            <td style=" text-align:center;">{{ $material->saldo_minimo }}</td>
            <td style=" text-align:center;">{{ $material->saldo }}</td>
        </tr>
        <?php
            $count++;
            $saldo += $material->saldo;
        ?>
        @endforeach
    </tbody>
</table>
