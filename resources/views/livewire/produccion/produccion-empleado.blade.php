<div>
    <div class="container" style="max-width:100%;">
        <div class="card" style="padding:0px;height: 85%;">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3" wire:ignore style="height: 30px">
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" wire:model='b_fecha_1'>
                            <input type="date" class="form-control" wire:model='b_fecha_2'>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div wire:loading>
                            <button id="btn_guardar" class="btn btn-outline-purpura" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <input type="radio" autocomplete="off" wire:model='b_rol' value='rolero'>
                        <label for="success-outlined">Roleros</label>

                        <input type="radio" autocomplete="off" wire:model='b_rol' value='bonchero'>
                        <label for="danger-outlined">Boncheros</label>

                        <input type="radio" autocomplete="off" wire:model='b_rol' value='boncherorolero'>
                        <label for="danger-outlined">Ambos</label>
                    </div>
                    <div class="col-md-3" wire:ignore style="height: 30px">
                        <input type="checkbox" autocomplete="off" wire:model='b_presentacion1' value='Tripa Larga'>
                        <label for="success-outlined">Tripa Larga</label>

                        <input type="checkbox" autocomplete="off" wire:model='b_presentacion2' value='Tripa Corta'>
                        <label for="danger-outlined">Tripa Corta</label>

                        <input type="checkbox" autocomplete="off" wire:model='b_presentacion3' value='Brocha'>
                        <label for="danger-outlined">Brocha</label></div>
                    <div class="col-md-2">
                        <div class="input-group mb-3" style="height: 30px">
                            <span class="input-group-text" id="basic-addon1" style="height: 30px;font-size: 0.7em">Por Pagina</span>
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
                            <button class="btn btn-primary" wire:click='imprimir_reporte_planilla' style="height: 30px">
                                <abbr title="Planilla">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-check-fill" viewBox="0 0 16 16">
                                        <path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5Z"/>
                                        <path d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585c.055.156.085.325.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5c0-.175.03-.344.085-.5Zm6.769 6.854-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708Z"/>
                                    </svg>
                                </abbr>
                            </button>
                        </div>
                    </div>
                </div>
                {{ $productos->links() }}
            </div>
            <div class="card-body">
                <div wire:loading.class='oscurecer_contenido'
                    style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;  height:450px;">
                    <table class="table table-light" style="font-size:10px;">
                        <thead>
                            <tr>
                                <th>N#</th>
                                <th wire:ignore>
                                    <select name="b_orden" id="b_orden" onchange="buscar_io()">
                                        <option value="">ORDEN</option>
                                        @foreach ($ordenes as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th>FECHA</th>
                                <th wire:ignore>
                                    <select name="b_codigo_empleado" id="b_codigo_empleado" onchange="buscar_io()">
                                        <option value="">Codigo</option>
                                        @foreach ($codigos_empleado as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th wire:ignore>
                                    <select name="b_nombre_empleado" id="b_nombre_empleado" onchange="buscar_io()">
                                        <option value="">Empleado</option>
                                        @foreach ($nombres_empleado as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th wire:ignore>
                                    <select name="b_codigo" id="b_codigo" onchange="buscar_io()">
                                        <option value="">CODIGO PRODUCTO</option>
                                        @foreach ($codigos_producto as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th wire:ignore>
                                    PRESENTACION
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
                                <th>CANTIDAD (L)</th>
                                <th>OPERACION</th>
                            </tr>
                        </thead>
                        <tbody name="body" id="body">
                            @php
                                $sumas = 0;
                                $sumasLempiras = 0;
                            @endphp
                            @foreach ($productos as $id => $producto)
                                <tr>
                                    <td>{{ ++$id }}</td>
                                    <td class="text-center">{{ $producto->orden }}</td>
                                    <td class="text-center">{{ $producto->fecha }}</td>
                                    <td class="text-center">{{ $producto->codigo_empleaado }}</td>
                                    <td>{{ '('.Str::upper($producto->rol).') '.$producto->nombre_empleado }}</td>
                                    <td class="text-center">{{ $producto->codigo_producto }}</td>
                                    <td class="text-center">{{ $producto->presentacion }}</td>
                                    <td>{{ $producto->marca }}</td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>{{ $producto->vitola }}</td>
                                    <td>{{ $producto->capa }}</td>
                                    <td class="text-center">{{ $producto->cantidad }}</td>
                                    <td>L. {{ number_format($producto->por_pagar, 2) }}</td>
                                    <td class="text-center">
                                        <a style="text-decoration: none" onclick="eliminar_item({{ $producto->id }})" href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                            </svg>
                                        </a>
                                    </td>
                                    @php
                                        $sumas += $producto->cantidad;
                                        $sumasLempiras += $producto->por_pagar;
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

        <span class="form-control input-group-text">Total (L.)</span>
        <input type="text" class="form-control" id="sumas" value="{{ number_format($sumasLempiras,2) }}">
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

            var seletscc = ["#b_orden", "#b_codigo","#b_nombre_empleado","#b_codigo_empleado","#b_marca", "#b_nombre", "#b_vitola", "#b_capa"];
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
                @this.b_marca = $(seletscc[4]).val();
                @this.b_nombre = $(seletscc[5]).val();
                @this.b_vitola = $(seletscc[6]).val();
                @this.b_capa = $(seletscc[7]).val();
                @this.b_codigo_productos = $(seletscc[1]).val();
                @this.b_codigo_empleado = $(seletscc[3]).val();
                @this.b_nombre_empleado = $(seletscc[2]).val();
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
