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
            <a style="color:white; font-size:12px;" href="pendiente_empaque"><strong>Pendiente</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="importar_c"><strong>Existencia en bodega</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="inventario_cajas"><strong>Existencia de cajas</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:#E5B1E2; font-size:12px;" href=""><strong>Programaciones</strong></a>
        </li>
    </ul>
    <br>

    <div class="" style="width:1100px; padding-left:250px;">

        <div class="row" style="width:1100px;">


            <div class="col-sm-4" style="text-align:right;">
                @foreach($titulo as $programacion)
                <h4 style="color:#ffffff;" id="contenedor" name="contenedor" value="" wire:model="titulo"><strong>
                        {{$programacion ->mes_contenedor}}</strong></h4>
                @endforeach
            </div>
            <div class="col-sm-4" style="text-align:right;">
                <form action="{{Route('exportar_programacion')}}" id="formver" name="formver">
                    <input name="buscar" id="buscar" value="{{isset($busqueda)?$busqueda:null}}"
                        class="btn botonprincipal form-control" wire:model="busqueda"
                        placeholder="Búsqueda por Marca, Nombre y Vitola" style="width:400px; padding:right;">
            </div>
            <div class="col-sm-2" style="text-align:right;">

                <input value="{{isset($id_tov)?$id_tov:0}}" name="id_tov" id="id_tov" hidden wire:model="id_tov">

                <button class="botonprincipal" type="submit" style="width:120px;">Exportar
                </button>
            </div>
            </form>
            <div class="col-sm-2" style="text-align:right;">
            <form action="{{Route('exportar_programacion')}}" id="formverid" name="formverid">
            <input value="{{isset($id_tov)?$id_tov:0}}" name="id_tov" id="id_tov" hidden wire:model="id_tov">
            <button class="botonprincipal" type="submit" style="width:120px;">
            <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                        <path
                            d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                    </svg>
                </span>
                </button>
                
            </form>

            </div>

        </div>
    </div>

    </br>


    <div style="width:1350px; padding-left:20px; padding-right:20px;">

        <div class="row">
            <div class="col-sm" style="width:400px;">

                <table class="table table-light" id="editable" style="font-size:10px;m">
                    <thead>
                        <tr style="font-size:16px; text-align:center;">
                            <th style=" text-align:center;">#-No.</th>
                            <th style=" text-align:center;">FECHA</th>
                            <th style=" text-align:center; width:150px">CONTENEDOR</th>


                        </tr>
                    </thead>
                    <tbody>
                    <?php $c = 0;?>
                        @foreach($programaciones as $programacion)
                        <tr>
                            <td> <?php $c = $c + 1;  echo $c ?></td>
                            <td> {{$programacion ->fecha}}</td>
                            <td>
                                <div class="row">
                                    <div class="col-sm-6" style="text-align:left;"> {{$programacion ->mes_contenedor}}
                                    </div>
                                    <div class="col-sm-1" style="text-align:right;">
                                        <a data-toggle="modal" data-target="#modal_eliminar_programacion"
                                            onclick="datos_modal_eliminar_pro({{ $programacion->id}})" href="">
                                            <abbr title="Eliminar programación"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor" class="bi bi-trash-fill"
                                                    viewBox="0 0 16 16" style="color:red;">
                                                    <path
                                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                </svg>
                                            </abbr>
                                        </a>
                                    </div>
                                        <div class="col-sm-1" style="text-align:right;">
                                        <a style=" width:10px; height:10px;" data-toggle="modal" href=""
                                            data-target="#modal_actualizar_programacion" type="submit"
                                            onclick="datos_modal_actualizar_programacion({{$programacion->id}})">
                                            <abbr title="Editar programacion"> <svg xmlns="http://www.w3.org/2000/svg"
                                                    width="20" height="20" fill="currentColor"
                                                    class="bi bi-pencil-square" viewBox="0 0 16 16"
                                                    style="color:yellow;">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>
                                            </abbr>
                                        </a>

                                    </div>
                                    <div class="col-sm-1" style="text-align:right;">
                                    
                                   
                                        <form wire:submit.prevent="ver({{$programacion->id}})">
                                        <a style=" width:10px; height:10px;"  type="submit"
                                            onclick="verpro({{$programacion->id}})">
                                             <button data-toggle="modal" data-target="" href="" style="background: none; color: inherit;   border: none;  padding: 0;
                                                font: inherit;  cursor: pointer; outline: inherit;" >
                                               
                                                <abbr title="Mostrar detalles de la programación"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"
                                                        style="color:green;">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                        <path
                                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                    </svg>
                                                </abbr>
                                               
                                            </button>
                                            </a>
                                        </form>
                                        

                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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

                        @foreach($detalles_programaciones as $detalles_programacione)
                        <tr>
                            <td> {{$detalles_programacione->numero_orden}}</td>
                            <td> {{$detalles_programacione->orden}}</td>
                            <td> {{$detalles_programacione->marca}}</td>
                            <td> {{$detalles_programacione->vitola}}</td>
                            <td> {{$detalles_programacione->nombre}}</td>
                            <td> {{$detalles_programacione->capa}}</td>
                            <td> {{$detalles_programacione->tipo_empaque}}</td>
                            <td> {{$detalles_programacione->anillo}}</td>
                            <td> {{$detalles_programacione->cello}}</td>
                            <td> {{$detalles_programacione->upc}}</td>
                            <td> {{$detalles_programacione->saldo}}</td>
                            <td style="text-align:center">

                                <a data-toggle="modal" data-target="#modal_eliminar_detalle"
                                    onclick="datos_modal_eliminar({{ $detalles_programacione->id_detalle_programacion}})"
                                    href="">
                                    <abbr title="Eliminar detalles"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor" class="bi bi-trash-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                        </svg>
                                    </abbr>
                                </a>

                                <a style=" width:10px; height:10px;" data-toggle="modal" href=""
                                    data-target="#modal_actualizar_saldo" type="submit"
                                    onclick="datos_modal_actualizar({{ $detalles_programacione->id_detalle_programacion}})">
                                    <abbr title="Editar detalles de programación"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </abbr>
                                </a>
                            </td>


                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

        </div>

    </div>




    <script type="text/javascript">
        function datos_modal_actualizar(id) {
            var datas = '<?php echo json_encode($detallestodos);?>';

            var data = JSON.parse(datas);

            var saldo_nuevo = 0;


            for (var i = 0; i < data.length; i++) {
                if (data[i].id_detalle_programacion === id) {



                    document.form_saldo.id_detalle.value = data[i].id_detalle_programacion;

                    document.form_saldo.id_pendiente.value = data[i].id_pendiente;
                    document.form_saldo.saldo.value = data[i].saldo;
                    saldo_nuevo = data[i].saldo;
                    document.form_saldo.saldo_pen.value = saldo_nuevo;

                }
            }

        }
    </script>



    <script type="text/javascript">
        function datos_modal_eliminar(id) {
            var datas = '<?php echo json_encode($detallestodos);?>';

            var data = JSON.parse(datas);




            for (var i = 0; i < data.length; i++) {
                if (data[i].id_detalle_programacion === id) {

                    document.formulario_mostrarE.ide.value = data[i].id_detalle_programacion;
                    document.formulario_mostrarE.saldoe.value = data[i].saldo;
                    document.formulario_mostrarE.id_pendientee.value = data[i].id_pendiente;
                }
            }



        }
    </script>

    <script type="text/javascript">
        function datos_modal_eliminar_pro(id) {
            var datas = '<?php echo json_encode($programaciones);?>';

            var data = JSON.parse(datas);
            for (var i = 0; i < data.length; i++) {
                if (data[i].id === id) {

                    document.formulario_eliminarpro.id_pro.value = data[i].id;

                }
            }
        }
    </script>




    <script type="text/javascript">
        function datos_modal_actualizar_programacion(id) {
            var datas = '<?php echo json_encode($programaciones);?>';

            var data = JSON.parse(datas);

            var saldo_nuevo = 0;

            for (var i = 0; i < data.length; i++) {
                if (data[i].id === id) {

                    document.formulario_actualipro.id_p.value = data[i].id;

                    document.formulario_actualipro.saldo_p.value = data[i].mes_contenedor;

                }
            }

        }
    </script>

