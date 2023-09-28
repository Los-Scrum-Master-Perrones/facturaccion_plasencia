<div xmlns:wire="http://www.w3.org/1999/xhtml">

    <ul class="nav nav-tabs justify-content-center">
        @if (auth()->user()->rol == -1)
        @else
            <li class="nav-item">
                <a class="nav-link" style="color:white; font-size:12px;"
                    href="{{ route('reportediarios') }}"><strong>Reporte Diarios</strong></a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" style="color:#E5B1E2; font-size:12px;"
                href="{{ route('programacionterminado') }}"><strong>Programaciones</strong></a>
        </li>
    </ul>




    <div style="width:100%;">

        <div class="row" style="width:100%;">

            <div style="padding-left:25px;" class="col-sm-3" style="text-align:right;">
                <input type="date" name="fecha" id="fecha" style="width: 100%;" class="form-control"
                    placeholder="Nombre" wire:model="fecha">
            </div>

            <div class="col-sm-2" style="text-align:right;">
                @foreach ($titulo as $programacion)
                    <h4 style="color:#ffffff;" id="contenedor" name="contenedor" value="" wire:model="titulo">
                        <strong>
                            {{ $programacion->mes_contenedor }}</strong></h4>
                @endforeach
            </div>


            <div class="col-sm-4" style="text-align:right;">
                <form action="{{ Route('exportar_programacion_terminado') }}" id="formver" name="formver">
                    <input name="buscar" id="buscar" value="{{ isset($busqueda) ? $busqueda : null }}"
                        onKeyDown="copiar('buscar','b');" class="  form-control" wire:model="busqueda"
                        placeholder="Búsqueda por Marca, Nombre, Vitola e Item" style="width:100%; padding:right;">
            </div>


            <div class="col-sm-1" style="text-align:right;">

                <input value="{{ isset($id_tov) ? $id_tov : 0 }}" name="id_tov" id="id_tov" hidden wire:model="id_tov">

                <button class="botonprincipal" id="xdd" type="submit" style="width:60px;">Exportar </button>

            </div>
            </form>
            <div hidden class="col-sm-1" style="text-align:right;">

                <button class="botonprincipal" style="width:60px;" data-bs-toggle="modal"
                    data-bs-target="#Remision">Generar Remision</button>

            </div>




        </div>
    </div>






    <div style="width:100%; padding-left:25px; padding-right:10px;">
        <div class="row">
            <div class="col-sm-3" style="padding-left:0px;   font-size:10px;  ">
                <div wire:change='tama' id="tabla_materiales2" class="table-responsive">
                    <div wire:loading.class='oscurecer_contenido' style="width:100%; padding-left:0px;">
                        <table class="table table-light" id="editable" style="font-size:10px;">

                            <thead>
                                <tr style="text-align:center;">
                                    <th style=" text-align:center;">#-No.</th>
                                    <th style=" text-align:center;">FECHA</th>
                                    <th style=" text-align:center;">CONTENEDOR</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($programaciones == null)
                                    <tr style="text-align:center;">
                                        <th colspan="3" style=" text-align:center;">No existe Planificacion para este
                                            mes</th>
                                    </tr>
                                @endif

                                @foreach ($programaciones as $i => $programacion)
                                    <tr>
                                        <td> {{ $i + 1 }}</td>
                                        <td> {{ $programacion->fecha }}</td>
                                        <td> {{ $programacion->mes_contenedor }}

                                            <div class="row">
                                                <div class="col-sm-1" style="text-align:right;">
                                                    <a style=" width:10px; height:10px;" onClick="limpiartable()"
                                                        wire:click='ver({{ $programacion->id }})'>
                                                        <button
                                                            style="background: none; color: inherit;   border: none;  padding: 0;
                                                font: inherit;  cursor: pointer; outline: inherit;">

                                                            <abbr title="Mostrar detalles de la programación"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="20"
                                                                    height="20" fill="currentColor"
                                                                    class="bi bi-eye-fill" viewBox="0 0 16 16"
                                                                    style="color:black;">
                                                                    <path
                                                                        d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                                    <path
                                                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                                </svg>
                                                            </abbr>

                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-9" style="padding-left:0px;   font-size:10px;  ">
                <div wire:change='tama' id="tabla_materiales" class="table-responsive">
                    <div wire:loading.class='oscurecer_contenido' style="width:100%; padding-left:0px; height:100%;">
                        <table class="table table-light" id="editable" style="font-size:10px;">
                            <thead>
                                <tr style=" text-align:center;">
                                    <th># ORDEN</th>
                                    <th style=" text-align:center;">ORDEN</th>
                                    <th style=" text-align:center;">ITEM</th>
                                    <th style=" text-align:center;">MARCA</th>
                                    <th style=" text-align:center;">VITOLA</th>
                                    <th style=" text-align:center;">NOMBRE</th>
                                    <th style=" text-align:center;">CAPA</th>
                                    <th style=" text-align:center;">TIPO DE EMPAQUE</th>
                                    <th style=" text-align:center;">BULTOS</th>
                                    <th style=" text-align:center;">SALDO</th>
                                    <th style=" text-align:center;">LISTOS</th>
                                    <th style=" text-align:center;">RESTANTES</th>
                                    <th style=" text-align:center;">OPERACIONES</th>
                                    <th style=" text-align:center;">CODIGO</th>
                                    <th style=" text-align:center;">FICHA</th>

                                </tr>
                            </thead>
                            <tbody id="tablechange">

                                @php
                                    $Tsaldo = 0;
                                    $Tlistos = 0;
                                    $suma_total = 0;
                                    $acum = 0;

                                @endphp
                                @foreach ($detalles_programaciones as $detalles_programacione)
                                    <tr>
                                        @php
                                            $suma_total += $detalles_programacione->saldo;
                                            $acum = $acum + 1;
                                            $Tsaldo = $Tsaldo + $detalles_programacione->saldo;
                                            $Tlistos = $Tlistos + $detalles_programacione->listos;
                                        @endphp
                                        <td> {{ $detalles_programacione->numero_orden }}</td>
                                        <td> {{ $detalles_programacione->orden }}</td>
                                        <td> {{ $detalles_programacione->item }}</td>
                                        <td> {{ $detalles_programacione->marca }}</td>
                                        <td> {{ $detalles_programacione->vitola }}</td>
                                        <td> {{ $detalles_programacione->nombre }}</td>
                                        <td> {{ $detalles_programacione->capa }}</td>
                                        <td> {{ $detalles_programacione->tipo_empaque }}</td>
                                        <td> {{ round($detalles_programacione->saldo / $detalles_programacione->cantidad_bultos, 2) }}
                                        </td>
                                        <td> {{ $detalles_programacione->saldo }}</td>
                                        <td>{{ $detalles_programacione->listos }}</td>
                                        @if ($detalles_programacione->saldo != 0)
                                            <td><b>{{ $detalles_programacione->saldo - $detalles_programacione->listos }}</b>
                                            </td>
                                        @else
                                            <td><b>N.A</b></td>
                                        @endif
                                        <td style="text-align:center;">
                                            <a class=""
                                                onclick="cargardatos('{{ $detalles_programacione->id }}',
                                        '{{ $detalles_programacione->item }}','{{ $detalles_programacione->id_programacion }}',
                                        '{{ $detalles_programacione->numero_orden }}','{{ $detalles_programacione->ordenes }}',)"
                                                data-bs-toggle="modal" data-bs-target="#modal-listos">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-bag-plus-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path
                                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0
                                        0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                </svg>
                                            </a>
                                        </td>


                                        <td class="xokers">
                                            <a id="{{ 'xokers' . $acum }}"
                                                href="data:image/png;base64,{{ DNS2D::getBarcodePNG(strval($detalles_programacione->id), 'QRCODE') }}"
                                                download="{{ $detalles_programacione->marca . ' ' . $detalles_programacione->vitola }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-bag-plus-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0v-3Zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1
                                        .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5ZM.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5
                                        -.5v-3a.5.5 0 0 1 .5-.5Zm15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0
                                        1 .5-.5ZM4 4h1v1H4V4Z" />
                                                    <path d="M7 2H2v5h5V2ZM3 3h3v3H3V3Zm2 8H4v1h1v-1Z" />
                                                    <path d="M7 9H2v5h5V9Zm-4 1h3v3H3v-3Zm8-6h1v1h-1V4Z" />
                                                    <path
                                                        d="M9 2h5v5H9V2Zm1 1v3h3V3h-3ZM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8H8Zm2 2H9V9h1v1Zm4 2h-1v1h-2v1h3v-2Zm-4
                                        2v-1H8v1h2Z" />
                                                    <path d="M12 9h2V8h-2v1Z" />
                                                </svg>
                                            </a>
                                        </td>

                                        <td class="xokers">
                                            <button
                                                wire:click="item(
                                            '{{ $detalles_programacione->sampler_descri }}',
                                            '{{ $detalles_programacione->vitola }}', '{{ $detalles_programacione->nombre }}',
                                            '{{ $detalles_programacione->capa }}', '{{ $detalles_programacione->tipo_empaque }}',
                                            '{{ $detalles_programacione->cantidad_bultos }}', '{{ $detalles_programacione->item }}'
                                            ,'{{ $detalles_programacione->id }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-bag-plus-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0v-3Zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1
                                        .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5ZM.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5
                                        -.5v-3a.5.5 0 0 1 .5-.5Zm15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0
                                        1 .5-.5ZM4 4h1v1H4V4Z" />
                                                    <path d="M7 2H2v5h5V2ZM3 3h3v3H3V3Zm2 8H4v1h1v-1Z" />
                                                    <path d="M7 9H2v5h5V9Zm-4 1h3v3H3v-3Zm8-6h1v1h-1V4Z" />
                                                    <path
                                                        d="M9 2h5v5H9V2Zm1 1v3h3V3h-3ZM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8H8Zm2 2H9V9h1v1Zm4 2h-1v1h-2v1h3v-2Zm-4
                                        2v-1H8v1h2Z" />
                                                    <path d="M12 9h2V8h-2v1Z" />
                                                </svg>
                                            </button>
                                        </td>

                                    </tr>
                                @endforeach

                                <tr>
                                    <td style="text-align:center;" colspan="9">
                                        <FONT SIZE=3 for="" style="font-family: fantasy;" class="form-label">
                                            TOTAL
                                        </FONT>
                                    </td>
                                    <td><b> {{ $Tsaldo }}</b></td>
                                    <td><b> {{ $Tlistos }}</b></td>
                                    <td><b>{{ $Tsaldo - $Tlistos }}</b></td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>




    <form id="updatelisto" name="updatelistoterminado" wire:ignore>
        <div class="modal fade" id="modal-listos" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="staticBackdropLabel"
                            style="width:450px; text-align:center; font-size:20px;">Cargar Diario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label"
                                style="width:440px; text-align:center; font-size:20px;">Cantidad de Puros</label>
                            <input class="form-control" id="pa_cantidad" name="pa_cantidad" placeholder="Ingresar"
                                style="width: 440px" maxLength="30" autocomplete="off" type="number">
                            <input hidden id="pa_id" name="pa_id">
                            <input hidden id="pa_item" name="pa_item">
                            <input hidden id="pa_id_programacion" name="pa_id_programacion">
                            <input hidden id="pa_numero_orden" name="pa_numero_orden">
                            <input hidden id="pa_orden" name="pa_orden">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button style=" background: #b39f64; color: #ecedf1;" type="button" class=" btn-info-claro "
                            data-bs-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button type="submit" onclick="updatelisto()" data-bs-dismiss="modal"
                            class="btn btn-success">
                            <span>Agregar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal Generar Remision -->

    <div class="modal fade" id="Remision" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="staticBackdropLabel"
                        style="width:450px; text-align:center; font-size:20px;">Generar Remision</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('programacionterminadoremision') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Seleccione la fecha</label>
                            <input type="date" name="fecha"class="form-control" id="recipient-name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button style=" background: #b39f64; color: #ecedf1;" type="button" class=" btn-info-claro "
                            data-bs-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button style=" background: #b39f64; color: #ecedf1;" type="submit">
                            <span>Generar</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- FIN MODAL  ACTUALIZAR SALDO -->



    <div class="modal fade" id="modal_ficha" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"
                        style="width:450px; text-align:center; font-size:20px;">Exportar Ficha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div  class="modal-body">
                    <div id="etiqueta" style="padding: 20px">
                        <div style="text-align:center;">
                            <FONT SIZE=7 for="" style="font-family: fantasy;" class="form-label">
                                FRAGILE
                            </FONT>
                            <br>
                            <div class="col-sm-3">
                                <h1 style="font-family: fantasy;" class=" fs-4">{!! DNS2D::getBarcodeSVG(strval($id_d), 'QRCODE', 3, 3) !!}</h1>
                            </div>
                            <h1><img class="form-label fs-4" style="width:200px; font-family: fantasy; text-align:center;"
                                    src="{{ asset('images/Rocky-Patel.png') }}" alt="Rocky">
                            </h1>
                        </div>


                        <div class="mb-2 row">
                            <h1 for="staticEmail" style="font-family: fantasy;" class="col-sm-3 fs-4">MARK: </h1>
                            <div class="offset-md-1 col-sm-8" style="text-align:center;">
                                <h1 contenteditable id="mark" style="font-family: fantasy;" class=" fs-4">
                                    DECADE BY RP</h1>
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <h1 for="staticEmail" style="font-family: fantasy;" class="col-sm-3 fs-4">SIZE: </h1>
                            <div class="offset-md-2 col-sm-6" style="text-align:center;">
                                <h1 id="size" contenteditable style="font-family: fantasy;" class=" fs-4">6-1/2
                                    X 52</h1>
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <h1 for="staticEmail" style="font-family: fantasy;" class="col-sm-3 fs-4">SHAPE: </h1>
                            <div class="offset-md-2 col-sm-6" style="text-align:center;">
                                <h1 id="shape" contenteditable style="font-family: fantasy;" class=" fs-4">TORO
                                    PRESS</h1>
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <h1 for="staticEmail" style="font-family: fantasy;" class="col-sm-3 fs-4">WRAPPER: </h1>
                            <div class="offset-md-2 col-sm-6" style="text-align:center;">
                                <h1 id="wrapper" contenteditable style="font-family: fantasy;" class=" fs-4">
                                    SUMATRA</h1>
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <h1 for="staticEmail" style="font-family: fantasy;" class="col-sm-3 fs-4">PACKING: </h1>
                            <div class="offset-md-2 col-sm-6" style="text-align:center;">
                                <h1 id="packing" style="font-family: fantasy;" class=" fs-4">BOX/20</label>
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <h1 for="staticEmail" style="font-family: fantasy;" class="col-sm-3 fs-4">QUANTITY: </h1>
                            <div class="offset-md-2 col-sm-6" style="text-align:center;">
                                <h1 contenteditable style="font-family: fantasy;" id="quantity" class=" fs-4">560
                                </h1>
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <h1 for="staticEmail" style="font-family: fantasy;" class="col-sm-3 fs-4">DATE: </h1>
                            <div class="offset-md-2 col-sm-6" style="text-align:center;">
                                <h1 id="date" contenteditable style="font-family: fantasy;" class=" fs-4">
                                    MES-00-0000</h1>
                            </div>
                        </div>


                        <div class="mb-2 row">
                            <h1 for="staticEmail" style="font-family: fantasy;" class="col-sm-3 fs-4">BOX #: </h1>
                            <div class="offset-md-2 col-sm-6" style="text-align:center;">
                                <h1 contenteditable id="box" style="font-family: fantasy;" class=" fs-4">00
                                </h1>
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <h1 for="staticEmail" style="font-family: fantasy;" class="col-sm-6 fs-4">ITEM NUMBER: </h1>
                            <div class="col-sm-4">
                                <h1 id="itemnumber" style="font-family: fantasy;" class=" fs-4">20005001</h1>
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <h1 for="staticEmail" style="font-family: fantasy;" class="col-sm-2 fs-4">BARCODE: </h1>
                        </div>

                        <div class="col-sm-3">
                            <h1 style="font-family: fantasy;" class=" fs-4">{!! DNS1D::getBarcodeSVG($item_b, 'C128A', 1, 50) !!}</h1>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button style=" background: #b39f64; color: #ecedf1;" type="button" class=" btn-info-claro "
                        data-bs-dismiss="modal">
                        <span>Cancelar</span>
                    </button>
                    <button onclick="generarFicha()" class=" btn-info float-right" style="margin-right: 10px">
                        <span>GENERAR FICHA</span>
                    </button>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script type="text/javascript">
            function mostrarMaterial(v) {
                @this.materiales = v;
            }

            function updatelisto() {
                @this.updatelistos(
                    document.getElementById("pa_id").value,
                    document.getElementById("pa_cantidad").value,
                    document.getElementById("pa_item").value,
                    document.getElementById("pa_id_programacion").value,
                    document.getElementById("pa_numero_orden").value,
                    document.getElementById("pa_orden").value
                );

                $('#pa_cantidad').val('');
            }

            function cargardatos(pa_id, pa_item, pa_id_programacion, pa_numero_orden, pa_orden) {
                $('#pa_id').val(pa_id);
                $('#pa_item').val(pa_item);
                $('#pa_id_programacion').val(pa_id_programacion);
                $('#pa_numero_orden').val(pa_numero_orden);
                $('#pa_orden').val(pa_orden);
            }

            function generarQR() {
                let cant = $('.xokers').toArray().length;

                for (let i = 1; i <= cant; i++) {
                    let elemento = "#xokers" + i;
                    $(elemento)[0].click();

                }
            }

            function generarFicha() {
                let nameconcat = $('#mark').text() + ' ' +
                    $('#size').text() + '.png';
                html2canvas(document.querySelector("#etiqueta"), {}).then(canvas => {
                    simulateDownloadImageClick(canvas.toDataURL('image/png', 1.0), nameconcat);
                });
            }

            function simulateDownloadImageClick(uri, filename) {
                var link = document.createElement('a');
                if (typeof link.download !== 'string') {
                    window.open(uri);
                } else {
                    link.href = uri;
                    link.download = filename;
                    accountForFirefox(clickLink, link);
                }
            }

            function clickLink(link) {
                link.click();
            }

            function accountForFirefox(click) { // wrapper function
                let link = arguments[1];
                document.body.appendChild(link);
                click(link);
                document.body.removeChild(link);
            }


            function limpiartable() {
                $('#tablechange').empty();
            }

            window.addEventListener('xxx', event => {
                $('#mark').text(event.detail.marca);
                $('#size').text(event.detail.size);
                $('#shape').text(event.detail.shape);
                $('#wrapper').text(event.detail.wrapper);
                $('#packing').text(event.detail.packing);
                $('#quantity').text(event.detail.quantity);
                $('#itemnumber').text(event.detail.item);
                $('#modal_ficha').modal('show');
            });

            function exportarMaterial() {
                @this.imprimir_materiales();
            }

            window.addEventListener('tamanio_tabla', event => {
                $('#tabla_materiales').css('height', ($('#bos').height() - 180));
                $('#tabla_materiales2').css('height', ($('#bos').height() - 180));
            });





            $(document).ready(function() {

                $('#tabla_materiales').css('height', ($('#bos').height() - 180));
                $('#tabla_materiales2').css('height', ($('#bos').height() - 180));

            });

            function datos_modal_eliminar(id,
                id_pendiente,
                saldo,
                cant_cajas_necesarias,
                cant_cajas) {

                $('#ide').val(id);
                $('#saldoe').val(saldo);
                $('#id_pendientee').val(id_pendiente);
                $('#cant_cajase').val(cant_cajas);
                $('#saldo_viejo').val(saldo);

            }

            function datos_modal_actualizar(id,
                id_pendiente,
                saldo,
                cant_cajas_necesarias,
                cant_cajas
            ) {

                $('#id_detalle').val(id);
                $('#id_pendiente').val(id_pendiente);
                $('#saldo').val(saldo);
                $('#saldo_pen').val(saldo);
                $('#cajas_viejas').val(cant_cajas_necesarias);
                $('#cant_cajas').val(cant_cajas);

            }


            function datos_modal_eliminar_pro(id) {
                $('#id_pro').val(id);
            }

            function datos_modal_actualizar_programacion(id, mes_contenedor) {
                $('#id_p').val(id);
                $('#saldo_p').val(mes_contenedor);
            }
        </script>
    @endpush

</div>
