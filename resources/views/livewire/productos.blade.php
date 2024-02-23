<div xmlns:wire="http://www.w3.org/1999/xhtml">
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

    <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item">
            <a class="nav-link active fs-7" style="color:#080707;"
                href="{{ route('productos') }}"><strong>Productos</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link fs-7"
                href="{{ route('datos_producto') }}"><strong>Datos Adicionales</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link fs-7"
                href="{{ route('precio.catalogo') }}"><strong>Catalogo de Precios</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link fs-7"
                href="{{ route('productos.catalogo') }}"><strong>Catalogo de Productos</strong></a>
        </li>
    </ul>
    <div class="container" style="max-width:100%;">
        <div class="card" style="padding:0px;">
            <div class="card-header">
                <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group btn-group-sm" role="group" aria-label="First group">
                        <button class="btn btn-outline-purpura" data-bs-toggle="modal" data-bs-target="#productos_crear"
                            style="height:35px;">Nuevo
                            producto
                        </button>
                        <form action="{{ Route('editarDetalles') }} " method="post">
                            @csrf
                            <button class="btn btn-outline-purpura" style="height:35px;">Editar
                                detalles
                                producto</button>
                        </form>
                    </div>
                    <div class="btn-group btn-group-sm" role="group" aria-label="First group">
                        <span class="input-group-text" id="basic-addon1" style="height:35px;">Por Pagina</span>
                        <select name="" id="" class="form-control" wire:model='por_pagina'
                            style="height:35px;">
                            <option value="50">50</option>
                            <option value="200">200</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                            <option value="{{ $total }}">Todos</option>
                        </select>
                        <button class="btn btn-success" wire:click='imprimir_reporte' style="height:35px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-file-spreadsheet" viewBox="0 0 16 16">
                                <path
                                    d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v4h10V2a1 1 0 0 0-1-1H4zm9 6h-3v2h3V7zm0 3h-3v2h3v-2zm0 3h-3v2h2a1 1 0 0 0 1-1v-1zm-4 2v-2H6v2h3zm-4 0v-2H3v1a1 1 0 0 0 1 1h1zm-2-3h2v-2H3v2zm0-3h2V7H3v2zm3-2v2h3V7H6zm3 3H6v2h3v-2z" />
                            </svg>
                        </button>
                    </div>
                </div>
                {{ $productos->links() }}
            </div>
            <div class="card-body">
                <div wire:loading.class='oscurecer_contenido'
                    style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;   height: 85vh">

                    <table class="table table-light table-hover" style="font-size:10px;">
                        <thead style=" position: static;" wire:ignore>
                            <tr style="font-size:16px; text-align:center;">
                                <th style=" text-align:center;">#</th>
                                <th style=" text-align:center;" wire:ignore>
                                    <select style="width: 150px;height:35px;" onchange="buscar_io()" name="b_items"
                                        id="b_items">
                                        <option value="">Item</option>
                                        @foreach ($items as $pr)
                                            <option value="{{ $pr }}">{{ $pr }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                @if ($ocultos)
                                    <th style=" text-align:center;">Cod. Producto</th>
                                    <th style=" text-align:center;">Cod. Caja</th>
                                @endif
                                <th style=" text-align:center;" wire:ignore>
                                    <select style="width: 150px;height:35px;" onchange="buscar_io()" name="b_marcas"
                                        id="b_marcas">
                                        <option value="">Marcas</option>
                                        @foreach ($marcas as $pr)
                                            <option value="{{ $pr }}">{{ $pr }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th style=" text-align:center;" wire:ignore>
                                    <select style="width: 150px;height:35px;" onchange="buscar_io()" name="b_nombre"
                                        id="b_nombre">
                                        <option value="">Nombre</option>
                                        @foreach ($nombres as $pr)
                                            <option value="{{ $pr }}">{{ $pr }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th style=" text-align:center;" wire:ignore>
                                    <select style="width: 150px;height:35px;" onchange="buscar_io()" name="b_vitolas"
                                        id="b_vitolas">
                                        <option value="">Vitolas</option>
                                        @foreach ($vitolas as $pr)
                                            <option value="{{ $pr }}">{{ $pr }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th style=" text-align:center;" wire:ignore>
                                    <select style="width: 150px;height:35px;" onchange="buscar_io()" name="b_capas"
                                        id="b_capas">
                                        <option value="">Capas</option>
                                        @foreach ($capas as $pr)
                                            <option value="{{ $pr }}">{{ $pr }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th style=" text-align:center;" wire:ignore>
                                    <select style="width: 150px;height:35px;" onchange="buscar_io()"
                                        name="b_empaques" id="b_empaques">
                                        <option value="">Tipo de Empaque</option>
                                        @foreach ($tipo_empaques as $pr)
                                            <option value="{{ $pr }}">{{ $pr }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                @if ($ocultos)
                                    <th style=" text-align:center;">Cod. Precio</th>
                                @endif

                                <th style=" text-align:center;">Precio</th>
                                <th style=" text-align:center;">Detalles</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td>{{ $producto->id_producto }}</td>
                                    <td>{{ $producto->item }}</td>
                                    @if ($ocultos)
                                        <td>{{ $producto->codigo_producto }}</td>
                                        <td>{{ $producto->codigo_caja }}</td>
                                    @endif
                                    @if ($producto->sampler == 'no' || is_null($producto->sampler))
                                        <td>{{ $producto->marca }}</td>
                                        <td>{{ $producto->nombre }}</td>
                                        <td>{{ $producto->vitola }}</td>
                                        <td>{{ $producto->capa }}</td>
                                    @else
                                        <td colspan="4">{{ $producto->des }}</td>
                                    @endif
                                    <td>{{ $producto->tipo_empaque }}</td>

                                    @if ($ocultos)
                                        <td>{{ $producto->codigo_precio }}</td>
                                    @endif

                                    <td>{{ $producto->precio }}</td>

                                    <td style=" text-align:center;">

                                        @if ($producto->sampler === 'si')
                                            <a style=" width:30px; height:30px;" data-bs-toggle="modal"
                                                data-bs-target="#productos_agregar_detalles" href="#"
                                                onclick="agregar_item('{{ json_encode($producto) }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="black" class="bi bi-file-earmark-plus"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z" />
                                                    <path
                                                        d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
                                                </svg>
                                            </a>

                                            <a style=" width:10px; height:10px;" data-bs-toggle="modal"
                                                href="#" data-bs-target="#modal_ver_detalle_producto"
                                                onclick="item_detalle('{{ json_encode($producto) }}')">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="black" class="bi bi-arrow-up-right-square"
                                                    viewBox="0 0 16 16"> '
                                                    <path fill-rule="evenodd"
                                                        d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.854 8.803a.5.5 0 1 1-.708-.707L9.243 6H6.475a.5.5 0 1 1 0-1h3.975a.5.5 0 0 1 .5.5v3.975a.5.5 0 1 1-1 0V6.707l-4.096 4.096z" />
                                                </svg>
                                            </a>
                                        @endif
                                        <a style=" width:10px; height:10px;"
                                            onclick="cargar_datos_editar('{{ json_encode($producto) }}')"
                                            data-bs-toggle="modal" data-bs-target="#productos_actualizar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="black" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a>
                                        @if ($producto->precio == 0)
                                            <a style=" width:10px; height:10px;"
                                                onclick="eliminar_item({{ $producto->id_producto }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                                    <path
                                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                </svg>
                                            </a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>




    <!-- INICIO DEL MODAL VER DETALLE PRODUCTO -->
    <div class="modal fade" id="modal_ver_detalle_producto" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
        style="opacity:.9;background:#212529;width=800px;">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="width:700px;">

                <div class="modal-header">
                    <h5 id="staticBackdropLabel">Detalles del producto <span style="font-size:10px;" name="clase"
                            id="clase"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <table id="detallestabla" name="detallestabla" class="table table-bordered table-striped"
                        style="font-size:10px;">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Marca</th>
                                <th>Nombre</th>
                                <th>Vitola</th>
                                <th>Capa</th>
                                <th>Tipo de empaque</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody name="body" id="body">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN DEL MODAL VER DETALLE PRODUCTO -->

    <div wire:ignore class="modal fade" id="productos_actualizar" tabindex="-1"
        aria-labelledby="productos_actualizarLabel" aria-hidden="true">
        <!-- INICIO MODAL ACTUALIZAR PRODUCTO-->
        <form action="{{ Route('actualizar_producto') }}" method="POST" name="formulario_actualizar"
            id="formulario_actualizar" style="width:100%;">
            @csrf
            <div class="modal-dialog modal-lg">
                <div>
                    <div class="modal-content" style="font-size: 0.9em">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Editar producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="marca_ac" class="form-label">Marca</label>
                                    <select class="mi-selector2" style=" height:30px; width: 100%; " name="marca_ac"
                                        id="marca_ac" placeholder="Ingresa figura y tipo" required>
                                        @foreach ($marcass as $marca)
                                            <option style="overflow-y: scroll;"> {{ $marca->marca }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="txt_figuraytipo" class="form-label">Item</label>
                                    <input name="item_ac" id="item_ac" class="form-control" required
                                        type="text" autocomplete="off">
                                </div>
                                <div class="mb-3 col">
                                    <label for="txt_figuraytipo" class="form-label">Capa</label>
                                    <select class=" mi-selector2" style=" height:30px; width: 100%; " name="capa_ac"
                                        id="capa_ac" placeholder="Ingresa figura y tipo" required>
                                        @foreach ($capass as $capa)
                                            <option style="overflow-y: scroll;"> {{ $capa->capa }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col">
                                    <label for="txt_total" class="form-label">Nombre</label>
                                    <select class=" mi-selector2" style=" height:30px; width: 100%; "
                                        name="nombre_ac" id="nombre_ac" placeholder="Ingresa figura y tipo" required>
                                        @foreach ($nombress as $nombre)
                                            <option style="overflow-y: scroll;"> {{ $nombre->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="txt_buenos" class="form-label">Vitola</label>
                                    <select class=" mi-selector2" style=" height:30px; width: 100%; "
                                        name="vitola_ac" id="vitola_ac" placeholder="Ingresa figura y tipo" required>
                                        @foreach ($vitolass as $vitola)
                                            <option style="overflow-y: scroll;"> {{ $vitola->vitola }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_malos" class="form-label">Tipo de empaque</label>
                                    <select class=" mi-selector2" style=" height:30px; width: 100%; " name="tipo_ac"
                                        id="tipo_ac" placeholder="Ingresa figura y tipo" required>
                                        @foreach ($empaquess as $tipo_empaque)
                                            <option style="overflow-y: scroll;"> {{ $tipo_empaque->tipo_empaque }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_malos" class="form-label">Presentación</label>
                                    <select class=" mi-selector2" name="presentacion_ac" id="presentacion_ac"
                                        placeholder="Ingresa figura y tipo" style=" height:30px; width: 100%; "
                                        required>
                                        <option value="Puros Tripa Larga" style="overflow-y: scroll;">Puros Tripa
                                            Larga
                                        </option>
                                        <option value="Puros Tripa Corta" style="overflow-y: scroll;">Puros Tripa
                                            Corta
                                        </option>
                                        <option value="Puros Sandwich" style="overflow-y: scroll;">Puros Sandwich
                                        </option>
                                        <option value="Puros Brocha" style="overflow-y: scroll;">Puros Brocha
                                        </option>

                                    </select>
                                </div>

                            </div>



                            <div class="row">

                                <div class="mb-3 col">
                                    <label for="txt_total" class="form-label">Código del sistema</label>
                                    <input name="cod_sistema_ac" id="cod_sistema_ac" class="form-control"
                                        type="text" autocomplete="off">
                                </div>
                                <div class="mb-3 col">
                                    <label for="txt_buenos" class="form-label">Código de precio</label>
                                    <input name="cod_precio_ac" id="cod_precio_ac" class="form-control"
                                        type="text" autocomplete="off">
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_buenos" class="form-label">Precio</label>
                                    <input name="precio" id="precio_ac" class="form-control"
                                        type="text" autocomplete="off">
                                </div>


                                <div class="mb-3 col">
                                    <label for="txt_total" class="form-label">Código de la cajita</label>
                                    <input name="cod_caja_ac" id="cod_caja_ac" class="form-control" type="text"
                                        autocomplete="off">
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_total" class="form-label">Cantidad x Bulto</label>
                                    <input name="cantxbult" id="cantxbult" class="form-control" type="text"
                                        autocomplete="off">
                                </div>

                            </div>


                            <div class="row">

                                <div class="mb-3 col">
                                    <input type="checkbox" name="cello_ac" id="cello_ac" value="si">
                                    <label for="cello" class="form-label">Sello</label>
                                </div>

                                <div class="mb-3 col">
                                    <input type="checkbox" name="anillo_ac" id="anillo_ac" style="font-size:20px"
                                        value="si">
                                    <label for="anillo" class="form-label">Anillo</label>
                                </div>
                                <div class="mb-3 col">
                                    <input type="checkbox" name="upc_ac" id="upc_ac" value="si">
                                    <label for="upc" class="form-label">UPC</label>
                                </div>
                                <input name="id_producto" id="id_producto" value="" hidden>
                            </div>


                            <div class="row">

                                <div>
                                    <input type="checkbox" name="sampler" id="sampler" value="si"
                                        onclick="ocultar()">
                                    <label for="upc" class="form-label">SAMPLER</label>

                                    <input type="text" name="des" id="des" value=""
                                        style="display:none; width:60%;">
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                <span>Cancelar</span>
                            </button>
                            <button type="submit" class="btn btn-success">
                                <span>Guardar</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
        <!-- FIN  MODAL ACTUALIZAR PRODUCTO -->
    </div>

    <div wire:ignore class="modal fade" id="productos_agregar_detalles" tabindex="-1"
        aria-labelledby="productos_agregar_detallesLabel" aria-hidden="true">
        <!-- INICIO DEL MODAL AGREGAR DETALLE PRODUCTO -->
        <form action="{{ Route('detalle') }}" method="POST" id="form_detalle" name="form_detalle"
            style="width:100%;">
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><strong>Agregar detalle del producto</strong>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="mb-3 col">
                                <label for="item_de" class="form-label" style="width:100%;">Item</label>
                                <input name="item_de" id="item_de" class="form-control" required type="text"
                                    autocomplete="off" readonly>
                            </div>


                            <div class="mb-3 col">
                                <label for="capa_de" class="form-label" style="width:100%;">Capa</label>
                                <select name="capa_de" id="capa_de" class="mi-selector4 form-control "
                                    style="width:100%;" required>
                                    <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach ($capas as $capa)
                                        <option style="overflow-y: scroll;"> {{ $capa }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col">
                                <label for="marca_de" class="form-label" style="width:100%;">Marca</label>
                                <select name="marca_de" id="marca_de" class="mi-selector4 form-control"
                                    style="width:100%;" required>
                                    <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach ($marcass as $marca)
                                        <option style="overflow-y: scroll;"> {{ $marca->marca }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="row">
                            <div class="mb-3 col">
                                <label for="nombre_de" class="form-label" style="width:100%;">Nombre</label>

                                <select name="nombre_de" id="nombre_de" class="mi-selector4 form-control"
                                    style="width:100%;" required>
                                    <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach ($nombres as $nombre)
                                        <option style="overflow-y: scroll;"> {{ $nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col">
                                <label for="vitola_de" class="form-label" style="width:100%;">Vitola</label>

                                <select name="vitola_de" id="vitola_de" class=" mi-selector4 form-control"
                                    style="width:100%;" required>
                                    <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach ($vitolas as $vitola)
                                        <option style="overflow-y: scroll;"> {{ $vitola }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col">
                                <label for="tipo_de" class="form-label" style="width:100%;">Tipo de
                                    empaque</label>
                                <select name="tipo_de" id="tipo_de" class=" mi-selector4 form-control"
                                    style="width:100%;" required>
                                    <option value="N/D" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach ($tipo_empaques as $tipo_empaque)
                                        <option style="overflow-y: scroll;"> {{ $tipo_empaque }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="row">
                            <div class="mb-3 col">
                                <input type="checkbox" name="cello_de" id="cello_de" value="si">
                                <label for="cello" class="form-label">Sello</label>
                            </div>
                            <div class="mb-3 col">

                                <input type="checkbox" name="anillo_de" id="anillo_de" value="si">
                                <label for="anillo" class="form-label">Anillo</label>
                            </div>
                            <div class="mb-3 col">

                                <input type="checkbox" name="upc_de" id="upc_de" value="si">
                                <label for="upc" class="form-label">UPC</label>
                            </div>
                        </div>

                        <div class="row">

                            <div class="mb-3 col">

                                <label for="txt_malos" class="form-label">Código de
                                    precio</label>
                                <input name="precio_de" id="precio_de" style="font-size:16px" class="form-control"
                                     type="text" autocomplete="off">
                            </div>
                            <div class="mb-3 col">

                                <label for="txt_buenos" class="form-label">Precio</label>
                                <input name="precio" id="precio" class="form-control"  type="text"
                                    autocomplete="off">

                            </div>
                            <div class="mb-3 col">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button type="submit" class="btn btn-success">
                            <span>Guardar</span>
                        </button>
                    </div>
                </div>

            </div>
        </form>
        <!-- FIN DEL MODAL AGREGAR DETALLE PRODUCTO -->
    </div>

    <div wire:ignore class="modal fade" id="productos_crear" tabindex="-1" aria-labelledby="productos_crearLabel"
        aria-hidden="true">
        <!-- INICIO DEL MODAL NUEVO PRODUCTO -->

        <form action="{{ Route('nuevo_producto') }} " method="POST" name="theForm" id="theForm"
            style="width:100%;">
            @csrf
            <div class="modal-dialog modal-lg">
                <div>
                    <div class="modal-content" style="font-size: 0.9em">

                        <div class="modal-header">

                            <h5 class="modal-title" id="exampleModalToggleLabel">Editar producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>

                        </div>

                        <div class="modal-body">

                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col">
                                        <label for="txt_vitola" class="form-label" style="width:100%;">Marca</label>
                                        <select class=" mi-selector" name="marca" id="marca"
                                            placeholder="Ingresa figura y tipo" style=" height:30px; width: 100%; "
                                            name="states[]" required>
                                            @foreach ($marcass as $marca)
                                                <option> {{ $marca->marca }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col">
                                        <label for="txt_figuraytipo" class="form-label">Item</label>
                                        <input name="item" id="item" style="font-size:16px"
                                            class="form-control" required type="text" autocomplete="off">
                                    </div>

                                    <div class="mb-3 col">
                                        <label for="txt_figuraytipo" class="form-label"
                                            style="width:100%;">Capa</label>
                                        <select class="form-control mi-selector" name="capa" id="capa"
                                            placeholder="Ingresa figura y tipo"
                                            style="overflow-y: scroll; width:100%;" required>
                                            @foreach ($capass as $capa)
                                                <option style="overflow-y: scroll;"> {{ $capa->capa }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 col">
                                        <label for="txt_total" class="form-label" style="width:100%;">Nombre</label>

                                        <select class="form-control mi-selector" name="nombre" id="nombre"
                                            placeholder="Ingresa figura y tipo"
                                            style="overflow-y: scroll; width:100%;" required>
                                            @foreach ($nombress as $nombre)
                                                <option style="overflow-y: scroll;"> {{ $nombre->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="mb-3 col">
                                        <label for="txt_buenos" class="form-label" style="width:100%;">Vitola</label>

                                        <select class="form-control mi-selector" name="vitola" id="vitola"
                                            placeholder="Ingresa figura y tipo"
                                            style="overflow-y: scroll; width:100%;" required>
                                            @foreach ($vitolass as $vitola)
                                                <option style="overflow-y: scroll;"> {{ $vitola->vitola }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="mb-3 col">
                                        <label for="txt_malos" class="form-label" style="width:100%;">Tipo de
                                            empaque</label>
                                        <select class="form-control mi-selector" name="tipo" id="tipo"
                                            placeholder="Ingresa figura y tipo" style="overflow-y: scroll;width:100%;"
                                            required>
                                            @foreach ($empaquess as $tipo_empaque)
                                                <option style="overflow-y: scroll;"> {{ $tipo_empaque->tipo_empaque }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 col">
                                        <label for="txt_malos" class="form-label"
                                            style="width:100%;">Presentación</label>

                                        <select class="form-control" name="presentacion" id="presentacion"
                                            placeholder="Ingresa figura y tipo"
                                            style="overflow-y: scroll;  width:100%;" required>

                                            <option value="Puros Tripa Larga" style="overflow-y: scroll;">Puros Tripa
                                                Larga
                                            </option>
                                            <option value="Puros Tripa Corta" style="overflow-y: scroll;">Puros Tripa
                                                Corta
                                            </option>
                                            <option value="Puros Sandwich" style="overflow-y: scroll;">Puros Sandwich
                                            </option>
                                            <option value="Puros Brocha" style="overflow-y: scroll;">Puros Brocha
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col">
                                        <label for="txt_total" class="form-label">Código del
                                            sistema</label>
                                        <input name="cod_sistema" id="cod_sistema" class="form-control"
                                            type="text" autocomplete="off">
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="txt_buenos" class="form-label">Código de
                                            precio</label>
                                        <input name="cod_precio" id="cod_precio" class="form-control"
                                            type="text" autocomplete="off">
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="txt_buenos" class="form-label">Precio</label>
                                        <input name="precio" id="precio" class="form-control"
                                            type="text" autocomplete="off">
                                    </div>

                                    <div class="mb-3 col">
                                        <label for="txt_total" class="form-label">Código de la cajita</label>
                                        <input name="cod_caja" id="cod_caja" class="form-control"
                                            type="text" autocomplete="off">
                                    </div>

                                    <div class="mb-3 col">
                                        <label for="txt_total" class="form-label">Cantidad x Bulto</label>
                                        <input name="cantxbult" id="cantxbult" class="form-control" type="text"
                                            autocomplete="off">
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="mb-3 col">
                                        <input type="checkbox" name="cello" id="cello" style="font-size:20px"
                                            value="si">
                                        <label for="cello" class="form-label">Cello</label>
                                    </div>
                                    <div class="mb-3 col">

                                        <input type="checkbox" name="anillo" id="anillo" style="font-size:20px"
                                            value="si">
                                        <label for="anillo" class="form-label">Anillo</label>
                                    </div>
                                    <div class="mb-3 col">
                                        <input type="checkbox" name="upc" id="upc" style="font-size:20px"
                                            value="si">
                                        <label for="upc" class="form-label">UPC</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                <span>Cancelar</span>
                            </button>
                            <button onclick="agregarproducto()" class="btn btn-success" type="submit">
                                <span>Guardar</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- FIN DEL MODAL NUEVO PRODUCTO -->
    </div>


    <!-- SCRIPT MODAL EDITAR MOLDE -->

    <script type="text/javascript">
        function cargar_datos_editar(id) {

            var producto = JSON.parse(id);


            if (document.formulario_actualizar.cello_ac.checked) {

                document.formulario_actualizar.cello_ac.click();

            } else {

            }
            if (document.formulario_actualizar.anillo_ac.checked) {

                document.formulario_actualizar.anillo_ac.click();

            } else {

            }
            if (document.formulario_actualizar.upc_ac.checked) {

                document.formulario_actualizar.upc_ac.click();

            } else {

            }

            if (document.formulario_actualizar.sampler.checked) {

                document.formulario_actualizar.sampler.click();

            } else {

            }

            $('#marca_ac').val(producto.marca).trigger('change.select2');
            $('#capa_ac').val(producto.capa).trigger('change.select2');
            $('#nombre_ac').val(producto.nombre).trigger('change.select2');
            $('#vitola_ac').val(producto.vitola).trigger('change.select2');
            $('#tipo_ac').val(producto.tipo_empaque).trigger('change.select2');

            document.formulario_actualizar.item_ac.value = producto.item;
            document.formulario_actualizar.presentacion_ac.value = producto.presentacion;
            document.formulario_actualizar.cod_sistema_ac.value = producto.codigo_producto;
            document.formulario_actualizar.cod_precio_ac.value = producto.codigo_precio;
            document.formulario_actualizar.precio_ac.value = producto.precio;
            document.formulario_actualizar.cod_caja_ac.value = producto.codigo_caja;
            document.formulario_actualizar.id_producto.value = producto.id_producto;
            document.formulario_actualizar.cantxbult.value = producto.cantidad_bulto;
            document.formulario_actualizar.des.value = producto.des;

            if (producto.cello === "SI") {

                document.formulario_actualizar.cello_ac.click();

            } else {


            }

            if (producto.anillo === "SI") {
                document.formulario_actualizar.anillo_ac.click();
            } else {

            }

            if (producto.upc === "SI") {

                document.formulario_actualizar.upc_ac.click();
            } else {}

            if (producto.sampler === "si") {

                document.formulario_actualizar.sampler.click();
            } else {}

        }
    </script>

    <!-- FIN SCRIPT MODAL EDITAR MOLDE -->


    <script type="text/javascript">
        function item_detalle(item, tamano) {

            var producto = JSON.parse(item);

            var table = document.getElementById("detallestabla");
            var rowCount = table.rows.length;
            var tableRows = table.getElementsByTagName('tr');
            //console.log(rowCount)

            if (rowCount <= 1) {} else {

                for (var x = rowCount - 1; x > 0; x--) {

                    document.getElementById("body").innerHTML = "";
                    document.getElementById("clase").innerHTML = "";

                }

            }


            var h3 = `<h3>
                        <strong>
                            ` + producto.item + `
                            ` + producto.tipo_empaque + `
                            ` + producto.vitola + `
                            ` + producto.marca + `
                            ` + producto.nombre + `
                        </strong>
                    </h3>`;
            if(producto.marca == 'NINGUNA'){
                var h3 = `<h3>
                        <strong>
                            ` + producto.item + `
                            ` + producto.tipo_empaque + ` -
                            ` + producto.des + `
                        </strong>
                    </h3>`;
            }


            document.getElementById("clase").innerHTML += h3.toString();

            tabla_nueva = "";

            var detalle = @json($detalle_productos);

            for (var i = 0; i < detalle.length; i++) {

                if (detalle[i].item === producto.item) {
                    var tabla_nueva = `
                        <tr>
                            <td>` + detalle[i].item + `</td>
                            <td>` + detalle[i].marca + `</td>
                            <td>` + detalle[i].nombre + `</td>
                            <td>` + detalle[i].vitola + `</td>
                            <td>` + detalle[i].capa + `</td>
                            <td>` + detalle[i].tipo_empaque + `</td>
                            <td>

                                <form action="/eliminar_detalles_productos" method="post">
                                    <div>
                                        @csrf
                                        <input name="id" id="id"  type="text" style="display:none" value="` + detalle[
                            i]
                        .id_producto + `">
                                        <input type="submit" value="Eliminar">
                                    </div>
                                </form>
                            </td>
                        </tr>

                        `;
                    document.getElementById("body").innerHTML += tabla_nueva.toString();
                }

            }
        }
    </script>

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

            var seletscc = ["#b_items", "#b_marcas", "#b_nombre", "#b_vitolas", "#b_capas", "#b_empaques"];

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

            function buscar_io() {
                @this.item = $(seletscc[0]).val();
                @this.marca = $(seletscc[1]).val();
                @this.nombre = $(seletscc[2]).val();
                @this.vitola = $(seletscc[3]).val();
                @this.capa = $(seletscc[4]).val();
                @this.tipo_empaque = $(seletscc[5]).val();
                //@this.page = 1;
            }

            $(document).ready(function() {
                $('.mi-selector').select2({
                    dropdownParent: $('#productos_crear')
                });
            });

            $(document).ready(function() {
                $('.mi-selector2').select2({
                    dropdownParent: $('#productos_actualizar')
                });
            });

            $(document).ready(function() {
                $('.mi-selector4').select2({
                    dropdownParent: $('#productos_agregar_detalles')
                });
            });

            function ocultar() {
                if (document.formulario_actualizar.sampler.checked) {
                    document.getElementById('des').style.display = "block";
                } else {
                    document.getElementById('des').style.display = "none";
                }
            }

            function agregar_item(id) {
                var producto = JSON.parse(id);

                document.form_detalle.item_de.value = producto.item;
            }


            function eliminar_item(id) {

                Swal.fire({
                    title: 'Esta seguro?',
                    text: "La eliminacion del item no podra revertise!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.eliminar_item(id);
                    } else {

                    }

                })
            }

            window.addEventListener('item_eliminar', event => {
                Swal.fire(
                    'Borrado!', 'El item ha sido eliminado.', 'success'
                );
            })


            function agregarproducto() {
                var v_item = document.getElementById('item').value;
                var unico_item = 0;

                var data = @json($items);

                var filteredItems = data.filter(function(item) {
                    return item.toLowerCase() === v_item.toLowerCase();
                });

                var unico_item = filteredItems.length;

                if (unico_item > 0) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Este item ya existe'
                    });
                    event.preventDefault();
                } else {
                    theForm.addEventListener('submit', function(event) {});

                }
            }
        </script>
    @endpush


</div>
