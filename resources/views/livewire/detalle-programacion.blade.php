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

    </br>



    <div class="container" style="max-width:100%; ">

        <div class="row" style="text-align:center;">

            <div class="col">
                <div class="input-group mb-3">

                    <a type="button" name="crear_programacion" id="crear_programacion" href="pendiente_empaque"
                        class=" botonprincipal   mr-sm-2" value="" style="width:70px; ">
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
                    <form wire:submit.prevent="modal_limpiar()">
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


        <!-- <script type="text/javascript">
        window.onload = function () {
            var fecha = new Date(); //Fecha actual
            var mes = fecha.getMonth() + 1; //obteniendo mes
            var dia = fecha.getDate(); //obteniendo dia
            var ano = fecha.getFullYear(); //obteniendo año
            if (dia < 10)
                dia = '0' + dia; //agrega cero si el menor de 10
            if (mes < 10)
                mes = '0' + mes //agrega cero si el menor de 10
            document.getElementById('fecha_creacion').value = ano + "-" + mes + "-" + dia;
        }
    </script> -->



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
                            <th style=" text-align:center;">SOLICITAR(CAJAS)</th>
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
                            <td>{{$detalle_provicional->total_existencia}}</td>
                            <?php  if($detalle_provicional->diferencia < 0){

                        echo '<td style="color:red;">'.$detalle_provicional->diferencia.'</td>' ;

                        }else{

                        echo '<td>' .$detalle_provicional->diferencia. '</td>' ;
                        }
                        ?>

                            <?php   if($detalle_provicional->existencia < 0){

                        echo '<td style="color:red;">'.$detalle_provicional->existencia.'</td>' ;

                        }else{

                        echo '<td>' .$detalle_provicional->existencia. '</td>' ;
                        }
                        ?>

                            <td style="text-align:center">

                                <a data-toggle="modal" data-target="#modal_eliminar_detalle"
                                    onclick="datos_modal_eliminar({{ $detalle_provicional->id }})"
                                    href="{{$ids = $detalle_provicional->id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </a>

                                <a style=" width:10px; height:10px;" data-toggle="modal" href=""
                                    data-target="#modal_actualizar_saldo" type="submit"
                                    onclick="datos_modal_actualizar({{$detalle_provicional->id}})">
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



    <!-- INICIO MODAL ACTUALIZAR SALDO-->
    <form action="{{Route('actualizar_rdetalles_programacion')}}" method="POST" id="form_saldo" name="form_saldo">
        <div class="modal fade" id="modal_actualizar_saldo" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <input id="id_detalle" name="id_detalle" hidden>

                        <input id="cant_cajas" name="cant_cajas" hidden>

                        <input id="saldo_viejo" name="saldo_viejo" hidden>

                        <input id="id_pendientea" name="id_pendientea" hidden>

                        <h5 class="modal-title" id="staticBackdropLabel"
                            style="width:450px; text-align:center; font-size:20px;">Actualizar saldo</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label"
                                style="width:440px; text-align:center; font-size:20px;">Nuevo saldo</label>

                            <input class="form-control" id="saldo" name="saldo" placeholder="Ingresar saldo"
                                style="width: 440px" maxLength="30" autocomplete="off" type="number">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button style=" background: #b39f64; color: #ecedf1;" type="button" class=" btn-info-claro "
                            data-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button class=" btn-info float-right" style="margin-right: 10px">
                            <span>Actualizar</span>
                        </button>

                        @csrf
                        <input name="id_planta" value='1' hidden />
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN MODAL  ACTUALIZAR SALDO -->


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
        function datos_modal_eliminar(id) {
            var datas = '<?php echo json_encode($detalles_provicionales);?>';

            var data = JSON.parse(datas);


            for (var i = 0; i < data.length; i++) {
                if (data[i].id === id) {
                    document.formulario_mostrarE.id_usuarioE.value = data[i].id;

                    document.formulario_mostrarE.saldo_viejoe.value = data[i].cant_cajas_necesarias;

                    document.formulario_mostrarE.id_pendientee.value = data[i].id_pendiente;

                    document.formulario_mostrarE.cant_cajase.value = data[i].cant_cajas;

                }
            }
        }
    </script>





    <!-- INICIO MODAL ELMINAR DETALLE -->
    <form action="{{Route('borrardetalles_programacion')}}" method="POST" id="formulario_mostrarE"
        name="formulario_mostrarE" action="" method="POST">

        @csrf
        <?php use App\Http\Controllers\UserController; ?>
        <div hidden>{{$id_usuario_basicoE=0}}</div>

        <input name="id_usuarioE" id="id_usuarioE" value="" hidden />

        <input id="cant_cajase" name="cant_cajase" hidden>

        <input id="saldo_viejoe" name="saldo_viejoe" hidden>

        <input id="id_pendientee" name="id_pendientee" hidden>
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
                        ¿Estás seguro que quieres eliminar este registro?
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
                    <button style=" background: #b39f64; color: #ecedf1;" type="button" class="btn-info-claro "
                        data-dismiss="modal">
                        <span>Cancelar</span>
                    </button>
                    <button wire:click="eliminar_datos()" class=" btn-info ">
                        <span>Eliminar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
