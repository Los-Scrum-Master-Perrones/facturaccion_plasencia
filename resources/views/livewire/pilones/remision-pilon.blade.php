<div>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div wire:ignore class="card-header" style="display: flex; margin-top: 2px">
                        <a href='#' asp-action="Crear" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalcrearRemisionP">Nuevo</a>
                        &nbsp;&nbsp;
                        <div style="width: 20%">
                            <select aria-label="Default select example" name="buscarMes" id="buscarMes"
                                onchange="buscar_cp()">
                                <option value="">Busque por mes</option>
                                <option value="01">Enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>&nbsp;&nbsp;

                        <div style="width: 20%">
                            <select aria-label="Default select example" name="buscarAño" id="buscarAño"
                                onchange="buscar_cp()">
                                <option value="">Busque por año</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                        </div>&nbsp;&nbsp;
                        <a href='#' class="btn btn-success btn-sm" wire:click = "imprimir_Remision()">Imprimir
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-printer" viewBox="0 0 16 16">
                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                                <path
                                    d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1" />
                            </svg></a>
                    </div>
                    <div class="table-responsive" style="height: 72vh;">

                        <table id="example" class="table table-striped table-hover">
                            <thead class="table table-hover table-sm" wire:ignore>
                                <tr>
                                    <th scope="col" style="text-align: center !important;">ID</th>
                                    <th scope="col" style="text-align: center !important;">
                                        <select name="buscarCod" id="buscarCod" onchange="buscar_cp()">
                                            <option value="">Código</option>

                                        </select>
                                    </th>
                                    <th scope="col" style="text-align: center !important;">
                                        <select name="buscarFecha" id="buscarFecha" onchange="buscar_cp()">
                                            <option value="">Fecha</option>

                                        </select>
                                    </th>
                                    <th scope="col" style="text-align: center !important;">
                                        <select name="buscarDest" id="buscarDest" onchange="buscar_cp()">
                                            <option value="">Destino</option>

                                        </select>
                                    </th>
                                    <th scope="col" style="text-align: center !important;">
                                        <select name="buscarOrig" id="buscarOrig" onchange="buscar_cp()">
                                            <option value="">Origen</option>

                                        </select>
                                    </th>
                                    <th scope="col" style="text-align: center !important;">Descripción</th>
                                    <th scope="col" style="text-align: center !important;">Total (Lbs.)</th>
                                    <th scope="col" style="text-align: center !important;">Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($remisionP as $key=> $remP)
                                    <tr>
                                        <td scope="row" style="text-align: center;">{{ ++$key }}</td>
                                        <td style="text-align: center;"> {{ $remP->id_remision }}</td>
                                        <td scope="row" style="text-align: center;">{{ $remP->fecha_remision }}</td>
                                        <td scope="row" style="text-align: center;">{{ $remP->destino_remision }}
                                        </td>
                                        <td style="text-align: center;">{{ $remP->origen_remision }}</td>
                                        <td scope="row" style="text-align: center;">
                                            {{ $remP->descripcion1_remision }}<br>
                                            {{ $remP->descripcion2_remision }}<br>
                                            {{ $remP->descripcion3_remision }}<br>
                                            {{ $remP->descripcion4_remision }}<br>
                                            {{ $remP->descripcion5_remision }}
                                        </td>
                                        <td style="text-align: center;">{{ $remP->cant_lbs_des_1 }}<br>
                                            {{ $remP->cant_lbs_des_2 }}<br>
                                            {{ $remP->cant_lbs_des_3 }}<br>
                                            {{ $remP->cant_lbs_des_4 }}<br>
                                            {{ $remP->cant_lbs_des_5 }}
                                        </td>
                                        <td style="text-align: center;"><a href='#'
                                                onclick="eliminarremision({{ $remP->id_remision_proceso }})"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                    <path
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                </svg></a><a href= '#' data-bs-target="#modalEditarRemisionP"
                                                data-bs-toggle="modal"
                                                onclick="cargarEditarRP(`{{ json_encode($remP) }}`)"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-square"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                </svg></a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- MODAL PARA CREAR Remision pilon-->
        <div wire:ignore class="modal fade" id="modalcrearRemisionP" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="titulo1">
                            Crear Remisión
                        </h3>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" id="formulario_Entrapilon">
                            @csrf
                            <input id="id_r" name="id_r" hidden value="">

                            <div style="display: flex; margin-top: 2px">
                                <div style="width: 100%">

                                    <label style="width: 100%">Código</label>
                                    <input id="codigo" type="text" name="codigo" class="form-control">

                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 100%">
                                    <label>Fecha</label>
                                    <input id="fecha" type="date" name="fecha" class="form-control">
                                </div>
                            </div>

                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">

                                    <label>Destino</label>
                                    <input id="destino" type="text" name="destino" class="form-control">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 100%">
                                    <label>Origen</label>
                                    <input id="origen" type="text" name="origen" class="form-control">

                                </div>
                            </div>

                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">

                                    <label>Descripción</label>
                                    <input id="descripcion1" type="text" name="descripcion1"
                                        class="form-control">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 20%">
                                    <label>Cantidad</label>
                                    <input id="cantidadLbs1" type="text" name="cantidadLbs1"
                                        class="form-control">
                                </div>
                            </div>

                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">
                                    <input id="descripcion2" type="text" name="descripcion2"
                                        class="form-control">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 20%">
                                    <input id="cantidadLbs2" type="text" name="cantidadLbs2"
                                        class="form-control">
                                </div>
                            </div>
                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">
                                    <input id="descripcion3" type="text" name="descripcion3"
                                        class="form-control">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 20%">
                                    <input id="cantidadLbs3" type="text" name="cantidadLbs3"
                                        class="form-control">
                                </div>
                            </div>
                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">
                                    <input id="descripcion4" type="text" name="descripcion4"
                                        class="form-control">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 20%">
                                    <input id="cantidadLbs4" type="text" name="cantidadLbs4"
                                        class="form-control">
                                </div>
                            </div>
                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">
                                    <input id="descripcion5" type="text" name="descripcion5"
                                        class="form-control">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 20%">
                                    <input id="cantidadLbs5" type="text" name="cantidadLbs5"
                                        class="form-control">
                                </div>
                            </div>
                        </form>

                        <div class="modal-footer" style="text-align: center">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                                onclick="registrar_RemisionP()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL PARA Editar Remision pilon-->
        <div wire:ignore class="modal fade" id="modalEditarRemisionP" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="titulo1">
                            Editar Remisión
                        </h3>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" id="formulario_Entrapilon">
                            @csrf
                            <input id="id_r" name="id_r" hidden value="">

                            <div style="display: flex; margin-top: 2px">
                                <div style="width: 100%">

                                    <label style="width: 100%">Código</label>
                                    <input id="codigoEdit" type="text" name="codigoEdit" class="form-control">

                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 100%">
                                    <label>Fecha</label>
                                    <input id="fechaEdit" type="date" name="fechaEdit" class="form-control">
                                </div>
                            </div>

                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">
                                    <label>Destino</label>
                                    <input id="destinoEdit" type="text" name="destinoEdit" class="form-control">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 100%">
                                    <label>Origen</label>
                                    <input id="origenEdit" type="text" name="origenEdit" class="form-control">

                                </div>
                            </div>

                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">
                                    <label>Descripción</label>
                                    <input id="descripcion1Edit" type="text" name="descripcion1Edit"
                                        class="form-control">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 20%">
                                    <label>Cantidad</label>
                                    <input id="cantidadLbs1Edit" type="text"
                                        name="cantidadLbs1Edit"class="form-control">
                                </div>
                            </div>

                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">
                                    <input id="descripcion2Edit" type="text" name="descripcion2Edit"
                                        class="form-control">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 20%">
                                    <input id="cantidadLbs2Edit" type="text" name="cantidadLbs2Edit"
                                        class="form-control">
                                </div>
                            </div>
                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">
                                    <input id="descripcion3Edit" type="text" name="descripcion3Edit"
                                        class="form-control">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 20%">
                                    <input id="cantidadLbs3Edit" type="text" name="cantidadLbs3Edit"
                                        class="form-control">
                                </div>
                            </div>
                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">
                                    <input id="descripcion4Edit" type="text" name="descripcion4Edit"
                                        class="form-control">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 20%">
                                    <input id="cantidadLbs4Edit" type="text" name="cantidadLbs4Edit"
                                        class="form-control">
                                </div>
                            </div>
                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">
                                    <input id="descripcion5Edit" type="text" name="descripcion5Edit"
                                        class="form-control">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 20%">
                                    <input id="cantidadLbs5Edit" type="text" name="cantidadLbs5Edit"
                                        class="form-control">
                                </div>
                            </div>
                        </form>

                        <div class="modal-footer" style="text-align: center">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                                onclick="editar_RemisionP()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @push('scripts')
        <script>
            function eliminarremision(id_remision_proceso) {
                swal.fire({
                        title: '¿Esta seguro que quiere eliminar?',
                        icon: 'question',
                        confirmButtonColor: '#3085d6',
                        showCancelButton: true,
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si',
                        cancelButtonText: 'No'
                    },
                    function() {
                        // excluir el json del array, diciendole que el id sea diferente

                    }).then((result) => {
                    if (result.isConfirmed) {

                        @this.eliminarRemisionP(id_remision_proceso);
                    }
                })
                event.preventDefault()
            }

            function registrar_RemisionP() {
                @this.registrar_RemisionP({
                    'id_remision': document.getElementById('codigo').value,
                    'fecha_remision': document.getElementById('fecha').value,
                    'destino_remision': document.getElementById('destino').value,
                    'origen_remision': document.getElementById('origen').value,
                    'descripcion1_remision': document.getElementById('descripcion1').value,
                    'cant_lbs_des_1': document.getElementById('cantidadLbs1').value,
                    'descripcion2_remision': document.getElementById('descripcion2').value,
                    'cant_lbs_des_2': document.getElementById('cantidadLbs2').value,
                    'descripcion3_remision': document.getElementById('descripcion3').value,
                    'cant_lbs_des_3': document.getElementById('cantidadLbs3').value,
                    'descripcion4_remision': document.getElementById('descripcion4').value,
                    'cant_lbs_des_4': document.getElementById('cantidadLbs4').value,
                    'descripcion5_remision': document.getElementById('descripcion5').value,
                    'cant_lbs_des_5': document.getElementById('cantidadLbs5').value,
                });
                document.getElementById('codigo').value = '';
                document.getElementById('fecha').value = '';
                document.getElementById('destino').value = '';
                document.getElementById('origen').value = '';
                document.getElementById('descripcion1').value = '';
                document.getElementById('cantidadLbs1').value = '';
                document.getElementById('descripcion2').value = '';
                document.getElementById('cantidadLbs2').value = '';
                document.getElementById('descripcion3').value = '';
                document.getElementById('cantidadLbs3').value = '';
                document.getElementById('descripcion4').value = '';
                document.getElementById('cantidadLbs4').value = '';
                document.getElementById('descripcion5').value = '';
                document.getElementById('cantidadLbs5').value = '';
            }

            var id_remision_p = 0;

            function cargarEditarRP(params) {
                var cargar = JSON.parse(params);
                id_remision_p = cargar.id_remision_proceso;
                document.getElementById('codigoEdit').value = cargar.id_remision;
                document.getElementById('fechaEdit').value = cargar.fecha_remision;
                document.getElementById('destinoEdit').value = cargar.destino_remision;
                document.getElementById('origenEdit').value = cargar.origen_remision;
                document.getElementById('descripcion1Edit').value = cargar.descripcion1_remision;
                document.getElementById('cantidadLbs1Edit').value = cargar.cant_lbs_des_1;
                document.getElementById('descripcion2Edit').value = cargar.descripcion2_remision;
                document.getElementById('cantidadLbs2Edit').value = cargar.cant_lbs_des_2;
                document.getElementById('descripcion3Edit').value = cargar.descripcion3_remision;
                document.getElementById('cantidadLbs3Edit').value = cargar.cant_lbs_des_3;
                document.getElementById('descripcion4Edit').value = cargar.descripcion4_remision;
                document.getElementById('cantidadLbs4Edit').value = cargar.cant_lbs_des_4;
                document.getElementById('descripcion5Edit').value = cargar.descripcion5_remision;
                document.getElementById('cantidadLbs5Edit').value = cargar.cant_lbs_des_5;

            }

            function editar_RemisionP() {
                @this.editar_RemisionP(id_remision_p, {
                    'id_remision': document.getElementById('codigoEdit').value,
                    'fecha_remision': document.getElementById('fechaEdit').value,
                    'destino_remision': document.getElementById('destinoEdit').value,
                    'origen_remision': document.getElementById('origenEdit').value,
                    'descripcion1_remision': document.getElementById('descripcion1Edit').value,
                    'cant_lbs_des_1': document.getElementById('cantidadLbs1Edit').value,
                    'descripcion2_remision': document.getElementById('descripcion2Edit').value,
                    'cant_lbs_des_2': document.getElementById('cantidadLbs2Edit').value,
                    'descripcion3_remision': document.getElementById('descripcion3Edit').value,
                    'cant_lbs_des_3': document.getElementById('cantidadLbs3Edit').value,
                    'descripcion4_remision': document.getElementById('descripcion4Edit').value,
                    'cant_lbs_des_4': document.getElementById('cantidadLbs4Edit').value,
                    'descripcion5_remision': document.getElementById('descripcion5Edit').value,
                    'cant_lbs_des_5': document.getElementById('cantidadLbs5Edit').value,
                });
            }

            function buscar_cp() {
                @this.id_remision = $('#buscarCod').val();
                @this.fecha_remision = $('#buscarFecha').val();
                @this.destino_remision = $('#buscarDest').val();
                @this.origen_remision = $('#buscarOrig').val();

                @this.mes = $('#buscarMes').val();
                @this.anio = $('#buscarAño').val();
            }

            $(document).ready(function() {
                var seletscc = ["buscarCod", "buscarFecha", "buscarDest", "buscarOrig", "buscarAño", "buscarMes"];
                seletscc.forEach(element => {
                    selects(element);
                });

            });

            function selects(variable) {
                new TomSelect("#" + variable, {
                    create: true,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
            }
        </script>
    @endpush
</div>
