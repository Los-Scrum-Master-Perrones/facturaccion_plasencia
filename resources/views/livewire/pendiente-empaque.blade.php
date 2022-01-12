<div xmlns:wire="http://www.w3.org/1999/xhtml">

    <ul class="nav justify-content-center">
        @if(auth()->user()->rol == -1)

        @else
            <li class="nav-item">
                <a style="color:#E5B1E2; font-size:12px;" href="pendiente_empaque"><strong>Pendiente</strong></a>
            </li>
            <li class="nav-item">
                <a style="color:white; font-size:12px;" href="importar_c"><strong>Existencia en bodega</strong></a>
            </li>
            <li class="nav-item">
                <a style="color:white; font-size:12px;" href="inventario_cajas"><strong>Existencia de cajas</strong></a>
            </li>
        @endif
        <li class="nav-item">
            <a style="color:white; font-size:12px; " href="historial_programacion"><strong>Programaciones</strong></a>
        </li>
    </ul>


    <div class="container" style="max-width:100%; " @if($ventanas != 2) hidden @endif>
        <div wire:loading>
            <div class="centro_carga">

                <div style="color: #a0cadb" class="la-ball-atom la-3x">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

            </div>
        </div>

        <div class="row" style="text-align:center;">

            <div class="col">
                <div class="input-group mb-3">

                    <a type="button" name="crear_programacion" id="crear_programacion" wire:click.prevent="cambio(1)"
                        class=" botonprincipal   mr-sm-2" value="" style="width:70px; " href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-reply-all-fill" viewBox="0 0 16 16">
                            <path
                                d="M8.021 11.9 3.453 8.62a.719.719 0 0 1 0-1.238L8.021 4.1a.716.716 0 0 1 1.079.619V6c1.5 0 6 0 7 8-2.5-4.5-7-4-7-4v1.281c0 .56-.606.898-1.079.62z" />
                            <path
                                d="M5.232 4.293a.5.5 0 0 1-.106.7L1.114 7.945a.5.5 0 0 1-.042.028.147.147 0 0 0 0 .252.503.503 0 0 1 .042.028l4.012 2.954a.5.5 0 1 1-.593.805L.539 9.073a1.147 1.147 0 0 1 0-1.946l3.994-2.94a.5.5 0 0 1 .699.106z" />
                        </svg>
                    </a>

                    <input name="buscar" id="buscar" class="  form-control  mr-sm-2" wire:model="busqueda"
                        placeholder="Búsqueda por Marca, Nombre y Vitola" style="width:350px;">
                    <form action="{{Route('exportar_detallesprogramacion')}}" id="formver" name="formver">

                        <button class="botonprincipal" type="submit" style="width:120px;">Exportar</button>
                    </form>
                    <form hidden wire:submit.prevent="modal_limpiar()">
                        <button class="botonprincipal" type="submit" style="width:120px;">Vaciar</button>
                    </form>
                    <form wire:submit.prevent="insertarDetalle_y_actualizarPendiente()"
                        style="width:auto; padding-left:50px; ">
                        @csrf
                        <input name="fecha_creacion" id="fecha_creacion" type="date" class="  form-control  mr-sm-2"
                            placeholder="" style="width:200px;" wire:model="fecha">
                        <input name="fecha_contenedor" id="fecha_contenedor" type="text" class="  form-control  mr-sm-2"
                            placeholder="Número y fecha del contenedor" style="width:300px;" required
                            wire:model="contenedor" autocomplete="off">
                        <button type=" button" name="crear_programacion" id="crear_programacion"
                            class=" botonprincipal " value="" style="width:auto;"> Crear programación</button>
                    </form>

                </div>
            </div>
        </div>

        <div class="panel-body" style="padding:0px;">
            <div
                style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto; height:450px;">

                <table class="table table-light" id="editable" style="font-size:10px;">
                    <thead>
                        <tr style="text-align:center;">
                            <th># ORDEN</th>
                            <th style=" text-align:center;">ORDEN</th>
                            <th style=" text-align:center;">CODIGO</th>
                            <th style=" text-align:center;">MARCA</th>
                            <th style=" text-align:center;">VITOLA</th>
                            <th style=" text-align:center;">NOMBRE</th>
                            <th style=" text-align:center;">CAPA</th>
                            <th style=" text-align:center;">TIPO EMPAQUE</th>
                            <th style=" text-align:center;">ANILLO</th>
                            <th style=" text-align:center;">CELLO</th>
                            <th style=" text-align:center;">UPC</th>
                            <th style=" text-align:center;">SALDO</th>
                            <th style=" text-align:center;">EXISTENCIA</th>
                            <th style=" text-align:center;">SOB/FAL</th>
                            <th style=" text-align:center;">EN EXISTENCIA</th>
                            <th style=" text-align:center;">CAJAS</th>
                            <th style=" text-align:center;">OPERACIONES</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detalles_provicionales as $detalle_provicional)
                        <tr>
                            <td>{{$detalle_provicional->numero_orden}}</td>
                            <td>{{$detalle_provicional->orden}}</td>
                            <td>{{$detalle_provicional->cod_producto}}</td>
                            <td>{{$detalle_provicional->marca}}</td>
                            <td>{{$detalle_provicional->vitola}}</td>
                            <td>{{$detalle_provicional->nombre}}</td>
                            <td>{{$detalle_provicional->capa}}</td>
                            <td>{{$detalle_provicional->tipo_empaque}}</td>
                            <td>{{$detalle_provicional->anillo}}</td>
                            <td>{{$detalle_provicional->cello}}</td>
                            <td>{{$detalle_provicional->upc}}</td>
                            <td>{{$detalle_provicional->saldo}}</td>


                            @php
                            $pendiente_restante = 0;


                            $existencia = DB::select('select total from importar_existencias where codigo_producto = ?',
                            [$detalle_provicional->cod_producto]);
                            $programado_salir = DB::select('select sum(saldo) as total from
                            detalle_programacion_temporal where cod_producto = ?',
                            [$detalle_provicional->cod_producto]);
                            if($detalle_provicional->cod_producto != '' && isset($existencia[0]->total) &&
                            isset($programado_salir[0]->total)){
                            $pendiente_restante = $existencia[0]->total - $programado_salir[0]->total;
                            }
                            @endphp

                            <td>{{$detalle_provicional->total_existencia}}</td>
                            <?php  if($pendiente_restante < 0){

                        echo '<td style="color:red;">'.$pendiente_restante.'</td>' ;

                        }else{

                        echo '<td>' .$pendiente_restante. '</td>' ;
                        }
                        ?>

                        <?php
                            $cajas_totales_en_progrmacion = DB::select('CALL `01_programacion_provisional_cajas`(?)', [$detalle_provicional->codigo_caja]);
                            $existencia_cajas = DB::select('SELECT codigo,existencia FROM lista_cajas WHERE lista_cajas.codigo = ?', [$detalle_provicional->codigo_caja]);

                            if(isset($cajas_totales_en_progrmacion[0]->total_cajas)){
                                if(isset($existencia_cajas[0]->existencia) ){

                                    if($existencia_cajas[0]->existencia > 0){

                                    echo '<td>Sobran '.($existencia_cajas[0]->existencia).' cajas</td>' ;

                                    }else{

                                    echo '<td style="color:red;">Faltan '.($existencia_cajas[0]->existencia).' cajas</td>' ;

                                    }

                                }else{
                                    echo '<td>No existe</td>' ;
                                }
                            }else{
                                echo '<td>N/A</td>' ;
                            }

                        ?>
                            <td style="text-align:center">
                                {{$detalle_provicional->cant_cajas_necesarias}}
                            </td>
                            <td style="text-align:center">

                                <a  onclick="eliminar_detalle_prgramacion({{$detalle_provicional->id}})" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        clcass="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </a>

                                <a style=" width:10px; height:10px;" href="#"
                                    onclick="editar_saldo({{$detalle_provicional->id}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </a>
                            </td>

                        </tr>

                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <br>
        <div class="input-group" style="width:30%;position: fixed;right: 0px;bottom:0px; height:30px;">
            <span class="form-control input-group-text">Total Programacion</span>
            <input type="text" class="form-control" wire:model="total_saldo">
        </div>
    </div>

    <div @if($ventanas == 2) hidden @endif>
        <div class="container" style="max-width:100%; ">
            <div wire:loading>
                <div class="centro_carga">

                    <div style="color: #a0cadb" class="la-ball-atom la-3x">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>

                </div>
            </div>

            <div class="row" style="margin-bottom:2px">
                @if(auth()->user()->rol == -1)

                @else
                <div class="col">
                    <div class="row">
                        <div class="col">

                                <abbr title="Agregar a Programación">
                                    <button class=" botonprincipal" onclick="agregar_a_programacion()" > <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                        </svg> Programación </button>
                                </abbr>

                        </div>

                        <div class="col">
                            <abbr title="Revisar Programacion actual">
                                <a href="" wire:click.prevent="cambio(2)"> <button class="botonprincipal">
                                        Ver</button></a>
                            </abbr>
                        </div>
                    </div>
                </div>
                @endif
                <div class="col">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle form-control" type="button"
                            id="dropdownMenuButton1" data-toggle="dropdown">
                            Categorias
                        </button>
                        <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton1">
                            <div class="form-check ">
                                <input class="form-check-input form-control" type="checkbox" value="1" wire:model="r_uno"
                                    id="checkbox1E" name="checkbox1E" checked>
                                <label class="form-check-label " for="flexCheckDefault"> NEW ROLL </label>
                            </div>

                            <div class="form-check ">
                                <input class="form-check-input form-control" type="checkbox" value="2" wire:model="r_dos"
                                    id="checkbox2E" name="checkbox2E" checked>
                                <label class="form-check-label " for="flexCheckChecked"> CATALOGO </label>
                            </div>

                            <div class="form-check ">
                                <input class="form-check-input form-control" type="checkbox" value="3" wire:model="r_tres"
                                    id="checkbox3E" name="checkbox3E" checked>
                                <label class="form-check-label " for="flexCheckDefault"> INVENTARIO EXISTENTE
                                </label>
                            </div>

                            <div class="form-check ">
                                <input class="form-check-input form-control" type="checkbox" value="4" wire:model="r_cuatro"
                                    id="checkbox4E" name="checkbox4E" checked>
                                <label class="form-check-label " for="flexCheckChecked"> WAREHOUSE </label>
                            </div>
                        </ul>
                    </div>
                </div>

                <div class="col">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle form-control" type="button"
                            id="dropdownMenuButton1" data-toggle="dropdown">
                            Presentacion
                        </button>
                        <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton1">
                            <div class="form-check ">
                                <input class="form-check-input" type="checkbox" value="Puros Tripa Larga" id="checkbox5"
                                    checked name="checkbox5" wire:model="r_cinco">
                                <label class="form-check-label " for="flexCheckDefault"> Puros Tripa Larga </label>
                            </div>

                            <div class="form-check ">
                                <input class="form-check-input" type="checkbox" value="Puros Tripa Corta" id="checkbox6"
                                    checked name="checkbox6" wire:model="r_seis">
                                <label class="form-check-label " for="flexCheckChecked"> Puros Tripa Corta </label>
                            </div>

                            <div class="form-check ">
                                <input class="form-check-input " type="checkbox" value="Puros Sandwich" id="checkbox7"
                                    checked name="checkbox7" wire:model="r_siete">
                                <label class="form-check-label " for="flexCheckDefault"> Puros Sandwich
                                </label>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="col" wire:ignore>
                    <select onchange="buscar_tabla()" onclick="funcion1()" name="b_mes" id="b_mes"
                        class=" mi-selector form-control" style="width:100%;height:34px;">
                        <option value="" style="overflow-y: scroll;">Todos los meses</option>
                        @foreach($mes_p as $mes)
                        <option style="overflow-y: scroll;"> {{$mes->mes}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col" wire:ignore>
                    <select onchange="buscar_tabla()" onclick="funcion1()" name="b_item" id="b_item"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                        <option value="" style="overflow-y: scroll;">Todos Items</option>
                        @foreach($items_p as $item)
                        <option style="overflow-y: scroll;"> {{$item->item}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col" wire:ignore>
                    <select onchange="buscar_tabla()" onclick="funcion1()" name="b_orden" id="b_orden"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                        <option value="" style="overflow-y: scroll;">Todas las ordenes del sistema</option>
                        @foreach($ordenes_p as $orden)
                        <option style="overflow-y: scroll;"> {{$orden->orden_del_sitema}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col" wire:ignore>
                    <select onchange="buscar_tabla()" onclick="funcion1()" name="b_hon" id="b_hon"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                        <option value="" style="overflow-y: scroll;">Todas las ordenes</option>
                        @foreach($hons_p as $hon)
                        <option style="overflow-y: scroll;"> {{$hon->orden}}</option>
                        @endforeach
                    </select>
                </div>

            </div>


            <div class="row">

                <div class="col">
                    <div class="row">
                        @if(auth()->user()->rol == -1)

                @else
                        <div class="col" wire:ignore>

                            <abbr title="Agregar a Pendiente Empaque">
                                <button class=" botonprincipal" data-toggle="modal" data-target="#productos_crear_empaque">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-plus-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg> Nuevo </button>
                            </abbr>
                        </div>

                        @endif
                        <div class="col">
                            <abbr title="Exportar a excel">
                                <button class=" botonprincipal" wire:click="exportPendiente()"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
                                        <path
                                            d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z" />
                                    </svg> Exportar </button>
                            </abbr>
                        </div>
                    </div>
                </div>

                <div class="col" wire:ignore>
                    <select onchange="buscar_tabla()" onclick="funcion1()" name="b_marca" id="b_marca"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                        <option value="" style="overflow-y: scroll;">Todas las marcas</option>
                        @foreach($marcas_p as $marca)
                        <option style="overflow-y: scroll;"> {{$marca->marca}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col" wire:ignore>
                    <select onchange="buscar_tabla()" onclick="funcion1()" name="b_vitola" id="b_vitola"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                        <option value="" style="overflow-y: scroll;">Todas las vitolas</option>
                        @foreach($vitolas_p as $vitola)
                        <option style="overflow-y: scroll;"> {{$vitola->vitola}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col" wire:ignore>
                    <select onchange="buscar_tabla()" onclick="funcion1()" name="b_nombre" id="b_nombre"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                        <option value="" style="overflow-y: scroll;">Todos los nombres</option>
                        @foreach($nombre_p as $nombre)
                        <option style="overflow-y: scroll;"> {{$nombre->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col" wire:ignore>
                    <select onchange="buscar_tabla()" onclick="funcion1()" name="b_capa" id="b_capa"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                        <option value="" style="overflow-y: scroll;">Todas las capas</option>
                        @foreach($capas_p as $capa)
                        <option style="overflow-y: scroll;"> {{$capa->capa}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col" wire:ignore>
                    <select onchange="buscar_tabla()" onclick="funcion1()" name="b_empaque" id="b_empaque"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                        <option value="" style="overflow-y: scroll;">Todos los empaques</option>
                        @foreach($empaques_p as $empaque)
                        <option style="overflow-y: scroll;"> {{$empaque->empaque}}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="row">
                <div class="col">
                    <nav>
                        <ul class="pagination justify-content-center">

                            <li class="page-item">
                                <a class="page-link" href="#" tabindex="-1" wire:click="mostrar_todo(0)">Dividir</a>
                            </li>
                            @php
                            $cantida = 1;
                            @endphp
                            @for ($i = 0; $i < $tuplas_conteo ; $i+=100) <li class="page-item"><a class="page-link" href="#"
                                    wire:click="paginacion_numerica({{$i}})">{{$cantida}}</a></li>
                                @php
                                $cantida++;
                                @endphp

                                @endfor
                                @php
                                $cantida = 1;
                                @endphp
                                <li class="page-item">
                                    <a class="page-link" href="#" wire:click="mostrar_todo(1)">Mostrar Todo</a>
                                </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="panel-body" style="padding:0px;">
            <div style="width:100%; padding-left:0px;   font-size:10px;   display: block;
            overflow-x: auto;
         height:450px;">
                <table class="table table-light" style="font-size:10px;" id="tabla_pendiente_empaque">
                    <thead style="width:100px;">
                        <tr>
                            <th>N#</th>
                            <th>CATEGORIA</th>
                            <th>ITEM</th>
                            <th>CODIGO CAJA</th>
                            <th>ORDEN DEL SISTEMA</th>
                            <th>OBSERVACÓN</th>
                            <th>PRESENTACIÓN</th>
                            <th>MES</th>
                            <th>ORDEN</th>
                            <th>MARCA</th>
                            <th>VITOLA</th>
                            <th>NOMBRE</th>
                            <th>CAPA</th>
                            <th>TIPO DE EMPAQUE</th>
                            <th>CANT. CAJAS</th>
                            <th>ANILLO</th>
                            <th>CELLO</th>
                            <th>UPC</th>
                            <th>PENDIENTE</th>
                            <th>SALDO</th>
                            <th>BODEGAS</th>
                            @if(auth()->user()->rol == -1)

                            @else
                            <th>OPERACIONES</th>
                            @endif
                        </tr>
                    </thead>
                    <?php $sumase = 0 ; $sumape = 0; ?>
                    <tbody name="bodyE" id="bodyE">
                        @foreach($datos_pendiente_empaque as $i => $datos)
                        <tr>
                            <td>{{++$i}}</td>
                            <td style="width:100px; max-width: 400px;overflow-x:auto;">
                                {{isset($datos->categoria)?($datos->categoria):"Sin categoria"}}</td>
                            <td>{{isset($datos->item)?($datos->item):""}}</td>
                            <td>
                                @php
                                    $codigo_de_caja = DB::select('select codigo_caja from clase_productos where item = ?', [(isset($datos->item)?($datos->item):"")]);
                                @endphp
                                {{$codigo_de_caja[0]->codigo_caja}}
                            </td>
                            <td>{{isset($datos->orden_del_sitema)?($datos->orden_del_sitema):""}}</td>

                            <td style="width:100px;">{{$datos->observacion}}</td>
                            <td style="width:100px;">{{$datos->presentacion}}</td>
                            <td>{{$datos->mes}}</td>

                            <td style="width:100px;">{{$datos->orden}}</td>
                            <td style="width:100px;">{{$datos->marca}}</td>
                            <td>{{$datos->vitola}}</td>

                            <td>{{$datos->nombre}}</td>
                            <td>{{$datos->capa}}</td>
                            <td>{{$datos->tipo_empaque}}</td>

                            <td>{{$datos->cant_cajas}}</td>
                            <td>{{$datos->anillo}}</td>
                            <td>{{$datos->cello}}</td>

                            <td>{{$datos->upc}}</td>
                            <td>{{$datos->pendiente}}</td>
                            <td>{{$datos->saldo}}</td>
                            <td>
                                @php

                                @endphp
                            </td>
                            @if(auth()->user()->rol == -1)

                            @else
                            <td style="text-align:center;">

                                <?php
                                    echo' <a style=" width:20px; height:20px;" ';
                                    echo'type="submit" wire:click.prevent= "insertar_detalle_provicional_sin_existencia('.$datos->id_pendiente.')">';

                                    echo'<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"';
                                    echo'    class="bi bi-arrow-up-right-square-fill" viewBox="0 0 16 16">';
                                    echo'    <path';
                                    echo'        d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12zM5.904 10.803 10 6.707v2.768a.5.5 0 0 0 1 0V5.5a.5.5 0 0 0-.5-.5H6.525a.5.5 0 1 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 .707.707z" />';
                                    echo'</svg>';
                                    echo'</a>';

                                    echo'<a style=" width:20px; height:20px;" data-toggle="modal" href=""';
                                    echo'             data-target="#modal_actualizar" type="submit"';
                                    echo'        onclick="datos_modal_actualizar(' .$datos->id_pendiente. ')">';
                                    echo'        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"';
                                    echo'            class="bi bi-pencil-square" viewBox="0 0 16 16">';
                                    echo'            <path';
                                    echo'                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />';
                                    echo'            <path fill-rule="evenodd"';
                                    echo'                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />';
                                    echo'        </svg>';
                                    echo'    </a>';


                                    echo'<a data-toggle="modal" data-target="#modal_eliminar_detalle"';
                                    echo'    onclick="datos_modal_eliminar(' .$datos->id_pendiente. ')" href="">';
                                    echo'    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"';
                                    echo'        class="bi bi-trash-fill" viewBox="0 0 16 16">';
                                    echo'        <path';
                                    echo'            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />';
                                    echo'    </svg></a>';
                                ?>


                            </td>
                            @endif
                        </tr>

                        <?php $sumase = $sumase + $datos->saldo;
                                 $sumape = $sumape + $datos->pendiente; ?>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="input-group" style="width:30%;position: fixed;right: 0px;bottom:0px; height:30px;">
            <span class="form-control input-group-text">Total pendiente</span>
            <input type="text" class="form-control" id="sumape" value="{{$sumape}}">

            <span class="form-control input-group-text">Total saldo</span>
            <input type="text" class="form-control" id="sumase" value="{{$sumase}}">
        </div>
    </div>





    <!-- INICIO MODAL CREAR DATO PENDIENTE -->
    <div wire:ignore class="modal fade" id="productos_crear_empaque" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="productos_crear_empaqueLabel" aria-hidden="true"
        style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-lg">
            <!-- INICIO DEL MODAL NUEVO PRODUCTO -->
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="staticBackdropLabel"><strong>Agregar producto</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </div>

                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Item</label>
                                <select name="itemn" id="itemn" style="height:30px; width: 100%;"
                                    class="form-control itema_nuevo" required type="text" autocomplete="off">
                                    <option value="">Todos los items</option>
                                    @foreach ($items_p as $items)
                                    <option value="{{$items->item}}">{{$items->item}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Categoria</label>
                                <select class="form-control" name="categoria" id="categoria"
                                    style="overflow-y: scroll; height:30px;" required>
                                    <option value="1">NEW ROLL</option>
                                    <option value="2">CATALOGO</option>
                                    <option value="3">TAKE FROM EXISTING INVENT</option>
                                    <option value="4">INTERNATIONAL SALES</option>
                                </select>
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_malos" class="form-label">Presentación</label>
                                <input class="form-control" name="presentacionn" id="presentacionn"
                                    wire:model='presentacion' placeholder="Ingresa figura y tipo"
                                    style="overflow-y: scroll; height:30px;" disabled>
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_vitola" class="form-label">Marca</label>
                                <input style=" height:30px; width: 100%;" name="marcan" id="marcan"
                                    wire:model='marcas_nuevo' placeholder="Ingresa figura y tipo" disabled>

                            </div>
                        </div>


                        <div class="row">
                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Capa</label>
                                <input style=" height:30px; width: 100%;" name="capan" id="capan"
                                    wire:model='capas_nuevo' placeholder="Ingresa figura y tipo" disabled>
                            </div>


                            <div class="mb-3 col">
                                <label for="txt_malos" class="form-label">Tipo de
                                    empaque</label>
                                <input style=" height:30px; width: 100%;" name="tipon" id="tipon"
                                    wire:model='tipo_empaques_nuevo' placeholder="Ingresa figura y tipo" disabled>
                            </div>


                            <div class="mb-3 col">
                                <label for="vitola" class="form-label">Vitola</label>
                                <input style=" height:30px; width: 100%;" name="vitolan" wire:model='vitolas_nuevo'
                                    id="vitolan" placeholder="Ingresa figura y tipo" disabled>
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_total" class="form-label">Nombre</label>
                                <input style=" height:30px; width: 100%;" name="nombren" wire:model='nombres_nuevo'
                                    id="nombren" placeholder="Ingresa figura y tipo" disabled>

                            </div>
                        </div>


                        <div class="row">

                            <div class="mb-2 col">
                                <label for="txt_figuraytipo" class="form-label">Orden del sistema</label>
                                <input name="ordensis" id="ordensis" style="font-size:16px" class="form-control"
                                    type="text" autocomplete="off">
                            </div>

                            <div class="mb-2 col">
                                <label for="txt_figuraytipo" class="form-label">Orden</label>
                                <input name="ordenn" id="ordenn" style="font-size:16px" class="form-control" required
                                    type="text" autocomplete="off">
                            </div>


                            <div class="mb-2 col">
                                <label for="txt_figuraytipo" class="form-label">Fecha</label>
                                <input value="{{Carbon\Carbon::now()->format('Y-m-d')}}" name=" fechan" id="fechan"
                                    style="font-size:12px" class="form-control" required type="date" autocomplete="off">
                            </div>

                            <div class="mb-2 col">
                                <label for="txt_total" class="form-label">Pendiente</label>
                                <input name="pendienten" id="pendienten" class="form-control" required type="number"
                                    autocomplete="off">
                            </div>

                            <div class="mb-2 col">
                                <label for="txt_buenos" class="form-label">Saldo</label>
                                <input name="saldon" id="saldon" class="form-control" required type="number"
                                    autocomplete="off">
                            </div>

                        </div>
                        <div class="row">
                            <div class="mb-6 col">
                                <label for="txt_figuraytipo" class="form-label">Observacion</label>
                                <input name="observacionn" id="observacionn" style="font-size:16px" class="form-control"
                                    type="text" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class=" bmodal_no" data-dismiss="modal"><span>Cancelar</span>
                        @csrf
                    </button>
                    <button onclick="insertar_nuevo_pendiente()" class=" bmodal_yes "> <span>Guardar</span>
                    </button>
                </div>
            </div>

        </div>
        <!-- FIN DEL MODAL NUEVO PRODUCTO -->
    </div>
    <!-- FIN MODAL CREAR DATO PENDIENTE -->

    <!-- INICIO MODAL ACTUALIZAR DATO PENDIENTE -->
    <div class="modal fade" role="dialog" id="modal_actualizar" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
        style="opacity:.9;background:#212529;width=800px;">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="opacity:.9;background:#212529;width=80%">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="staticBackdropLabel"><strong>Descripción del producto: </strong><span id="tituloupdate"
                            name="tituloupdate"></span></h5>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <input name="id_pendientea2" id="id_pendientea2" value="" hidden />

                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Orden del sistema</label>
                            <input name="orden_sistema2" id="orden_sistema2" class="form-control" type="text"
                                autocomplete="off">
                        </div>
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Orden</label>
                            <input name="orden2" id="orden2" class="form-control" type="text" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Pendiente</label>
                            <input name="pendiente2" id="pendiente2" class="form-control" type="text"
                                autocomplete="off">
                        </div>
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Saldo</label>
                            <input name="saldo2" id="saldo2" class="form-control" type="text" autocomplete="off">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Observación</label>
                            <input name="observacion2" id="observacion2" class="form-control" type="text"
                                autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="bmodal_no" data-dismiss="modal">
                        <span>Cancelar</span>
                    </button>
                    <button type="button" class="bmodal_yes" onclick="guardar_actualizacion()">
                        <span>Actualizar</span>
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- FIN MODAL ACTUALIZAR DATO PENDIENTE -->

    <!-- INICIO MODAL ELMINAR DATO PENDIENTE -->
    <div class="modal fade" id="modal_eliminar_detalle" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Eliminar <strong><input value="" id="txt_usuarioE"
                                name="txt_usuarioE" style="border:none;"></strong> </h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input name="id_pendiente3" id="id_pendiente3" value="" hidden />

                    ¿Estás seguro que quieres eliminar este registro del pendiente?
                </div>
                <div class="modal-footer">
                    <button type="button" class="bmodal_no " data-dismiss="modal">
                        <span>Cancelar</span>
                    </button>
                    <button type="button" onclick="eliminar_pendiente()" class=" bmodal_yes ">
                        <span>Eliminar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL ELMINAR DATO PENDIENTE -->



        <!-- INICIO MODAL ELMINAR TODO DETALLE PROGRAMACION -->
        <div class="modal fade" id="modal_eliminar_tabla_progra" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Advertencia</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro que quieres limpiar estos registros?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="bmodal_no" data-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button wire:click="eliminar_datos()" class=" bmodal_yes ">
                            <span>Eliminar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN MODAL ELMINAR TODO DETALLE DETALLE PROGRAMACION -->


    {{-- JavaScript detalle programacion --}}
    @push('scripts')
    <script type="text/javascript">
        function datos_modal_eliminar(id) {
            var datastiles = @this.datos_pendiente_empaque;
            for (var i = 0; i < datastiles.length; i++) {
                if (datastiles[i].id_pendiente === id) {
                    document.getElementById('id_pendiente3').value = datastiles[i].id_pendiente;
                }
            }
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.itema_nuevo').select2({
                dropdownParent: $('#productos_crear_empaque')
            });
        });
    </script>
    <script type="text/javascript">
        function addexportar() {
            var theForm = document.forms['insertar_detalle_provicional'];
            theForm.addEventListener('submit', function (event) {});

        }
    </script>
    <script>
        function buscar_tabla() {
            @this.busqueda_items_p = $('#b_item').val();
            @this.busqueda_marcas_p = $('#b_marca').val();
            @this.busqueda_nombre_p = $('#b_nombre').val();
            @this.busqueda_vitolas_p = $('#b_vitola').val();
            @this.busqueda_capas_p = $('#b_capa').val();
            @this.busqueda_empaques_p = $('#b_empaque').val();
            @this.busqueda_mes_p = $('#b_mes').val();
            @this.busqueda_items_p = $('#b_item').val();
            @this.busqueda_ordenes_p = $('#b_orden').val();
            @this.busqueda_hons_p = $('#b_hon').val();
            @this.paginacion = 0;
        }

        $('#itemn').on('change', function (e) {
            var data = $('#itemn').select2("val");
            @this.set('codigo_item', data);
            @this.agregar_productos();
        });

        window.addEventListener('notificacionconfirmacion', event => {
            toastr.success('La inserción realizada con exito.', 'Completado!');
            $("#productos_crear_empaque").removeClass("in");
            $(".modal-backdrop").remove();
            $("#productos_crear_empaque").hide();
        })

        window.addEventListener('notificacionconfirmacionUpdate', event => {
            toastr.success('Actualización realizada con exito.', 'Completado!');
            $("#modal_actualizar").removeClass("in");
            $(".modal-backdrop").remove();
            $("#modal_actualizar").hide();
        })

        window.addEventListener('notificacionErrorUpdate', event => {
            toastr.error('Hay campos erroneos.\n' + event.detail.mensaje, 'Error!');
        })

        window.addEventListener('notificacionErrorInsert', event => {
            toastr.error('Hay campos erroneos.\n' + event.detail.mensaje, 'Error!');
        })

        window.addEventListener('notificacionConfirmacionDelete', event => {
            toastr.success('Se elimino correctamente.', 'Completado!');
            $("#modal_eliminar_detalle").removeClass("in");
            $(".modal-backdrop").remove();
            $("#modal_eliminar_detalle").hide();
        })
    </script>
    @endpush


    <script>
        function eliminar_pendiente() {
            @this.eliminar_pendiente({
                'id_pendiente3': $('#id_pendiente3').val()
            });
        }

        function guardar_actualizacion() {
            if ($('#id_pendientea2').val() == "" || $('#orden_sistema2').val() == "" || $('#orden2').val() == "" ||
                $('#pendiente2').val() == "" || $('#saldo2').val() == "") {
                toastr.info('Hay campos requeridos vacios.', 'Advertencia!');
            } else {

                @this.actualizar_pendiente({
                    'id_pendientea2': $('#id_pendientea2').val(),
                    'orden_sistema2': $('#orden_sistema2').val(),
                    'orden2': $('#orden2').val(),
                    'pendiente2': $('#pendiente2').val(),
                    'saldo2': $('#saldo2').val(),
                    'observacion2': $('#observacion2').val()
                });

                event.preventDefault();
            }
        }

        function insertar_nuevo_pendiente() {

            if ($('#categoria').val() == "" || $('#itemn').val() == "" ||
                $('#ordensis').val() == "" ||
                $('#fechan').val() == "" || $('#ordenn').val() == "" ||
                $('#pendienten').val() == "" || $('#saldon').val() == "") {
                toastr.info('Hay compos requeridos vacios.', 'Advertencia!');
            } else {

                @this.insertar_nuevo_pendiente({
                    'categoria': $('#categoria').val(),
                    'itemn': $('#itemn').val(),
                    'ordensis': $('#ordensis').val(),
                    'observacionn': $('#observacionn').val(),
                    'fechan': $('#fechan').val(),
                    'ordenn': $('#ordenn').val(),
                    'pendienten': $('#pendienten').val(),
                    'saldon': $('#saldon').val()
                });
                event.preventDefault();
            }
        }


    </script>
    <script type="text/javascript">
        function datos_modal_actualizar(id) {

            var data = @json($datos_pendiente_empaque);

            for (var i = 0; i < data.length; i++) {
                if (data[i].id_pendiente === id) {
                    document.actualizar_pendiente.id_pendientea.value = data[i].id_pendiente;
                    document.actualizar_pendiente.saldo.value = data[i].saldo;
                    document.actualizar_pendiente.pendiente.value = data[i].pendiente;
                    document.actualizar_pendiente.observacion.value = data[i].observacion;
                }
            }
        }
    </script>
    <script type="text/javascript">
        function datos_modal_eliminar(id) {

            var datastiles = @json($datos_pendiente_empaque);

            for (var i = 0; i < datastiles.length; i++) {
                if (datastiles[i].id_pendiente === id) {
                    document.formulario_mostrarE.id_pendiente.value = datastiles[i].id_pendiente;
                }
            }

        }
    </script>


    {{-- JavaScript detalle programacion --}}
    <script type="text/javascript">
        function datos_modal_actualizar(id) {
            var datas = '<?php echo json_encode($detalles_provicionales);?>';

            var data = JSON.parse(datas);


            for (var i = 0; i < data.length; i++) {
                if (data[i].id === id) {
                    document.form_saldo.saldo.value = data[i].saldo;

                    document.form_saldo.id_detalle.value = data[i].id;

                    document.form_saldo.id_pendientea.value = data[i].id_pendiente;

                    document.form_saldo.cant_cajas.value = data[i].cant_cajas;

                    document.form_saldo.saldo_viejo.value = data[i].cant_cajas_necesarias;



                }
            }
        }
    </script>

    <script type="text/javascript">
        function eliminar_detalle_prgramacion(id){
            var mensaje = confirm("¿Estás seguro que quieres eliminar este registro?");
            if (mensaje) {
                @this.eliminar_Detalles(id);
            } else {

            }
        }

        function agregar_a_programacion(){
            var mensaje = confirm("¿Estás seguro que deseas agregar todos estos registros a la programación?");
            if (mensaje) {
                @this.insertar_detalle_provicional();
            } else {

            }
        }

        function editar_saldo(id){
            var saldo = prompt("Actualizar saldo", "Nuevo saldo");
                if (saldo != null) {
                    @this.actualizar_saldo(id,saldo);
                }
        }



    </script>

</div>
