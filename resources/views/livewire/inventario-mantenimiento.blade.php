<div>
    <div class="card">
        <div class="card-header">
            <a asp-action="Crear" class="btn btn-success btn-sm">Crear nuevo</a>
        </div>
        <div class="card-body">
            <table id="example" class="table table-striped table-hover">
                <thead class="table table-hover table-sm">
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Fecha ingreso</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Estado</th>
                        <th scope="col" style="text-align: center;"><svg xmlns="http://www.w3.org/2000/svg"
                                width="30" height="30" fill="currentColor" class="bi bi-gear-fill"
                                viewBox="0 0 16 16">
                                <path
                                    d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                            </svg></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inventarioM as $key=> $in)
                        <tr>
                            <td scope="row">{{ ++$key }}</td>
                            <td>{{ $in->nombre }}</td>
                            <td>{{ $in->descripcion }}</td>
                            <td>{{ $in->fecha_ingreso }}</td>
                            <td>{{ $in->cantidad }}</td>
                            <td>{{ $in->estado }}</td>
                            <td style="text-align: center;"><a href='#'
                                    onclick="eliminarmaterial({{ $in->id }})"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                    </svg></a><a href= '#' data-bs-toggle="modal"
                                    data-bs-target="#modaleditmantenimiento"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="currentColor" class="bi bi-pencil-square"
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

        <div class="modal fade" id="modaleditmantenimiento" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="titulo1">
                            Editar Material
                        </h3>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" id="formulario_factura">
                            @csrf
                            <input id="id_r" name="id_r" hidden value="">

                            <div style="display: flex; margin-top: 2px">
                                <div style="width: 100%">

                                    <label style="width: 100%">Nombre</label>
                                    <input readonly id="nombre" type="text" name="nombre" class="form-control">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 100%">

                                    <label>Fecha ingreso</label>
                                    <input id="fecha_ingreso" type="date" name="fecha_ingreso" class="form-control"
                                        value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                </div>
                            </div>


                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">

                                    <label>Cantidad</label>
                                    <input maxlength="4" id="cantidad" type="text" name="cantidad"
                                        class="form-control">
                                </div>
                                &nbsp;&nbsp;
                                <div style="width: 100%">

                                    <label>Descripción</label>
                                    <textarea id="descripcion" type="text" name="descripcion" class="form-control" rows="1"></textarea>
                                </div>
                            </div>

                            <div style="display: flex; margin-top: 5px">
                                <div style="width: 100%">

                                    <label>Estado</label>
                                    <select class="form-control" aria-label="Default select example" id="estado"
                                        name="estado">
                                        <option selected>Seleccione un estado</option>
                                        <option value="1">Bueno</option>
                                        <option value="2">Malo</option>
                                        <option value="3">En reparación</option>
                                    </select>
                                </div>
                            </div>
                        </form>

                        <div class="modal-footer" style="text-align: center">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function eliminarmaterial(id) {
                swal.fire({
                        title: '¿Esta seguro que quiere eliminar este material?',
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

                        @this.eliminarMaterial(id);

                        alertify.success('Detalle pedido eliminado')
                    }
                })
                event.preventDefault()
            }
        </script>
    @endpush
