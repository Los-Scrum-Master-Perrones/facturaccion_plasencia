<div xmlns:wire="http://www.w3.org/1999/xhtml">
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
                                <button class="btn btn-outline-dark" data-bs-toggle="modal"
                                    data-bs-target="#productos_crear" wire:click='nuevo_pendiente()'>
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
                            <a class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <abbr title="Exportar Reporte del Mes">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-list-check" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                </abbr>
                            </a>
                            <button class="btn btn-outline-warning" wire:click="mostrar_prioridad()">
                                <abbr title="Prioridades">
                                    <img width="20" height="20"
                                        src="https://img.icons8.com/3d-fluency/94/high-priority.png"
                                        alt="high-priority" />
                                </abbr>
                            </button>
                            <button class="btn btn-outline-info" data-bs-toggle="modal"
                                data-bs-target="#modal_subir_moldes">
                                <abbr title="Actualizar Moldes">
                                    <img width="20" height="20"
                                        src="https://img.icons8.com/external-goofy-color-kerismaker/96/external-Mold-bakery-goofy-color-kerismaker.png"
                                        alt="external-Mold-bakery-goofy-color-kerismaker" />
                                </abbr>
                            </button>
                            <button class="btn btn-outline-warning" wire:click="mostrar_sobrantes()">
                                <abbr title="Sobrantes">
                                   <img width="20" height="20" src="https://img.icons8.com/nolan/25/product.png" alt="product"/>
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
                <select onchange="buscar_tabla()" name="b_empresa" id="b_empresa" style="width:100%;height:34px;"
                    name="states[]">
                    <option value="" style="overflow-y: scroll;">Clientes</option>
                    @foreach ($clientes as $client)
                        <option style="overflow-y: scroll;"> {{ $client }}</option>
                    @endforeach
                </select>
            </div>
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
                <select onchange="buscar_tabla()" name="b_color" id="b_color" style="width:100%;height:34px;"
                    name="states[]">
                    <option value="" style="overflow-y: scroll;">Colores</option>
                    @foreach ($colores as $color)
                        <option style="overflow-y: scroll;"> {{ $color }}</option>
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
        <div wire:ignore class="modal fade" id="productos_crear" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="productos_crear" aria-hidden="true"
            style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-lg">
                <!-- INICIO DEL MODAL NUEVO PRODUCTO -->
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="staticBackdropLabel"><strong>Agregar producto</strong></h5>
                        <button type="button" id="cerrar_modal_productos_crear" class="btn btn-close"
                            data-bs-dismiss="modal" aria-label="Close">
                    </div>

                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="txt_figuraytipo" class="form-label">Item</label>
                                    <select name="itemn" id="itemn" style="height:30px; width: 100%;"
                                        class="fs-7" required type="text" autocomplete="off"
                                        onchange="buscar_codigo()">
                                        <option value="">Todos los Codigos</option>
                                        @foreach ($codigos as $codigo)
                                            <option value="{{ $codigo }}">{{ $codigo }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_malos" class="form-label">Presentación</label>
                                    <input class="form-control fs-7" name="presentacionn" id="presentacionn"
                                        wire:model='presentacionn' placeholder="Ingresa figura y tipo"
                                        style="overflow-y: scroll; height:30px;" disabled>
                                </div>

                                <div class="mb-6 col">
                                    <label for="txt_vitola" class="form-label">Marca</label>
                                    <input class="form-control fs-7" style=" height:30px; width: 100%;"
                                        name="marcan" id="marcan" wire:model='marcas_nuevo'
                                        placeholder="Ingresa figura y tipo" disabled>

                                </div>
                            </div>


                            <div class="row">
                                <div class="mb-4 col">
                                    <label for="txt_figuraytipo" class="form-label">Capa</label>
                                    <input class="form-control fs-7" style=" height:30px; width: 100%;"
                                        name="capan" id="capan" wire:model='capas_nuevo'
                                        placeholder="Ingresa figura y tipo" disabled>
                                </div>

                                <div class="mb-4 col">
                                    <label for="vitola" class="form-label">Vitola</label>
                                    <input class="form-control fs-7" style=" height:30px; width: 100%;"
                                        name="vitolan" wire:model='vitolas_nuevo' id="vitolan"
                                        placeholder="Ingresa figura y tipo" disabled>
                                </div>

                                <div class="mb-4 col">
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
                                        class="form-control fs-7" type="text" autocomplete="off"
                                        wire:model.defer='produc_pendiente.orden_sistema'>
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_figuraytipo" class="form-label">Fecha</label>
                                    <input value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" name=" fechan"
                                        id="fechan" style="font-size:12px" class="form-control fs-7" required
                                        type="date" autocomplete="off"
                                        wire:model.defer='produc_pendiente.fecha_recibido'>
                                </div>

                                <div class="mb-6 col">
                                    <label for="txt_figuraytipo" class="form-label">Observacion</label>
                                    <input name="observacionn" id="observacionn" style="font-size:16px"
                                        class="form-control fs-7" type="text" autocomplete="off"
                                        wire:model.defer='observacion'>
                                </div>
                            </div>

                            <div class="row">

                                <div class="mb-3 col">
                                    <label for="txt_total" class="form-label">Pendinte</label>
                                    <input name="paquetes" id="paquetes" class="form-control fs-7" required
                                        type="number" autocomplete="off"
                                        wire:model.defer='produc_pendiente.cantidad'>
                                </div>
                                <div class="mb-3 col">
                                </div>
                                <div class="mb-3 col">
                                </div>
                                <div class="mb-3 col">
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span>Cancelar</span>
                            @csrf
                        </button>
                        <button wire:click="registrar_pendiente()" class="btn btn-success"> <span>Guardar</span>
                        </button>
                    </div>
                </div>

            </div>
            <!-- FIN DEL MODAL NUEVO PRODUCTO -->
        </div>
    @endif
    <br>
    <div class="panel-body">
        <div
            style="width:100%; padding-left:0px;  font-size:9px;   overflow-x: display; overflow-y: auto; height:75%;">
            <table class="table table-light table-hover" style="font-size:9px;" id="tabla_pendiente">
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
                        <th>COLOR</th>
                        <th>PRIORIDAD</th>
                        <th>PEND. PRIORIDAD</th>
                        <th>PENDIENTE</th>
                        <th>PRODUCIDO</th>
                        <th>@if($sobrante) SOBRANTES @else RESTANTE @endif </th>
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
                        $moldes_nesarios_base10 = 0;
                        $moldes_exitentea = 0;
                        $moldes_sin_molde = 0;
                    @endphp
                    @foreach ($pendiente as $i => $detalle)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $detalle->codigo }}</td>
                            <td>{{ $detalle->orden_sistema }}</td>
                            <td>{{ $detalle->fecha_recibido }}</td>
                            @php
                                $fecha_recibido = new DateTime($detalle->fecha_recibido);
                                $fecha_actual = new DateTime();

                                $intervalo = new DateInterval('P1D'); // Intervalo de 1 día
                                $periodo = new DatePeriod($fecha_recibido, $intervalo, $fecha_actual);

                                $dias_habiles = 0;

                                foreach ($periodo as $fecha) {
                                    $dia_semana = $fecha->format('N'); // 1 (lunes) a 7 (domingo)

                                    // Excluir sábado (6) y domingo (7)
                                    if ($dia_semana != 6 && $dia_semana != 7) {
                                        $dias_habiles++;
                                    }
                                }
                                $diferencia_dias = $dias_habiles;
                            @endphp
                            <td>{{ $diferencia_dias }}</td>
                            <td>{{ $detalle->observacion }}</td>
                            <td>{{ $detalle->presentacion }}</td>
                            <td>{{ $detalle->mes }}</td>
                            <td style="width:200px">{{ $detalle->marca }}</td>
                            <td>{{ $detalle->nombre }}</td>
                            <td>{{ $detalle->vitola }}</td>
                            <td>{{ $detalle->capa }}</td>
                            <td>{{ $detalle->color }}</td>
                            <td class="text-center">
                                @if ($detalle->prioridad > 0)
                                    @if ($detalle->prioridad_completo > 0)
                                        <div class="alert alert-danger text-center" role="alert">
                                            <b>{{ $detalle->prioridad }}</b></div>
                                    @else
                                        <div class="alert alert-success text-center" role="alert">
                                            <b>{{ $detalle->prioridad }}</b></div>
                                    @endif
                                @else
                                    {{ $detalle->prioridad }}
                                @endif
                            </td>
                            <td style="text-align:right;color: red">{{ $detalle->pendiente_prioridad<= 0? 'Completado':$detalle->pendiente_prioridad  }}</td>
                            <td style="text-align:right;">{{ $detalle->pendiente }}</td>
                            <td style="text-align:right;">{{ $detalle->pendiente - $detalle->restantes }}
                                @php
                                    $porcentaje = (($detalle->pendiente - $detalle->restantes) / $detalle->pendiente) * 100;
                                @endphp
                                <div class="progress">
                                    <div class="progress-bar @if ($porcentaje < 25) bg-danger @endif

                                    @if ($porcentaje >= 25 && $porcentaje < 50) bg-warning @endif

                                    @if ($porcentaje >= 50 && $porcentaje < 75) bg-info @endif

                                    @if ($porcentaje >= 75 && $porcentaje <= 100) bg-success @endif
                                    "
                                        role="progressbar" style="width: {{ $porcentaje }}%;"
                                        aria-valuenow="{{ $porcentaje }}" aria-valuemin="0" aria-valuemax="100"
                                        style="color: black">
                                        {{ number_format($porcentaje, 0) }}%
                                    </div>
                                </div>
                            </td>
                            <td style="text-align:right;">@if($sobrante) {{ -1*$detalle->restantes }} @else {{ $detalle->restantes }} @endif </td>
                            <td style="text-align:right;">{{ $detalle->precio_rolero }}</td>
                            <td style="text-align:right;">{{ $detalle->precio_bonchero }}</td>



                            @if (auth()->user()->rol == -1)
                            @else
                                <td style="width:120px; text-align: center">
                                    @if (isset($historial[$detalle->id]))
                                        <a href="#" onclick='mostrar_historial({{ $detalle->id }})'>
                                            <abbr title="Historial de Precios">
                                                <img width="16" height="16" fill="currentColor"
                                                    src="https://img.icons8.com/ios/50/time-machine--v1.png"
                                                    alt="time-machine--v1" />
                                            </abbr>
                                        </a>
                                    @endif

                                    <a style="text-decoration: none" onclick="enviar_produccion({{ $detalle->id }})"
                                        href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            fill="currentColor" class="bi bi-send-arrow-down-fill"
                                            viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M15.854.146a.5.5 0 0 1 .11.54L13.026 8.03A4.5 4.5 0 0 0 8 12.5c0 .5 0 1.5-.773.36l-1.59-2.498L.644 7.184l-.002-.001-.41-.261a.5.5 0 0 1 .083-.886l.452-.18.001-.001L15.314.035a.5.5 0 0 1 .54.111ZM6.637 10.07l7.494-7.494.471-1.178-1.178.471L5.93 9.363l.338.215a.5.5 0 0 1 .154.154l.215.338Z" />
                                            <path fill-rule="evenodd"
                                                d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.354-1.646a.5.5 0 0 1-.722-.016l-1.149-1.25a.5.5 0 1 1 .737-.676l.28.305V11a.5.5 0 0 1 1 0v1.793l.396-.397a.5.5 0 0 1 .708.708l-1.25 1.25Z" />
                                        </svg>
                                    </a>
                                    @if ($porcentaje > 0)
                                    @else
                                        <a style="text-decoration: none"
                                            onclick="datos_modal_eliminar({{ $detalle->id }})" href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                            </svg>
                                        </a>
                                    @endif
                                    <a style="text-decoration: none" data-bs-toggle="modal" href="#"
                                        data-bs-target="#modal_actualizar"
                                        onclick="editar_pendiente({{ $detalle->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </a>

                                    <button type="button" class="btn btn-sm  @if(isset($materiales[$detalle->id_producto])) btn-primary @else  btn-danger @endif dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#collapseExample{{ $i }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-list-check" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                                        </svg>
                                    </button>
                                </td>
                            @endif
                        </tr>
                        @if(isset($materiales[$detalle->id_producto]))
                        <tr>
                            <td colspan="11"></td>
                            <td colspan="6">
                                <div class="collapse" id="collapseExample{{ $i }}">
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-sm-6">Material</div>
                                            <div class="col-sm-2">Base</div>
                                            <div class="col-sm-2">ONZ</div>
                                            <div class="col-sm-2">LBS</div>
                                        </div>
                                        @foreach ($materiales[$detalle->id_producto] as $molde)
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a href="#" style="text-decoration: none" wire:click="eliminar_material({{ $molde->id }},2)">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                            <path
                                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                        </svg>
                                                    </a>
                                                    {{  $molde->nombre_material }} </div>
                                                @php
                                                    $arr = explode(' ',trim($molde->onza));
                                                @endphp
                                                <div class="col-sm-2" style="color: red; font-weight: bold; font-size: 10px">{{  '('.$molde->onza.')'  }} </div>
                                                <div class="col-sm-2">{{  number_format((intval($arr[0])/100)*$detalle->restantes,0,',','')  }} </div>
                                                <div class="col-sm-2">{{  number_format(((intval($arr[0])/100)*$detalle->restantes)/16,2,',','')  }} </div>
                                            </div>
                                        @endforeach
                                            <div class="row">
                                                <div class="col-sm-12 text-center">
                                                    <a style="text-decoration: none" data-bs-toggle="modal" href="#" data-bs-target="#modal_agreagr_material" onclick="agregar_material({{ $detalle->id_producto }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </td>
                            <td colspan="4"></td>
                        </tr>
                        @else
                        <tr>
                            <td colspan="11"></td>
                            <td colspan="6">
                                <div class="collapse" id="collapseExample{{ $i }}">
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-sm-6">Material</div>
                                            <div class="col-sm-2">Base</div>
                                            <div class="col-sm-2">ONZ</div>
                                            <div class="col-sm-2">LBS</div>
                                        </div>
                                        <div class="row">
                                                <div class="col-sm-12 text-center">
                                                    <a style="text-decoration: none" data-bs-toggle="modal" href="#" data-bs-target="#modal_agreagr_material" onclick="agregar_material({{ $detalle->id_producto }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td colspan="4"></td>
                        </tr>

                        @endif
                        @php
                            $sumas = $sumas + $detalle->restantes;
                            // $sumaprecio_dolar += $datos->precio_dolares;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="input-group" style="width:40%; position: fixed;right: 0px;bottom:0px; height:30px;">
        <span class="form-control input-group-text fs-7">Total pendiente</span>
        <input type="text" class="form-control fs-7" id="sumap" value="{{ number_format($sumas, 0) }}">
    </div>

    <form action="{{ route('produccion.reporte.diario') }}" method="GET">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Reportes</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <input type="date" class="form-control" name="fecha"
                                value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal" wire:click='imprimir_pendiente_por_producir(1)'>Pendiente</button>
                            </div>
                            <div class="col-md-4 text-center">
                                <button type="button" class="btn btn-info" data-bs-dismiss="modal" wire:click='imprimir_pendiente_por_producir(2)'>Materiales</button>
                            </div>
                            <div class="col-md-4 text-center">
                                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Mat. Por Tipo</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Exportar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form wire:submit.prevent="importMoldes">
        <div wire:ignore class="modal fade" id="modal_subir_moldes" tabindex="-1"
            aria-labelledby="modal_subir_moldesLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modal_subir_moldesLabel">Actualizar moldes</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="file" class="form-control" name="moldes" wire:model="select_file">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Subir</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- INICIO MODAL ACTUALIZAR DATO PENDIENTE -->
    <div wire:ignore class="modal fade" role="dialog" id="modal_actualizar" data-backdrop="static"
        data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
        style="opacity:.9;background:#212529;width=800px;">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="opacity:.9;background:#212529;width=80%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="staticBackdropLabel">
                        <strong>Descripción del producto: </strong><span id="tituloupdate" name="tituloupdate"></span>
                    </h5>
                    <button id='boton_cerrar_modal_actualizar' type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input name="id_pendientea2" id="id_pendientea2" value="" hidden />
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Orden del sistema</label>
                            <input name="orden_sistema2" id="orden_sistema2" class="form-control" type="text"
                                wire:model.defer='produc_pendiente.orden_sistema' autocomplete="off">
                        </div>
                        <div class="mb-3 col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Pendiente</label>
                            <input name="pendiente2" id="pendiente2" class="form-control" type="text"
                                wire:model.defer='produc_pendiente.cantidad' autocomplete="off">
                        </div>
                        <div class="mb-3 col">

                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Observación</label>
                            <input name="observacion2" id="observacion2" class="form-control" type="text"
                                wire:model.defer='produc_pendiente.observacion' autocomplete="off">
                        </div>
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Prioridad</label>
                            <input name="prioridad" id="prioridad" class="form-control" type="text"
                                wire:model.defer='produc_pendiente.prioridad' autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">
                        <span>Cancelar</span>
                    </button>
                    <button type="button" class="btn btn-success" wire:click="registrar_pendiente()">
                        <span>Actualizar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL ACTUALIZAR DATO PENDIENTE -->

    <!-- INICIO MODAL ELMINAR DATO PENDIENTE -->
    {{-- <div class="modal fade" id="modal_eliminar_detalle" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Eliminar <strong><input value="" id="txt_usuarioE"
                                name="txt_usuarioE" style="border:none;"></strong> </h5>
                    <button id="boton_cerrar_modal_eliminar_detalle" type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
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
    <div wire:ignore class="modal fade" id="modal_agreagr_material" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buscar por material</h5>
                    <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text" hidden id="idproducto">
                            <label for="txt_figuraytipo" class="form-label">Codigos</label>
                            <select name="codigon" id="codigon" style="height:30px; width: 100%;"
                                class="fs-7" required type="text" autocomplete="off">
                                <option value="">Todos los materiales</option>
                                @foreach ($datos_codigo as $codiog)
                                    <option value="{{ $codiog->nombre_material }}">{{ $codiog->nombre_material }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="txt_figuraytipo" class="form-label">Peso</label>
                            <input class="form-control" type="number" name="peso" id="peso">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" id="boton_cerrar_buscar" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                    <button type="button" class="btn btn-success" onclick="asinar_material()">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">

            var historial = @json($historial);
            var control_producto;

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


            var seletscc = ["#b_codigo", "#b_orden", "#b_mes", "#b_fecha", "#b_marca", "#b_nombre", "#b_vitola", "#b_capa",
                "#por_pagina", "#itemn", "#b_color","#b_empresa"
            ];


            $(document).ready(function() {
                seletscc.forEach(element => {
                    selects(element);
                });


                control_producto = new TomSelect('#codigon', {
                    create: true,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
            });

            function selects(nombre) {
                new TomSelect(nombre, {
                    create: true,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
            }

            function datos_modal_eliminar(id) {
                var datastiles = @this.datos_pendiente;
                for (var i = 0; i < datastiles.length; i++) {
                    if (datastiles[i].id_pendiente === id) {
                        document.getElementById('id_pendiente3').value = datastiles[i].id_pendiente;
                    }
                }
            }
            function editar_pendiente(id) {
                @this.editar_pendiente(id);
            }


            async function enviar_produccion(id) {
                const {
                    value: formValues
                } = await Swal.fire({
                    title: '<strong>Enviar <u>Produccion</u></strong>',
                    icon: 'info',
                    html: `<div class="container">
                            <div class="row">
                                <div class="col">
                                    <select class="form-control" name="destino" id="destino">
                                        <option value="Moroceli">Moroceli</option>
                                        <option value="San Marcos">San Marcos</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <input  class="form-control" type="number" name="cantidad" id="cantidad">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <input  class="form-control" type="date" name="fecha" id="fecha">
                                </div>
                            </div>
                        </div>`,
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonText: 'Enviar',
                    confirmButtonAriaLabel: 'Thumbs up, great!',
                    cancelButtonText: 'Cancelar',
                    cancelButtonAriaLabel: 'Thumbs down',
                    preConfirm: () => {
                        return [
                            id, document.getElementById('destino').value, document.getElementById(
                                'cantidad').value, document.getElementById('fecha').value
                        ]
                    }
                })

                if (formValues) {
                    @this.enviar_produccion(formValues);
                }

            }

            window.addEventListener('notificacionEnvioExitoso', event => {
                Toast.fire({
                    icon: 'success',
                    title: 'Envio realizada con exito.'
                });
            })


            function mostrar_historial(key) {

                var datos = historial[key];


                let html = `<div class="lineatemp">`;

                datos.forEach(e => {

                    html += `<div class="fila">
                            <div class="disco"></div>
                            <div>${e.fecha_salida}</div>
                            <div>${e.destino}</div>
                            <div>${e.cantidad}</div>
                        </div>`

                });



                html += `</div>`;

                Swal.fire({
                    title: '<strong>Historial de Salidas</strong>',
                    html: html,
                    width: 800,
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText: '<i class="fa fa-thumbs-up"></i>Great!',
                    confirmButtonAriaLabel: 'Thumbs up, great!',
                    cancelButtonText: '<i class="fa fa-thumbs-down"></i>',
                    cancelButtonAriaLabel: 'Thumbs down'
                })
            }

            function agregar_material(idproducto) {
                document.getElementById('idproducto').value = idproducto;
            }

            function asinar_material() {
                @this.asinar_material(control_producto.getValue(),$('#idproducto').val(),$('#peso').val());
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
                @this.b_color = $('#b_color').val();
                @this.cliente = $(seletscc[11]).val();
                @this.page = 1;
            }

            function buscar_codigo() {
                @this.buscarProducto($(seletscc[9]).val());
            }


            window.addEventListener('notificacionRegistroExitoso', event => {
                Toast.fire({
                    icon: 'success',
                    title: 'Registro realizada con exito.'
                });

                var btnCerrar = document.getElementById("cerrar_modal_productos_crear");
                btnCerrar.click();

                var btnCerrar2 = document.getElementById("boton_cerrar_modal_actualizar");
                btnCerrar2.click();
            })


            // $('#itemn').on('change', function(e) {
            //     var data = $('#itemn').val();
            //     @this.set('codigo_item', data);
            //     @this.agregar_productos();
            // });

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
