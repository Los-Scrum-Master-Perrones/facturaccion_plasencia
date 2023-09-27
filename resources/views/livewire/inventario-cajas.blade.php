<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="green" viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="check-fill-imcomple" fill="orange" viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="info-fill" fill="blue" viewBox="0 0 16 16">
            <path
                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="red" viewBox="0 0 16 16">
            <path
                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>

    <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item">
            <a class="nav-link" style="color:white;  font-size:12px;" href="pendiente_empaque"><strong>Pendiente</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:white; font-size:12px;" href="{{ route('materiales.index') }}"><strong>Materiales</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:white; font-size:12px;" href="{{ route('materiales.relacionar') }}"><strong>Materiales
                    materials</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:white;  font-size:12px;" href="importar_c"><strong>Existencia en bodega</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:#E5B1E2; font-size:12px;" href="{{ route('inventario_cajas') }}"><strong>Existencia de cajas</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:white; font-size:12px; " href="historial_programacion"><strong>Programaciones</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:white;  font-size:12px;"
                href="{{ route('entradas.salidas') }}"><strong>Entrada/Salida</strong></a>
        </li>
    </ul>

    <div class="container" style="max-width:100%;">

        <div class="card" style="padding:0px;">
            <div class="card-header">
                <div class="row" wire:ignore>
                    <div class="col-3"></div>
                    <div class="col-3"></div>
                    <div class="col-3"></div>
                    <div class="col-3">
                        <div class="input-group mb-3">
                            <select class="form-control" name="b_opciones" id="b_opciones" onchange="buscar_tabla()">
                                <option value="0">Seleccione</option>
                                <option value="1">Faltantes</option>
                                <option value="2">Con Saldo</option>
                                <option value="3">Sin Saldo</option>
                            </select>
                            @if (false)
                            <button class="btn btn-success" wire:click='imprimir_reporte'>
                                <abbr title="Exportar Excel">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-spreadsheet" viewBox="0 0 16 16">
                                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v4h10V2a1 1 0 0 0-1-1H4zm9 6h-3v2h3V7zm0 3h-3v2h3v-2zm0 3h-3v2h2a1 1 0 0 0 1-1v-1zm-4 2v-2H6v2h3zm-4 0v-2H3v1a1 1 0 0 0 1 1h1zm-2-3h2v-2H3v2zm0-3h2V7H3v2zm3-2v2h3V7H6zm3 3H6v2h3v-2z"/>
                                    </svg>
                                </abbr>
                            </button>
                            @endif
                            <a href="index_importar_cajas" class="btn btn-primary">
                                <abbr title="Importar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-airplane-engines" viewBox="0 0 16 16">
                                        <path d="M8 0c-.787 0-1.292.592-1.572 1.151A4.347 4.347 0 0 0 6 3v3.691l-2 1V7.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.191l-1.17.585A1.5 1.5 0 0 0 0 10.618V12a.5.5 0 0 0 .582.493l1.631-.272.313.937a.5.5 0 0 0 .948 0l.405-1.214 2.21-.369.375 2.253-1.318 1.318A.5.5 0 0 0 5.5 16h5a.5.5 0 0 0 .354-.854l-1.318-1.318.375-2.253 2.21.369.405 1.214a.5.5 0 0 0 .948 0l.313-.937 1.63.272A.5.5 0 0 0 16 12v-1.382a1.5 1.5 0 0 0-.83-1.342L14 8.691V7.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v.191l-2-1V3c0-.568-.14-1.271-.428-1.849C9.292.591 8.787 0 8 0ZM7 3c0-.432.11-.979.322-1.401C7.542 1.159 7.787 1 8 1c.213 0 .458.158.678.599C8.889 2.02 9 2.569 9 3v4a.5.5 0 0 0 .276.447l5.448 2.724a.5.5 0 0 1 .276.447v.792l-5.418-.903a.5.5 0 0 0-.575.41l-.5 3a.5.5 0 0 0 .14.437l.646.646H6.707l.647-.646a.5.5 0 0 0 .14-.436l-.5-3a.5.5 0 0 0-.576-.411L1 11.41v-.792a.5.5 0 0 1 .276-.447l5.448-2.724A.5.5 0 0 0 7 7V3Z"/>
                                    </svg>
                                </abbr>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div wire:loading.class='oscurecer_contenido'
                class="table-responsive" style="height: 70vh;">
                <table class="table table-light" style="font-size:10px; ">
                    <thead>
                        <tr style="font-size:16px; text-align:center;">
                            <th style=" text-align:center;">N#</th>
                            <th style=" text-align:center;">Opera.</th>
                            <th style=" text-align:center;">Movimi.</th>
                            <th wire:ignore style=" text-align:center;">
                                <select name="todas_codigos" id="todas_codigos" onchange="buscar_tabla()">
                                    <option value="">Código</option>
                                    @foreach ($codigo_p as $v)
                                        <option value="{{$v}}">{{$v}}</option>
                                    @endforeach
                                </select>
                            </th>
                            <th wire:ignore style=" text-align:center;">
                                <select name="todas_marca" id="todas_marca" onchange="buscar_tabla()">
                                    <option value="">Marca</option>
                                    @foreach ($marcas_p as $v)
                                        <option value="{{$v}}">{{$v}}</option>
                                    @endforeach
                                </select>
                            </th>
                            <th wire:ignore>
                                <select name="todas_porductos" id="todas_porductos" onchange="buscar_tabla()">
                                    <option value="">Producto</option>
                                    @foreach ($producto_p as $v)
                                        <option value="{{$v}}">{{$v}}</option>
                                    @endforeach
                                </select>
                            </th>
                            <th style="text-align:center;">Mal Estado</th>
                            <th style="text-align:center;">Faltante</th>
                            <th style="text-align:center;">Saldo</th>
                            <th style="text-align:center;">Saldo Neto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        $saldo = 0;
                        $saldoNeto = 0;
                        $saldoFaltante = 0;
                        $saldoMalos = 0;
                        @endphp

                        @foreach($listacajas as $material)
                        <tr>
                            <td style=" text-align:center;">{{ $count }}</td>
                            <td>
                                <a data-toggle="modal" data-target="#material_actualizar" style="width:10px; height:10px;"
                                    href="#" onclick="editar_material({{$material->id}},
                                                                            '{{$material->codigo}}',
                                                                            '{{$material->marca}}',
                                                                            '{{$material->productoServicio}}',
                                                                            '{{$material->mal_estado}}',
                                                                            '{{$material->faltantes}}',
                                                                            '{{$material->existencia}}'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </a>
                                <a onclick="eliminar_material({{$material->id}})" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        clcass="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </a>
                            </td>
                            <td style=" text-align:center;">
                                <a onclick="traslardr({{$material->id}},1,'{{ $material->codigo }}')" href="#">
                                    <abbr title="Trasladar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z" />
                                        </svg>
                                    </abbr>
                                </a>
                                <a onclick="traslardr({{$material->id}},2,'{{ $material->codigo }}')" href="#">
                                    <abbr title="Entrada">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-basket-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717L5.07 1.243zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3z" />
                                        </svg>
                                    </abbr>
                                </a>
                                <a onclick="traslardr({{$material->id}},3,'{{ $material->codigo }}')" href="#">
                                    <abbr title="Salida">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-folder-symlink" viewBox="0 0 16 16">
                                            <path
                                                d="m11.798 8.271-3.182 1.97c-.27.166-.616-.036-.616-.372V9.1s-2.571-.3-4 2.4c.571-4.8 3.143-4.8 4-4.8v-.769c0-.336.346-.538.616-.371l3.182 1.969c.27.166.27.576 0 .742z" />
                                            <path
                                                d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm.694 2.09A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09l-.636 7a1 1 0 0 1-.996.91H2.826a1 1 0 0 1-.995-.91l-.637-7zM6.172 2a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z" />
                                        </svg>
                                    </abbr>
                                </a>
                            </td>

                            <td style=" text-align:center;">{{ $material->codigo }}</td>
                            <td style=" text-align:center;">{{ $material->marca }}</td>
                            <td>{{ $material->productoServicio }}

                                @if ($material->existencia > 0 && $material->existencia != 0)
                                <abbr title="Listo para Enviar">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                        aria-label="Success:">
                                        <use xlink:href="#check-circle-fill" />
                                    </svg>
                                </abbr>
                                @endif

                                @if ($material->faltantes>0)
                                <abbr title="Hay Material Pendiente">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                        aria-label="Success:">
                                        <use xlink:href="#info-fill" />
                                    </svg>
                                </abbr>
                                @endif

                                @if ($material->existencia == 0)
                                <abbr title="No hay en Existencia">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                        aria-label="Success:">
                                        <use xlink:href="#exclamation-triangle-fill" />
                                    </svg>
                                </abbr>
                                @endif


                            </td>
                            @php
                                if ($material->existencia < 0) {
                                    DB::update('UPDATE lista_cajas
                                                SET existencia = 0,
                                                    faltantes = faltantes + ?
                                                WHERE id = ?', [($material->existencia*(-1)),$material->id]);
                                    $material->existencia = 0;
                                    $material->faltantes = ($material->existencia*(-1));
                                }
                            @endphp


                                <td style=" text-align:center;">{{ number_format($material->mal_estado) }}</td>
                                <td style=" text-align:center;">{{ number_format($material->faltantes) }}</td>
                                <td style=" text-align:center;">{{ number_format($material->existencia,0) }}</td>
                                <td style=" text-align:center;">{{ number_format($material->mal_estado+
                                    $material->faltantes+
                                    $material->existencia,0) }}</td>
                        </tr>
                        <?php
                        $count++;
                        $saldo += $material->existencia;
                        $saldoNeto += $material->mal_estado+$material->faltantes+$material->existencia;
                        $saldoFaltante += $material->faltantes;
                        $saldoMalos += $material->mal_estado;
                    ?>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    <div class="input-group" style="width:40%;position: fixed;right: 0px;bottom:0px; height:30px;">
        <span class="form-control input-group-text">Total Malos</span>
        <input type="text" class="form-control" value="{{ number_format($saldoMalos,0)  }}">

        <span class="form-control input-group-text">Total Faltante</span>
        <input type="text" class="form-control" value="{{ number_format($saldoFaltante,0)  }}">

        <span class="form-control input-group-text">Total</span>
        <input type="text" class="form-control" value="{{ number_format($saldo,0)  }}">

        <span class="form-control input-group-text">Total neto</span>
        <input type="text" class="form-control" id="sumase" value="{{ number_format($saldoNeto,0) }}">
    </div>


    @push('scripts')
    <script>

        $(document).ready(function () {

            var seletscc = ["todas_codigos", "todas_marca",'todas_porductos '];
            seletscc.forEach(element => {
                selects(element);
            });
        });

        function selects(nombre) {
            new TomSelect("#" + nombre, {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });

        }

        function buscar_tabla() {
            @this.marcas = $('#todas_marca').val();
            @this.codigo = $('#todas_codigos').val();
            @this.producto = $('#todas_porductos').val();
            @this.filtro = $('#b_opciones').val();
        }


        async function traslardr(id, operacion, codigo_material) {

            var titulo = 'Traspasar Material';
            var html = '';

            if (operacion == 1) {
                titulo = 'Traspasar Cajas';
                html = '<input id="swal-input1" type="number" style="width: 80%" class="swal2-input form-control">' +
                    '<input type="date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" id="swal-input2" style="width: 80%" class="swal2-input form-control">' +
                    '<select id="swal-input3"  style="width: 80%" class="swal2-input form-control">' +
                    '<option value="Mal Estado">Mal Estado</option>' +
                    '<option value="Faltante">Faltante</option>' +
                    '</select>';
                    const {
                        value: formValues
                    } = await Swal.fire({
                        title: titulo,
                        html: html,
                        focusConfirm: true,
                        preConfirm: () => {
                            return [
                                id,
                                codigo_material,
                                document.getElementById('swal-input1').value,
                                document.getElementById('swal-input2').value,
                                document.getElementById('swal-input3').value,
                            ]
                        }
                    });

                    if (formValues) {


                    @this.materiales_traspaso({
                        'pa_id': formValues[0],
                        'pa_codigo': formValues[1],
                        'pa_fecha': formValues[3],
                        'pa_cantidad': formValues[2],
                        'pa_tipo': formValues[4],
                        'pa_descripcion': formValues[4]
                    });

            }
            }
            if (operacion == 2) {
                titulo = 'Entrada Cajas';
                html = '<input id="swal-input1" type="number"  style="width: 80%" class="swal2-input form-control">' +
                    '<input type="date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" id="swal-input2" style="width: 80%" class="swal2-input form-control">' +
                    '<input id="swal-input4" placeholder="Descripcion" style="width: 80%" class="swal2-input form-control">' +
                    '<select id="swal-input3"  style="width: 80%" class="swal2-input form-control">' +
                    '<option value="Entrada Normal Cajas">Entrada Normal</option>' +
                    '<option value="Mal Estado Cajas">Renovar Cajas Dañado</option>' +
                    '</select>';
                    const {
                        value: formValues
                    } = await Swal.fire({
                        title: titulo,
                        html: html,
                        focusConfirm: true,
                        preConfirm: () => {
                            return [
                                id,
                                codigo_material,
                                document.getElementById('swal-input1').value,
                                document.getElementById('swal-input2').value,
                                document.getElementById('swal-input3').value,
                                document.getElementById('swal-input4').value,
                            ]
                        }
                    });
                    if (formValues) {

                        @this.materiales_entrada({
                            'pa_id': formValues[0],
                            'pa_codigo': formValues[1],
                            'pa_fecha': formValues[3],
                            'pa_cantidad': (-1) * parseInt(formValues[2]),
                            'pa_tipo': formValues[4],
                            'pa_descripcion': formValues[5]
                        });


                    }
            }
            if (operacion == 3) {
                titulo = 'Salida Cajas';
                html = '<input id="swal-input1" type="number" style="width: 80%" class="swal2-input form-control">' +
                    '<input id="swal-input2" placeholder="Descripcion" style="width: 80%" class="swal2-input form-control">' +
                    '<input type="date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" id="swal-input3" style="width: 80%" class="swal2-input form-control">'+
                    '<select id="swal-input4"  style="width: 80%" class="swal2-input form-control">' +
                        '<option value="Entrada Normal Cajas">Salida Cajas</option>' +
                        '<option value="Mal Estado Cajas">Mal Estado</option>' +
                        '<option value="Faltante Cajas">Faltante</option>' +
                    '</select>';
                    const {
                        value: formValues
                    } = await Swal.fire({
                        title: titulo,
                        html: html,
                        focusConfirm: true,
                        preConfirm: () => {
                            return [
                                id,
                                codigo_material,
                                document.getElementById('swal-input1').value,
                                document.getElementById('swal-input2').value,
                                document.getElementById('swal-input3').value,
                                document.getElementById('swal-input4').value
                            ]
                        }
                    });


                if (formValues) {

                    @this.materiales_salida({
                        'pa_id': formValues[0],
                        'pa_codigo': formValues[1],
                        'pa_fecha': formValues[4],
                        'pa_cantidad': formValues[2],
                        'pa_tipo': formValues[5],
                        'pa_descripcion': formValues[3]
                    });

                }
            }
        }

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
        })

        window.addEventListener('entrdas_errornea', event => {
            Toast.fire({
                icon: 'error',
                title: 'Hay campos erroneos.\n' + event.detail.mensaje
            })
        });
    </script>
    @endpush

</div>
