<div xmlns:wire="http://www.w3.org/1999/xhtml">

    <div class="container" style="max-width:100%;" @if($ventanas==2) hidden @endif>
        <br>
        @if(auth()->user()->rol == -1)
        <br>
        <br>
        @else
        <div class="row" style="text-align:center;">

            <div class="col">
                <div class="input-group mb-3">
                    <button id="boton_agregar" name="boton_agregar" wire:click.prevent="cambio(2)"
                        class=" mr-sm-2 botonprincipal" style="width:120px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                        Productos
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

                    <div wire:loading>
                        <button id="btn_guardar" class="mr-sm-2 botonprincipal" style="width:120px; height: 35px;"
                            disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </div>
                    <div wire:loading.attr="hidden" style="width:120px;">
                        <button id="btn_guardar" class=" mr-sm-2 botonprincipal" wire:click="insertar_factura()"
                            style="width:120px; height: 35px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-save2" viewBox="0 0 16 16">
                                <path
                                    d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .354.854l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5A.5.5 0 0 1 5.5 6.5h2V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z" />
                            </svg> Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif


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
                <button style="width:120px;" class="botonprincipal"
                    wire:click="imprimir_formato_largo()">Imprimir(factura Larga)</button>
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
                            @if(auth()->user()->rol == -1)

                            @else
                            <th rowspan="2"></th>
                            @endif
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

                        <?php try{ ?>



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
                            @if(auth()->user()->rol == -1)

                            @else
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
                            @endif


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


                            @php
                            $unidades = DB::select('SELECT item,orden,mes,paquetes FROM pendiente WHERE id_pendiente =
                            ?',[$detalles->id_pendiente]);
                            $total_unidades = 0;

                            $total_paqutes = DB::select('SELECT sum(paquetes) AS total_pendiente FROM pendiente
                            WHERE item = ? AND orden = ? and mes = ?',
                            [$unidades[0]->item,$unidades[0]->orden,$unidades[0]->mes]);




                            @endphp



                            <td></td>
                            <td></td>
                            <td><b></b></td>
                            <td>{{$detalles->total_tabacos*(intval($unidades[0]->paquetes)/$total_paqutes[0]->total_pendiente)}}
                            </td>
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
                                {{number_format((($detalles->total_tabacos*(intval($unidades[0]->paquetes)/$total_paqutes[0]->total_pendiente))*$arreglo_detalles[0]->precio)/1000,2)}}
                            </td>
                            @php
                            $valor_factura +=
                            (($detalles->total_tabacos*(intval($unidades[0]->paquetes)/$total_paqutes[0]->total_pendiente))*$arreglo_detalles[0]->precio)/1000;
                            @endphp

                            @if(auth()->user()->rol == -1)

                            @else
                            <td style="width: 60px">
                            </td>
                            @endif


                        </tr>


                        @php
                        $total_puros_tabla +=
                        $detalles->total_tabacos*(intval($unidades[0]->paquetes)/$total_paqutes[0]->total_pendiente);
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

                        @php
                        $unidades = DB::select('SELECT item,orden,mes,paquetes FROM pendiente WHERE id_pendiente =
                        ?',[$detalles->id_pendiente]);
                        $total_unidades = 0;

                        $total_paqutes = DB::select('SELECT sum(paquetes) AS total_pendiente FROM pendiente
                        WHERE item = ? AND orden = ? and mes = ?',
                        [$unidades[0]->item,$unidades[0]->orden,$unidades[0]->mes]);




                        @endphp

                        <tr style="font-size:10px;">
                            <td style="overflow-x:auto;"></td>
                            <td></td>
                            <td></td>
                            <td><b></b></td>
                            <td>{{$detalles->total_tabacos*(intval($unidades[0]->paquetes)/$total_paqutes[0]->total_pendiente)}}
                            </td>

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
                                {{number_format((($detalles->total_tabacos*(intval($unidades[0]->paquetes)/$total_paqutes[0]->total_pendiente))*$arreglo_detalles[0]->precio)/1000,2)}}
                            </td>
                            @php
                            $valor_factura +=
                            (($detalles->total_tabacos*(intval($unidades[0]->paquetes)/$total_paqutes[0]->total_pendiente))*$arreglo_detalles[0]->precio)/1000;
                            @endphp
                            @if(auth()->user()->rol == -1)

                            @else
                            <td style="width: 60px"></td>
                            @endif
                        </tr>

                        @php
                        $total_puros_tabla +=
                        $detalles->total_tabacos*(intval($unidades[0]->paquetes)/$total_paqutes[0]->total_pendiente);
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

                            @if(auth()->user()->rol == -1)

                            @else
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
                            @endif

                        </tr>



                        @endif

                        <?php }catch(\Exception $e){ ?>
                        <?php } ?>
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

    <div class="container" style="max-width:100%; font-size:10px;" @if($ventanas !=2) hidden @endif>
        <div class="row" wire:ignore style="margin-bottom:2px">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <div wire:loading style="width:100%;height:34px;">
                            <button id="btn_guardar" class="mr-sm-2 botonprincipal" style="width:100%;height:34px;"
                                disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...
                            </button>
                        </div>
                        <div wire:loading.attr="hidden" style="width:100%;height:34px;">
                            <abbr title="Agregar nuevo producto">
                                <button id="boton_agregar" name="boton_agregar" wire:click.prevent="cambio(1)"
                                    class=" mr-sm-2 botonprincipal" style="width:100%;height:34px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                                    </svg>
                                    Factura
                                </button>
                            </abbr>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle form-control" type="button"
                        id="dropdownMenuButton1" data-toggle="dropdown">
                        Categorias
                    </button>
                    <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton1">
                        <div class="form-check ">
                            <input class="form-check-input" type="checkbox" value="1" id="checkbox1" checked
                                name="checkbox1" wire:model="r_uno">
                            <label class="form-check-label " for="flexCheckDefault"> NEW ROLL </label>
                        </div>

                        <div class="form-check ">
                            <input class="form-check-input" type="checkbox" value="2" id="checkbox2" checked
                                name="checkbox2" wire:model="r_dos">
                            <label class="form-check-label " for="flexCheckChecked"> CATALOGO </label>
                        </div>

                        <div class="form-check ">
                            <input class="form-check-input " type="checkbox" value="3" id="checkbox3" checked
                                name="checkbox3" wire:model="r_tres">
                            <label class="form-check-label " for="flexCheckDefault"> INVENTARIO EXISTENTE
                            </label>
                        </div>

                        <div class="form-check ">
                            <input class="form-check-input " type="checkbox" value="4" id="checkbox4" checked
                                name="checkbox4" wire:model="r_cuatro">
                            <label class="form-check-label " for="flexCheckChecked"> WAREHOUSE </label>
                        </div>
                    </ul>
                </div>
            </div>


            <div class="col">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle form-control" type="button"
                        id="dropdownMenuButton1" data-toggle="dropdown">
                        Presentacion
                    </button>
                    <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton1">
                        <div class="form-check ">
                            <input class="form-check-input" type="checkbox" value="Puros Tripa Larga" id="checkbox5"
                                checked name="checkbox5" wire:model="r_cinco">
                            <label class="form-check-label " for="flexCheckDefault"> Puros Tripa Larga </label>
                        </div>

                        <div class="form-check ">
                            <input class="form-check-input" type="checkbox" value="Puros Tripa Corta" id="checkbox6"
                                checked name="checkbox6" wire:model="r_seis">
                            <label class="form-check-label " for="flexCheckChecked"> Puros Tripa Corta </label>
                        </div>

                        <div class="form-check ">
                            <input class="form-check-input " type="checkbox" value="Puros Sandwich" id="checkbox7"
                                checked name="checkbox7" wire:model="r_siete">
                            <label class="form-check-label " for="flexCheckDefault"> Puros Sandwich
                            </label>
                        </div>
			<div class="form-check ">
                            <input class="form-check-input " type="checkbox" value="Puros Brocha" id="checkbox7"
                                checked name="checkbox7" wire:model="r_mill">
                            <label class="form-check-label " for="flexCheckDefault"> Puros Brocha
                            </label>
                        </div>
                    </ul>
                </div>
            </div>

            <div class="col">
                <select onchange="buscar_tabla()" name="b_item" id="b_item" class="mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todos Items</option>
                    @foreach($items_p as $itemss)
                    <option style="overflow-y: scroll;"> {{$itemss->item}}</option>
                    @endforeach
                </select>
            </div>


            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_orden" id="b_orden" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todas las ordenes del sistema</option>
                    @foreach($ordenes_p as $orden)
                    <option style="overflow-y: scroll;"> {{$orden->orden_del_sitema}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_hon" id="b_hon" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todas las ordenes</option>
                    @foreach($hons_p as $hon)
                    <option style="overflow-y: scroll;"> {{$hon->orden}}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="row" wire:ignore>
            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_marca" id="b_marca" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todas las marcas</option>
                    @foreach($marcas_p as $marca)
                    <option style="overflow-y: scroll;"> {{$marca->marca}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_vitola" id="b_vitola" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todas las vitolas</option>
                    @foreach($vitolas_p as $vitola)
                    <option style="overflow-y: scroll;"> {{$vitola->vitola}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_nombre" id="b_nombre" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todos los nombres</option>
                    @foreach($nombre_p as $nombre)
                    <option style="overflow-y: scroll;"> {{$nombre->nombre}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_capa" id="b_capa" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todas las capas</option>
                    @foreach($capas_p as $capa)
                    <option style="overflow-y: scroll;"> {{$capa->capa}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_empaque" id="b_empaque" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todos los empaques</option>
                    @foreach($empaques_p as $empaque)
                    <option style="overflow-y: scroll;"> {{$empaque->empaque}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_mes" id="b_mes" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todos los meses</option>
                    @foreach($mes_p as $mes)
                    <option style="overflow-y: scroll;"> {{$mes->mes}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <nav>
                    <ul class="pagination justify-content-center">

                        <li class="page-item">
                            <a class="page-link" href="#" tabindex="-1" wire:click="mostrar_todo(0)">Dividir</a>
                        </li>
                        @php
                        $cantida = 1;
                        @endphp
                        @for ($i = 0; $i < $tuplas_conteo ; $i+=100) <li class="page-item"><a class="page-link" href="#"
                                wire:click="paginacion_numerica({{$i}})">{{$cantida}}</a></li>
                            @php
                            $cantida++;
                            @endphp

                            @endfor
                            @php
                            $cantida = 1;
                            @endphp
                            <li class="page-item">
                                <a class="page-link" href="#" wire:click="mostrar_todo(1)">Mostrar Todo</a>
                            </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="panel-body" style="padding:0px;">
            <div style="width:100%; padding-left:0px;  font-size:9px;   overflow-x: display; overflow-y: auto;
         height:75%;">
                <table class="table table-light" style="font-size:9px;" id="tabla_pendiente">
                    <thead>
                        <tr>
                            <th>N#</th>
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
                            @if(auth()->user()->rol == -1)

                            @else
                            <th></th>
                            @endif
                        </tr>
                    </thead>
                    <tbody name="body" id="body">
                        <?php $sumas = 0 ;
                        $sumap=0;
                        ?>
                        @foreach($datos_pendiente as $i => $datos)
                        <tr>
                            <td>{{++$i}}</td>
                            <td style="width:100px; max-width: 400px;overflow-x:auto;">{{$datos->categoria}}</td>
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
                            @if(auth()->user()->rol == -1)

                            @else
                            <td style="text-align:center;">
                                <a data-toggle="modal" data-target="#modal_actualizar"
                                    onclick="asignar({{$datos->id_pendiente}});  document.getElementById('titulo1').innerHTML = '{{$datos->descripcion_produto}}';"
                                    href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z" />
                                    </svg>
                                </a>
                            </td>
                            @endif
                        </tr>

                        <?php
                            $sumas = $sumas + $datos->saldo;
                            $sumap = $sumap + $datos->pendiente;
                        ?>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="input-group" style="width:40%; position: fixed;right: 0px;bottom:0px; height:30px;">
            <span class="form-control input-group-text">Total pendiente</span>
            <input type="text" class="form-control" id="sumap" value="{{$sumap}}">

            <span class="form-control input-group-text">Total saldo</span>
            <input type="text" class="form-control" id="sumas" value="{{$sumas}}">
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
            @this.busqueda_items_p = $('#b_item').val();
            @this.busqueda_marcas_p = $('#b_marca').val();
            @this.busqueda_nombre_p = $('#b_nombre').val();
            @this.busqueda_vitolas_p = $('#b_vitola').val();
            @this.busqueda_capas_p = $('#b_capa').val();
            @this.busqueda_empaques_p = $('#b_empaque').val();
            @this.busqueda_mes_p = $('#b_mes').val();
            @this.busqueda_items_p = $('#b_item').val();
            @this.busqueda_ordenes_p = $('#b_orden').val();
            @this.busqueda_hons_p = $('#b_hon').val();
            @this.paginacion = 0;
        }
    </script>
</div>
