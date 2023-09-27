<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <ul class="nav  nav-tabs  justify-content-center">
        <li class="nav-item">
            <a class="nav-link" style="color:white; font-size:12px;"
                href="{{ route('materiales.index') }}"><strong>Materiales</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:white; font-size:12px;"
                href="{{ route('materiales.relacionar') }}"><strong>Materiales
                    materials</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:#E5B1E2; font-size:12px;"
                href="{{ route('entradas.salidas') }}"><strong>Entrada/Salida</strong></a>
        </li>
    </ul>

    <div class="container" style="max-width:100%;">
        <div class="card" style="padding:0px;">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3" wire:ignore style="height: 30px">
                        <input class="form-control" autocomplete="off" id="example" />
                    </div>
                    <div class="col-md-4">
                        <form wire:submit.prevent="import" class="form-inline">
                            @csrf
                            <div class="input-group mb-3" style="height: 30px">
                                <input type="file" name="select_file" id="select_file"
                                    style="height: 30px;font-size: 0.7em" wire:model="select_file"
                                    class="form-control" />
                                <input type="submit" name="upload" class="btn btn-primary"
                                    style="height: 30px;font-size: 0.7em" value="Importar">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3"></div>
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
                    <table class="table table-light" style="font-size:10px;">
                        <thead>
                            <tr>
                                <th>N#</th>
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
                                <th>SALDO</th>
                            </tr>
                        </thead>
                        <tbody name="body" id="body">
                            @php
                                $sumas = 0;
                            @endphp
                            @foreach ($productos as $id => $producto)
                                <tr>
                                    <td>{{ ++$id }}</td>
                                    <td>{{ $producto->fecha }}</td>
                                    <td>{{ intval($producto->orden) }}</td>
                                    <td>{{ $producto->codigo }}</td>
                                    <td>{{ $producto->marca }}</td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>{{ $producto->vitola }}</td>
                                    <td>{{ $producto->capa }}</td>
                                    <td>{{ $producto->existencia }}</td>
                                    @php
                                        $sumas += $producto->existencia;
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
            var seletscc = ["#b_orden", "#b_fecha", "#b_codigo", "#b_marca", "#b_nombre", "#b_vitola", "#b_capa"];
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


                const myDatePicker = new HotelDatepicker(inputField, {
                    autoClose: false,
                    startDate: new Date('2020-01-01'),
                    endDate: false,
                    onSelectRange: function() {
                        console.log('Fecha de inicio:', myDatePicker.getValue());

                        const fechasSeparadas = myDatePicker.getValue().split(' - ');

                        const fechaInicio = fechasSeparadas[0];
                        const fechaFin = fechasSeparadas[1];

                        @this.b_fecha_inicial = fechaInicio;
                        @this.b_fecha_final = fechaFin;
                    },
                    i18n: {
                        selected: 'Rango de Fecha:',
                        night: 'Día',
                        nights: 'Días',
                        button: 'Cerrar',
                        clearButton: 'Limpiar',
                        submitButton: 'Enviar',
                        'checkin-disabled': 'Check-in no disponible',
                        'checkout-disabled': 'Check-out no disponible',
                        'day-names-short': ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                        'day-names': ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                        'month-names-short': ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep',
                            'Oct', 'Nov', 'Dic'
                        ],
                        'month-names': ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
                            'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                        ],
                        'error-more': 'El rango de fechas no debe ser mayor a 1 noche',
                        'error-more-plural': 'El rango de fechas no debe ser mayor a %d noches',
                        'error-less': 'El rango de fechas no debe ser menor a 1 noche',
                        'error-less-plural': 'El rango de fechas no debe ser menor a %d noches',
                        'info-more': 'Por favor, selecciona un rango de fechas de al menos 1 noche',
                        'info-more-plural': 'Por favor, selecciona un rango de fechas de al menos %d noches',
                        'info-range': 'Por favor, selecciona un rango de fechas entre %d y %d noches',
                        'info-range-equal': 'Por favor, selecciona un rango de fechas de %d noches',
                        'info-default': 'Por favor, selecciona un rango de fechas',
                        'aria-application': 'Calendario',
                        'aria-selected-checkin': 'Seleccionado como fecha de check-in, %s',
                        'aria-selected-checkout': 'Seleccionado como fecha de check-out, %s',
                        'aria-selected': 'Seleccionado, %s',
                        'aria-disabled': 'No disponible, %s',
                        'aria-choose-checkin': 'Elige %s como tu fecha de check-in',
                        'aria-choose-checkout': 'Elige %s como tu fecha de check-out',
                        'aria-prev-month': 'Ir hacia atrás para cambiar al mes anterior',
                        'aria-next-month': 'Ir hacia adelante para cambiar al próximo mes',
                        'aria-close-button': 'Cerrar el selector de fechas',
                        'aria-clear-button': 'Limpiar las fechas seleccionadas',
                        'aria-submit-button': 'Enviar el formulario'
                    }
                });

            });



            function buscar_io() {
                @this.b_orden = $(seletscc[0]).val();
                @this.b_fecha = $(seletscc[1]).val();
                @this.b_codigo = $(seletscc[2]).val();
                @this.b_marca = $(seletscc[3]).val();
                @this.b_nombre = $(seletscc[4]).val();
                @this.b_vitola = $(seletscc[5]).val();
                @this.b_capa = $(seletscc[6]).val();
                @this.page = 1;
            }
        </script>
    @endpush
</div>
