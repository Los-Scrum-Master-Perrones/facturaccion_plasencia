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
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}" />

    </br>
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="pendiente_empaque"><strong>Pendiente</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="importar_c"><strong>Existencia en bodega</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="inventario_cajas"><strong>Existencia de cajas</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href=""><strong>Programaciones</strong></a>
        </li>
    </ul>
    <br>

    <div class="" style="width:1250px; padding-left:100px;">

        <div class="row">

            <div class="col-sm">


                <div class="row">

                    <div class="col-sm">
                        <input name="buscar" id="buscar" class="btn botonprincipal form-control" wire:model="busqueda"
                            placeholder="Búsqueda por Marca, Nombre y Vitola" style="width:450px;">
                    </div>

                    <div class="col-sm" style="text-align:right">
                        <button type="button" name="crear_programacion" id="crear_programacion"
                            class="btn botonprincipal form-control" value="" style="width:200px;">
                            Crear programación</button>
                    </div>

                </div>

            </div>


        </div>
    </div>

    </br>

    <div style="width:1350px; padding-left:20px; padding-right:20px;">

        <div class="col-sm">
            <table class="table table-light" id="editable" style="font-size:10px;m">
                <thead>
                    <tr style="font-size:16px; text-align:center;">
                        <th># ORDEN</th>
                        <th style=" text-align:center;">ORDEN</th>
                        <th style=" text-align:center;">MARCA</th>
                        <th style=" text-align:center;">VITOLA</th>
                        <th style=" text-align:center;">NOMBRE</th>
                        <th style=" text-align:center;">CAPA</th>
                        <th style=" text-align:center;">TIPO DE EMPAQUE</th>
                        <th style=" text-align:center;">ANILLO</th>
                        <th style=" text-align:center;">CELLO</th>
                        <th style=" text-align:center;">UPC</th>
                        <th style=" text-align:center;">SALDO</th>
                        <th style=" text-align:center;">OPERACIONES</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach($detalles_provicionales as $detalle_provicional)
                    <tr>
                        <td>{{$detalle_provicional->numero_orden}}</td>
                        <td>{{$detalle_provicional->orden}}</td>
                        <td>{{$detalle_provicional->marca}}</td>
                        <td>{{$detalle_provicional->vitola}}</td>
                        <td>{{$detalle_provicional->nombre}}</td>
                        <td>{{$detalle_provicional->capa}}</td>
                        <td>{{$detalle_provicional->tipo_empaque}}</td>
                        <td>{{$detalle_provicional->anillo}}</td>
                        <td>{{$detalle_provicional->cello}}</td>
                        <td>{{$detalle_provicional->upc}}</td>
                        <td>{{$detalle_provicional->saldo}}</td>
                        <td>
                            <a data-toggle="modal" data-target="#modal_eliminar_detalle"
                                onclick="datos_modal_eliminar({{ $detalle_provicional->id }})" href="{{$ids = $detalle_provicional->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                </svg></a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>


    <script type="text/javascript">
        function datos_modal_eliminar(id) {
            var datas = '<?php echo json_encode($detalles_provicionales);?>';

            var data = JSON.parse(datas);


            for (var i = 0; i < data.length; i++) {
                if (data[i].id === id) {
                    document.formulario_mostrarE.id_usuarioE.value = data[i].id;


                }
            }

        }
    </script>

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




    <!-- INICIO MODAL ELMINAR DETALLE -->
    <form action="{{Route('borrardetalles_programacion')}}"  method= "POST" id="formulario_mostrarE"
        name="formulario_mostrarE" action="" method="POST">

        @csrf
        <?php use App\Http\Controllers\UserController; ?>
        <div hidden>{{$id_usuario_basicoE=0}}</div>

        <input name="id_usuarioE" id="id_usuarioE" value="" hidden />

        <div class="modal fade" id="modal_eliminar_detalle" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Eliminar a <strong><input value=""
                                    id="txt_usuarioE" name="txt_usuarioE" style="border:none;"></strong> </h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro que quieres eliminar este usuario?
                    </div>
                    <div class="modal-footer">
                        <button style=" background: #b39f64; color: #ecedf1;" type="button" class=" btn-info-claro "
                            data-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button type="submit" class=" btn-info ">
                            <span>Eliminar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <!-- FIN MODAL ELMINAR DETALLE -->

</div>
