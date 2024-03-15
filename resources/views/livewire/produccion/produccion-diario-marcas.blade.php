<div class="container-fluid" style="height: 90vh">
    <style>
        .oscurecer_contenido {
            justify-content: center;
            align-items: center;
            background-color: black;
            top: 0px;
            left: 0px;
            z-index: 9999;
            width: 100%;
            height: 100%;
            opacity: 0.5;
        }

        html {
            font-family: sans-serif;
        }

        .lineatemp {
            position: relative;
            width: 650px;
            margin: 0 auto;
            border: 1px solid lightgray;
            border-radius: 10px;
        }

        .fila {
            display: flex;
            justify-content: start;
            border-bottom: 1px solid lightgray;
            position: relative;
        }

        .fila .disco {
            width: 36px;
            display: flex;
            flex-direction: column;
            position: relative;
            justify-content: center;
            align-items: center;
        }

        .fila .disco:after {
            content: '';
            position: absolute;
            top: 0;
            left: calc(505 - 2px);
            height: 100%;
            width: 3px;
            background: #80DEEA;
            z-index: -1;
        }

        .fila:first-child .disco:after {
            height: 50%;
            top: 50%;
        }

        .fila:last-child .disco:after {
            height: 50%;
        }

        .fila .disco>div {

            aspect-ratio: 1/1;
            border-radius: 50%;
            background: lightblue;
            box-sizing: border-box;
        }

        .fila:hover .disco>div {
            border: 3px solid red;
            background: white;
        }

        .fila div:nth-of-type(2) {
            width: 20%;
            padding: 4px;
            display: flex;
            align-items: center;
        }

        .fila div:nth-of-type(3) {
            width: 60%;
            padding: 4px;
        }

        .align-self-center {
            width: -webkit-fill-available;
        }

        li {
            display: list-item;
            text-align: center;
        }

        .flotante {
            display: inline-block;
            position: fixed;
            bottom: 50vh;
            left: 0px;
            width: 50px;
            /* ajusta el tamaño según necesites */
            height: 50px;
            /* ajusta el tamaño según necesites */
            border-radius: 50%;
            /* hace que el botón sea redondo */
            background-color: green;
            /* define el color verde */
            border: none;
            /* elimina el borde */
            cursor: pointer;
            /* cambia el cursor al pasar sobre el botón */
            z-index: 999;
            display: flex;
            /* usa flexbox para centrar contenido */
            justify-content: center;
            /* centra horizontalmente */
            align-items: center;
            /* centra verticalmente */
        }

        .flotante svg {
            width: 70%;
            /* ajusta el tamaño del icono según necesites */
            height: 70%;
            /* ajusta el tamaño del icono según necesites */
        }

        .lightRed {
            background-color: #ff8080 !important
        }
    </style>



    <div style="height: 0.8rem;" role="status">
        <div wire:loading style="width: 100%;" role="status">
            <span class="loader"></span>
        </div>
    </div>

    <a class='flotante' href='#' wire:click="ocultar_empleados()">
        @if ($verempleados == 0)
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                class="bi bi-person-check" viewBox="0 0 16 16">
                <path
                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                <path
                    d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
            </svg>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                class="bi bi-person-dash" viewBox="0 0 16 16">
                <path
                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M11 12h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m0-7a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                <path
                    d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
            </svg>
        @endif
    </a>

    <div class="row">
        <div class="col-md-4" @if ($verempleados == 0) hidden @else @endif>
            <div class="card" style="height: 90vh;">
                <div class="card-body">
                    <div class="table-responsive" style="height: 87vh;">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 60px">Codigo</th>
                                    <th style="width: 60px">Rol</th>
                                    <th>Nombre</th>
                                    <th>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-nut" viewBox="0 0 16 16">
                                            <path
                                                d="m11.42 2 3.428 6-3.428 6H4.58L1.152 8 4.58 2h6.84zM4.58 1a1 1 0 0 0-.868.504l-3.428 6a1 1 0 0 0 0 .992l3.428 6A1 1 0 0 0 4.58 15h6.84a1 1 0 0 0 .868-.504l3.429-6a1 1 0 0 0 0-.992l-3.429-6A1 1 0 0 0 11.42 1H4.58z" />
                                            <path
                                                d="M6.848 5.933a2.5 2.5 0 1 0 2.5 4.33 2.5 2.5 0 0 0-2.5-4.33zm-1.78 3.915a3.5 3.5 0 1 1 6.061-3.5 3.5 3.5 0 0 1-6.062 3.5z" />
                                        </svg>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($empleados as $empleado)
                                    <tr class="text-center">
                                        <td style="width: 60px">{{ $empleado->codigo }}</td>
                                        <td style="width: 60px">{{ $empleado->rol }}</td>
                                        <td>{{ $empleado->nombre }}</td>
                                        <td>
                                            <a href="#" style="text-decoration: none">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-arrow-90deg-right"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M14.854 4.854a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 4H3.5A2.5 2.5 0 0 0 1 6.5v8a.5.5 0 0 0 1 0v-8A1.5 1.5 0 0 1 3.5 5h9.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div @if ($verempleados == 0) class="col-md-12" @else class="col-md-8" @endif>
            <ul class="nav nav-tabs justify-content-center">

                @php
                    $moduloactual = [];
                @endphp
                @foreach ($modulos as $modulo)
                    <li class="nav-item">
                        <a class="nav-link @if ($modulo_actual == $modulo->id) active
                        @php
                            $moduloactual = $modulo;
                        @endphp
                    @else @endif fs-7"
                            href="#"
                            wire:click="cambiar_modulo({{ $modulo->id }})"><strong>{{ $modulo->nombre }}</strong></a>
                    </li>
                @endforeach
                @if (!$moduloactual)
                    @php
                        $moduloactual = $modulo;
                    @endphp
                @endif
                @if ($modulo->nombre == 'Modulo 7')
                @else
                    <li class="nav-item">
                        <a class="nav-link fs-7 active" href="#" wire:click="agregar_nuevo_modulo()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-bag-plus" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                <path
                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                            </svg>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link fs-7 active" href="#">
                        <abbr title="Etiquetas de Mesas">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-tag-fill" viewBox="0 0 16 16">
                                <path
                                    d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1H2zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                            </svg>
                        </abbr>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-7 active" href="#" wire:click="generar_vinetas()">
                        <abbr title="Etiquetas de las maletas">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-tags" viewBox="0 0 16 16">
                                <path
                                    d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z" />
                                <path
                                    d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z" />
                            </svg>
                        </abbr>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-7 active" href="#" onclick="exportar_documentos()">
                        <abbr title="Exportar planificacion">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                                <path d="M6 12v-2h3v2H6z" />
                                <path
                                    d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3V9z" />
                            </svg>
                        </abbr>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-7 active" href="#" onclick="moldes_parejas()">
                        <abbr title="Moldes por Parejas">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-archive-fill" viewBox="0 0 16 16">
                                <path
                                    d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z" />
                            </svg>
                        </abbr>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-7 active" href="#" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <abbr title="Buscar empleado">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-binoculars-fill" viewBox="0 0 16 16">
                                <path
                                    d="M4.5 1A1.5 1.5 0 0 0 3 2.5V3h4v-.5A1.5 1.5 0 0 0 5.5 1h-1zM7 4v1h2V4h4v.882a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V13H9v-1.5a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5V13H1V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882V4h4zM1 14v.5A1.5 1.5 0 0 0 2.5 16h3A1.5 1.5 0 0 0 7 14.5V14H1zm8 0v.5a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5V14H9zm4-11H9v-.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5V3z" />
                            </svg>
                        </abbr>
                    </a>
                </li>
                <li class="nav-item" hidden>
                    <a class="nav-link fs-7 active" href="#" data-bs-toggle="modal"
                        data-bs-target="#modal_programar_marca">
                        <abbr title="Programar por marca">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
                                <path
                                    d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                                <path
                                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                            </svg>
                        </abbr>
                    </a>
                </li>
                <li class="nav-item" wire:loading.attr="hidden">
                    <a class="nav-link fs-7 active" href="#" wire:click="guardar_planificacion()">
                        <abbr title="Guardar Planificacion">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-floppy-fill" viewBox="0 0 16 16">
                                <path
                                    d="M0 1.5A1.5 1.5 0 0 1 1.5 0H3v5.5A1.5 1.5 0 0 0 4.5 7h7A1.5 1.5 0 0 0 13 5.5V0h.086a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5H14v-5.5A1.5 1.5 0 0 0 12.5 9h-9A1.5 1.5 0 0 0 2 10.5V16h-.5A1.5 1.5 0 0 1 0 14.5z" />
                                <path
                                    d="M3 16h10v-5.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5zm9-16H4v5.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5zM9 1h2v4H9z" />
                            </svg>
                        </abbr>
                    </a>
                </li>
            </ul>
            <div class="card" style="height: 86vh;">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">Revisadores</label>
                        </div>
                        <div class="col-md-5">
                            @if (is_null($moduloactual->revisador1))
                                @isset($revisador['revisador'])
                                    @if (Auth::user()->hasRole(['ADMIN', 'PRODUCCION']))
                                        <select class="form-control form-control-sm" name="" id="revisador_1"
                                            onchange="agregar_revisador_modulo({{ $moduloactual->id }},'revisador_1',1)">
                                            <option value="">Selecione</option>
                                            @foreach ($revisador['revisador'] as $revisa)
                                                <option value="{{ $revisa->id }}">
                                                    {{ $revisa->codigo . ' - ' . $revisa->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif
                                @endisset
                            @else
                                @if (Auth::user()->hasRole(['ADMIN', 'PRODUCCION']))
                                    <a href="#" style="text-decoration: none"
                                        wire:click="eliminar_revisador_modulo({{ $moduloactual->id }},1)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                        </svg>
                                    </a>
                                @endif
                                {{ $moduloactual->revisador1 }}
                            @endif
                        </div>
                        <div class="col-md-5">
                            @if (is_null($moduloactual->revisador2))
                                @isset($revisador['revisador'])
                                    @if (Auth::user()->hasRole(['ADMIN', 'PRODUCCION']))
                                        <select class="form-control form-control-sm" name="" id="revisador_2"
                                            onchange="agregar_revisador_modulo({{ $moduloactual->id }},'revisador_2',2)">
                                            <option value="">Selecione</option>
                                            @foreach ($revisador['revisador'] as $revisa)
                                                <option value="{{ $revisa->id }}">
                                                    {{ $revisa->codigo . ' - ' . $revisa->nombre }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                @endisset
                            @else
                                @if (Auth::user()->hasRole(['ADMIN', 'PRODUCCION']))
                                    <a href="#" style="text-decoration: none"
                                        wire:click="eliminar_revisador_modulo({{ $moduloactual->id }},2)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                        </svg>
                                    </a>
                                @endif
                                {{ $moduloactual->revisador2 }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div wire:loading.class='oscurecer_contenido' class="table-responsive" style="height: 78vh;">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>N#</th>
                                    <th>COD</th>
                                    <th>BONCHERO</th>
                                    <th>COD</th>
                                    <th>ROLERO</th>
                                    <th>ORDEN</th>
                                    <th>VITOLA</th>
                                    <th>MARCAS</th>
                                    <th>CAPA</th>
                                    <th>PEND.</th>
                                    <th>TAREA</th>
                                    <th>ESTIMADO</th>
                                    <th>MOLDES USAR</th>
                                    <th>EXISTENCIA</th>
                                </tr>
                            </thead>
                            <tbody class="fs-7">
                                @if (Auth::user()->hasRole(['ADMIN', 'PRODUCCION']))
                                    <tr>
                                        <td></td>
                                        <td colspan="2" class="text-center">
                                            @isset($boncheros['boncheros'])
                                                <select class="form-control form-control-sm" name=""
                                                    id="empleadon" onchange="agregar_nueva_tupla(1,'empleadon')">
                                                    <option value="">Selecione</option>
                                                    @foreach ($boncheros['boncheros'] as $bonche)
                                                        <option value="{{ $bonche->id }}">
                                                            {{ $bonche->codigo . ' - ' . $bonche->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            @endisset
                                        </td>
                                        <td colspan="2" class="text-center">
                                            @isset($roleros['roleros'])
                                                <select class="form-control form-control-sm" name=""
                                                    id="empleadon2" onchange="agregar_nueva_tupla(2,'empleadon2')">
                                                    <option value="">Selecione</option>
                                                    @foreach ($roleros['roleros'] as $rolero)
                                                        <option value="{{ $rolero->id }}">
                                                            {{ $rolero->codigo . ' - ' . $rolero->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            @endisset
                                        </td>
                                        <td colspan="2" class="text-center"></td>
                                        <td colspan="2" class="text-center"></td>
                                    </tr>
                                @endif
                                @php
                                    $moldes_totale_para_usar = 0;
                                    $moldes = 0;
                                    $empleado1 = '';
                                    $mostrar = true;
                                @endphp
                                @foreach ($modulo_empleado as $key => $emple)
                                    @php
                                        if ($emple->codigo_empleaado == $empleado1) {
                                            $mostrar = false;
                                        }

                                        if ($emple->codigo_empleaado != $empleado1) {
                                            $empleado1 = $emple->codigo_empleaado;
                                            $mostrar = true;
                                        }
                                    @endphp

                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        @if(!$mostrar)
                                            <td colspan="4">

                                            </td>
                                        @else
                                            @if (is_null($emple->codigo_empleaado))
                                                @if (Auth::user()->hasRole(['ADMIN', 'PRODUCCION']))
                                                    <td colspan="2" class="text-center">
                                                        @isset($boncheros['boncheros'])
                                                            <button type="button" class="btn btn-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#busquedaEmpleadobonchero"
                                                                onclick="agregar_id_bonchero({{ $emple->id }},1,`{{ json_encode($boncheros['boncheros']) }}`)">
                                                                BONCHEROS
                                                            </button>
                                                        @endisset
                                                    </td>
                                                @endif
                                            @else
                                                <td>
                                                    @if (Auth::user()->hasRole(['ADMIN', 'PRODUCCION']))
                                                        <a href="#" style="text-decoration: none"
                                                            wire:click="eliminar_detalle({{ $emple->id }},1)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="red" class="bi bi-trash3-fill"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                            </svg>
                                                        </a>
                                                    @endif
                                                    {{ $emple->codigo_empleaado }}
                                                </td>
                                                <td>{{ $emple->nombre_empleado }}</td>
                                            @endif
                                            @if (is_null($emple->codigo_empleaado2))
                                                    <td colspan="2" class="text-center">
                                                        @isset($roleros['roleros'])
                                                            @if (Auth::user()->hasRole(['ADMIN', 'PRODUCCION']))
                                                                <button type="button" class="btn btn-warning"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#busquedaEmpleadorolero"
                                                                    onclick="agregar_id_rolero({{ $emple->id }},2,`{{ json_encode($roleros['roleros']) }}`)">
                                                                    ROLEROS
                                                                </button>
                                                            @endif
                                                        @endisset
                                                    </td>
                                                @else
                                                    <td>
                                                        @if (Auth::user()->hasRole(['ADMIN', 'PRODUCCION']))
                                                            <a href="#" style="text-decoration: none"
                                                                wire:click="eliminar_detalle({{ $emple->id }},2)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="red" class="bi bi-trash3-fill"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                                </svg>
                                                            </a>
                                                        @endif
                                                        {{ $emple->codigo_empleaado2 }}
                                                    </td>
                                                    <td>{{ $emple->nombre_empleado2 }}</td>
                                                @endif
                                        @endif


                                        <td>{{ $emple->orden_sistema }}</td>
                                        @if (is_null($emple->marca))
                                            @if (Auth::user()->hasRole(['ADMIN', 'PRODUCCION']))
                                                <td colspan="3" class="text-center">
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#modal_agregar_marca"
                                                        onclick="seleccionar_tupla({{ $emple->id }})">Agregar Marca
                                                    </button>
                                                </td>
                                            @endif
                                        @else
                                            <td>{{ $emple->vitola . ' ' . $emple->nombre }}</td>
                                            <td>
                                                @if (Auth::user()->hasRole(['ADMIN', 'PRODUCCION']))
                                                    <a href="#" style="text-decoration: none"
                                                        data-bs-toggle="modal" data-bs-target="#modal_agregar_marca"
                                                        onclick="seleccionar_tupla_extra({{ $emple->id }},{{ $emple->id_modulo }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="green" class="bi bi-plus-square"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                                            <path
                                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                                        </svg>
                                                    </a>
                                                @endif
                                                <b>{{ $emple->marca }}</b>
                                                @if (Auth::user()->hasRole(['ADMIN', 'PRODUCCION']))
                                                    @if(!$mostrar)
                                                        <a href="#" style="text-decoration: none"
                                                            wire:click="eliminar_detalle_extra({{ $emple->id }})">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="red" class="bi bi-trash3-fill"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                            </svg>
                                                        </a>
                                                    @else
                                                        <a href="#" style="text-decoration: none"
                                                            wire:click="eliminar_detalle({{ $emple->id }},3)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="red" class="bi bi-trash3-fill"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                            </svg>
                                                        </a>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{ $emple->capa }}</td>
                                        @endif
                                        <td>
                                            <b>{{ $emple->restantes }}</b>
                                            @if (Auth::user()->hasRole(['ADMIN', 'PRODUCCION']))
                                                @if (is_null($emple->vinetas_parejas))
                                                @else
                                                    <a href="#">
                                                        <abbr title="Viñetas restantes: {{ $emple->vinetas_parejas }}"
                                                            onclick="generar_viñetas_pdf({{ $emple->id_produccion_orden }},{{ $emple->id_empleado }},{{ $emple->id_empleado2 }})">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" fill="red" class="bi bi-substack"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M15 3.604H1v1.891h14v-1.89ZM1 7.208V16l7-3.926L15 16V7.208zM15 0H1v1.89h14z" />
                                                            </svg>
                                                        </abbr>
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if (Auth::user()->hasRole(['ADMIN', 'PRODUCCION']))
                                                <input value="{{ $emple->tareas }}" type="number"
                                                    id="tearea{{ $emple->id }}"
                                                    onchange="agregar_nueva_tarea({{ $emple->id }},'#tearea{{ $emple->id }}')"
                                                    class="form-control form-control-sm form-control-color"
                                                    style="width: 4rem;">
                                            @else
                                                {{ $emple->tareas }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($emple->tareas == 0 || is_null($emple->marca))
                                                0
                                            @else
                                                @php
                                                    $n = $emple->por_empleado;
                                                    $fraction = $n - intval($n); // .25
                                                @endphp
                                                {{ intval($n) . 'd y ' . number_format($fraction * 8, 0) . 'h' }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm " style="width: 5.5rem;">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text fs-7"
                                                        id="basic-addon1">{{ $emple->moldes_para_uso ?? 0 }}</span>
                                                </div>
                                                @if (Auth::user()->hasRole(['ADMIN', 'PRODUCCION']))
                                                    <input value="{{ $emple->moldes_a_usar }}" type="number"
                                                        id="moldes{{ $emple->id }}"
                                                        onchange="agregar_nueva_moldes({{ $emple->id }},'#moldes{{ $emple->id }}')"
                                                        class="form-control  fs-7">
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @if (Auth::user()->hasRole(['ADMIN', 'PRODUCCION']))
                                                @if (is_null($emple->marca))
                                                <button type="button" class="btn btn-sm btn-danger" wire:click="eliminar_detalle_extra({{ $emple->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-trash3-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                    </svg>
                                                </button>
                                                @else
                                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseExample{{ $key }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-list-check"
                                                        viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                                                    </svg>
                                                </button>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($emple->ring_real == 55)
                                        @php
                                            $emple->ring_real = 56;
                                        @endphp
                                    @elseif($emple->ring_real == 47)
                                        @php
                                            $emple->ring_real = 48;
                                        @endphp
                                    @else
                                    @endif
                                    @isset($usosMoldes[$emple->ring_real])
                                        <tr>
                                            <td colspan="8"></td>
                                            <td colspan="5">
                                                <div class="collapse" id="collapseExample{{ $key }}">
                                                    <div class="card card-body">
                                                        @foreach ($usosMoldes[$emple->ring_real] as $molde)
                                                            <div class="row">
                                                                <div class="col-sm-1">
                                                                    @if ($emple->moldes_para_uso == $emple->moldes_a_usar || $molde->buenos <= 0)
                                                                        @if (isset($apartdoMoldes[$emple->id][$molde->id]))
                                                                            @php
                                                                                $mol =
                                                                                    $apartdoMoldes[$emple->id][
                                                                                        $molde->id
                                                                                    ][0];
                                                                            @endphp
                                                                            @if ($mol->check)
                                                                                <input type="checkbox" checked
                                                                                    name="" id=""
                                                                                    wire:click="asignare_molde({{ $molde->id }},{{ $emple->id }},'collapseExample{{ $key }}')">
                                                                            @else
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if (isset($apartdoMoldes[$emple->id][$molde->id]))
                                                                            @php
                                                                                $mol =
                                                                                    $apartdoMoldes[$emple->id][
                                                                                        $molde->id
                                                                                    ][0];
                                                                            @endphp
                                                                            @if ($mol->check)
                                                                                <input type="checkbox" checked
                                                                                    name="" id=""
                                                                                    wire:click="asignare_molde({{ $molde->id }},{{ $emple->id }},'collapseExample{{ $key }}')">
                                                                            @else
                                                                                <input type="checkbox" name=""
                                                                                    id=""
                                                                                    wire:click="asignare_molde({{ $molde->id }},{{ $emple->id }},'collapseExample{{ $key }}')">
                                                                            @endif
                                                                        @else
                                                                            <input type="checkbox" name=""
                                                                                id=""
                                                                                wire:click="asignare_molde({{ $molde->id }},{{ $emple->id }},'collapseExample{{ $key }}')">
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    {{ $molde->vitola . ' ' . $molde->figuraTipo . ' ' . $molde->material }}
                                                                </div>
                                                                <div class="col-sm-3">{{ $molde->buenos }} </div>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endisset

                                    @php
                                        $moldes_totale_para_usar += $emple->moldes_para_uso;
                                        if (is_null($emple->marca)) {
                                        } else {
                                            $moldes += $emple->moldes;
                                        }
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="input-group" style="width:40%; position: fixed;right: 0px;bottom:0px; height:30px;">
        <span class="form-control input-group-text fs-7">Tareas Global</span>
        <input type="text" class="form-control fs-7" id="sumap1" value="{{ $tareaglobal }}">
        <span class="form-control input-group-text fs-7">Moldes</span>
        <input type="text" class="form-control fs-7" id="sumap2" value="{{ $moldes }}">
        <span class="form-control input-group-text fs-7">Moldes Necesarios</span>
        <input type="text" class="form-control fs-7" id="sumap3"
            value="{{ number_format($moldes_totale_para_usar, 0) }}">
    </div>

    <div wire:ignore class="modal fade" id="modal_agregar_marca" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
        style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo_ctalogo_productos">Marcas</h5>
                    <button id="btn_cerrar" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="catalgo_pendiente">
                        <thead>
                            <tr style="text-align: center">
                                <th style="width: 60px">ID(Agregar)</th>
                                <th>ORDEN</th>
                                <th>PRIORIDAD</th>
                                <th>FECHA</th>
                                <th>PRODUCTO</th>
                                <th>POR PRODUCIR</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 1em">
                            @foreach ($pendiente_catalogo as $key => $pendiente)
                                <tr>
                                    <td>
                                        <a style="text-decoration: none" href="#" data-bs-dismiss="modal"
                                            onclick="agregar_pendiente('{{ $pendiente->id }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-database-add" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Z" />
                                                <path
                                                    d="M12.096 6.223A4.92 4.92 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.493 4.493 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.525 4.525 0 0 1-.813-.927C8.5 14.992 8.252 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.552 4.552 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10c.262 0 .52-.008.774-.024a4.525 4.525 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777ZM3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4Z" />
                                            </svg>
                                        </a>
                                        {{ ++$key }}
                                    </td>
                                    <td style="text-align: center;">{{ $pendiente->orden_sistema }}</td>
                                    @if ($pendiente->prioridad > 0)
                                        @if($pendiente->restantes > $pendiente->prioridad)
                                            <td style="text-align: center; color: red !important">Prioridad: {{ $pendiente->prioridad }}</td>
                                        @else
                                            <td style="text-align: center; color: red !important">Prioridad: {{ $pendiente->restantes }}</td>
                                        @endif
                                    @else
                                        <td style="text-align: center"></td>
                                    @endif
                                    <td>{{ $pendiente->fecha_recibido }}</td>
                                    <td>{{ $pendiente->codigo . ' - ' . $pendiente->producto }}</td>
                                    <td style="text-align: center">{{ $pendiente->restantes }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID(Agregar)</th>
                                <th>ORDEN</th>
                                <th>PRIORIDAD</th>
                                <th>FECHA</th>
                                <th>PRODUCTO</th>
                                <th>POR PRODUCIR</th>
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

    <div wire:ignore class="modal fade" id="modal_agregar_moldes" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
        style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo_ctalogo_productos">Marcas</h5>
                    <button id="btn_cerrar" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="catalgo_molde">
                        <thead>
                            <tr>
                                <th style="width: 60px">ID(Agregar)</th>
                                <th style="text-align: center">VITOLA</th>
                                <th>FIGURA</th>
                                <th>EXISTENCIA</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 1em">
                            @foreach ($moldesss as $key => $molde)
                                <tr>
                                    <td>
                                        <a style="text-decoration: none" href="#" data-bs-dismiss="modal"
                                            onclick="agregar_pendiente('{{ $molde->id }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-database-add" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Z" />
                                                <path
                                                    d="M12.096 6.223A4.92 4.92 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.493 4.493 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.525 4.525 0 0 1-.813-.927C8.5 14.992 8.252 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.552 4.552 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10c.262 0 .52-.008.774-.024a4.525 4.525 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777ZM3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4Z" />
                                            </svg>
                                        </a>
                                        {{ ++$key }}
                                    </td>
                                    <td style="text-align: center">{{ $molde->vitola }}</td>
                                    <td>{{ $molde->figuraTipo }}</td>
                                    <td style="text-align: center">{{ $molde->buenos }}</td>
                                </tr>
                            @endforeach
                        </tbody>
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

    <div wire:ignore class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buscar empleado por modulo</h5>
                    <button type="button" class="btn-close" id="boton_cerrar_buscar" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="selectEmpleado">
                    <select id="selectOptions" onchange="buscar()">
                        <option value="">Seleccionar</option>
                        @foreach ($emplead as $emple)
                            <option value="{{ $emple->id }}">{{ $emple->codigo . '-' . $emple->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore class="modal" id="busquedaEmpleadobonchero" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buscar empleado Bonchero</h5>
                    <button type="button" class="btn-close" id="boton_cerrar_buscarr_bonchero"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="posicion1" hidden>
                    <div id="selectBonchero">
                        <select id="selectBoncheros" onchange="agregar_empleado_bonchero()">
                            <option value="">Seleccionar</option>
                            @foreach ($boncheros['boncheros'] as $bonche)
                                <option value="{{ $bonche->id }}">
                                    {{ $bonche->codigo . ' - ' . $bonche->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore class="modal" id="busquedaEmpleadorolero" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buscar empleado Rolero</h5>
                    <button type="button" class="btn-close" id="boton_cerrar_buscar_rolero" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="posicion2" hidden>
                    <div id="selectRolero">
                        <select id="selectRoleros" onchange="agregar_empleado_rolero()">
                            <option value="">Seleccionar</option>
                            @foreach ($roleros['roleros'] as $rolero)
                                <option value="{{ $rolero->id }}">
                                    {{ $rolero->codigo . ' - ' . $rolero->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore class="modal fade" id="modal_programar_marca" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
        style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo_ctalogo_productos">Marcas</h5>
                    <button id="btn_cerrar" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="catalgo_pendiente_asignar_por_marca">
                        <thead>
                            <tr style="text-align: center">
                                <th style="width: 60px">ID(Agregar)</th>
                                <th>ORDEN</th>
                                <th>PRIORIDAD</th>
                                <th>FECHA</th>
                                <th>PRODUCTO</th>
                                <th>POR PRODUCIR</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 1em">
                            @foreach ($pendiente_catalogo as $key => $pendiente)
                                <tr>
                                    <td>
                                        <a style="text-decoration: none" href="#" data-bs-dismiss="modal"
                                            onclick="agregar_pendiente('{{ $pendiente->id }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-database-add" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Z" />
                                                <path
                                                    d="M12.096 6.223A4.92 4.92 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.493 4.493 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.525 4.525 0 0 1-.813-.927C8.5 14.992 8.252 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.552 4.552 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10c.262 0 .52-.008.774-.024a4.525 4.525 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777ZM3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4Z" />
                                            </svg>
                                        </a>
                                        {{ ++$key }}
                                    </td>
                                    <td style="text-align: center;">{{ $pendiente->orden_sistema }}</td>
                                    @if ($pendiente->prioridad > 0)
                                        <td style="text-align: center; color: red !important">Prioridad: {{ $pendiente->prioridad }}</td>
                                    @else
                                        <td style="text-align: center"></td>
                                    @endif
                                    <td>{{ $pendiente->fecha_recibido }}</td>
                                    <td>{{ $pendiente->codigo . ' - ' . $pendiente->producto }}</td>
                                    <td style="text-align: center">{{ $pendiente->restantes }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID(Agregar)</th>
                                <th>ORDEN</th>
                                <th>PRIORIDAD</th>
                                <th>FECHA</th>
                                <th>PRODUCTO</th>
                                <th>POR PRODUCIR</th>
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


    @push('scripts')
        <script>
            var id_detalles = 0;
            var para_detalle_extra = false;
            var id_modulo = 0;

            let id_tupla = 0;
            var table;
            let buscador;
            let boncheros;
            let roleros;

            function agregar_id_rolero(id, columna_rolero, rols) {
                $('#posicion2').val(columna_rolero);

                document.getElementById('selectRolero').innerHTML = "";
                var emple = JSON.parse(rols);
                var select = `<select id="selectRoleros" onchange="agregar_empleado_rolero()">
                                    <option value="">Seleccionar</option>`
                emple.forEach(element => {
                    select += `<option value="${element.id}">${element.codigo}-${element.nombre}</option>`;
                });
                select += `</select>`;
                document.getElementById('selectRolero').innerHTML = select;
                roleros = new TomSelect('#selectRoleros', {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });

                console.log('Rolero: ' + emple.length);

                id_tupla = id;
                roleros.open();
            }

            function agregar_id_bonchero(id, columna_bonchero, bonche) {
                $('#posicion1').val(columna_bonchero);


                document.getElementById('selectBonchero').innerHTML = "";
                var emple = JSON.parse(bonche);
                var select = `<select id="selectBoncheros" onchange="agregar_empleado_bonchero()">
                                    <option value="">Seleccionar</option>`
                emple.forEach(element => {
                    select += `<option value="${element.id}">${element.codigo}-${element.nombre}</option>`;
                });
                select += `</select>`;
                document.getElementById('selectBonchero').innerHTML = select;
                boncheros = new TomSelect('#selectBoncheros', {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });


                boncheros.open();
                id_tupla = id;
            }

            function agregar_nueva_tupla(num, select) {
                @this.nueva_tupla_detalle(num, $('#' + select).val());
            }

            function agregar_revisador_modulo(id, select, num) {
                @this.agregar_revisador_modulo(id, $('#' + select).val(), num);
            }

            function agregar_nueva_tarea(id, num) {
                @this.nueva_tareas(id, $(num).val());
            }

            function agregar_nueva_moldes(id, num) {
                @this.nueva_moldes(id, $(num).val());
            }


            function agregar_pendiente(id) {
                if (para_detalle_extra) {
                    @this.agregar_detalle_extra(id_detalles, id_modulo, id);
                } else {
                    @this.agregar_detalle(id_detalles, 3, id);
                }
                para_detalle_extra = false;
            }



            function historial(key) {
                let historial = JSON.parse(key);

                let html = `<table class='table table-hover table-sm' ">
                            <thead>
                                <tr>
                                    <th>Vitola</th>
                                    <th>Nombre</th>
                                    <th>Existencia</th>
                                    <th>Usado</th>
                                </tr>
                            </thead>
                            <tbody>`;

                historial.forEach(e => {

                    html += `<tr>
                                <td>${e.vitola}</td>
                                <td>${e.figuraTipo} ${e.material}</td>
                                <td>${e.buenos}</td>
                                <td>
                                    <input type="checkbox" name="" id="" ` + (e.buenos ? `checked` : ``) + `>
                                </td>
                            </tr>
                            `;

                });

                html += `</tbody>
                        </table>`;

                Swal.fire({
                    title: '<strong>Moldes usables</strong>',
                    html: html,
                    width: 1200,
                    showCloseButton: true,
                    showCancelButton: false,
                    confirmButtonText: '<i class="fa fa-thumbs-up"></i> Great!',
                    confirmButtonAriaLabel: 'Thumbs up, great!',
                    cancelButtonText: '<i class="fa fa-thumbs-down"></i>',
                    cancelButtonAriaLabel: 'Thumbs down'
                })

            }

            function exportar_documentos() {

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: 'Exportar documentos',
                    focusConfirm: false,
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Promedio Semanal',
                    cancelButtonText: 'Planificación',

                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.imprimir_planificacion_semanal();
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        @this.imprimir_planificacion();
                    }
                })
            }

            function vinetas() {

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: 'Viñetas por Orden',
                    focusConfirm: false,
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Generar',
                    cancelButtonText: 'Exportar',

                }).then((result) => {
                    if (result.isConfirmed) {
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your imaginary file is safe :)',
                            'error'
                        )
                    }
                })
            }

            async function moldes_parejas() {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: 'Exportar Docuemtos Moldes',
                    focusConfirm: false,
                    showConfirmButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Moldes Restantes',
                    cancelButtonText: 'Planificación',

                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.imprimir_moldes_restantes();
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        //@this.imprimir_planificacion();
                    }
                })
            }

            $(document).ready(function() {
                $('#catalgo_pendiente').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                        "pageLength": 50
                    },
                    "paging": true,
                    "autoWidth": true,
                    "columnDefs": [{
                        "targets": 2,
                        "render": function(data, type, full, meta) {
                            if (type === 'display' && data == '') {
                                return data;
                            } else {
                               // console.log(meta.row + 1);
                                var rowIndex = meta.row + 1;
                                $('#catalgo_pendiente tbody tr:nth-child(' + rowIndex + ')').addClass('lightRed');
                                return data;
                            }
                        }
                    }],
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
                                input.style.width = "167px";

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

                $('#catalgo_pendiente_asignar_por_marca').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                        "pageLength": 50
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
                                input.style.width = "200px";

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

                buscador = new TomSelect('#selectOptions', {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });

                boncheros = new TomSelect('#selectBoncheros', {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });

                roleros = new TomSelect('#selectRoleros', {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });

            });

            window.addEventListener('abrirOpciones', event => {
                $('#' + event.detail.id).collapse('toggle');
            })



            function seleccionar_tupla(id) {
                id_detalles = id;
            }

            function seleccionar_tupla_extra(id,modulo) {
                id_detalles = id;
                para_detalle_extra = true;
                id_modulo = modulo;
            }



            function buscar() {
                let empleados = @json($emplead);
                let id = buscador.getValue();
                empleados.filter((empleado) => {
                    if (empleado.id == id) {
                        @this.cambiar_modulo(empleado.modulo);
                        @this.nombre_empleado = empleado.nombre;
                        $('#boton_cerrar_buscar').click();
                    }
                });
            }


            function agregar_empleado_rolero() {
                $('#boton_cerrar_buscar_rolero').click();
                @this.agregar_detalle(id_tupla, 2, roleros.getValue());


            }

            function agregar_empleado_bonchero() {
                $('#boton_cerrar_buscarr_bonchero').click();
                @this.agregar_detalle(id_tupla, 1, boncheros.getValue());
            }

            function generar_viñetas_pdf(id_orden, id_rolero, id_bonchero) {
                var opcion = confirm("Desea geneara las viñetas para esta pareja?");
                if (opcion == true) {
                    if (id_rolero === undefined) {
                        id_rolero = '0';
                    }
                    if (id_bonchero === undefined) {
                        id_bonchero = '0';
                    }
                    window.location = "{{ route('produccion.producir.vinetas') }}" + "?id_orden=" + id_orden +
                        "&id_bonchero=" + id_bonchero + "&id_rolero=" + id_rolero + "";
                } else {

                }
            }
        </script>
    @endpush
</div>
