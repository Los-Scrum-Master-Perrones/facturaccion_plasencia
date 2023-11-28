<div xmlns:wire="http://www.w3.org/1999/xhtml">

    <div class="container" style="max-width:100%;" @if ($ventanas == 2) hidden @endif>
        <br>
        @if (auth()->user()->rol == -1)
            <br>
            <br>
        @else
            <div class="row" style="text-align:center;">

                <div class="col">
                    <div class="input-group mb-3">
                        <button id="boton_agregar" name="boton_agregar" wire:click.prevent="cambio(2)"
                            class="btn btn-outline-purpura" style="width:120px;">
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
                            class="form-control mr-sm-2 " wire:model="contenedor" placeholder="Primer Contenedor"
                            required>

                        <select name="para1" id="para1" wire:model="aereo" onchange="@this.cambio_formatos()">
                            <option value="RP">Rocky Patel</option>
                            <option value="Aerea">Aerea</option>
                            <option value="FM">Family</option>
                            <option value="AereaFamily">Aerea (Family)</option>
                            <option value="WH">Warehouse</option>
                            <option value="C1">Contenedor 1</option>
                            <option value="C2">Contenedor 2</option>
                            <option value="C3">Contenedor 3</option>
                            <option value="C4">Contenedor 4</option>
                            <option value="C5">Contenedor 5</option>
                        </select>

                        <button wire:loading.attr.remove='hidden' hidden class="btn btn-outline-purpura"
                            style="width:120px;" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>

                        <button onclick="@this.insertar_factura()" wire:loading.attr='hidden'
                            class="btn btn-outline-purpura">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-save2" viewBox="0 0 16 16">
                                <path
                                    d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .354.854l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5A.5.5 0 0 1 5.5 6.5h2V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z" />
                            </svg> Guardar
                        </button>
                    </div>
                </div>
            </div>
        @endif


        <div class="row" id="op_factura" name="op_factura">
            <div class="col-sm-2">
                <label wire:model="titulo_cliente"
                    style="font-size:15px;color:white;">{{ $titulo_factura . ' ' . $titulo_cliente . ' ' . $contenedor . ' ' . $titulo_mes }}
                </label>
            </div>

            <div class="col-sm-2" style="text-align:end;">
                <label style="font-size:15px;color:white;">Factura N#: {{ $num_factura_sistema }}</label>
            </div>
            <div class="col-sm-8" style="text-align:end;">
                <div class="btn-group" style="height: 35px;" role="group">
                    <button class="btn btn-warning fs-7" wire:click="imprimir_formatos()">Imprimir</button>

                    <select wire:model="formatos_impresiones" class="form-control">
                        <option value="1">Warehouse Detallada</option>
                        <option value="2">Warehouse Simple</option>
                        <option value="3">Family</option>
                        <option value="4">Rocky Patel</option>
                        <option value="6">Rocky Patel(Aerea)</option>
                        <option value="7">Family (Aerea)</option>
                        <option value="8">LIOM LEAF</option>
                        <option value="9">Bandido</option>
                        <option value="10">Coyote</option>
                    </select>
                    <button class="btn btn-light fs-7" wire:click="historial()">Historial</button>
                </div>
            </div>
        </div>
        <br>
        <div class="row" wire:ignore>
            <div class="col">
                <select name="item_b" id="item_b" onchange="wiremodel()" name="states[]"
                    style="width:100%;height:34px;">
                    <option value="" style="overfl ow-y: scroll;">Todos Items</option>
                    @foreach ($items_p as $item)
                        <option value="{{ $item }}" style="overflow-y: scroll;"> {{ $item }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col">
                <select name="orden_b" id="orden_b" onchange="wiremodel()" name="states[]"
                    style="width:100%;height:34px;">
                    <option value="" style="overflow-y: scroll;">Todos Orden</option>
                    @foreach ($hons_p as $item)
                        <option style="overflow-y: scroll;"> {{ $item }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col">
                <select name="tipo_b" id="tipo_b" onchange="wiremodel()" name="states[]"
                    style="width:100%;height:34px;">
                    <option value="" style="overflow-y: scroll;">Todos Empaque</option>
                    @foreach ($empaques_p as $item)
                        <option style="overflow-y: scroll;"> {{ $item }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col">
                <select name="precio_b" id="precio_b" onchange="wiremodel()" name="states[]"
                    style="width:100%;height:34px;">
                    <option value="" style="overflow-y: scroll;">Todos Codigo Precio</option>
                    @foreach ($series_p as $item)
                        <option style="overflow-y: scroll;"> {{ $item->codigo_precio }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        <br>

        <div class="panel-body" style="padding:0px;">
            <div
                style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;
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
                            @if (auth()->user()->rol == -1)
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
                            $orden = '';
                            $orden_actua = '';
                            $item = '';
                            $total_puros_tabla = 0;
                            $total_ac = 0;
                            $total_neto = 0;
                            $total_bruto = 0;
                            $valor_factura = 0;

                            $bultos = 0;
                            $val_anterioir = 0;
                            $val_actual = 0;

                            $detalles_cantidad = 0;
                        @endphp

                        @foreach ($detalles_venta as $detalles)
                            @if ($orden == '' && $orden_actua == '')
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
                                $sampler_s = false;
                            @endphp


                            @if ($detalles->sampler == 'si')
                                @php
                                    $sampler_s = true;
                                @endphp
                            @else
                                @php
                                    $sampler_s = false;
                                @endphp
                            @endif

                            @php
                                if (!$sampler_s) {
                                    $val_anterioir = $bultos + 1;
                                    $bultos += $detalles->cantidad_puros;
                                    $val_actual = $bultos;
                                } else {
                                    if ($detalles_cantidad == 0) {
                                        $detalles_cantidad = $detalles->can_detalles;
                                    }
                                }
                            @endphp

                            @if ($detalles_cantidad == $detalles->can_detalles && $sampler_s)
                                <tr style="font-size:10px;">
                                    @php
                                        $val_anterioir = $bultos + 1;
                                        $bultos += $detalles->cantidad_puros;

                                        $val_actual = $bultos;
                                    @endphp

                                    @if ($val_actual == $val_anterioir)
                                        <td>{{ $val_actual }}</td>
                                    @else
                                        <td>{{ $val_anterioir }} al {{ $val_actual }}
                                        </td>
                                    @endif

                                    <td>{{ $detalles->cantidad_puros }}</td>
                                    <td>{{ $detalles->unidad }}</td>
                                    <td><b>{{ $detalles->cantidad_cajas }}</b></td>
                                    <td></td>
                                    <td>SEVERAL</td>
                                    <td>{{ $detalles->cantidad_por_caja }}</td>
                                    <td><b>{{ strtoupper($detalles->descripcion_sampler) }}</b> </td>
                                    <td></td>
                                    <td>{{ $detalles->codigo_item }}</td>
                                    <td>{{ $detalles->orden }}</td>
                                    <td>{{ $detalles->pen_pendiente }}</td>
                                    <td>{{ $detalles->orden_restante }}</td>
                                    <td>{{ $detalles->total_bruto }}</td>
                                    <td>{{ $detalles->total_neto }}</td>
                                    <td></td>
                                    <td style="text-align: right">
                                        <b>{{ number_format($detalles->costo_promedio, 4) }}</b>
                                    </td>
                                    <td style="text-align: center">-</td>
                                    @if (auth()->user()->rol == -1)
                                    @else
                                        <td style="width: 60px">
                                            <a style="text-decoration: none"
                                                onclick="eliminar_item({{ $detalles->id_detalle }})" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                </svg>
                                            </a>

                                            <a style="text-decoration: none; width:10px; height:10px;"
                                                data-bs-toggle="modal" href="#"
                                                wire:click="editar_detalles({{ $detalles->id_detalle }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    fill="currentColor" class="bi bi-pencil-square"
                                                    viewBox="0 0 16 16">
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
                                @endphp
                            @endif

                            <tr style="font-size:10px;">

                                @if ($val_actual == $val_anterioir)
                                    <td style="overflow-x:auto;">{{ $sampler_s ? '' : $val_actual }}</td>
                                @else
                                    <td style="overflow-x:auto;">
                                        {{ $sampler_s ? '' : $val_anterioir . ' al ' . $val_actual }}
                                    </td>
                                @endif

                                <td>{{ $sampler_s ? '' : $detalles->cantidad_puros }}</td>
                                <td>{{ $sampler_s ? '' : $detalles->unidad }}</td>
                                <td><b>{{ $sampler_s ? '' : $detalles->cantidad_cajas }}</b></td>
                                <td>{{ $sampler_s ? (($detalles->paquetes)/$detalles->pen_paquetes)*$detalles->cantidad_puros* $detalles->unidad : $detalles->total_tabacos }}
                                </td>
                                <td>{{ $detalles->capas }}</td>
                                <td>{{ $sampler_s ? '' : $detalles->cantidad_por_caja }}</td>
                                <td style="width: 250px">{{ $detalles->producto }}</td>
                                <td style="text-align: center;">
                                    @if ($detalles->codigo == '-')
                                    @else
                                        <a style="text-decoration: none"
                                            @if ($detalles->codigo == '') data-bs-toggle="modal" data-bs-target="#modal_agregar_precio" href="#" onclick="detalles_pendiente({{ $detalles->id_producto }},{{ $detalles->id_pendiente }},'{{ $detalles->codigo_item . '-' . $detalles->producto }}')"
                                            @else
                                                data-bs-toggle="collapse" href="#collapseExample{{ $detalles->id_detalle }}" @endif
                                            role="button" aria-expanded="false"
                                            aria-controls="collapseExample{{ $detalles->id_detalle }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-tag" viewBox="0 0 16 16">
                                                <path
                                                    d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0z" />
                                                <path
                                                    d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1zm0 5.586 7 7L13.586 9l-7-7H2v4.586z" />
                                            </svg>
                                        </a>
                                        @if ($detalles->codigo == '')
                                            <a style="text-decoration: none" data-bs-toggle="modal"
                                                data-bs-target="#productos_agregar_detalles" href="#"
                                                onclick="detalles_nuevo_precio({{ $detalles->id_detalle }},'{{ $detalles->marca }}','{{ $detalles->nombre }}','{{ $detalles->vitola }}','{{ $detalles->capa }}','{{ $detalles->tipo_empaque_ingles }}',{{ $detalles->id_producto }},{{ $detalles->id_pendiente }})"
                                                role="button" aria-expanded="false" aria-controls="collapseExample">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-folder-plus"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2Zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672Z" />
                                                    <path
                                                        d="M13.5 9a.5.5 0 0 1 .5.5V11h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V12h-1.5a.5.5 0 0 1 0-1H13V9.5a.5.5 0 0 1 .5-.5Z" />
                                                </svg>
                                            </a>
                                        @endif
                                    @endif
                                    {{ $detalles->codigo }}
                                    @if ($detalles->codigo == '' || $detalles->codigo == '-')
                                    @else
                                        <a style="text-decoration: none" href="#"
                                            onclick="eliminar_precio_catalogo({{ $detalles->id_producto }},{{ $detalles->id_pendiente }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-journal-x" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M6.146 6.146a.5.5 0 0 1 .708 0L8 7.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 8l1.147 1.146a.5.5 0 0 1-.708.708L8 8.707 6.854 9.854a.5.5 0 0 1-.708-.708L7.293 8 6.146 6.854a.5.5 0 0 1 0-.708z" />
                                                <path
                                                    d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                                <path
                                                    d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                            </svg>
                                        </a>
                                    @endif

                                </td>
                                <td>{{ $sampler_s ? '' : $detalles->codigo_item }}</td>
                                <td>{{ $sampler_s ? '' : $detalles->orden }}</td>
                                <td>{{ $sampler_s ? '' : $detalles->orden_total }}</td>
                                <td>{{ $sampler_s ? '' : number_format($detalles->orden_restante, 0) }}</td>
                                <td style="width: 65px">{{ $sampler_s ? '' : $detalles->total_bruto }}</td>
                                <td style="width: 60px">{{ $sampler_s ? '' : $detalles->total_neto }}</td>

                                @php
                                    $deta = new stdClass();
                                    $actual = Carbon\Carbon::now()->format('Y');
                                    if (isset($precio_sugerido[$detalles->codigo . '-' . $actual])) {
                                        $deta = $precio_sugerido[$detalles->codigo . '-' . $actual];
                                    } else {
                                        $deta->precio = $detalles->precio_producto;
                                    }
                                @endphp
                                <td
                                    @if (number_format($detalles->precio_producto, 2) == number_format($deta->precio, 2)) style="text-align: right;"
                                @else
                                    style="text-align: right; background-color: green; color: white" @endif>
                                    @if (number_format($detalles->precio_producto, 2) != 0.0)
                                        <a style="text-decoration: none" href="#"
                                            wire:click="incrementar_precio_catalogo({{ $detalles->id_producto }},10,'{{ $detalles->sampler }}','{{ $detalles->codigo }}',{{ $detalles->precio_producto }})">
                                            <img width="16" height="16"
                                                src="https://img.icons8.com/color/48/plus--v1.png" alt="plus--v1" />
                                        </a>
                                        {{ number_format($detalles->precio_producto, 2) }}
                                        <a style="text-decoration: none" href="#"
                                            wire:click="incrementar_precio_catalogo({{ $detalles->id_producto }},-10,'{{ $detalles->sampler }}','{{ $detalles->codigo }}',{{ $detalles->precio_producto }})">
                                            <img width="16" height="16"
                                                src="https://img.icons8.com/fluency/48/minus.png" alt="minus" />
                                        </a>
                                    @else
                                        {{ number_format($detalles->precio_producto, 2) }}
                                    @endif
                                </td>
                                @php
                                     $unitario = $sampler_s ? (($detalles->paquetes)/$detalles->pen_paquetes)*$detalles->cantidad_puros* $detalles->unidad : $detalles->total_tabacos;
                                @endphp
                                <td style="text-align: right">
                                    <b>{{ $sampler_s ? '' : number_format($detalles->costo, 4) }}</b>
                                </td>
                                <td style="text-align: right">{{ number_format((($unitario)*$detalles->precio_producto)/1000, 2) }}</td>
                                @php
                                    $valor_factura += (($unitario)*$detalles->precio_producto)/1000;
                                    $total_puros_tabla += $sampler_s ? (($detalles->paquetes)/$detalles->pen_paquetes)*$detalles->cantidad_puros* $detalles->unidad : $detalles->total_tabacos;
                                    $total_neto += $sampler_s ? 0 : $detalles->total_neto;
                                    $total_bruto += $sampler_s ? 0 : $detalles->total_bruto;

                                    if ($detalles_cantidad > 0 && $sampler_s) {
                                        $detalles_cantidad--;
                                    }
                                @endphp

                                @if (auth()->user()->rol == -1)
                                @else
                                    <td style="width: 60px">
                                        <a style="text-decoration: none"
                                            onclick="eliminar_item({{ $detalles->id_detalle }})" href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                            </svg>
                                        </a>

                                        <a style=" width:10px; height:10px;" data-bs-toggle="modal" href=""
                                            wire:click="editar_detalles({{ $detalles->id_detalle }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                            @isset($precio_sugerido[$detalles->codigo . '-' . substr($detalles->orden, -4)])
                                @php
                                    $detalle = $precio_sugerido[$detalles->codigo . '-' . substr($detalles->orden, -4)];
                                @endphp
                                <tr style="font-size:10px;">
                                    <td colspan="15"></td>
                                    <td>
                                        <div class="collapse" id="collapseExample{{ $detalles->id_detalle }}">
                                            <div class="card-body">
                                                <ol>
                                                    @php
                                                        $anio = substr($detalles->orden, -4);
                                                        $anio_actual = Carbon\Carbon::now()->format('Y');
                                                        if ($anio != $anio_actual) {
                                                            $detalle2 = $precio_sugerido[$detalles->codigo . '-' . $anio_actual];
                                                        }
                                                    @endphp
                                                    <li>
                                                        <div style="text-align: right">
                                                            <a style="text-decoration: none" href="#"
                                                                wire:click="actualizar_precio_catalogo({{ $detalles->id_producto }},{{ $detalle->precio }},'{{ $detalles->sampler }}','{{ $detalles->codigo }}')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-bag-plus" viewBox="0 0 16 16">
                                                                    <path fill-rule="evenodd"
                                                                        d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                                                    <path
                                                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                                                </svg>
                                                            </a>
                                                            <b>{{ '(' . $anio . ') ' . number_format($detalle->precio, 2) }}</b>
                                                        </div>
                                                    </li>
                                                    @if ($anio != $anio_actual)
                                                        <li>
                                                            <div style="text-align: right">
                                                                <a style="text-decoration: none" href="#"
                                                                    wire:click="actualizar_precio_catalogo({{ $detalles->id_producto }},{{ $detalle2->precio }},'{{ $detalles->sampler }}','{{ $detalles->codigo }}')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-bag-plus" viewBox="0 0 16 16">
                                                                        <path fill-rule="evenodd"
                                                                            d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                                                        <path
                                                                            d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                                                    </svg>
                                                                </a>
                                                                <b>{{ '(' . $anio_actual . ') ' . number_format($detalle2->precio, 2) }}</b>
                                                            </div>
                                                        </li>
                                                    @endif
                                                </ol>
                                            </div>
                                        </div>
                                    </td>
                                    <td colspan="3"></td>
                                </tr>
                            @endisset
                        @endforeach

                        @php
                            $this->total_cantidad_bultos = $val_actual;
                            $this->total_peso_bruto = $total_bruto;
                            $this->total_peso_neto = $total_neto;
                            $this->total_factura_precio = $valor_factura;
                            $this->total_total_puros = $total_puros_tabla;
                        @endphp
                    </tbody>
                </table>



            </div>


            <div class="input-group" style="width:30%;position: fixed;left: 0px;bottom:0px; height:30px;display:flex;"
                id="sumas1">
                <span id="de" class="input-group-text form-control fs-7"
                    style="background:rgba(174, 0, 255, 0.432);color:white;">Total Bultos</span>
                <input type="number" class="form-control  mr-sm-4 fs-7" placeholder="0"
                    value="{{ $val_actual }}" readonly>

                <span id="de" class="input-group-text form-control fs-7"
                    style="background:rgba(174, 0, 255, 0.432);color:white;">Total Puros</span>
                <input type="number" class="form-control  mr-sm-4 fs-7" placeholder="0"
                    value="{{ $total_puros_tabla }}" readonly>
            </div>


            <div class="input-group"
                style="width:45%;position: fixed;right: 0px;bottom:0px; height:30px;display:flex;" id="sumas2">

                <span id="de" class="input-group-text form-control fs-7"
                    style="background:rgba(174, 0, 255, 0.432);color:white;">Peso Bruto Total</span>

                <input type="number" class="form-control  mr-sm-4 fs-7" placeholder="0.00"
                    value="{{ $total_bruto }}" readonly>

                <span id="de" class="input-group-text form-control fs-7"
                    style="background:rgba(174, 0, 255, 0.432);color:white;">Peso Neto Total</span>

                <input type="number" class="form-control  fs-7" placeholder="0.00" value="{{ $total_neto }}"
                    readonly>

                <span id="de" class="input-group-text form-control fs-7"
                    style="background:rgba(174, 0, 255, 0.432);color:white;">Valor Total</span>

                <input type="number" class="form-control fs-7" style="font-weight: bold'; font-size: 12px;"
                    placeholder="0.00" value="{{ $valor_factura }}" readonly>
            </div>
        </div>
    </div>

    <div class="container" style="max-width:100%; font-size:10px;" @if ($ventanas != 2) hidden @endif>
        <div class="row" wire:ignore style="margin-bottom:2px">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <div wire:loading style="width:100%;height:34px;">
                            <button id="btn_guardar" class="mr-sm-2 botonprincipal" style="width:100%;height:34px;"
                                disabled>
                                <span class="spinner-border spinner-border-sm" role="status"
                                    aria-hidden="true"></span>
                                Loading...
                            </button>
                        </div>
                        <div wire:loading.attr="hidden" style="width:100%;height:34px;">
                            <abbr title="Agregar nuevo producto">
                                <button id="boton_agregar" name="boton_agregar" wire:click.prevent="cambio(1)"
                                    class=" mr-sm-2 botonprincipal" style="width:100%;height:34px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
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
                        id="dropdownMenuButton1" data-bs-toggle="dropdown">
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
                        id="dropdownMenuButton1" data-bs-toggle="dropdown">
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
                    @foreach ($items_p as $itemss)
                        <option style="overflow-y: scroll;"> {{ $itemss }}</option>
                    @endforeach
                </select>
            </div>


            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_orden" id="b_orden" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todas las ordenes del sistema</option>
                    @foreach ($ordenes_p as $orden)
                        <option style="overflow-y: scroll;"> {{ $orden }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_hon" id="b_hon" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todas las ordenes</option>
                    @foreach ($hons_p as $hon)
                        <option style="overflow-y: scroll;"> {{ $hon }}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="row" wire:ignore>
            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_marca" id="b_marca" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todas las marcas</option>
                    @foreach ($marcas_p as $marca)
                        <option style="overflow-y: scroll;"> {{ $marca }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_vitola" id="b_vitola" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todas las vitolas</option>
                    @foreach ($vitolas_p as $vitola)
                        <option style="overflow-y: scroll;"> {{ $vitola }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_nombre" id="b_nombre" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todos los nombres</option>
                    @foreach ($nombre_p as $nombre)
                        <option style="overflow-y: scroll;"> {{ $nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_capa" id="b_capa" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todas las capas</option>
                    @foreach ($capas_p as $capa)
                        <option style="overflow-y: scroll;"> {{ $capa }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_empaque" id="b_empaque" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todos los empaques</option>
                    @foreach ($empaques_p as $empaque)
                        <option style="overflow-y: scroll;"> {{ $empaque }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_mes" id="b_mes" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todos los meses</option>
                    @foreach ($mes_p as $mes)
                        <option style="overflow-y: scroll;"> {{ $mes }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <nav>
                    <ul class="pagination justify-content-center">

                        <li class="page-item">
                            <a class="page-link" href="#" tabindex="-1"
                                wire:click="mostrar_todo(0)">Dividir</a>
                        </li>
                        @php
                            $cantida = 1;
                        @endphp
                        @for ($i = 0; $i < $tuplas_conteo; $i += 100)
                            <li class="page-item"><a class="page-link" href="#"
                                    wire:click="paginacion_numerica({{ $i }})">{{ $cantida }}</a>
                            </li>
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
            <div
                style="width:100%; padding-left:0px;  font-size:9px;   overflow-x: display; overflow-y: auto;
         height:75%;">
                <table class="table table-light" style="font-size:9px;" id="tabla_pendiente">
                    <thead>
                        <tr>
                            <th>N#</th>
                            <th>CATEGORIA</th>
                            <th>ITEM</th>
                            <th># ORDEN</th>
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
                            @if (auth()->user()->rol == -1)
                            @else
                                <th></th>
                            @endif
                        </tr>
                    </thead>
                    <tbody name="body" id="body">
                        <?php $sumas = 0;
                        $sumap = 0;
                        ?>
                        @foreach ($datos_pendiente as $i => $datos)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td style="width:100px; max-width: 400px;overflow-x:auto;">{{ $datos->categoria }}
                                </td>
                                <td>{{ $datos->item }}</td>
                                <td>{{ $datos->orden_del_sitema }}</td>
                                <td>{{ $datos->observacion }}</td>
                                <td>{{ $datos->presentacion }}</td>
                                <td>{{ $datos->mes }}</td>
                                <td>{{ $datos->orden }}</td>
                                <td>{{ $datos->marca }}</td>
                                <td>{{ $datos->vitola }}</td>
                                <td>{{ $datos->nombre }}</td>
                                <td>{{ $datos->capa }}</td>
                                <td>{{ $datos->tipo_empaque }}</td>
                                <td>{{ $datos->anillo }}</td>
                                <td>{{ $datos->cello }}</td>
                                <td>{{ $datos->upc }}</td>
                                <td>{{ $datos->pendiente }}</td>
                                <td>{{ $datos->saldo }}</td>
                                @if (auth()->user()->rol == -1)
                                @else
                                    <td style="text-align:center;">
                                        <a data-bs-toggle="modal" data-bs-target="#modal_actualizar"
                                            onclick="asignar({{ $datos->id_pendiente }});  document.getElementById('titulo1').innerHTML = '{{ $datos->descripcion_produto }}';"
                                            href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
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
            <span class="form-control input-group-text fs-7">Total pendiente</span>
            <input type="text" class="form-control fs-7" id="sumap" value="{{ $sumap }}">

            <span class="form-control input-group-text fs-7">Total saldo</span>
            <input type="text" class="form-control fs-7" id="sumas" value="{{ $sumas }}">
        </div>
    </div>

    <!-- INICIO MODAL INSERTAR DATOS DETALLES FACTURA -->
    <div wire:ignore class="modal fade" role="dialog" id="modal_actualizar" data-backdrop="static"
        data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
        style="opacity:.9;background:#212529;width=900px;">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="opacity:.9;background:#212529;width=40%">
            <div class="modal-content">
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
                            <input id="intpeso_neto" name="intpeso_neto" class="form-control" type="number"
                                min="1" autocomplete="off" required>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <span>Cancelar</span>
                    </button>
                    <button type="button" onclick="guardar_detalle()" data-bs-dismiss="modal"
                        class="btn btn-success">
                        <span>Agregar</span>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- INICIO MODAL ACTUALIZAR DATO PENDIENTE -->
    <div wire:ignore class="modal fade" role="dialog" id="modal_editar_detalles" data-backdrop="static"
        data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
        style="opacity:.9;background:#212529;width=900px;">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="opacity:.9;background:#212529;width=40%">
            <div class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 id="staticBackdropLabel"><strong>Descripción del producto: </strong>
                        <input style=" border: none; background: transparent; outline: none; width: 100%"
                            type="text" name="" id=""
                            wire:model.defer='editar_descripcion_producto'>
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="text" name="id_pendi" id="id_pendi" wire:model.defer='id_editar' hidden />
                        <div class="mb-3 col">
                            <label for="txt_bultos" class="form-label">Cantidad de Bultos:</label>
                            <input id="cantidad_bultos" name="cantidad_bultos"
                                wire:model.defer='editar_cantidad_bultos' class="form-control" type="text"
                                autocomplete="off">
                        </div>
                        <div class="mb-3 col">
                            <label for="txt_unidades" class="form-label">Unidades de Puros por Bulto:</label>
                            <input id="unidades_bultos" name="unidades_bultos"
                                wire:model.defer='editar_unidades_bultos' class="form-control" type="text"
                                autocomplete="off">
                        </div>
                        <div class="mb-3 col">
                            <label for="txt_unidad_cajon" class="form-label">Unidad por Cajon:</label>
                            <input id="unidades_cajon" name="unidades_cajon" wire:model.defer='editar_unidades_cajon'
                                class="form-control" type="text" autocomplete="off">
                        </div>
                        <div class="mb-3 col">
                            <label for="txt_peso_bruto" class="form-label">Peso Bruto (Lbs)</label>
                            <input id="peso_bruto" name="peso_bruto" wire:model.defer='editar_peso_bruto'
                                class="form-control" type="text" autocomplete="off">
                        </div>
                        <div class="mb-3 col">
                            <label for="txt_peso_neto" class="form-label">Peso Neto (Lbs)</label>
                            <input id="peso_neto" name="peso_neto" wire:model.defer='editar_peso_neto'
                                class="form-control" type="text" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btn_cerrar_modal">
                        <span>Cancelar</span>
                    </button>
                    <button wire:click="actualizar_detalle_factura()" class="btn btn-success" wire:model="">
                        <span>Agregar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL ACTUALIZAR DATO PENDIENTE -->

    <div class="modal fade" id="modal_advertencia" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Advertencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Rellene los campos del Cliente y Contenedor
                </div>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" class="btn btn-success">
                        <span>OK</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore class="modal fade" id="modal_agregar_precio" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
        style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo_ctalogo_productos">Catalogo</h5>
                    <button id="btn_cerrar" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <table class="table" id="catalgo_precio">
                        <thead>
                            <tr style="text-align: center">
                                <th>ID(Agregar)</th>
                                <th>Codigo</th>
                                <th>Marca</th>
                                <th>Nombre</th>
                                <th>Vitola</th>
                                <th>Capa</th>
                                <th>Tipo Empaque</th>
                                <th>Precio ({{ Carbon\Carbon::now()->format('Y') }})</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 0.6em">
                            @foreach ($precio_catalogo as $precio)
                                <tr>
                                    <td>
                                        <a style="text-decoration: none" href="#"
                                            onclick="agregar_precio('{{ $precio->codigo }}',{{ $precio->precio }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-database-add" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Z" />
                                                <path
                                                    d="M12.096 6.223A4.92 4.92 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.493 4.493 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.525 4.525 0 0 1-.813-.927C8.5 14.992 8.252 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.552 4.552 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10c.262 0 .52-.008.774-.024a4.525 4.525 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777ZM3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4Z" />
                                            </svg>
                                        </a>
                                        {{ $precio->id }}
                                    </td>
                                    <td style="text-align: center">{{ $precio->codigo }}</td>
                                    <td>{{ $precio->marca }}</td>
                                    <td>{{ $precio->nombre }}</td>
                                    <td style="text-align: center">{{ $precio->vitola }}</td>
                                    <td style="text-align: center">{{ $precio->capa }}</td>
                                    <td style="text-align: center">{{ $precio->tipo_empaque }}</td>
                                    <td style="text-align: right">{{ number_format($precio->precio, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Codigo</th>
                                <th>Marca</th>
                                <th>Nombre</th>
                                <th>Vitola</th>
                                <th>Capa</th>
                                <th>Tipo Empaque</th>
                                <th>Precio</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" class="btn btn-success">
                        <span>OK</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore class="modal fade" id="productos_agregar_detalles" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <form wire:submit.prevent="save" id="form_detalle" name="form_detalle" style="width:100%;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><strong>Agregar Precio Nuevo</strong>
                        </h5>
                        <button id="cerrar_modal_nuevo_precio" type="button" class="btn-close"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="codigo_de" class="form-label" style="width:100%;">Codigo</label>
                                <input name="codigo_de" id="codigo_de" class="form-control" required type="text"
                                    autocomplete="off" wire:model='codigo_n'>
                            </div>
                            <div class="mb-3 col">
                                <label for="marca_de" class="form-label" style="width:100%;">Marca</label>
                                <select name="marca_de" id="marca_de" style="width:100%;" required
                                    autocomplete="off" onchange="cambio_marca()">
                                    <option value="">Seleccione Marca</option>
                                    @foreach ($marcas_precio as $marcas)
                                        <option value="{{ $marcas->marca }}">{{ $marcas->marca }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col">
                                <label for="capa_de" class="form-label" style="width:100%;">Capa</label>
                                <input name="capa_de" id="capa_de" class="form-control" style="width:100%;"
                                    required autocomplete="off" wire:model='capa_n'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="nombre_de" class="form-label" style="width:100%;">Nombre</label>
                                <input name="nombre_de" id="nombre_de" class="form-control" style="width:100%;"
                                    required autocomplete="off" wire:model='nombre_n'>
                            </div>
                            <div class="mb-3 col">
                                <label for="vitola_de" class="form-label" style="width:100%;">Vitola</label>
                                <input name="vitola_de" id="vitola_de" class="form-control" style="width:100%;"
                                    required autocomplete="off" wire:model='vitola_n'>
                            </div>
                            <div class="mb-3 col">
                                <label for="tipo_de" class="form-label" style="width:100%;">Tipo de empaque</label>
                                <input name="tipo_de" id="tipo_de" class="form-control" style="width:100%;"
                                    required autocomplete="off" wire:model='empaque_n'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="txt_buenos">Precio</label>
                                <input name="precio_de" id="precio_de" class="form-control" type="text"
                                    autocomplete="off" wire:model='precio_n'>
                            </div>
                            <div class="mb-3 col">
                            </div>
                            <div class="mb-3 col">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button class="btn btn-success" wire:loading.attr='disabled' type="submit">
                            <span wire:loading.attr.remove='hidden' hidden class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true"></span>
                            <span wire:loading.remove>Guardar</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            var id_producto = 0;
            var id_pendiente = 0;

            var seletscc = ["#item_b", "#orden_b", "#tipo_b", "#precio_b", "#marca_de"];

            $(document).ready(function() {
                seletscc.forEach(element => {
                    selects(element);
                });
            });

            function selects(nombre) {
                new TomSelect(nombre, {
                    create: nombre === "#marca_de" ? true : false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
            }

            $(document).ready(function() {
                $('#catalgo_precio').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                    },
                    scrollY: 320,
                    initComplete: function() {
                        this.api()
                            .columns()
                            .every(function() {
                                let column = this;
                                let title = column.footer().textContent;

                                // Create input element
                                let input = document.createElement('input');
                                input.placeholder = title;
                                input.style.width = "120px";
                                column.footer().replaceChildren(input);

                                // Event listener for user input
                                input.addEventListener('keyup', () => {
                                    if (column.search() !== this.value) {
                                        column.search(input.value).draw();
                                    }
                                });
                            });
                    }
                });
            });

            function detalles_pendiente(id_producto_d, id_pendiente_d, producto) {
                id_producto = id_producto_d;
                id_pendiente = id_pendiente_d;

                document.getElementById('titulo_ctalogo_productos').innerHTML = 'Catalogo: ' + producto;
            }

            function detalles_nuevo_precio(id, marca, nombre, vitola, capa, empaque, id_produc, id_pend) {
                @this.nombre_n = nombre;
                @this.vitola_n = vitola;
                @this.capa_n = capa;
                @this.empaque_n = empaque;

                @this.id_pendiente_precio = id_pend;
                @this.id_clase_producto = id_produc;
            }

            function cambio_marca() {
                @this.marca_n = $('#marca_de').val();
            }

            window.addEventListener('RegistradoConExito', event => {
                Toast.fire({
                    icon: 'success',
                    title: 'Registro realizada con exito.'
                });
                var btnCerrar = document.getElementById("cerrar_modal_nuevo_precio");
                btnCerrar.click();
            })

            function agregar_precio(codigo, precio) {
                Swal.fire({
                    title: 'Desea agregar el precio a este Item?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    denyButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.insertar_precio_catalogo(id_producto, id_pendiente, codigo, precio);
                    }
                })
            }

            function eliminar_precio_catalogo(id_producto_d, id_pendiente_d) {
                Swal.fire({
                    title: 'Desea eliminar el precio de ete item?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    denyButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.eliminar_precio_catalogo(id_producto_d, id_pendiente_d);
                    }
                })
            }

            window.addEventListener('cerrar_modal_precio', event => {
                var btnCerrar = document.getElementById("btn_cerrar");
                btnCerrar.click();
            })

            function eliminar_item(id) {

                Swal.fire({
                    title: 'Esta seguro?',
                    text: "¿Quieres eliminar este producto de la factura?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.borrar_detalles_datos(id);
                    } else {

                    }

                })
            }

            window.addEventListener('mensaje_editar_error', function(event) {
                var miVariable = event.detail.errores;

                console.log("Hay error en:", miVariable);
            });

            window.addEventListener('mensaje_editar_correcto', event => {
                Toast.fire({
                    icon: 'success',
                    title: 'Editado con exito.'
                });
                $('#modal_editar_detalles').modal('hide')
            })


            window.addEventListener('cerrar_modal_borrar', event => {
                Toast.fire({
                    icon: 'success',
                    title: 'Eliminado con exito.'
                });
            })

            function myFunction() {
                var input, filter, table, tr, td, i, j, visible;
                input = document.getElementById("seacrh");
                filter = input.value.toUpperCase();
                table = document.getElementById("editable");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    visible = false;
                    td = tr[i].getElementsByTagName("td");
                    for (j = 0; j < td.length; j++) {
                        if (td[j] && td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                            visible = true;
                        }
                    }
                    if (visible === true) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }

            function asignar(id) {
                @this.id_pendiente_detalle = id;
            }

            function guardar_detalle() {
                @this.insertar_detalle_factura(
                    document.getElementById("intunidades_cajon").value, document.getElementById("intpeso_bruto").value,
                    document.getElementById("intpeso_neto").value, document.getElementById("intcantidad_bultos").value,
                    document.getElementById("intunidades_bultos").value
                );
                @this.item = "";
            }
        </script>
        <script>
            function wiremodel() {
                @this.items_b = $('#item_b').val();
                @this.ordens_b = $('#orden_b').val();
                @this.t_empaque_b = $('#tipo_b').val();
                @this.codigo_b = $('#precio_b').val();
                @this.aereo = $('#para1').val();
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
                const myModal = new bootstrap.Modal(document.getElementById('modal_advertencia'), {
                    keyboard: false
                });
                myModal.show();
            })

            window.addEventListener('cerrar_editar_detalles', event => {
                $("#modal_editar_detalles").modal('hide');
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

            function eliminar_detalle_olvidado(id) {
                var mensaje = confirm("¿Estás seguro que desea eliminar este detalle?");
                if (mensaje) {
                    @this.eliminar_detalle_olvidado(id);
                } else {

                }
            }
        </script>
    @endpush
</div>
