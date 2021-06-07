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

        <div class="row" style="text-align:center;">

            <div class="col">
                <div class="input-group mb-3">


                    <span class="input-group-text form-control ">Fecha</span>
                    <input type="date" name="fecha_de" id="fecha_de" wire:model="fechade" class="form-control "
                        style="width:200px;" placeholder="Nombre">

                    <input name="nombre" id="nombre" class="form-control mr-sm-2 " style="width:200px;"
                        placeholder="Nombre" wire:model="nombre">

                    <form action="{{Route('exportar_pendiente')}}">
                        <input type="text" value="{{isset($nom)?$nom:null}}" name="nombre" id="nombre" hidden>
                        <input type="date" value="{{isset($fede)?$fede:null}}" name="fecha_de" id="fecha_de" hidden>
                    </form>

                    <form wire:submit.prevent="insertar_detalle_provicional()">
                        @csrf
                        <button class="mr-sm-2 botonprincipal" style="width:200px;">Agregar Programación </button>
                    </form>

                    <a href="/detalles_programacion"> <button class="mr-sm-2 botonprincipal" style="width:200px;">
                            Ver</button></a>

                </div>
            </div>
        </div>

    </div>









    <div class="panel-body" style="padding:0px;">
        <div style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;
     height:450px;">
            @csrf
            <table class="table table-light" style="font-size:10px;">
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
                <tbody>
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
                        <td>{{$datos->pendiente_empaque}}</td>
                        <td>{{$datos->saldo}}</td>
                        <td style="text-align:center;">

                            <?php if( str_contains(strtoupper((string)($datos->nombre)) , 'PRESS'))    {   
                       echo' <a style=" width:10px; height:10px;" data-toggle="modal" href="" data-target="#modal_actualizar"';
                       echo'type="submit" wire:click.prevent= "insertar_detalle_provicional_sin_existencia('.$datos->id_pendiente.')">';

                       echo'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"';
                       echo'    class="bi bi-arrow-up-right-square-fill" viewBox="0 0 16 16">';
                       echo'    <path';
                       echo'        d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12zM5.904 10.803 10 6.707v2.768a.5.5 0 0 0 1 0V5.5a.5.5 0 0 0-.5-.5H6.525a.5.5 0 1 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 .707.707z" />';
                       echo'</svg>';
                       echo'</a>';
                    }?>

                            <a style=" width:10px; height:10px;" data-toggle="modal" href=""
                                data-target="#modal_actualizar" type="submit"
                                onclick="datos_modal_actualizar({{$datos->id_pendiente}})">
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
            </table>
        </div>
    </div>



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

                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">SALDO</label>
                                <input name="saldo" id="saldo" class="form-control" type="text" autocomplete="off">
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
                        [1, 'first_name'],
                        [2, 'last_name'],
                        [3, 'gender']
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
</div>
