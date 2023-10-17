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

        html {
            font-family: sans-serif;
        }

        .lineatemp {
            position: relative;
            width: 400px;
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
    </style>

    <br>

    <div class="container" style="max-width:100%;">
        <div class="card" style="padding:0px;">
            <div class="card-header">
                <div class="row">
                    <div class="col-4">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#productos_agregar_detalles"
                            aria-controls="productos_agregar_detalles">Crear Precio</button>
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Nuevo Precio</button>
                    </div>
                    <div class="col-3"></div>
                    <div class="col-3">
                        <div class="input-group mb-2">
                            <span class="input-group-text" id="basic-addon1">Rango Precios</span>
                            <input class="form-control" type="number" placeholder="$0.00"
                                wire:model.lazy='precio_menor'>
                            <input class="form-control" type="number" placeholder="$0.00"
                                wire:model.lazy='precio_mayor'>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Por Pagina</span>
                            <select name="" id="" class="form-control" wire:model='por_pagina'>
                                <option value="50">50</option>
                                <option value="200">200</option>
                                <option value="500">500</option>
                                <option value="1000">1000</option>
                                <option value="{{ $total }}">Todos</option>
                            </select>
                            <button class="btn btn-success" wire:click='imprimir_reporte'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-file-spreadsheet" viewBox="0 0 16 16">
                                    <path
                                        d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v4h10V2a1 1 0 0 0-1-1H4zm9 6h-3v2h3V7zm0 3h-3v2h3v-2zm0 3h-3v2h2a1 1 0 0 0 1-1v-1zm-4 2v-2H6v2h3zm-4 0v-2H3v1a1 1 0 0 0 1 1h1zm-2-3h2v-2H3v2zm0-3h2V7H3v2zm3-2v2h3V7H6zm3 3H6v2h3v-2z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                {{ $prodcutosPrecio->links() }}
            </div>
            <div class="card-body">
                <div wire:loading.class='oscurecer_contenido'
                    style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;  height:450px;">
                    <table class="table table-light" style="font-size:10px;">
                        <thead style=" position: static;">
                            <tr style="font-size:16px; text-align:center;">
                                <th style=" text-align:center;">#</th>
                                <th style=" text-align:center;" wire:ignore>
                                    <select style="width: 150px;height:35px;" onchange="buscar_io()" name="b_codigo"
                                        id="b_codigo">
                                        <option value="">Codigo</option>
                                        @foreach ($codigo_p as $pr)
                                            <option value="{{ $pr }}">{{ $pr }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th style=" text-align:center;" wire:ignore>
                                    <select style="width: 150px;height:35px;" onchange="buscar_io()" name="b_marcas"
                                        id="b_marcas">
                                        <option value="">Marcas</option>
                                        @foreach ($marcas_p as $pr)
                                            <option value="{{ $pr }}">{{ $pr }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th style=" text-align:center;" wire:ignore>
                                    <select style="width: 150px;height:35px;" onchange="buscar_io()" name="b_nombre"
                                        id="b_nombre">
                                        <option value="">Nombre</option>
                                        @foreach ($nombre_p as $pr)
                                            <option value="{{ $pr }}">{{ $pr }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th style=" text-align:center;" wire:ignore>
                                    <select style="width: 150px;height:35px;" onchange="buscar_io()" name="b_vitolas"
                                        id="b_vitolas">
                                        <option value="">Vitolas</option>
                                        @foreach ($vitolas_p as $pr)
                                            <option value="{{ $pr }}">{{ $pr }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th style=" text-align:center;" wire:ignore>
                                    <select style="width: 150px;height:35px;" onchange="buscar_io()" name="b_capas"
                                        id="b_capas">
                                        <option value="">Capas</option>
                                        @foreach ($capas_p as $pr)
                                            <option value="{{ $pr }}">{{ $pr }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th style=" text-align:center;" wire:ignore>
                                    <select style="width: 150px;height:35px;" onchange="buscar_io()" name="b_empaques"
                                        id="b_empaques">
                                        <option value="">Tipo de Empaque</option>
                                        @foreach ($empaques_p as $pr)
                                            <option value="{{ $pr }}">{{ $pr }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th style=" text-align:center;">Precio ({{ Carbon\Carbon::now()->format('Y') }})</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $count = 1;
                            @endphp
                            @foreach ($prodcutosPrecio as $key => $prodPrecio)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $prodPrecio->codigo }}</td>
                                    <td>{{ $prodPrecio->marca }}</td>
                                    <td>{{ $prodPrecio->nombre }}</td>
                                    <td>{{ $prodPrecio->vitola }}</td>
                                    <td>{{ $prodPrecio->capa }}</td>
                                    <td>{{ $prodPrecio->tipo_empaque }}</td>
                                    <td style="text-align: right">
                                        {{ '$ ' . number_format($prodPrecio->precio_actual->precio, 2) }}
                                        <a href="#" onclick='historial({{ $key }})'>
                                            <abbr title="Historial de Precios">
                                                <img width="20" height="20"
                                                    src="https://img.icons8.com/ios/50/time-machine--v1.png"
                                                    alt="time-machine--v1" />
                                            </abbr>
                                        </a>
                                        <a wire:click="editarPrecio({{ $prodPrecio->id }})" onclick='cargar_modal("{{ $prodPrecio->marca }}","{{ $prodPrecio->nombre }}","{{ $prodPrecio->vitola }}","{{ $prodPrecio->capa }}","{{ $prodPrecio->tipo_empaque }}",{{ $prodPrecio->precio_actual->precio }})' style=" width:10px; height:10px; text-decoration: none" data-bs-toggle="modal" href="#"
                                            data-bs-target="#productos_editar_detalles" type="submit">
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
                                @php
                                    $count++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore class="offcanvas offcanvas-bottom" style="height: 60vh;" tabindex="-1" id="offcanvasBottom"
        aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header top-right">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @livewire('productos.calculo-precio')
        </div>
    </div>

    <div wire:ignore class="modal fade" id="productos_agregar_detalles" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <form wire:submit.prevent="save" id="form_detalle" name="form_detalle" style="width:100%;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><strong>Agregar Precio Nuevo</strong>
                        </h5>
                        <button id="cerrar_modal_nuevo_precio" type="button" class="btn-close"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col">
                                <label class="form-label" style="width:100%;">Codigo</label>
                                <input name="codigo_de" id="codigo_de" class="form-control" wire:model='codigo_n'
                                    required type="text" autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                                <label class="form-label" style="width:100%;">Capa</label>
                                <select name="capa_de" id="capa_de" onchange="buscar_agregar()"
                                    style="width:100%;" required>
                                    <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach ($capas_p as $capa)
                                        <option style="overflow-y: scroll;"> {{ $capa }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col">
                                <label  class="form-label" style="width:100%;">Marca</label>
                                <select name="marca_de" id="marca_de" onchange="buscar_agregar()"
                                    style="width:100%;" required>
                                    <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach ($marcas_p as $marca)
                                        <option style="overflow-y: scroll;"> {{ $marca }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col">
                                <label class="form-label" style="width:100%;">Nombre</label>
                                <select name="nombre_de" id="nombre_de" onchange="buscar_agregar()"
                                    style="width:100%;" required>
                                    <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach ($nombre_p as $nombre)
                                        <option style="overflow-y: scroll;"> {{ $nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col">
                                <label  class="form-label" style="width:100%;">Vitola</label>
                                <select name="vitola_de" id="vitola_de" onchange="buscar_agregar()"
                                    style="width:100%;" required>
                                    <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach ($vitolas_p as $vitola)
                                        <option style="overflow-y: scroll;"> {{ $vitola }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col">
                                <label  class="form-label" style="width:100%;">Tipo de
                                    empaque</label>
                                <select name="tipo_de" id="tipo_de" onchange="buscar_agregar()"
                                    style="width:100%;" required>
                                    <option value="N/D" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach ($empaques_p as $tipo_empaque)
                                        <option style="overflow-y: scroll;"> {{ $tipo_empaque }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="txt_buenos">Precio</label>
                                <input name="precio_de" id="precio_de" class="form-control" wire:model='precio_n'
                                    required type="number" onchange="buscar_agregar()" autocomplete="off">
                            </div>
                            <div class="mb-3 col">
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

                </form>
            </div>
        </div>
    </div>

    <!-- INICIO MODAL ACTUALIZAR DATO PRECIO -->
    <div wire:ignore class="modal fade" id="productos_editar_detalles" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <form wire:submit.prevent="actualizarPrecio()" id="form_detalle" name="form_detalle" style="width:100%;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><strong>Editar Precio Nuevo</strong>
                        </h5>
                        <button id="cerrar_modal_nuevo_precio" type="button" class="btn-close"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="codigo_edi" class="form-label" style="width:100%;">Codigo</label>
                                <input name="codigo_edi" id="codigo_edi" class="form-control" wire:model='new_precio.codigo'
                                    required type="text" autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                                <label class="form-label" style="width:100%;">Capa</label>
                                <select name="capa_edi" id="capa_edi"  wire:model='new_precio.capa'
                                    style="width:100%;" required>
                                    <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach ($capas_p as $capa)
                                        <option style="overflow-y: scroll;">{{ $capa }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col">
                                <label for="marca_edi" class="form-label" style="width:100%;">Marca</label>
                                <select name="marca_edi" id="marca_edi"
                                    style="width:100%;" required>
                                    <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach ($marcas_p as $marca)
                                        <option style="overflow-y: scroll;"> {{ $marca }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="nombre_edi" class="form-label" style="width:100%;">Nombre</label>
                                <select name="nombre_edi" id="nombre_edi" wire:model='new_precio.nombre'
                                    style="width:100%;" required>
                                    <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach ($nombre_p as $nombre)
                                        <option style="overflow-y: scroll;"> {{ $nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col">
                                <label for="vitola_edi" class="form-label" style="width:100%;">Vitola</label>
                                <select name="vitola_edi" id="vitola_edi" wire:model='new_precio.vitola'
                                    style="width:100%;" required>
                                    <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach ($vitolas_p as $vitola)
                                        <option style="overflow-y: scroll;"> {{ $vitola }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col">
                                <label for="tipo_edi" class="form-label" style="width:100%;">Tipo de
                                    empaque</label>
                                <select name="tipo_edi" id="tipo_edi" wire:model='new_precio.tipo_empaque'
                                    style="width:100%;" required>
                                    <option value="N/D" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach ($empaques_p as $tipo_empaque)
                                        <option style="overflow-y: scroll;"> {{ $tipo_empaque }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="txt_buenos">Precio</label>
                                <input name="precio_edi" id="precio_edi" class="form-control" wire:model='edi_precio'
                                    required type="text"  autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                            </div>
                            <div class="mb-3 col">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button type="submit" class="btn btn-success" data-bs-dismiss="modal">
                            <span>Guardar</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- FIN MODAL ACTUALIZAR DATO PRECIO -->
    @push('scripts')
        <script>
            var control_marca;
            var control_nombre;
            var control_vitola;
            var control_capa;
            var control_tipo;
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

            var seletscc = ["#b_codigo", "#b_marcas", "#b_nombre", "#b_vitolas", "#b_capas", "#b_empaques", "#floatingSelect22",
                "#capa_de",
                "#marca_de",
                "#nombre_de",
                "#vitola_de",
                "#tipo_de",
                "#floatingSelect223",
            ];

            $(document).ready(function() {
                seletscc.forEach(element => {
                    selects(element);
                });

                control_capa = new TomSelect('#capa_edi', {
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
                control_marca = new TomSelect('#marca_edi', {
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
                control_nombre = new TomSelect('#nombre_edi', {
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
                control_vitola = new TomSelect('#vitola_edi', {
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
                control_tipo = new TomSelect('#tipo_edi', {
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
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

            function cargar_modal(marca,nombre,vitola,capa,empaque,precio){
                control_marca.setValue(marca);
                control_nombre.setValue(nombre);
                control_vitola.setValue(vitola);
                control_capa.setValue(capa);
                control_tipo.setValue(empaque);
                @this.edi_precio =precio;
            }

            function buscar_io() {
                @this.codigo = $(seletscc[0]).val();
                @this.marca = $(seletscc[1]).val();
                @this.nombre = $(seletscc[2]).val();
                @this.vitola = $(seletscc[3]).val();
                @this.capa = $(seletscc[4]).val();
                @this.empaque = $(seletscc[5]).val();
                @this.page = 1;
            }

            function buscar_agregar() {
                @this.marca_n = $(seletscc[8]).val();
                @this.nombre_n = $(seletscc[9]).val();
                @this.vitola_n = $(seletscc[10]).val();
                @this.capa_n = $(seletscc[7]).val();
                @this.empaque_n = $(seletscc[11]).val();
            }

            function historial(key) {
                let precios = @this.datos;
                let historial = precios[key].historial[0];
                historial = historial.reverse();
                //alert(historial[0].precio);
                let html = `<div class="lineatemp">`;
                var precio_ultimo = Number(historial[0].precio);
                historial.forEach(e => {

                    html += `<div class="fila">
                            <div class="disco"><b></b><div>${Number(e.porcentaje_incremento).toFixed(2)*100}%</div></div>
                            <div>${e.anio}</div>
                            <div>$ ${Number(e.precio).toFixed(2)}</div>
                        </div>`

                });

                html += `</div>`;

                Swal.fire({
                    title: '<strong>Historial de Cambios</strong>',
                    html: html,
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText: '<i class="fa fa-thumbs-up"></i> Great!',
                    confirmButtonAriaLabel: 'Thumbs up, great!',
                    cancelButtonText: '<i class="fa fa-thumbs-down"></i>',
                    cancelButtonAriaLabel: 'Thumbs down'
                })
            }

            window.addEventListener('RegistradoConExito', event => {
                Toast.fire({
                    icon: 'success',
                    title: 'Registro realizada con exito.'
                });
                var btnCerrar = document.getElementById("cerrar_modal_nuevo_precio");
                btnCerrar.click();
            })
        </script>
    @endpush
</div>
