<tr>
    <td colspan="12" style='text-align: center; font-family: Edwardian Script ITC; font-size: 17'><i><b><u>Informe De
                    Produccion Diaria 2023</u></b></i></td>
</tr>
<tr></tr>
<tr></tr>
<table>
    <thead>
        <tr>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">#</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Medida</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;width:100px;"
                rowspan="3">Nombres</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;" rowspan="3">Marcas
            </th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;" rowspan="3">Capas
            </th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;" rowspan="3">
                Prioridad</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Pendiente</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;" rowspan="3">
                Requerido</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;" rowspan="3">
                Acumulado</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Pendiente</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Produccion</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;" rowspan="3">
                Acumulado mes</th>
        </tr>
        <tr>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Orden</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">De</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">De</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">De</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Del</th>
        </tr>
        <tr>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Sistema</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Vitola</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Prioridad</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Producir</th>
            <th style="text-align:center;font-size:12px;border: 1px solid #C00;font-weight: bold;">Mes</th>
        </tr>
    </thead>
    <tbody name="body" id="body">
        @php
            $empresa_marca = '';
            $pendiente_s = 0;
            $acumulado_neto = 0;
            $restante_total_almes = 0;
            $acumulado_del_mes = 0;
            $acumulado_neto_mes = 0;

            $pendiente_stotales = 0;
            $acumulado_netototales = 0;
            $restante_total_almestotales = 0;
            $acumulado_del_mestotales = 0;
            $acumulado_neto_mestotales = 0;

            $pendiente_stripa_larga = 0;
            $acumulado_netotripa_larga = 0;
            $restante_total_almestripa_larga = 0;
            $acumulado_del_mestripa_larga = 0;
            $acumulado_neto_mestripa_larga = 0;

            $pendiente_stripa_corta = 0;
            $acumulado_netotripa_corta = 0;
            $restante_total_almestripa_corta = 0;
            $acumulado_del_mestripa_corta = 0;
            $acumulado_neto_mestripa_corta = 0;

            $pendiente_stripa_larga_muestras = 0;
            $acumulado_netotripa_larga_muestras = 0;
            $restante_total_almestripa_larga_muestras = 0;
            $acumulado_del_mestripa_larga_muestras = 0;
            $acumulado_neto_mestripa_larga_muestras = 0;

            $pendiente_stripa_corta_muestras = 0;
            $acumulado_netotripa_corta_muestras = 0;
            $restante_total_almestripa_corta_muestras = 0;
            $acumulado_del_mestripa_corta_muestras = 0;
            $acumulado_neto_mestripa_corta_muestras = 0;

            $pendiente_stripa_larga_otras_empresas = 0;
            $acumulado_netotripa_larga_otras_empresas = 0;
            $restante_total_almestripa_larga_otras_empresas = 0;
            $acumulado_del_mestripa_larga_otras_empresas = 0;
            $acumulado_neto_mestripa_larga_otras_empresas = 0;

            $pendiente_stripa_corta_otras_empresas = 0;
            $acumulado_netotripa_corta_otras_empresas = 0;
            $restante_total_almestripa_corta_otras_empresas = 0;
            $acumulado_del_mestripa_corta_otras_empresas = 0;
            $acumulado_neto_mestripa_corta_otras_empresas = 0;

            $pendiente_sbrocha = 0;
            $acumulado_netobrocha = 0;
            $restante_total_almesbrocha = 0;
            $acumulado_del_mesbrocha = 0;
            $acumulado_neto_mesbrocha = 0;
        @endphp
        @foreach ($pendiente as $key => $pend)
            @if ($empresa_marca == $pend->empresa . ' "' . $pend->marca . '"')
            @else
                @if ($empresa_marca == '')
                @else
                    <tr>
                        <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
                        <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
                        <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
                        <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
                        <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
                        <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
                        <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
                        <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">
                            <b>{{ $pendiente_s }}</b></td>
                        <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">
                            <b>{{ $acumulado_neto }}</b></td>
                        <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">
                            <b>{{ $restante_total_almes }}</b></td>
                        <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">
                            <b>{{ $acumulado_del_mes }}</b></td>
                        <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">
                            <b>{{ $acumulado_neto_mes }}</b></td>
                    </tr>
                @endif

                @php
                    $pendiente_s = 0;
                    $acumulado_neto = 0;
                    $restante_total_almes = 0;
                    $acumulado_del_mes = 0;
                    $acumulado_neto_mes = 0;
                @endphp
                @php
                    $empresa_marca = $pend->empresa . ' "' . $pend->marca . '"';
                @endphp
                <tr>
                    <td></td>
                    <td style="color: red"><b>{{ $pend->empresa . ' ' }}</b></td>
                    <td colspan="2" style="color: blue"><b>"{{ $pend->marca }}"</b></td>
                    <td colspan="8"></td>
                </tr>
            @endif
            <tr>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pend->orden_sistema }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pend->vitola }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pend->nombre }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pend->marca }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pend->capa }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pend->pendiente }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pend->acumulado_neto }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pend->restante_total_almes }}
                </td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">{{ $pend->acumulado_del_mes }}</td>
                <td style="text-align:center;font-size:8px;border: 1px solid #C00;">
                    {{ $pend->acumulado_neto - $pend->acumulado_del_mes }}</td>
            </tr>
            @php
                $pendiente_s += $pend->pendiente;
                $acumulado_neto += $pend->acumulado_neto;
                $restante_total_almes += $pend->restante_total_almes;
                $acumulado_del_mes += $pend->acumulado_del_mes;
                $acumulado_neto_mes += $pend->acumulado_neto - $pend->acumulado_del_mes;

                if($pend->tipo == 'Larga' && $pend->empresa == 'Rocky Patel Premium Cigar' && stristr($pend->marca, 'Muestra') == false){
                    $pendiente_stripa_larga += $pend->pendiente;
                    $acumulado_netotripa_larga += $pend->acumulado_neto;
                    $restante_total_almestripa_larga += $pend->restante_total_almes;
                    $acumulado_del_mestripa_larga += $pend->acumulado_del_mes;
                    $acumulado_neto_mestripa_larga += $pend->acumulado_neto - $pend->acumulado_del_mes;
                }

                if($pend->tipo == 'Corta' && $pend->empresa == 'Rocky Patel Premium Cigar' && stristr($pend->marca, 'Muestra') == false){
                    $pendiente_stripa_corta += $pend->pendiente;
                    $acumulado_netotripa_corta += $pend->acumulado_neto;
                    $restante_total_almestripa_corta += $pend->restante_total_almes;
                    $acumulado_del_mestripa_corta += $pend->acumulado_del_mes;
                    $acumulado_neto_mestripa_corta += $pend->acumulado_neto - $pend->acumulado_del_mes;
                }

                if($pend->tipo == 'Larga' && $pend->empresa == 'Rocky Patel Premium Cigar' && stristr($pend->marca, 'Muestra') !== false){
                    $pendiente_stripa_larga_muestras += $pend->pendiente;
                    $acumulado_netotripa_larga_muestras += $pend->acumulado_neto;
                    $restante_total_almestripa_larga_muestras += $pend->restante_total_almes;
                    $acumulado_del_mestripa_larga_muestras += $pend->acumulado_del_mes;
                    $acumulado_neto_mestripa_larga_muestras += $pend->acumulado_neto - $pend->acumulado_del_mes;
                }

                if($pend->tipo == 'Corta' && $pend->empresa == 'Rocky Patel Premium Cigar' && stristr($pend->marca, 'Muestra') !== false){
                    $pendiente_stripa_corta_muestras += $pend->pendiente;
                    $acumulado_netotripa_corta_muestras += $pend->acumulado_neto;
                    $restante_total_almestripa_corta_muestras += $pend->restante_total_almes;
                    $acumulado_del_mestripa_corta_muestras += $pend->acumulado_del_mes;
                    $acumulado_neto_mestripa_corta_muestras += $pend->acumulado_neto - $pend->acumulado_del_mes;
                }


                if($pend->tipo == 'Larga' && $pend->empresa != 'Rocky Patel Premium Cigar'){
                    $pendiente_stripa_larga_otras_empresas += $pend->pendiente;
                    $acumulado_netotripa_larga_otras_empresas += $pend->acumulado_neto;
                    $restante_total_almestripa_larga_otras_empresas += $pend->restante_total_almes;
                    $acumulado_del_mestripa_larga_otras_empresas += $pend->acumulado_del_mes;
                    $acumulado_neto_mestripa_larga_otras_empresas += $pend->acumulado_neto - $pend->acumulado_del_mes;
                }

                if($pend->tipo == 'Corta' && $pend->empresa != 'Rocky Patel Premium Cigar'){
                    $pendiente_stripa_corta_otras_empresas += $pend->pendiente;
                    $acumulado_netotripa_corta_otras_empresas += $pend->acumulado_neto;
                    $restante_total_almestripa_corta_otras_empresas += $pend->restante_total_almes;
                    $acumulado_del_mestripa_corta_otras_empresas += $pend->acumulado_del_mes;
                    $acumulado_neto_mestripa_corta_otras_empresas += $pend->acumulado_neto - $pend->acumulado_del_mes;

                }

                if($pend->tipo == 'Brocha'){
                    $pendiente_sbrocha += $pend->pendiente;
                    $acumulado_netobrocha += $pend->acumulado_neto;
                    $restante_total_almesbrocha += $pend->restante_total_almes;
                    $acumulado_del_mesbrocha += $pend->acumulado_del_mes;
                    $acumulado_neto_mesbrocha += $pend->acumulado_neto - $pend->acumulado_del_mes;
                }

                $pendiente_stotales += $pend->pendiente;
                $acumulado_netototales += $pend->acumulado_neto;
                $restante_total_almestotales += $pend->restante_total_almes;
                $acumulado_del_mestotales += $pend->acumulado_del_mes;
                $acumulado_neto_mestotales += $pend->acumulado_neto - $pend->acumulado_del_mes;
            @endphp
            @if ($key + 1 == count($pendiente))
                <tr>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">
                        <b>{{ $pendiente_s }}</b></td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">
                        <b>{{ $acumulado_neto }}</b></td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">
                        <b>{{ $restante_total_almes }}</b></td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">
                        <b>{{ $acumulado_del_mes }}</b></td>
                    <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">
                        <b>{{ $acumulado_neto_mes }}</b></td>
                </tr>
            @endif
        @endforeach
        <tr></tr>
        <tr></tr>
        <tr>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td colspan="2" style="font-size:8px;border: 1px solid #C00;">Total Rehechos</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red"></td>
        </tr>
        <tr>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td colspan="2" style="font-size:8px;border: 1px solid #C00;">Agrego de Capa</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red"></td>
        </tr>
        <tr>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td colspan="2" style="font-size:8px;border: 1px solid #C00;">Long Filler Rocky Patel Premiun</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $pendiente_stripa_larga }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_netotripa_larga }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $restante_total_almestripa_larga }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_del_mestripa_larga }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_neto_mestripa_larga }}</td>
        </tr>
        <tr>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td colspan="2" style="font-size:8px;border: 1px solid #C00;">Long Filler Muestras Rocky Patel Premiun</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $pendiente_stripa_larga_muestras }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_netotripa_larga_muestras }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $restante_total_almestripa_larga_muestras }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_del_mestripa_larga_muestras }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_neto_mestripa_larga_muestras }}</td>
        </tr>
        <tr>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td colspan="2" style="font-size:8px;border: 1px solid #C00;">Long Filler Otros Clientes</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $pendiente_stripa_larga_otras_empresas }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_netotripa_larga_otras_empresas }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $restante_total_almestripa_larga_otras_empresas }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_del_mestripa_larga_otras_empresas }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_neto_mestripa_larga_otras_empresas }}</td>
        </tr>
        <tr>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td colspan="2" style="font-size:8px;border: 1px solid #C00;">Short Filler Rocky Patel Premiun</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $pendiente_stripa_corta }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_netotripa_corta }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $restante_total_almestripa_corta }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_del_mestripa_corta }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_neto_mestripa_corta }}</td>
        </tr>
        <tr>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td colspan="2" style="font-size:8px;border: 1px solid #C00;">Short Filler Muestras Rocky Patel Premiun</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $pendiente_stripa_corta_muestras }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_netotripa_corta_muestras  }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $restante_total_almestripa_corta_muestras  }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_del_mestripa_corta_muestras  }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_neto_mestripa_corta_muestras  }}</td>
        </tr>
        <tr>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td colspan="2" style="font-size:8px;border: 1px solid #C00;">Short Filler Otros Clientes</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $pendiente_stripa_corta_otras_empresas }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_netotripa_corta_otras_empresas }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $restante_total_almestripa_corta_otras_empresas }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_del_mestripa_corta_otras_empresas }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_neto_mestripa_corta_otras_empresas }}</td>
        </tr>
        <tr>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td colspan="2" style="font-size:8px;border: 1px solid #C00;">Short Filler Brocha</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $pendiente_sbrocha }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_netobrocha }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $restante_total_almesbrocha }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_del_mesbrocha }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_neto_mesbrocha }}</td>
        </tr>
        <tr>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td colspan="2" style="font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;"></td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00;">0</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $pendiente_stotales }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_netototales }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $restante_total_almestotales }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_del_mestotales }}</td>
            <td style="text-align:center;font-size:8px;border: 1px solid #C00; color: red">{{ $acumulado_neto_mestotales }}</td>
        </tr>
    </tbody>
</table>
