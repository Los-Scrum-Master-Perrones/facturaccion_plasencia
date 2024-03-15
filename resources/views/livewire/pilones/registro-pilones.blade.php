<div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href='#' asp-action="Crear" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#modalcrearpilon">Nuevo</a>
                </div>
                <div class="table-responsive" style="height: 72vh;">
                    <table id="example" class="table table-striped table-hover">
                        <thead class="table table-hover table-sm" wire:ignore>
                            <tr>
                                <th scope="col" style="text-align: center;">ID</th>
                                <th scope="col" style="text-align: center;">
                                    <select name="buscarClaP" id="buscarClaP" onchange="buscar_io()">
                                        <option value="">Clase Tabaco</option>

                                    </select>
                                </th>
                                <th scope="col" style="text-align: center;">Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pilonC as $key=> $pc)
                                <tr>
                                    <td scope="row" style="text-align: center;">{{ ++$key }}</td>
                                    <td style="text-align: center;">{{ $pc->nombre }}</td>
                                    <td style="text-align: center;"><a href= '#' data-bs-target="#modaleditarpilon"
                                            data-bs-toggle="modal"
                                            onclick="cargarEditarCP(`{{ json_encode($pc) }}`)"><svg
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

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <a href='#' asp-action="Crear" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#modalcrearidpilon">Nuevo</a>
                </div>
                <div class="table-responsive" style="height: 72vh;">
                    <table id="example" class="table table-striped table-hover">
                        <thead class="table table-hover table-sm" wire:ignore>
                            <tr>
                                <th scope="col" style="text-align: center;">ID</th>
                                <th scope="col" style="text-align: center;">
                                    <select name="buscNumP" id="buscNumP" onchange="buscar_io()">
                                        <option value="">Número de pilon</option>
                                    </select>
                                </th>
                                <th scope="col" style="text-align: center;">Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($nPilon as $key=> $np)
                                <tr>
                                    <td scope="row" style="text-align: center;">{{ ++$key }}</td>
                                    <td style="text-align: center;">{{ $np->numero_pilon }}</td>
                                    <td style="text-align: center;"><a href= '#'
                                            data-bs-target="#modaleditaridpilon" data-bs-toggle="modal"
                                            onclick="cargarEditarNumP(`{{ json_encode($np) }}`)"><svg xmlns="http://www.w3.org/2000/svg" width="16"
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

    <!-- MODAL PARA CREAR clase pilon-->
    <div class="modal fade" id="modalcrearpilon" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="titulo1">
                        Crear
                    </h3>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="formulario_pilon">
                        @csrf
                        <input id="id_r" name="id_r" hidden value="">

                        <div style="display: flex; margin-top: 2px">
                            <div style="width: 100%">
                                <label style="width: 100%">Clase tabaco</label>
                                <input id="clase_tabaco" type="text" name="clase_tabaco" class="form-control">
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer" style="text-align: center">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                            onclick="registrar_claseP()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PARA CREAR id pilon-->
    <div class="modal fade" id="modalcrearidpilon" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="titulo1">
                        Crear
                    </h3>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="formulario_pilon">
                        @csrf
                        <input id="id_r" name="id_r" hidden value="">

                        <div style="display: flex; margin-top: 2px">
                            <div style="width: 100%">
                                <label style="width: 100%">Número de pilon</label>
                                <input id="numeroPi" type="text" name="numeroPi" class="form-control">
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer" style="text-align: center">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                            onclick="registrar_idP()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PARA EDITAR clase pilon-->
    <div class="modal fade" id="modaleditarpilon" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="titulo1">
                        Editar
                    </h3>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="formulario_pilon">
                        @csrf
                        <input id="id_r" name="id_r" hidden value="">

                        <div style="display: flex; margin-top: 2px">
                            <div style="width: 100%">
                                <label style="width: 100%">Clase tabaco</label>
                                <input id="clase_tabacoE" type="text" name="clase_tabacoE" class="form-control">
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer" style="text-align: center">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                            onclick="editar_claseP()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PARA EDITAR id pilon-->
    <div class="modal fade" id="modaleditaridpilon" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="titulo1">
                        Editar
                    </h3>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="formulario_pilon">
                        @csrf
                        <input id="id_r" name="id_r" hidden value="">

                        <div style="display: flex; margin-top: 2px">
                            <div style="width: 100%">
                                <label style="width: 100%">Número de pilon</label>
                                <input id="numeroPiE" type="text" name="numeroPiE"
                                    class="form-control">
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer" style="text-align: center">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                            onclick="editar_idP()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function registrar_claseP() {
                @this.registrar_claseP({
                    'nombre': document.getElementById('clase_tabaco').value,
                });
                document.getElementById('clase_tabaco').value = '';
            }

            var id_cp = 0;

            function cargarEditarCP(params) {
                var cargar = JSON.parse(params);
                id_cp = cargar.id;
                document.getElementById('clase_tabacoE').value = cargar.nombre;
            }

            function editar_claseP() {
                @this.editar_claseP(id_cp, {
                    'nombre': document.getElementById('clase_tabacoE').value,
                });
            }

            function buscar_io() {
                @this.nombre = $('#buscarClaP').val();
                @this.numero_pilon = $('#buscNumP').val();

            }

            $(document).ready(function() {
                var seletscc = ["buscarClaP","buscNumP" ];
                seletscc.forEach(element => {
                    selects(element);
                });
            });

            function selects(nombre) {
                new TomSelect("#" + nombre, {
                    create: true,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });

            }

            function registrar_idP() {
                @this.registrar_idP({
                    'numero_pilon': document.getElementById('numeroPi').value,
                });
                document.getElementById('numeroPi').value = '';
            }

            var id_NumPil = 0;

            function cargarEditarNumP(params) {
                var cargarN = JSON.parse(params);
                id_NumPil = cargarN.id_pilon;
                document.getElementById('numeroPiE').value = cargarN.numero_pilon;
            }

            function editar_idP() {
                @this.editar_idP(id_NumPil, {
                    'numero_pilon': document.getElementById('numeroPiE').value,
                });
            }
        </script>
    @endpush
</div>
