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
    <script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js') }}"></script>
    <link rel="stylesheet"
        href="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css') }}">






    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="pendiente"><strong>Pendiente</strong></a>
        </li>
    </ul>




    <div class="container" style="max-width:100%;">

        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <input name="buscar" id="buscar" style="width:350px;" class=" form-control  mr-sm-2 "
                        wire:model="busqueda" placeholder="Búsqueda por Marca, Nombre y Vitola">
                        <form action="{{Route('datos_producto')}} " >
                            <button class=" botonprincipal mr-sm-2 " style="width:200px;">Datos adicionales</button>
                        </form>
                    <button class=" botonprincipal mr-sm-2 " onclick="mostrar_div_AddProducto();"
                        style="width:200px;">Nuevo producto</button>
                </div>
            </div>
        </div>



        <div class="panel-body" style="padding:0px;">
            <div
                style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;  height:450px;">
                @csrf
                <table class="table table-light" style="font-size:10px;">
                    <thead style=" position: static;">
                        <tr style="font-size:16px; text-align:center;">
                            <th style=" text-align:center;">#</th>
                            <th style=" text-align:center;">Item</th>
                            <th style=" text-align:center;">Marca</th>
                            <th style=" text-align:center;">Nombre</th>
                            <th style=" text-align:center;">Vitola</th>
                            <th style=" text-align:center;">Capa</th>
                            <th style=" text-align:center;">Tipo de empaque</th>
                            <th style=" text-align:center;">Detalles</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($productos as $producto)
                        <tr>
                            <td>{{$producto->id_producto}}</td>
                            <td>{{$producto->item}}</td>
                            <td>{{$producto->marca}}</td>
                            <td>{{$producto->nombre}}</td>
                            <td>{{$producto->vitola}}</td>
                            <td>{{$producto->capa}}</td>
                            <td>{{$producto->tipo_empaque}}</td>


                            <td style=" text-align:center;">

                                <?php      if($producto->sampler==="si")    {     

                           echo' <a style=" width:30px; height:30px;"  data-toggle="modal"  ';
                           echo'  data-target="#modal_agregarproducto" href="" ';
                           echo'  data-target="#modal_agregarproducto" href="" ';
                           echo'  onclick="agregar_item('.$producto->id_producto.','. strlen($producto->item).')"> ';
                           echo'  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" ';
                           echo'    class="bi bi-file-earmark-plus" viewBox="0 0 16 16"> ';
                           echo'    <path ';
                           echo'        d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z" /> ';
                           echo'    <path ';
                           echo'        d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" /> ';
                           echo'  </svg> ';
                           echo' </a> ';

                           echo' <a style=" width:10px; height:10px;" data-toggle="modal" href="" ';
                           echo'     data-target="#modal_ver_detalle_producto" ';
                           echo'  onclick="item_detalle(parseInt('.$producto->item.',10),'. strlen($producto->item).')"> ';
                           
                           echo'      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" ';
                           echo'    class="bi bi-arrow-up-right-square" viewBox="0 0 16 16"> ';
                           echo'    <path fill-rule="evenodd" ';
                           echo'        d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.854 8.803a.5.5 0 1 1-.708-.707L9.243 6H6.475a.5.5 0 1 1 0-1h3.975a.5.5 0 0 1 .5.5v3.975a.5.5 0 1 1-1 0V6.707l-4.096 4.096z" /> ';
                           echo' </svg> ';
                           echo' </a> ';
                     }?>
                                <a style=" width:10px; height:10px;" onclick="cargar_datos_editar({{$producto->id_producto}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black"
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
    </div>




    <!-- SCRIPT MODAL EDITAR MOLDE -->

    <script type="text/javascript">
        function cargar_datos_editar(id) {
            $('.mi-selector').select2();
            document.getElementById('div_EditarProducto').style.display = "flex";

            if (document.formulario_actualizar.cello_ac.checked) {

                document.formulario_actualizar.cello_ac.click();

            } else {

            }
            if (document.formulario_actualizar.anillo_ac.checked) {

                document.formulario_actualizar.anillo_ac.click();

            } else {

            }
            if (document.formulario_actualizar.upc_ac.checked) {

                document.formulario_actualizar.upc_ac.click();

            } else {

            }

            if (document.formulario_actualizar.sampler.checked) {

                document.formulario_actualizar.sampler.click();

            } else {

            }



            var productos = '<?php echo json_encode($productos);?>';

            var producto = JSON.parse(productos);


            for (var i = 0; i < producto.length; i++) {

                if (producto[i].id_producto === id) {

                    $('#marca_ac').val(producto[i].marca).trigger('change.select2');
                    $('#capa_ac').val(producto[i].capa).trigger('change.select2');
                    $('#nombre_ac').val(producto[i].nombre).trigger('change.select2');
                    $('#vitola_ac').val(producto[i].vitola).trigger('change.select2');
                    $('#tipo_ac').val(producto[i].tipo_empaque).trigger('change.select2');

                    // document.formulario_actualizar.marca_ac.value =;
                    document.formulario_actualizar.item_ac.value = producto[i].item;
                    //document.formulario_actualizar.capa_ac.value = producto[i].capa;
                    //document.formulario_actualizar.nombre_ac.value = producto[i].nombre;
                    //document.formulario_actualizar.vitola_ac.value = producto[i].vitola;
                    //document.formulario_actualizar.tipo_ac.value = producto[i].tipo_empaque;
                    document.formulario_actualizar.presentacion_ac.value = producto[i].presentacion;
                    document.formulario_actualizar.cod_sistema_ac.value = producto[i].codigo_producto;
                    document.formulario_actualizar.cod_precio_ac.value = producto[i].codigo_precio;
                    document.formulario_actualizar.cod_caja_ac.value = producto[i].codigo_caja;

                    document.formulario_actualizar.id_producto.value = producto[i].id_producto;

                    document.formulario_actualizar.des.value = producto[i].des;

                    if (producto[i].cello === "SI") {

                        document.formulario_actualizar.cello_ac.click();

                    } else {


                    }

                    if (producto[i].anillo === "SI") {
                        document.formulario_actualizar.anillo_ac.click();
                    } else {

                    }

                    if (producto[i].upc === "SI") {

                        document.formulario_actualizar.upc_ac.click();
                    } else {}

                    if (producto[i].sampler === "si") {

                        document.formulario_actualizar.sampler.click();
                    } else {}


                }
            }

        }
    </script>

    <!-- FIN SCRIPT MODAL EDITAR MOLDE -->
    <script type="text/javascript">
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $("input[name=_token]").val()
                }
            });

            $('#editable').Tabledit({
                url: '{{ route("tabledit.action") }}',
                method: 'POST',
                dataType: "json",
                columns: {
                    identifier: [0, 'id'],
                    editable: [
                        [1, 'Marca'],
                        [2, 'Nombre'],
                        [3, 'Vitola'],
                        [4, 'Orden'],
                        [5, 'Tipo de empaque']
                    ]
                },
                restoreButton: false,

                onSuccess: function (data, textStatus, jqXHR) {
                    if (data.action == 'delete') {
                        $('#' + data.id).remove();
                    }
                }

            });

        });
    </script>


    <script type="text/javascript">
        function agregar_item(id, tamano) {
            $('.mi-selector').select2();
            document.getElementById('div_AddDetalleProducto').style.display = "flex";

            var idproductos = '<?php echo json_encode($productos);?>';
            var idproduct = JSON.parse(idproductos);
            for (var i = 0; i < idproduct.length; i++) {

                if (idproduct[i].id_producto === id) {

                    var nombre_item = idproduct[i].item;
                    document.form_detalle.item_de.value = nombre_item;
                }
            }
        }
    </script>


    <script type="text/javascript">
        function item_detalle(item, tamano) {
            var table = document.getElementById("detallestabla");
            var rowCount = table.rows.length;
            var tableRows = table.getElementsByTagName('tr');
            //console.log(rowCount)

            if (rowCount <= 1) {} else {

                for (var x = rowCount - 1; x > 0; x--) {

                    document.getElementById("body").innerHTML = "";
                    document.getElementById("clase").innerHTML = "";

                }

            }


            tabla_nueva = "";

            var ta_item = (item.toString()).length;
            var diferencia = tamano - ta_item;
            var cero = "0";

            var nombre_item = item.toString();

            for (var i = 0; i < diferencia; i++) {
                nombre_item = cero + nombre_item;
            }



            var detalles = '<?php echo json_encode($detalle_productos);?>';
            var detalle = JSON.parse(detalles);
            for (var i = 0; i < detalle.length; i++) {


                if (detalle[i].item === nombre_item) {
                    var tabla_nueva = `
                  <tr>
                    <td>` + detalle[i].item + `</td>
                    <td>` + detalle[i].marca + `</td>
                    <td>` + detalle[i].nombre + `</td>
                    <td>` + detalle[i].vitola + `</td>
                    <td>` + detalle[i].capa + `</td>
                    <td>` + detalle[i].tipo_empaque + `</td>

                  </tr>

                  `;
                    document.getElementById("body").innerHTML += tabla_nueva.toString();
                }

            }



            var productos = '<?php echo json_encode($productos);?>';
            var producto = JSON.parse(productos);
            for (var i = 0; i < producto.length; i++) {


                if (producto[i].item === nombre_item) {
                    var h3 = `
                  <h3><strong>
                    ` + producto[i].item + `
                    ` + producto[i].tipo_empaque + `
                    ` + producto[i].vitola + `
                    ` + producto[i].marca + `
                    ` + producto[i].nombre + `
                    

                    </strong></h3>

                  `;
                    document.getElementById("clase").innerHTML += h3.toString();
                }

            }

        }
    </script>











    <script type="text/javascript">
        function agregarproducto() {
            var v_item = document.getElementById('item').value;
            var unico_item = 0;

            var datas = '<?php echo json_encode($productos);?>';
            var data = JSON.parse(datas);

            for (var i = 0; i < data.length; i++) {
                if (data[i].item.toLowerCase() === v_item.toLowerCase()) {
                    unico_item++;
                }
            }

            if (unico_item > 0) {
                toastr.error('Este item ya existe', 'ERROR', {
                    "progressBar": true,
                    "closeButton": false,
                    "preventDuplicates": true,
                    "preventOpenDuplicates": true
                });
                event.preventDefault();
            } else {
                theForm.addEventListener('submit', function (event) {});

            }
        }
    </script>
















    <!-- INICIO DEL MODAL VER DETALLE PRODUCTO -->
    <form action="{{Route('detalle_producto')}} " method="POST" name="formde" id=" formde">
        @csrf
        <div class="modal fade" id="modal_ver_detalle_producto" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
            style="opacity:.9;background:#212529;width=800px;">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" style="width:700px;">

                    <div class="modal-header">
                        <h5 id="staticBackdropLabel">Detalles del producto <span style="font-size:10px;" name="clase"
                                id="clase"></span></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <table id="detallestabla" name="detallestabla" class="table table-bordered table-striped"
                            style="font-size:10px;">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Marca</th>
                                    <th>Nombre</th>
                                    <th>Vitola</th>
                                    <th>Capa</th>
                                    <th>Tipo de empaque</th>

                                </tr>
                            </thead>
                            <tbody name="body" id="body">

                            </tbody>
                        </table>
                    </div>

                    <input name="item_detalle" id="item_detalle" value+="" hidden>

                </div>
            </div>
        </div>
    </form>
    <!-- FIN DEL MODAL VER DETALLE PRODUCTO -->









    <div style="  display: none;justify-content: center;align-items: center; height:100%;position:fixed;top:0px;width:50%;left:25%;"
        id="div_EditarProducto">
        <!-- INICIO MODAL ACTUALIZAR PRODUCTO-->
        <form action="{{Route('actualizar_producto')}}" method="POST" name="formulario_actualizar"
            id="formulario_actualizar" style="width:100%;">
            @csrf
            <div data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                aria-hidden="true">
                <div>
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="staticBackdropLabel"><strong>Editar producto</strong></h5>
                            <button type="button" class="btn-close" aria-label="Close"
                                onclick="ocultar_div_EditarProducto()"></button>
                        </div>

                        <div class="modal-body">

                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="marca_ac" class="form-label">Marca</label>
                                    <select class=" mi-selector" style=" height:30px; width: 100%; " name="marca_ac"
                                        id="marca_ac" placeholder="Ingresa figura y tipo" required>
                                        @foreach($marcas as $marca)
                                        <option style="overflow-y: scroll;"> {{$marca->marca}}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>


                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="txt_figuraytipo" class="form-label">Item</label>
                                    <input name="item_ac" id="item_ac" class="form-control" required type="text"
                                        autocomplete="off" readOnly>
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_figuraytipo" class="form-label">Capa</label>
                                    <select class=" mi-selector" style=" height:30px; width: 100%; " name="capa_ac"
                                        id="capa_ac" placeholder="Ingresa figura y tipo" required>
                                        @foreach($capas as $capa)
                                        <option style="overflow-y: scroll;"> {{$capa->capa}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_total" class="form-label">Nombre</label>
                                    <select class=" mi-selector" style=" height:30px; width: 100%; " name="nombre_ac"
                                        id="nombre_ac" placeholder="Ingresa figura y tipo" required>
                                        @foreach($nombres as $nombre)
                                        <option style="overflow-y: scroll;"> {{$nombre->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="txt_buenos" class="form-label">Vitola</label>
                                    <select class=" mi-selector" style=" height:30px; width: 100%; " name="vitola_ac"
                                        id="vitola_ac" placeholder="Ingresa figura y tipo" required>
                                        @foreach($vitolas as $vitola)
                                        <option style="overflow-y: scroll;"> {{$vitola->vitola}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_malos" class="form-label">Tipo de empaque</label>
                                    <select class=" mi-selector" style=" height:30px; width: 100%; " name="tipo_ac"
                                        id="tipo_ac" placeholder="Ingresa figura y tipo" required>
                                        @foreach($tipo_empaques as $tipo_empaque)
                                        <option style="overflow-y: scroll;"> {{$tipo_empaque->tipo_empaque}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_malos" class="form-label">Presentación</label>
                                    <select class="form-control" name="presentacion_ac" id="presentacion_ac"
                                        placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;"
                                        required>
                                        <option value="Puros Tripa Larga" style="overflow-y: scroll;">Puros Tripa
                                            Larga
                                        </option>
                                        <option value="Puros Tripa Corta" style="overflow-y: scroll;">Puros Tripa
                                            Corta
                                        </option>
                                    </select>
                                </div>

                            </div>



                            <div class="row">

                                <div class="mb-3 col">
                                    <label for="txt_total" class="form-label">Código del sistema</label>
                                    <input name="cod_sistema_ac" id="cod_sistema_ac" class="form-control" type="text"
                                        autocomplete="off">
                                </div>
                                <div class="mb-3 col">
                                    <label for="txt_buenos" class="form-label">Código de precio</label>
                                    <input name="cod_precio_ac" id="cod_precio_ac" class="form-control" type="text"
                                        autocomplete="off">
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_total" class="form-label">Código de la cajita</label>
                                    <input name="cod_caja_ac" id="cod_caja_ac" class="form-control" type="text"
                                        autocomplete="off">
                                </div>

                            </div>


                            <div class="row">
                                <div class="mb-3 col">
                                    <input type="checkbox" name="cello_ac" id="cello_ac" value="si">
                                    <label for="cello" class="form-label">Sello</label>
                                </div>

                                <div class="mb-3 col">
                                    <input type="checkbox" name="anillo_ac" id="anillo_ac" style="font-size:20px"
                                        value="si">
                                    <label for="anillo" class="form-label">Anillo</label>
                                </div>
                                <div class="mb-3 col">
                                    <input type="checkbox" name="upc_ac" id="upc_ac" value="si">
                                    <label for="upc" class="form-label">UPC</label>
                                </div>
                                <input name="id_producto" id="id_producto" value="" hidden>
                            </div>


                            <div class="row">

                                <div>
                                    <input type="checkbox" name="sampler" id="sampler" value="si" onclick="ocultar()">
                                    <label for="upc" class="form-label">SAMPLER</label>

                                    <input type="text" name="des" id="des" value="" style="display:none; width:60%;">
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button class="bmodal_no" onclick="ocultar_div_EditarProducto()">
                                <span>Cancelar</span>
                            </button>
                            <button type="submit" class="bmodal_yes">
                                <span>Guardar</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
        <!-- FIN  MODAL ACTUALIZAR PRODUCTO -->
    </div>



    <script type="text/javascript">
        function ocultar() {
            if (document.formulario_actualizar.sampler.checked) {
                document.getElementById('des').style.display = "block";
            } else {
                document.getElementById('des').style.display = "none";
            }
        }
    </script>




<div style="  display: none;justify-content: center;align-items: center; height:100%;position:fixed;top:0px;width:50%;left:25%;" id="div_AddDetalleProducto"   >
    <!-- INICIO DEL MODAL AGREGAR DETALLE PRODUCTO -->
    <form action="{{Route('detalle')}}" method="POST" id="form_detalle" name="form_detalle" style="width:100%;">
        <div data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="background:#212529;">
            <div >
                <div class="modal-content" >
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Agregar detalle del producto</h5>
                    </div>

                    <div class="modal-body">
                         <div class="row">
                              <div class="mb-3 col">
                                <label for="item_de" class="form-label" style="width:100%;">Item</label>
                                <input name="item_de" id="item_de" class="form-control" required type="text"
                                    autocomplete="off" readonly>
                            </div>


                            <div class="mb-3 col">
                                <label for="capa_de" class="form-label" style="width:100%;">Capa</label>
                                <select  name="capa_de" id="capa_de" class="mi-selector form-control "  style="width:100%;" name="states[]" required >
                                    <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach($capas as $capa)
                                    <option style="overflow-y: scroll;"> {{$capa->capa}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col">
                                <label for="marca_de" class="form-label" style="width:100%;">Marca</label>
                                <select  name="marca_de" id="marca_de" class=" mi-selector form-control"  style="width:100%;" name="states[]" required >
                                    <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach($marcas as $marca)
                                    <option style="overflow-y: scroll;"> {{$marca->marca}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    

                        <div class="row">
                            <div class="mb-3 col">
                                <label for="nombre_de" class="form-label" style="width:100%;">Nombre</label>

                                <select name="nombre_de" id="nombre_de"class=" mi-selector form-control" style="width:100%;" name="states[]" required >
                                    <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach($nombres as $nombre)
                                    <option style="overflow-y: scroll;"> {{$nombre->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col">
                                <label for="vitola_de" class="form-label" style="width:100%;">Vitola</label>

                                <select name="vitola_de" id="vitola_de"class=" mi-selector form-control"  style="width:100%;" name="states[]" required >
                                    <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach($vitolas as $vitola)
                                    <option style="overflow-y: scroll;"> {{$vitola->vitola}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col">
                                <label for="tipo_de" class="form-label" style="width:100%;">Tipo de empaque</label>
                                <select name="tipo_de" id="tipo_de" class=" mi-selector form-control"  style="width:100%;" name="states[]" required >
                                    <option value="N/D" style="overflow-y: scroll;">Ninguna</option>
                                    @foreach($tipo_empaques as $tipo_empaque)
                                    <option style="overflow-y: scroll;"> {{$tipo_empaque->tipo_empaque}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="row">
                            <div class="mb-3 col">
                                <input type="checkbox" name="cello_de" id="cello_de" value="si">
                                <label for="cello" class="form-label">Sello</label>
                            </div>
                            <div class="mb-3 col">

                                <input type="checkbox" name="anillo_de" id="anillo_de" value="si">
                                <label for="anillo" class="form-label">Anillo</label>
                            </div>
                            <div class="mb-3 col">

                                <input type="checkbox" name="upc_de" id="upc_de" value="si">
                                <label for="upc" class="form-label">UPC</label>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="item_de" class="form-label" style="width:100%;">Item</label>
                                    <input name="item_de" id="item_de" class="form-control" required type="text"
                                        autocomplete="off" readonly>
                                </div>


                                <div class="mb-3 col">
                                    <label for="capa_de" class="form-label" style="width:100%;">Capa</label>
                                    <select name="capa_de" id="capa_de" class="mi-selector form-control "
                                        style="width:100%;" name="states[]" required>
                                        <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                        @foreach($capas as $capa)
                                        <option style="overflow-y: scroll;"> {{$capa->capa}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col">
                                    <label for="marca_de" class="form-label" style="width:100%;">Marca</label>
                                    <select name="marca_de" id="marca_de" class=" mi-selector form-control"
                                        style="width:100%;" name="states[]" required>
                                        <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                        @foreach($marcas as $marca)
                                        <option style="overflow-y: scroll;"> {{$marca->marca}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="nombre_de" class="form-label" style="width:100%;">Nombre</label>

                                    <select name="nombre_de" id="nombre_de" class=" mi-selector form-control"
                                        style="width:100%;" name="states[]" required>
                                        <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                        @foreach($nombres as $nombre)
                                        <option style="overflow-y: scroll;"> {{$nombre->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col">
                                    <label for="vitola_de" class="form-label" style="width:100%;">Vitola</label>

                                    <select name="vitola_de" id="vitola_de" class=" mi-selector form-control"
                                        style="width:100%;" name="states[]" required>
                                        <option value="NINGUNA" style="overflow-y: scroll;">Ninguna</option>
                                        @foreach($vitolas as $vitola)
                                        <option style="overflow-y: scroll;"> {{$vitola->vitola}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col">
                                    <label for="tipo_de" class="form-label" style="width:100%;">Tipo de
                                        empaque</label>
                                    <select name="tipo_de" id="tipo_de" class=" mi-selector form-control"
                                        style="width:100%;" name="states[]" required>
                                        <option value="N/D" style="overflow-y: scroll;">Ninguna</option>
                                        @foreach($tipo_empaques as $tipo_empaque)
                                        <option style="overflow-y: scroll;"> {{$tipo_empaque->tipo_empaque}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="row">
                                <div class="mb-3 col">
                                    <input type="checkbox" name="cello_de" id="cello_de" value="si">
                                    <label for="cello" class="form-label">Sello</label>
                                </div>
                                <div class="mb-3 col">

                                    <input type="checkbox" name="anillo_de" id="anillo_de" value="si">
                                    <label for="anillo" class="form-label">Anillo</label>
                                </div>
                                <div class="mb-3 col">

                                    <input type="checkbox" name="upc_de" id="upc_de" value="si">
                                    <label for="upc" class="form-label">UPC</label>
                                </div>
                            </div>

                            <div class="row">

                                <div class="mb-3 col">

                                    <label for="txt_malos" class="form-label">Código de
                                        precio</label>
                                    <input name="precio_de" id="precio_de" style="font-size:16px" class="form-control"
                                        required type="text" autocomplete="off">
                                </div>
                                <div class="mb-3 col">
                                </div>
                                <div class="mb-3 col">
                                </div>
                            </div>
                        </div>



                        <div class="modal-footer">
                            <button class="bmodal_no" onclick="ocultar_div_AddDetalleProducto()">
                                <span>Cancelar</span>
                            </button>
                            <button type="submit" class="bmodal_yes">
                                <span>Guardar</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- FIN DEL MODAL AGREGAR DETALLE PRODUCTO -->
    </div>













    <div style="  display: none;justify-content: center;align-items: center;height: 100%;position:fixed;top:0px;left:25%;width:50%;"
        id="div_AddProducto">
        <!-- INICIO DEL MODAL NUEVO PRODUCTO -->

        <form action="{{Route('nuevo_producto')}} " method="POST" name="theForm" id="theForm" style="width:100%;">
            <div data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                aria-hidden="true">
                <div>
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="staticBackdropLabel"><strong>Agregar producto</strong></h5>
                            <button type="button" class="btn-close" aria-label="Close"
                                onclick="ocultar_div_AddProducto()"></button>
                        </div>

                        <div class="modal-body">

                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col">
                                        <label for="txt_vitola" class="form-label" style="width:100%;">Marca</label>
                                        <select class=" mi-selector" name="marca" id="marca"
                                            placeholder="Ingresa figura y tipo" style=" height:30px; width: 100%; "
                                            name="states[]" required>
                                            @foreach($marcas as $marca)
                                            <option> {{$marca->marca}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col">
                                        <label for="txt_figuraytipo" class="form-label">Item</label>
                                        <input name="item" id="item" style="font-size:16px" class="form-control"
                                            required type="text" autocomplete="off">
                                    </div>

                                    <div class="mb-3 col">
                                        <label for="txt_figuraytipo" class="form-label" style="width:100%;">Capa</label>
                                        <select class="form-control mi-selector" name="capa" id="capa"
                                            placeholder="Ingresa figura y tipo" style="overflow-y: scroll; width:100%;"
                                            required>
                                            @foreach($capas as $capa)
                                            <option style="overflow-y: scroll;"> {{$capa->capa}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 col">
                                        <label for="txt_total" class="form-label" style="width:100%;">Nombre</label>

                                        <select class="form-control mi-selector" name="nombre" id="nombre"
                                            placeholder="Ingresa figura y tipo" style="overflow-y: scroll; width:100%;"
                                            required>
                                            @foreach($nombres as $nombre)
                                            <option style="overflow-y: scroll;"> {{$nombre->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="mb-3 col">
                                        <label for="txt_buenos" class="form-label" style="width:100%;">Vitola</label>

                                        <select class="form-control mi-selector" name="vitola" id="vitola"
                                            placeholder="Ingresa figura y tipo" style="overflow-y: scroll; width:100%;"
                                            required>
                                            @foreach($vitolas as $vitola)
                                            <option style="overflow-y: scroll;"> {{$vitola->vitola}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="mb-3 col">
                                        <label for="txt_malos" class="form-label" style="width:100%;">Tipo de
                                            empaque</label>
                                        <select class="form-control mi-selector" name="tipo" id="tipo"
                                            placeholder="Ingresa figura y tipo" style="overflow-y: scroll;width:100%;"
                                            required>
                                            @foreach($tipo_empaques as $tipo_empaque)
                                            <option style="overflow-y: scroll;"> {{$tipo_empaque->tipo_empaque}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 col">
                                        <label for="txt_malos" class="form-label"
                                            style="width:100%;">Presentación</label>

                                        <select class="form-control" name="presentacion" id="presentacion"
                                            placeholder="Ingresa figura y tipo" style="overflow-y: scroll;  width:100%;"
                                            required>

                                            <option value="Puros Tripa Larga" style="overflow-y: scroll;">Puros Tripa
                                                Larga
                                            </option>
                                            <option value="Puros Tripa Corta" style="overflow-y: scroll;">Puros Tripa
                                                Corta
                                            </option>

                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col">
                                        <label for="txt_total" class="form-label">Código del
                                            sistema</label>
                                        <input name="cod_sistema" id="cod_sistema" class="form-control" required
                                            type="text" autocomplete="off">
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="txt_buenos" class="form-label">Código de
                                            precio</label>
                                        <input name="cod_precio" id="cod_precio" class="form-control" required
                                            type="text" autocomplete="off">
                                    </div>

                                    <div class="mb-3 col">
                                        <label for="txt_total" class="form-label">Código de la cajita</label>
                                        <input name="cod_caja" id="cod_caja" class="form-control" required type="text"
                                            autocomplete="off">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col">
                                        <input type="checkbox" name="cello" id="cello" style="font-size:20px"
                                            value="si">
                                        <label for="cello" class="form-label">Cello</label>
                                    </div>
                                    <div class="mb-3 col">

                                        <input type="checkbox" name="anillo" id="anillo" style="font-size:20px"
                                            value="si">
                                        <label for="anillo" class="form-label">Anillo</label>
                                    </div>
                                    <div class="mb-3 col">

                                        <input type="checkbox" name="upc" id="upc" style="font-size:20px" value="si">
                                        <label for="upc" class="form-label">UPC</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class=" bmodal_no"
                                onclick="ocultar_div_AddProducto()"><span>Cancelar</span>
                                @csrf
                            </button>
                            <button onclick="agregarproducto()" class=" bmodal_yes " type="submit"> <span>Guardar</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
        <!-- FIN DEL MODAL NUEVO PRODUCTO -->
    </div>





    <script type="text/javascript">
        function ocultar_div_AddProducto() {

            document.getElementById('div_AddProducto').style.display = "none";
        }

        function mostrar_div_AddProducto() {
            document.getElementById('div_AddProducto').style.display = "flex";
        }



        function ocultar_div_EditarProducto() {

            document.getElementById('div_EditarProducto').style.display = "none";
        }


        function mostrar_div_EditarProducto() {
            document.getElementById('div_EditarProducto').style.display = "flex";
        }



        function ocultar_div_AddDetalleProducto() {

            document.getElementById('div_AddDetalleProducto').style.display = "none";
        }


        
    </script>

    
</div>