<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <ul class="nav justify-content-center">
        @if (auth()->user()->rol == 0 || auth()->user()->rol == 1)
            @if (auth()->user()->rol == -1)
            @else
                <li class="nav-item">
                    <a class="nav-link active fs-7" aria-current="page"
                        href="pendiente_empaque"><strong>Pendiente</strong></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-7" href="importar_c"><strong>Existencia en bodega</strong></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-7" href="{{ route('inventario_cajas') }}"><strong>Existencia de
                            cajas</strong></a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link fs-7" href="historial_programacion"><strong>Programaciones</strong></abbr>
                </a>
            </li>
        @else
            <br>
        @endif
    </ul>

    <script>
        window.addEventListener('error_vista_pendiente_empaque', event => {
            alert('Name updated to: ' + event.detail.newName);
        })
    </script>

    <div class="container" style="max-width:100%; " @if ($ventanas != 2) hidden @endif>

        <div class="row" style="text-align:center;">

            <div class="col">
                <div class="input-group mb-3">
                    <div wire:loading>
                        <button id="btn_guardar" class="mr-sm-2 botonprincipal" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </div>
                    <div wire:loading.attr="hidden">
                        <a type="button" name="crear_programacion" id="crear_programacion"
                            wire:click.prevent="cambio(1)" class=" botonprincipal   mr-sm-2" value=""
                            style="width:70px; " href="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-reply-all-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8.021 11.9 3.453 8.62a.719.719 0 0 1 0-1.238L8.021 4.1a.716.716 0 0 1 1.079.619V6c1.5 0 6 0 7 8-2.5-4.5-7-4-7-4v1.281c0 .56-.606.898-1.079.62z" />
                                <path
                                    d="M5.232 4.293a.5.5 0 0 1-.106.7L1.114 7.945a.5.5 0 0 1-.042.028.147.147 0 0 0 0 .252.503.503 0 0 1 .042.028l4.012 2.954a.5.5 0 1 1-.593.805L.539 9.073a1.147 1.147 0 0 1 0-1.946l3.994-2.94a.5.5 0 0 1 .699.106z" />
                            </svg>
                        </a>
                    </div>


                    <input name="buscar" id="buscar" class="  form-control  mr-sm-2" wire:model="busqueda"
                        placeholder="Búsqueda por Marca, Nombre y Vitola" style="width:350px;">

                    <button onclick="mostrarMaterial(true)" type="button"
                        class="botonprincipal @if ($materiales) btn-success
                    @else @endif"
                        style="width:100px;height: 35;border-radius: 20%">Progra. con <br>Materiales</button>
                    <button onclick="mostrarMaterial(false)" type="button"
                        class="botonprincipal @if ($materiales) @else
                        btn-success @endif"
                        style="width:100px;height: 35;border-radius: 20%">Progra. sin <br>Materiales</button>

                    <button class="botonprincipal" onclick="exportarMaterial()" type="button"
                        style="width:100px;height: 35;border-radius: 20%">Materiales <br> Exportar </button>

                    <form wire:submit.prevent="exportProgramacion()">
                        <button class="botonprincipal" type="submit" style="width:100px;">Exportar</button>
                    </form>
                    <form method="GET" action="{{ route('exportar_materia') }}">
                        <button class="botonprincipal" type="submit" style="width:120px;">Actualizar(Mat.)</button>
                    </form>
                    @if (auth()->user()->rol == 0 || auth()->user()->rol == 1)
                        <button type=" button" onclick="guardar_programacion()" class=" botonprincipal "
                            style="width:auto;"> Crear programación
                        </button>
                    @endif

                </div>
            </div>
        </div>

        <div wire:change='tama' id="tabla_materiales2" class="table-responsive">
            <div wire:loading.class='oscurecer_contenido' style="width:100%; padding-left:0px; height:100%;">

                <table class="table table-light table-hover" id="editable" style="font-size:10px;">
                    <thead>
                        <tr style="text-align:center;">
                            <th># ORDEN</th>
                            <th style=" text-align:center;">ORDEN</th>
                            <th style=" text-align:center;">ITEM</th>
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
                            <th style=" text-align:center;">EXISTENCIA(P)</th>
                            <th style=" text-align:center;">SOB/FAL</th>
                            <th style=" text-align:center;">CAJAS</th>
                            <th style=" text-align:center;">EN EXISTENCIA(C)</th>
                            <th style=" text-align:center;">SOB/FAL</th>
                            @if (auth()->user()->rol == 0 || auth()->user()->rol == 1)
                                <th style=" text-align:center;">OPERACIONES</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $existencia_actual = 0;
                            $pendiente_restante = 0;

                            $total_materiales = 0;
                        @endphp
                        @foreach ($detalles_provicionales as $detalle_provicional)
                            <tr>
                                <td>{{ $detalle_provicional->numero_orden }}</td>
                                <td>{{ $detalle_provicional->orden }}</td>
                                <td>{{ $detalle_provicional->item }}</td>
                                <td>{{ $detalle_provicional->cod_producto }}</td>
                                <td>{{ $detalle_provicional->marca }}</td>
                                <td>{{ $detalle_provicional->vitola }}</td>
                                <td>{{ $detalle_provicional->nombre }}</td>
                                <td>{{ $detalle_provicional->capa }}</td>
                                <td>{{ $detalle_provicional->tipo_empaque }}</td>
                                <td>{{ $detalle_provicional->anillo }}</td>
                                <td>{{ $detalle_provicional->cello }}</td>
                                <td>{{ $detalle_provicional->upc }}</td>
                                <td>{{ intval($detalle_provicional->saldo) }}</td>
                                <td>{{ intval($detalle_provicional->existencia_puros) }}</td>
                                @if (intval($detalle_provicional->cantidad_sobrante_puros) < 0)
                                    <td style="color: red">
                                        {{ 'Faltan ' . intval($detalle_provicional->cantidad_sobrante_puros) }}</td>
                                @endif
                                @if (intval($detalle_provicional->cantidad_sobrante_puros) > 0)
                                    <td style="color: rgb(119, 0, 255)">
                                        {{ 'Sobran ' . intval($detalle_provicional->cantidad_sobrante_puros) }}</td>
                                @endif
                                @if (intval($detalle_provicional->cantidad_sobrante_puros) == 0)
                                    <td>{{ intval($detalle_provicional->cantidad_sobrante_puros) }}</td>
                                @endif
                                <td>{{ intval($detalle_provicional->cant_cajas) }}</td>
                                <td>{{ intval($detalle_provicional->existencia_cajas) }}</td>
                                @if (intval($detalle_provicional->cantida_sobrante) < 0)
                                    <td style="color: red">
                                        {{ 'Faltan ' . intval($detalle_provicional->cantida_sobrante) }}</td>
                                @endif
                                @if (intval($detalle_provicional->cantida_sobrante) > 0)
                                    <td style="color: rgb(119, 0, 255)">
                                        {{ 'Sobran ' . intval($detalle_provicional->cantida_sobrante) }}</td>
                                @endif
                                @if (intval($detalle_provicional->cantida_sobrante) == 0)
                                    <td>{{ intval($detalle_provicional->cantida_sobrante) }}</td>
                                @endif


                                @if (auth()->user()->rol == 0 || auth()->user()->rol == 1)
                                    <td style="text-align:center">

                                        <a onclick="eliminar_detalle_prgramacion({{ $detalle_provicional->id }})"
                                            href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" clcass="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                            </svg>
                                        </a>

                                        <a style=" width:10px; height:10px;" href="#"
                                            onclick="editar_saldo({{ $detalle_provicional->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
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

                            @if ($materiales)
                                @php
                                    $detalles_materiale = DB::select('call traer_materiales_temporal(?)', [$detalle_provicional->id]);
                                @endphp
                                @foreach ($detalles_materiale as $materiale)
                                    <tr>
                                        <th colspan="3"></th>
                                        <td colspan="6">
                                            {{ '(' . $materiale->codigo_material . ') ' . $materiale->des_material }}</td>
                                        <th></th>
                                        <th></th>
                                        <td>{{ $materiale->cantidad_m }}</td>
                                        <td>{{ $materiale->existencia_material }}</td>
                                        @if ($materiale->restante < 0)
                                            <td style="color: red">{{ 'Faltan ' . $materiale->restante }}</td>
                                        @endif
                                        @if ($materiale->restante > 0)
                                            <td style="color: rgb(119, 0, 255)">{{ 'Sobran ' . $materiale->restante }}
                                            </td>
                                        @endif
                                        @if ($materiale->restante == 0)
                                            <td>{{ $materiale->restante }}</td>
                                        @endif
                                        <th colspan="3"></th>
                                    </tr>
                                    @php
                                        $total_materiales += $materiale->cantidad_m;
                                    @endphp
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <br>
        <div class="input-group" style="width:40%;position: fixed;right: 0px;bottom:0px; height:30px;">
            <span class="form-control input-group-text">Total Materiales</span>
            <input type="text" class="form-control" value="{{ $total_materiales }}">
            <span class="form-control input-group-text">Total Programacion</span>
            <input type="text" class="form-control" wire:model="total_saldo">
        </div>
    </div>

    <div @if ($ventanas == 2) hidden @endif>
        <div class="container" style="max-width:100%; ">
            <div class="row" style="margin-bottom:2px">
                @if (auth()->user()->rol == -1)
                @else
                    <div class="col">
                        <div class="row">
                            <div class="btn-group" style="height: 35px;" role="group"
                                aria-label="Basic mixed styles example">
                                @if (auth()->user()->rol == 0 || auth()->user()->rol == 1)
                                    <button class="btn btn-outline-dark" onclick="agregar_a_programacion()">
                                        <abbr title="Agregar a Programación">
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
                                <button wire:loading.attr.remove='hidden' id="btn_guardar"
                                    class="btn btn-outline-danger" hidden disabled>
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                </button>
                                <button wire:loading.attr="hidden" id="btn_guardar" class="btn btn-outline-danger"
                                    wire:click.prevent="cambio(2)">
                                    <abbr title="Revisar Programacion actual">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                            <path
                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            fill="currentColor" class="bi bi-list-check" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                                        </svg>
                                    </abbr>
                                </button>

                                <button class="btn btn-outline-warning" onclick="exportar_materiales()">
                                    <abbr title="Exportar Solo Materiales">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            fill="currentColor" class="bi bi-list-columns-reverse"
                                            viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5Zm-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Z" />
                                        </svg>
                                    </abbr>
                                </button>
                            </div>

                            <form hidden id="form_actualizar_datos"
                                action="{{ route('materiales_empaque.actualizar_datos') }}" method="POST">
                                @csrf
                                <input type="text" hidden name="r_uno" id="r_uno" wire:model='r_uno'>
                                <input type="text" hidden name="r_dos" id="r_dos" wire:model='r_dos'>
                                <input type="text" hidden name="r_tres" id="r_tres" wire:model='r_tres'>
                                <input type="text" hidden name="r_cuatro" id="r_cuatro" wire:model='r_cuatro'>
                                <input type="text" hidden name="r_cinco" id="r_cinco" wire:model='r_cinco'>
                                <input type="text" hidden name="r_seis" id="r_seis" wire:model='r_seis'>
                                <input type="text" hidden name="r_siete" id="r_siete" wire:model='r_siete'>
                                <input type="text" hidden name="busqueda_marcas_p" id="busqueda_marcas_p"
                                    wire:model='busqueda_marcas_p'>
                                <input type="text" hidden name="busqueda_nombre_p" id="busqueda_nombre_p"
                                    wire:model='busqueda_nombre_p'>
                                <input type="text" hidden name="busqueda_vitolas_p" id="busqueda_vitolas_p"
                                    wire:model='busqueda_vitolas_p'>
                                <input type="text" hidden name="busqueda_capas_p" id="busqueda_capas_p"
                                    wire:model='busqueda_capas_p'>
                                <input type="text" hidden name="busqueda_empaques_p" id="busqueda_empaques_p"
                                    wire:model='busqueda_empaques_p'>
                                <input type="text" hidden name="busqueda_items_p" id="busqueda_items_p"
                                    wire:model='busqueda_items_p'>
                                <input type="text" hidden name="busqueda_ordenes_p" id="busqueda_ordenes_p"
                                    wire:model='busqueda_ordenes_p'>
                                <input type="text" hidden name="busqueda_hons_p" id="busqueda_hons_p"
                                    wire:model='busqueda_hons_p'>
                                <input type="text" hidden name="r_mill" id="r_mill" wire:model='r_mill'>
                            </form>

                            <form hidden id="form_exportar_pendiente"
                                action="{{ route('materiales_empaque.exporPendiente') }}" method="POST">
                                @csrf
                                <input type="text" hidden name="r_uno" id="r_uno" wire:model='r_uno'>
                                <input type="text" hidden name="r_dos" id="r_dos" wire:model='r_dos'>
                                <input type="text" hidden name="r_tres" id="r_tres" wire:model='r_tres'>
                                <input type="text" hidden name="r_cuatro" id="r_cuatro" wire:model='r_cuatro'>
                                <input type="text" hidden name="r_cinco" id="r_cinco" wire:model='r_cinco'>
                                <input type="text" hidden name="r_seis" id="r_seis" wire:model='r_seis'>
                                <input type="text" hidden name="r_siete" id="r_siete" wire:model='r_siete'>
                                <input type="text" hidden name="busqueda_marcas_p" id="busqueda_marcas_p"
                                    wire:model='busqueda_marcas_p'>
                                <input type="text" hidden name="busqueda_nombre_p" id="busqueda_nombre_p"
                                    wire:model='busqueda_nombre_p'>
                                <input type="text" hidden name="busqueda_vitolas_p" id="busqueda_vitolas_p"
                                    wire:model='busqueda_vitolas_p'>
                                <input type="text" hidden name="busqueda_capas_p" id="busqueda_capas_p"
                                    wire:model='busqueda_capas_p'>
                                <input type="text" hidden name="busqueda_empaques_p" id="busqueda_empaques_p"
                                    wire:model='busqueda_empaques_p'>
                                <input type="text" hidden name="busqueda_items_p" id="busqueda_items_p"
                                    wire:model='busqueda_items_p'>
                                <input type="text" hidden name="busqueda_ordenes_p" id="busqueda_ordenes_p"
                                    wire:model='busqueda_ordenes_p'>
                                <input type="text" hidden name="busqueda_hons_p" id="busqueda_hons_p"
                                    wire:model='busqueda_hons_p'>
                                <input type="text" hidden name="r_mill" id="r_mill" wire:model='r_mill'>
                            </form>

                            <form hidden id="form_exportar_materiales"
                                action="{{ route('materiales_empaque.exportMateriales') }}" method="POST">
                                @csrf
                                <input type="text" hidden name="busqueda_items_p" id="busqueda_items_p"
                                    wire:model='busqueda_items_p'>
                                <input type="text" hidden name="busqueda_hons_p" id="busqueda_hons_p"
                                    wire:model='busqueda_hons_p'>
                                <input type="text" hidden name="busqueda_ordenes_p" id="busqueda_ordenes_p"
                                    wire:model='busqueda_ordenes_p'>
                                <input type="text" hidden name="busqueda_mes_p" id="busqueda_mes_p"
                                    wire:model='busqueda_mes_p'>
                            </form>
                        </div>
                    </div>
                    <br>
                @endif
                <div class="col">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle form-control" type="button"
                            id="dropdownMenuButton1" data-bs-toggle="dropdown">
                            Categorias
                        </button>
                        <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton1">
                            <div class="form-check ">
                                <input class="form-check-input form-control" type="checkbox" value="1"
                                    wire:model="r_uno" id="checkbox1E" name="checkbox1E" checked>
                                <label class="form-check-label " for="flexCheckDefault"> NEW ROLL </label>
                            </div>

                            <div class="form-check ">
                                <input class="form-check-input form-control" type="checkbox" value="2"
                                    wire:model="r_dos" id="checkbox2E" name="checkbox2E" checked>
                                <label class="form-check-label " for="flexCheckChecked"> CATALOGO </label>
                            </div>

                            <div class="form-check ">
                                <input class="form-check-input form-control" type="checkbox" value="3"
                                    wire:model="r_tres" id="checkbox3E" name="checkbox3E" checked>
                                <label class="form-check-label " for="flexCheckDefault"> INVENTARIO EXISTENTE
                                </label>
                            </div>

                            <div class="form-check ">
                                <input class="form-check-input form-control" type="checkbox" value="4"
                                    wire:model="r_cuatro" id="checkbox4E" name="checkbox4E" checked>
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
                                <input class="form-check-input" type="checkbox" value="Puros Tripa Larga"
                                    id="checkbox5" checked name="checkbox5" wire:model="r_cinco">
                                <label class="form-check-label " for="flexCheckDefault"> Puros Tripa Larga </label>
                            </div>

                            <div class="form-check ">
                                <input class="form-check-input" type="checkbox" value="Puros Tripa Corta"
                                    id="checkbox6" checked name="checkbox6" wire:model="r_seis">
                                <label class="form-check-label " for="flexCheckChecked"> Puros Tripa Corta </label>
                            </div>

                            <div class="form-check ">
                                <input class="form-check-input " type="checkbox" value="Puros Sandwich"
                                    id="checkbox7" checked name="checkbox7" wire:model="r_siete">
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
                <div class="col" wire:ignore>
                    <select name="b_mes[]" id="b_mes" multiple>
                        @foreach ($mes_p as $mes)
                            <option style="overflow-y: scroll;" value='{{ $mes }}'>{{ $mes }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col" wire:ignore>
                    <select onchange="buscar_tabla()" name="b_orden" id="b_orden" style="width:100%;height:34px;"
                        name="states[]">
                        <option value="" style="overflow-y: scroll;">Todas las ordenes del sistema</option>
                        @foreach ($ordenes_p as $orden)
                            <option style="overflow-y: scroll;"> {{ $orden }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col" wire:ignore>
                    <select onchange="buscar_tabla()" name="b_hon" id="b_hon" style="width:100%;height:34px;"
                        name="states[]">
                        <option value="" style="overflow-y: scroll;">Todas las ordenes</option>
                        @foreach ($hons_p as $hon)
                            <option style="overflow-y: scroll;"> {{ $hon }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="btn-group" style="height: 35px;" role="group">
                        @if (auth()->user()->rol == -1)
                        @else
                            @if (auth()->user()->rol == 0 || auth()->user()->rol == 1)
                            <button class="btn btn-outline-primary fs-7" data-bs-toggle="modal" data-bs-target="#productos_crear_empaque">
                                <abbr title="Agregar a Pendiente Empaque">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg>
                                </abbr> Nuevo
                            </button>
                            @endif
                        @endif
                        <button class="btn btn-outline-secondary fs-7" wire:click="exportPendiente()">
                            <abbr title="Exportar a excel">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z" />
                                </svg>
                            </abbr>
                            Exportar
                        </button>
                    </div>
                </div>
                <div class="col" wire:ignore>
                    <select onchange="buscar_tabla()" name="b_item" id="b_item" style="width:100%;height:34px;"
                        name="states[]">
                        <option value="" style="overflow-y: scroll;">Todos Items</option>
                        @foreach ($items_p as $item)
                            <option style="overflow-y: scroll;"> {{ $item }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col" wire:ignore>
                    <select onchange="buscar_tabla()" name="b_marca" id="b_marca" style="width:100%;height:34px;"
                        name="states[]">
                        <option value="" style="overflow-y: scroll;">Todas las marcas</option>
                        @foreach ($marcas_p as $marca)
                            <option style="overflow-y: scroll;"> {{ $marca }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col" wire:ignore>
                    <select onchange="buscar_tabla()" name="b_vitola" id="b_vitola" style="width:100%;height:34px;"
                        name="states[]">
                        <option value="" style="overflow-y: scroll;">Todas las vitolas</option>
                        @foreach ($vitolas_p as $vitola)
                            <option style="overflow-y: scroll;"> {{ $vitola }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col" wire:ignore>
                    <select onchange="buscar_tabla()" name="b_nombre" id="b_nombre" style="width:100%;height:34px;"
                        name="states[]">
                        <option value="" style="overflow-y: scroll;">Todos los nombres</option>
                        @foreach ($nombre_p as $nombre)
                            <option style="overflow-y: scroll;"> {{ $nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col" wire:ignore>
                    <select onchange="buscar_tabla()" name="b_capa" id="b_capa" style="width:100%;height:34px;"
                        name="states[]">
                        <option value="" style="overflow-y: scroll;">Todas las capas</option>
                        @foreach ($capas_p as $capa)
                            <option style="overflow-y: scroll;"> {{ $capa }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col" wire:ignore>
                    <select onchange="buscar_tabla()" name="b_empaque" id="b_empaque"
                        style="width:100%;height:34px;" name="states[]">
                        <option value="" style="overflow-y: scroll;">Todos los empaques</option>
                        @foreach ($empaques_p as $empaque)
                            <option style="overflow-y: scroll;"> {{ $empaque }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="row p-2"  style="margin-bottom: -10px">
                <div class="col">
                    <nav>
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <button type="button" class="page-link  fs-8"
                                    wire:click='actualizar_fichas_pendiente_empaque()'>Actualizar</button>

                            </li>
                            @php
                                $cantida = 1;
                            @endphp
                            @for ($i = 0; $i < $tuplas_conteo; $i += 100)
                                <li class="page-item"><a class="page-link  fs-8" href="#"
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
                                <a class="page-link  fs-8" href="#" wire:click="mostrar_todo(1)">Mostrar Todo</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div wire:change='tama' id="tabla_materiales1" class="table-responsive">
            <div wire:loading.class='oscurecer_contenido' style="width:100%; padding-left:0px; height:100%;">
                <table class="table table-light table-hover" style="font-size:10px;" id="tabla_pendiente_empaque">
                    <thead style="width:100px;">
                        <tr>
                            <th>N#</th>
                            <th>CATEGORIA</th>
                            <th>ITEM</th>
                            <th>CODIGO CAJA</th>
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
                            <th>CANT. CAJAS</th>
                            <th>ANILLO</th>
                            <th>CELLO</th>
                            <th>UPC</th>
                            <th>PENDIENTE</th>
                            <th>SALDO</th>
                            <th>CAJAS</th>
                            <th>BODEGAS</th>
                            @if (auth()->user()->rol == -1)
                            @else
                                @if (auth()->user()->rol == 0 || auth()->user()->rol == 1)
                                    <th>OPERACIONES</th>
                                @endif
                            @endif
                        </tr>
                    </thead>
                    <?php $sumase = 0;
                    $sumape = 0; ?>
                    <tbody name="bodyE" id="bodyE">
                        @foreach ($datos_pendiente_empaque as $i => $datos)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td style="width:100px; max-width: 400px;overflow-x:auto;">
                                    {{ isset($datos->categoria) ? $datos->categoria : 'Sin categoria' }}</td>
                                <td>{{ isset($datos->item) ? $datos->item : '' }}</td>
                                <td>
                                    {{ isset($datos->codigo_caja) ? $datos->codigo_caja : '' }}
                                </td>
                                <td>{{ isset($datos->orden_del_sitema) ? $datos->orden_del_sitema : '' }}</td>

                                <td style="width:100px;">{{ $datos->observacion }}</td>
                                <td style="width:100px;">{{ $datos->presentacion }}</td>
                                <td>{{ $datos->mes }}</td>

                                <td style="width:100px;">{{ $datos->orden }}</td>
                                <td style="width:100px;">{{ $datos->marca }}</td>
                                <td>{{ $datos->vitola }}</td>

                                <td>{{ $datos->nombre }}</td>
                                <td>{{ $datos->capa }}</td>
                                <td>{{ $datos->tipo_empaque }}</td>

                                <td>{{ intval($datos->cant_cajas) }}</td>
                                <td>{{ $datos->anillo }}</td>
                                <td>{{ $datos->cello }}</td>

                                <td>{{ $datos->upc }}</td>
                                <td>{{ $datos->pendiente }}</td>
                                <td>{{ $datos->saldo }}</td>
                                <td>{{ $cajas[$datos->codigo_caja] ?? 0 }}</td>
                                <td>{{ $puros[$datos->codigo_productos] ?? 0 }}</td>

                                @if (auth()->user()->rol == -1)
                                @else
                                    @if (auth()->user()->rol == 0 || auth()->user()->rol == 1)
                                        <td style="text-align:center;">

                                            <?php
                                            echo ' <a style=" width:20px; height:20px;" ';
                                            echo 'type="submit" wire:click.prevent= "insertar_detalle_provicional_sin_existencia(' . $datos->id_pendiente . ')">';

                                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"';
                                            echo '    class="bi bi-arrow-up-right-square-fill" viewBox="0 0 16 16">';
                                            echo '    <path';
                                            echo '        d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12zM5.904 10.803 10 6.707v2.768a.5.5 0 0 0 1 0V5.5a.5.5 0 0 0-.5-.5H6.525a.5.5 0 1 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 .707.707z" />';
                                            echo '</svg>';
                                            echo '</a>';

                                            echo '<a style=" width:20px; height:20px;" data-bs-toggle="modal" href=""';
                                            echo '             data-bs-target="#modal_actualizar" type="submit"';
                                            echo '        onclick="datos_modal_actualizar_p(' . $datos->id_pendiente . ')">';
                                            echo '        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"';
                                            echo '            class="bi bi-pencil-square" viewBox="0 0 16 16">';
                                            echo '            <path';
                                            echo '                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />';
                                            echo '            <path fill-rule="evenodd"';
                                            echo '                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />';
                                            echo '        </svg>';
                                            echo '    </a>';

                                            echo '<a data-bs-toggle="modal" data-bs-target="#modal_eliminar_detalle"';
                                            echo '    onclick="datos_modal_eliminar(' . $datos->id_pendiente . ')" href="">';
                                            echo '    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"';
                                            echo '        class="bi bi-trash-fill" viewBox="0 0 16 16">';
                                            echo '        <path';
                                            echo '            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />';
                                            echo '    </svg></a>';
                                            ?>


                                        </td>
                                    @endif
                                @endif
                            </tr>

                            <?php $sumase = $sumase + $datos->saldo;
                            $sumape = $sumape + $datos->pendiente; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="input-group" style="width:30%;position: fixed;right: 0px;bottom:0px; height:30px;">
            <span class="form-control input-group-text fs-7">Total pendiente</span>
            <input type="text" class="form-control  fs-7" id="sumape" value="{{ number_format($sumape,0) }}">

            <span class="form-control input-group-text fs-7">Total saldo</span>
            <input type="text" class="form-control fs-7" id="sumase" value="{{ number_format($sumase,0) }}">
        </div>
    </div>





    <!-- INICIO MODAL CREAR DATO PENDIENTE -->
    <div wire:ignore class="modal fade" id="productos_crear_empaque" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="productos_crear_empaqueLabel" aria-hidden="true"
        style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-lg">
            <!-- INICIO DEL MODAL NUEVO PRODUCTO -->
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="staticBackdropLabel"><strong>Agregar producto</strong></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                </div>

                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Item</label>
                                <select name="itemn" id="itemn" style="height:30px; width: 100%;"
                                    class="form-control itema_nuevo" required type="text" autocomplete="off">
                                    <option value="">Todos los items</option>
                                    @foreach ($items_agregar as $items)
                                        <option value="{{ $items->item }}">{{ $items->item }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Categoria</label>
                                <select class="form-control" name="categoria" id="categoria"
                                    style="overflow-y: scroll; height:30px;" required>
                                    <option value="1">NEW ROLL</option>
                                    <option value="2">CATALOGO</option>
                                    <option value="3">TAKE FROM EXISTING INVENT</option>
                                    <option value="4">INTERNATIONAL SALES</option>
                                </select>
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_malos" class="form-label">Presentación</label>
                                <input class="form-control" name="presentacionn" id="presentacionn"
                                    wire:model='presentacion' placeholder="Ingresa figura y tipo"
                                    style="overflow-y: scroll; height:30px;" disabled>
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_vitola" class="form-label">Marca</label>
                                <input style=" height:30px; width: 100%;" name="marcan" id="marcan"
                                    wire:model='marcas_nuevo' placeholder="Ingresa figura y tipo" disabled>

                            </div>
                        </div>


                        <div class="row">
                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Capa</label>
                                <input style=" height:30px; width: 100%;" name="capan" id="capan"
                                    wire:model='capas_nuevo' placeholder="Ingresa figura y tipo" disabled>
                            </div>


                            <div class="mb-3 col">
                                <label for="txt_malos" class="form-label">Tipo de
                                    empaque</label>
                                <input style=" height:30px; width: 100%;" name="tipon" id="tipon"
                                    wire:model='tipo_empaques_nuevo' placeholder="Ingresa figura y tipo" disabled>
                            </div>


                            <div class="mb-3 col">
                                <label for="vitola" class="form-label">Vitola</label>
                                <input style=" height:30px; width: 100%;" name="vitolan" wire:model='vitolas_nuevo'
                                    id="vitolan" placeholder="Ingresa figura y tipo" disabled>
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_total" class="form-label">Nombre</label>
                                <input style=" height:30px; width: 100%;" name="nombren" wire:model='nombres_nuevo'
                                    id="nombren" placeholder="Ingresa figura y tipo" disabled>

                            </div>
                        </div>


                        <div class="row">

                            <div class="mb-2 col">
                                <label for="txt_figuraytipo" class="form-label">Orden del sistema</label>
                                <input name="ordensis" id="ordensis" style="font-size:16px" class="form-control"
                                    type="text" autocomplete="off">
                            </div>

                            <div class="mb-2 col">
                                <label for="txt_figuraytipo" class="form-label">Orden</label>
                                <input name="ordenn" id="ordenn" style="font-size:16px" class="form-control"
                                    required type="text" autocomplete="off">
                            </div>


                            <div class="mb-2 col">
                                <label for="txt_figuraytipo" class="form-label">Fecha</label>
                                <input value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" name=" fechan"
                                    id="fechan" style="font-size:12px" class="form-control" required
                                    type="date" autocomplete="off">
                            </div>

                            <div class="mb-2 col">
                                <label for="txt_total" class="form-label">Pendiente</label>
                                <input name="pendienten" id="pendienten" class="form-control" required
                                    type="number" autocomplete="off">
                            </div>

                            <div class="mb-2 col">
                                <label for="txt_buenos" class="form-label">Saldo</label>
                                <input name="saldon" id="saldon" class="form-control" required type="number"
                                    autocomplete="off">
                            </div>

                        </div>
                        <div class="row">
                            <div class="mb-6 col">
                                <label for="txt_figuraytipo" class="form-label">Observacion</label>
                                <input name="observacionn" id="observacionn" style="font-size:16px"
                                    class="form-control" type="text" autocomplete="off">
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
    </div>
    <!-- FIN MODAL CREAR DATO PENDIENTE -->

    <!-- INICIO MODAL ACTUALIZAR DATO PENDIENTE -->
    <div class="modal fade" role="dialog" id="modal_actualizar" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
        style="opacity:.9;background:#212529;width=800px;">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="opacity:.9;background:#212529;width=80%">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="staticBackdropLabel"><strong>Descripción del producto:</strong><span id="tituloupdate"
                            name="tituloupdate"></span></h5>
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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <span>Cancelar</span>
                    </button>
                    <button type="button" class="btn btn-success" onclick="guardar_actualizacion()">
                        <span>Actualizar</span>
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- FIN MODAL ACTUALIZAR DATO PENDIENTE -->

    <!-- INICIO MODAL ELMINAR DATO PENDIENTE -->
    <div class="modal fade" id="modal_eliminar_detalle" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Eliminar <strong><input value=""
                                id="txt_usuarioE" name="txt_usuarioE" style="border:none;"></strong> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
    </div>
    <!-- FIN MODAL ELMINAR DATO PENDIENTE -->



    <!-- INICIO MODAL ELMINAR TODO DETALLE PROGRAMACION -->
    <div class="modal fade" id="modal_eliminar_tabla_progra" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
        style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Advertencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro que quieres limpiar estos registros?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <span>Cancelar</span>
                    </button>
                    <button wire:click="eliminar_datos()" class="btn btn-success">
                        <span>Eliminar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL ELMINAR TODO DETALLE DETALLE PROGRAMACION -->


    {{-- JavaScript detalle programacion --}}
    @push('scripts')
        <script type="text/javascript">
            function datos_modal_eliminar(id) {
                var datastiles = @this.datos_pendiente_empaque;
                for (var i = 0; i < datastiles.length; i++) {
                    if (datastiles[i].id_pendiente === id) {
                        document.getElementById('id_pendiente3').value = datastiles[i].id_pendiente;
                    }
                }
            }


            var seletscc = ["#b_item", "#b_orden", "#b_hon", "#b_marca", "#b_vitola", "#b_nombre", "#b_capa",
                "#b_empaque", "#itemn"
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

            function actualizar_datos() {
                document.getElementById("form_actualizar_datos").submit();
            }

            function exportar_pendiente() {
                document.getElementById("form_exportar_pendiente").submit();
            }

            function exportar_materiales() {
                document.getElementById("form_exportar_materiales").submit();
            }
        </script>

        <script type="text/javascript">
            var meses_control;
            $(document).ready(function() {
                $('.itema_nuevo').select2({
                    dropdownParent: $('#productos_crear_empaque')
                });

                $('#tabla_materiales1').css('height', ($('#bos').height() - 250));
                $('#tabla_materiales2').css('height', ($('#bos').height() - 160));

                $("#b_mes").CreateMultiCheckBox({
                    width: '200px',
                    defaultText: 'Selecciona el mes'
                });

            });

            window.addEventListener('tamanio_tabla', event => {
                $('#tabla_materiales1').css('height', ($('#bos').height() - 250));
                $('#tabla_materiales2').css('height', ($('#bos').height() - 160));
            });
        </script>
        <script type="text/javascript">
            function addexportar() {
                var theForm = document.forms['insertar_detalle_provicional'];
                theForm.addEventListener('submit', function(event) {});

            }

            function exportarMaterial() {
                @this.imprimir_materiales();
            }
        </script>
        <script>
            function buscar_tabla() {


                @this.busqueda_items_p = $('#b_item').val();
                @this.busqueda_marcas_p = $('#b_marca').val();
                @this.busqueda_nombre_p = $('#b_nombre').val();
                @this.busqueda_vitolas_p = $('#b_vitola').val();
                @this.busqueda_capas_p = $('#b_capa').val();
                @this.busqueda_empaques_p = $('#b_empaque').val();

                $("#b_mes").UpdateSelect();
                var meses = $('#b_mes').val();
                var mesesconcatenados = '';
                meses.forEach(element => {
                    mesesconcatenados = mesesconcatenados + element;
                });

                @this.busqueda_mes_p = mesesconcatenados;
                @this.busqueda_items_p = $('#b_item').val();
                @this.busqueda_ordenes_p = $('#b_orden').val();
                @this.busqueda_hons_p = $('#b_hon').val();
                @this.paginacion = 0;
            }

            $('#itemn').on('change', function(e) {
                var data = $('#itemn').select2("val");
                @this.set('codigo_item', data);
                @this.agregar_productos();
            });

            window.addEventListener('notificacionconfirmacion', event => {
                toastr.success('La inserción realizada con exito.', 'Completado!');
                $("#productos_crear_empaque").removeClass("in");
                $(".modal-backdrop").remove();
                $("#productos_crear_empaque").hide();
            })

            window.addEventListener('notificacionconfirmacionUpdate', event => {
                $("#modal_actualizar").removeClass("in");
                $(".modal-backdrop").remove();
                $("#modal_actualizar").hide();
                toastr.success('Actualización realizada con exito.', 'Completado!');
            })

            window.addEventListener('notificacionErrorUpdate', event => {
                toastr.error('Hay campos erroneos.\n' + event.detail.mensaje, 'Error!');
            })

            window.addEventListener('notificacionErrorInsert', event => {
                toastr.error('Hay campos erroneos.\n' + event.detail.mensaje, 'Error!');
            })

            window.addEventListener('notificacionConfirmacionDelete', event => {
                toastr.success('Se elimino correctamente.', 'Completado!');
                $("#modal_eliminar_detalle").removeClass("in");
                $(".modal-backdrop").remove();
                $("#modal_eliminar_detalle").hide();
            })
        </script>
    @endpush


    <script>
        function eliminar_pendiente() {
            @this.eliminar_pendiente({
                'id_pendiente3': $('#id_pendiente3').val()
            });
        }

        function guardar_actualizacion() {
            if ($('#id_pendientea2').val() == "" || $('#orden_sistema2').val() == "" || $('#orden2').val() == "" ||
                $('#pendiente2').val() == "" || $('#saldo2').val() == "") {
                toastr.info('Hay campos requeridos vacios.', 'Advertencia!');
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
                toastr.info('Hay compos requeridos vacios.', 'Advertencia!');
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
                event.preventDefault();
            }
        }
    </script>
    <script type="text/javascript">
        function datos_modal_actualizar_p(id) {

            var data = @this.datos_pendiente_empaque;

            for (var i = 0; i < data.length; i++) {
                if (data[i].id_pendiente === id) {
                    $('#id_pendientea2').val(data[i].id_pendiente);
                    $('#orden2').val(data[i].orden);
                    $('#orden_sistema2').val(data[i].orden_del_sitema);
                    $('#pendiente2').val(data[i].pendiente);
                    $('#saldo2').val(data[i].saldo);
                    $('#observacion2').val(data[i].observacion);

                }
            }
        }
    </script>
    <script type="text/javascript">
        function datos_modal_eliminar(id) {

            var datastiles = @this.datos_pendiente_empaque;

            for (var i = 0; i < datastiles.length; i++) {
                if (datastiles[i].id_pendiente === id) {
                    document.formulario_mostrarE.id_pendiente.value = datastiles[i].id_pendiente;
                }
            }

        }
    </script>


    {{-- JavaScript detalle programacion --}}
    <script type="text/javascript">
        function datos_modal_actualizar(id) {
            var datas = '<?php echo json_encode($detalles_provicionales); ?>';

            var data = JSON.parse(datas);


            for (var i = 0; i < data.length; i++) {
                if (data[i].id === id) {
                    document.form_saldo.saldo.value = data[i].saldo;

                    document.form_saldo.id_detalle.value = data[i].id;

                    document.form_saldo.id_pendientea.value = data[i].id_pendiente;

                    document.form_saldo.cant_cajas.value = data[i].cant_cajas;

                    document.form_saldo.saldo_viejo.value = data[i].cant_cajas_necesarias;



                }
            }
        }
    </script>

    <script type="text/javascript">
        function eliminar_detalle_prgramacion(id) {
            var mensaje = confirm("¿Estás seguro que quieres eliminar este registro?");
            if (mensaje) {
                @this.eliminar_Detalles(id);
            } else {

            }
        }

        function agregar_a_programacion() {
            var mensaje = confirm("¿Estás seguro que deseas agregar todos estos registros a la programación?");
            if (mensaje) {
                @this.insertar_detalle_provicional();
            } else {

            }
        }

        function editar_saldo(id) {
            var saldo = prompt("Actualizar saldo", "Nuevo saldo");
            if (saldo != null) {
                @this.actualizar_saldo(id, saldo);
            }
        }


        function mostrarMaterial(v) {
            @this.materiales = v;
        }


        async function guardar_programacion() {
            var html = '<div>' +
                '<div>' +
                '<div>' +
                '<div><br>' +
                '  <div class="mb-3 col">' +
                '<label for="txt_empaque" class="form-label">Editar tipo de empaque</label>' +
                '<input name="fecha_creacion_new" id="fecha_creacion_new" type="date" class="  form-control  mr-sm-2"' +
                'placeholder="" style="width:100%;">' +
                '</div>' +
                '<div class="mb-3 col">' +
                '<label for="txt_empaque" class="form-label">Nombre Ingles</label>' +
                '<input name="fecha_contenedor_new" id="fecha_contenedor_new" type="text" class="  form-control  mr-sm-2"' +
                'placeholder="Número y fecha del contenedor" style="width:100%;" autocomplete="off">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';




            const {
                value: formValues
            } = await Swal.fire({
                title: '',
                html: html,
                width: 300,
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar',
                focusConfirm: false,
                preConfirm: () => {
                    return [
                        document.getElementById('fecha_creacion_new').value, document.getElementById(
                            'fecha_contenedor_new').value
                    ]
                }

            })

            if (formValues) {
                if (formValues[0] == "") {
                    toastr.info('Debe seleccionar una Fecha.', 'Advertencia!');
                } else if (formValues[1] == "") {
                    toastr.info('Debe ingresar la descripcion de la programacion.', 'Advertencia!');
                } else {
                    @this.insertarDetalle_y_actualizarPendiente({
                        'fecha': formValues[0],
                        'contenedor': formValues[1]
                    });
                }
            }
        }
    </script>

</div>
