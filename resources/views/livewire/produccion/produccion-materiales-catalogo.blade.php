<div>
    <div class="container" style="max-width:100%;">
        <div class="card" style="height: 90vh;">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-2" wire:ignore>
                        <div class="btn-group" style="height: 35px;" role="group"
                            aria-label="Basic mixed styles example">
                            @if (auth()->user()->rol == -1)
                            @else
                                <button class="btn btn-outline-dark" >
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
                            <button id="btn_guardar" class="btn btn-outline-purpura" disabled wire:loading>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4" wire:ignore>
                        <div class="input-group mb-3" style="height: 30px">
                            <input type="file" name="select_file" id="select_file"
                                style="height: 30px;font-size: 0.7em" wire:model="select_file"
                                class="form-control" />
                            <input type="submit" wire:click="import" name="upload" class="btn btn-primary"
                            style="height: 30px;font-size: 0.7em" value="Produccion Diaria">
                        </div>
                    </div>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-1" wire:ignore style="height: 30px"></div>
                    <div class="col-md-2">
                        <div class="input-group mb-3" style="height: 30px">
                            <span class="input-group-text" id="basic-addon1" style="height: 30px;font-size: 0.7em">Por
                                Pagina</span>
                            <select name="" id="" class="form-control" wire:model='por_pagina'
                                style="height: 30px;font-size: 0.7em">
                                <option value="50">50</option>
                                <option value="200">200</option>
                                <option value="500">500</option>
                                <option value="1000">1000</option>
                                <option value="{{ $total }}">Todo</option>
                            </select>
                            <button class="btn btn-success" wire:click='imprimir_reporte' style="height: 30px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-file-spreadsheet" viewBox="0 0 16 16">
                                    <path
                                        d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v4h10V2a1 1 0 0 0-1-1H4zm9 6h-3v2h3V7zm0 3h-3v2h3v-2zm0 3h-3v2h2a1 1 0 0 0 1-1v-1zm-4 2v-2H6v2h3zm-4 0v-2H3v1a1 1 0 0 0 1 1h1zm-2-3h2v-2H3v2zm0-3h2V7H3v2zm3-2v2h3V7H6zm3 3H6v2h3v-2z" />
                                </svg>
                            </button>

                            @if ($this->activoss != 'A')
                                <button class="btn btn-warning" wire:click="activos('A')" style="height: 30px">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-lightbulb-off" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M2.23 4.35A6.004 6.004 0 0 0 2 6c0 1.691.7 3.22 1.826 4.31.203.196.359.4.453.619l.762 1.769A.5.5 0 0 0 5.5 13a.5.5 0 0 0 0 1 .5.5 0 0 0 0 1l.224.447a1 1 0 0 0 .894.553h2.764a1 1 0 0 0 .894-.553L10.5 15a.5.5 0 0 0 0-1 .5.5 0 0 0 0-1 .5.5 0 0 0 .288-.091L9.878 12H5.83l-.632-1.467a2.954 2.954 0 0 0-.676-.941 4.984 4.984 0 0 1-1.455-4.405l-.837-.836zm1.588-2.653.708.707a5 5 0 0 1 7.07 7.07l.707.707a6 6 0 0 0-8.484-8.484zm-2.172-.051a.5.5 0 0 1 .708 0l12 12a.5.5 0 0 1-.708.708l-12-12a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </button>
                            @else
                                <button class="btn btn-warning" wire:click="activos('I')" style="height: 30px">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-lightbulb-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13h-5a.5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm3 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                </button>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive" style="height: 74vh;">
                    <table class="table table-light" style="font-size:10px;">
                        <thead>
                            <tr>
                                <th>N#</th>
                                <th wire:ignore style="width:100px;" class="text-center">
                                    <select name="b_codigo" id="b_codigo" onchange="buscar_io()">
                                        <option value="">CODIGO PRODUCTO</option>
                                        @foreach ($codigos as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th wire:ignore style="width:100px;">
                                    <select name="b_presentacion" id="b_presentacion" onchange="buscar_io()">
                                        <option value="">Presentacion</option>
                                        @foreach ($presentacion as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </th>

                                <th wire:ignore>
                                    <select name="b_marca" id="b_marca" onchange="buscar_io()">
                                        <option value="">MARCA</option>
                                        @foreach ($marcas as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th wire:ignore>
                                    <select name="b_nombre" id="b_nombre" onchange="buscar_io()">
                                        <option value="">NOMBRE</option>
                                        @foreach ($nombres as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th wire:ignore>
                                    <select name="b_vitola" id="b_vitola" onchange="buscar_io()">
                                        <option value="">VITOLA</option>
                                        @foreach ($vitolas as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th wire:ignore>
                                    <select name="b_capa" id="b_capa" onchange="buscar_io()">
                                        <option value="">CAPA</option>
                                        @foreach ($capas as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th wire:ignore>
                                    <select name="b_material" id="b_material" onchange="buscar_io()">
                                        <option value="">Material</option>
                                        @foreach ($nombres_materials as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th>Onza</th>
                                <th>Base</th>
                                <th class="text-center">A/I</th>
                                <th class="text-center">OPERACION</th>
                            </tr>
                        </thead>
                        <tbody name="body" id="body">
                            @foreach ($productos as $id => $producto)
                                <tr>
                                    <td>{{ ++$id }}</td>
                                    <td style="text-align: center">
                                        @if (is_null($producto->codigo))
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#productos_crear" onclick="asignar_id_material({{ $producto->id_material }},'{{ $producto->marca.' '.$producto->nombre.' '.$producto->vitola.' '.$producto->capa }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    fill="green" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path
                                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                </svg>
                                            </a>
                                        @else
                                            {{ $producto->codigo }}
                                        @endif
                                    </td>
                                    <td>{{ $producto->presentacion }}</td>
                                    <td>{{ $producto->marca }}</td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>{{ $producto->vitola }}</td>
                                    <td>{{ $producto->capa }}</td>
                                    <td>{{ $producto->nombre_material }}</td>
                                    <td>
                                        <input value="{{ $producto->onza }}" type="text"
                                        id="tearea{{ $producto->id_material }}"
                                        onchange="modificar_onzas({{ $producto->id_material }},'#tearea{{ $producto->id_material }}')"
                                        class="form-control form-control-sm form-control-color fs-7"
                                        style="width: 80px">
                                    </td>
                                    <td>{{ $producto->base }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input"
                                                onchange="activar_desactivar({{ $producto->id_material }},'{{ $producto->activo == 'A' ? 'I' : 'A' }}')"
                                                type="checkbox" @if ($producto->activo == 'A') checked @endif
                                                role="switch" id="flexSwitchCheckDisabled">
                                            <label class="form-check-label" for="flexSwitchCheckDisabled">
                                                @if ($producto->activo == 'A')
                                                    Desactivar
                                                @else
                                                    Activar
                                                @endif
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        {{-- <a style="text-decoration: none" href="#" data-bs-toggle="modal" data-bs-target="#productos_editar"
                                        onclick="cargar_modal({{ $producto->id_marca }},{{ $producto->id_nombre }},{{ $producto->id_vitola }},{{ $producto->id_capa }},'{{ $producto->color }}',{{ $producto->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ $productos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <div wire:ignore class="modal fade" id="productos_crear" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="productos_crear" aria-hidden="true" style="opacity:.9;background:#212529;">
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
                                <label for="txt_figuraytipo" class="form-label">Codigo</label>
                                <input class="form-control fs-7" name="codigo_n" id="codigo_n"
                                wire:model.defer='produc.codigo' placeholder="Ingresa figura y tipo"
                                    style="overflow-y: scroll; height:30px;" >
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_malos" class="form-label">Presentación</label>
                                <select class="form-control fs-7" name="presentacion_ac" id="presentacion_ac" wire:model.defer="produc.presentacion"
                                    placeholder="Ingresa figura y tipo" style="height:30px; width: 100%;" required>
                                    <option value="Puros Tripa Larga" style="overflow-y: scroll;">Puros Tripa Larga</option>
                                    <option value="Puros Tripa Corta" style="overflow-y: scroll;">Puros Tripa Corta</option>
                                    <option value="Puros Sandwich" style="overflow-y: scroll;">Puros Sandwich</option>
                                    <option value="Puros Brocha" style="overflow-y: scroll;">Puros Brocha</option>
                                </select>
                            </div>

                            <div class="mb-6 col" wire:ignore>
                                <label for="txt_vitola" class="form-label">Marca</label>
                                <select wire:model.defer='produc.id_marca' name="marca_n" id="marca_n">
                                    <option value="0">Seleccione</option>
                                    @foreach ($marcas_select as $marcas)
                                        <option value="{{ $marcas->id_marca }}">{{ $marcas->marca }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="row">
                            <div class="mb-4 col">
                                <label for="txt_figuraytipo" class="form-label">Capa</label>
                                <select wire:model.defer='produc.id_capa' name="capa_n" id="capa_n">
                                    <option value="0">Seleccione</option>
                                    @foreach ($capas_select as $capas)
                                        <option value="{{ $capas->id_capa }}">{{ $capas->capa }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4 col">
                                <label for="vitola" class="form-label">Vitola</label>
                                <select wire:model.defer='produc.id_vitola' name="vitola_n" id="vitola_n">
                                    <option value="0">Seleccione</option>
                                    @foreach ($vitolas_select as $vitolas)
                                        <option value="{{ $vitolas->id_vitola }}">{{ $vitolas->vitola }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4 col">
                                <label for="txt_total" class="form-label">Nombre</label>
                                <select wire:model.defer='produc.id_nombre' name="nombre_n" id="nombre_n">
                                    <option value="0">Seleccione</option>
                                    @foreach ($nombres_select as $nombres)
                                        <option value="{{ $nombres->id_nombre }}">{{ $nombres->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Precio Rolero</label>
                                <input style="font-size:16px" class="form-control fs-7"
                                    type="text" autocomplete="off" wire:model.defer='produc.precio_rolero'>
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Precio Bonchero</label>
                                <input  style="font-size:12px"
                                    class="form-control fs-7" required type="text" autocomplete="off"
                                    wire:model.defer='produc.precio_bonchero'>
                            </div>

                            <div class="mb-6 col">
                                <label for="txt_figuraytipo" class="form-label">Color</label>
                                <input style="font-size:16px"
                                    class="form-control fs-7" type="text" autocomplete="off"
                                    wire:model.defer='color_n'>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span>Cancelar</span>
                        @csrf
                    </button>
                    <button wire:click="registra_producto()" class="btn btn-success" data-bs-dismiss="modal"> <span>Guardar</span>
                    </button>
                </div>
            </div>

        </div>
        <!-- FIN DEL MODAL NUEVO PRODUCTO -->
    </div>

    <div wire:ignore class="modal fade" id="productos_editar" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="productos_crear" aria-hidden="true" style="opacity:.9;background:#212529;">
    <div class="modal-dialog modal-lg">
        <!-- INICIO DEL MODAL NUEVO PRODUCTO -->
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="staticBackdropLabel"><strong>Editar producto</strong></h5>
                <button type="button" id="cerrar_modal_productos_crear" class="btn btn-close"
                    data-bs-dismiss="modal" aria-label="Close">
            </div>

            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Codigo</label>
                            <input class="form-control fs-7" name="codigo_e" id="codigo_e"
                            wire:model.defer='produc.codigo' placeholder="Ingresa figura y tipo"
                                style="overflow-y: scroll; height:30px;" >
                        </div>

                        <div class="mb-3 col">
                            <label for="txt_malos" class="form-label">Presentación</label>
                            <select class="form-control fs-7" name="presentacion_e" id="presentacion_e" wire:model.defer="produc.presentacion"
                                placeholder="Ingresa figura y tipo" style="height:30px; width: 100%;" required>
                                <option value="Puros Tripa Larga" style="overflow-y: scroll;">Puros Tripa Larga</option>
                                <option value="Puros Tripa Corta" style="overflow-y: scroll;">Puros Tripa Corta</option>
                                <option value="Puros Sandwich" style="overflow-y: scroll;">Puros Sandwich</option>
                                <option value="Puros Brocha" style="overflow-y: scroll;">Puros Brocha</option>
                            </select>
                        </div>

                        <div class="mb-6 col" wire:ignore>
                            <label for="txt_vitola" class="form-label">Marca</label>
                            <select wire:model.defer='produc.id_marca' name="marca_e" id="marca_e">
                                <option value="0">Seleccione</option>
                                @foreach ($marcas_select as $marcas)
                                    <option value="{{ $marcas->id_marca }}">{{ $marcas->marca }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="mb-4 col">
                            <label for="txt_figuraytipo" class="form-label">Capa</label>
                            <select wire:model.defer='produc.id_capa' name="capa_e" id="capa_e">
                                <option value="0">Seleccione</option>
                                @foreach ($capas_select as $capas)
                                    <option value="{{ $capas->id_capa }}">{{ $capas->capa }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4 col">
                            <label for="vitola" class="form-label">Vitola</label>
                            <select wire:model.defer='produc.id_vitola' name="vitola_e" id="vitola_e">
                                <option value="0">Seleccione</option>
                                @foreach ($vitolas_select as $vitolas)
                                    <option value="{{ $vitolas->id_vitola }}">{{ $vitolas->vitola }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4 col">
                            <label for="txt_total" class="form-label">Nombre</label>
                            <select wire:model.defer='produc.id_nombre' name="nombre_e" id="nombre_e">
                                <option value="0">Seleccione</option>
                                @foreach ($nombres_select as $nombres)
                                    <option value="{{ $nombres->id_nombre }}">{{ $nombres->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Precio Rolero</label>
                            <input style="font-size:16px" class="form-control fs-7"
                                type="text" autocomplete="off" wire:model.defer='produc.precio_rolero'>
                        </div>

                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Precio Bonchero</label>
                            <input value="" name="fechan" id="fechan" style="font-size:12px"
                                class="form-control fs-7" required type="text" autocomplete="off"
                                wire:model.defer='produc.precio_bonchero'>
                        </div>

                        <div class="mb-6 col">
                            <label for="txt_figuraytipo" class="form-label">Color</label>
                            <input style="font-size:16px"
                                class="form-control fs-7" type="text" autocomplete="off"
                                wire:model.defer='color_n'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Cliente</label>
                            <input style="font-size:16px" class="form-control fs-7"
                                type="text" autocomplete="off" wire:model.defer='cliente'>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span>Cancelar</span>
                    @csrf
                </button>
                <button wire:click="registra_producto()" class="btn btn-success" data-bs-dismiss="modal"> <span>Guardar</span>
                </button>
            </div>
        </div>

    </div>
    <!-- FIN DEL MODAL NUEVO PRODUCTO -->
</div> --}}

    <div wire:ignore class="modal fade" id="productos_crear" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="productos_crear" aria-hidden="true" style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="titulo_modal"></h5>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <input type="text"  id="idMaterial" style="display: none">
                        <div class="row">
                            <div class="mb-12 col">
                                <label for="txt_figuraytipo" class="form-label">Item</label>
                                <select name="codigon" id="codigon" style="height:30px; width: 100%;"
                                    class="fs-7" required type="text" autocomplete="off">
                                    <option value="">Todos los Codigos</option>
                                    @foreach ($datos_codigo as $codiog)
                                        <option value="{{ $codiog->id }}">{{ $codiog->codigo.'-'.$codiog->marca.' '.$codiog->nombre.' '.$codiog->vitola.' '.$codiog->capa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span>Cancelar</span></button>
                    <button onclick="asignar_codigo()" data-bs-dismiss="modal" class="btn btn-success"><span>Guardar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            var control_producto;
            var control_nombre;
            var control_vitola;
            var control_capa;
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

            var seletscc = ["#b_presentacion", "#b_codigo", "#b_marca", "#b_nombre", "#b_vitola", "#b_capa",
                "#b_material"
            ];
            const inputField = document.querySelector("#example");

            $(document).ready(function() {
                seletscc.forEach(element => {
                    selects(element);
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

                control_producto = new TomSelect('#codigon', {
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
                // control_marca = new TomSelect('#marca_e', {
                //     sortField: {
                //         field: "text",
                //         direction: "asc"
                //     }
                // });
                // control_nombre = new TomSelect('#nombre_e', {
                //     sortField: {
                //         field: "text",
                //         direction: "asc"
                //     }
                // });
                // control_vitola = new TomSelect('#vitola_e', {
                //     sortField: {
                //         field: "text",
                //         direction: "asc"
                //     }
                // });


            });

            function buscar_io() {
                @this.b_presentacion = $(seletscc[0]).val();
                @this.b_codigo = $(seletscc[1]).val();
                @this.b_marca = $(seletscc[2]).val();
                @this.b_nombre = $(seletscc[3]).val();
                @this.b_vitola = $(seletscc[4]).val();
                @this.b_capa = $(seletscc[5]).val();
                @this.b_nombre_material = $(seletscc[6]).val();
                @this.page = 1;
            }

            function activar_desactivar(id, valor) {
                @this.activar_desactivar(id, valor);
            }

            function asignar_id_material(id,textp) {
                $('#idMaterial').val(id);
                $('#titulo_modal').html(textp);
            }

            function asignar_codigo() {
                @this.asignar_codigo_producto($('#codigon').val(),$('#idMaterial').val());
            }

            function modificar_onzas(id, num) {
                @this.modificar_onzas($(num).val(),id);
            }



            // function cargar_modal(marca,nombre,vitola,capa,color,id){
            //     control_marca.setValue(marca);
            //     control_nombre.setValue(nombre);
            //     control_vitola.setValue(vitola);
            //     control_capa.setValue(capa);
            //     @this.color_n =color;
            //     @this.editar_producto(id);
            // }

            // function eliminar_item(id) {
            //     Swal.fire({
            //         title: 'Esta seguro?',
            //         text: "Eliminar el producto, no podra revertise!",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'Si, eliminar!'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             @this.eliminar_salida(id);
            //         } else {

            //         }
            //     })
            // }

            window.addEventListener('salida_eliminada', event => {
                Toast.fire({
                    icon: 'success',
                    title: 'Salida eliminada con exito.'
                });
            })

            window.addEventListener('nuevo_codigo', event => {
                Toast.fire({
                    icon: 'success',
                    title: 'Producto creado con exito.'
                });
            })
        </script>
    @endpush
</div>
