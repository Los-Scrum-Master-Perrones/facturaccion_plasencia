<div>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href='#' asp-action="Crear" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalcrearEntrP">Nuevo</a>
                    </div>
                    <div class="table-responsive" style="height: 72vh;">
                        <table id="example" class="table table-striped table-hover">
                            <thead class="table table-hover table-sm" wire:ignore>
                                <tr>
                                    <th scope="col" style="text-align: center;">ID</th>
                                    <th scope="col" style="text-align: center;">

                                        <select name="buscarNomPilon" id="buscarNomPilon" onchange="buscar_io()">
                                            <option value="">Nombre del tabaco</option>

                                        </select>
                                    </th>
                                    <th scope="col" style="text-align: center;">
                                        <select name="buscarVarieda" id="buscarVarieda" onchange="buscar_io()">
                                            <option value="">Variedad</option>

                                        </select>
                                    </th>
                                    <th scope="col" style="text-align: center;">
                                        <select name="buscarFinca" id="buscarFinca" onchange="buscar_io()">
                                            <option value="">Finca</option>

                                        </select>
                                    </th>
                                    <th scope="col" style="text-align: center;">
                                        <select name="buscarPilon" id="buscarPilon" onchange="buscar_io()">
                                            <option value="">Pilón</option>

                                        </select>
                                    </th>
                                    <th scope="col" style="text-align: center;">
                                        <select name="buscarFechaEntra" id="buscarFechaEntra" onchange="buscar_io()">
                                            <option value="">Fecha de entrada</option>

                                        </select>
                                    </th>
                                    <th scope="col" style="text-align: center;">
                                        <select name="buscartiemAdela" id="buscartiemAdela" onchange="buscar_io()">
                                            <option value="">Tiempo de adelanto</option>

                                        </select>
                                    </th>
                                    <th scope="col" style="text-align: center;">
                                        <select name="buscarFechEsSal" id="buscarFechEsSal" onchange="buscar_io()">
                                            <option value="">Fecha estimada de salida</option>

                                        </select>
                                    </th>
                                    <th scope="col" style="text-align: center;">
                                        <select name="buscarCantLib" id="buscarCantLib" onchange="buscar_io()">
                                            <option value="">Cantidad en libras</option>

                                        </select>
                                    </th>
                                    <th scope="col" style="text-align: center;">Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($entradaPilon as $key=> $entP)
                                    <tr>
                                        <td scope="row" style="text-align: center;">{{ ++$key }}</td>
                                        <td style="text-align: center;">{{ $entP->nombre_tabaco }}</td>
                                        <td scope="row" style="text-align: center;">{{ $entP->variedad }}</td>
                                        <td style="text-align: center;">{{ $entP->finca }}</td>
                                        <td scope="row" style="text-align: center;">{{ $entP->numero_pilon }}</td>
                                        <td style="text-align: center;">{{ $entP->fecha_entrada_pilon }}</td>
                                        <td scope="row" style="text-align: center;">
                                            {{ $entP->tiempo_adelanto_pilon }}</td>
                                        <td style="text-align: center;">{{ $entP->fecha_estimada_salida }}</td>
                                        <td scope="row" style="text-align: center;">{{ $entP->cantidad_lbs }}</td>
                                        <td style="text-align: center;"><a href= '#'
                                                data-bs-target="#modaleditarEntrP" data-bs-toggle="modal"
                                                onclick="cargarEditarEP(`{{ json_encode($entP) }}`)"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                    height="16" fill="currentColor" class="bi bi-pencil-square"
                                                    viewBox="0 0 16 16">
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

        <!-- MODAL PARA CREAR Entrada pilon-->
        <div wire:ignore class="modal fade" id="modalcrearEntrP" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="titulo1">
                            Crear Entrada
                        </h3>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" id="formulario_Entrapilon">
                            @csrf
                            <input id="id_r" name="id_r" hidden value="">

                            <div style="display: flex; margin-top: 2px">
                                <div style="width: 100%">

                                    <label style="width: 100%">Nombre del tabaco</label>
                                    <select aria-label="Default select example" id="nombreTaba" name="nombreTaba">
                                        <option value="">Seleccione el nombre</option>
                                        @foreach ($tabla_clase as $tabC)
                                            <option value="{{ $tabC->nombre }}"> {{ $tabC->nombre }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 100%">

                                    <label>Variedad</label>
                                    <input id="variedad" type="text" name="variedad" class="form-control">
                                </div>
                            </div>

                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">

                                    <label>Finca</label>
                                    <input id="finca" type="text" name="finca" class="form-control">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 100%">
                                    <label>Pilón</label>
                                    <select aria-label="Default select example" id="pilon" name="pilon">
                                        <option value="">Seleccione un pilón</option>
                                        @foreach ($tabla_pilon as $tabP)
                                            <option value="{{ $tabP->numero_pilon }}"> {{ $tabP->numero_pilon }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">

                                    <label>Fecha de entrada</label>
                                    <input id="fecha_entrada" type="date" name="fecha_entrada"
                                        class="form-control" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 100%">
                                    <label>Tiempo de adelanto</label>
                                    <input id="tienpo_adelanto" type="text" name="tienpo_adelanto"
                                        class="form-control">
                                </div>
                            </div>

                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">
                                    <label>Fecha estimada</label>
                                    <input id="fecha_estimada" type="date" name="fecha_estimada"
                                        class="form-control">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 100%">

                                    <label>Cantidad en libras</label>
                                    <input id="cantidad_lib" type="text" name="cantidad_lib"
                                        class="form-control">
                                </div>
                            </div>
                        </form>

                        <div class="modal-footer" style="text-align: center">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                                onclick="registrar_EntradaP()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL PARA EDITAR la entrada pilon-->
        <div wire:ignore class="modal fade" id="modaleditarEntrP" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="titulo1">
                            Editar Entrada
                        </h3>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" id="formulario_pilon">
                            @csrf
                            <input id="id_r" name="id_r" hidden value="">

                            <div style="display: flex; margin-top: 2px">
                                <div style="width: 100%">

                                    <label style="width: 100%">Nombre del tabaco</label>
                                    <select aria-label="Default select example" id="edit_nombreTaba" name="edit_nombreTaba">
                                        <option value="">Seleccione el nombre</option>
                                        @foreach ($tabla_clase as $tabC)
                                            <option value="{{ $tabC->nombre }}"> {{ $tabC->nombre }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 100%">

                                    <label>Variedad</label>
                                    <input id="edit_variedad" type="text" name="edit_variedad" class="form-control">
                                </div>
                            </div>

                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">

                                    <label>Finca</label>
                                    <input id="edit_finca" type="text" name="edit_finca" class="form-control">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 100%">
                                    <label>Pilón</label>
                                    <select aria-label="Default select example" id="edit_pilon" name="edit_pilon">
                                        <option value="">Seleccione un pilón</option>
                                        @foreach ($tabla_pilon as $tabP)
                                            <option value="{{ $tabP->numero_pilon }}"> {{ $tabP->numero_pilon }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">

                                    <label>Fecha de entrada</label>
                                    <input id="edit_fecha_entrada" type="date" name="edit_fecha_entrada"
                                        class="form-control" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 100%">
                                    <label>Tiempo de adelanto</label>
                                    <input id="edit_tiempo_adelanto" type="text" name="edit_tiempo_adelanto"
                                        class="form-control">
                                </div>
                            </div>

                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">
                                    <label>Fecha estimada</label>
                                    <input id="edit_fecha_estimada" type="date" name="edit_fecha_estimada"
                                        class="form-control">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 100%">

                                    <label>Cantidad en libras</label>
                                    <input id="edit_cantidad_lib" type="text" name="edit_cantidad_lib"
                                        class="form-control">
                                </div>
                            </div>
                        </form>

                        <div class="modal-footer" style="text-align: center">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                                onclick="editar_EntradaP()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @push('scripts')
        <script>
            let control_tabla_tipo_edit;
            let control_tabla_pilon_edit;
            let control_tabla_tipo;
            let control_tabla_pilon;

            function registrar_EntradaP() {
                @this.registrar_EntradaP({
                    'nombre_tabaco': document.getElementById('nombreTaba').value,
                    'variedad': document.getElementById('variedad').value,
                    'finca': document.getElementById('finca').value,
                    'numero_pilon': document.getElementById('pilon').value,
                    'fecha_entrada_pilon': document.getElementById('fecha_entrada').value,
                    'tiempo_adelanto_pilon': document.getElementById('tienpo_adelanto').value,
                    'fecha_estimada_salida': document.getElementById('fecha_estimada').value,
                    'cantidad_lbs': document.getElementById('cantidad_lib').value,
                });
                control_tabla_tipo.setValue('');
                document.getElementById('variedad').value = '';
                document.getElementById('finca').value = '';
                control_tabla_pilon.setValue('');
                document.getElementById('tienpo_adelanto').value = '';
                document.getElementById('fecha_estimada').value = '';
                document.getElementById('cantidad_lib').value = '';

            }

            var id_entrada_p = 0;

            function cargarEditarEP(params) {
                var cargar = JSON.parse(params);
                id_entrada_p = cargar.id_entrada_pilones;
                control_tabla_tipo_edit.setValue(cargar.nombre_tabaco);
                document.getElementById('edit_variedad').value = cargar.variedad;
                document.getElementById('edit_finca').value = cargar.finca;
                control_tabla_pilon_edit.setValue(cargar.numero_pilon);
                document.getElementById('edit_fecha_entrada').value = cargar.fecha_entrada_pilon;
                document.getElementById('edit_tiempo_adelanto').value = cargar.tiempo_adelanto_pilon;
                document.getElementById('edit_fecha_estimada').value = cargar.fecha_estimada_salida;
                document.getElementById('edit_cantidad_lib').value = cargar.cantidad_lbs;

            }

            function editar_EntradaP() {
                @this.editar_EntradaP(id_entrada_p, {
                    'nombre_tabaco': document.getElementById('edit_nombreTaba').value,
                    'variedad': document.getElementById('edit_variedad').value,
                    'finca': document.getElementById('edit_finca').value,
                    'numero_pilon': document.getElementById('edit_pilon').value,
                    'fecha_entrada_pilon': document.getElementById('edit_fecha_entrada').value,
                    'tiempo_adelanto_pilon': document.getElementById('edit_tiempo_adelanto').value,
                    'fecha_estimada_salida': document.getElementById('edit_fecha_estimada').value,
                    'cantidad_lbs': document.getElementById('edit_cantidad_lib').value,

                });
            }

            function buscar_io() {
                @this.nombre_tabaco = $('#buscarNomPilon').val();
                @this.variedad = $('#buscarVarieda').val();
                @this.finca = $('#buscarFinca').val();
                @this.numero_pilon = $('#buscarPilon').val();
                @this.fecha_entrada_pilon = $('#buscarFechaEntra').val();
                @this.tiempo_adelanto_pilon = $('#buscartiemAdela').val();
                @this.fecha_estimada_salida = $('#buscarFechEsSal').val();
                @this.cantidad_lbs = $('#buscarCantLib').val();
            }

            $(document).ready(function() {
                var seletscc = ["buscarNomPilon", "buscarVarieda", "buscarFinca", "buscarPilon",
                    "buscarFechaEntra", "buscartiemAdela", "buscarFechEsSal", "buscarCantLib",
                ];
                seletscc.forEach(element => {
                    selects(element);
                });
                control_tabla_tipo_edit = new TomSelect("#edit_nombreTaba", {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
                control_tabla_pilon_edit = new TomSelect("#edit_pilon", {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });

                control_tabla_tipo = new TomSelect("#nombreTaba", {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
                control_tabla_pilon = new TomSelect("#pilon", {
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
