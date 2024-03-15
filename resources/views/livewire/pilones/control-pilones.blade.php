<div>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href='#' asp-action="Crear" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalcrearControlP">Nuevo</a>
                    </div>
                    <div class="table-responsive" style="height: 72vh;">
                        <table id="example" class="table table-striped table-hover">
                            <thead class="table table-hover table-sm" wire:ignore>
                                <tr>
                                    <th scope="col" style="text-align: center;">ID</th>
                                    <th scope="col" style="text-align: center;">

                                        <select name="buscarnomtab" id="buscarnomtab" onchange="buscar_cp()">
                                            <option value="">Nombre de tabaco</option>

                                        </select>
                                    </th>
                                    <th scope="col" style="text-align: center;">
                                        <select name="buscarFecha" id="buscarFecha" onchange="buscar_cp()">
                                            <option value="">Fecha</option>

                                        </select>
                                    </th>
                                    <th scope="col" style="text-align: center;">
                                        <select name="buscarnPilon" id="buscarnPilon" onchange="buscar_cp()">
                                            <option value="">Número de Pilón</option>

                                        </select>
                                    </th>
                                    <th scope="col" style="text-align: center;">Entrada de tabaco</th>
                                    <th scope="col" style="text-align: center;">Salida de tabaco</th>
                                    <th scope="col" style="text-align: center;">Total actual</th>
                                    <th scope="col" style="text-align: center;">Existencia total</th>
                                    <th scope="col" style="text-align: center;">Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($controlP as $key=> $contP)
                                    <tr>
                                        <td scope="row" style="text-align: center;">{{ ++$key }}</td>
                                        <td style="text-align: center;"> {{ $contP->nombre_tabaco }}</td>
                                        <td scope="row" style="text-align: center;">{{ $contP->fecha_entrada_pilon }}
                                        </td>
                                        <td scope="row" style="text-align: center;">{{ $contP->numero_pilon }}</td>
                                        <td style="text-align: center;">{{ $contP->entrada_tabaco_pilon }}</td>
                                        <td scope="row" style="text-align: center;">{{ $contP->salida_tabaco_pilon }}
                                        </td>
                                        <td style="text-align: center;">{{ $contP->total_actual }}</td>
                                        <td scope="row" style="text-align: center;">{{ $contP->Total }}</td>
                                        <td style="text-align: center;"><a href='#'
                                                onclick="eliminarcontrol({{ $contP->id_control_pilones }})"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                    <path
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                </svg></a><a href= '#' data-bs-target="#modaleditarControlP"
                                                data-bs-toggle="modal"
                                                onclick="cargarEditarCP(`{{ json_encode($contP) }}`)"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                </svg></a></td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <!-- MODAL PARA CREAR control pilon-->
        <div wire:ignore class="modal fade" id="modalcrearControlP" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="titulo1">
                            Crear control de pilón
                        </h3>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" id="formulario_Entrapilon">
                            @csrf
                            <input id="id_r" name="id_r" hidden value="">

                            <div style="display: flex; margin-top: 2px">
                                <div style="width: 100%">

                                    <label style="width: 100%">Nombre del tabaco</label>
                                    <select aria-label="Default select example" id="nombre_taba" name="nombre_taba">
                                        <option value="">Seleccione el nombre</option>
                                        @foreach ($tabla_entraP as $tabenp)
                                            <option value="{{ $tabenp->id_entrada_pilones }}">
                                                {{ $tabenp->nombre_tabaco . ' Pilón: ' . $tabenp->numero_pilon . ' Fecha entrada: ' . $tabenp->fecha_entrada_pilon }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">
                                    <label>Entrada de tabaco</label>
                                    <input id="entrada_taba" type="text" name="entrada_taba"
                                        class="form-control">
                                </div>

                                &nbsp;&nbsp;
                                <div style="width: 100%">
                                    <label>Salida de tabaco</label>
                                    <input id="salida_tab" type="text" name="salida_tab" class="form-control">
                                </div>
                            </div>

                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">

                                    <label>Total actual</label>
                                    <input id="total_act" type="text" name="total_act" class="form-control">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 100%">
                                    <label>Existencia Total</label>
                                    <input id="exis_total" type="text" name="exis_total" class="form-control">
                                </div>
                            </div>
                        </form>

                        <div class="modal-footer" style="text-align: center">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                                onclick="registrar_ControlP()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL PARA EDITAR control pilon-->
        <div wire:ignore class="modal fade" id="modaleditarControlP" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="titulo1">
                            Editar control de pilón
                        </h3>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" id="formulario_contrpilon">
                            @csrf
                            <input id="id_r" name="id_r" hidden value="">

                            <div style="display: flex; margin-top: 2px">
                                <div style="width: 100%">
                                    <label style="width: 100%">Nombre del tabaco</label>
                                    <select disabled aria-label="Default select example" id="nombre_taba_edit"
                                        name="nombre_taba_edit">
                                        <option value="">Seleccione el nombre</option>
                                        @foreach ($tabla_entraP as $tabenp)
                                            <option value="{{ $tabenp->id_entrada_pilones }}">
                                                {{ $tabenp->nombre_tabaco . ' Pilón: ' . $tabenp->numero_pilon . ' Fecha entrada: ' . $tabenp->fecha_entrada_pilon }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">
                                    <label>Entrada de tabaco</label>
                                    <input id="entrada_taba_edit" type="text"
                                        name="entrada_taba_edit"class="form-control">
                                </div>

                                &nbsp;&nbsp;
                                <div style="width: 100%">
                                    <label>Salida de tabaco</label>
                                    <input id="salida_tab_edit" type="text" name="salida_tab_edit"
                                        class="form-control">
                                </div>
                            </div>

                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">

                                    <label>Total actual</label>
                                    <input id="total_act_edit" type="text" name="total_act_edit"
                                        class="form-control">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 100%">
                                    <label>Existencia Total</label>
                                    <input id="exis_total_edit" type="text" name="exis_total_edit"
                                        class="form-control">
                                </div>
                            </div>
                        </form>

                        <div class="modal-footer" style="text-align: center">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                                onclick="editar_ControlP()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function eliminarcontrol(id_control_pilones) {
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

                        @this.eliminarControlP(id_control_pilones);
                    }
                })
                event.preventDefault()
            }
            
            let control_tabla_entrada;
            let control_tabla_entrada_edit;

            function registrar_ControlP() {
                @this.registrar_ControlP({
                    'id_entrada_pilones': document.getElementById('nombre_taba').value,
                    'entrada_tabaco_pilon': document.getElementById('entrada_taba').value,
                    'salida_tabaco_pilon': document.getElementById('salida_tab').value,
                    'total_actual': document.getElementById('total_act').value,
                    'Total': document.getElementById('exis_total').value,
                });
                control_tabla_entrada.setValue('');
                document.getElementById('entrada_taba').value = '';
                document.getElementById('salida_tab').value = '';
                document.getElementById('total_act').value = '';
                document.getElementById('exis_total').value = '';

            }

            var id_control_p = 0;

            function cargarEditarCP(params) {
                var cargar = JSON.parse(params);
                id_control_p = cargar.id_control_pilones;
                control_tabla_entrada_edit.setValue(cargar.id_entrada_pilones);
                document.getElementById('entrada_taba_edit').value = cargar.entrada_tabaco_pilon;
                document.getElementById('salida_tab_edit').value = cargar.salida_tabaco_pilon;
                document.getElementById('total_act_edit').value = cargar.total_actual;
                document.getElementById('exis_total_edit').value = cargar.Total;

            }

            function editar_ControlP() {
                @this.editar_ControlP(id_control_p, {

                    'id_entrada_pilones': document.getElementById('nombre_taba_edit').value,
                    'entrada_tabaco_pilon': document.getElementById('entrada_taba_edit').value,
                    'salida_tabaco_pilon': document.getElementById('salida_tab_edit').value,
                    'total_actual': document.getElementById('total_act_edit').value,
                    'Total': document.getElementById('exis_total_edit').value,
                });
            }

            function buscar_cp() {
                @this.nombre_tabaco = $('#buscarnomtab').val();
                @this.fecha_entrada_pilon = $('#buscarFecha').val();
                @this.numero_pilon = $('#buscarnPilon').val();
            }

            $(document).ready(function() {
                var seletscc = ["buscarnomtab", "buscarFecha", "buscarnPilon", ];
                seletscc.forEach(element => {
                    selects(element);
                });
                control_tabla_entrada = new TomSelect("#nombre_taba", {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
                control_tabla_entrada_edit = new TomSelect("#nombre_taba_edit", {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
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
