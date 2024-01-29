<div xmlns:wire="http://www.w3.org/1999/xhtml">

    <ul class="nav nav-tabs justify-content-center">
        @if(auth()->user()->rol == -1)

        @else
            <li class="nav-item">
                <a class="nav-link" style="color:white; font-size:12px;" href="pendiente_empaque"><strong>Pendiente</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color:white; font-size:12px;" href="importar_c"><strong>Existencia en bodega</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color:white; font-size:12px;"
                    href="{{ route('inventario_cajas') }}"><strong>Existencia de cajas</strong></a>
            </li>
        @endif
        <li class="nav-item">
            <a style="color:#E5B1E2; font-size:12px;"
                href="{{ route('entradas.salidas') }}"><strong>Programaciones</strong></a>
        </li>
    </ul>



    <div style="width:100%;">

        <div class="row" style="width:100%;">

        <div style="padding-left:25px;" class="col-sm-3" style="text-align:right;">
        <input type="date" name="fecha" id="fecha" style="width: 100%;" class="form-control" placeholder="Nombre"
                                wire:model="fecha">
            </div>
            <div class="col-sm-2" style="text-align:right;">
                @foreach($titulo as $programacion)
                    <h4 style="color:#ffffff;" id="contenedor" name="contenedor" value="" wire:model="titulo"><strong>
                            {{ $programacion ->mes_contenedor }}</strong></h4>
                @endforeach
            </div>
            <div class="col-sm-3" style="text-align:right;">
                <form action="{{ Route('exportar_programacion') }}" id="formver" name="formver">
                    <input name="buscar" id="buscar" value="{{ isset($busqueda)?$busqueda:null }}"
                        onKeyDown="copiar('buscar','b');" class="  form-control" wire:model="busqueda"
                        placeholder="Búsqueda por Marca, Nombre y Vitola" style="width:100%; padding:right;">
            </div>
            <div class="col-sm-3" style="text-align:right;">

                <button onclick="mostrarMaterial(true)" type="button" class="botonprincipal @if($materiales)
                btn-success
                @else

                @endif" style="width:100px;height: 35;border-radius: 20%">Progra. con <br>Materiales</button>

                <button onclick="mostrarMaterial(false)" type="button" class="botonprincipal @if($materiales)

                @else
                    btn-success
                @endif" style="width:100px;height: 35;border-radius: 20%">Progra. sin <br>Materiales</button>

                <button class="botonprincipal" onclick="exportarMaterial()" type="button" style="width:100px;">Materiales <br> Exportar </button>
            </div>
            <div class="col-sm-1" style="text-align:right;">

                <input value="{{ isset($id_tov)?$id_tov:0 }}" name="id_tov" id="id_tov" hidden
                    wire:model="id_tov">

                <button class="botonprincipal" type="submit" style="width:60px;">Exportar </button>

            </div>
            </form>




        </div>
    </div>






    <div style="width:100%; padding-left:25px; padding-right:10px;">
        <div class="row">
            <div class="col-sm-3" style="padding-left:0px;   font-size:10px;  ">
                <div wire:change='tama' id="tabla_materiales2" class="table-responsive">
                    <div wire:loading.class='oscurecer_contenido' style="width:100%; padding-left:0px;">
                        <table class="table table-light table-hover" id="editable" style="font-size:10px;">
                            <thead>
                                <tr style="text-align:center;">
                                    <th style=" text-align:center;">#-No.</th>
                                    <th style=" text-align:center;">FECHA</th>
                                    <th style=" text-align:center;">CONTENEDOR</th>
                                </tr>
                            </thead>
                            <tbody>

                            @if($programaciones== null)
                                <tr style="text-align:center;">
                                    <th colspan="3" style=" text-align:center;">No existe Planificacion para este mes</th>
                                </tr>
                        @endif

                                @foreach($programaciones as $i => $programacion)
                                    <tr>
                                        <td> {{ $i+1 }}</td>
                                        <td> {{ $programacion->fecha }}</td>
                                        <td> {{ $programacion->mes_contenedor }}

                                            <div class="row">
                                                @if(auth()->user()->rol == -1)

                                                @else
                                                    <div class="col-sm-1" style="text-align:right;">
                                                        <a data-bs-toggle="modal"
                                                            data-bs-target="#modal_eliminar_programacion"
                                                            onclick="datos_modal_eliminar_pro({{ $programacion->id }})"
                                                            href="">
                                                            <abbr title="Eliminar programación"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-trash-fill" viewBox="0 0 16 16"
                                                                    style="color:black;">
                                                                    <path
                                                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                                </svg>
                                                            </abbr>
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-1" style="text-align:right;">
                                                        <a style=" width:10px; height:10px;" data-bs-toggle="modal" href=""
                                                            data-bs-target="#modal_actualizar_programacion" type="submit"
                                                            onclick="datos_modal_actualizar_programacion({{ $programacion->id }},
                                                                                             '{{ $programacion->mes_contenedor }}')">
                                                            <abbr title="Editar programacion">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                    height="20" fill="currentColor"
                                                                    class="bi bi-pencil-square" viewBox="0 0 16 16"
                                                                    style="color:black;">
                                                                    <path
                                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                    <path fill-rule="evenodd"
                                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                                </svg>
                                                            </abbr>
                                                        </a>
                                                    </div>
                                                @endif
                                                <div class="col-sm-1" style="text-align:right;">
                                                    <a style=" width:10px; height:10px;"
                                                        wire:click='ver({{ $programacion->id }})'>
                                                        <button style="background: none; color: inherit;   border: none;  padding: 0;
                                                font: inherit;  cursor: pointer; outline: inherit;">

                                                            <abbr title="Mostrar detalles de la programación"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="20"
                                                                    height="20" fill="currentColor"
                                                                    class="bi bi-eye-fill" viewBox="0 0 16 16"
                                                                    style="color:black;">
                                                                    <path
                                                                        d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                                    <path
                                                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                                </svg>
                                                            </abbr>

                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-9" style="padding-left:0px;   font-size:10px;  ">
                <div wire:change='tama' id="tabla_materiales" class="table-responsive">
                    <div wire:loading.class='oscurecer_contenido' style="width:100%; padding-left:0px; height:100%;">
                        <table class="table table-light table-hover" id="editable" style="font-size:10px;">
                            <thead>
                                <tr style=" text-align:center;">
                                    <th># ORDEN</th>
                                    <th style=" text-align:center;">ORDEN</th>
				    <th style=" text-align:center;">ITEM</th>
                                    <th style=" text-align:center;">MARCA</th>
                                    <th style=" text-align:center;">VITOLA</th>
                                    <th style=" text-align:center;">NOMBRE</th>
                                    <th style=" text-align:center;">CAPA</th>
                                    <th style=" text-align:center;">TIPO DE EMPAQUE</th>
                                    <th style=" text-align:center;">ANILLO</th>
                                    <th style=" text-align:center;">CELLO</th>
                                    <th style=" text-align:center;">UPC</th>
                                    <th style=" text-align:center;">SALDO</th>
                                    <th style=" text-align:center;">SOLICITUD(CAJAS)</th>
                                    <th style=" text-align:center;">TOTAL CAJAS</th>
                                    <th style=" text-align:center;">OPERACIONES</th>


                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $suma_total = 0;
                                    $total_cajas = 0;
                                    $total_materiales = 0;

                                @endphp
                                @foreach($detalles_programaciones as $detalles_programacione)
                                    <tr>
                                        <td> {{ $detalles_programacione->numero_orden }}</td>
                                        <td> {{ $detalles_programacione->orden }}</td>
					                    <td> {{ $detalles_programacione->item }}</td>
                                        <td> {{ $detalles_programacione->marca }}</td>
                                        <td> {{ $detalles_programacione->vitola }}</td>
                                        <td> {{ $detalles_programacione->nombre }}</td>
                                        <td> {{ $detalles_programacione->capa }}</td>
                                        <td> {{ $detalles_programacione->tipo_empaque }}</td>
                                        <td> {{ $detalles_programacione->anillo }}</td>
                                        <td> {{ $detalles_programacione->cello }}</td>
                                        <td> {{ $detalles_programacione->upc }}</td>
                                        <td> {{ $detalles_programacione->saldo }}</td>
                                        @php
                                            $suma_total+=$detalles_programacione->saldo;
                                        @endphp
                                        <td> {{ $detalles_programacione->cajas }}</td>
                                        <td> {{ $detalles_programacione->cant_cajas }}</td>

                                        <td style="text-align:center">

                                            <a data-bs-toggle="modal" data-bs-target="#modal_eliminar_detalle" onclick="datos_modal_eliminar({{ $detalles_programacione->id_detalle_programacion }})" href="#">
                                                <abbr title="Eliminar detalles"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="16" height="16" fill="currentColor"
                                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                    </svg>
                                                </abbr>
                                            </a>

                                            <a style=" width:10px; height:10px;" data-bs-toggle="modal" href=""
                                                data-bs-target="#modal_actualizar_saldo" type="submit" onclick="datos_modal_actualizar({{ $detalles_programacione->id_detalle_programacion }},
                                                                    {{ $detalles_programacione->id_pendiente }},
                                                                    '{{ $detalles_programacione->saldo }}',
                                                                    '{{ $detalles_programacione->cajas }}',
                                                                    '{{ $detalles_programacione->cant_cajas }}')">
                                                <abbr title="Editar detalles de programación"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        fill="currentColor" class="bi bi-pencil-square"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                    </svg>
                                                </abbr>
                                            </a>
                                        </td>


                                    </tr>

                                    @if($materiales)
                                        @php
                                            $detalles_materiale = DB::select('call traer_materiales_programacion(?)', [$detalles_programacione->id_detalle_programacion]);
                                        @endphp
                                        @foreach ($detalles_materiale as $materiale)
                                            <tr>
                                                <th colspan="3"></th>
                                                <td colspan="6">{{ '('.$materiale->codigo_material.') '.$materiale->des_material }}</td>
                                                <th></th>
                                                <th></th>
                                                @if ($materiale->restante  < 0)
                                                    <td style="color: red">{{'Faltan '.$materiale->restante }}</td>
                                                @endif
                                                @if ($materiale->restante  > 0)
                                                    <td style="color: rgb(119, 0, 255)">{{'Sobran '.$materiale->restante }}</td>
                                                @endif
                                                @if ($materiale->restante  == 0)
                                                    <td>{{$materiale->restante }}</td>
                                                @endif
                                                <td>{{ $materiale->cantidad_m }}</td>
                                                <td></td>
                                                <th colspan="3"></th>
                                            </tr>
                                            @php
                                                $total_materiales += $materiale->cantidad_m;
                                            @endphp

                                        @endforeach
                                    @endif



                                    @php
                                        $total_cajas += $detalles_programacione->cant_cajas;
                                    @endphp
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="input-group" style="width:40%;position: fixed;right: 0px;bottom:0px; height:30px;">
            <span class="form-control input-group-text">Total saldo</span>
            <input type="text" class="form-control" id="sumase" value="{{ $suma_total }}">
            <span class="form-control input-group-text">Total Cajas</span>
            <input type="text" class="form-control" id="sumase" value="{{ $total_cajas }}">
            <span class="form-control input-group-text">Total Materiales</span>
            <input type="text" class="form-control" id="sumase" value="{{ $total_materiales }}">
        </div>


    </div>



    <!-- INICIO MODAL ELMINAR DETALLE -->
    <form  id="formulario_mostrarE"
        name="formulario_mostrarE">
        <div class="modal fade" id="modal_eliminar_detalle" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Eliminar detalle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">

                        <input name="ide" id="ide" hidden />

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button type="button" class="btn btn-success" onclick="datos_reversar_item()" data-bs-dismiss="modal">
                            <span>Eliminar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN MODAL ELMINAR DETALLE -->


    <!-- INICIO MODAL ELMINAR PROGRAMACION -->
    <form action="{{ Route('eliminar_programacion') }}" method="POST" id="formulario_eliminarpro"
        name="formulario_eliminarpro">

        @csrf
        <div class="modal fade" id="modal_eliminar_programacion" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
            style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Eliminar</h5>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro que quieres eliminar esta programación?
                    </div>
                    <div class="modal-footer">


                        <input name="id_pro" id="id_pro" hidden />
                        <button type="button" class=" btn_no " data-bs-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button type="submit" class=" btn_yes ">
                            <span>Eliminar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN MODAL ELMINAR PROGRAMACION -->


    <!-- INICIO MODAL ACTUALIZAR PROGRAMACION -->
    <form action="{{ Route('actualizar_programacion') }}" method="POST" id="formulario_actualipro"
        name="formulario_actualipro">
        @csrf
        <div class="modal fade" id="modal_actualizar_programacion" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
            style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="staticBackdropLabel">Actualizar fecha del contenedor</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label">Fecha del contenedor</label>


                            <input type="text" class="form-control" name="saldo_p" id="saldo_p"
                                placeholder="Ingrese la fecha del contenedor" autocomplete="off" />
                        </div>
                    </div>
                    <div class="modal-footer">


                        <input name="id_p" id="id_p" hidden />

                        <button type="button" class=" btn_no " data-bs-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button type="submit" class="btn_yes">
                            <span>Actualizar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN MODAL ACTUALIZAR PROGRAMACION -->



    <!-- INICIO MODAL ACTUALIZAR SALDO-->
    <form action="{{ Route('actualizar_historial_programacion') }}" method="POST" id="form_saldo"
        name="form_saldo">
        <div class="modal fade" id="modal_actualizar_saldo" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">

                        <input id="id_detalle" name="id_detalle" hidden>
                        <input id="id_pendiente" name="id_pendiente" hidden>
                        <input id="saldo_pendiente" name="saldo_pendiente" hidden>
                        <input id="saldo_pen" name="saldo_pen" hidden>
                        <input id="cajas_viejas" name="cajas_viejas" hidden>

                        <input id="cant_cajas" name="cant_cajas" hidden>

                        <h5 class="modal-title" id="staticBackdropLabel"
                            style="width:450px; text-align:center; font-size:20px;">Actualizar saldo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            data-bs-dismiss="modal">
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


    @push('scripts')
        <script type="text/javascript">
            function mostrarMaterial(v){
                @this.materiales = v;
            }

            function exportarMaterial(){
                @this.imprimir_materiales();
            }

            window.addEventListener('tamanio_tabla', event => {
                $('#tabla_materiales').css('height', ($('#bos').height() - 180));
                $('#tabla_materiales2').css('height', ($('#bos').height() - 180));
            });

            $(document).ready(function () {

                $('#tabla_materiales').css('height', ($('#bos').height() - 180));
                $('#tabla_materiales2').css('height', ($('#bos').height() - 180));

            });

            function datos_modal_eliminar(id) {
                $('#ide').val(id);
            }

            function datos_reversar_item() {
                @this.eliminar_detalles_pro($('#ide').val());
            }

            function datos_modal_actualizar(id,
                id_pendiente,
                saldo,
                cant_cajas_necesarias,
                cant_cajas
            ) {

                $('#id_detalle').val(id);
                $('#id_pendiente').val(id_pendiente);
                $('#saldo').val(saldo);
                $('#saldo_pen').val(saldo);
                $('#cajas_viejas').val(cant_cajas_necesarias);
                $('#cant_cajas').val(cant_cajas);

            }


            function datos_modal_eliminar_pro(id) {
                $('#id_pro').val(id);
            }

            function datos_modal_actualizar_programacion(id, mes_contenedor) {
                $('#id_p').val(id);
                $('#saldo_p').val(mes_contenedor);
            }
        </script>
    @endpush

</div>