<script type="text/javascript">
        function verpro(id) {
            var datas = '<?php echo json_encode($programaciones);?>';

            var data = JSON.parse(datas);
            for (var i = 0; i < data.length; i++) {
                if (data[i].id === id) {

                    document.formver.id_tov.value = data[i].id;
                    document.formver.buscar.value = "";

                }
            }
        }
    </script>




    <!-- INICIO MODAL ELMINAR DETALLE -->
    <form action="{{Route('borrar_historial_programacion')}}" method="POST" id="formulario_mostrarE"
        name="formulario_mostrarE">

        @csrf


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
                    </div>
                    <div class="modal-footer">


                        <input name="ide" id="ide" hidden />
                        <input name="saldoe" id="saldoe" hidden />
                        <input name="id_pendientee" id="id_pendientee" hidden />
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


    <!-- INICIO MODAL ELMINAR PROGRAMACION -->
    <form action="{{Route('eliminar_programacion')}}" method="POST" id="formulario_eliminarpro"
        name="formulario_eliminarpro">

        @csrf


        <div class="modal fade" id="modal_eliminar_programacion" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
            style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Eliminar a <strong><input value=""
                                    id="txt_usuarioE" name="txt_usuarioE" style="border:none;"></strong> </h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">


                        <input name="id_pro" id="id_pro" hidden />
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


    <!-- FIN MODAL ELMINAR PROGRAMACION -->


    <!-- INICIO MODAL ACTUALIZAR PROGRAMACION -->
    <form action="{{Route('actualizar_programacion')}}" method="POST" id="formulario_actualipro"
        name="formulario_actualipro">

        @csrf


        <div class="modal fade" id="modal_actualizar_programacion" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
            style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="staticBackdropLabel"
                            style="width:450px; text-align:center; font-size:20px;">Actualizar fecha del contenedor</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label"
                                style="width:440px; text-align:center; font-size:20px;">Fecha del contenedor</label>


                            <input type="text" class="form-control" name="saldo_p" id="saldo_p"
                                placeholder="Ingrese la fecha del contenedor" autocomplete="off" />
                        </div>
                    </div>
                    <div class="modal-footer">


                        <input name="id_p" id="id_p" hidden />



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


    <!-- FIN MODAL ACTUALIZAR PROGRAMACION -->



    <!-- INICIO MODAL ACTUALIZAR SALDO-->
    <form action="{{Route('actualizar_historial_programacion')}}" method="POST" id="form_saldo" name="form_saldo">
        <div class="modal fade" id="modal_actualizar_saldo" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">

                        <input id="id_detalle" name="id_detalle" hidden>
                        <input id="id_pendiente" name="id_pendiente" hidden>
                        <input id="saldo_pendiente" name="saldo_pendiente" hidden>
                        <input id="saldo_pen" name="saldo_pen" hidden>


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


</div>
