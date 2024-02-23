<div>
    <div class="container" style="max-width:100%;">
        <div class="card" style="padding:0px;height: 85%;">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-1" wire:ignore style="height: 30px">
                        <div wire:loading>
                            <button id="btn_guardar" class="btn btn-outline-purpura" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </button>
                        </div>

                    </div>
                    <div class="col-md-3">

                    </div>

                    <div class="col-md-2">

                    </div>
                    <div class="col-md-3" wire:ignore style="height: 30px">
                        <input type="checkbox" autocomplete="off" wire:model='b_presentacion1' value='Tripa Larga'>
                        <label for="success-outlined">Tripa Larga</label>

                        <input type="checkbox" autocomplete="off" wire:model='b_presentacion2' value='Tripa Corta'>
                        <label for="danger-outlined">Tripa Corta</label>

                        <input type="checkbox" autocomplete="off" wire:model='b_presentacion3' value='Brocha'>
                        <label for="danger-outlined">Brocha</label>

                        <input type="checkbox" autocomplete="off" wire:model='b_presentacion4' value='Sandwich'>
                        <label for="danger-outlined">Sandwich</label>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group mb-3" style="height: 30px; width: 100%">
                            <span class="input-group-text" id="basic-addon1" style="height: 30px;font-size: 0.7em">Por Pagina</span>
                            <select class="form-control fs-7" style="height: 30px;" name="week" wire:model='fechas'>
                                @for ($week = 1; $week <= 52; $week++)
                                    @php
                                        date_default_timezone_set('America/Mexico_City');
                                        $startOfWeek = \Carbon\Carbon::now()->startOfYear()->addWeeks($week - 1);
                                        $endOfWeek = \Carbon\Carbon::now()->startOfYear()->addWeeks($week)->subDay();
                                    @endphp
                                    <option value="{{ $startOfWeek->format('Y-m-d').' '.$endOfWeek->format('Y-m-d'); }}">{{ $startOfWeek->format('M d, Y') }} - {{ $endOfWeek->format('M d, Y') }}</option>
                                @endfor
                            </select>
                            <button class="btn btn-primary" wire:click='imprimir_reporte_planilla' style="height: 30px">
                                <abbr title="Planilla">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-clipboard2-check-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5Z" />
                                        <path
                                            d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585c.055.156.085.325.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5c0-.175.03-.344.085-.5Zm6.769 6.854-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708Z" />
                                    </svg>
                                </abbr>
                            </button>
                            <button class="btn btn-danger" style="height: 30px" data-bs-toggle="modal" data-bs-target="#modal_eliminar_produccuin" >
                                <abbr title="Eliminar por Fecha">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path
                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                    </svg>
                                </abbr>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div wire:loading.class='oscurecer_contenido'
                    style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;  height:70vh;">
                    <table class="table table-light table-hover" style="font-size:10px;">
                        <thead>
                            <tr>
                                <th>N#</th>
                                <th wire:ignore>
                                    {{-- <select name="b_orden" id="b_orden" onchange="buscar_io()">
                                        <option value="">ORDEN</option>
                                        @foreach ($ordenes as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select> --}}
                                </th>
                                <th>FECHA</th>
                                <th wire:ignore>
                                    {{-- <select name="b_codigo_empleado" id="b_codigo_empleado" onchange="buscar_io()">
                                        <option value="">Codigo</option>
                                        @foreach ($codigos_empleado as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select> --}}
                                </th>
                                <th wire:ignore>
                                    {{-- <select name="b_nombre_empleado" id="b_nombre_empleado" onchange="buscar_io()">
                                        <option value="">Empleado</option>
                                        @foreach ($nombres_empleado as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select> --}}
                                </th>
                                <th wire:ignore>
                                    {{-- <select name="b_codigo" id="b_codigo" onchange="buscar_io()">
                                        <option value="">CODIGO PRODUCTO</option>
                                        @foreach ($codigos_producto as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select> --}}
                                </th>
                                <th wire:ignore>
                                    PRESENTACION
                                </th>
                                <th style="width:100px;" wire:ignore>
                                    {{-- <select name="b_marca" id="b_marca" onchange="buscar_io()">
                                        <option value="">MARCA</option>
                                        @foreach ($marcas as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select> --}}
                                </th>
                                <th wire:ignore>
                                    {{-- <select name="b_nombre" id="b_nombre" onchange="buscar_io()">
                                        <option value="">NOMBRE</option>
                                        @foreach ($nombres as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select> --}}
                                </th>
                                <th wire:ignore>
                                    {{-- <select name="b_vitola" id="b_vitola" onchange="buscar_io()">
                                        <option value="">VITOLA</option>
                                        @foreach ($vitolas as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select> --}}
                                </th>
                                <th wire:ignore>
                                    {{-- <select name="b_capa" id="b_capa" onchange="buscar_io()">
                                        <option value="">CAPA</option>
                                        @foreach ($capas as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select> --}}
                                </th>
                                <th>CANTIDAD</th>
                                <th>CANTIDAD (L)</th>
                                <th>OPERACION</th>
                            </tr>
                        </thead>
                        <tbody name="body" id="body">
                            @php
                                $sumas = 0;
                            @endphp
                            @foreach ($produccion as $id => $producto)
                                <tr>
                                    <td>{{ ++$id }}</td>
                                    <td class="text-center">{{ $producto->codigo }}</td>
                                    <td class="text-center">{{ $producto->nombre }}</td>
                                    <td class="text-center">{{ $producto->total }}</td>

                                    @php
                                        $sumas += $producto->total;
                                    @endphp
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="input-group" style="width:30%; position: fixed;right: 0px;bottom:0px; height:30px;">
        <span class="form-control input-group-text">Total</span>
        <input type="text" class="form-control" id="sumas" value="{{ number_format($sumas) }}">

        {{-- <span class="form-control input-group-text">Total (L.)</span>
        <input type="text" class="form-control" id="sumas" value="{{ number_format($sumasLempiras, 2) }}"> --}}
    </div>
</div>
