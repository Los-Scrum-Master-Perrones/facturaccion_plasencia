<div xmlns:wire="http://www.w3.org/1999/xhtml">

    <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item">
            <a class="nav-link" style="color:white;font-size:12px;" href="pendiente_empaque"><strong>Pendiente</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:#E5B1E2; font-size:12px;" href="importar_c"><strong>Existencia en
                    bodega</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:white; font-size:12px;"
                href="{{ route('inventario_cajas') }}"><strong>Existencia de cajas</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:white; font-size:12px;"
                href="historial_programacion"><strong>Programaciones</strong></a>
        </li>
    </ul>

    <div class="container" style="max-width:100%;">
        <div class="card" style="height: 90vh;">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4" wire:ignore>
                        <form wire:submit.prevent="import" class="force-inline">
                            <div class="input-group mb-3" style="height: 30px">
                                <input type="file" name="select_file" id="select_file" wire:model="select_file"
                                    class="form-control" style="width:150px;" />
                                <input type="submit" name="upload" style="width:100px;" class="btn btn-primary"
                                    value="Importar">
                                <button type="button" class="btn btn-warning"  wire:click="vaciar">Vaciar</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <input name="busqueda" id="busqueda"  wire:model= "busqueda" class="form-control" placeholder="Búsqueda por Marca, Nombre y Capa" >
                    </div>
                    <div class="col-md-3" wire:ignore style="height: 30px"></div>
                    <div class="col-md-1">
                        <div class="input-group  align-text-top" >
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
            </div>
            <div class="card-body">
                <div class="table-responsive" style="height: 74vh;">
                    <table class="table table-light table-hover">
                        <thead>
                            <tr>
                                <th>Código sistema</th>
                                <th>Marca</th>
                                <th>Alias vitola</th>
                                <th>Vitola</th>
                                <th>Capa</th>
                                <th>Existencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($existencias as $existencia)
                                <tr>
                                    <td>{{ $existencia->codigo_producto }}</td>
                                    <td>{{ $existencia->marca }}</td>
                                    <td>{{ $existencia->nombre }}</td>
                                    <td>{{ $existencia->vitola }}</td>
                                    <td>{{ $existencia->capa }}</td>
                                    <td>{{ $existencia->total }}</td>
                                </tr>
                                @php
                                    $total += $existencia->total;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>

                    <div class="input-group" style="width:40%; position: fixed;right: 0px;bottom:0px; height:30px;">
                        <span class="form-control input-group-text">Total pendiente</span>
                        <input type="text" class="form-control" id="sumap" value="{{ number_format($total , 0) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
