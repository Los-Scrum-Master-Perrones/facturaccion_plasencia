<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">


    <br>

    <div class="" style="width:100%; ">

        <div class="col">
            <div class="row" style="margin-bottom:2px">
                <div class="col">
                    <input type="date" class="form-control" wire:model="fecha_mes" style="width:100%; padding:right;">
                </div>
                <div class="col">
                    <input name="buscar" id="buscar" class="  form-control" wire:model="busqueda"
                        placeholder="Búsqueda número factura" style="width: 100%; padding:right;">
                </div>
                <div class="col">
                    <button class="botonprincipal" style="width:100%;" wire:click="exportar_factura()">Exportar
                    </button>
                </div>
                <div class="col"></div>
                <div class="col"></div>


            </div>
        </div>

        <br>







        <div style="width:100%; padding-left:25px; padding-right:10px;">

            <div class="row">
                <div class="col-sm"
                    style="width:20%; padding-left:0px; height: 200px;  overflow-x: display; overflow-y: auto;">

                    <table class="table table-light" id="editable" style="font-size:8px;max-height: 200px">
                        <thead>
                            <tr>
                                <th>#-No. Factura</th>
                                <th>Cliente</th>
                                <th>Contenedor</th>
                                <th>Bultos</th>
                                <th>Puros</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($factura_mes as $factur)
                            <tr>
                                <td>{{$factur->numero_factura}}</td>
                                <td>{{$factur->cliente}}</td>
                                <td>{{$factur->contenedor}}</td>
                                <td>{{$factur->cantidad_bultos}}</td>
                                <td>{{$factur->total_puros}}</td>
                                <td>
                                    <a wire:click.prevent="editar_factura({{$factur->id}})" href=""
                                        style="text-decoration:none">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </a>
                                    <a style=" width:10px; height:10px; text-decoration:none;"
                                        wire:click.prevent="detalles_ventas({{$factur->id}},'{{$factur->numero_factura}}')"
                                        href="">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                            <path
                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <br>
            
            <div class="row">
                <div class="col-sm" style="width:80%; padding-left:0px; ">
                    <table class="table table-light" id="editable">
                        <thead style="font-size:8px;">
                            <tr style="font-size:8px; ">
                                <th rowspan="2">Bulto<br>Package<br>No.</th>
                                <th rowspan="2">Cant.<br>Quant.</th>
                                <th rowspan="2">Unidad<br>Unit. </th>
                                <th rowspan="2" style="background:#ddd;">Units</th>
                                <th rowspan="2">Total<br>Tabacos<br>Cigars </th>
                                <th rowspan="2">Capa<br>Wrappar </th>
                                <th rowspan="2"># </th>
                                <th rowspan="2">Clase<br>Class </th>
                                <th rowspan="2">CODIGO #<br>ITEM # </th>
                                <th rowspan="2">YOUR<br>ITEM # </th>
                                <th rowspan="2" style="background:#ddd;">YOUR<br>ORDER #</th>
                                <th rowspan="2">ORDER<br>AMOUNT </th>
                                <th rowspan="2">BACK<br>ORDER<br>AMOUNT </th>
                                <th colspan="2"> Peso en Libras<br>Weigth in Pounds </th>
                                <th rowspan="2">Precio FOB<br>per 1000 ($)</th>
                                <th rowspan="2" style="background:#ddd;">Cost </th>
                                <th rowspan="2">Valor<br>Value ($)</th>
                                <th rowspan="2"></th>
                            </tr>
                            <tr style="font-size:8px; ">
                                <th>Bruto Gross</th>
                                <th>Neto Net</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                            $orden = "";
                            $orden_actua = "";
                            $total_saldo = 0;
                            $item = "";
                            $total_puros_tabla = 0;
                            $total_ac = 0;
                            $total_neto = 0;
                            $total_bruto = 0;
                            $valor_factura = 0;
                            @endphp



                            <?php   $bultos = 0;
                            $val_anterioir=0;
                            $val_actual=0
                            ?>

