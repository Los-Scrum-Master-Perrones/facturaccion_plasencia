<div xmlns:wire="http://www.w3.org/1999/xhtml">

    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a style="color:#E5B1E2; font-size:12px;" href="pendiente_empaque"><strong>Pendiente</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="importar_c"><strong>Existencia en bodega</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="inventario_cajas"><strong>Existencia de cajas</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white; font-size:12px; " href="historial_programacion"><strong>Programaciones</strong></a>
        </li>
    </ul>

    <div class="container" style="max-width:100%; ">
    <form action =  "{{Route('insertar_detalle_provicional')}}" method= "POST" >
@csrf

        <div class="col" style="height:66px;">
            <div class="row" style="margin-bottom:2px">

            <div class="col" >
                  <div class="row" >
                  <div class="col" >

                   <abbr title="Agregar a Programación">
                   <button class=" botonprincipal" onclick="addexportar(1)" > <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg> Programación </button>
                    </abbr>
                     </div>

                     <div class="col" >
                   <abbr title="Revisar Programacion actual">
                     <a href="/detalles_programacion"> <button onclick="addexportar(2)" class="botonprincipal"> Ver</button></a>
                    </abbr>
                    </div>
                    </div>
                      </div>

                 <div class="col">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle form-control" type="button"
                            id="dropdownMenuButton1" data-toggle="dropdown">
                            Categorias
                        </button>
                        <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton1">
                            <div class="form-check ">
                                <input class="form-check-input form-control" type="checkbox" value="1"
                                    wire:model="r_uno" id="checkbox1E"  name="checkbox1E" checked>
                                <label class="form-check-label " for="flexCheckDefault"> NEW ROLL </label>
                            </div>

                            <div class="form-check ">
                                <input class="form-check-input form-control" type="checkbox" value="2"
                                    wire:model="r_dos" id="checkbox2E" name="checkbox2E" checked>
                                <label class="form-check-label " for="flexCheckChecked"> CATALOGO </label>
                            </div>

                            <div class="form-check ">
                                <input class="form-check-input form-control" type="checkbox" value="3"
                                    wire:model="r_tres" id="checkbox3E" name="checkbox3E" checked>
                                <label class="form-check-label " for="flexCheckDefault"> INVENTARIO EXISTENTE </label>
                            </div>

                            <div class="form-check ">
                                <input class="form-check-input form-control" type="checkbox" value="4"
                                    wire:model="r_cuatro" id="checkbox4E" name="checkbox4E" checked>
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
                                <input class="form-check-input" type="checkbox" value="Puros Tripa Larga" id="checkbox5" checked
                                    name="checkbox5" wire:model="r_cinco">
                                <label class="form-check-label " for="flexCheckDefault"> Puros Tripa Larga </label>
                            </div>

                            <div class="form-check ">
                                <input class="form-check-input" type="checkbox" value="Puros Tripa Corta" id="checkbox6" checked
                                    name="checkbox6" wire:model="r_seis">
                                <label class="form-check-label " for="flexCheckChecked"> Puros Tripa Corta </label>
                            </div>

                            <div class="form-check ">
                                <input class="form-check-input " type="checkbox" value="Puros Sandwich" id="checkbox7" checked
                                    name="checkbox7" wire:model="r_siete">
                                <label class="form-check-label " for="flexCheckDefault"> Puros Sandwich
                                </label>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="col" wire:ignore>
                    <select onchange="buscar_tablaE()" onclick="funcion1()" name="b_mesE" id="b_mesE"
                        class=" mi-selector form-control" style="width:100%;height:34px;">
                        <option value="" style="overflow-y: scroll;">Todos los meses</option>
                        @foreach($mes_p as $mes)
                        <option style="overflow-y: scroll;"> {{$mes->mes}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col" wire:ignore>
                    <select onchange="buscar_tablaE()" onclick="funcion1()" name="b_itemE" id="b_itemE"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]" >
                        <option value="" style="overflow-y: scroll;">Todos Items</option>
                        @foreach($items_p as $item)
                        <option style="overflow-y: scroll;"> {{$item->item}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col" wire:ignore>
                    <select onchange="buscar_tablaE()" onclick="funcion1()" name="b_ordenE" id="b_ordenE"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]" >
                        <option value="" style="overflow-y: scroll;">Todas las ordenes del sistema</option>
                        @foreach($ordenes_p as $orden)
                        <option style="overflow-y: scroll;"> {{$orden->orden_del_sitema}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col" wire:ignore>
                    <select onchange="buscar_tablaE()" onclick="funcion1()" name="b_honE" id="b_honE"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]" >
                        <option value="" style="overflow-y: scroll;">Todas las ordenes</option>
                        @foreach($hons_p as $hon)
                        <option style="overflow-y: scroll;"> {{$hon->orden}}</option>
                        @endforeach
                    </select>
                </div>

            </div>


            <div class="row">

            <div class="col" >
                  <div class="row" >
                  <div class="col" wire:ignore>

                   <abbr title="Agregar a Pendiente Empaque">
                   <button class=" botonprincipal" onclick="addexportar(3)" > <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg> Nuevo </button>
                    </abbr>
                     </div>

                     <div class="col" >
                   <abbr title="Exportar a excel">
                     <button class=" botonprincipal"  onclick="addexportar(4)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z"/>
                        </svg> Exportar </button>
                    </abbr>
                    </div>
                    </div>
                      </div>


                <div class="col" wire:ignore>
                    <select onchange="buscar_tablaE()" onclick="funcion1()" name="b_marcaE" id="b_marcaE"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]" >
                        <option value="" style="overflow-y: scroll;">Todas las marcas</option>
                        @foreach($marcas_p as $marca)
                        <option style="overflow-y: scroll;"> {{$marca->marca}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col" wire:ignore>
                    <select onchange="buscar_tablaE()" onclick="funcion1()" name="b_vitolaE" id="b_vitolaE"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]" >
                        <option value="" style="overflow-y: scroll;">Todas las vitolas</option>
                        @foreach($vitolas_p as $vitola)
                        <option style="overflow-y: scroll;"> {{$vitola->vitola}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col" wire:ignore>
                    <select onchange="buscar_tablaE()" onclick="funcion1()" name="b_nombreE" id="b_nombreE"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]" >
                        <option value="" style="overflow-y: scroll;">Todos los nombres</option>
                        @foreach($nombre_p as $nombre)
                        <option style="overflow-y: scroll;"> {{$nombre->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col" wire:ignore>
                    <select onchange="buscar_tablaE()" onclick="funcion1()" name="b_capaE" id="b_capaE"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]" >
                        <option value="" style="overflow-y: scroll;">Todas las capas</option>
                        @foreach($capas_p as $capa)
                        <option style="overflow-y: scroll;"> {{$capa->capa}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col" wire:ignore>
                    <select onchange="buscar_tablaE()" onclick="funcion1()" name="b_empaqueE" id="b_empaqueE"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]" >
                        <option value="" style="overflow-y: scroll;">Todos los empaques</option>
                        @foreach($empaques_p as $empaque)
                        <option style="overflow-y: scroll;"> {{$empaque->empaque}}</option>
                        @endforeach
                    </select>
                </div>

            </div>

        </div>
    </div>

    <input name="funcion" id="funcion" hidden>

    </form>






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
                        <th>ORDEN DEL SISTEMA</th>
                        <th >OBSERVACÓN</th>
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
                        <th>OPERACIONES</th>
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
                    </tr>

                    <?php $sumase = $sumase + $datos->saldo;
                             $sumape = $sumape + $datos->pendiente; ?>

                    @endforeach
            </table>
        </div>
        <br>

        <div class="input-group" style="width:30%;position: fixed;right: 0px;bottom:0px; height:30px;">
            <span class="form-control input-group-text">Total pendiente</span>
            <input type="text" class="form-control" id="sumape" value="{{$sumape}}">

            <span class="form-control input-group-text">Total saldo</span>
            <input type="text" class="form-control" id="sumase" value="{{$sumase}}">
        </div>









        <div style="  display: none;justify-content: center;align-items: center;  position:fixed;bottom:20%;width:100%;"
        id="div_AddProductoPendiente">
        <!-- INICIO DEL MODAL NUEVO PRODUCTO -->

        <form action="{{Route('nuevo_pendiente_empaque')}} " method="POST">
            <div data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                aria-hidden="true">
                <div>
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="staticBackdropLabel"><strong>Agregar producto</strong></h5>
                            <button type="button" class="btn-close" aria-label="Close"
                                onclick="ocultar_div_AddProductoP()"></button>
                        </div>

                        <div class="modal-body">


                            <div class="card-body">
                                <div class="row">

                                    <div class="mb-3 col">
                                        <label for="txt_figuraytipo" class="form-label">Item</label>
                                        <input name="itemn" id="itemn" style="font-size:16px" class="form-control"
                                            required type="text" autocomplete="off">
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
                                        <select class="form-control" name="presentacionn" id="presentacionn"
                                            placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;"
                                            required>
                                            <option value="Puros Tripa Larga" style="overflow-y: scroll;">Puros Tripa
                                                Larga </option>
                                            <option value="Puros Tripa Corta" style="overflow-y: scroll;">Puros Tripa
                                                Corta </option>
                                            <option value="Puros Sandwich" style="overflow-y: scroll;">Puros Sandwich
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="txt_vitola" class="form-label">Marca</label>
                                        <select class=" mi-selector" style=" height:30px; width: 100%; " name="marca"
                                            id="marca" placeholder="Ingresa figura y tipo" required>
                                            @foreach($marcas as $mar)
                                            <option style="overflow-y: scroll;"> {{$mar->marca}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>





                                <div class="row">

                                    <div class="mb-3 col">
                                        <label for="txt_figuraytipo" class="form-label">Capa</label>
                                        <select class=" mi-selector" style=" height:30px; width: 100%; " name="capa"
                                            id="capa" placeholder="Ingresa figura y tipo" required>
                                            @foreach($capas as $capa)
                                            <option style="overflow-y: scroll;"> {{$capa->capa}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 col">
                                        <label for="txt_malos" class="form-label">Tipo de
                                            empaque</label>
                                        <select class=" mi-selector" style=" height:30px; width: 100%; " name="tipo"
                                            id="tipo" placeholder="Ingresa figura y tipo" required>
                                            @foreach($tipo_empaques as $tipo_empaque)
                                            <option style="overflow-y: scroll;"> {{$tipo_empaque->tipo_empaque}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="mb-3 col">
                                        <label for="vitola" class="form-label">Vitola</label>
                                        <select class=" mi-selector" style=" height:30px; width: 100%; " name="vitola"
                                            id="vitola" placeholder="Ingresa figura y tipo" required>
                                            @foreach($vitolas as $vitola)
                                            <option style="overflow-y: scroll;"> {{$vitola->vitola}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 col">
                                        <label for="txt_total" class="form-label">Nombre</label>
                                        <select class=" mi-selector" style=" height:30px; width: 100%; " name="nombre"
                                            id="nombre" placeholder="Ingresa figura y tipo" required>
                                            @foreach($nombres as $nombre)
                                            <option style="overflow-y: scroll;"> {{$nombre->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>





                                <div class="row">

                                    <div class="mb-3 col">
                                        <label for="txt_figuraytipo" class="form-label">Orden del sistema</label>
                                        <input name="ordensis" id="ordensis" style="font-size:16px" class="form-control"
                                            type="text" autocomplete="off">
                                    </div>

                                    <div class="mb-3 col">
                                        <label for="txt_figuraytipo" class="form-label">Orden</label>
                                        <input name="ordenn" id="ordenn" style="font-size:16px" class="form-control"
                                            required type="text" autocomplete="off">
                                    </div>


                                    <div class="mb-3 col">
                                        <label for="txt_figuraytipo" class="form-label">Fecha</label>
                                        <input name="fechan" id="fechan" style="font-size:12px" class="form-control"
                                            required type="date" autocomplete="off">
                                    </div>

                                    <div class="mb-3 col">
                                        <label for="txt_figuraytipo" class="form-label">Observacion</label>
                                        <input name="observacionn" id="observacionn" style="font-size:16px"
                                            class="form-control" type="text" autocomplete="off">
                                    </div>


                                </div>















                                <div class="row">

                                    <div class="mb-3 col">
                                        <div class="row">
                                            <div class="col">
                                                <input type="checkbox" name="cello" id="cello" style="font-size:20px"
                                                    value="si">
                                                <label for="cello" class="form-label">Cello</label>
                                            </div>

                                            <div class="col">
                                                <input type="checkbox" name="anillo" id="anillo" style="font-size:20px"
                                                    value="si">
                                                <label for="anillo" class="form-label">Anillo</label>
                                            </div>

                                            <div class="col">
                                                <input type="checkbox" name="upc" id="upc" style="font-size:20px"
                                                    value="si">
                                                <label for="upc" class="form-label">UPC</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 col">
                                        <label for="txt_total" class="form-label">Pendiente</label>
                                        <input name="pendienten" id="pendienten" class="form-control" required
                                            type="number" autocomplete="off">
                                    </div>

                                    <div class="mb-3 col">
                                        <label for="txt_buenos" class="form-label">Saldo</label>
                                        <input name="saldon" id="saldon" class="form-control" required type="number"
                                            autocomplete="off">
                                    </div>


                                </div>


                                <div class="row">

                                    <div class="mb-3 col">
                                        <label for="txt_total" class="form-label">Paquetes</label>
                                        <input name="paquetes" id="paquetes" class="form-control" required type="number"
                                            autocomplete="off">
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="txt_total" class="form-label">Unidades</label>
                                        <input name="unidades" id="unidades" class="form-control" required type="number"
                                            autocomplete="off">
                                    </div>

                                    <div class="mb-3 col">
                                        <label for="txt_buenos" class="form-label">Codigo precio</label>
                                        <input name="c_precion" id="c_precion" class="form-control" type="text"
                                            autocomplete="off">
                                    </div>

                                    <div class="mb-3 col">
                                        <label for="txt_total" class="form-label">precio</label>
                                        <input name="precion" id="precion" class="form-control" type="number"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class=" bmodal_no"
                                onclick="ocultar_div_AddProductoP()"><span>Cancelar</span>
                                @csrf
                            </button>
                            <button onclick="agregarproducto()" class=" bmodal_yes "> <span>Guardar</span> </button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
        <!-- FIN DEL MODAL NUEVO PRODUCTO -->
    </div>



















        <script type="text/javascript">
            function addexportar(id) {
            var theForm = document.forms['insertar_detalle_provicional'];
                if(id == 0 ){
                   event.preventDefault();
                }else if(id == 1 ){
                    document.getElementById("funcion").value = '1';
                    theForm.addEventListener('submit', function (event) {});
                }else   if(id == 2 ){
                    document.getElementById("funcion").value = '2';
                    theForm.addEventListener('submit', function (event) {});
                }else  if(id == 3 ){
                    event.preventDefault();
                    document.getElementById('div_AddProductoPendiente').style.display = "flex";
                }else  if(id == 4 ){
                    document.getElementById("funcion").value = '4';
                    theForm.addEventListener('submit', function (event) {});
                }
            }

            function ocultar_div_AddProductoP() {
                     document.getElementById('div_AddProductoPendiente').style.display = "none";
                }
        </script>


        <script type="text/javascript">
            function buscar_tablaE() {

                var table = document.getElementById("tabla_pendiente_empaque");
                var rowCount = table.rows.length;
                var tableRows = table.getElementsByTagName('tr');
                //console.log(rowCount)

                if (rowCount <= 1) {} else {
                    for (var x = rowCount - 1; x > 0; x--) {
                        document.getElementById("bodyE").innerHTML = "";
                    }
                }

                var b_orden = document.getElementById('b_ordenE').value;
                var b_item = document.getElementById('b_itemE').value;
                var b_hon = document.getElementById('b_honE').value;
                var b_mes = document.getElementById('b_mesE').value;

                var b_marca = document.getElementById('b_marcaE').value;
                var b_vitola = document.getElementById('b_vitolaE').value;
                var b_capa = document.getElementById('b_capaE').value;
                var b_nombre = document.getElementById('b_nombreE').value;
                var b_empaque = document.getElementById('b_empaqueE').value;

                var checkbox1 = document.getElementById('checkbox1E').value;
                var checkbox2 = document.getElementById('checkbox2E').value;
                var checkbox3 = document.getElementById('checkbox3E').value;
                var checkbox4 = document.getElementById('checkbox4E').value;

                var data = @this.datos_pendiente_empaque;


                if (b_orden == "" && b_item == "" && b_hon == "" && b_mes == "" && b_marca == "" &&
                    b_vitola == "" && b_capa == "" && b_nombre == "" && b_empaque == "") {
            location.reload(true);
                } else {
                    var sumase = 0;
                    var sumape = 0;
                    var incrmenta = 0;
                    for (var i = 0; i < data.length; i++) {
                        try {

                            console.log(data[i].marca);

                            if (data[i].marca.toLowerCase().replace(/\((\w+)\)/g,'').match(b_marca.toLowerCase().replace(/\((\w+)\)/g,'')) &&
                                data[i].vitola.toLowerCase().match(b_vitola.toLowerCase()) &&
                                data[i].nombre.toLowerCase().match(b_nombre.toLowerCase()) &&
                                data[i].capa.toLowerCase().match(b_capa.toLowerCase()) &&
                                data[i].tipo_empaque.toLowerCase().match(b_empaque.toLowerCase()) &&

                                data[i].item.toLowerCase().match(b_item.toLowerCase()) &&
                                data[i].orden_del_sitema.toLowerCase().match(b_orden.toLowerCase()) &&
                                data[i].mes.toLowerCase().match(b_mes.toLowerCase()) &&
                                data[i].orden.toLowerCase().match(b_hon.toLowerCase())) {


                                sumase = sumase + data[i].saldo;
                                sumape = sumape + data[i].pendiente;



                                if (data[i].observacion == null) {
                                    data[i].observacion = "";
                                }
                                if (data[i].presentacion == null) {
                                    data[i].presentacion = "";
                                }
                                if (data[i].anillo == null) {
                                    data[i].anillo = "";
                                }
                                if (data[i].cello == null) {
                                    data[i].cello = "";
                                }
                                if (data[i].upc == null) {
                                    data[i].upc = "";
                                }
                                if (data[i].cant_cajas == null) {
                                    data[i].cant_cajas = "";
                                }
                                incrmenta++;

                                var tabla_nuevaE =
                                    `<tr>
                     <td>` + incrmenta + `</td>
                    <td>` + data[i].categoria + `</td>
                    <td>` + data[i].item + `</td>
                    <td>` + data[i].orden_del_sitema + `</td>

                    <td>` + data[i].observacion + `</td>
                    <td>` + data[i].presentacion + `</td>
                    <td>` + data[i].mes + `</td>

                    <td>` + data[i].orden + `</td>
                    <td>` + data[i].marca + `</td>
                    <td>` + data[i].vitola + `</td>

                    <td>` + data[i].nombre + `</td>
                    <td>` + data[i].capa + `</td>
                    <td>` + data[i].tipo_empaque + `</td>

                    <td>` + data[i].cant_cajas + `</td>
                    <td>` + data[i].anillo + `</td>
                    <td>` + data[i].cello + `</td>

                    <td>` + data[i].upc + `</td>
                    <td>` + data[i].pendiente + `</td>
                    <td>` + data[i].saldo + `</td>



                    <td style="text-align:center;">
                    <form  action =  "insertar_detalle_provicional_sin_existencia/` + data[i].id_pendiente + `"  method="post">
                            @csrf
                                <button style="border:none;" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-up-right-square-fill" viewBox="0 0 16 16">
                                <path
                                d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12zM5.904 10.803 10 6.707v2.768a.5.5 0 0 0 1 0V5.5a.5.5 0 0 0-.5-.5H6.525a.5.5 0 1 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 .707.707z" />
                                </svg>
                                </button>

                            </form>

                            <a style=" width:15px; height:15px;" data-toggle="modal" href=""
                                    data-target="#modal_actualizar" type="submit"
                                    onclick="datos_modal_actualizar(` + data[i].id_pendiente + `)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </a>

                                <a data-toggle="modal" data-target="#modal_eliminar_detalle"
                                onclick="datos_modal_eliminar(` + data[i].id_pendiente + `)" href="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                                    class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                </svg></a>


            </td>
                  </tr> `



                                document.getElementById("bodyE").innerHTML += tabla_nuevaE.toString();
                            }
                        } catch (error) {
                            console.error(error);
                        }
                        document.getElementById("sumase").value = sumase.toString();
                        document.getElementById("sumape").value = sumape.toString();
                    }
                }
                // fin del else
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

        <!-- FIN MODAL ACTUALIZAR DATO PENDIENTE -->



    <!-- INICIO MODAL ELMINAR DATO PENDIENTE -->
    <form action="{{Route('borrarpendienteEmpaque')}}" id="formulario_mostrarE" name="formulario_mostrarE" method="POST">

        @csrf

        <input name="id_pendiente" id="id_pendiente" value="" hidden />

        <div class="modal fade" id="modal_eliminar_detalle" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Eliminar <strong><input value=""
                                    id="txt_usuarioE" name="txt_usuarioE" style="border:none;"></strong> </h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro que quieres eliminar este registro del pendiente?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="bmodal_no " data-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button type="submit" class="bmodal_yes ">
                            <span>Eliminar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>


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


        <!-- INICIO MODAL ACTUALIZAR DATO PENDIENTE -->

    <form action="{{Route('actualizar_pendiente_empaque')}}" method="POST" id="actualizar_pendiente"
    name="actualizar_pendiente">
    <div class="modal fade" role="dialog" id="modal_actualizar" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
        style="opacity:.9;background:#212529;width=800px;">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="opacity:.9;background:#212529;width=80%">
            <div class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 id="staticBackdropLabel"><strong>Descripción del producto: </strong><span id="titulo"
                            name="titulo"></span></h5>
                </div>


                <div class="modal-body">
                    <div class="row">

                        <input name="id_pendientea" id="id_pendientea" value="" hidden />

                        <input name="itema" id="itema" value="" hidden />

                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Pendiente</label>
                            <input name="pendiente" id="pendiente" class="form-control" type="text"
                                autocomplete="off">
                        </div>

                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Saldo</label>
                            <input name="saldo" id="saldo" class="form-control" type="text"
                                autocomplete="off">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Observación</label>
                            <input name="observacion" id="observacion" class="form-control" type="text"
                                autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="bmodal_no" data-dismiss="modal">
                        <span>Cancelar</span>
                    </button>
                    <button type="submit" class="bmodal_yes">
                        <span>Actualizar</span>
                    </button>
                </div>

            </div>
        </div>
    </div>
</form>

</div>
