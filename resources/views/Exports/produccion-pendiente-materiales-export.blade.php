<tr></tr>
<tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th style="width:100px; font-size: 16px; font-weight: bold">Pendiente por Producir {{ Carbon\Carbon::now()->format('Y-m-d') }}</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
</tr>
<tr></tr>
<tr></tr>
<table class="table table-light" style="font-size:9px;" id="tabla_pendiente">
    <thead>
        <tr>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">N#</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">EMPRESA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">CODIGO</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold"># ORDEN</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">FECHA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">PRESENTACION</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">MES</th>
            <th style="width:200px;text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">MARCA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">NOMBRE</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">VITOLA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">CAPA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">COLOR</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">PENDIENTE</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">RESTANTE</th>

            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">MATERIAL</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">NORMA</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">TIPO</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">CANTIDAD (ONZ)</th>
            <th style="text-align:center;font-size:16px;border: 1px solid #C00; font-weight: bold">CANTIDAD (LBS)</th>
        </tr>
    </thead>
    <tbody name="body" id="body">
        @php
            $sumaPendiente = 0;
            $sumaRestantes = 0;
            $sumaProducido = 0;
            $sumaPriodiad = 0;
            $sumaPriodiadRestantes = 0;

            $sumaOnza = 0;
            $sumaLibras = 0;

            $sumaprecio_dolar = 0;
            $moldes_nesarios_base10 = 0;
            $moldes_exitentea = 0;
            $moldes_sin_molde = 0;


            $capa = 0;
            $banda= 0;
            $tripa = 0;
            $picadura = 0;
        @endphp
        @foreach ($pendiente as $i => $detalle)
            @if(isset($usosMateriales[$detalle->id_producto]))
                @foreach ($usosMateriales[$detalle->id_producto] as $materiales)
                <tr>
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ ++$i }}</td>
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->empresa }}</td>
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->codigo }}</td>
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->orden_sistema }}</td>
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->fecha_recibido }}</td>
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->presentacion }}</td>
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->mes }}</td>
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;width:200px">{{ $detalle->marca }}</td>
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->nombre }}</td>
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->vitola }}</td>
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->capa }}</td>
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->color }}</td>
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;text-align:right;">{{ $detalle->pendiente }}</td>
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;text-align:right;">{{ $detalle->restantes }}</td>

                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $materiales->nombre_material }}</td>
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $materiales->onza }}</td>
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $materiales->banda }}</td>
                    @php
                        $arr = explode(' ',trim($materiales->onza));
                    @endphp
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{  number_format((intval($arr[0])/100)*$detalle->restantes,2,',','') }}</td>
                    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{  number_format(((intval($arr[0])/100)*$detalle->restantes)/16,4,',','') }}</td>
                </tr>
                @php
                    $sumaOnza += (intval($arr[0])/100)*$detalle->restantes;
                    $sumaLibras += ((intval($arr[0])/100)*$detalle->restantes)/16;


                    if($materiales->banda == 'CAPA'){
                        $capa += (intval($arr[0])/100)*$detalle->restantes;
                    }
                    if($materiales->banda == 'BANDA'){
                        $banda += (intval($arr[0])/100)*$detalle->restantes;
                    }
                    if($materiales->banda == 'TRIPA'){
                        $tripa += (intval($arr[0])/100)*$detalle->restantes;
                    }

                    if($materiales->banda == 'PICADURA'){
                        $picadura += (intval($arr[0])/100)*$detalle->restantes;
                    }
                @endphp
                @endforeach
            @else
            <tr>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ ++$i }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->empresa }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->codigo }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->orden_sistema }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->fecha_recibido }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->presentacion }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->mes }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;width:200px">{{ $detalle->marca }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->nombre }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->vitola }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->capa }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $detalle->color }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;text-align:right;">{{ $detalle->pendiente }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;text-align:right;">{{ $detalle->restantes }}</td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
                <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            </tr>
            @endif


            @php
                $sumaPendiente += $detalle->pendiente;
                $sumaRestantes += $detalle->restantes;
                $sumaProducido += $detalle->pendiente - $detalle->restantes;
                $sumaPriodiad += $detalle->prioridad;
                $sumaPriodiadRestantes = $detalle->pendiente_prioridad;
            @endphp
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;width:200px"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;text-align:right;">{{ $sumaPendiente }}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;text-align:right;">{{ $sumaRestantes }}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ number_format($sumaOnza,2,',','') }}</td>
            <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ number_format($sumaLibras,2,',','') }}</td>
        </tr>
    </tfoot>
</table>
<tr></tr>
<tr></tr>
<tr>
    <td style="text-align:center;font-size:12px;border: 1px solid #C00;"></td>
    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">ONZ</td>
    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">LBS</td>
</tr>
<tr>
    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">CAPA</td>
    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $capa }}</td>
    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">CAPA</td>
</tr>
<tr>
    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">BANDA</td>
    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $banda }}</td>
    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">CAPA</td>
</tr>
<tr>
    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">TRIPA</td>
    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $tripa }}</td>
    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">CAPA</td>
</tr>
<tr>
    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">PICADURA</td>
    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">{{ $picadura }}</td>
    <td style="text-align:center;font-size:12px;border: 1px solid #C00;">CAPA</td>
</tr>
