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
                <div class="col">

                </div>
            </div>


        </div>
        <br>

        <div style="width:100%; padding-left:25px; padding-right:10px;">

            <div class="row">
                <div class="col-sm"
                    style="width:20%; padding-left:0px; height: 200px;  overflow-x: display; overflow-y: auto;">

                    <table class="table table-light table-hover" id="editable" style="font-size:8px;max-height: 200px">
                        <thead>
                            <tr>
                                <th>#-No. Factura</th>
                                <th>Cliente</th>
                                <th>Contenedor</th>
                                <th>Bultos</th>
                                <th>Puros</th>
                                <th>Total($)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_mes= 0.00;
                            @endphp

                            @foreach ($factura_mes as $factur)
                            <tr>
                                <td>{{$factur->numero_factura}}</td>
                                <td>{{$factur->cliente}}</td>
                                <td>{{$factur->contenedor}}</td>
                                <td>{{$factur->cantidad_bultos}}</td>
                                <td>{{$factur->total_puros}}</td>
                                <td style="text-align: end">{{number_format($factur->total,2)}}</td>

                                @php
                                    $total_mes += $factur->total;
                                @endphp
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
            <div class="input-group"
                        style="width:30%;position: fixed;left: 0px;bottom:0px; height:30px;display:flex;" id="sumas1">
                        <span id="de" class="input-group-text form-control "
                            style="background:rgba(174, 0, 255, 0.432);color:white;">Total ($)</span>
                        <input type="number" class="form-control  mr-sm-4" placeholder="0" value="{{($total_mes)}}" readonly>


                    </div>

            <br>

            <div class="row">
                <div class="col-sm" style="width:80%; padding-left:0px; ">
                    <table class="table table-light table-hover" id="editable">
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
                                        <td>{{ $detalles->precio_producto }}</td>


                                        <td><b></b></td>
                                        <td style="text-align: center">-</td>d>
                                @endif

                                </tr>

                                @php
                                    $total_neto += $detalles->total_neto;
                                    $total_bruto += $detalles->total_bruto;
                                @endphp


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
                                    <td style="text-align: center;">{{ $detalles->codigo }}</td>
                                    <td>{{ $sampler_s ? '' : $detalles->codigo_item }}</td>
                                    <td>{{ $sampler_s ? '' : $detalles->orden }}</td>
                                    <td>{{ $sampler_s ? '' : $detalles->orden_total }}</td>
                                    <td>{{ $sampler_s ? '' : number_format($detalles->orden_restante, 0) }}</td>
                                    <td style="width: 65px">{{ $sampler_s ? '' : $detalles->total_bruto }}</td>
                                    <td style="width: 60px">{{ $sampler_s ? '' : $detalles->total_neto }}</td>
                                    <td style="text-align: right;">
                                        {{ number_format($detalles->precio_producto, 2) }}
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
                                        $total_puros_tabla += $sampler_s ? $detalles->total_tabacos / $detalles->can_detalles : $detalles->total_tabacos;
                                        $total_neto += $sampler_s ? 0 : $detalles->total_neto;
                                        $total_bruto += $sampler_s ? 0 : $detalles->total_bruto;

                                        if ($detalles_cantidad > 0 && $sampler_s) {
                                            $detalles_cantidad--;
                                        }
                                    @endphp
                                </tr>
                            @endforeach
                            <tr style="font-size:10px;">
                                <td></td>
                                <td><b>{{ $val_actual }}</b></td>
                                <td></td>
                                <td></td>
                                <td><b>{{ $total_puros_tabla }}</b></td>

                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td><b>{{ number_format($total_bruto, 2) }}</b></td>
                                <td><b>{{ number_format($total_neto, 2) }}</b></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right"><b>{{ number_format($valor_factura, 2) }}</b></td>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            data-bs-dismiss="modal">
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
