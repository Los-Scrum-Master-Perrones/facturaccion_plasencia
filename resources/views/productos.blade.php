
@extends('principal')


@section('content')

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




  
        <br />
        <h3 style="	text-align:center; font-size:35px; font:bold; width:1160px;">Inventario de productos Plasencia</h3>
        <br />
        <div class="" style="width:1100px; padding-left:100px;">

<div class="row">

    <div class="col-sm">


                <form action="{{Route('buscar')}}" method="POST" class="form-inline" name="form_tabla" id="form_tabla">
                    @csrf
                    <input name="vitolabuscar" id="vitolabuscar" class="form-control mr-sm-2" placeholder="Vitola"
                        style="width:150px;">
                    <button class="btn-dark" type="submit">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </span>
                    </button>
                </form>

                <button style="text-align: right;" data-toggle="modal" data-target="#modal_nuevoproducto">Nuevo
                    producto</button>

            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    @csrf
                    <table class="table table-light" id="editable" style="font-size:10px;m">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Marca</th>
                                <th>Nombre</th>
                                <th>Vitola</th>
                                <th>Tipo de empaque</th>
                                <th>Detalles</th>

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
                                <td>
                                
                                <a class="buttom"style="font-size:12px;" data-toggle="modal"
                                        data-target="#modal_agregarproducto" href=""
                                        onclick="agregar_item({{$producto->id_producto}},{{ strlen($producto->item)}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width=25 height="25" fill="black"
                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>hola
                                        
                                        
                                        </a>
                                    <button style="font-size:12px;" data-toggle="modal"
                                        data-target="#modal_ver_detalle_producto"
                                        onclick="item_detalle(parseInt({{$producto->item}},10),{{ strlen($producto->item)}})">Ver
                                        detalle</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


   
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
    <!-- <script src="{{ asset('js/app.js') }}" ></script> -->
   

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
                        id="staticBackdropLabel">Agregar producto</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="card-body">

                        <div class="row">
                            <div class="mb-3 col">
                                <label style="font-size:16px" for="txt_figuraytipo" class="form-label">Item</label>
                                <input name="item" id="item" style="font-size:16px" class="form-control" required
                                    type="text" autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                                <label style="font-size:16px" for="txt_figuraytipo" class="form-label">Capa</label>
                                <input name="capa" id="capa" style="font-size:16px" class="form-control" required
                                    type="text" autocomplete="off">
                            </div>

                            <div class="mb-3 col">
                                <label style="font-size:16px" for="txt_vitola" class="form-label">Marca</label>
                                <input name="marca" id="marca" style="font-size:16px" class="form-control" required
                                    type="text" autocomplete="off"> </div>


                        </div>

                        <div class="row">
                           <div class="mb-3 col">
                                <label for="txt_total" style="font-size:16px" class="form-label">Nombre</label>
                                <input name="nombre" id="nombre" style="font-size:16px" class="form-control" required
                                    type="text" autocomplete="off"> </div>
                            <div class="mb-3 col">
                                <label style="font-size:16px" for="txt_buenos" class="form-label">Vitola</label>
                                <input name="vitola" id="vitola" style="font-size:16px" class="form-control" required
                                    type="text" autocomplete="off"> </div>
                            <div class="mb-3 col">
                                <label style="font-size:16px" for="txt_malos" class="form-label">Tipo de empaque</label>
                                <input name="tipo" id="tipo" style="font-size:16px" class="form-control" required
                                    type="text" autocomplete="off"> </div>

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


<!-- INICIO DEL MODAL AGREGAR DETALLE PRODUCTO -->

<form action="{{Route('detalle')}}" method="POST" id="form_detalle" name="form_detalle"> -->
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
                                <input name="item_de" id="item_de" style="font-size:16px" class="form-control" required
                                    type="text" autocomplete="off" readonly>
                            </div>
                            <div class="mb-3 col">
                                <label style="font-size:16px" for="txt_figuraytipo" class="form-label">Capa</label>
                                <input name="capa_de" id="capa_de" style="font-size:16px" class="form-control" required
                                    type="text" autocomplete="off">
                            </div>

                            <div class="mb-3 col">
                                <label style="font-size:16px" for="txt_vitola" class="form-label">Marca</label>
                                <input name="marca_de" id="marca_de" style="font-size:16px" class="form-control"
                                    required type="text" autocomplete="off"> </div>


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
                                <label style="font-size:16px" for="txt_malos" class="form-label">Tipo de empaque</label>
                                <input name="tipo_de" id="tipo_de" style="font-size:16px" class="form-control" required
                                    type="text" autocomplete="off"> </div>

                        </div>


                    </div>

                    <div class="row">
                        <div class="mb-3 col">
                            <input type="checkbox" name="cello_de" id="cello_de" style="font-size:20px" value="si">
                            <label style="font-size:16px" for="cello" class="form-label">Cello</label>
                        </div>
                        <div class="mb-3 col">

                            <input type="checkbox" name="anillo_de" id="anillo_de" style="font-size:20px" value="si">
                            <label style="font-size:16px" for="anillo" class="form-label">Anillo</label>
                        </div>
                        <div class="mb-3 col">

                            <input type="checkbox" name="upc_de" id="upc_de" style="font-size:20px" value="si">
                            <label style="font-size:16px" for="upc" class="form-label">UPC</label>
                        </div>


                    </div>

                    <div class="row">
                        <div class="mb-3 col">

                            <label style="font-size:16px" for="txt_malos" class="form-label">Código de precio</label>
                            <input name="precio_de" id="precio_de" style="font-size:16px" class="form-control" required
                                type="text" autocomplete="off">
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
    <div class="modal fade" role="dialog" id="modal_ver_detalle_producto" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
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
                            <table id="detallestabla" name="detallestabla" class="table table-bordered table-striped">
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


@endsection




