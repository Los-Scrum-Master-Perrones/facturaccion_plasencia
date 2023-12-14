<div>
    <div class="container" style="max-width:100%;">
        <div class="card" style="padding:0px;height: 85%;">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-2" wire:ignore style="height: 30px">
                        <div wire:loading>
                            <button id="btn_guardar" class="btn btn-outline-purpura" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-3" wire:ignore style="height: 30px">
                    </div>
                    <div class="col-md-5">

                    </div>
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
                        </div>
                    </div>
                </div>
                {{ $productos->links() }}
            </div>
            <div class="card-body">
                <div wire:loading.class='oscurecer_contenido'
                    style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;  height:450px;">
                    <table class="table table-light table-hover" style="font-size:10px;">
                        <thead>
                            <tr>
                                <th>N#</th>
                                <th wire:ignore>
                                    <select name="b_destino" id="b_destino" onchange="buscar_io()">
                                        <option value="">DESTINO</option>
                                        @foreach ($destino as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th wire:ignore>
                                    <select name="b_fecha" id="b_fecha" onchange="buscar_io()">
                                        <option value="">FECHA</option>
                                        @foreach ($fechas as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th wire:ignore>
                                    <select name="b_orden" id="b_orden" onchange="buscar_io()">
                                        <option value="">ORDEN</option>
                                        @foreach ($ordenes as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th wire:ignore>
                                    <select name="b_codigo" id="b_codigo" onchange="buscar_io()">
                                        <option value="">CODIGO PRODUCTO</option>
                                        @foreach ($codigos as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th style="width:100px;" wire:ignore>
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
                                <th>CANTIDAD</th>
                                <th>OPERACION</th>
                            </tr>
                        </thead>
                        <tbody name="body" id="body">
                            @php
                                $sumas = 0;
                            @endphp
                            @foreach ($productos as $id => $producto)
                                <tr>
                                    <td>{{ ++$id }}</td>
                                    <td>{{ $producto->destino }}</td>
                                    <td>{{ $producto->fecha_salida }}</td>
                                    <td>{{ intval($producto->orden_sistema) }}</td>
                                    <td>{{ $producto->codigo }}</td>
                                    <td>{{ $producto->marca }}</td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>{{ $producto->vitola }}</td>
                                    <td>{{ $producto->capa }}</td>
                                    <td>{{ $producto->cantidad }}</td>
                                    <td>
                                        <a style="text-decoration: none" onclick="eliminar_item({{ $producto->id }})" href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                            </svg>
                                        </a>
                                    </td>
                                    @php
                                        $sumas += $producto->cantidad;
                                    @endphp
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="input-group" style="width:20%; position: fixed;right: 0px;bottom:0px; height:30px;">
        <span class="form-control input-group-text">Total saldo</span>
        <input type="text" class="form-control" id="sumas" value="{{ $sumas }}">
    </div>

    @push('scripts')
        <script>

            const Toast = Swal.mixin({
                    toast: true
                    , position: 'top-end'
                    , showConfirmButton: false
                    , timer: 3000
                    , timerProgressBar: true
                    , didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

            var seletscc = ["#b_orden", "#b_fecha", "#b_codigo", "#b_marca", "#b_nombre", "#b_vitola", "#b_capa","#b_destino"];
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
            });

            function buscar_io() {
                @this.b_orden = $(seletscc[0]).val();
                @this.b_fecha = $(seletscc[1]).val();
                @this.b_codigo = $(seletscc[2]).val();
                @this.b_marca = $(seletscc[3]).val();
                @this.b_nombre = $(seletscc[4]).val();
                @this.b_vitola = $(seletscc[5]).val();
                @this.b_capa = $(seletscc[6]).val();
                @this.b_destino = $(seletscc[7]).val();
                @this.page = 1;
            }

            function eliminar_item(id) {
                Swal.fire({
                    title: 'Esta seguro?',
                    text: "Eliminar la salida, no podra revertise!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.eliminar_salida(id);
                    } else {

                    }
                })
            }

            window.addEventListener('salida_eliminada', event => {
                Toast.fire({
                    icon: 'success'
                    , title: 'Salida eliminada con exito.'
                });
            })
        </script>
    @endpush
</div>
