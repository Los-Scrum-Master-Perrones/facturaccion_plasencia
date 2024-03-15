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
    </style>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="green" viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="check-fill-imcomple" fill="orange" viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="info-fill" fill="blue" viewBox="0 0 16 16">
            <path
                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="red" viewBox="0 0 16 16">
            <path
                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>
    @if (auth()->user()->rol == -2)
        <br>
    @else
        <ul class="nav nav-tabs justify-content-center">
            @if (auth()->user()->rol == 0 || auth()->user()->rol == 1)
                <li class="nav-item">
                    <a class="nav-link" style="color:white; font-size:12px;"
                        href="{{ route('inventario_cajas') }}"><strong>Catálogo
                            Cajas</strong></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color:white; font-size:12px;"
                        href="{{ route('index_importar_cajas') }}"><strong>Importar
                            Cajas</strong></a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" style="color:#E5B1E2; font-size:12px;"
                    href="{{ route('materiales.index') }}"><strong>Materiales</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color:white; font-size:12px;"
                    href="{{ route('materiales.relacionar') }}"><strong>Materiales
                        materials</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color:white;  font-size:12px;"
                    href="{{ route('entradas.salidas') }}"><strong>Entrada/Salida</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color:white;  font-size:12px;"
                    href="{{ route('inventario.materiales') }}"><strong>Inventario</strong></a>
            </li>
        </ul>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card" style="height: 91vh;">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3" wire:ignore style="height: 30px">
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                @if (Auth::user()->rol == -2)
                                @else
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#material_nuevo"
                                        class="btn btn-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                            <path
                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                        </svg>
                                    </button>
                                @endif
                                <button id="btn_guardar" class="btn btn-warning fs-7"
                                    wire:click='imprimir()'>Imprimir</button>
                                <button id="btn_guardar" class="btn btn-danger fs-7"
                                    wire:click='imprimir_valores(0)'>Imprimir (Sin Existencia)</button>
                                <button id="btn_guardar" class="btn btn-primary fs-7"
                                    wire:click='imprimir_valores(1)'>Imprimir (Bajo minimo)</button>
                                <button id="btn_guardar" class="btn btn-dark fs-7"
                                    wire:click='imprimir_valores(2)'>Imprimir (Bajo y sin Existencia)</button>
                            </div>
                        </div>
                        <div class="col-md-1" wire:ignore>
                        </div>
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-1" wire:ignore style="height: 30px"></div>
                        <div class="col-md-2">
                            <div class="input-group mb-3" style="height: 30px">
                                <span class="input-group-text" id="basic-addon1"
                                    style="height: 30px;font-size: 0.7em">Por
                                    Pagina</span>
                                <select name="" id="" class="form-control" wire:model='por_pagina'
                                    style="height: 30px;font-size: 0.7em">
                                    <option value="50">50</option>
                                    <option value="200">200</option>
                                    <option value="500">500</option>
                                    <option value="1000">1000</option>
                                    <option value="{{ $total }}">Todo</option>
                                </select>
                                {{-- <button class="btn btn-success" wire:click='imprimir_reporte' style="height: 30px">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-file-spreadsheet" viewBox="0 0 16 16">
                                        <path
                                            d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v4h10V2a1 1 0 0 0-1-1H4zm9 6h-3v2h3V7zm0 3h-3v2h3v-2zm0 3h-3v2h2a1 1 0 0 0 1-1v-1zm-4 2v-2H6v2h3zm-4 0v-2H3v1a1 1 0 0 0 1 1h1zm-2-3h2v-2H3v2zm0-3h2V7H3v2zm3-2v2h3V7H6zm3 3H6v2h3v-2z" />
                                    </svg>
                                </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="height: 72vh;">
                        <table class="table table-light table-hover" style="font-size:10px; ">
                            <thead>
                                <tr style="font-size:16px; text-align:center;">
                                    <th style=" text-align:center;">N#</th>
                                    <th style=" text-align:center;">Opera.</th>
                                    @if (Auth::user()->rol == -2)
                                    @else
                                        <th style=" text-align:center;">Movimi.</th>
                                    @endif
                                    <th wire:ignore style=" text-align:center;">
                                        <select name="todas_fitem" id="todas_fitem" onchange="buscar_io()">
                                            <option value="">Factory Item</option>
                                            @foreach ($items_factory as $v)
                                                <option value="{{ $v }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th wire:ignore style=" text-align:center;">
                                        <select name="todas_nitem" id="todas_nitem" onchange="buscar_io()">
                                            <option value="">Navision Item</option>
                                            @foreach ($items_navisor as $v)
                                                <option value="{{ $v }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th wire:ignore style=" text-align:center;">
                                        <select name="todas_cmaterial" id="todas_cmaterial" onchange="buscar_io()">
                                            <option value="">Codigo Material</option>
                                            @foreach ($items_codigo as $v)
                                                <option value="{{ $v }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th wire:ignore>
                                        <select name="todas_descripcion" id="todas_descripcion"
                                            onchange="buscar_io()">
                                            <option value="">Descripción</option>
                                            @foreach ($descripcion as $v)
                                                <option value="{{ $v }}">{{ $v }}</option>
                                            @endforeach
                                        </select>

                                    </th>
                                    <th wire:ignore>
                                        <select name="todas_Brand" id="todas_Brand" onchange="buscar_io()">
                                            <option value="">Brand</option>
                                            @foreach ($brand as $v)
                                                <option value="{{ $v }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th>Linea</th>
                                    <th style="text-align:center;">Mal Estado</th>
                                    <th style="text-align:center;">Faltante</th>
                                    <th style="text-align:center;">Saldo Minimo</th>
                                    <th style="text-align:center;">Saldo</th>
                                    <th style="text-align:center;">Saldo Neto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 1;
                                    $saldo = 0;
                                    $saldoNeto = 0;
                                @endphp

                                @foreach ($datos_materiales as $material)
                                    <tr>
                                        <td style=" text-align:center;">{{ $count }}</td>
                                        <td>
                                            <a data-bs-toggle="modal" data-bs-target="#material_actualizar"
                                                style="width:10px; height:10px;" href="#"
                                                onclick="editar_material({{ $material->id }},
                                                                                        '{{ $material->factory_item }}',
                                                                                        '{{ $material->navision_item }}',
                                                                                        '{{ $material->codigo_material }}',
                                                                                        '{{ $material->item_description }}',
                                                                                        '{{ $material->brand }}',
                                                                                        '{{ $material->linea }}',
                                                                                        '{{ $material->saldo_minimo }}',
                                                                                        '{{ intval($material->saldo) }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    fill="currentColor" class="bi bi-pencil-square"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>
                                            </a>
                                            @if (Auth::user()->rol == -2)
                                            @else
                                                <a onclick="eliminar_material({{ $material->id }})" href="#">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" clcass="bi bi-trash-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                    </svg>
                                                </a>
                                            @endif
                                        </td>
                                        @if (Auth::user()->rol == -2)
                                        @else
                                            <td style=" text-align:center;">
                                                <a onclick="traslardr({{ $material->id }},1,'{{ $material->codigo_material }}')"
                                                    href="#">
                                                    <abbr title="Trasladar">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z" />
                                                        </svg>
                                                    </abbr>
                                                </a>
                                                <a onclick="traslardr({{ $material->id }},2,'{{ $material->codigo_material }}')"
                                                    href="#">
                                                    <abbr title="Entrada">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-basket-fill" viewBox="0 0 16 16">
                                                            <path
                                                                d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717L5.07 1.243zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3z" />
                                                        </svg>
                                                    </abbr>
                                                </a>
                                                <a onclick="traslardr({{ $material->id }},3,'{{ $material->codigo_material }}')"
                                                    href="#">
                                                    <abbr title="Salida">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-folder-symlink" viewBox="0 0 16 16">
                                                            <path
                                                                d="m11.798 8.271-3.182 1.97c-.27.166-.616-.036-.616-.372V9.1s-2.571-.3-4 2.4c.571-4.8 3.143-4.8 4-4.8v-.769c0-.336.346-.538.616-.371l3.182 1.969c.27.166.27.576 0 .742z" />
                                                            <path
                                                                d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm.694 2.09A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09l-.636 7a1 1 0 0 1-.996.91H2.826a1 1 0 0 1-.995-.91l-.637-7zM6.172 2a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z" />
                                                        </svg>
                                                    </abbr>
                                                </a>
                                            </td>
                                        @endif

                                        <td style=" text-align:center;">{{ $material->factory_item }}</td>
                                        <td style=" text-align:center;">{{ $material->navision_item }}</td>
                                        <td style=" text-align:center;">{{ $material->codigo_material }}</td>
                                        <td>{{ $material->item_description }}

                                            @if ($material->saldo_minimo <= $material->saldo && $material->saldo > 0 && $material->saldo != 0)
                                                <abbr title="Listo para Enviar">
                                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24"
                                                        role="img" aria-label="Success:">
                                                        <use xlink:href="#check-circle-fill" />
                                                    </svg>
                                                </abbr>
                                            @endif

                                            @if ($material->saldo_minimo > $material->saldo)
                                                <abbr title="Esta bajo el minimo requerido">
                                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24"
                                                        role="img" aria-label="Success:">
                                                        <use xlink:href="#check-fill-imcomple" />
                                                    </svg>
                                                </abbr>
                                            @endif

                                            @if ($material->faltantes > 0)
                                                <abbr title="Hay Material Pendiente">
                                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24"
                                                        role="img" aria-label="Success:">
                                                        <use xlink:href="#info-fill" />
                                                    </svg>
                                                </abbr>
                                            @endif

                                            @if ($material->saldo == 0)
                                                <abbr title="No hay en Existencia">
                                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24"
                                                        role="img" aria-label="Success:">
                                                        <use xlink:href="#exclamation-triangle-fill" />
                                                    </svg>
                                                </abbr>
                                            @endif


                                        </td>
                                        <td>{{ $material->brand }}</td>
                                        <td>{{ $material->linea }}</td>
                                        @php
                                            if (intval($material->saldo) < 0) {
                                                DB::update(
                                                    'UPDATE materiales_catalogo
                                                        SET saldo = 0,
                                                            faltantes = faltantes + ?
                                                        WHERE id = ?',
                                                    [$material->saldo * -1, $material->id],
                                                );

                                                $material->faltantes = $material->saldo * -1;
                                                $material->saldo = 0;
                                            }

                                        @endphp
                                        <td style=" text-align:center;">{{ number_format($material->mal_estado) }}
                                        </td>
                                        <td style=" text-align:center;">{{ number_format($material->faltantes) }}</td>
                                        <td style=" text-align:center;">{{ number_format($material->saldo_minimo) }}
                                        </td>
                                        <td style=" text-align:center;">{{ number_format($material->saldo, 0) }}</td>
                                        <td style=" text-align:center;">
                                            {{ number_format($material->mal_estado + $material->faltantes + $material->saldo, 0) }}
                                        </td>
                                    </tr>
                                    <?php
                                    $count++;
                                    $saldo += $material->saldo;
                                    $saldoNeto += $material->mal_estado + $material->faltantes + $material->saldo;
                                    ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">{{ $datos_materiales->links() }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="input-group" style="width:30%;position: fixed;right: 0px;bottom:0px; height:30px;">
        <span class="form-control input-group-text">Total</span>
        <input type="text" class="form-control" value="{{ number_format($saldo, 0) }}">

        <span class="form-control input-group-text">Total neto</span>
        <input type="text" class="form-control" id="sumase" value="{{ number_format($saldoNeto, 0) }}">
    </div>


    <div class="modal fade" id="material_actualizar" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="material_actualizar" aria-hidden="true" style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-lg">
            <!-- INICIO DEL MODAL ACTUALIZAR MATERIAL -->
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="staticBackdropLabel"><strong>Actualizar Material</strong></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                </div>

                <div class="modal-body">
                    <div class="card-body">
                        <input type="text" name="ided" id="ided" hidden>
                        <div class="row">
                            <div class="mb-4 col">
                                <label for="txt_malos" class="form-label">Factory Item</label>
                                <input class="form-control" @if (Auth::user()->rol == -2) readonly @endif
                                    name="factoryed" id="factoryed" style=" height:30px;">
                            </div>
                            <div class="mb-4 col">
                                <label for="txt_malos" class="form-label">Navisor Item</label>
                                <input class="form-control" @if (Auth::user()->rol == -2) readonly @endif
                                    name="navisored" id="navisored" style=" height:30px;">
                            </div>
                            <div class="mb-4 col">

                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-4 col">
                                <label for="txt_figuraytipo" class="form-label">Brand</label>
                                <input style=" height:30px; width: 100%;"
                                    @if (Auth::user()->rol == -2) readonly @endif name="branded" id="branded">
                            </div>
                            <div class="mb-4 col">
                                <label for="txt_malos" class="form-label">Linea</label>
                                <input style=" height:30px; width: 100%;"
                                    @if (Auth::user()->rol == -2) readonly @endif name="lineaed" id="lineaed">
                            </div>
                            <div class="mb-4 col">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-12 col">
                                <label for="txt_figuraytipo" class="form-label">Descripción</label>
                                <input name="desed" id="desed" style="font-size:16px" class="form-control"
                                    @if (Auth::user()->rol == -2) readonly @endif type="text"
                                    autocomplete="off">
                            </div>
                        </div>
                        <br>

                        <div wire:ignore class="row">
                            <div class="mb-12 col">
                                <label for="txt_figuraytipo" style="z-index: 999">Código Material</label>
                                <select class="codigobus" name="codigoed" id="codigoed" style="height:30px;"
                                    @if (Auth::user()->rol == -2) readonly @endif required>
                                    <option value="">Todos los codigos</option>
                                    @foreach ($items_codigo_existentes as $codigo_existentes)
                                        <option value="{{ $codigo_existentes->codigo_material }}">
                                            {{ $codigo_existentes->codigo_material . ' ' . $codigo_existentes->des_material }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="mb-3 col">

                            </div>
                            <div class="mb-3 col">
                                <label for="txt_total" class="form-label">Saldo Minimo</label>
                                <input name="saldo_med" id="saldo_med" class="form-control" required type="number"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                                <label for="txt_buenos" class="form-label">Saldo</label>
                                <input name="saldo_ed" id="saldo_ed" class="form-control"
                                    @if (Auth::user()->rol == -2) readonly @endif required type="number"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                            </div>
                            <div class="mb-3 col">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <span>Cancelar</span>
                    </button>
                    <button onclick="actulizar_material()" class="btn btn-success"> <span>Guardar</span> </button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="material_nuevo" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="material_nuevo" aria-hidden="true" style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-lg">
            <!-- INICIO DEL MODAL NUEVO PRODUCTO -->
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="staticBackdropLabel"><strong>Nuevo Material</strong></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                </div>

                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-4 col">
                                <label for="txt_malos" class="form-label">Factory Item</label>
                                <input class="form-control" name="new_factoryed" id="new_factoryed"
                                    style=" height:30px;"
                                    value="{{ 'RP-0' . (intval(substr($factoryItemUltimo, 3)) + 1) }}">
                            </div>
                            <div class="mb-4 col">
                                <label for="txt_malos" class="form-label">Navisor Item</label>
                                <input class="form-control" name="new_navisored" value="No Hay descripción"
                                    id="new_navisored" style=" height:30px;">
                            </div>
                            <div class="mb-4 col">

                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-4 col">
                                <label for="txt_figuraytipo" class="form-label">Brand</label>
                                <input style=" height:30px; width: 100%;" value="No Hay descripción"
                                    name="new_branded" id="new_branded">
                            </div>
                            <div class="mb-4 col">
                                <label for="txt_malos" class="form-label">Linea</label>
                                <input style=" height:30px; width: 100%;" value="No Hay descripción"
                                    name="new_lineaed" id="new_lineaed">
                            </div>
                            <div class="mb-4 col">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-12 col">
                                <label for="txt_figuraytipo" class="form-label">Descripción</label>
                                <input name="new_desed" id="new_desed" style="font-size:16px" class="form-control"
                                    type="text" autocomplete="off">
                            </div>
                        </div>
                        <br>

                        <div wire:ignore class="row">
                            <div class="mb-12 col">
                                <label for="txt_figuraytipo" style="z-index: 999">Código Material</label>
                                <select class="codigobus" name="new_codigoed" id="new_codigoed" style="height:30px;"
                                    required>
                                    <option value="">Todos los codigos</option>
                                    @foreach ($items_codigo_existentes as $codigo_existentes)
                                        <option value="{{ $codigo_existentes->codigo_material }}">
                                            {{ $codigo_existentes->codigo_material . ' ' . $codigo_existentes->des_material }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="mb-3 col">

                            </div>
                            <div class="mb-3 col">
                                <label for="txt_total" class="form-label">Saldo Minimo</label>
                                <input name="new_saldo_med" id="new_saldo_med" class="form-control" required
                                    type="number" autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                                <label for="txt_buenos" class="form-label">Saldo</label>
                                <input name="new_saldo_ed" id="new_saldo_ed" class="form-control" required
                                    type="number" autocomplete="off">
                            </div>
                            <div class="mb-3 col">

                            </div>
                            <div class="mb-3 col">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <span>Cancelar</span>
                    </button>
                    <button onclick="insertar_material()" class="btn btn-success"> <span>Guardar</span> </button>
                </div>
            </div>
        </div>
    </div>



    @push('scripts')
        <script>
            var control;
            var new_control;
            window.addEventListener('tamanio_tabla', event => {
                $('#tabla_materiales').css('height', ($('#bos').height() - 230));
            });


            $(document).ready(function() {
                $('#tabla_materiales').css('height', ($('#bos').height() - 230));
                var seletscc = ["todas_Brand", "todas_cmaterial", "todas_nitem", "todas_fitem", "todas_descripcion"];
                seletscc.forEach(element => {
                    selects(element);
                });


                control = new TomSelect("#codigoed", {
                    create: true,
                    plugins: ['change_listener'],
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });

                new_control = new TomSelect("#new_codigoed", {
                    create: true,
                    plugins: ['change_listener'],
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
            });

            function selects(nombre) {
                new TomSelect("#" + nombre, {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });

            }

            function buscar_io() {
                @this.factory = $('#todas_fitem').val();
                @this.navisor = $('#todas_nitem').val();
                @this.codigo = $('#todas_cmaterial').val();
                @this.br = $('#todas_Brand').val();
                @this.descrip = $('#todas_descripcion').val();
                @this.paginacion = 0;
            }

            async function traslardr(id, operacion, codigo_material) {

                var titulo = 'Traspasar Material';
                var html = '';

                if (operacion == 1) {
                    titulo = 'Traspasar Material';
                    html =
                        '<input id="swal-input1" placeholder="Cantidad" type="number" style="width: 80%" class="swal2-input form-control">' +
                        '<input type="date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" id="swal-input2" style="width: 80%" class="swal2-input form-control">' +
                        '<select id="swal-input3"  style="width: 80%;margin: 1em 2em 3px;" class="swal2-input form-control">' +
                        '<option value="Mal Estado">Mal Estado</option>' +
                        '<option value="Faltante">Faltante</option>' +
                        '</select>';
                }
                if (operacion == 2) {
                    titulo = 'Entrada Material';
                    html =
                        '<input id="swal-input1" placeholder="Cantidad" type="number"  style="width: 80%" class="swal2-input form-control">' +
                        '<input type="date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" id="swal-input2" style="width: 80%" class="swal2-input form-control">' +
                        '<select id="swal-input3"  style="width: 80%;margin: 1em 2em 3px;" class="swal2-input form-control">' +
                        '<option value="Entrada Normal Material">Entrada Normal</option>' +
                        '<option value="Mal Estado Material">Renovar Material Dañado</option>' +
                        '<option value="Faltante Material">Material faltante</option>' +
                        '</select>';
                }
                if (operacion == 3) {
                    titulo = 'Salida Material';
                    html =
                        '<input id="swal-input1" placeholder="Cantidad" type="number" style="width: 80%" class="swal2-input form-control">' +
                        '<input id="swal-input2" placeholder="Descripcion" style="width: 80%" class="swal2-input form-control">' +
                        '<input type="date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" id="swal-input3" style="width: 80%" class="swal2-input form-control">';
                }

                const {
                    value: formValues
                } = await Swal.fire({
                    title: titulo,
                    html: html,
                    focusConfirm: true,
                    preConfirm: () => {

                        let swalinput1 = document.getElementById('swal-input1').value;
                        let swalinput2 = document.getElementById('swal-input2').value;
                        let swalinput3 = document.getElementById('swal-input3').value;

                        if (!swalinput1) {
                            Swal.showValidationMessage('Por favor ingrese la cantidad de la operacion')
                        } else if (!swalinput2) {
                            Swal.showValidationMessage('Por favor ingrese la direccion')
                        } else if (!swalinput3) {
                            Swal.showValidationMessage('Por favor agregue el tipo de operacion')
                        } else if (isNaN(swalinput1)) {
                            Swal.showValidationMessage('La cantidad debe ser un número')
                        } else {
                            return [
                                id,
                                codigo_material,
                                document.getElementById('swal-input1').value,
                                document.getElementById('swal-input2').value,
                                document.getElementById('swal-input3').value,
                            ]
                        }

                    }
                });

                if (formValues) {
                    if (operacion == 1) {

                        @this.materiales_traspaso({
                            'pa_id': formValues[0],
                            'pa_codigo': formValues[1],
                            'pa_fecha': formValues[3],
                            'pa_cantidad': formValues[2],
                            'pa_tipo': formValues[4],
                            'pa_descripcion': formValues[4]
                        });
                    }
                    if (operacion == 2) {

                        @this.materiales_entrada({
                            'pa_id': formValues[0],
                            'pa_codigo': formValues[1],
                            'pa_fecha': formValues[3],
                            'pa_cantidad': formValues[2],
                            'pa_tipo': formValues[4],
                            'pa_descripcion': formValues[4]
                        });
                    }

                    if (operacion == 3) {
                        @this.materiales_salida({
                            'pa_id': formValues[0],
                            'pa_codigo': formValues[1],
                            'pa_fecha': formValues[4],
                            'pa_cantidad': formValues[2],
                            'pa_tipo': 'Salida Material',
                            'pa_descripcion': formValues[3]
                        });
                    }
                }
            }

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

            window.addEventListener('entrada_exitoso', event => {
                Toast.fire({
                    icon: 'success',
                    title: 'Realizado con Exito!'
                })

                $('#tabla_materiales').css('height', ($('#bos').height() - 180));
            })

            window.addEventListener('entrdas_errornea', event => {
                Toast.fire({
                    icon: 'error',
                    title: 'Hay campos erroneos.\n' + event.detail.mensaje
                })
            });



            function eliminar_material(id) {
                Swal.fire({
                    title: 'Esta seguro?',
                    text: "No se puede revertir este cambio!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.eliminar_material(id);
                    }
                })
            }





            window.addEventListener('eliminacion_exitoso', event => {
                Swal.fire('Eliminado con exito!', '', 'success');

                $('#tabla_materiales').css('height', ($('#bos').height() - 180));
            })



            async function insertar_material() {

                if ($('#new_factoryed').val() == "" || $('#new_navisored').val() == "" ||
                    $('#new_desed').val() == "" ||
                    $('#new_branded').val() == "" || $('#new_lineaed').val() == "" ||
                    $('#new_saldo_med').val() == "" || $('#new_saldo_ed').val() == "") {
                    toastr.info('Hay compos requeridos vacios.', 'Advertencia!');
                } else {

                    await @this.insertar_material({
                        'factoryed': $('#new_factoryed').val(),
                        'navisored': $('#new_navisored').val(),
                        'desed': $('#new_desed').val(),
                        'branded': $('#new_branded').val(),
                        'saldo_med': $('#new_saldo_med').val(),
                        'saldo_ed': $('#new_saldo_ed').val(),
                        'codigoed': $('#new_codigoed').val(),
                        'lineaed': $('#new_lineaed').val(),
                    });

                }
            }

            window.addEventListener('insercion_exitoso', event => {
                Swal.fire('Insertado con exito!', '', 'success');

                $('#material_nuevo').modal('hide')
                $('#tabla_materiales').css('height', ($('#bos').height() - 180));
            })

            window.addEventListener('insercion_falta', event => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hay campos erroneos.\n' + event.detail.mensaje
                });
            });





            function editar_material(id, factory_item, navision_item, codigo_material, item_description, brand, linea,
                saldo_minimo, saldo) {

                $('#ided').val(id);
                $('#factoryed').val(factory_item);
                $('#navisored').val(navision_item);
                control.setValue(codigo_material);
                $('#desed').val(item_description);
                $('#branded').val(brand);
                $('#lineaed').val(linea);
                $('#saldo_med').val(saldo_minimo);
                $('#saldo_ed').val(saldo);

                if ('{{ Auth::user()->rol }}' == -2) {
                    control.disable();
                }


            }


            async function actulizar_material() {

                if ($('#factoryed').val() == "" || $('#navisored').val() == "" ||
                    $('#desed').val() == "" ||
                    $('#branded').val() == "" || $('#lineaed').val() == "" ||
                    $('#saldo_med').val() == "" || $('#saldo_ed').val() == "") {
                    toastr.info('Hay compos requeridos vacios.', 'Advertencia!');
                } else {
                    await @this.actualizar_material({
                        'ided': $('#ided').val(),
                        'factoryed': $('#factoryed').val(),
                        'navisored': $('#navisored').val(),
                        'desed': $('#desed').val(),
                        'branded': $('#branded').val(),
                        'saldo_med': $('#saldo_med').val(),
                        'saldo_ed': $('#saldo_ed').val(),
                        'codigoed': $('#codigoed').val(),
                        'lineaed': $('#lineaed').val(),
                    });

                }
            }

            window.addEventListener('actualiza_exitoso', event => {
                Swal.fire('Actualizado con exito!', '', 'success');

                $('#material_actualizar').modal('hide')
                $('#tabla_materiales').css('height', ($('#bos').height() - 180));
            })

            window.addEventListener('actualiza_falta', event => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hay campos erroneos.\n' + event.detail.mensaje
                });
            });
        </script>
    @endpush
</div>
