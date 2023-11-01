<div class="container-fluid" style="height: 90vh">
    <div class="row">
        <div class="col-md-4" @if(count($empleados)==0)
            hidden
        @else

        @endif>
            <div class="card" style="height: 90vh;" >
                <div class="card-body">
                    <div class="table-responsive" style="height: 87vh;">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 60px">Codigo</th>
                                    <th style="width: 60px">Rol</th>
                                    <th>Nombre</th>
                                    <th>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-nut" viewBox="0 0 16 16">
                                            <path
                                                d="m11.42 2 3.428 6-3.428 6H4.58L1.152 8 4.58 2h6.84zM4.58 1a1 1 0 0 0-.868.504l-3.428 6a1 1 0 0 0 0 .992l3.428 6A1 1 0 0 0 4.58 15h6.84a1 1 0 0 0 .868-.504l3.429-6a1 1 0 0 0 0-.992l-3.429-6A1 1 0 0 0 11.42 1H4.58z" />
                                            <path
                                                d="M6.848 5.933a2.5 2.5 0 1 0 2.5 4.33 2.5 2.5 0 0 0-2.5-4.33zm-1.78 3.915a3.5 3.5 0 1 1 6.061-3.5 3.5 3.5 0 0 1-6.062 3.5z" />
                                        </svg>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($empleados as $empleado)
                                <tr class="text-center">
                                    <td style="width: 60px">{{ $empleado->codigo }}</td>
                                    <td style="width: 60px">{{ $empleado->rol }}</td>
                                    <td>{{ $empleado->nombre }}</td>
                                    <td>
                                        <a href="#" style="text-decoration: none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M14.854 4.854a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 4H3.5A2.5 2.5 0 0 0 1 6.5v8a.5.5 0 0 0 1 0v-8A1.5 1.5 0 0 1 3.5 5h9.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4z"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div @if(count($empleados)==0)
        class="col-md-12"
    @else
    class="col-md-8"
    @endif>
            <ul class="nav nav-tabs justify-content-center">
                @php
                    $moduloactual = [];
                @endphp
                @foreach ($modulos as $modulo)
                <li class="nav-item">
                    <a class="nav-link @if($modulo_actual == $modulo->id)
                        active

                        @php
                            $moduloactual = $modulo;
                        @endphp
                    @else

                    @endif fs-7" href="#" wire:click="cambiar_modulo({{ $modulo->id }})"><strong>{{ $modulo->nombre }}</strong></a>
                </li>
                @endforeach
                @if($modulo->nombre == 'Modulo 7')

                @else
                    <li class="nav-item">
                        <a class="nav-link fs-7 active" href="#" wire:click="agregar_nuevo_modulo()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z"/>
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                            </svg>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link fs-7 active" href="#">
                        <abbr title="Etiquetas de Mesas">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tag-fill" viewBox="0 0 16 16">
                                <path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1H2zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            </svg>
                        </abbr>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-7 active" href="#">
                        <abbr title="Etiquetas de las maletas">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tags" viewBox="0 0 16 16">
                                <path d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z"/>
                                <path d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z"/>
                            </svg>
                        </abbr>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-7 active" href="#">
                        <abbr title="Exportar planificacion">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                                <path d="M6 12v-2h3v2H6z"/>
                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3V9z"/>
                            </svg>
                        </abbr>
                    </a>
                </li>
            </ul>
            <div class="card" style="height: 86vh;">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">Revisadores</label>
                        </div>
                        <div class="col-md-5">
                            @if(is_null($moduloactual->revisador1))
                            @isset($revisador['revisador'])
                            <select class="form-control form-control-sm" name="" id="revisador_1" onchange="agregar_revisador_modulo({{ $moduloactual->id }},'revisador_1',1)">
                                <option value="">Selecione</option>
                                @foreach ($revisador['revisador'] as $revisa)
                                    <option value="{{ $revisa->id }}">{{ $revisa->codigo.' - '.$revisa->nombre }}</option>
                                @endforeach
                            </select>
                            @endisset
                            @else
                                <a href="#" style="text-decoration: none" wire:click="eliminar_revisador_modulo({{ $moduloactual->id }},1)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                    </svg>
                                </a>
                                {{ $moduloactual->revisador1 }}
                            @endif
                        </div>
                        <div class="col-md-5">
                            @if(is_null($moduloactual->revisador2))
                            @isset($revisador['revisador'])
                            <select class="form-control form-control-sm" name="" id="revisador_2" onchange="agregar_revisador_modulo({{ $moduloactual->id }},'revisador_2',2)">
                                <option value="">Selecione</option>
                                @foreach ($revisador['revisador'] as $revisa)
                                    <option value="{{ $revisa->id }}">{{ $revisa->codigo.' - '.$revisa->nombre }}</option>
                                @endforeach
                            </select>
                            @endisset
                            @else
                                <a href="#" style="text-decoration: none" wire:click="eliminar_revisador_modulo({{ $moduloactual->id }},2)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                    </svg>
                                </a>
                                {{ $moduloactual->revisador2 }}
                            @endif

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="height: 78vh;">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>N#</th>
                                    <th>COD</th>
                                    <th>BONCHERO</th>
                                    <th>COD</th>
                                    <th>ROLERO</th>
                                    <th>ORDEN</th>
                                    <th>VITOLA</th>
                                    <th>MARCAS</th>
                                    <th>PEND.</th>
                                    <th>TAREA</th>
                                    <th>ESTIMADO</th>
                                </tr>
                            </thead>
                            <tbody class="fs-7">
                                <tr>
                                    <td></td>
                                    <td colspan="2" class="text-center">
                                        @isset($boncheros['boncheros'])
                                        <select class="form-control form-control-sm" name="" id="empleadon" onchange="agregar_nueva_tupla(1,'empleadon')">
                                            <option value="">Selecione</option>
                                            @foreach ($boncheros['boncheros'] as $bonche)
                                                <option value="{{ $bonche->id }}">{{ $bonche->codigo.' - '.$bonche->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @endisset
                                    </td>
                                    <td colspan="2" class="text-center">
                                        @isset($roleros['roleros'])
                                        <select class="form-control form-control-sm" name="" id="empleadon2" onchange="agregar_nueva_tupla(2,'empleadon2')">
                                            <option value="">Selecione</option>
                                            @foreach ($roleros['roleros'] as $rolero)
                                                <option value="{{ $rolero->id }}">{{ $rolero->codigo.' - '.$rolero->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @endisset
                                    </td>
                                    <td colspan="2" class="text-center"></td>
                                    <td colspan="2" class="text-center"></td>
                                </tr>
                                @foreach ($modulo_empleado as $key => $emple)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    @if(is_null($emple->codigo_empleaado))
                                        <td colspan="2" class="text-center">
                                            @isset($boncheros['boncheros'])
                                            <select class="form-control form-control-sm" name="" id="empleado{{ $emple->id }}" onchange="agregar_empleado({{ $emple->id }},1,'empleado{{ $emple->id }}')">
                                                <option value="">Selecione</option>
                                                @foreach ($boncheros['boncheros'] as $bonche)
                                                    <option value="{{ $bonche->id }}">{{ $bonche->codigo.' - '.$bonche->nombre }}</option>
                                                @endforeach
                                            </select>
                                            @endisset
                                        </td>
                                    @else
                                        <td>
                                            <a href="#" style="text-decoration: none" wire:click="eliminar_detalle({{ $emple->id }},1)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                                </svg>
                                            </a>
                                            {{ $emple->codigo_empleaado }}</td>
                                        <td>{{ $emple->nombre_empleado }}</td>
                                    @endif
                                    @if(is_null($emple->codigo_empleaado2))
                                    <td colspan="2" class="text-center">
                                        @isset($roleros['roleros'])
                                        <select class="form-control form-control-sm" name="" id="empleado2{{ $emple->id }}" onchange="agregar_empleado({{ $emple->id }},2,'empleado2{{ $emple->id }}')">
                                            <option value="">Selecione</option>
                                            @foreach ($roleros['roleros'] as $rolero)
                                                <option value="{{ $rolero->id }}">{{ $rolero->codigo.' - '.$rolero->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @endisset
                                    </td>
                                    @else
                                        <td>
                                            <a href="#" style="text-decoration: none" wire:click="eliminar_detalle({{ $emple->id }},2)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                                </svg>
                                            </a>
                                            {{ $emple->codigo_empleaado2 }}</td>
                                        <td>{{ $emple->nombre_empleado2 }}</td>
                                    @endif
                                    <td>{{ $emple->orden_sistema }}</td>
                                    @if(is_null($emple->marca))
                                        <td colspan="2" class="text-center"><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_agregar_marca" onclick="seleccionar_tupla({{ $emple->id  }})">Agregar Marca</button></td>
                                    @else
                                        <td>{{ $emple->vitola.' '.$emple->nombre }}</td>
                                        <td>{{ $emple->marca }}</b>
                                            <a href="#" style="text-decoration: none" wire:click="eliminar_detalle({{ $emple->id }},3)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                                </svg>
                                            </a>
                                        </td>

                                    @endif
                                    <td><b>{{ $emple->restantes }}</td>
                                    <td>
                                        <input value="{{ $emple->tareas }}" type="number" id="tearea{{ $emple->id }}" onchange="agregar_nueva_tarea({{ $emple->id }},'#tearea{{ $emple->id }}')" class="form-control form-control-sm form-control-color" style="width: 4rem;">
                                    </td>
                                    <td>
                                        @if($emple->tareas == 0 || is_null($emple->marca))
                                            0
                                        @else
                                            @php
                                                $n = $emple->por_empleado / $emple->tareas;
                                                $whole = floor($n); // 1
                                                $fraction = $n - $whole; // .25
                                            @endphp
                                            {{ number_format($n , 0).'d y '. number_format(($fraction )*8, 0).'h' }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore class="modal fade" id="modal_agregar_marca" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
        style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo_ctalogo_productos">Marcas</h5>
                    <button id="btn_cerrar" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped"  id="catalgo_pendiente">
                        <thead>
                            <tr style="text-align: center">
                                <th style="width: 60px">ID(Agregar)</th>
                                <th>ORDEN</th>
                                <th>FECHA</th>
                                <th>PRODUCTO</th>
                                <th>POR PRODUCIR</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 1em">
                            @foreach ($pendiente_catalogo as $key => $pendiente)
                                <tr>
                                    <td>
                                        <a style="text-decoration: none" href="#"  data-bs-dismiss="modal"
                                            onclick="agregar_pendiente('{{ $pendiente->id }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-database-add" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Z" />
                                                <path
                                                    d="M12.096 6.223A4.92 4.92 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.493 4.493 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.525 4.525 0 0 1-.813-.927C8.5 14.992 8.252 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.552 4.552 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10c.262 0 .52-.008.774-.024a4.525 4.525 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777ZM3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4Z" />
                                            </svg>
                                        </a>
                                        {{ ++$key }}
                                    </td>
                                    <td style="text-align: center">{{ $pendiente->orden_sistema }}</td>
                                    <td>{{ $pendiente->fecha_recibido }}</td>
                                    <td>{{ $pendiente->producto }}</td>
                                    <td style="text-align: center">{{ $pendiente->restantes }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID(Agregar)</th>
                                <th>ORDEN</th>
                                <th>FECHA</th>
                                <th>PRODUCTO</th>
                                <th>POR PRODUCIR</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" class="btn btn-success">
                        <span>OK</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
    <script>
        var id_detalles = 0;
        function agregar_empleado(id,num,select){
            @this.agregar_detalle(id,num,$('#'+select).val());
        }

        function agregar_nueva_tupla(num,select){
            @this.nueva_tupla_detalle(num,$('#'+select).val());
        }

        function agregar_revisador_modulo(id,select,num){
            @this.agregar_revisador_modulo(id,$('#'+select).val(),num);
        }

        function agregar_nueva_tarea(id,num){
            @this.nueva_tareas(id,$(num).val());
        }

        function seleccionar_tupla(id) {
            id_detalles = id;
        }

        function agregar_pendiente(id) {
            @this.agregar_detalle(id_detalles,3,id);
        }

        $(document).ready(function() {
                $('#catalgo_pendiente').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                        "pageLength": 50
                    },
                    scrollY: 320,
                    initComplete: function() {
                        this.api()
                            .columns()
                            .every(function() {
                                let column = this;
                                let title = column.footer().textContent;

                                // Create input element
                                let input = document.createElement('input');
                                input.placeholder = title;
                                input.style.width = "200px";
                                column.footer().replaceChildren(input);

                                // Event listener for user input
                                input.addEventListener('keyup', () => {
                                    if (column.search() !== this.value) {
                                        column.search(input.value).draw();
                                    }
                                });
                            });
                    }
                });
            });
    </script>
@endpush
</div>