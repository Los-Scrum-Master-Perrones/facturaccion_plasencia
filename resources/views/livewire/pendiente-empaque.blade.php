<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hola</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('css/tabla.js') }}"></script>
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">




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


        <div class="col" style="height:66px;">
            <div class="row" style="margin-bottom:2px">

                <div class="col">
                    <form wire:submit.prevent="insertar_detalle_provicional()">
                        @csrf
                        <button class="mr-sm-2 botonprincipal" style="width:200px;">Agregar Programación </button>
                    </form>
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
                                    wire:model="r_uno" id="checkbox1E">
                                <label class="form-check-label " for="flexCheckDefault"> NEW ROLL </label>
                            </div>

                            <div class="form-check ">
                                <input class="form-check-input form-control" type="checkbox" value="2"
                                    wire:model="r_dos" id="checkbox2E">
                                <label class="form-check-label " for="flexCheckChecked"> CATALOGO </label>
                            </div>

                            <div class="form-check ">
                                <input class="form-check-input form-control" type="checkbox" value="3"
                                    wire:model="r_tres" id="checkbox3E">
                                <label class="form-check-label " for="flexCheckDefault"> INVENTARIO EXISTENTE </label>
                            </div>

                            <div class="form-check ">
                                <input class="form-check-input form-control" type="checkbox" value="4"
                                    wire:model="r_cuatro" id="checkbox4E">
                                <label class="form-check-label " for="flexCheckChecked"> WAREHOUSE </label>
                            </div>
                        </ul>
                    </div>
                </div>


                <div class="col">
                    <select onchange="buscar_tablaE()" onclick="funcion1()" name="b_mesE" id="b_mesE"
                        class=" mi-selector form-control" style="width:100%;height:34px;">
                        <option value="" style="overflow-y: scroll;">Todos los meses</option>
                        @foreach($mes_p as $mes)
                        <option style="overflow-y: scroll;"> {{$mes->mes}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <select onchange="buscar_tablaE()" onclick="funcion1()" name="b_itemE" id="b_itemE"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]" required>
                        <option value="" style="overflow-y: scroll;">Todos Items</option>
                        @foreach($items_p as $item)
                        <option style="overflow-y: scroll;"> {{$item->item}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <select onchange="buscar_tablaE()" onclick="funcion1()" name="b_ordenE" id="b_ordenE"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]" required>
                        <option value="" style="overflow-y: scroll;">Todas las ordenes del sistema</option>
                        @foreach($ordenes_p as $orden)
                        <option style="overflow-y: scroll;"> {{$orden->orden_del_sitema}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <select onchange="buscar_tablaE()" onclick="funcion1()" name="b_honE" id="b_honE"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]" required>
                        <option value="" style="overflow-y: scroll;">Todas las ordenes</option>
                        @foreach($hons_p as $hon)
                        <option style="overflow-y: scroll;"> {{$hon->orden}}</option>
                        @endforeach
                    </select>
                </div>

            </div>


            <div class="row">

                <div class="col">
                    <a href="/detalles_programacion"> <button class="mr-sm-2 botonprincipal" style="width:200px;">
                            Ver</button></a>
                </div>

                <div class="col">
                    <select onchange="buscar_tablaE()" onclick="funcion1()" name="b_marcaE" id="b_marcaE"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]" required>
                        <option value="" style="overflow-y: scroll;">Todas las marcas</option>
                        @foreach($marcas_p as $marca)
                        <option style="overflow-y: scroll;"> {{$marca->marca}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <select onchange="buscar_tablaE()" onclick="funcion1()" name="b_vitolaE" id="b_vitolaE"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]" required>
                        <option value="" style="overflow-y: scroll;">Todas las vitolas</option>
                        @foreach($vitolas_p as $vitola)
                        <option style="overflow-y: scroll;"> {{$vitola->vitola}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <select onchange="buscar_tablaE()" onclick="funcion1()" name="b_nombreE" id="b_nombreE"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]" required>
                        <option value="" style="overflow-y: scroll;">Todos los nombres</option>
                        @foreach($nombre_p as $nombre)
                        <option style="overflow-y: scroll;"> {{$nombre->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <select onchange="buscar_tablaE()" onclick="funcion1()" name="b_capaE" id="b_capaE"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]" required>
                        <option value="" style="overflow-y: scroll;">Todas las capas</option>
                        @foreach($capas_p as $capa)
                        <option style="overflow-y: scroll;"> {{$capa->capa}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <select onchange="buscar_tablaE()" onclick="funcion1()" name="b_empaqueE" id="b_empaqueE"
                        class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]" required>
                        <option value="" style="overflow-y: scroll;">Todos los empaques</option>
                        @foreach($empaques_p as $empaque)
                        <option style="overflow-y: scroll;"> {{$empaque->empaque}}</option>
                        @endforeach
                    </select>
                </div>

            </div>

        </div>
    </div>

    <form wire:submit.prevent="exportPendiente()">
        <input type="text" value="{{isset($nom)?$nom:null}}" name="nombre" id="nombre" hidden wire:model="nom">
        <input type="date" value="{{isset($fede)?$fede:null}}" name="fecha_de" id="fecha_de" hidden wire:model="fede">

    </form>






    <div class="panel-body" style="padding:0px;">
        <div style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;
     height:450px;">
            @csrf
            <table class="table table-light" style="font-size:10px;" id="tabla_pendiente_empaque">
                <thead>
                    <tr>
                        <th style="width:100px;">CATEGORIA</th>
                        <th>ITEM</th>
                        <th>ORDEN DEL SISTEMA</th>
                        <th>OBSERVACÓN</th>
                        <th>PRESENTACIÓN</th>
                        <th>MES</th>
                        <th>ORDEN</th>
                        <th style="width:100px;">MARCA</th>
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
                    @foreach($datos_pendiente_empaque as $datos)
                    <tr>
                        <td style="width:100px; max-width: 400px;overflow-x:auto;">
                            {{isset($datos->categoria)?($datos->categoria):"Sin categoria"}}</td>
                        <td>{{isset($datos->item)?($datos->item):""}}</td>
                        <td>{{isset($datos->orden_del_sitema)?($datos->orden_del_sitema):""}}</td>

                        <td>{{$datos->observacion}}</td>
                        <td>{{$datos->presentacion}}</td>
                        <td>{{$datos->mes}}</td>

                        <td>{{$datos->orden}}</td>
                        <td>{{$datos->marca}}</td>
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

                       echo'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"';
                       echo'    class="bi bi-arrow-up-right-square-fill" viewBox="0 0 16 16">';
                       echo'    <path';
                       echo'        d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12zM5.904 10.803 10 6.707v2.768a.5.5 0 0 0 1 0V5.5a.5.5 0 0 0-.5-.5H6.525a.5.5 0 1 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 .707.707z" />';
                       echo'</svg>';
                       echo'</a>';

                       echo'<a style=" width:20px; height:20px;" data-toggle="modal" href=""';
                       echo'             data-target="#modal_actualizar" type="submit"';
                       echo'        onclick="datos_modal_actualizar(` + data[i].id_pendiente + `,` + data[i].item + `)">';
                       echo'        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"';
                       echo'            class="bi bi-pencil-square" viewBox="0 0 16 16">';
                       echo'            <path';
                       echo'                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />';
                       echo'            <path fill-rule="evenodd"';
                       echo'                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />';
                       echo'        </svg>';
                       echo'    </a>';
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





        <script type="text/javascript">
            function buscar_tablaE() {
                $('.mi-selector').select2();

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



                var data = @json($datos_pendiente_empaque);



                if (b_orden == "" && b_item == "" && b_hon == "" && b_mes == "" && b_marca == "" &&
                    b_vitola == "" && b_capa == "" && b_nombre == "" && b_empaque == "") {



                    document.getElementById('checkbox1E').value = checkbox1;
                    document.getElementById('checkbox2E').value = checkbox2;
                    document.getElementById('checkbox3E').value = checkbox3;
                    document.getElementById('checkbox4E').value = checkbox4;
                } else {
                    var sumase = 0;
                    var sumape = 0;
                    for (var i = 0; i < data.length; i++) {
                        try {


                            console.log(data[i].marca);

                            if (data[i].marca.toLowerCase().match(b_marca.toLowerCase()) &&
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

                                var tabla_nuevaE =
                                    `<tr>
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

                            <a style=" width:10px; height:10px;" data-toggle="modal" href=""
                                    data-target="#modal_actualizar" type="submit"
                                    onclick="datos_modal_actualizar(` + data[i].id_pendiente + `,` + data[i].item + `)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </a>


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
                var datas = '<?php echo json_encode($datos_pendiente_empaque_nuevo);?>';
                var data = JSON.parse(datas);
                for (var i = 0; i < data.length; i++) {
                    if (data[i].id_pendiente === id) {
                        document.actualizar_pendiente.id_pendientea.value = data[i].id_pendiente;
                        document.actualizar_pendiente.saldo.value = data[i].saldo;
                    }
                }
            }
        </script>

        <script type="text/javascript">
            function funcion1() {
                $('.mi-selector').select2();
            }
        </script>








        <!-- FIN MODAL ACTUALIZAR DATO PENDIENTE -->


    </div>
