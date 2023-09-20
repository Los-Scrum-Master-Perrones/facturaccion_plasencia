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
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Nuevo Precio</button>
                    </div>
                    <div class="col-3"></div>
                    <div class="col-3">
                        <div class="input-group mb-2">
                            <span class="input-group-text" id="basic-addon1">Rango Precios</span>
                            <input class="form-control" type="number" placeholder="$0.00" wire:model.lazy='precio_menor'>
                            <input class="form-control" type="number" placeholder="$0.00" wire:model.lazy='precio_mayor'>
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
                                <option value="{{  $total }}">Todos</option>
                            </select>
                            <button class="btn btn-success" wire:click='imprimir_reporte'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-spreadsheet" viewBox="0 0 16 16">
                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v4h10V2a1 1 0 0 0-1-1H4zm9 6h-3v2h3V7zm0 3h-3v2h3v-2zm0 3h-3v2h2a1 1 0 0 0 1-1v-1zm-4 2v-2H6v2h3zm-4 0v-2H3v1a1 1 0 0 0 1 1h1zm-2-3h2v-2H3v2zm0-3h2V7H3v2zm3-2v2h3V7H6zm3 3H6v2h3v-2z"/>
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
    <div wire:ignore class="offcanvas offcanvas-bottom" style="height: 60vh;" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header top-right">
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          @livewire('productos.calculo-precio')
        </div>
      </div>
    @push('scripts')
        <script>
            var seletscc = ["#b_codigo", "#b_marcas", "#b_nombre", "#b_vitolas", "#b_capas", "#b_empaques","#floatingSelect22","#floatingSelect223"];


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

            function buscar_io() {
                @this.codigo = $(seletscc[0]).val();
                @this.marca = $(seletscc[1]).val();
                @this.nombre = $(seletscc[2]).val();
                @this.vitola = $(seletscc[3]).val();
                @this.capa = $(seletscc[4]).val();
                @this.empaque = $(seletscc[5]).val();
                @this.page = 1;
            }

            function historial(key) {
                let precios = @this.datos;
                let historial = precios[key].historial[0];
                historial = historial.reverse();
                //alert(historial[0].precio);
                let html =`<div class="lineatemp">`;
                var precio_ultimo = Number(historial[0].precio);
                historial.forEach(e =>{

                    html  += `<div class="fila">
                            <div class="disco"><b></b><div>${Number(e.porcentaje_incremento).toFixed(2)*100}%</div></div>
                            <div>${e.anio}</div>
                            <div>$ ${Number(e.precio).toFixed(2)}</div>
                        </div>`

                });

                html  += `</div>`;

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
        </script>
    @endpush
</div>
