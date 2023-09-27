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


        <div class="container" style="max-width:100%;">
        <div class="panel-body" style="padding:10px;">
        <input name="buscar" id="buscar" style="width:350px;" class=" form-control  mr-sm-2 "
                        wire:model="busqueda" placeholder="Búsqueda por Item"><br>
            <div
                style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;  height:80%;">
                @csrf
                <table class="table table-light" style="font-size:10px;">
                    <thead style=" position: static;">
                        <tr style="font-size:16px; text-align:center;">
                            <th style=" text-align:center;">#</th>
                            <th style=" text-align:center;">Item</th>
                            <th style=" text-align:center;">Código producto</th>
                            <th style=" text-align:center;">Capa</th>
                            <th style=" text-align:center;">Vitola</th>
                            <th style=" text-align:center;">Nombre</th>
                            <th style=" text-align:center;">Marca</th>
                            <th style=" text-align:center;">Cello</th>
                            <th style=" text-align:center;">Anillo</th>
                            <th style=" text-align:center;">UPC</th>
                            <th style=" text-align:center;">Tipo de Empaque</th>
                            <th style=" text-align:center;">Código precio</th>
                            <th style=" text-align:center;">Precio</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php $i = 0;?>
                        @foreach($detalles as $detalle)
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$detalle->item}}</td>
                            <td>{{$detalle->codigo_producto}}</td>
                            <td>{{$detalle->capa}}</td>
                            <td>{{$detalle->vitola}}</td>
                            <td>{{$detalle->nombre}}</td>
                            <td>{{$detalle->marca}}</td>
                            <td>{{$detalle->cello}}</td>
                            <td>{{$detalle->anillo}}</td>
                            <td>{{$detalle->upc}}</td>
                            <td>{{$detalle->tipo_empaque}}</td>
                            <td>{{$detalle->otra_descripcion}}</td>
                            <td>{{$detalle->precio}}</td>
                            <td>  <a style=" width:10px; height:10px;" data-bs-toggle="modal" href=""
                                data-bs-target="#modal_actualizar" type="submit"
                                onclick="cargar_datos_editar({{$detalle->id_producto}})">
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
            document.getElementById('div_EditarDetalleProducto').style.display = "flex";

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



            var productos = '<?php echo json_encode($detalles);?>';

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
                    document.formulario_actualizar.cod_sistema_ac.value = producto[i].codigo_producto;
                    document.formulario_actualizar.cod_precio_ac.value = producto[i].otra_descripcion;
                    document.formulario_actualizar.precio_ac.value = producto[i].precio;
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

        function ocultar_div_EditarProducto() {

document.getElementById('div_EditarDetalleProducto').style.display = "none";
}

    </script>




<div style="  display: none;justify-content: center;align-items: center; height:100%;position:fixed;top:0px;width:50%;left:25%;"
        id="div_EditarDetalleProducto">
        <!-- INICIO MODAL ACTUALIZAR PRODUCTO-->
        <form action="{{Route('actualizar_detalle_producto')}}" method="POST" name="formulario_actualizar"
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
                                    <label for="txt_figuraytipo" class="form-label">Item</label>
                                    <input name="item_ac" id="item_ac" class="form-control" required type="text"
                                        autocomplete="off" readonly>
                                </div>

                                <div class="mb-3 col">
                                    <label for="marca_ac" class="form-label">Marca</label>
                                    <select class=" mi-selector" style=" height:30px; width: 100%; " name="marca_ac"
                                        id="marca_ac" placeholder="Ingresa figura y tipo" required>
                                        @foreach($marcas as $marca)
                                        <option style="overflow-y: scroll;"> {{$marca->marca}}</option>
                                        @endforeach
                                    </select>
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
                            </div>


                            <div class="row">

                                <div class="mb-3 col">
                                    <label for="txt_total" class="form-label">Nombre</label>
                                    <select class=" mi-selector" style=" height:30px; width: 100%; " name="nombre_ac"
                                        id="nombre_ac" placeholder="Ingresa figura y tipo" required>
                                        @foreach($nombres as $nombre)
                                        <option style="overflow-y: scroll;"> {{$nombre->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>

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
                                    <label for="txt_buenos" class="form-label">Precio</label>
                                    <input name="precio" id="precio_ac" class="form-control"  type="text"
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


                            <div class="row" hidden>

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


</div>
