<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item">
            <a class="nav-link active fs-7" aria-current="page" href="{{ route('produccion.pendiente.index') }}"><strong>Pendiente</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link fs-7" href="{{ route('produccion.index') }}"><strong>Entradas</strong></a>
        </li>
    </ul>

    <div class="container" style="max-width:100%;">
        <div wire:loading>
            <div class="centro_carga">
                <div style="color: #a0cadb" class="la-ball-atom la-3x">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
        <div class="row" wire:ignore style="margin-bottom:2px">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <div class="btn-group" style="height: 35px;" role="group"
                            aria-label="Basic mixed styles example">
                            @if (auth()->user()->rol == -1)
                            @else
                                <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#productos_crear">
                                    <abbr title="Agregar nuevo producto al pendiente">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            fill="white" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                            <path
                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                        </svg>
                                    </abbr>
                                </button>
                            @endif
                            <button class="btn btn-outline-danger" wire:click="exportPendiente()">
                                <abbr title="Exportar a excel">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
                                        <path
                                            d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z" />
                                    </svg>
                                </abbr>
                            </button>
                            <button class="btn btn-outline-info" onclick="actualizar_datos()">
                                <abbr title="Preparar Reporte Materiales">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
                                        <path
                                            d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z" />
                                    </svg>
                                </abbr>
                            </button>
                            <button class="btn btn-outline-success" onclick="exportar_pendiente()">
                                <abbr title="Exportar Materiales Pendiente">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-list-check" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                </abbr>
                            </button>
                            <button class="btn btn-outline-warning" onclick="exportar_materiales()">
                                <abbr title="Exportar Solo Materiales">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-list-columns-reverse" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5Zm-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Z" />
                                    </svg>
                                </abbr>
                            </button>

                        </div>
                    </div>
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
                                checked name="checkbox5" wire:model="tipo1">
                            <label class="form-check-label " for="flexCheckDefault"> Puros Tripa Larga </label>
                        </div>

                        <div class="form-check ">
                            <input class="form-check-input" type="checkbox" value="Puros Tripa Corta" id="checkbox6"
                                checked name="checkbox6" wire:model="tipo2">
                            <label class="form-check-label " for="flexCheckChecked"> Puros Tripa Corta </label>
                        </div>

                        <div class="form-check ">
                            <input class="form-check-input " type="checkbox" value="Puros Sandwich" id="checkbox7"
                                checked name="checkbox7" wire:model="tipo3">
                            <label class="form-check-label " for="flexCheckDefault"> Puros Sandwich </label>
                        </div>
                        <div class="form-check ">
                            <input class="form-check-input " type="checkbox" value="Puros Brocha" id="checkbox7"
                                checked name="checkbox7" wire:model="tipo4">
                            <label class="form-check-label " for="flexCheckDefault"> Puros Brocha </label>
                        </div>
                    </ul>
                </div>
            </div>
            <div class="col">
                <select onchange="buscar_tabla()" id="b_codigo" name="b_codigo" name="states[]">
                    <option value="">Codigos</option>
                    @foreach ($codigos as $codigo)
                        <option>{{ $codigo }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_orden" id="b_orden" style="width:100%;height:34px;"
                    name="states[]">
                    <option value="" style="overflow-y: scroll;"># Ordenes</option>
                    @foreach ($ordenes as $orden)
                        <option style="overflow-y: scroll;"> {{ $orden }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_mes" id="b_mes" style="width:100%;height:34px;"
                    name="states[]">
                    <option value="" style="overflow-y: scroll;">Meses</option>
                    @foreach ($mes as $me)
                        <option style="overflow-y: scroll;"> {{ $me }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_fecha" id="b_fecha" style="width:100%;height:34px;"
                    name="states[]">
                    <option value="" style="overflow-y: scroll;">Fecha</option>
                    @foreach ($fechas as $fecha)
                        <option style="overflow-y: scroll;"> {{ $fecha }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row" wire:ignore>
            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_marca" id="b_marca" style="width:100%;height:34px;"
                    name="states[]">
                    <option value="" style="overflow-y: scroll;">Marcas</option>
                    @foreach ($marcas as $marca)
                        <option style="overflow-y: scroll;"> {{ $marca }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_nombre" id="b_nombre" style="width:100%;height:34px;"
                    name="states[]">
                    <option value="" style="overflow-y: scroll;">Nombres</option>
                    @foreach ($nombres as $nombre)
                        <option style="overflow-y: scroll;"> {{ $nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_vitola" id="b_vitola" style="width:100%;height:34px;"
                    name="states[]">
                    <option value="" style="overflow-y: scroll;">Vitolas</option>
                    @foreach ($vitolas as $vitola)
                        <option style="overflow-y: scroll;"> {{ $vitola }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_capa" id="b_capa" style="width:100%;height:34px;"
                    name="states[]">
                    <option value="" style="overflow-y: scroll;">Capas</option>
                    @foreach ($capas as $capa)
                        <option style="overflow-y: scroll;"> {{ $capa }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col" wire:ignore>
                <select name="por_pagina" id="por_pagina" onchange="buscar_tabla()">
                    <option selected value="50">50</option>
                    <option value="200">200</option>
                    <option value="{{ $total }}">Todo</option>
                </select>
            </div>
        </div>
        <div class="row p-2" style="margin-bottom: -30px">
            <div class="col">
                {{ $pendiente->links() }}
            </div>
        </div>
    </div>

    @if (auth()->user()->rol == -1)
    @else
        {{-- <div wire:ignore class="modal fade" id="productos_crear" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="productos_crear" aria-hidden="true"
            style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-lg">
                <!-- INICIO DEL MODAL NUEVO PRODUCTO -->
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="staticBackdropLabel"><strong>Agregar producto</strong></h5>
                        <button type="button" id="cerrar_modal_productos_crear" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </div>

                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="txt_figuraytipo" class="form-label">Item</label>
                                    <select name="itemn" id="itemn" style="height:30px; width: 100%;"
                                        class="fs-7" required type="text" autocomplete="off">
                                        <option value="">Todos los items</option>
                                        @foreach ($items_p as $items)
                                            <option value="{{ $items->item }}">{{ $items->item }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_figuraytipo" class="form-label">Categoria</label>
                                    <select class="form-control fs-7" name="categoria" id="categoria"
                                        style="overflow-y: scroll; height:30px;" required>
                                        <option value="1">NEW ROLL</option>
                                        <option value="2">CATALOGO</option>
                                        <option value="3">TAKE FROM EXISTING INVENT</option>
                                        <option value="4">INTERNATIONAL SALES</option>
                                    </select>
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_malos" class="form-label">Presentación</label>
                                    <input class="form-control fs-7" name="presentacionn" id="presentacionn"
                                        wire:model='presentacion' placeholder="Ingresa figura y tipo"
                                        style="overflow-y: scroll; height:30px;" disabled>
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_vitola" class="form-label">Marca</label>
                                    <input class="form-control fs-7" style=" height:30px; width: 100%;"
                                        name="marcan" id="marcan" wire:model='marcas_nuevo'
                                        placeholder="Ingresa figura y tipo" disabled>

                                </div>
                            </div>


                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="txt_figuraytipo" class="form-label">Capa</label>
                                    <input class="form-control fs-7" style=" height:30px; width: 100%;"
                                        name="capan" id="capan" wire:model='capas_nuevo'
                                        placeholder="Ingresa figura y tipo" disabled>
                                </div>


                                <div class="mb-3 col">
                                    <label for="txt_malos" class="form-label">Tipo de
                                        empaque</label>
                                    <input class="form-control fs-7" style=" height:30px; width: 100%;"
                                        name="tipon" id="tipon" wire:model='tipo_empaques_nuevo'
                                        placeholder="Ingresa figura y tipo" disabled>
                                </div>


                                <div class="mb-3 col">
                                    <label for="vitola" class="form-label">Vitola</label>
                                    <input class="form-control fs-7" style=" height:30px; width: 100%;"
                                        name="vitolan" wire:model='vitolas_nuevo' id="vitolan"
                                        placeholder="Ingresa figura y tipo" disabled>
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_total" class="form-label">Nombre</label>
                                    <input class="form-control fs-7" style=" height:30px; width: 100%;"
                                        name="nombren" wire:model='nombres_nuevo' id="nombren"
                                        placeholder="Ingresa figura y tipo" disabled>

                                </div>
                            </div>


                            <div class="row">

                                <div class="mb-3 col">
                                    <label for="txt_figuraytipo" class="form-label">Orden del sistema</label>
                                    <input name="ordensis" id="ordensis" style="font-size:16px"
                                        class="form-control fs-7" type="text" autocomplete="off">
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_figuraytipo" class="form-label">Orden</label>
                                    <input name="ordenn" id="ordenn" style="font-size:16px"
                                        class="form-control fs-7" required type="text" autocomplete="off">
                                </div>


                                <div class="mb-3 col">
                                    <label for="txt_figuraytipo" class="form-label">Fecha</label>
                                    <input value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" name=" fechan"
                                        id="fechan" style="font-size:12px" class="form-control fs-7" required
                                        type="date" autocomplete="off">
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_figuraytipo" class="form-label">Observacion</label>
                                    <input name="observacionn" id="observacionn" style="font-size:16px"
                                        class="form-control fs-7" type="text" autocomplete="off">
                                </div>
                            </div>



                            <div class="row">

                                <div class="mb-3 col" hidden>
                                    <div class="row">
                                        <div class="col">
                                            <input type="checkbox" name="cello" id="cello"
                                                style="font-size:20px" value="si">
                                            <label for="cello" class="form-label">Cello</label>
                                        </div>

                                        <div class="col">
                                            <input type="checkbox" name="anillo" id="anillo"
                                                style="font-size:20px" value="si">
                                            <label for="anillo" class="form-label">Anillo</label>
                                        </div>

                                        <div class="col">
                                            <input type="checkbox" name="upc" id="upc"
                                                style="font-size:20px" value="si">
                                            <label for="upc" class="form-label">UPC</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_total" class="form-label">Pendiente</label>
                                    <input name="pendienten" id="pendienten" class="form-control fs-7" required
                                        type="number" autocomplete="off">
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_buenos" class="form-label">Saldo</label>
                                    <input name="saldon" id="saldon" class="form-control fs-7" required
                                        type="number" autocomplete="off">
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_buenos" class="form-label">Codigo precio</label>
                                    <input disabled name="c_precion" id="c_precion" class="form-control fs-7"
                                        type="text" wire:model='codigo_precio_nuevo' autocomplete="off">
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_total" class="form-label">precio</label>
                                    <input disabled name="precion" id="precion" class="form-control fs-7"
                                        type="number" wire:model='precio_precio' autocomplete="off">
                                </div>

                            </div>


                            <div class="row">

                                <div class="mb-3 col" hidden>
                                    <label for="txt_total" class="form-label">Paquetes</label>
                                    <input name="paquetes" id="paquetes" class="form-control fs-7" required
                                        type="number" autocomplete="off">
                                </div>
                                <div class="mb-3 col" hidden>
                                    <label for="txt_total" class="form-label">Unidades</label>
                                    <input name="unidades" id="unidades" class="form-control fs-7" required
                                        type="number" autocomplete="off">
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span>Cancelar</span>
                            @csrf
                        </button>
                        <button onclick="insertar_nuevo_pendiente()" class="btn btn-success"> <span>Guardar</span>
                        </button>
                    </div>
                </div>

            </div>
            <!-- FIN DEL MODAL NUEVO PRODUCTO -->
        </div> --}}
    @endif
<br>
    <div class="panel-body">
        <div
            style="width:100%; padding-left:0px;  font-size:9px;   overflow-x: display; overflow-y: auto; height:75%;">
            <table class="table table-light" style="font-size:9px;" id="tabla_pendiente">
                <thead>
                    <tr>
                        <th>N#</th>
                        <th>CODIGO</th>
                        <th># ORDEN</th>
                        <th>FECHA</th>
                        <th>EN PROCESO</th>
                        <th>OBSERVACÓN</th>
                        <th>PRESENTACION</th>
                        <th>MES</th>
                        <th style="width:100px;">MARCA</th>
                        <th>NOMBRE</th>
                        <th>VITOLA</th>
                        <th>CAPA</th>
                        <th>PENDIENTE</th>
                        <th>PRODUCIDO</th>
                        <th>RESTANTE</th>
                        <th>PRECIO ROLERO</th>
                        <th>PRECIO BONCHERO</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody name="body" id="body">
                    @php
                        $sumas = 0;
                        $sumap = 0;
                        $sumaprecio_dolar = 0;
                    @endphp
                    @foreach ($pendiente as $i => $detalle)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $detalle->codigo }}</td>
                            <td>{{ $detalle->orden_sistema }}</td>
                            <td>{{ $detalle->fecha_recibido }}</td>
                            @php
                                $timestamp1 = strtotime($detalle->fecha_recibido);
                                $timestamp2 = strtotime(Carbon\Carbon::now()->format('Y-m-d'));
                                $diferencia_dias = ($timestamp2 - $timestamp1) / (60 * 60 * 24);
                            @endphp
                            <td>{{ $diferencia_dias }}</td>
                            <td></td>
                            <td>{{ $detalle->presentacion }}</td>
                            <td>{{ $detalle->mes }}</td>
                            <td style="width:200px">{{ $detalle->marca }}</td>
                            <td>{{ $detalle->nombre }}</td>
                            <td>{{ $detalle->vitola }}</td>
                            <td>{{ $detalle->capa }}</td>

                            <td style="text-align:right;">{{ $detalle->pendiente }}</td>
                            <td style="text-align:right;">{{ $detalle->pendiente - $detalle->restantes }}
                                @php
                                    $porcentaje = (($detalle->pendiente - $detalle->restantes) / $detalle->pendiente)*100 ;
                                @endphp
                                <div class="progress">
                                    <div class="progress-bar @if($porcentaje<25)
                                        bg-danger
                                    @endif

                                    @if($porcentaje>=25 && $porcentaje<50)
                                        bg-warning
                                    @endif

                                    @if($porcentaje>=50 && $porcentaje <75)
                                        bg-info
                                    @endif

                                    @if($porcentaje>=75 && $porcentaje <= 100)
                                        bg-success
                                    @endif

                                    " role="progressbar" style="width: {{ $porcentaje }}%;" aria-valuenow="{{ $porcentaje  }}" aria-valuemin="0" aria-valuemax="100" style="color: black">
                                        {{ number_format($porcentaje,0) }}%
                                    </div>
                                  </div>
                            </td>
                            <td style="text-align:right;">{{ $detalle->restantes }}</td>
                            <td style="text-align:right;">{{ $detalle->precio_rolero }}</td>
                            <td style="text-align:right;">{{ $detalle->precio_bonchero }}</td>



                            @if (auth()->user()->rol == -1)
                            @else
                                <td style="width:120px;">
                                    <a data-bs-toggle="modal" data-bs-target="#modal_eliminar_detalle"
                                        onclick="datos_modal_eliminar({{ $detalle->id }})" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                        </svg>
                                    </a>
                                    <a style=" width:10px; height:10px;" data-bs-toggle="modal" href="#"
                                        data-bs-target="#modal_actualizar" type="submit"
                                        onclick="datos_modal_actualizar({{ $detalle->id }})">
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

                        @php
                            $sumas = $sumas + $detalle->restantes ;
                            // $sumaprecio_dolar += $datos->precio_dolares;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="input-group" style="width:20%; position: fixed;right: 0px;bottom:0px; height:30px;">
        <span class="form-control input-group-text fs-7">Total pendiente</span>
        <input type="text" class="form-control fs-7" id="sumap" value="{{ number_format($sumas, 0) }}">
{{--
        <span class="form-control input-group-text fs-7">Total saldo ($)</span>
        <input type="text" class="form-control fs-7" id="sumaprecio"
            value="{{ number_format($sumaprecio_dolar, 2) }}"> --}}
    </div>

    <!-- INICIO MODAL ACTUALIZAR DATO PENDIENTE -->
    {{-- <div class="modal fade" role="dialog" id="modal_actualizar" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
        style="opacity:.9;background:#212529;width=800px;">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="opacity:.9;background:#212529;width=80%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="staticBackdropLabel">
                        <strong>Descripción del producto: </strong><span id="tituloupdate" name="tituloupdate"></span>
                    </h5>
                    <button id='boton_cerrar_modal_actualizar' type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input name="id_pendientea2" id="id_pendientea2" value="" hidden />
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Orden del sistema</label>
                            <input name="orden_sistema2" id="orden_sistema2" class="form-control" type="text"
                                autocomplete="off">
                        </div>
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Orden</label>
                            <input name="orden2" id="orden2" class="form-control" type="text"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Pendiente</label>
                            <input name="pendiente2" id="pendiente2" class="form-control" type="text"
                                autocomplete="off">
                        </div>
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Saldo</label>
                            <input name="saldo2" id="saldo2" class="form-control" type="text"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Observación</label>
                            <input name="observacion2" id="observacion2" class="form-control" type="text"
                                autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">
                        <span>Cancelar</span>
                    </button>
                    <button type="button" class="btn btn-success" onclick="guardar_actualizacion()">
                        <span>Actualizar</span>
                    </button>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- FIN MODAL ACTUALIZAR DATO PENDIENTE -->

    <!-- INICIO MODAL ELMINAR DATO PENDIENTE -->
    {{-- <div class="modal fade" id="modal_eliminar_detalle" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Eliminar <strong><input value=""
                                id="txt_usuarioE" name="txt_usuarioE" style="border:none;"></strong> </h5>
                    <button id="boton_cerrar_modal_eliminar_detalle" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input name="id_pendiente3" id="id_pendiente3" value="" hidden />

                    ¿Estás seguro que quieres eliminar este registro del pendiente?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <span>Cancelar</span>
                    </button>
                    <button type="button" onclick="eliminar_pendiente()" class="btn btn-success">
                        <span>Eliminar</span>
                    </button>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- FIN MODAL ELMINAR DATO PENDIENTE -->



    <!-- MODAL GENERAR REMISION DE CAJAS DE MADERA SEGUN ORDEN DEL SISTEMA -->
    {{-- <div class="modal fade" id="generarremisioncajas" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel">PEDIDO CAJAS DE MADERA<strong></strong> </h6>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('pendientecajapedido') }}">
                    @csrf
                    <div class="modal-body">
                        Ingrese el numero de Orden del Sistema que desea generar para su Orden de Cajas de Madera.
                        <br>
                        <br>
                        <input class="form-control" name="orden_sistema" id="orden_sistema" value="" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button type="submit" class="btn btn-success">
                            <span>Generar Pedido</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}


    @push('scripts')
        <script type="text/javascript">
            // function datos_modal_eliminar(id) {
            //     var datastiles = @this.datos_pendiente;
            //     for (var i = 0; i < datastiles.length; i++) {
            //         if (datastiles[i].id_pendiente === id) {
            //             document.getElementById('id_pendiente3').value = datastiles[i].id_pendiente;
            //         }
            //     }
            // }

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
            })


            var seletscc = ["#b_codigo", "#b_orden", "#b_mes", "#b_fecha", "#b_marca", "#b_nombre",
                "#b_vitola", "#b_capa","#por_pagina"
            ];


            $(document).ready(function() {
                seletscc.forEach(element => {
                    selects(element);
                });
            });

            function selects(nombre) {
                new TomSelect(nombre, {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
            }

            // function mostra_detalles_pendiente_empaque(id) {
            //     // URL de la ruta API con el ID deseado
            //     const apiUrl = `/api/pendiente/empaque/${id}`;

            //     // Realiza una solicitud GET a la ruta API
            //     fetch(apiUrl)
            //         .then(response => {
            //             if (!response.ok) {
            //                 throw new Error('Error en la solicitud.');
            //             }
            //             return response.json();
            //         })
            //         .then(data => {
            //             if (data.estatus === 200) {
            //                 let detalle = JSON.parse(data.data);

            //                 let tabla = `<table class='table'>
            //                 <tr>
            //                     <th>Item</th>
            //                     <th>Descripción</th>
            //                     <th>Mes</th>
            //                 </tr>`;


            //                 tabla = tabla + `<tr>
            //                                 <td>` + detalle.item + `</td>
            //                                 <td>` + detalle.descripcion + `</td>
            //                                 <td>` + detalle.mes + `</td>
            //                             </tr>`;

            //                 tabla = tabla + `</table>`;

            //                 // Mostrar el alert de SweetAlert con la tabla
            //                 Swal.fire({
            //                     title: 'Pendiente Empaque',
            //                     icon: 'info',
            //                     width: 800,
            //                     html: tabla,
            //                     showCloseButton: true,
            //                     showCancelButton: false,
            //                     focusConfirm: false,
            //                     confirmButtonText: '<i class="fa fa-thumbs-up"></i> Great!',
            //                     confirmButtonAriaLabel: 'OK!',
            //                     cancelButtonText: '<i class="fa fa-thumbs-down"></i>',
            //                     cancelButtonAriaLabel: 'Thumbs down'
            //                 });

            //                 @this.dato = 'hola';
            //             } else {
            //                 let text = "El registro no existen en el pendiente de empaque\n¿Deseas agregarlo?";
            //                 if (confirm(text) == true) {
            //                     agregar_detalles_pendiente_empaque(id)
            //                 } else {

            //                 }
            //             }
            //         })
            //         .catch(error => {
            //             Toast.fire({
            //                 icon: 'error',
            //                 title: 'Error: '+error
            //             });
            //         });
            // }

            // function agregar_detalles_pendiente_empaque(id) {
            //     // URL de la ruta API con el ID deseado
            //     const apiUrl = `/api/pendiente/empaque/agregar/${id}`;

            //     // Realiza una solicitud GET a la ruta API
            //     fetch(apiUrl)
            //         .then(response => {
            //             if (!response.ok) {
            //                 throw new Error('Error en la solicitud.');
            //             }
            //             return response.json();
            //         })
            //         .then(data => {
            //             if (data.estatus === 200) {
            //                 let detalle = data.data;

            //                 // Mostrar el alert de SweetAlert con la tabla
            //                 Swal.fire({
            //                     position: 'top-end',
            //                     icon: 'success',
            //                     title: 'Se agrego con exito',
            //                     showConfirmButton: false,
            //                     timer: 1500
            //                 })

            //                 @this.dato = 'hola';
            //             } else {
            //                 Toast.fire({
            //                     icon: 'error',
            //                     title: 'No se agrego'
            //                 });
            //             }
            //         })
            //         .catch(error => {
            //             Toast.fire({
            //                 icon: 'error',
            //                 title: 'Error: '+error
            //             });
            //         });
            // }
        </script>

        <script>
            function buscar_tabla() {
                @this.b_fechas = $(seletscc[3]).val();
                @this.b_ordenes = $(seletscc[1]).val();
                @this.b_codigos = $(seletscc[0]).val();
                @this.b_marcas = $(seletscc[4]).val();
                @this.b_nombres = $(seletscc[5]).val();
                @this.b_vitolas = $(seletscc[6]).val();
                @this.b_capas = $(seletscc[7]).val();
                @this.b_mes = $(seletscc[2]).val();
                @this.por_pagina = $(seletscc[8]).val();
                @this.page = 1;
            }

            // $('#itemn').on('change', function(e) {
            //     var data = $('#itemn').val();
            //     @this.set('codigo_item', data);
            //     @this.agregar_productos();
            // });

            // window.addEventListener('notificacionconfirmacion', event => {
            //     Toast.fire({
            //             icon: 'success',
            //             title: 'La inserción realizada con exito.'
            //     });

            //     var btnCerrar = document.getElementById("cerrar_modal_productos_crear");
            //     btnCerrar.click();
            // })

            // window.addEventListener('notificacionconfirmacionUpdate', event => {
            //     Toast.fire({
            //             icon: 'success',
            //             title: 'Actualización realizada con exito.'
            //         });
            //     var btnCerrar = document.getElementById("boton_cerrar_modal_actualizar");
            //     btnCerrar.click();
            // })

            // window.addEventListener('notificacionErrorUpdate', event => {
            //     Toast.fire({
            //         icon: 'error',
            //         title: 'Hay campos erroneos.\n' + event.detail.mensaje
            //     });
            // })

            // window.addEventListener('notificacionErrorInsert', event => {
            //     Toast.fire({
            //         icon: 'error',
            //         title: 'Hay campos erroneos.\n' + event.detail.mensaje
            //     });
            // })

            // window.addEventListener('notificacionConfirmacionDelete', event => {
            //     Toast.fire({
            //         icon: 'success',
            //         title: 'Se elimino correctamente.'
            //     });
            //     var btnCerrar = document.getElementById("boton_cerrar_modal_eliminar_detalle");
            //     btnCerrar.click();
            // })

            // window.addEventListener('notificacionErrorEjecucion', event => {
            //     Toast.fire({
            //         icon: 'error',
            //         title: 'Excepción: \n' + event.detail.error + "            Item: " + event.detail.mensaje
            //     });
            // })
        </script>
{{--

        <script>
            function eliminar_pendiente() {
                @this.eliminar_pendiente({
                    'id_pendiente3': $('#id_pendiente3').val()
                });
            }

            function guardar_actualizacion() {
                if ($('#id_pendientea2').val() == "" || $('#orden_sistema2').val() == "" || $('#orden2').val() == "" ||
                    $('#pendiente2').val() == "" || $('#saldo2').val() == "") {
                    Toast.fire({
                        icon: 'info',
                        title: 'Hay compos requeridos vacios.'
                    })
                } else {
                    @this.actualizar_pendiente({
                        'id_pendientea2': $('#id_pendientea2').val(),
                        'orden_sistema2': $('#orden_sistema2').val(),
                        'orden2': $('#orden2').val(),
                        'pendiente2': $('#pendiente2').val(),
                        'saldo2': $('#saldo2').val(),
                        'observacion2': $('#observacion2').val()
                    });

                    event.preventDefault();
                }
            }

            function insertar_nuevo_pendiente() {

                if ($('#categoria').val() == "" || $('#itemn').val() == "" ||
                    $('#ordensis').val() == "" ||
                    $('#fechan').val() == "" || $('#ordenn').val() == "" ||
                    $('#pendienten').val() == "" || $('#saldon').val() == "") {

                    Toast.fire({
                        icon: 'info',
                        title: 'Hay compos requeridos vacios.'
                    })

                } else {

                    @this.insertar_nuevo_pendiente({
                        'categoria': $('#categoria').val(),
                        'itemn': $('#itemn').val(),
                        'ordensis': $('#ordensis').val(),
                        'observacionn': $('#observacionn').val(),
                        'fechan': $('#fechan').val(),
                        'ordenn': $('#ordenn').val(),
                        'pendienten': $('#pendienten').val(),
                        'saldon': $('#saldon').val()

                    });

                    $('#categoria').val(""), $('#itemn').val(""), $('#ordensis').val(""), $('#observacionn').val(""), $(
                            '#fechan').val(""), $('#ordenn').val(""), $('#pendienten').val(""), $('#saldon').val(""),

                        event.preventDefault();
                }
            }

            function datos_modal_actualizar(id) {

                var datasss = @this.datos_pendiente;

                for (var i = 0; i < datasss.length; i++) {
                    if (datasss[i].id_pendiente === id) {

                        document.getElementById('id_pendientea2').value = id;


                        document.getElementById("tituloupdate").innerHTML = "".concat(datasss[i].marca, " ", datasss[i]
                            .nombre, " ", datasss[i].capa, " ", datasss[i].vitola);

                        document.getElementById('orden_sistema2').value = datasss[i].orden_del_sitema;

                        document.getElementById('orden2').value = datasss[i].orden;

                        document.getElementById('pendiente2').value = datasss[i].pendiente;

                        document.getElementById('saldo2').value = datasss[i].saldo;

                        document.getElementById('observacion2').value = datasss[i].observacion;
                    }
                }
            }
        </script> --}}
    @endpush
</div>
