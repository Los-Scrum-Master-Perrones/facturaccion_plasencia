<div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="1"
            wire:model="cambio">
        <label class="form-check-label" for="inlineRadio2">Procesos</label>
    </div>&nbsp;&nbsp;
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="2"
            wire:model="cambio">
        <label class="form-check-label" for="inlineRadio3">Pilón</label>
    </div>

    <!-- Esto es para Proceso -->
    <div class="row" @if ($cambio == 1) @else
      hidden @endif>
        <div class="col-md-12">
            <div class="card">
                <label for="" style="text-align:center; font-size:16px; font-weight: bold;">Tabla de
                    Procesos</label>
                <div wire:ignore class="card-header" style="display: flex; margin-top: 2px">
                    <a href='#' asp-action="Crear" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#modalcrearProceso">Nuevo</a>
                    &nbsp;&nbsp;
                    <a href='#' class="btn btn-success btn-sm" wire:click = "imprimir_ProcesoPilon()">Imprimir
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
                                <th scope="col" style="text-align: center !important;">Fecha de proceso</th>
                                <th scope="col" style="text-align: center !important;">
                                    <select name="buscarNRemisionPr" id="buscarNRemisionPr" onchange="buscar_cp()">
                                        <option value="">Numero de remisión</option>
                                    </select>
                                </th>
                                <th scope="col" style="text-align: center !important;">
                                    <select name="buscar_Entr_SalPr" id="buscar_Entr_SalPr" onchange="buscar_cp()">
                                        <option value="">Entradas y Salidas</option>
                                    </select>
                                </th>
                                <th scope="col" style="text-align: center !important;">
                                    <select name="buscarNomTabPr" id="buscarNomTabPr" onchange="buscar_cp()">
                                        <option value="">Nombre Tabaco</option>
                                    </select>
                                </th>
                                <th scope="col" style="text-align: center !important;">Sub Total</th>
                                <th scope="col" style="text-align: center !important;">Total libras</th>
                                <th scope="col" style="text-align: center !important;">Total general</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($proPilones as $key=> $procP)
                                <tr>
                                    <td scope="row" style="text-align: center;">{{ ++$key }}</td>
                                    <td style="text-align: center;"> {{ $procP->fecha_proceso }}</td>
                                    <td scope="row" style="text-align: center;">{{ $procP->id_remision }}</td>
                                    <td scope="row" style="text-align: center;">{{ $procP->entradas_salidas }}
                                    </td>
                                    <td style="text-align: center;">{{ $procP->nombre_tabaco }}</td>
                                    <td scope="row" style="text-align: center;"> {{ $procP->subtotal }}</td>
                                    <td style="text-align: center;">{{ $procP->total_libras }}</td>
                                    <td style="text-align: center;">{{ $procP->total_remision }}</td>
                                    <td style="text-align: center;"><a href='#'
                                            onclick="eliminarProceso({{ $procP->id_tabla_pilon }})"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                <path
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                            </svg></a><a href= '#' data-bs-target="#modalEditarProceso"
                                            data-bs-toggle="modal"
                                            onclick="cargarEditarProceso(`{{ json_encode($procP) }}`)"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
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

    <!-- MODAL PARA CREAR Proceso-->
    <div wire:ignore class="modal fade" id="modalcrearProceso" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="titulo1">
                        Crear Proceso
                    </h3>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="formulario_Entrapilon">
                        @csrf
                        <input id="id_r" name="id_r" hidden value="">

                        <div style="display: flex; margin-top: 5px">
                            <div style="width: 100%">
                                <label>Fecha de proceso</label>
                                <input id="fech_procePr" type="date" name="fech_procePr" class="form-control">
                            </div>

                            &nbsp;&nbsp;
                            <div style="width: 100%">
                                <label>Numero de remisión</label>
                                <input id="num_remisPr" type="text" name="num_remisPr" class="form-control">
                            </div>
                        </div>

                        <div style="display: flex; margin-top: 5px">
                            <div style="width: 100%">
                                <label>Entradas y Salidas</label>
                                <input id="entra_saldPr" type="text" name="entra_saldPr" class="form-control">
                            </div> &nbsp;&nbsp;
                            <div style="width: 100%">
                                <label style="width: 100%">Nombre del tabaco</label>
                                <select aria-label="Default select example" id="nombre_tabaPr" name="nombre_tabaPr">
                                    <option value="">Seleccione el nombre</option>
                                    @foreach ($tabla_ProcesoP as $tabProp)
                                        <option value="{{ $tabProp->id_entrada_pilones }}">
                                            {{ $tabProp->nombre_tabaco }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div style="display: flex; margin-top: 5px">
                            <div style="width: 100%">
                                <label>Sub total</label>
                                <input id="sub_totalPr" type="text" name="sub_totalPr"class="form-control">
                            </div>

                            &nbsp;&nbsp;
                            <div style="width: 100%">
                                <label>Total en libras</label>
                                <input id="total_libPr" type="text" name="total_libPr" class="form-control">
                            </div>&nbsp;&nbsp;
                            <div style="width: 100%">

                                <label>Total general</label>
                                <input id="total_genPr" type="text" name="total_genPr" class="form-control">
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer" style="text-align: center">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                            onclick="registrar_Proceso()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PARA EDITAR Proceso-->
    <div wire:ignore class="modal fade" id="modalEditarProceso" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="titulo1">
                        Editar Procesos
                    </h3>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="formulario_Entrapilon">
                        @csrf
                        <input id="id_r" name="id_r" hidden value="">

                        <div style="display: flex; margin-top: 5px">
                            <div style="width: 100%">
                                <label>Fecha de proceso</label>
                                <input id="fech_procePr_edit" type="date" name="fech_procePr_edit"
                                    class="form-control">
                            </div>

                            &nbsp;&nbsp;
                            <div style="width: 100%">
                                <label>Numero de remisión</label>
                                <input id="num_remisPr_edit" type="text" name="num_remisPr_edit"
                                    class="form-control">
                            </div>
                        </div>

                        <div style="display: flex; margin-top: 5px">
                            <div style="width: 100%">
                                <label>Entradas y Salidas</label>
                                <input id="entra_saldPr_edit" type="text" name="entra_saldPr_edit"
                                    class="form-control">
                            </div> &nbsp;&nbsp;
                            <div style="width: 100%">
                                <label style="width: 100%">Nombre del tabaco</label>
                                <select aria-label="Default select example" id="nombre_tabaPr_edit"
                                    name="nombre_tabaPr_edit">
                                    <option value="">Seleccione el nombre</option>
                                    @foreach ($tabla_ProcesoP as $tabProp)
                                        <option value="{{ $tabProp->nombre_tabaco }}">
                                            {{ $tabProp->nombre_tabaco }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div style="display: flex; margin-top: 5px">
                            <div style="width: 100%">
                                <label>Sub total</label>
                                <input id="sub_totalPr_edit" type="text" name="sub_totalPr_edit"
                                    class="form-control">
                            </div>

                            &nbsp;&nbsp;
                            <div style="width: 100%">
                                <label>Total en libras</label>
                                <input id="total_libPr_edit" type="text" name="total_libPr_edit"
                                    class="form-control">
                            </div>&nbsp;&nbsp;
                            <div style="width: 100%">

                                <label>Total general</label>
                                <input id="total_genPr_edit" type="text" name="total_genPr_edit"
                                    class="form-control">
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer" style="text-align: center">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                            onclick="editar_Proceso()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Esto es para Proceso Pilones-->
    <div class="row" @if ($cambio == 2)
    @else  hidden @endif>
        <div class="col-md-12">
            <div class="card">
                <label for="" style="text-align:center; font-size:16px; font-weight: bold;">Tabla de
                    Pilones</label>
                <div wire:ignore class="card-header" style="display: flex; margin-top: 2px">
                    <a href='#' asp-action="Crear" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#modalcrearProcesoP">Nuevo</a>
                    &nbsp;&nbsp;
                    <a href='#' class="btn btn-success btn-sm" wire:click = "imprimir_ProcesoPilon()">Imprimir
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
                                <th scope="col" style="text-align: center !important;">Fecha de proceso</th>
                                <th scope="col" style="text-align: center !important;">
                                    <select name="buscarNRemision" id="buscarNRemision" onchange="buscar_Pi()">
                                        <option value="">Numero de remisión</option>
                                    </select>
                                </th>
                                <th scope="col" style="text-align: center !important;">
                                    <select name="buscar_Entr_Sal" id="buscar_Entr_Sal" onchange="buscar_Pi()">
                                        <option value="">Entradas y Salidas</option>
                                    </select>
                                </th>
                                <th scope="col" style="text-align: center !important;">
                                    <select name="buscarNomTab" id="buscarNomTab" onchange="buscar_Pi()">
                                        <option value="">Nombre Tabaco</option>
                                    </select>
                                </th>
                                <th scope="col" style="text-align: center !important;">Sub Total</th>
                                <th scope="col" style="text-align: center !important;">Total libras</th>
                                <th scope="col" style="text-align: center !important;">Total general</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($proPilones as $key=> $procP)
                                <tr>
                                    <td scope="row" style="text-align: center;">{{ ++$key }}</td>
                                    <td style="text-align: center;"> {{ $procP->fecha_proceso }}</td>
                                    <td scope="row" style="text-align: center;">{{ $procP->id_remision }}</td>
                                    <td scope="row" style="text-align: center;">{{ $procP->entradas_salidas }}
                                    </td>
                                    <td style="text-align: center;">{{ $procP->nombre_tabaco }}</td>
                                    <td scope="row" style="text-align: center;"> {{ $procP->subtotal }}</td>
                                    <td style="text-align: center;">{{ $procP->total_libras }}</td>
                                    <td style="text-align: center;">{{ $procP->total_remision }}</td>
                                    <td style="text-align: center;"><a href='#'
                                            onclick="eliminarProcesoPilon({{ $procP->id_tabla_pilon }})"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                <path
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                            </svg></a><a href= '#' data-bs-target="#modalEditarProcesoP"
                                            data-bs-toggle="modal"
                                            onclick="cargarEditarProcP(`{{ json_encode($procP) }}`)"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
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

    <!-- MODAL PARA CREAR Proceso pilon-->
    <div wire:ignore class="modal fade" id="modalcrearProcesoP" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="titulo1">
                        Crear Proceso de pilones
                    </h3>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="formulario_Entrapilon">
                        @csrf
                        <input id="id_r" name="id_r" hidden value="">

                        <div style="display: flex; margin-top: 5px">
                            <div style="width: 100%">
                                <label>Fecha de proceso</label>
                                <input id="fech_proce" type="date" name="fech_proce" class="form-control">
                            </div>

                            &nbsp;&nbsp;
                            <div style="width: 100%">
                                <label>Numero de remisión</label>
                                <input id="num_remis" type="text" name="num_remis" class="form-control">
                            </div>
                        </div>

                        <div style="display: flex; margin-top: 5px">
                            <div style="width: 100%">
                                <label>Entradas y Salidas</label>
                                <input id="entra_sald" type="text" name="entra_sald" class="form-control">
                            </div> &nbsp;&nbsp;
                            <div style="width: 100%">
                                <label style="width: 100%">Nombre del tabaco</label>
                                <select aria-label="Default select example" id="nombre_taba" name="nombre_taba">
                                    <option value="">Seleccione el nombre</option>
                                    @foreach ($tabla_ProcesoP as $tabProp)
                                        <option value="{{ $tabProp->id_entrada_pilones }}">
                                            {{ $tabProp->nombre_tabaco }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div style="display: flex; margin-top: 5px">
                            <div style="width: 100%">
                                <label>Sub total</label>
                                <input id="sub_total" type="text" name="sub_total"class="form-control">
                            </div>

                            &nbsp;&nbsp;
                            <div style="width: 100%">
                                <label>Total en libras</label>
                                <input id="total_lib" type="text" name="total_lib" class="form-control">
                            </div>&nbsp;&nbsp;
                            <div style="width: 100%">

                                <label>Total general</label>
                                <input id="total_gen" type="text" name="total_gen" class="form-control">
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer" style="text-align: center">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                            onclick="registrar_ProcesoP()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PARA EDITAR Proceso pilon-->
    <div wire:ignore class="modal fade" id="modalEditarProcesoP" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="titulo1">
                        Editar Proceso de pilones
                    </h3>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="formulario_Entrapilon">
                        @csrf
                        <input id="id_r" name="id_r" hidden value="">

                        <div style="display: flex; margin-top: 5px">
                            <div style="width: 100%">
                                <label>Fecha de proceso</label>
                                <input id="fech_proce_edit" type="date" name="fech_proce_edit"
                                    class="form-control">
                            </div>

                            &nbsp;&nbsp;
                            <div style="width: 100%">
                                <label>Numero de remisión</label>
                                <input id="num_remis_edit" type="text" name="num_remis_edit"
                                    class="form-control">
                            </div>
                        </div>

                        <div style="display: flex; margin-top: 5px">
                            <div style="width: 100%">
                                <label>Entradas y Salidas</label>
                                <input id="entra_sald_edit" type="text" name="entra_sald_edit"
                                    class="form-control">
                            </div> &nbsp;&nbsp;
                            <div style="width: 100%">
                                <label style="width: 100%">Nombre del tabaco</label>
                                <select aria-label="Default select example" id="nombre_taba_edit"
                                    name="nombre_taba_edit">
                                    <option value="">Seleccione el nombre</option>
                                    @foreach ($tabla_ProcesoP as $tabProp)
                                        <option value="{{ $tabProp->nombre_tabaco }}">
                                            {{ $tabProp->nombre_tabaco }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div style="display: flex; margin-top: 5px">
                            <div style="width: 100%">
                                <label>Sub total</label>
                                <input id="sub_total_edit" type="text" name="sub_total_edit"
                                    class="form-control">
                            </div>

                            &nbsp;&nbsp;
                            <div style="width: 100%">
                                <label>Total en libras</label>
                                <input id="total_lib_edit" type="text" name="total_lib_edit"
                                    class="form-control">
                            </div>&nbsp;&nbsp;
                            <div style="width: 100%">

                                <label>Total general</label>
                                <input id="total_gen_edit" type="text" name="total_gen_edit"
                                    class="form-control">
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer" style="text-align: center">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                            onclick="editar_ProcesoP()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@push('scripts')
    <script>
        function eliminarProcesoPilon(id_tabla_pilon) {
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

                    @this.eliminarProcePilon(id_tabla_pilon);
                }
            })
            event.preventDefault()
        }

        let control_tabla_Proceso_pilon;
        let control_tabla_Proceso_pilon_edit;

        let control_tabla_Proceso;
        let control_tabla_Proceso_edit;

        function registrar_ProcesoP() {
            @this.registrar_ProcesoP({
                'fecha_proceso': document.getElementById('fech_proce').value,
                'id_remision': document.getElementById('num_remis').value,
                'entradas_salidas': document.getElementById('entra_sald').value,
                'id_entrada_pilones': document.getElementById('nombre_taba').value,
                'subtotal': document.getElementById('sub_total').value,
                'total_libras': document.getElementById('total_lib').value,
                'total_remision': document.getElementById('total_gen').value,
            });
            document.getElementById('fech_proce').value = '';
            document.getElementById('num_remis').value = '';
            document.getElementById('entra_sald').value = '';
            control_tabla_Proceso_pilon.setValue('');
            document.getElementById('sub_total').value = '';
            document.getElementById('total_lib').value = '';
            document.getElementById('total_gen').value = '';

        }

        var id_proceso_p = 0;

        function cargarEditarProcP(params) {
            var cargar = JSON.parse(params);
            id_proceso_p = cargar.id_tabla_pilon;
            document.getElementById('fech_proce_edit').value = cargar.fecha_proceso;
            document.getElementById('num_remis_edit').value = cargar.id_remision;
            document.getElementById('entra_sald_edit').value = cargar.entradas_salidas;
            control_tabla_Proceso_pilon_edit.setValue(cargar.nombre_tabaco);
            document.getElementById('sub_total_edit').value = cargar.subtotal;
            document.getElementById('total_lib_edit').value = cargar.total_libras;
            document.getElementById('total_gen_edit').value = cargar.total_remision;

        }

        function editar_ProcesoP() {
            @this.editar_ProcesoP(id_proceso_p, {
                'fecha_proceso': document.getElementById('fech_proce_edit').value,
                'id_remision': document.getElementById('num_remis_edit').value,
                'entradas_salidas': document.getElementById('entra_sald_edit').value,
                'id_entrada_pilones': document.getElementById('nombre_taba_edit').value,
                'subtotal': document.getElementById('sub_total_edit').value,
                'total_libras': document.getElementById('total_lib_edit').value,
                'total_remision': document.getElementById('total_gen_edit').value,
            });
        }

        function buscar_cp() {
            @this.id_remision = $('#buscarNRemisionPr').val();
            @this.entradas_salidas = $('#buscar_Entr_SalPr').val();
            @this.nombre_tabaco = $('#buscarNomTabPr').val();

        }

        $(document).ready(function() {
            var seletscc = [ "buscarNRemisionPr",
                "buscar_Entr_SalPr", "buscarNomTabPr"
            ];
            seletscc.forEach(element => {
                selects(element);
            });

            control_tabla_Proceso = new TomSelect("#nombre_tabaPr", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
            control_tabla_Proceso_edit = new TomSelect("#nombre_tabaPr_edit", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });

        });

        function selects(variable1) {
            new TomSelect("#" + variable1, {
                create: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        }

        // Funciones para Pocesos
        function eliminarProceso(id_tabla_proceso) {
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

                    @this.eliminarProceso(id_tabla_proceso);
                }
            })
            event.preventDefault()
        }

        function registrar_Proceso() {
            @this.registrar_Proceso({
                'fecha_proceso': document.getElementById('fech_procePr').value,
                'id_remision': document.getElementById('num_remisPr').value,
                'entradas_salidas': document.getElementById('entra_saldPr').value,
                'id_entrada_pilones': document.getElementById('nombre_tabaPr').value,
                'subtotal': document.getElementById('sub_totalPr').value,
                'total_libras': document.getElementById('total_libPr').value,
                'total_remision': document.getElementById('total_genPr').value,
            });
            document.getElementById('fech_procePr').value = '';
            document.getElementById('num_remisPr').value = '';
            document.getElementById('entra_saldPr').value = '';
            control_tabla_Proceso.setValue('');
            document.getElementById('sub_totalPr').value = '';
            document.getElementById('total_libPr').value = '';
            document.getElementById('total_genPr').value = '';

        }

        var id_proceso = 0;

        function cargarEditarProceso(params) {
            var cargar = JSON.parse(params);
            id_proceso = cargar.id_tabla_proceso;
            document.getElementById('fech_procePr_edit').value = cargar.fecha_proceso;
            document.getElementById('num_remisPr_edit').value = cargar.id_remision;
            document.getElementById('entra_saldPr_edit').value = cargar.entradas_salidas;
            control_tabla_Proceso_edit.setValue(cargar.nombre_tabaco);
            document.getElementById('sub_totalPr_edit').value = cargar.subtotal;
            document.getElementById('total_libPr_edit').value = cargar.total_libras;
            document.getElementById('total_genPr_edit').value = cargar.total_remision;

        }

        function editar_Proceso() {
            @this.editar_Proceso(id_proceso, {
                'fecha_proceso': document.getElementById('fech_procePr_edit').value,
                'id_remision': document.getElementById('num_remisPr_edit').value,
                'entradas_salidas': document.getElementById('entra_saldPr_edit').value,
                'id_entrada_pilones': document.getElementById('nombre_tabaPr_edit').value,
                'subtotal': document.getElementById('sub_totalPr_edit').value,
                'total_libras': document.getElementById('total_libPr_edit').value,
                'total_remision': document.getElementById('total_genPr_edit').value,
            });
        }



        function buscar_Pi() {
            @this.id_remision = $('#buscarNRemision').val();
            @this.entradas_salidas = $('#buscar_Entr_Sal').val();
            @this.nombre_tabaco = $('#buscarNomTab').val();

        }

        $(document).ready(function() {
            var seletscc = ["buscarNRemision", "buscar_Entr_Sal", "buscarNomTab",
            ];
            seletscc.forEach(element => {
                selects(element);
            });
            control_tabla_Proceso_pilon = new TomSelect("#nombre_taba", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
            control_tabla_Proceso_pilon_edit = new TomSelect("#nombre_taba_edit", {
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
