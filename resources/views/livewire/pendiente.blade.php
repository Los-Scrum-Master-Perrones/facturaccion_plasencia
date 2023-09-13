<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <ul class="nav justify-content-center">
        @if (auth()->user()->rol == -1)
        @else
        <li class="nav-item">
            <a style="color:#E5B1E2; font-size:12px;" href="pendiente"><strong>Pendiente</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="import_excel"><strong>Importar pedido</strong></a>
        </li>
        @endif

        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="pendiente_salida"><strong>Reporte</strong></a>
        </li>

        <li class="nav-item">
            <a style="color:white; font-size:12px;" data-toggle="modal" href=""
                data-target="#generarremisioncajas"><strong>Pedido Cajas <br> de Madera</strong></a>
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
                    <div>
                        <div class="btn-group" style="height: 35px;" role="group" aria-label="Basic mixed styles example">
                            @if (auth()->user()->rol == -1)
                            @else

                                    <button class="btn btn-dark" data-toggle="modal" data-target="#productos_crear">
                                        <abbr title="Agregar nuevo producto">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path
                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                            </svg>
                                        Producto
                                        </abbr>
                                    </button>

                            @endif
                            <button class="btn btn-danger" wire:click="exportPendiente()">
                                <abbr title="Exportar a excel">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
                                    <path
                                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z" />
                                </svg>
                                </abbr>
                            </button>
                            <button class="btn btn-info" onclick="actualizar_datos()">
                                <abbr title="Preparar Reporte Materiales">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-basket" viewBox="0 0 16 16">
                                    <path
                                        d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z" />
                                </svg>
                                </abbr>
                            </button>

                            <button class="btn btn-success" onclick="exportar_pendiente()">
                                <abbr title="Exportar Materiales Pendiente">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-list-check" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                </abbr>
                            </button>

                            <button class="btn btn-warning" onclick="exportar_materiales()">
                                <abbr title="Exportar Solo Materiales">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-list-columns-reverse" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5Zm-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Z" />
                                </svg>
                            </abbr>
                            </button>


                                <form id="form_actualizar_datos" action="{{ route('materiales.actualizar_datos') }}" method="POST">
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

                                <form  id="form_exportar_pendiente" action="{{ route('materiales.exporPendiente') }}" method="POST">
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

                                <form id="form_exportar_materiales" action="{{ route('materiales.exportMateriales') }}" method="POST">
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
                            <input class="form-check-input " type="checkbox" value="Puros Brocha" id="checkbox7" checked
                                name="checkbox7" wire:model="r_mill">
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
                    @foreach ($items_p as $item)
                    <option style="overflow-y: scroll;"> {{ $item->item }}</option>
                    @endforeach
                </select>
            </div>


            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_orden" id="b_orden" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todas las ordenes del sistema</option>
                    @foreach ($ordenes_p as $orden)
                    <option style="overflow-y: scroll;"> {{ $orden->orden_del_sitema }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_hon" id="b_hon" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todas las ordenes</option>
                    @foreach ($hons_p as $hon)
                    <option style="overflow-y: scroll;"> {{ $hon->orden }}</option>
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
                    <option style="overflow-y: scroll;"> {{ $marca->marca }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_vitola" id="b_vitola" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todas las vitolas</option>
                    @foreach ($vitolas_p as $vitola)
                    <option style="overflow-y: scroll;"> {{ $vitola->vitola }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_nombre" id="b_nombre" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todos los nombres</option>
                    @foreach ($nombre_p as $nombre)
                    <option style="overflow-y: scroll;"> {{ $nombre->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_capa" id="b_capa" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todas las capas</option>
                    @foreach ($capas_p as $capa)
                    <option style="overflow-y: scroll;"> {{ $capa->capa }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_empaque" id="b_empaque" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todos los empaques</option>
                    @foreach ($empaques_p as $empaque)
                    <option style="overflow-y: scroll;"> {{ $empaque->empaque }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col" wire:ignore>
                <select onchange="buscar_tabla()" name="b_mes" id="b_mes" class=" mi-selector form-control"
                    style="width:100%;height:34px;" name="states[]">
                    <option value="" style="overflow-y: scroll;">Todos los meses</option>
                    @foreach ($mes_p as $mes)
                    <option style="overflow-y: scroll;"> {{ $mes->mes }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <nav>
                    <ul class="pagination justify-content-center">

                        <li class="page-item">

                            <form action="{{ route('materiales.actualizar_fichas') }}" method="POST">
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

                                <button type="submit" class="page-link" style="height: 28px">Actualizar</button>
                            </form>
                        </li>
                        @php
                        $cantida = 1;
                        @endphp
                        @for ($i = 0; $i < $tuplas_conteo; $i +=100) <li class="page-item"><a class="page-link" href="#"
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
    </div>

    @if (auth()->user()->rol == -1)
    @else
    <div wire:ignore class="modal fade" id="productos_crear" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="productos_crear" aria-hidden="true" style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-lg">
            <!-- INICIO DEL MODAL NUEVO PRODUCTO -->
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="staticBackdropLabel"><strong>Agregar producto</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </div>

                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Item</label>
                                <select name="itemn" id="itemn" style="height:30px; width: 100%;"
                                    class="form-control mi-selector200" required type="text" autocomplete="off">
                                    <option value="">Todos los items</option>
                                    @foreach ($items_p as $items)
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

                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Orden del sistema</label>
                                <input name="ordensis" id="ordensis" style="font-size:16px" class="form-control"
                                    type="text" autocomplete="off">
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Orden</label>
                                <input name="ordenn" id="ordenn" style="font-size:16px" class="form-control" required
                                    type="text" autocomplete="off">
                            </div>


                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Fecha</label>
                                <input value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" name=" fechan" id="fechan"
                                    style="font-size:12px" class="form-control" required type="date" autocomplete="off">
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Observacion</label>
                                <input name="observacionn" id="observacionn" style="font-size:16px" class="form-control"
                                    type="text" autocomplete="off">
                            </div>
                        </div>



                        <div class="row">

                            <div class="mb-3 col" hidden>
                                <div class="row">
                                    <div class="col">
                                        <input type="checkbox" name="cello" id="cello" style="font-size:20px"
                                            value="si">
                                        <label for="cello" class="form-label">Cello</label>
                                    </div>

                                    <div class="col">
                                        <input type="checkbox" name="anillo" id="anillo" style="font-size:20px"
                                            value="si">
                                        <label for="anillo" class="form-label">Anillo</label>
                                    </div>

                                    <div class="col">
                                        <input type="checkbox" name="upc" id="upc" style="font-size:20px" value="si">
                                        <label for="upc" class="form-label">UPC</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_total" class="form-label">Pendiente</label>
                                <input name="pendienten" id="pendienten" class="form-control" required type="number"
                                    autocomplete="off">
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_buenos" class="form-label">Saldo</label>
                                <input name="saldon" id="saldon" class="form-control" required type="number"
                                    autocomplete="off">
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_buenos" class="form-label">Codigo precio</label>
                                <input disabled name="c_precion" id="c_precion" class="form-control" type="text"
                                    wire:model='codigo_precio_nuevo' autocomplete="off">
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_total" class="form-label">precio</label>
                                <input disabled name="precion" id="precion" class="form-control" type="number"
                                    wire:model='precio_precio' autocomplete="off">
                            </div>

                        </div>


                        <div class="row">

                            <div class="mb-3 col" hidden>
                                <label for="txt_total" class="form-label">Paquetes</label>
                                <input name="paquetes" id="paquetes" class="form-control" required type="number"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3 col" hidden>
                                <label for="txt_total" class="form-label">Unidades</label>
                                <input name="unidades" id="unidades" class="form-control" required type="number"
                                    autocomplete="off">
                            </div>


                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class=" bmodal_no" data-dismiss="modal"><span>Cancelar</span>
                        @csrf
                    </button>
                    <button onclick="insertar_nuevo_pendiente()" class=" bmodal_yes "> <span>Guardar</span>
                    </button>
                </div>
            </div>

        </div>
        <!-- FIN DEL MODAL NUEVO PRODUCTO -->
    </div>
    @endif



    <div class="panel-body" style="padding:0px;">
        <div style="width:100%; padding-left:0px;  font-size:9px;   overflow-x: display; overflow-y: auto;
     height:75%;">
            <table class="table table-light" style="font-size:9px;" id="tabla_pendiente">
                <thead>
                    <tr>
                        <th>N#</th>
                        <th style="width:100px;">CATEGORIA</th>
                        <th>ITEM</th>
                        <th>ORDEN DEL SISTEMA</th>
                        <th>OBSERVACÓN</th>
                        <th>PRESENTACIÓN</th>
                        <th>MES</th>
                        <th style="width:100px;">ORDEN</th>
                        <th style="width:100px;">MARCA</th>
                        <th>VITOLA</th>
                        <th>NOMBRE</th>
                        <th>CAPA</th>
                        <th>TIPO DE EMPAQUE</th>
                        <th>ANILLO</th>
                        <th>CELLO</th>
                        <th>UPC</th>
                        <th>COD.PRECIO</th>
                        <th>PRECIO</th>
                        <th>PENDIENTE</th>
                        <th>SALDO</th>
                        <th>SALDO ($)</th>
                        @if (auth()->user()->rol == -1)
                        @else
                        <th></th>
                        @endif
                    </tr>
                </thead>
                <tbody name="body" id="body">
                    <?php $sumas = 0;
                    $sumap = 0;
                    $sumaprecio_dolar = 0;
                    ?>
                    @foreach ($datos_pendiente as $i => $datos)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td style="width:100px; max-width: 400px;overflow-x:auto;">{{ $datos->categoria }}</td>
                        <td>

                            @if ($datos->item == $datos->esta_pendiente)
                            <img width="24" height="24"
                                src="https://img.icons8.com/emoji/48/check-box-with-check-emoji.png"
                                alt="check-box-with-check-emoji" />
                            @else
                            <a onclick='mostra_detalles_pendiente_empaque({{ $datos->id_pendiente }})'>
                                <img width="24" height="24"
                                    src="https://img.icons8.com/emoji/48/cross-mark-button-emoji.png"
                                    alt="cross-mark-button-emoji" />
                            </a>
                            @endif
                            {{ $datos->item }}

                        </td>
                        <td>{{ $datos->orden_del_sitema }}</td>
                        <td>{{ $datos->observacion }}</td>
                        <td>{{ $datos->presentacion }}</td>
                        <td>{{ $datos->mes }}</td>
                        <td style="width:100px;font-size:8px;">{{ $datos->orden }}</td>
                        <td style="width:100px;font-size:8px;">{{ $datos->marca }}</td>
                        <td>{{ $datos->vitola }}</td>
                        <td>{{ $datos->nombre }}</td>
                        <td>{{ $datos->capa }}</td>
                        <td>{{ $datos->tipo_empaque }}</td>
                        <td>{{ $datos->anillo }}</td>
                        <td>{{ $datos->cello }}</td>
                        <td>{{ $datos->upc }}</td>
                        <td>{{ $datos->serie_precio }}</td>
                        <td style="text-align:right;">{{ $datos->precio }}</td>
                        <td>{{ $datos->pendiente }}</td>
                        <td>{{ $datos->saldo }}</td>
                        <td style="text-align:right;">{{ number_format($datos->precio_dolares, 2) }}</td>


                        @if (auth()->user()->rol == -1)
                        @else
                        <td style="width:120px;">
                            <a data-toggle="modal" data-target="#modal_eliminar_detalle"
                                onclick="datos_modal_eliminar({{ $datos->id_pendiente }})" href="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                                    class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                </svg></a>

                            <a style=" width:10px; height:10px;" data-toggle="modal" href=""
                                data-target="#modal_actualizar" type="submit"
                                onclick="datos_modal_actualizar({{ $datos->id_pendiente }})">
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

                    <?php
                        $sumas = $sumas + $datos->saldo;
                        $sumap = $sumap + $datos->pendiente;
                        $sumaprecio_dolar += $datos->precio_dolares;
                        ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="input-group" style="width:40%; position: fixed;right: 0px;bottom:0px; height:30px;">
        <span class="form-control input-group-text">Total pendiente</span>
        <input type="text" class="form-control" id="sumap" value="{{ $sumap }}">

        <span class="form-control input-group-text">Total saldo</span>
        <input type="text" class="form-control" id="sumas" value="{{ $sumas }}">

        <span class="form-control input-group-text">Total saldo ($)</span>
        <input type="text" class="form-control" id="sumaprecio" value="{{ number_format($sumaprecio_dolar, 2) }}">
    </div>

    <!-- INICIO MODAL ACTUALIZAR DATO PENDIENTE -->
    <div class="modal fade" role="dialog" id="modal_actualizar" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
        style="opacity:.9;background:#212529;width=800px;">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="opacity:.9;background:#212529;width=80%">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="staticBackdropLabel"><strong>Descripción del producto: </strong><span id="tituloupdate"
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
                            <input name="orden2" id="orden2" class="form-control" type="text" autocomplete="off">
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
                            <input name="saldo2" id="saldo2" class="form-control" type="text" autocomplete="off">
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
                    <button class="bmodal_no" data-dismiss="modal">
                        <span>Cancelar</span>
                    </button>
                    <button type="button" class="bmodal_yes" onclick="guardar_actualizacion()">
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
                    <h5 class="modal-title" id="staticBackdropLabel">Eliminar <strong><input value="" id="txt_usuarioE"
                                name="txt_usuarioE" style="border:none;"></strong> </h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input name="id_pendiente3" id="id_pendiente3" value="" hidden />

                    ¿Estás seguro que quieres eliminar este registro del pendiente?
                </div>
                <div class="modal-footer">
                    <button type="button" class="bmodal_no " data-dismiss="modal">
                        <span>Cancelar</span>
                    </button>
                    <button type="button" onclick="eliminar_pendiente()" class=" bmodal_yes ">
                        <span>Eliminar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL ELMINAR DATO PENDIENTE -->



    <!-- MODAL GENERAR REMISION DE CAJAS DE MADERA SEGUN ORDEN DEL SISTEMA -->
    <div class="modal fade" id="generarremisioncajas" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">PEDIDO CAJAS DE MADERA. <strong></strong> </h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('pendientecajapedido') }}">
                    @csrf
                    <div class="modal-body">
                        Ingrese el numero de Orden del Sistema que desea generar para su Orden de Cajas de Madera.
                        <br>
                        <br>
                        <input class="" name="orden_sistema" id="orden_sistema" value="" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="bmodal_no " data-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button type="submit" class=" bmodal_yes ">
                            <span>Generar Pedido</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @push('scripts')
    <script type="text/javascript">
        function datos_modal_eliminar(id) {
                var datastiles = @this.datos_pendiente;
                for (var i = 0; i < datastiles.length; i++) {
                    if (datastiles[i].id_pendiente === id) {
                        document.getElementById('id_pendiente3').value = datastiles[i].id_pendiente;
                    }
                }
            }



            $(document).ready(function() {
                $('.mi-selector200').select2({
                    dropdownParent: $('#productos_crear')
                });

            });

            function mostra_detalles_pendiente_empaque(id) {
                // URL de la ruta API con el ID deseado
                const apiUrl = `/api/pendiente/empaque/${id}`;

                // Realiza una solicitud GET a la ruta API
                fetch(apiUrl)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error en la solicitud.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.estatus === 200) {
                            let detalle = JSON.parse(data.data);

                            let tabla = `<table class='table'>
                            <tr>
                                <th>Item</th>
                                <th>Descripción</th>
                                <th>Mes</th>
                            </tr>`;


                            tabla = tabla + `<tr>
                                            <td>` + detalle.item + `</td>
                                            <td>` + detalle.descripcion + `</td>
                                            <td>` + detalle.mes + `</td>
                                        </tr>`;

                            tabla = tabla + `</table>`;

                            // Mostrar el alert de SweetAlert con la tabla
                            Swal.fire({
                                title: 'Pendiente Empaque',
                                icon: 'info',
                                width: 800,
                                html: tabla,
                                showCloseButton: true,
                                showCancelButton: false,
                                focusConfirm: false,
                                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Great!',
                                confirmButtonAriaLabel: 'OK!',
                                cancelButtonText: '<i class="fa fa-thumbs-down"></i>',
                                cancelButtonAriaLabel: 'Thumbs down'
                            });

                            @this.dato = 'hola';
                        } else {
                            let text = "El registro no existen en el pendiente de empaque\n¿Deseas agregarlo?";
                            if (confirm(text) == true) {
                                agregar_detalles_pendiente_empaque(id)
                            } else {

                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            function agregar_detalles_pendiente_empaque(id) {
                // URL de la ruta API con el ID deseado
                const apiUrl = `/api/pendiente/empaque/agregar/${id}`;

                // Realiza una solicitud GET a la ruta API
                fetch(apiUrl)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error en la solicitud.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.estatus === 200) {
                            let detalle = data.data;

                            // Mostrar el alert de SweetAlert con la tabla
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Se agrego con exito',
                                showConfirmButton: false,
                                timer: 1500
                            })

                            @this.dato = 'hola';
                        } else {
                            alert('No se agrego');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
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
                @this.busqueda_mes_p = $('#b_mes').val();
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
                $("#productos_crear").modal("hide");
            })

            window.addEventListener('notificacionconfirmacionUpdate', event => {
                toastr.success('Actualización realizada con exito.', 'Completado!');
                $("#modal_actualizar").removeClass("in");
                $(".modal-backdrop").remove();
                $("#modal_actualizar").hide();
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

            window.addEventListener('notificacionErrorEjecucion', event => {
                toastr.error('Excepción: \n' + event.detail.error + "            Item: " + event.detail.mensaje,
                    'Error!');
            })

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
    </script>


</div>
