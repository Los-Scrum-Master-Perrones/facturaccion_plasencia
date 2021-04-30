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

    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}"/>

    </br>
    <ul class="nav justify-content-center">

    <li class="nav-item">
            <a style="color:black; font-size:16px;" href="pendiente"><strong>Pendiente</strong></a>
        </li>

         <li class="nav-item">
            <a style="color:black; font-size:16px;" href="productos"><strong>Productos</strong></a>
        </li>
        
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="import_excel"><strong>Importar pedido</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="index_bodega_proceso"><strong>Reporte</strong></a>
        </li>

    </ul>
    <h3 style="	text-align:center;  width:auto;"><strong>Inventario de productos Plasencia</strong></h3>
    <br />

    <div class="" style="width:1100px; padding-left:200px;">

        <div class="row">

            <div class="col-sm">


                <div class="row">
                    <div class="col-sm">
                        <input name="buscar" id="buscar" class="btn botonprincipal form-control" wire:model="busqueda"
                            placeholder="Búsqueda por Marca, Nombre y Vitola" style="width:350px;">
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-sm">
                    <button class="btn botonprincipal form-control" data-toggle="modal"
                        data-target="#modal_nuevoproducto" style="width:200px;">Nuevo
                        producto</button>
                </div>

                <div class="col-sm">

                    <a class="btn botonprincipal form-control" href="{{Route('datos_producto')}}"
                        style="width:200px;">Datos adicionales</a>
                </div>
            </div>

        </div>
    </div>

    </br>


    <div style="width:1250px; padding-left:100px;">
        <div class="table-responsive">
            @csrf
            <table class="table table-light" id="editable" style="font-size:10px;m">
                <thead>
                    <tr style="font-size:16px; text-align:center;">
                        <th style=" text-align:center;">Item</th>
                        <th style=" text-align:center;">Marca</th>
                        <th style=" text-align:center;">Nombre</th>
                        <th style=" text-align:center;">Vitola</th>
                        <th style=" text-align:center;">Tipo de empaque</th>
                        <th style=" text-align:center;">Detalles</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                    <tr>
                        <td>{{$producto->item}}</td>
                        <td>{{$producto->marca}}</td>
                        <td>{{$producto->nombre}}</td>
                        <td>{{$producto->vitola}}</td>
                        <td>{{$producto->tipo_empaque}}</td>
                        <td style=" text-align:center;">

                            <a  style=" width:30px; height:30px;" data-toggle="modal"
                                data-target="#modal_agregarproducto" href=""
                                onclick="agregar_item({{$producto->id_producto}},{{ strlen($producto->item)}})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
                                    <path
                                        d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z" />
                                    <path
                                        d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
                                </svg>
                            </a>

                            <a style=" width:10px; height:10px;" data-toggle="modal" href=""
                                data-target="#modal_ver_detalle_producto"
                                onclick="item_detalle(parseInt({{$producto->item}},10),{{ strlen($producto->item)}})">

                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-arrow-up-right-square" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.854 8.803a.5.5 0 1 1-.708-.707L9.243 6H6.475a.5.5 0 1 1 0-1h3.975a.5.5 0 0 1 .5.5v3.975a.5.5 0 1 1-1 0V6.707l-4.096 4.096z" />
                                </svg>
                            </a>
                       
                            <a style=" width:10px; height:10px;" data-toggle="modal" href=""
                                data-target="#modal_actualizarproducto" type="submit" onclick="cargar_datos_editar({{$producto->id_producto}})">
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




<!-- SCRIPT MODAL EDITAR MOLDE -->

