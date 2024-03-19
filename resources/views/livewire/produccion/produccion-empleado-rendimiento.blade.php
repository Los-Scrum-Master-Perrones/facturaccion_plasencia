<div>
    <div style="height: 0.8rem;" role="status">
        <div wire:loading style="width: 100%;" role="status">
            <span class="loader"></span>
        </div>
    </div>

    <div class="container" style="max-width:100%;">
        <div class="card" style="padding:0px;height: 85%;">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-1" wire:ignore >
                        <label for="">Tarea Promedio</label>
                        <input class="form-control" type="text" name="" id="" wire:model="tarea_promedio">
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
                            <span class="input-group-text" id="basic-addon1" style="height: 30px;font-size: 0.7em">Por
                                Pagina</span>
                            <select class="form-control fs-7" style="height: 30px;" name="week" wire:model='fechas'>
                                @for ($week = 1; $week <= 52; $week++)
                                    @php
                                        date_default_timezone_set('America/Mexico_City');
                                        $startOfWeek = \Carbon\Carbon::now()
                                            ->startOfYear()
                                            ->addWeeks($week - 1);
                                        $endOfWeek = \Carbon\Carbon::now()->startOfYear()->addWeeks($week)->subDay();
                                    @endphp
                                    <option
                                        value="{{ $startOfWeek->format('Y-m-d') . ' ' . $endOfWeek->format('Y-m-d') }}">
                                        {{ $startOfWeek->format('M d, Y') }} - {{ $endOfWeek->format('M d, Y') }}
                                    </option>
                                @endfor
                            </select>
                            <button class="btn btn-primary" wire:click='exportar_reporte()' style="height: 30px">
                                <abbr title="Porcentaje Produccion">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-clipboard2-check-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5Z" />
                                        <path
                                            d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585c.055.156.085.325.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5c0-.175.03-.344.085-.5Zm6.769 6.854-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708Z" />
                                    </svg>
                                </abbr>
                            </button>
                            <button class="btn btn-warning" wire:click='elimnar_guardado()' style="height: 30px">
                                <abbr title="Eliminar guardado">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                    </svg>
                                </abbr>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div wire:loading.class='oscurecer_contenido'
                            style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;  height:70vh;">
                            <table class="table table-light table-hover" style="font-size:10px;">
                                <thead>
                                    <tr>
                                        <th>N#</th>
                                        <th>Codigo</th>
                                        <th>Empleados</th>
                                        <th>Produccion (L)</th>
                                        <th>TAREA PROMEDIO</th>
                                    </tr>
                                </thead>
                                <tbody name="body" id="body">
                                    @php
                                        $sumas = 0;
                                        $sumas3 = 0;
                                    @endphp
                                    @foreach ($produccion as $id => $producto)
                                        <tr>
                                            <td>{{ ++$id }}</td>
                                            <td class="text-center">{{ $producto->codigo }}</td>
                                            <td class="text-center">{{ $producto->nombre }}</td>
                                            <td class="text-center">{{ $producto->total }}</td>
                                            <td class="text-center">{{ $tarea_promedio }}</td>
                                            @php
                                                $sumas += $producto->total;
                                                $sumas3 += $tarea_promedio;
                                            @endphp
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div wire:loading.class='oscurecer_contenido'
                            style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;  height:70vh;">
                            <table class="table table-light table-hover" style="font-size:10px;">
                                <thead>
                                    <tr>
                                        <th>N#</th>
                                        <th>CODIGO</th>
                                        <th>PRESENTACION</th>
                                        <th>MARCA</th>
                                        <th>NOMBRE</th>
                                        <th>VITOLA</th>
                                        <th>CAPA</th>
                                        <th>TAREA ASIGNADA</th>

                                    </tr>
                                </thead>
                                <tbody name="body" id="body">
                                    @php
                                        $sumas2 = 0;
                                    @endphp
                                    @foreach ($planificado_semana as $id => $producto)
                                        <tr>
                                            <td>{{ ++$id }}</td>
                                            <td class="text-center">{{ $producto->codigo }}</td>
                                            <td class="text-center">{{ $producto->presentacion }}</td>
                                            <td class="text-center">{{ $producto->marca }}</td>
                                            <td class="text-center">{{ $producto->nombre }}</td>
                                            <td class="text-center">{{ $producto->vitola }}</td>
                                            <td class="text-center">{{ $producto->capa }}</td>
                                            <td class="text-center">{{ $producto->tarea_acumulada }}</td>
                                            @php
                                                $sumas2 += $producto->tarea_acumulada;
                                            @endphp
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="input-group" style="width:40%; position: fixed;right: 0px;bottom:0px; height:30px;">
        <span class="form-control input-group-text">Total Producido</span>
        <input type="text" class="form-control" id="sumas" value="{{ number_format($sumas) }}">

        <span class="form-control input-group-text">Total Tareas</span>
        <input type="text" class="form-control" id="sumas" value="{{ number_format(($sumas2*5)) }}">


        <span class="form-control input-group-text">Total Promedio</span>
        <input type="text" class="form-control" id="sumas" value="{{ number_format($sumas3*5) }}">
    </div>
</div>
