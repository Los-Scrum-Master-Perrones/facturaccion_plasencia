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
    <script>
        $('.mi-selector').select2();
    </script>

    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">





    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a style="color:#E5B1E2; font-size:12px;" href="pendiente"><strong>Pendiente</strong></a>
        </li>

        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="import_excel"><strong>Importar pedido</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="pendiente_salida"><strong>Reporte</strong></a>
        </li>
    </ul>



    <div class="container" style="max-width:100%;">

        <form action="{{Route('exportPendiente')}}" method="POST">
            @csrf
            <div class="col" style="height:74px;">
                <div class="row" style="margin-bottom:2px">

                    <div class="col">
                        <div class="row">
                            <div class="col">

                                <abbr title="Agregar nuevo producto">
                                    <button class="botonprincipal" onclick="mostrar_div_AddProductoP()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                            <path
                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                        </svg>Producto
                                    </button>
                                </abbr>

                            </div>



                            <div class="col">


                                <abbr title="Importar a excel">
                                    <button class="botonprincipal" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-file-earmark-spreadsheet"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z" />
                                        </svg>
                                    </button>
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
                                    <input class="form-check-input" type="checkbox" value="1" id="checkbox1" checked
                                        name="checkbox1" wire:model="r_uno">
                                    <label class="form-check-label " for="flexCheckDefault"> NEW ROLL </label>
                                </div>

                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" value="2" id="checkbox2" checked
                                        name="checkbox2" wire:model="r_dos">
                                    <label class="form-check-label " for="flexCheckChecked"> CATALOGO </label>
                                </div>

                                <div class="form-check ">
                                    <input class="form-check-input " type="checkbox" value="3" id="checkbox3" checked
                                        name="checkbox3" wire:model="r_tres">
                                    <label class="form-check-label " for="flexCheckDefault"> INVENTARIO EXISTENTE
                                    </label>
                                </div>

                                <div class="form-check ">
                                    <input class="form-check-input " type="checkbox" value="4" id="checkbox4" checked
                                        name="checkbox4" wire:model="r_cuatro">
                                    <label class="form-check-label " for="flexCheckChecked"> WAREHOUSE </label>
                                </div>
                            </ul>
                        </div>
                    </div>


                    <div class="col">
                        <select class="  form-control" style="overflow-y: scroll; height:34px;" name="pres"
                            wire:model="pres">
                            <option value="" style="overflow-y: scroll;">Todas presentaciones </option>
                            <option value="Puros Tripa Larga" style="overflow-y: scroll;">Puros Tripa Larga </option>
                            <option value="Puros Tripa Corta" style="overflow-y: scroll;">Puros Tripa Corta </option>
                            <option value="Puros Sandwich" style="overflow-y: scroll;">Puros Sandwich </option>
                        </select>
                    </div>








                    <div class="col">
                        <select onchange="buscar_tabla()" onclick="funcion1()" name="b_item" id="b_item"
                            class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                            <option value="" style="overflow-y: scroll;">Todos Items</option>
                            @foreach($items_p as $item)
                            <option style="overflow-y: scroll;"> {{$item->item}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <select onchange="buscar_tabla()" onclick="funcion1()" name="b_orden" id="b_orden"
                            class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                            <option value="" style="overflow-y: scroll;">Todas las ordenes del sistema</option>
                            @foreach($ordenes_p as $orden)
                            <option style="overflow-y: scroll;"> {{$orden->orden_del_sitema}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
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

                        <select onchange="buscar_tabla()" onclick="funcion1()" name="b_marca" id="b_marca"
                            class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                            <option value="" style="overflow-y: scroll;">Todas las marcas</option>
                            @foreach($marcas_p as $marca)
                            <option style="overflow-y: scroll;"> {{$marca->marca}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <select onchange="buscar_tabla()" onclick="funcion1()" name="b_vitola" id="b_vitola"
                            class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                            <option value="" style="overflow-y: scroll;">Todas las vitolas</option>
                            @foreach($vitolas_p as $vitola)
                            <option style="overflow-y: scroll;"> {{$vitola->vitola}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <select onchange="buscar_tabla()" onclick="funcion1()" name="b_nombre" id="b_nombre"
                            class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                            <option value="" style="overflow-y: scroll;">Todos los nombres</option>
                            @foreach($nombre_p as $nombre)
                            <option style="overflow-y: scroll;"> {{$nombre->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <select onchange="buscar_tabla()" onclick="funcion1()" name="b_capa" id="b_capa"
                            class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                            <option value="" style="overflow-y: scroll;">Todas las capas</option>
                            @foreach($capas_p as $capa)
                            <option style="overflow-y: scroll;"> {{$capa->capa}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <select onchange="buscar_tabla()" onclick="funcion1()" name="b_empaque" id="b_empaque"
                            class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                            <option value="" style="overflow-y: scroll;">Todos los empaques</option>
                            @foreach($empaques_p as $empaque)
                            <option style="overflow-y: scroll;"> {{$empaque->empaque}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <select onchange="buscar_tabla()" onclick="funcion1()" name="b_mes" id="b_mes"
                            class=" mi-selector form-control" style="width:100%;height:34px;" name="states[]">
                            <option value="" style="overflow-y: scroll;">Todos los meses</option>
                            @foreach($mes_p as $mes)
                            <option style="overflow-y: scroll;"> {{$mes->mes}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
        </form>
    </div>



    <script type="text/javascript">
        function buscar_tabla() {
            $('.mi-selector').select2();

            var table = document.getElementById("tabla_pendiente");
            var rowCount = table.rows.length;
            var tableRows = table.getElementsByTagName('tr');
            //console.log(rowCount)

            if (rowCount <= 1) {} else {
                for (var x = rowCount - 1; x > 0; x--) {
                    document.getElementById("body").innerHTML = "";
                }
            }


            var b_orden = document.getElementById('b_orden').value;
            var b_item = document.getElementById('b_item').value;
            var b_hon = document.getElementById('b_hon').value;
            var b_mes = document.getElementById('b_mes').value;

            var b_marca = document.getElementById('b_marca').value;
            var b_vitola = document.getElementById('b_vitola').value;
            var b_capa = document.getElementById('b_capa').value;
            var b_nombre = document.getElementById('b_nombre').value;
            var b_empaque = document.getElementById('b_empaque').value;

            var checkbox1 = document.getElementById('checkbox1').value;
            var checkbox2 = document.getElementById('checkbox2').value;
            var checkbox3 = document.getElementById('checkbox3').value;
            var checkbox4 = document.getElementById('checkbox4').value;


            var datas = '<?php echo json_encode($datos_pendiente);?>';
            var data = JSON.parse(datas);

            if (b_orden == "" && b_item == "" && b_hon == "" && b_mes == "" && b_marca == "" &&
                b_vitola == "" && b_capa == "" && b_nombre == "" && b_empaque == "") {
                document.getElementById('checkbox1').value = checkbox1;
                document.getElementById('checkbox2').value = checkbox2;
                document.getElementById('checkbox3').value = checkbox3;
                document.getElementById('checkbox4').value = checkbox4;
            } else {
                var sumas = 0;
                var sumap = 0;
                for (var i = 0; i < data.length; i++) {
                    try {



                        if (data[i].marca.toLowerCase().match(b_marca.toLowerCase()) &&
                            data[i].vitola.toLowerCase().match(b_vitola.toLowerCase()) &&
                            data[i].nombre.toLowerCase().match(b_nombre.toLowerCase()) &&
                            data[i].capa.toLowerCase().match(b_capa.toLowerCase()) &&
                            data[i].tipo_empaque.toLowerCase().match(b_empaque.toLowerCase()) &&

                            data[i].item.toLowerCase().match(b_item.toLowerCase()) &&
                            data[i].orden_del_sitema.toLowerCase().match(b_orden.toLowerCase()) &&
                            data[i].mes.toLowerCase().match(b_mes.toLowerCase()) &&
                            data[i].orden.toLowerCase().match(b_hon.toLowerCase())) {


                            sumas = sumas + data[i].saldo;
                            sumap = sumap + data[i].pendiente;



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
                            if (data[i].serie_precio == null) {
                                data[i].serie_precio = "";
                            }
                            if (data[i].precio == null) {
                                data[i].precio = "";
                            }

                            var tabla_nueva = `
                  <tr>
                    <td>` + data[i].categoria + `</td>
                    <td>` + data[i].item + `</td>
                    <td>` + data[i].orden_del_sitema + `</td>
                    <td>` + data[i].observacion + `</td>

                    <td>` + data[i].presentacion + `</td>
                    <td>` + data[i].mes + `</td>
                    <td style="width:100px;font-size:8px;">` + data[i].orden + `</td>
                    <td style="width:100px;font-size:8px;">` + data[i].marca + `</td>
                    <td>` + data[i].vitola + `</td>

                    <td>` + data[i].nombre + `</td>
                    <td>` + data[i].capa + `</td>
                    <td>` + data[i].tipo_empaque + `</td>
                    <td>` + data[i].anillo + `</td>
                    <td>` + data[i].cello + `</td>
                    <td>` + data[i].upc + `</td>
                    <td>` + data[i].serie_precio + `</td>
                    <td>` + data[i].precio + `</td>
                    <td>` + data[i].pendiente + `</td>
                    <td>` + data[i].saldo + `</td>

                    <td style="width:100px;">
                                <a data-toggle="modal" data-target="#modal_eliminar_detalle"
                                    onclick="datos_modal_eliminar(` + data[i].id_pendiente + `)" href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg></a>


                                <a style=" width:10px; height:10px;" data-toggle="modal" href=""
                                    data-target="#modal_actualizar" type="submit"
                                    onclick="datos_modal_actualizar(` + data[i].id_pendiente + `,` + data[i].item + `)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </a>
                            </td>
                  </tr>

                  `;


                            document.getElementById("body").innerHTML += tabla_nueva.toString();
                        }
                    } catch (error) {
                        console.error(error);
                    }
                    document.getElementById("sumas").value = sumas.toString();
                    document.getElementById("sumap").value = sumap.toString();


                }
            }
            // fin del else
        }
    </script>










    <div style="  display: none;justify-content: center;align-items: center;  position:fixed;bottom:20%;width:100%;"
        id="div_AddProductoPendiente">
        <!-- INICIO DEL MODAL NUEVO PRODUCTO -->

        <form action="{{Route('nuevo_pendiente')}} " method="POST">
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







    <div class="panel-body" style="padding:0px;">
        <div style="width:100%; padding-left:0px;   font-size:9px;   overflow-x: display; overflow-y: auto;
     height:450px;">
            @csrf
            <table class="table table-light" style="font-size:9px;" id="tabla_pendiente">
                <thead>
                    <tr>
                        <th style="width:100px;">CATEGORIA</th>
                        <th>ITEM</th>
                        <th>ORDEN DEL SISTEMA</th>
                        <th>OBSERVACÓN</th>
                        <th>PRESENTACIÓN</th>
                        <th>MES</th>
                        <th style="width:100px;">ORDEN</th>
                        <th style="width:100px;">MARCA</th>
                        <th>VITOLA</th>
                        <th>NOMBRE</th>
                        <th>CAPA</th>
                        <th>TIPO DE EMPAQUE</th>
                        <th>ANILLO</th>
                        <th>CELLO</th>
                        <th>UPC</th>
                        <th>COD.PRECIO</th>
                        <th>PRECIO</th>
                        <th>PENDIENTE</th>
                        <th>SALDO</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody name="body" id="body">
                    <?php $sumas = 0 ;
                    $sumap=0;
                    ?>
                    @foreach($datos_pendiente as $datos)
                    <tr>
                        <td style="width:100px; max-width: 400px;overflow-x:auto;">{{$datos->categoria}}</td>
                        <td>{{$datos->item}}</td>
                        <td>{{$datos->orden_del_sitema}}</td>
                        <td>{{$datos->observacion}}</td>
                        <td>{{$datos->presentacion}}</td>
                        <td>{{$datos->mes}}</td>
                        <td style="width:100px;font-size:8px;">{{$datos->orden}}</td>
                        <td style="width:100px;font-size:8px;">{{$datos->marca}}</td>
                        <td>{{$datos->vitola}}</td>
                        <td>{{$datos->nombre}}</td>
                        <td>{{$datos->capa}}</td>
                        <td>{{$datos->tipo_empaque}}</td>
                        <td>{{$datos->anillo}}</td>
                        <td>{{$datos->cello}}</td>
                        <td>{{$datos->upc}}</td>
                        <td>{{$datos->serie_precio}}</td>
                        <td>{{$datos->precio}}</td>
                        <td>{{$datos->pendiente}}</td>
                        <td>{{$datos->saldo}}</td>


                        <td style="width:120px;">
                            <a data-toggle="modal" data-target="#modal_eliminar_detalle"
                                onclick="datos_modal_eliminar({{$datos->id_pendiente}})" href="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                                    class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                </svg></a>

                            <a style=" width:10px; height:10px;" data-toggle="modal" href=""
                                data-target="#modal_actualizar" type="submit"
                                onclick="datos_modal_actualizar({{$datos->id_pendiente}},{{$datos->item}})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </a>


                        </td>
                    </tr>

                    <?php $sumas = $sumas + $datos->saldo;
                             $sumap = $sumap + $datos->pendiente; ?>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="input-group" style="width:30%;position: fixed;right: 0px;bottom:0px; height:30px;">
        <span class="form-control input-group-text">Total pendiente</span>
        <input type="text" class="form-control" id="sumap" value="{{$sumap}}">

        <span class="form-control input-group-text">Total saldo</span>
        <input type="text" class="form-control" id="sumas" value="{{$sumas}}">
    </div>

</div>





<!-- INICIO MODAL ELMINAR DATO PENDIENTE -->
<form action="{{Route('borrarpendiente')}}" id="formulario_mostrarE" name="formulario_mostrarE" method="POST">

    @csrf
    <?php use App\Http\Controllers\UserController; ?>

    <input name="id_pendiente" id="id_pendiente" value="" hidden />

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
                    ¿Estás seguro que quieres eliminar este registro del pendiente?
                </div>
                <div class="modal-footer">
                    <button type="button" class="bmodal_no " data-dismiss="modal">
                        <span>Cancelar</span>
                    </button>
                    <button type="submit" class=" bmodal_yes ">
                        <span>Eliminar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- FIN MODAL ELMINAR DATO PENDIENTE -->


    <!-- INICIO MODAL ACTUALIZAR DATO PENDIENTE -->

    <form action="{{Route('actualizar_pendiente')}}" method="POST" id="actualizar_pendiente"
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
                                <label for="txt_figuraytipo" class="form-label">Orden del sistema</label>
                                <input name="orden_sistema" id="orden_sistema" class="form-control" \ type="text"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Orden</label>
                                <input name="orden" id="orden" class="form-control" type="text" autocomplete="off">
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Presentación</label>
                                <input name="presentacion" id="presentacion" class="form-control" type="text"
                                    autocomplete="off">
                            </div>
                        </div>


                        <div class="row">


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

                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Código precio</label>
                                <input name="cprecio" id="cprecio" class="form-control" type="text" autocomplete="off">
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Precio</label>
                                <input name="precio" id="precio" class="form-control" type="text" autocomplete="off">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Observación</label>
                                <input name="observacion" id="observacion" class="form-control" type="text"
                                    autocomplete="off">

                                <input name="b_mesA" id="b_mesA" hidden>
                                <input name="b_itemA" id="b_itemA" hidden>
                                <input name="b_ordenA" id="b_ordenS" hidden>
                                <input name="b_honA" id="b_honA" hidden>
                                <input name="b_marcaA" id="b_marcaA" hidden>
                                <input name="b_vitolaA" id="b_vitolaA" hidden>
                                <input name="b_nombreA" id="b_nombreA" hidden>
                                <input name="b_capaA" id="b_capaA" hidden>
                                <input name="b_empaqueA" id="b_empaqueA" hidden>
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
    <!-- FIN MODAL ACTUALIZAR DATO PENDIENTE -->





<script type="text/javascript">
    function ocultar_div_AddProductoP() {
        document.getElementById('div_AddProductoPendiente').style.display = "none";
    }

    function mostrar_div_AddProductoP() {
        event.preventDefault();
        document.getElementById('div_AddProductoPendiente').style.display = "flex";
    }
</script>


<script type="text/javascript">
    function datos_modal_eliminar(id) {
        var datass = '<?php echo json_encode($datos_pendiente);?>';

        var datastiles = JSON.parse(datass);



        for (var i = 0; i < datastiles.length; i++) {
            if (datastiles[i].id_pendiente === id) {
                document.formulario_mostrarE.id_pendiente.value = datastiles[i].id_pendiente;


            }
        }

    }
</script>




<script type="text/javascript">
    function datos_modal_actualizar(id, item) {


        document.actualizar_pendiente.b_mesA.value = document.getElementById('b_mes').value;
        document.actualizar_pendiente.b_itemA.value = document.getElementById('b_item').value;
        document.actualizar_pendiente.b_ordenA.value = document.getElementById('b_orden').value;

        document.actualizar_pendiente.b_honA.value = document.getElementById('b_hon').value;
        document.actualizar_pendiente.b_marcaA.value = document.getElementById('b_marca').value;
        document.actualizar_pendiente.b_vitolaA.value = document.getElementById('b_vitola').value;

        document.actualizar_pendiente.b_nombreA.value = document.getElementById('b_nombre').value;
        document.actualizar_pendiente.b_capaA.value = document.getElementById('b_capa').value;
        document.actualizar_pendiente.b_empaqueA.value = document.getElementById('b_empaque').value;

        var datasss = @json($datos_pendiente);

        var producto = "";

        for (var i = 0; i < datasss.length; i++) {
            if (datasss[i].id_pendiente === id) {
                document.actualizar_pendiente.id_pendientea.value = datasss[i].id_pendiente;

                document.actualizar_pendiente.itema.value = datasss[i].item;

                producto =
                    document.getElementById("titulo").innerHTML = "".concat(datasss[i].marca, " ", datasss[i].nombre,
                        " ",
                        datasss[i].capa, " ", datasss[i].vitola);;


                        document.actualizar_pendiente.presentacion.value = datasss[i].presentacion;

                        document.actualizar_pendiente.observacion.value = datasss[i].observacion;

                        document.actualizar_pendiente.orden_sistema.value = datasss[i].orden_del_sitema;

                        document.actualizar_pendiente.pendiente.value = datasss[i].pendiente;

                        document.actualizar_pendiente.saldo.value = datasss[i].saldo;

                        document.actualizar_pendiente.cprecio.value = datasss[i].serie_precio;

                        document.actualizar_pendiente.precio.value = datasss[i].precio;

                        document.actualizar_pendiente.orden.value = datasss[i].orden;
            }
        }

    }
</script>



<script>
    $('#b_mes').val($b_mesA).trigger('change.select2');
    $('#b_item').val($b_itemA).trigger('change.select2');
    $('#b_orden').val($b_ordenA).trigger('change.select2');
    $('#b_hon').val($b_honA).trigger('change.select2');
    $('#b_marca').val($b_marcaA).trigger('change.select2');
    $('#b_vitola').val($b_vitolaA).trigger('change.select2');
    $('#b_nombre').val($b_nombreA).trigger('change.select2');
    $('#b_capa').val($b_capaA).trigger('change.select2');
    $('#b_empaque').val($b_empaqueA).trigger('change.select2');
</script>


<script type="text/javascript">
    function funcion1() {
        $('.mi-selector').select2();
    }
</script>

<script type="text/javascript">
    function buscar_tabla() {
        $('.mi-selector').select2();

        var table = document.getElementById("tabla_pendiente");
        var rowCount = table.rows.length;
        var tableRows = table.getElementsByTagName('tr');
        //console.log(rowCount)

        if (rowCount <= 1) {} else {
            for (var x = rowCount - 1; x > 0; x--) {
                document.getElementById("body").innerHTML = "";
            }
        }


        var b_orden = document.getElementById('b_orden').value;
        var b_item = document.getElementById('b_item').value;
        var b_hon = document.getElementById('b_hon').value;
        var b_mes = document.getElementById('b_mes').value;

        var b_marca = document.getElementById('b_marca').value;
        var b_vitola = document.getElementById('b_vitola').value;
        var b_capa = document.getElementById('b_capa').value;
        var b_nombre = document.getElementById('b_nombre').value;
        var b_empaque = document.getElementById('b_empaque').value;

        var checkbox1 = document.getElementById('checkbox1').value;
        var checkbox2 = document.getElementById('checkbox2').value;
        var checkbox3 = document.getElementById('checkbox3').value;
        var checkbox4 = document.getElementById('checkbox4').value;


        var datas = '<?php echo json_encode($datos_pendiente);?>';
        var data = JSON.parse(datas);

        if (b_orden == "" && b_item == "" && b_hon == "" && b_mes == "" && b_marca == "" &&
            b_vitola == "" && b_capa == "" && b_nombre == "" && b_empaque == "") {
            location.reload(true);
        } else {
            var sumas = 0;
            var sumap = 0;
            for (var i = 0; i < data.length; i++) {
                try {



                    if (data[i].marca.toLowerCase().match(b_marca.toLowerCase()) &&
                        data[i].vitola.toLowerCase().match(b_vitola.toLowerCase()) &&
                        data[i].nombre.toLowerCase().match(b_nombre.toLowerCase()) &&
                        data[i].capa.toLowerCase().match(b_capa.toLowerCase()) &&
                        data[i].tipo_empaque.toLowerCase().match(b_empaque.toLowerCase()) &&

                        data[i].item.toLowerCase().match(b_item.toLowerCase()) &&
                        data[i].orden_del_sitema.toLowerCase().match(b_orden.toLowerCase()) &&
                        data[i].mes.toLowerCase().match(b_mes.toLowerCase()) &&
                        data[i].orden.toLowerCase().match(b_hon.toLowerCase())) {


                        sumas = sumas + data[i].saldo;
                        sumap = sumap + data[i].pendiente;



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
                        if (data[i].serie_precio == null) {
                            data[i].serie_precio = "";
                        }
                        if (data[i].precio == null) {
                            data[i].precio = "";
                        }
                        if (data[i].pendiente == null) {
                            data[i].pendiente = "";
                        }
                        if (data[i].saldo == null) {
                            data[i].saldo = "";
                        }

                        var tabla_nueva = `
                  <tr>
                    <td>` + data[i].categoria + `</td>
                    <td>` + data[i].item + `</td>
                    <td>` + data[i].orden_del_sitema + `</td>
                    <td>` + data[i].observacion + `</td>

                    <td>` + data[i].presentacion + `</td>
                    <td>` + data[i].mes + `</td>
                    <td style="width:100px;font-size:8px;">` + data[i].orden + `</td>
                    <td style="width:100px;font-size:8px;">` + data[i].marca + `</td>
                    <td>` + data[i].vitola + `</td>

                    <td>` + data[i].nombre + `</td>
                    <td>` + data[i].capa + `</td>
                    <td>` + data[i].tipo_empaque + `</td>
                    <td>` + data[i].anillo + `</td>
                    <td>` + data[i].cello + `</td>
                    <td>` + data[i].upc + `</td>
                    <td>` + data[i].serie_precio + `</td>
                    <td>` + data[i].precio + `</td>
                    <td>` + data[i].pendiente + `</td>
                    <td>` + data[i].saldo + `</td>

                    <td style="width:100px;">
                                <a data-toggle="modal" data-target="#modal_eliminar_detalle"
                                    onclick="datos_modal_eliminar(` + data[i].id_pendiente + `)" href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg></a>


                                <a style=" width:10px; height:10px;" data-toggle="modal" href=""
                                    data-target="#modal_actualizar" type="submit"
                                    onclick="datos_modal_actualizar(` + data[i].id_pendiente + `,` + data[i].item + `)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </a>

                            </td>

                  </tr>

                  `;


                        document.getElementById("body").innerHTML += tabla_nueva.toString();
                    }
                } catch (error) {
                    console.error(error);
                }
                document.getElementById("sumas").value = sumas.toString();
                document.getElementById("sumap").value = sumap.toString();


            }
        }
        // fin del else
    }
</script>





</div>