<script type="text/javascript">
    function cargar_datos_editar(id) {

        if(document.formulario_actualizar.cello_ac.checked){

        document.formulario_actualizar.cello_ac.click();

        }else{

        }
        if(document.formulario_actualizar.anillo_ac.checked){

        document.formulario_actualizar.anillo_ac.click();

        }else{

        }
        if(document.formulario_actualizar.upc_ac.checked){

        document.formulario_actualizar.upc_ac.click();

        }else{

        }




        var productos = '<?php echo json_encode($productos);?>';

        var producto = JSON.parse(productos);


        for (var i = 0; i < producto.length; i++) {

            if (producto[i].id_producto === id) {
             
                document.formulario_actualizar.marca_ac.value = producto[i].marca;
                document.formulario_actualizar.item_ac.value = producto[i].item;
                document.formulario_actualizar.capa_ac.value = producto[i].capa;
                document.formulario_actualizar.nombre_ac.value = producto[i].nombre;
                document.formulario_actualizar.vitola_ac.value = producto[i].vitola;
                document.formulario_actualizar.tipo_ac.value = producto[i].tipo_empaque;
                document.formulario_actualizar.presentacion_ac.value = producto[i].presentacion;
                document.formulario_actualizar.cod_sistema_ac.value = producto[i].codigo_producto;
                document.formulario_actualizar.cod_precio_ac.value = producto[i].codigo_precio;
                document.formulario_actualizar.cod_caja_ac.value = producto[i].codigo_caja;
               
                document.formulario_actualizar.id_producto.value = producto[i].id_producto;



                if(producto[i].cello === "SI"){
                    
                     document.formulario_actualizar.cello_ac.click();
                   
                }else{
                
                     
                }

                if(producto[i].anillo === "SI"){  
                    document.formulario_actualizar.anillo_ac.click();
                }else{
                    
                }

                if(producto[i].upc === "SI"){
                    
                    document.formulario_actualizar.upc_ac.click();
                    }else{
                    }

                

            }
        }

    }
</script>

