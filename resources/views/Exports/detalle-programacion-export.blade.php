<table  id="editable" style="font-size:10px;">
                    <thead>
                        <tr style="text-align:center;">
                            <th># ORDEN</th>
                            <th style=" text-align:center;">ORDEN</th>
                            <th style=" text-align:center;">CODIGO</th>
                            <th style=" text-align:center;">MARCA</th>
                            <th style=" text-align:center;">VITOLA</th>
                            <th style=" text-align:center;">NOMBRE</th>
                            <th style=" text-align:center;">CAPA</th>
                            <th style=" text-align:center;">TIPO EMPAQUE</th>
                            <th style=" text-align:center;">ANILLO</th>
                            <th style=" text-align:center;">CELLO</th>
                            <th style=" text-align:center;">UPC</th>
                            <th style=" text-align:center;">SALDO</th>
                            <th style=" text-align:center;">SOLICITAR(CAJAS)</th>
                            <th style=" text-align:center;">CAJAS NECESARIAS</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $codigo_anterioir = '';
                            $existencia_actual = 0;
                        @endphp
                        @foreach($detalles_provicionales as $detalle_provicional)
                        <tr>
                            <td>{{$detalle_provicional->numero_orden}}</td>
                            <td>{{$detalle_provicional->orden}}</td>
                            <td>{{$detalle_provicional->cod_producto}}</td>
                            <td>{{$detalle_provicional->marca}}</td>
                            <td>{{$detalle_provicional->vitola}}</td>
                            <td>{{$detalle_provicional->nombre}}</td>
                            <td>{{$detalle_provicional->capa}}</td>
                            <td>{{$detalle_provicional->tipo_empaque}}</td>
                            <td>{{$detalle_provicional->anillo}}</td>
                            <td>{{$detalle_provicional->cello}}</td>
                            <td>{{$detalle_provicional->upc}}</td>
                            <td>{{$detalle_provicional->saldo}}</td>

                            @php
                            $pendiente_restante = 0;
                            $codigo_cajas = $detalle_provicional->codigo_caja;


                            if($codigo_cajas != $codigo_anterioir && $detalle_provicional->codigo_caja != ''){
                                $codigo_anterioir = $codigo_cajas;
                                 $existencia_actual = isset(DB::select('SELECT * FROM lista_cajas WHERE codigo = ?', [$codigo_anterioir])[0]->existencia)?
								DB::select('SELECT * FROM lista_cajas WHERE codigo = ?', [$codigo_anterioir])[0]->existencia : 0;
                            }

                            @endphp

                        @php
                            $existencia_actual = $existencia_actual - $detalle_provicional->cant_cajas;
                        @endphp
                            @if ($existencia_actual < 0)
                                <td style="color: red">{{'Faltan '.$existencia_actual}}</td>
                            @endif
                            @if ($existencia_actual > 0)
                                <td style="color: rgb(119, 0, 255)">{{'Sobran '.$existencia_actual}}</td>
                            @endif
                            @if ($existencia_actual == 0)
                                <td>{{$existencia_actual}}</td>
                            @endif
                        @php

                        @endphp
                         <td style="text-align:center">
                            {{$detalle_provicional->cant_cajas_necesarias}}
                        </td>

                        @endforeach
                    </tbody>
                </table>
