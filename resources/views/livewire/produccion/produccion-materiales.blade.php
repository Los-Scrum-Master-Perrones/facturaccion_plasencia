<div>
    <div class="container" style="max-width:100%;">
        <div class="card" style="height: 90vh;">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-2" wire:ignore>
                        <div class="btn-group" style="height: 35px;" role="group"
                            aria-label="Basic mixed styles example">
                            <button id="btn_guardar" class="btn btn-outline-purpura" disabled wire:loading>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4" wire:ignore>
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
                                <option value="{{ $total }}">Todo</option>
                            </select>
                            <button class="btn btn-success" wire:click='imprimir_reporte' style="height: 30px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-file-spreadsheet" viewBox="0 0 16 16">
                                    <path
                                        d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v4h10V2a1 1 0 0 0-1-1H4zm9 6h-3v2h3V7zm0 3h-3v2h3v-2zm0 3h-3v2h2a1 1 0 0 0 1-1v-1zm-4 2v-2H6v2h3zm-4 0v-2H3v1a1 1 0 0 0 1 1h1zm-2-3h2v-2H3v2zm0-3h2V7H3v2zm3-2v2h3V7H6zm3 3H6v2h3v-2z" />
                                </svg>
                            </button>
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
                                <th wire:ignore class="text-center">
                                    <select name="b_codigo" id="b_codigo" onchange="buscar_io()">
                                        <option value="">Codigos</option>
                                        @foreach ($codigos as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th wire:ignore class="text-center">
                                    <select name="b_nombre" id="b_nombre" onchange="buscar_io()">
                                        <option value="">Nombre Material</option>
                                        @foreach ($nombre as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th wire:ignore>
                                    <select name="b_clase" id="b_clase" onchange="buscar_io()">
                                        <option value="">Clase</option>
                                        @foreach ($clases as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th style="width:100px;">Precio</th>
                                <th class="text-center">OPERACION</th>
                            </tr>
                        </thead>
                        <tbody name="body" id="body">
                            @foreach ($productos as $id => $producto)
                                <tr>
                                    <td>{{ ++$id }}</td>
                                    <td>{{ $producto->codigo }}</td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>{{ $producto->clase }}</td>
                                    <td>{{ $producto->precio }}</td>
                                    <td>
                                        <a style="text-decoration: none" href="#" data-bs-toggle="modal"
                                            wire:click = "edit({{ $producto->id }})"
                                            data-bs-target="#material_editar"
                                            onclick="editar_claser('{{ $producto->clase }}')">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a>
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

    <div wire:ignore class="modal fade" id="material_editar" tabindex="-1"aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <form   wire:submit.prevent="actualizarMaterial" id="form_detalle" name="form_detalle"
                    style="width:100%;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><strong>Editar Material</strong>
                        </h5>
                        <button id="cerrar_modal_nuevo_precio" type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="codigo_edi" class="form-label" style="width:100%;">Codigo</label>
                                <input name="codigo_edi" id="codigo_edi" class="form-control"
                                    wire:model.defer='material.codigo' required type="text" autocomplete="off">
                            </div>
                            <div class="col-md-9">
                                <label for="material_edi"  class="form-label" style="width:100%;">Material</label>
                                <input name="material_edi" id="material_edi" class="form-control"
                                wire:model.defer='material.nombre' required type="text" autocomplete="off">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="clase_edi" class="form-label" style="width:100%;">Clase</label>
                                <select name="clase_edi" id="clase_edi"  wire:model.defer='material.clase'
                                    style="width:100%;" required>
                                    <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach ($clases as $v)
                                        <option value="{{ $v }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="precio_edi" class="form-label" style="width:100%;">Precio</label>
                                <input name="precio_edi" id="precio_edi" class="form-control"
                                wire:model.defer='material.precio' required type="text" autocomplete="off">
                            </div>
                            <div class="col-md-6">
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

                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            var control_edit_clase;
            // var control_nombre;
            // var control_vitola;
            // var control_capa;


            var seletscc = ["#b_nombre", "#b_clase", "#b_codigo"];

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

                control_edit_clase = new TomSelect('#clase_edi', {
                    create: true,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });



            });

            function editar_claser(params) {
                control_edit_clase.setValue(params);
            }

            function buscar_io() {
                @this.b_nombre = $(seletscc[0]).val();
                @this.b_clase = $(seletscc[1]).val();
                @this.b_codigo = $(seletscc[2]).val();
                @this.page = 1;
            }
        </script>
    @endpush
</div>