<!-- FIN SCRIPT MODAL EDITAR MOLDE -->
c


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


    <!-- INICIO DEL MODAL NUEVO PRODUCTO -->

    <form action="{{Route('nuevo_producto')}} " method="POST">
        <div class="modal fade" role="dialog" id="modal_nuevoproducto" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
            style="opacity:.9;background:#212529;width=800px;">
            <div class="modal-dialog modal-dialog-centered modal-lg" style="opacity:.9;background:#212529;width=80%">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 style="font-size:20px; width:3000px; text-align:center; font:bold" class=""
                            id="staticBackdropLabel"><strong>Agregar producto</strong></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col">
                                    <label style="font-size:16px" for="txt_vitola" class="form-label">Marca</label>
                                    <select class="form-control" name="marca" id="marca"
                                        placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;"
                                        required>
                                        @foreach($marcas as $marca)
                                        <option style="overflow-y: scroll;"> {{$marca->marca}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col">
                                    <label style="font-size:16px" for="txt_figuraytipo" class="form-label">Item</label>
                                    <input name="item" id="item" style="font-size:16px" class="form-control" required
                                        type="text" autocomplete="off">
                                </div>

                                <div class="mb-3 col">
                                    <label style="font-size:16px" for="txt_figuraytipo" class="form-label">Capa</label>
                                    <select class="form-control" name="capa" id="capa"
                                        placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;"
                                        required>
                                        @foreach($capas as $capa)
                                        <option style="overflow-y: scroll;"> {{$capa->capa}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_total" style="font-size:16px" class="form-label">Nombre</label>

                                    <select class="form-control" name="nombre" id="nombre"
                                        placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;"
                                        required>
                                        @foreach($nombres as $nombre)
                                        <option style="overflow-y: scroll;"> {{$nombre->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="row">

                                <div class="mb-3 col">
                                    <label style="font-size:16px" for="txt_buenos" class="form-label">Vitola</label>

                                    <select class="form-control" name="vitola" id="vitola"
                                        placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;"
                                        required>
                                        @foreach($vitolas as $vitola)
                                        <option style="overflow-y: scroll;"> {{$vitola->vitola}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="mb-3 col">
                                    <label style="font-size:16px" for="txt_malos" class="form-label">Tipo de
                                        empaque</label>
                                    <select class="form-control" name="tipo" id="tipo"
                                        placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;"
                                        required>
                                        @foreach($tipo_empaques as $tipo_empaque)
                                        <option style="overflow-y: scroll;"> {{$tipo_empaque->tipo_empaque}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col">
                                    <label style="font-size:16px" for="txt_malos"
                                        class="form-label">Presentación</label>

                                    <select class="form-control" name="presentacion" id="presentacion"
                                        placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;"
                                        required>

                                        <option value="Puros Tripa Larga" style="overflow-y: scroll;">Puros Tripa Larga
                                        </option>
                                        <option value="Puros Tripa Corta" style="overflow-y: scroll;">Puros Tripa Corta
                                        </option>

                                    </select>
                                </div>
                            </div>



                            <div class="row">


                                <div class="mb-3 col">
                                    <label for="txt_total" style="font-size:16px" class="form-label">Código del
                                        sistema</label>
                                    <input name="cod_sistema" id="cod_sistema" style="font-size:16px"
                                        class="form-control" required type="text" autocomplete="off">
                                </div>
                                <div class="mb-3 col">
                                    <label style="font-size:16px" for="txt_buenos" class="form-label">Código de
                                        precio</label>
                                    <input name="cod_precio" id="cod_precio" style="font-size:16px" class="form-control"
                                        required type="text" autocomplete="off">
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_total" style="font-size:16px" class="form-label">Código de la
                                        cajita</label>
                                    <input name="cod_caja" id="cod_caja" style="font-size:16px" class="form-control"
                                        required type="text" autocomplete="off">
                                </div>

                            </div>


                            <div class="row">
                                <div class="mb-3 col">
                                    <input type="checkbox" name="cello" id="cello" style="font-size:20px" value="si">
                                    <label style="font-size:16px" for="cello" class="form-label">Cello</label>
                                </div>
                                <div class="mb-3 col">

                                    <input type="checkbox" name="anillo" id="anillo" style="font-size:20px" value="si">
                                    <label style="font-size:16px" for="anillo" class="form-label">Anillo</label>
                                </div>
                                <div class="mb-3 col">

                                    <input type="checkbox" name="upc" id="upc" style="font-size:20px" value="si">
                                    <label style="font-size:16px" for="upc" class="form-label">UPC</label>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button style=" background: #b39f64; color: #ecedf1;" type="button" class=" btn-info-claro "
                            data-dismiss="modal">
                            <span style="font-size:16px">Cancelar</span>
                            @csrf
                        </button>
                        <button class="submit">
                            <span style="font-size:16px">Guardar</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </form>
    <!-- FIN DEL MODAL NUEVO PRODUCTO -->





    <!-- INICIO MODAL ACTUALIZAR PRODUCTO-->

  
    <form action="{{Route('actualizar_producto')}}" method="POST" name="formulario_actualizar" id="formulario_actualizar">
        <div class="modal fade" role="dialog" id="modal_actualizarproducto" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
            style="opacity:.9;background:#212529;width=800px;">
            <div class="modal-dialog modal-dialog-centered modal-lg" style="opacity:.9;background:#212529;width=80%">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 style="font-size:20px; width:3000px; text-align:center; font:bold" class=""
                            id="staticBackdropLabel"><strong>Editar producto</strong></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col">
                                    <label style="font-size:16px" for="txt_vitola" class="form-label">Marca</label>
                                    <select class="form-control" name="marca_ac" id="marca_ac" 
                                        placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;"
                                        required>
                                        @foreach($marcas as $marca)
                                        <option style="overflow-y: scroll;"> {{$marca->marca}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col">
                                    <label style="font-size:16px" for="txt_figuraytipo" class="form-label">Item</label>
                                    <input name="item_ac" id="item_ac" style="font-size:16px" class="form-control" required
                                        type="text" autocomplete="off" >
                                </div>

                                <div class="mb-3 col">
                                    <label style="font-size:16px" for="txt_figuraytipo" class="form-label">Capa</label>
                                    <select class="form-control" name="capa_ac" id="capa_ac" 
                                        placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;"
                                        required>
                                        @foreach($capas as $capa)
                                        <option style="overflow-y: scroll;"> {{$capa->capa}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_total" style="font-size:16px" class="form-label">Nombre</label>

                                    <select class="form-control" name="nombre_ac" id="nombre_ac" 
                                        placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;"
                                        required>
                                        @foreach($nombres as $nombre)
                                        <option style="overflow-y: scroll;"> {{$nombre->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="row">

                                <div class="mb-3 col">
                                    <label style="font-size:16px" for="txt_buenos" class="form-label">Vitola</label>

                                    <select class="form-control" name="vitola_ac" id="vitola_ac" 
                                        placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;"
                                        required>
                                        @foreach($vitolas as $vitola)
                                        <option style="overflow-y: scroll;"> {{$vitola->vitola}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="mb-3 col">
                                    <label style="font-size:16px" for="txt_malos" class="form-label">Tipo de
                                        empaque</label>
                                    <select class="form-control" name="tipo_ac" id="tipo_ac"
                                        placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;"
                                        required>
                                        @foreach($tipo_empaques as $tipo_empaque)
                                        <option style="overflow-y: scroll;"> {{$tipo_empaque->tipo_empaque}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col">
                                    <label style="font-size:16px" for="txt_malos"
                                        class="form-label">Presentación</label>

                                    <select class="form-control" name="presentacion_ac" id="presentacion_ac"
                                        placeholder="Ingresa figura y tipo"
                                        style="overflow-y: scroll; height:30px;" required>

                                        <option value="Puros Tripa Larga" style="overflow-y: scroll;">Puros Tripa Larga
                                        </option>
                                        <option value="Puros Tripa Corta" style="overflow-y: scroll;">Puros Tripa Corta
                                        </option>

                                    </select>
                                </div>
                            </div>



                            <div class="row">


                                <div class="mb-3 col">
                                    <label for="txt_total" style="font-size:16px" class="form-label">Código del
                                        sistema</label>
                                    <input name="cod_sistema_ac" id="cod_sistema_ac" style="font-size:16px"
                                        class="form-control"  type="text"
                                        autocomplete="off">
                                </div>
                                <div class="mb-3 col">
                                    <label style="font-size:16px" for="txt_buenos" class="form-label">Código de
                                        precio</label>
                                    <input name="cod_precio_ac" id="cod_precio_ac" style="font-size:16px" class="form-control"
                                         type="text" autocomplete="off" >
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_total" style="font-size:16px" class="form-label">Código de la
                                        cajita</label>
                                    <input name="cod_caja_ac" id="cod_caja_ac" style="font-size:16px" class="form-control"
                                         type="text" autocomplete="off" >
                                </div>

                            </div>


                            <div class="row">
                                <div class="mb-3 col">
                                    <input type="checkbox" name="cello_ac" id="cello_ac" style="font-size:20px"  value="si">
                                    <label style="font-size:16px" for="cello" class="form-label">Cello</label>
                                </div>
                                <div class="mb-3 col">

                                    <input type="checkbox" name="anillo_ac" id="anillo_ac" style="font-size:20px"  value="si">
                                    <label style="font-size:16px" for="anillo" class="form-label">Anillo</label>
                                </div>
                                <div class="mb-3 col">

                                    <input type="checkbox" name="upc_ac" id="upc_ac" style="font-size:20px"  value="si">
                                    <label style="font-size:16px" for="upc" class="form-label">UPC</label>
                                </div>

   <input name="id_producto" id="id_producto" value="" hidden>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button style=" background: #b39f64; color: #ecedf1;" type="button" class=" btn-info-claro "
                            data-dismiss="modal">
                            <span style="font-size:16px">Cancelar</span>
                            @csrf
                        </button>
                       
                        <button class="submit" >
                            <span style="font-size:16px">Guardar</span>
                        </button>
                      

                    </div>

                </div>
            </div>
        </div>
    </form>
    <!-- FIN  MODAL ACTUALIZAR PRODUCTO -->









    <!-- INICIO DEL MODAL AGREGAR DETALLE PRODUCTO -->

    <form action="{{Route('detalle')}}" method="POST" id="form_detalle" name="form_detalle">
        <div class="modal fade" role="dialog" id="modal_agregarproducto" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
            style="opacity:.9;background:#212529;width=800px;">
            <div class="modal-dialog modal-dialog-centered modal-lg" style="opacity:.9;background:#212529;width=80%">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 style="font-size:20px; width:3000px; text-align:center; font:bold" class=""
                            id="staticBackdropLabel">Agregar detalle del producto</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="card-body">

                            <div class="row">
                                <div class="mb-3 col">
                                    <label style="font-size:16px" for="txt_figuraytipo" class="form-label">Item</label>
                                    <input name="item_de" id="item_de" style="font-size:16px" class="form-control"
                                        required type="text" autocomplete="off" readonly>
                                </div>
                                <div class="mb-3 col">
                                    <label style="font-size:16px" for="txt_figuraytipo" class="form-label">Capa</label>
                                    <input name="capa_de" id="capa_de" style="font-size:16px" class="form-control"
                                        required type="text" autocomplete="off">
                                </div>

                                <div class="mb-3 col">
                                    <label style="font-size:16px" for="txt_vitola" class="form-label">Marca</label>
                                    <input name="marca_de" id="marca_de" style="font-size:16px" class="form-control"
                                        required type="text" autocomplete="off">

                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="txt_total" style="font-size:16px" class="form-label">Nombre</label>
                                    <input name="nombre_de" id="nombre_de" style="font-size:16px" class="form-control"
                                        required type="text" autocomplete="off"> </div>
                                <div class="mb-3 col">
                                    <label style="font-size:16px" for="txt_buenos" class="form-label">Vitola</label>
                                    <input name="vitola_de" id="vitola_de" style="font-size:16px" class="form-control"
                                        required type="text" autocomplete="off"> </div>
                                <div class="mb-3 col">
                                    <label style="font-size:16px" for="txt_malos" class="form-label">Tipo de
                                        empaque</label>
                                    <input name="tipo_de" id="tipo_de" style="font-size:16px" class="form-control"
                                        required type="text" autocomplete="off">
                                </div>

                            </div>




                            <div class="row">
                                <div class="mb-3 col">
                                    <input type="checkbox" name="cello_de" id="cello_de" style="font-size:20px"
                                        value="si">
                                    <label style="font-size:16px" for="cello" class="form-label">Cello</label>
                                </div>
                                <div class="mb-3 col">

                                    <input type="checkbox" name="anillo_de" id="anillo_de" style="font-size:20px"
                                        value="si">
                                    <label style="font-size:16px" for="anillo" class="form-label">Anillo</label>
                                </div>
                                <div class="mb-3 col">

                                    <input type="checkbox" name="upc_de" id="upc_de" style="font-size:20px" value="si">
                                    <label style="font-size:16px" for="upc" class="form-label">UPC</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col">

                                    <label style="font-size:16px" for="txt_malos" class="form-label">Código de
                                        precio</label>
                                    <input name="precio_de" id="precio_de" style="font-size:16px" class="form-control"
                                        required type="text" autocomplete="off">
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button style=" background: #b39f64; color: #ecedf1;" type="button" class=" btn-info-claro "
                            data-dismiss="modal">
                            <span style="font-size:16px">Cancelar</span>
                            @csrf
                        </button>
                        <button class="submit">
                            <span style="font-size:16px">Guardar</span>
                        </button>


                    </div>


                </div>
            </div>
        </div>
    </form>
    <!-- FIN DEL MODAL AGREGAR DETALLE PRODUCTO -->


    <!-- INICIO DEL MODAL VER DETALLE PRODUCTO -->

    <form action="{{Route('detalle_producto')}} " method="POST" name="formde" id=" formde">
        <div class="modal fade" role="dialog" id="modal_ver_detalle_producto" data-backdrop="static"
            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
            style="opacity:.9;background:#212529;width=800px;">
            <div class="modal-dialog modal-dialog-centered modal-lg" style="opacity:.9;background:#212529;width=80%">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-size:20px; width:3000px; text-align:center; font:bold" class=""
                            id="staticBackdropLabel">Detalles del producto</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="card-body">

                            <div class="row">
                                <h3 name="clase" id="clase" style="font-weight: bold;"></h3>
                            </div>
                            <div class="row">
                                <table id="detallestabla" name="detallestabla"
                                    class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Marca</th>
                                            <th>Nombre</th>
                                            <th>Vitola</th>
                                            <th>Tipo de empaque</th>

                                        </tr>
                                    </thead>
                                    <tbody name="body" id="body">

                                    </tbody>
                                </table>

                            </div>


                            <div class="modal-footer">



                            </div>
                        </div>

                        <input name="item_detalle" id="item_detalle" value+="" hidden> </input>
                    </div>
                </div>

    </form>
    <!-- FIN DEL MODAL VER DETALLE PRODUCTO -->

</div>
