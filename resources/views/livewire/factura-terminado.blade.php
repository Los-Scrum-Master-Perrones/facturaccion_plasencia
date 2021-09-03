<div xmlns:wire="http://www.w3.org/1999/xhtml">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">


    <div class="container" style="max-width:100%;" id="div_factura" name="div_factura">
        <br>
        <div class="row" style="text-align:center;">

            <div class="col">
                <div class="input-group mb-3">
                    <button id="boton_agregar" name="boton_agregar" onclick="mostrarPendiente()"
                        class=" mr-sm-2 botonprincipal" style="width:120px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                        Producto
                    </button>


                    <span id="lbl_cliente" name="lbl_cliente" class="form-control input-group-text ">Cliente</span>
                    <input style="width:150px;" id="txt_cliente" name="txt_cliente" type="text"
                        class="form-control mr-sm-2 " wire:model="cliente" placeholder="Rocky,  Hatsa" required>

                    <span id="lbl_fecha" name="lbl_fecha" class="input-group-text form-control">Fecha</span>
                    <input style="width:150px;" id="txt_fecha" name="txt_fecha" type="date"
                        class="form-control mr-sm-2 " wire:model="fecha_factura">

                    <span id="lbl_contenedor" name="lbl_contenedor"
                        class="input-group-text form-control">Contenedor</span>
                    <input style="width:150px;" id="txt_contenedor" name="txt_contenedor" type="text"
                        class="form-control mr-sm-2 " wire:model="contenedor" placeholder="Primer Contenedor" required>

                    <select name="para1" id="para1" wire:model="aereo">
                        <option value="RP">Rocky Patel</option>
                        <option value="FM">Family</option>
                        <option value="WH">Warehouse</option>
                        <option value="Aerea">Aerea</option>
                    </select>

                    <button id="btn_guardar" class="botonprincipal" wire:click="insertar_factura()"
                        style="width:120px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-save2" viewBox="0 0 16 16">
                            <path
                                d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .354.854l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5A.5.5 0 0 1 5.5 6.5h2V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z" />
                        </svg> Guardar
                    </button>
                </div>
            </div>
        </div>


        <div class="row" id="op_factura" name="op_factura">
            <div class="col-sm-2">
                <label wire:model="titulo_cliente"
                    style="font-size:15px;color:white;">{{$titulo_factura." ".$titulo_cliente." ". $contenedor." ".$titulo_mes}}
                </label>
            </div>

            <div class="col-sm-2" style="text-align:end;">
                <label style="font-size:15px;color:white;">Factura N#: {{$num_factura_sistema}}</label>
            </div>

            <div class="col-sm-3" style="text-align:end;">
                <button style="width:120px;" class="botonprincipal" wire:click="imprimir()">Imprimir</button>
            </div>
            <div class="col-sm-3" style="text-align:end;">
                <button style="width:120px;" class="botonprincipal" wire:click="imprimir_formato_largo()">Imprimir(factura Larga)</button>
            </div>
            <div class="col-sm-2" style="text-align:end;">
                <button style="width:120px;" class="botonprincipal" wire:click="historial()">Historial</button>
            </div>
        </div>
        <br>


        <div class="panel-body" style="padding:0px;">
            <div style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;
                height:70%;">

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
                            <th>Bruto Net</th>
                            <th>Neto Net</th>
                        </tr>
                    </thead>
                    <tbody>


                        @php
                        $orden = "";
                        $orden_actua = "";
                        $item = "";
                        $total_puros_tabla = 0;
                        $total_ac = 0;
                        $total_neto = 0;
                        $total_bruto = 0;
                        $valor_factura = 0;
                        $sampler_s=0;
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

                        $item_primero = DB::select('SELECT id_pendiente FROM pendiente WHERE item = ? AND mes = ? AND
                        orden LIKE
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
                            = ? and mes = ?',[$detalles->codigo_item,$pendiente[0]->orden,$pendiente[0]->mes
                            ])[0]->sampler_empresa;


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
                            <td style="width: 60px">
                                <a data-toggle="modal" data-target="#borrar_detalles" href=""
                                    wire:click="borrar_detalles({{$detalles->id_detalle}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg></a>


                                <a style=" width:10px; height:10px;" data-toggle="modal" href=""
                                    wire:click="editar_detalles({{$detalles->id_detalle}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </a>

                            </td>


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
                            <td style="width: 250px">{{strtoupper($arreglo_detalles[0]->sampler)}}</td>
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
                            <td style="width: 60px">


                            </td>


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
                            <td style="width: 250px">{{strtoupper($arreglo_detalles[0]->sampler)}}</td>
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
                            <td style="width: 60px">
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
                            <td style="width: 250px">{{$detalles->producto}}</td>
                            <td>{{$detalles->codigo}}</td>
                            <td>{{$detalles->codigo_item}}</td>
                            <td>{{$detalles->orden}}</td>
                            <td>{{$detalles->orden_total}}</td>
                            <td>{{$total_restante}}</td>
                            <td style="width: 65px">{{$detalles->total_bruto}}</td>
                            <td style="width: 60px">{{$detalles->total_neto}}</td>
                            <td style="text-align: right">{{$detalles->precio_producto}}</td>


                            <td style="text-align: right"><b>{{number_format($detalles->costo,4)}}</b></td>
                            <td style="text-align: right">{{number_format($detalles->valor_total,2)}}</td>
                            @php
                            $valor_factura += $detalles->valor_total;
                            @endphp
                            <td style="width: 60px">
                                <a data-toggle="modal" data-target="#borrar_detalles" href=""
                                    wire:click="borrar_detalles({{$detalles->id_detalle}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg></a>


                                <a style=" width:10px; height:10px;" data-toggle="modal" href=""
                                    wire:click="editar_detalles({{$detalles->id_detalle}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </a>

                            </td>


                        </tr>



                        @endif

                        @endforeach

                        @php

                        $this->total_cantidad_bultos = $val_actual;
                        $this->total_total_puros = $total_puros_tabla;
                        $this->total_peso_bruto=$total_bruto;
                        $this->total_peso_neto =$total_neto;
                        $this->total_precio= $valor_factura;
                        @endphp
                    </tbody>
                </table>



            </div>


            <div class="input-group" style="width:30%;position: fixed;left: 0px;bottom:0px; height:30px;display:flex;"
                id="sumas1">
                <span id="de" class="input-group-text form-control "
                    style="background:rgba(174, 0, 255, 0.432);color:white;">Total Bultos</span>
                <input type="number" class="form-control  mr-sm-4" placeholder="0" value="{{$val_actual}}" readonly>

                <span id="de" class="input-group-text form-control"
                    style="background:rgba(174, 0, 255, 0.432);color:white;">Total Puros</span>
                <input type="number" class="form-control  mr-sm-4" placeholder="0" value="{{$total_puros_tabla}}"
                    readonly>
            </div>


            <div class="input-group" style="width:45%;position: fixed;right: 0px;bottom:0px; height:30px;display:flex;"
                id="sumas2">

                <span id="de" class="input-group-text form-control"
                    style="background:rgba(174, 0, 255, 0.432);color:white;">Peso Bruto Total</span>
                <input type="number" class="form-control  mr-sm-4" placeholder="0.00" value="{{$total_bruto}}" readonly>

                <span id="de" class="input-group-text form-control"
                    style="background:rgba(174, 0, 255, 0.432);color:white;">Peso Neto Total</span>
                <input type="number" class="form-control " placeholder="0.00" value="{{$total_neto}}" readonly>

                <span id="de" class="input-group-text form-control"
                    style="background:rgba(174, 0, 255, 0.432);color:white;">Valor Total</span>

                <input type="number" class="form-control " placeholder="0.00" value="{{$valor_factura}}" readonly>
            </div>
        </div>
    </div>

    <div class="container" style="max-width:100%;  display:none" id="div_pendiente" name="div_pendiente">
        <br>

        <div class="row" style="text-align:center;">

            <div class="col">

                <div class="col" id="pendiente_asuntos_1" name="pendiente_asuntos_1">
                    <div class="row" style="margin-bottom:2px">
                        <div class="col-2">
                            <button style="width:100%;" id="boton_regresar" onclick="mostrarDetalleFactura()"
                                class=" mr-sm-2 botonprincipal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                                </svg>
                                Regresar
                            </button>
                        </div>

                        <div class="col-1">
                            <select name="para2" id="para2" wire:model="aereo" style="width:100%;height:28px;">
                                <option value="RP">Rocky Patel</option>
                                <option value="FM">Family</option>
                                <option value="WH">Warehouse</option>
                                <option value="Aerea">Aerea</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <select onchange="buscar_tabla()" onclick="funcion1()" name="b_item" id="b_item"
                                class=" mi-selector form-control " style="width:100%;height:34px;" name="states[]">
                                <option value="" style="overflow-y: scroll;">Todos Items</option>
                                @foreach ($items as $item)
                                <option style="overflow-y: scroll;">{{$item->item}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-3">
                            <select onchange="buscar_tabla()" onclick="funcion1()" name="b_orden" id="b_orden"
                                class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                                <option value="" style="overflow-y: scroll;">Todas las ordenes del sistema</option>
                                @foreach ($orden_sistemas as $orden_sistema)
                                <option style="overflow-y: scroll;">{{$orden_sistema->orden_del_sitema}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-3">
                            <select onchange="buscar_tabla()" onclick="funcion1()" name="b_hon" id="b_hon"
                                class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                                <option value="" style="overflow-y: scroll;">Todas las ordenes</option>
                                @foreach ($orden_pedidos as $orden_pedido)
                                <option style="overflow-y: scroll;">{{$orden_pedido->orden}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>



                <div class="container" style="max-width:100%; margin-top: 4px;" id="pendiente_asuntos_2"
                    name="pendiente_asuntos_2">
                    <div class="row">


                        <div class="col-sm-2">
                            <select onchange="buscar_tabla()" onclick="funcion1()" name="b_marca" id="b_marca"
                                class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                                <option value="" style="overflow-y: scroll;">Todas las marcas</option>
                                @foreach ($marcas_busqueda as $marcas_busquedas)
                                <option style="overflow-y: scroll;">{{$marcas_busquedas->marca}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2">
                            <select onchange="buscar_tabla()" onclick="funcion1()" name="b_vitola" id="b_vitola"
                                class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                                <option value="" style="overflow-y: scroll;">Todas las vitolas</option>
                                @foreach ($busqueda_vitolas as $busqueda_vitola)
                                <option style="overflow-y: scroll;">{{$busqueda_vitola->vitola}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select onchange="buscar_tabla()" onclick="funcion1()" name="b_nombre" id="b_nombre"
                                class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                                <option value="" style="overflow-y: scroll;">Todos los nombres</option>
                                @foreach ($busqueda_nombre as $busqueda_nombres)
                                <option style="overflow-y: scroll;">{{$busqueda_nombres->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2">
                            <select onchange="buscar_tabla()" onclick="funcion1()" name="b_capa" id="b_capa"
                                class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                                <option value="" style="overflow-y: scroll;">Todas las capas</option>
                                @foreach ($busqueda_capas as $busqueda_capa)
                                <option style="overflow-y: scroll;">{{$busqueda_capa->capa}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2">
                            <select onchange="buscar_tabla()" onclick="funcion1()" name="b_empaque" id="b_empaque"
                                class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                                <option value="" style="overflow-y: scroll;">Todas los empaques</option>
                                @foreach ($busqueda_tipo_empaques as $busqueda_tipo_empaque)
                                <option style="overflow-y: scroll;">{{$busqueda_tipo_empaque->tipo_empaque}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2">
                            <select onchange="buscar_tabla()" onclick="funcion1()" name="b_mes" id="b_mes"
                                class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                                <option value="" style="overflow-y: scroll;">Todos los meses</option>
                                @foreach ($busqueda_meses as $busqueda_mese)
                                <option style="overflow-y: scroll;">{{$busqueda_mese->mes}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <br>
        <br>

        <div class="panel-body" style="padding:0px;">
            <div style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;
                height:70%;">

                <div id="tabla_pendiente_factura" name="tabla_pendiente_factura">


                    <table class="table table-light" style="font-size:8px;" id="pendiente_factura">
                        <thead>
                            <tr>
                                <th>CATEGORIA</th>
                                <th>ITEM</th>
                                <th>ORDEN DEL SISTEMA</th>
                                <th>OBSERVACÓN</th>
                                <th>PRESENTACIÓN</th>
                                <th>MES</th>
                                <th>ORDEN</th>
                                <th>MARCA</th>
                                <th>VITOLA</th>
                                <th>NOMBRE</th>
                                <th>CAPA</th>
                                <th>TIPO DE EMPAQUE</th>
                                <th>ANILLO</th>
                                <th>CELLO</th>
                                <th>UPC</th>
                                <th>PENDIENTE</th>
                                <th>SALDO</th>
                                <th>PT</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="body_pendiente_factura">
                            @php
                            $tota_penidiente_factura= 0;
                            $tota_saldo_factura= 0;
                            @endphp

                            @foreach($datos_pendiente as $datos)

                            <tr>
                                <td style="width:100px; max-width: 400px; overflow-x:auto;">{{$datos->categoria}}</td>
                                <td>{{$datos->item}}</td>
                                <td>{{$datos->orden_del_sitema}}</td>
                                <td>{{$datos->observacion}}</td>
                                <td>{{$datos->presentacion}}</td>
                                <td>{{$datos->mes}}</td>
                                <td>{{$datos->orden}}</td>
                                <td>{{$datos->marca}}</td>
                                <td>{{$datos->vitola}}</td>
                                <td>{{$datos->nombre}}</td>
                                <td>{{$datos->capa}}</td>
                                <td>{{$datos->tipo_empaque}}</td>
                                <td>{{$datos->anillo}}</td>
                                <td>{{$datos->cello}}</td>
                                <td>{{$datos->upc}}</td>
                                <td>{{$datos->pendiente}}</td>
                                <td>{{$datos->saldo}}</td>
                                <td>{{$datos->PT}}</td>
                                <td style="text-align:center;">

                                    <a data-toggle="modal" data-target="#modal_actualizar"
                                        onclick="asignar({{$datos->id_pendiente}});  document.getElementById('titulo1').innerHTML = '{{$datos->descripcion_produto}}';"
                                        href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z" />
                                        </svg>
                                    </a>


                                </td>
                            </tr>

                            @php
                            $tota_penidiente_factura+= $datos->pendiente;
                            $tota_saldo_factura+= $datos->saldo;
                            @endphp


                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

            <div class="input-group" style="width:30%;position: fixed;right: 0px;bottom:0px; height:30px;" id="sumas3">
                <span id="de" class="input-group-text form-control "
                    style="background:rgba(174, 0, 255, 0.432);color:white;">Total Pendiente</span>
                <input type="number" id="pendiente" class="form-control  mr-sm-4" placeholder="0"
                    value='{{$tota_penidiente_factura}}' readonly>

                <span id="de" class="input-group-text form-control"
                    style="background:rgba(174, 0, 255, 0.432);color:white;">Total Saldo</span>
                <input type="number" id="saldo" class="form-control  mr-sm-4" placeholder="0"
                    value='{{$tota_saldo_factura}}' readonly>
            </div>
        </div>
    </div>








    <!-- INICIO MODAL INSERTAR DATOS DETALLES FACTURA -->

    <form id="actualizar_pendiente" name="actualizar_pendiente" wire:ignore>
        <div class="modal fade" role="dialog" id="modal_actualizar" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
            style="opacity:.9;background:#212529;width=900px;">
            <div class="modal-dialog modal-dialog-centered modal-lg" style="opacity:.9;background:#212529;width=40%">
                <div class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 id="staticBackdropLabel"><strong>Descripción del producto: </strong><span id="titulo1"
                                name="titulo1"></span></h5>
                    </div>

                    <div class="modal-body">
                        <div class="row">

                            <input name="id_pendi" id="id_pendi" wire:model="id_pendiente" hidden />
                            <input name="para" id="para" wire:model="aereo" hidden />

                            <div class="mb-3 col">
                                <label for="txt_bultos" class="form-label">Cantidad de Bultos:</label>
                                <input id="intcantidad_bultos" name="intcantidad_bultos" class="form-control"
                                    type="number" min="1" autocomplete="off" required>
                            </div>
                            <div class="mb-3 col">
                                <label for="txt_unidades" class="form-label">Unidades de Puros por
                                    Bulto:</label>
                                <input id="intunidades_bultos" name="intunidades_bultos" class="form-control"
                                    type="number" min="1" autocomplete="off" required>
                            </div>
                            <div class="mb-3 col">
                                <label for="txt_unidad_cajon" class="form-label">Unidad por Cajon:</label>
                                <input id="intunidades_cajon" name="intunidades_cajon" class="form-control"
                                    type="number" min="1" autocomplete="off" required>
                            </div>
                            <div class="mb-3 col">
                                <label for="txt_peso_bruto" class="form-label">Peso Bruto (Lbs)</label>
                                <input id="intpeso_bruto" name="intpeso_bruto" class="form-control" type="number"
                                    min="1" autocomplete="off" required>
                            </div>
                            <div class="mb-3 col">
                                <label for="txt_peso_neto" class="form-label">Peso Neto (Lbs)</label>
                                <input id="intpeso_neto" name="intpeso_neto" class="form-control" type="number" min="1"
                                    autocomplete="off" required>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="bmodal_no" data-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button type="submit" onclick="guardar_detalle()" data-dismiss="modal" class="bmodal_yes">
                            <span>Agregar</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </form>

    <!-- INICIO MODAL ACTUALIZAR DATO PENDIENTE -->

    <form action="{{Route('actualizar_detalle_factura')}}" method="POST" id="actualizar_from" name="actualizar_from">
        <div class="modal fade" role="dialog" id="modal_editar_detalles" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
            style="opacity:.9;background:#212529;width=900px;">
            <div class="modal-dialog modal-dialog-centered modal-lg" style="opacity:.9;background:#212529;width=40%">
                <div class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 id="staticBackdropLabel"><strong>Descripción del producto: </strong><span id="titulo"
                                name="titulo">{{$id_editar." ".$editar_descripcion_producto}}</span>
                        </h5>
                    </div>

                    <div class="modal-body">
                        <div class="row">

                            <input type="text" name="id_pendi" id="id_pendi" value="{{$id_editar}}" hidden />

                            <div class="mb-3 col">
                                <label for="txt_bultos" class="form-label">Cantidad de Bultos:</label>
                                <input id="cantidad_bultos" name="cantidad_bultos" value="{{$editar_cantidad_bultos}}"
                                    class="form-control" type="text" autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                                <label for="txt_unidades" class="form-label">Unidades de Puros por
                                    Bulto:</label>
                                <input id="unidades_bultos" name="unidades_bultos" value="{{$editar_unidades_bultos}}"
                                    class="form-control" type="text" autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                                <label for="txt_unidad_cajon" class="form-label">Unidad por Cajon:</label>
                                <input id="unidades_cajon" name="unidades_cajon" value="{{$editar_unidades_cajon}}"
                                    class="form-control" type="text" autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                                <label for="txt_peso_bruto" class="form-label">Peso Bruto (Lbs)</label>
                                <input id="peso_bruto" name="peso_bruto" value="{{$editar_peso_bruto}}"
                                    class="form-control" type="text" autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                                <label for="txt_peso_neto" class="form-label">Peso Neto (Lbs)</label>
                                <input id="peso_neto" name="peso_neto" value="{{$editar_peso_neto}}"
                                    class="form-control" type="text" autocomplete="off">
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="bmodal_no" data-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button type="submit" class="bmodal_yes">
                            <span>Agregar</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </form>
    <!-- FIN MODAL ACTUALIZAR DATO PENDIENTE -->

    <!-- INICIO MODAL ELMINAR DETALLE -->
    <form wire:submit.prevent="borrar_detalles_datos({{$id_eliminar}})">

        <div class="modal fade" id="modal_eliminar_detalle" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Eliminar </h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro que quieres eliminar este producto de la factura?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="bmodal_no" data-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button type="submit" class="bmodal_yes">
                            <span>Eliminar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="modal_advertencia" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Advertencia</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Rellene los campos del Cliente y Contenedor
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class=" bmodal_yes ">
                        <span>OK</span>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        function asignar(id) {
            var table_div = document.getElementById("tabla_pendiente_factura");
            table_div.setAttribute('wire:ignore', '');
            @this.item = "0909";
            @this.id_pendiente_detalle = id;

        }

        function guardar_detalle() {

            @this.insertar_detalle_factura(
                document.getElementById("intunidades_cajon").value,
                document.getElementById("intpeso_bruto").value,
                document.getElementById("intpeso_neto").value,
                document.getElementById("intcantidad_bultos").value,
                document.getElementById("intunidades_bultos").value
            );


            @this.item = "";

            mostrarDetalleFactura();

        }
    </script>
    <script>
        window.addEventListener('abrir', event => {
            $("#modal_actualizar").modal('show');
            mostrarPendiente();
        })

        window.addEventListener('pendiente', event => {
            mostrarPendiente();
        })

        window.addEventListener('cerrar', event => {
            $("#modal_actualizar").modal('hide');
        })

        window.addEventListener('editar_detalless', event => {
            $("#modal_editar_detalles").modal('show');
        })

        window.addEventListener('advertencia_mensaje', event => {
            $("#modal_advertencia").modal('show');
        })

        window.addEventListener('cerrar_editar_detalles', event => {
            $("#modal_editar_detalles").modal('hide');
        })

        window.addEventListener('borrar', event => {
            $("#modal_eliminar_detalle").modal('show');
        })

        window.addEventListener('cerrar_modal_borrar', event => {
            $("#modal_eliminar_detalle").modal('hide');
        })
    </script>


    <script type="text/javascript">
        function mostrarPendiente() {
            document.getElementById('div_pendiente').style.display = 'block';
            document.getElementById('div_factura').style.display = 'none';
        }

        function mostrarDetalleFactura() {
            document.getElementById('div_pendiente').style.display = 'none';
            document.getElementById('div_factura').style.display = 'block';

        }
    </script>

    <script>
        function abrir(id, descripcion) {
            $("#productos_faltantes").modal('show');
        }
    </script>

    <script type="text/javascript">
        function funcion1() {
            $('.mi-selector').select2();
        }
    </script>

    <script type="text/javascript">
        function buscar_tabla() {

            var data = null;
            var table = document.getElementById("pendiente_factura");
            var rowCount = table.rows.length;
            var tableRows = table.getElementsByTagName('tr');
            //console.log(rowCount)

            if (rowCount <= 1) {} else {
                for (var x = rowCount - 1; x > 0; x--) {
                    document.getElementById("body_pendiente_factura").innerHTML = "";
                }
            }

            var table_div = document.getElementById("tabla_pendiente_factura");
            table_div.setAttribute('wire:ignore', '');


            var b_orden = document.getElementById('b_orden').value;
            var b_item = document.getElementById('b_item').value;
            var b_hon = document.getElementById('b_hon').value;
            var b_mes = document.getElementById('b_mes').value;

            var b_marca = document.getElementById('b_marca').value;
            var b_vitola = document.getElementById('b_vitola').value;
            var b_capa = document.getElementById('b_capa').value;
            var b_nombre = document.getElementById('b_nombre').value;
            var b_empaque = document.getElementById('b_empaque').value;

            data = @json($datos_pendiente);


            if (b_orden == "" && b_item == "" && b_hon == "" && b_mes == "" && b_marca == "" &&
                b_vitola == "" && b_capa == "" && b_nombre == "" && b_empaque == "") {
                location.reload(true);
            } else {

                var sumas = 0;
                var sumap = 0;
                for (var i = 0; i < data.length; i++) {
                    try {

                        if (data[i].marca.toLowerCase().replace(/\((\w+)\)/g, '').match(b_marca.toLowerCase().replace(
                                /\((\w+)\)/g, '')) &&
                            data[i].vitola.toLowerCase().match(b_vitola.toLowerCase()) &&
                            data[i].nombre.toLowerCase().match(b_nombre.toLowerCase()) &&
                            data[i].capa.toLowerCase().match(b_capa.toLowerCase()) &&
                            data[i].tipo_empaque.toLowerCase().match(b_empaque.toLowerCase()) &&

                            data[i].item.toLowerCase().match(b_item.toLowerCase()) &&
                            data[i].orden_del_sitema.toLowerCase().match(b_orden.toLowerCase()) &&
                            data[i].mes.toLowerCase().match(b_mes.toLowerCase()) &&
                            data[i].orden.toLowerCase().match(b_hon.toLowerCase())) {

                            sumas = sumas + data[i].saldo;
                            sumap = sumap + data[i].pendiente;

                            if (data[i].observacion == null) {
                                data[i].observacion = "";
                            }
                            if (data[i].presentacion == null) {
                                data[i].presentacion = "";
                            }
                            if (data[i].anillo == null) {
                                data[i].anillo = "";
                            }
                            if (data[i].cello == null) {
                                data[i].cello = "";
                            }
                            if (data[i].upc == null) {
                                data[i].upc = "";
                            }
                            if (data[i].serie_precio == null) {
                                data[i].serie_precio = "";
                            }
                            if (data[i].precio == null) {
                                data[i].precio = "";
                            }
                            if (data[i].pendiente == null) {
                                data[i].pendiente = "";
                            }
                            if (data[i].saldo == null) {
                                data[i].saldo = "";
                            }

                            var tabla_nueva = `
                        <tr>
                        <td>` + data[i].categoria + `</td>
                        <td>` + data[i].item + `</td>
                        <td>` + data[i].orden_del_sitema + `</td>
                        <td>` + data[i].observacion + `</td>

                        <td>` + data[i].presentacion + `</td>
                        <td>` + data[i].mes + `</td>
                        <td style="width:100px;font-size:8px;">` + data[i].orden + `</td>
                        <td style="width:100px;font-size:8px;">` + data[i].marca + `</td>
                        <td>` + data[i].vitola + `</td>

                        <td>` + data[i].nombre + `</td>
                        <td>` + data[i].capa + `</td>
                        <td>` + data[i].tipo_empaque + `</td>
                        <td>` + data[i].anillo + `</td>
                        <td>` + data[i].cello + `</td>
                        <td>` + data[i].upc + `</td>
                        <td>` + data[i].pendiente + `</td>
                        <td>` + data[i].saldo + `</td>
                        <td>` + data[i].PT + `</td>
                        <td>
                            <a data-toggle="modal"  data-target="#modal_actualizar" onclick="asignar(` + data[i]
                                .id_pendiente + `);  document.getElementById('titulo1').innerHTML = '` + data[i]
                                .descripcion_produto + `';" href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z" />
                                        </svg>
                            </a>
                        </td>
                    </tr>

                    `;


                            document.getElementById("body_pendiente_factura").innerHTML += tabla_nueva.toString();
                        }
                    } catch (error) {
                        console.error(error);
                    }


                }

                document.getElementById("pendiente").value = sumap;
                document.getElementById("saldo").value = sumas;
              
            }
            // fin del else
        }
    </script>
</div>