@foreach($detalles_venta as $detalles)



                        @if ( $orden == "" && $orden_actua == "")
                        @php
                        $orden_actua = $detalles->orden;
                        $orden_actua = $detalles->orden;
                        @endphp
                        @endif

                        @php
                        $orden = $detalles->orden;
                        @endphp

                        @if ($orden_actua == $orden)

                        @else
                        <tr>
                            <td colspan="19" style="background-color: gray"></td>
                        </tr>
                        @php
                        $orden_actua = $detalles->orden;
                        @endphp
                        @endif

                        @php

                        $sampler = DB::select('SELECT sampler FROM clase_productos WHERE item =
                        ?',[$detalles->codigo_item]);

                        $pendiente = DB::select('SELECT orden,mes FROM pendiente WHERE id_pendiente =
                        ?',[$detalles->id_pendiente]);

                        $conteo_sampler = DB::select('SELECT COUNT(*) AS tuplas FROM pendiente WHERE item = ? AND orden
                        = ? and mes = ?',[$detalles->codigo_item,$pendiente[0]->orden,$pendiente[0]->mes]);

                        $item_primero = DB::select('SELECT id_pendiente FROM pendiente WHERE item = ? AND mes = ? AND orden LIKE
                        CONCAT("%",?,"%") limit 0,1',[$detalles->codigo_item,$pendiente[0]->mes,$pendiente[0]->orden]);


                        $total_pendiente = DB::select('SELECT sum(pendiente.saldo) AS
                        total_saldo,sum(pendiente.pendiente) AS total_pendiente FROM pendiente WHERE item = ? AND orden
                        = ? and mes = ?',[$detalles->codigo_item,$pendiente[0]->orden,$pendiente[0]->mes]);


                        if( $sampler[0]->sampler == "si"){
                        $repartir = $detalles->total_tabacos/$conteo_sampler[0]->tuplas;
                        }

                        @endphp

                        @if ( $sampler[0]->sampler == "si" && $item_primero[0]->id_pendiente == $detalles->id_pendiente)

                        @php
                        $sampler_nombre = DB::select('SELECT concat((SELECT tipo_empaque_ingles FROM tipo_empaques WHERE
                        tipo_empaques.id_tipo_empaque = clase_productos.id_tipo_empaque)," ",descripcion_sampler) as nom
                        FROM clase_productos WHERE item = ?',[$detalles->codigo_item]);

                        $promedio = DB::select('SELECT AVG(precio) AS promedio FROM detalle_clase_productos WHERE item =
                        ?',[$detalles->codigo_item]);
                        @endphp






                        <tr style="font-size:10px;">
                            @php
                            $val_anterioir= $bultos+1;
                            $bultos += $detalles->cantidad_puros;

                            $val_actual=$bultos;

                            $total_sampler_detalles = DB::select('SELECT SUM(cantidad_puros*unidad) AS salida FROM
                            detalle_factura WHERE facturado = "N" and id_pendiente = ?',
                            [$detalles->id_pendiente])[0]->salida;


                            $cantidad_sampler_empresa = DB::select('SELECT COUNT(pendiente.saldo) AS sampler_empresa
                            FROM pendiente WHERE item = ? AND orden
                            = ? and mes = ?',[$detalles->codigo_item,$pendiente[0]->orden,$pendiente[0]->mes ])[0]->sampler_empresa;


                            $cantidad_total_sampler_factura = DB::select('SELECT COUNT(pendiente.saldo) AS
                            sampler_factura
                            FROM pendiente WHERE item = ? AND orden
                            = ? and mes = ? AND pendiente != 0 AND saldo !=
                            0',[$detalles->codigo_item,$pendiente[0]->orden,$pendiente[0]->mes])[0]->sampler_factura;

                            $total_ac = intval($total_pendiente[0]->total_saldo) - ((intval( $total_sampler_detalles) *
                            intval($cantidad_total_sampler_factura))/intval($cantidad_sampler_empresa));

                            $total_saldo_pendiente = DB::update('UPDATE detalle_factura SET anterior = ? WHERE
                            id_detalle =
                            ?', [ $total_ac,$detalles->id_detalle]);
                            @endphp

                            @if ($val_actual == $val_anterioir)
                            <td style="overflow-x:auto;">{{$val_actual}}</td>
                            @else
                            <td style="overflow-x:auto;">{{$val_anterioir}} al {{$val_actual}}
                            </td>
                            @endif

                            <td>{{$detalles->cantidad_puros}}</td>
                            <td>{{$detalles->unidad}}</td>
                            <td><b>{{$detalles->cantidad_cajas}}</b></td>
                            <td></td>
                            <td>SEVERAL</td>
                            <td>{{$detalles->cantidad_por_caja}}</td>
                            <td style="width: 250px"><b>{{strtoupper($sampler_nombre[0]->nom)}}</b> </td>
                            <td>{{$detalles->codigo}}</td>
                            <td>{{$detalles->codigo_item}}</td>
                            <td>{{$detalles->orden}}</td>
                            <td>{{$total_pendiente[0]->total_pendiente}}</td>
                            <td>{{$total_ac}}</td>

                            <td style="width: 65px">{{$detalles->total_bruto}}</td>
                            <td style="width: 60px">{{$detalles->total_neto}}</td>
                            <td>{{$detalles->precio_producto}}</td>


                            <td><b>{{number_format(($promedio[0]->promedio*$detalles->cantidad_por_caja)/1000,4)}}</b>
                            </td>

                            <td style="text-align: center">-</td>
                         


                        </tr>

                        @php

                        $total_neto += $detalles->total_neto;
                        $total_bruto += $detalles->total_bruto;

                        $sampler_s = 0;
                        $arreglo_detalles = DB::select('CALL `traer_detalles_productos_factura`(?, ?)',
                        [$detalles->codigo_item, $sampler_s]);
                        @endphp



                        <tr style="font-size:10px;">

                            <td style="overflow-x:auto;"></td>


                            <td></td>
                            <td></td>
                            <td><b></b></td>
                            <td>{{$repartir}}</td>
                            <td>{{$arreglo_detalles[0]->capa}}</td>
                            <td></td>
                            <td>{{strtoupper($arreglo_detalles[0]->sampler)}}</td>
                            <td>{{$arreglo_detalles[0]->otra_descripcion}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">{{number_format($arreglo_detalles[0]->precio,4)}}</td>


                            <td></td>
                            <td style="text-align: right">
                                {{number_format(($repartir*$arreglo_detalles[0]->precio)/1000,2)}}
                            </td>
                            @php
                            $valor_factura += ($repartir*$arreglo_detalles[0]->precio)/1000;
                            @endphp
                           


                        </tr>


                        @php
                        $total_puros_tabla += $repartir;
                        $sampler_s++;
                        @endphp

                        @elseif ($sampler[0]->sampler == "si")

                        @php
                        $arreglo_detalles = DB::select('CALL `traer_detalles_productos_factura`(?, ?)',
                        [$detalles->codigo_item, $sampler_s]);


                        $total_ac = intval($total_pendiente[0]->total_saldo)-intval($detalles->total_tabacos);

                        $total_saldo_pendiente = DB::update('UPDATE detalle_factura SET anterior = ? WHERE id_detalle =
                        ?',
                        [ $total_ac,$detalles->id_detalle]);
                        @endphp

                        <tr style="font-size:10px;">
                            <td style="overflow-x:auto;"></td>
                            <td></td>
                            <td></td>
                            <td><b></b></td>
                            <td>{{$repartir}}</td>
                            <td>{{$arreglo_detalles[0]->capa}}</td>
                            <td></td>
                            <td>{{strtoupper($arreglo_detalles[0]->sampler)}}</td>
                            <td>{{$arreglo_detalles[0]->otra_descripcion}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">{{number_format($arreglo_detalles[0]->precio,4)}}</td>


                            <td style="text-align: right"></td>
                            <td style="text-align: right">
                                {{number_format(($repartir*$arreglo_detalles[0]->precio)/1000,2)}}
                            </td>
                            @php
                            $valor_factura += ($repartir*$arreglo_detalles[0]->precio)/1000;
                            @endphp
                        
                        </tr>

                        @php
                        $total_puros_tabla += $repartir;
                        $sampler_s++;
                        @endphp


                        @else

                        @php
                        $total_puros_tabla += $detalles->total_tabacos;
                        $sampler_s = 0;
                        @endphp
                        <tr style="font-size:10px;">


                            <?php
                                    $val_anterioir= $bultos+1;
                                    $bultos += $detalles->cantidad_puros;
                                    $val_actual=$bultos;

                                    $total_puros_salida = DB::select('SELECT SUM(cantidad_puros*unidad) AS salida FROM detalle_factura WHERE facturado = "N" and id_pendiente = ?', [$detalles->id_pendiente]);
                                    $total_saldo_pendiente = DB::select('SELECT saldo FROM pendiente WHERE id_pendiente = ?', [$detalles->id_pendiente]);

                                    $total_restante =  intval($total_saldo_pendiente[0]->saldo) - intval($total_puros_salida[0]->salida);

                                    $total_saldo_pendiente = DB::update('UPDATE detalle_factura SET anterior = ? WHERE id_detalle = ?', [$total_restante,$detalles->id_detalle]);


                                    $total_neto += $detalles->total_neto;
                                    $total_bruto += $detalles->total_bruto;
                                ?>

                            @if ($val_actual == $val_anterioir)
                            <td style="overflow-x:auto;">{{$val_actual}}</td>
                            @else
                            <td style="overflow-x:auto;">{{$val_anterioir}} al {{$val_actual}}
                            </td>
                            @endif

                            <td>{{$detalles->cantidad_puros}}</td>
                            <td>{{$detalles->unidad}}</td>
                            <td><b>{{$detalles->cantidad_cajas}}</b></td>
                            <td>{{$detalles->total_tabacos}}</td>
                            <td>{{$detalles->capas}}</td>
                            <td>{{$detalles->cantidad_por_caja}}</td>
                            <td>{{$detalles->producto}}</td>
                            <td>{{$detalles->codigo}}</td>
                            <td>{{$detalles->codigo_item}}</td>
                            <td>{{$detalles->orden}}</td>
                            <td>{{$detalles->orden_total}}</td>
                            <td>{{$total_restante}}</td>
                            <td>{{$detalles->total_bruto}}</td>
                            <td>{{$detalles->total_neto}}</td>
                            <td style="text-align: right">{{$detalles->precio_producto}}</td>


                            <td style="text-align: right"><b>{{number_format($detalles->costo,4)}}</b></td>
                            <td style="text-align: right">{{number_format($detalles->valor_total,2)}}</td>
                            @php
                            $valor_factura += $detalles->valor_total;
                            @endphp


                        </tr>



                        @endif

                        @endforeach
                          
                            <tr style="font-size:10px;">
                                <td></td>
                                <td><b>{{$val_actual}}</b></td>
                                <td></td>
                                <td></td>
                                <td><b>{{ $total_puros_tabla}}</b></td>

                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td><b>{{number_format($total_bruto,2)}}</b></td>
                                <td><b>{{number_format($total_neto,2)}}</b></td>
                                <td></td>
                                <td></td>
                                <td><b>{{number_format($valor_factura,2)}}</b></td>
                            </tr>
                            <tr style="font-size:10px;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr style="font-size:10px;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr style="font-size:10px;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr style="font-size:10px;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="font-size: 10px">CARIBBEAN CIGAR COMPANY</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>

                    </table>



                </div>
            </div>
        </div>


    </div>


    <!-- INICIO MODAL ACTUALIZAR SALDO-->
    <form action="{{Route('editar_venta_factura')}}" method="POST" id="form_saldo" name="form_saldo">
        <div class="modal fade" id="modal_actualizar_ventas" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"
                            style="width:450px; text-align:center; font-size:20px;">Actualizar Venta</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 col">
                            <label class="form-label" style="width:440px; text-align:center; font-size:20px;">No.
                                Factura</label>
                            <input class="form-control" id="num_factura" name="num_factura" placeholder=""
                                style="width: 440px" maxLength="30" value="{{$num_factura_editar}}" autocomplete="off"
                                type="text">
                        </div>
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label"
                                style="width:440px; text-align:center; font-size:20px;">Cliente</label>
                            <input class="form-control" id="cliente" name="cliente" placeholder="" style="width: 440px"
                                maxLength="30" value="{{$cliente_editar}}" autocomplete="off" type="text">
                        </div>
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label"
                                style="width:440px; text-align:center; font-size:20px;">Contenedor</label>
                            <input class="form-control" id="contenedor" name="contenedor" placeholder=""
                                style="width: 440px" maxLength="30" value="{{$contenedor_editar}}" autocomplete="off"
                                type="text">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button style=" background: #b39f64; color: #ecedf1;" type="button" class=" btn-info-claro "
                            data-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button class=" btn-info float-right" style="margin-right: 10px">
                            <span>Actualizar</span>
                        </button>

                        @csrf
                        <input name="id_venta" wire:model="id_factura_editar" hidden />
                    </div>
                </div>
            </div>
        </div>

    </form>
    <!-- FIN MODAL  ACTUALIZAR SALDO -->

    <script>
        window.addEventListener('abrir', event => {
            $("#modal_actualizar_ventas").modal('show');
        })
    </script>

</div>
