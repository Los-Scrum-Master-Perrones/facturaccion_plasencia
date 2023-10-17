<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Medida</th>
            <th rowspan="3">Nombres</th>
            <th rowspan="3" style="width:100px;">Marcas</th>
            <th rowspan="3">Capas</th>
            <th rowspan="3">Prioridad</th>
            <th>Pendiente</th>
            <th rowspan="3">Requerido</th>
            <th rowspan="3">Acumulado</th>
            <th>Produccion</th>
            <th>Acumulado mes</th>
        </tr>
        <tr>
            <th>Orden</th>
            <th>De</th>
            <th>De</th>
            <th>De</th>
            <th>Del</th>
        </tr>
        <tr>
            <th>Sistema</th>
            <th>Vitola</th>
            <th>Prioridad</th>
            <th>Producir</th>
            <th>Mes</th>
        </tr>
    </thead>
    <tbody name="body" id="body">
        @foreach ($pendiente as $pend)
            <tr>
                <td>{{ $pend->orden_sistema }}</td>
                <td>{{ $pend->vitola }}</td>
                <td>{{ $pend->nombre }}</td>
                <td>{{ $pend->marca }}</td>
                <td>{{ $pend->capa }}</td>
                <td>{{ $pend->empresa }}</td>
                <td>{{ $pend->empresa }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
