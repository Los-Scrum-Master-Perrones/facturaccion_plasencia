<div xmlns:wire="http://www.w3.org/1999/xhtml">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    <div class="container" style="max-width:100%; ">
        <br>

        <div class="row" style="text-align:center;">

            <div class="col">
                <div class="input-group mb-3">


                    <button id="boton_agregar" name="boton_agregar" onclick="mostrarPendiente()"
                        class=" mr-sm-2 botonprincipal" style="width:120px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                        Producto
                    </button>

                    <button style="display: none;width:120px;" id="boton_regresar" onclick="mostrarDetalleFactura()"
                        class=" mr-sm-2 botonprincipal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                        </svg>
                        Regresar </button>



                    <span id="lbl_cliente" name="lbl_cliente" class="form-control input-group-text ">Cliente</span>
                    <input style="width:150px;" id="txt_cliente" name="txt_cliente" type="text"
                        class="form-control mr-sm-2 " wire:model="cliente" placeholder="Rocky,  Hatsa" required>

                    <span id="lbl_fecha" name="lbl_fecha" class="input-group-text form-control">Fecha</span>
                    <input style="width:150px;" id="txt_fecha" name="txt_fecha" type="date"
                        class="form-control mr-sm-2 " wire:model="fecha_factura">

                    <span id="lbl_contenedor" name="lbl_contenedor"
                        class="input-group-text form-control">Contenedor</span>
                    <input style="width:150px;" id="txt_contenedor" name="txt_contenedor" type="text"
                        class="form-control mr-sm-2 " wire:model="contenedor" placeholder="Primer Contenedor" required>

                    <select id="tipo_orden" name="tipo_orden" class="form-control mr-sm-2 " wire:model="tipo_factura"
                        style="overflow-y: scroll;">
                        <option style="overflow-y: scroll;">HON</option>
                        <option style="overflow-y: scroll;">FTT</option>
                        <option style="overflow-y: scroll;">INT-H</option>
                    </select>

                    <button id="btn_guardar" class="botonprincipal" wire:click="insertar_factura()"
                        style="width:120px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-save2" viewBox="0 0 16 16">
                            <path
                                d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .354.854l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5A.5.5 0 0 1 5.5 6.5h2V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z" />
                        </svg>  Guardar </button>



                        <input type="date" name="fecha_de" id="fecha_de" class="form-control mr-sm-2 "
                        style="width:200px; display: none" placeholder="Fecha" wire:model="fede">

                        <input name="itemb" id="itemb" class="form-control mr-sm-2 "
                        style="width:200px; display: none" placeholder="Item" wire:model="item">

                        <input  name="ordenb" id="ordenb" class="form-control mr-sm-2 "
                        style="width:200px; display: none" placeholder="Orden del sistema" wire:model="orden">

                        <input  name="honb" id="honb" class="form-control "
                        style="width:200px; display: none" placeholder="Orden" wire:model="hon">








                    <div style="display: none" id="busqueda_pendiente2" name="busqueda_pendiente2">
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-body" style="padding:0px;">
            <div style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;
            height:450px;">

                <div class="row">
                    <div class="col">
                        <label wire:model="titulo_cliente"
                            style="font-size:15px;color:white;">{{$titulo_factura." ".$titulo_cliente." ". $contenedor." ".$titulo_mes}}
                        </label>
                    </div>

                    <div class="col" style="text-align:end;">
                        <label style="font-size:15px;color:white;">Factura N#: {{$num_factura_sistema}}</label>
                    </div>
                    <div class="col" style="text-align:end;">
                        <button style="width:120px;" class="botonprincipal" wire:click="historial()">Historial</button>
                    </div>
                </div>
<br>


                <table class="table table-light" id="editable">
                    <thead style="position: static;">
                        <tr style="font-size:10px; text-align:center">
                            <th style="text-align:center;">Bulto<br>Package<br>No.
                            </th>
                            <th style="text-align:center;">Cant.<br>Quant.
                            </th>
                            <th style="text-align:center;">Unidad<br>Unit.
                            </th>
                            <th style="text-align:center;">Units<br>
                            </th>
                            <th style="text-align:center;">Total<br>Tabacos<br>Cigars
                            </th>
                            <th style="text-align:center;">Capa<br>Wrappar
                            </th>
                            <th style="text-align:center;">#
                            </th>
                            <th style="text-align:center; width: 300px">Clase<br>Class
                            </th>
                            <th style="text-align:center;">CODIGO #<br>ITEM #
                            </th>
                            <th style="text-align:center;">YOUR<br>ITEM #
                            </th>
                            <th style="text-align:center;">YOUR<br>ORDER #
                            </th>
                            <th style="text-align:center;">ORDER<br>AMOUNT
                            </th>
                            <th style="text-align:center;">BACK<br>ORDER<br>AMOUNT
                            </th>
                            <th style="text-align:center;">Bruto<br>Gross
                            </th>
                            <th style="text-align:center;">Neto<br>Net
                            </th>
                            <th style="text-align:center;">Precio FOB<br>per 1000
                            </th>
                            <th style="text-align:center;">Cost
                            </th>
                            <th style="text-align:center;">Valor<br>Value
                            </th>
                            <th style="text-align:center;">
                            </th>
                        </tr>
                    </thead>
                    <tbody>


                        @php
                        $orden = "";
                        $orden_actua = "";
                    @endphp



                        <?php  $bultos = 0;
                                $val_anterioir=0;
                               $val_actual=0 ?>

                        @foreach($detalles_venta as $detalles)




                            @if ( $orden == "" && $orden_actua == "")
                            @php
                                $orden_actua = $detalles->orden;
                                $orden_actua = $detalles->orden;
                            @endphp
                            @endif

                            @php
                            $orden = $detalles->orden;
                            @endphp

                            @if ($orden_actua == $orden)

                            @else
                            <tr>
                                <td colspan="19" style="background-color: gray"></td>
                            </tr>
                            @php
                                $orden_actua = $detalles->orden;
                            @endphp
                            @endif

                        <tr style="font-size:10px;">
                            <?php
                            $val_anterioir= $bultos+1;
                            $bultos += $detalles->cantidad_puros;

                           $val_actual=$bultos ?>

                            @if ($val_actual == $val_anterioir)
                               <td style="width:100px; max-width: 400px;overflow-x:auto;">{{$val_actual}}</td>
                            @else
                               <td style="width:100px; max-width: 400px;overflow-x:auto;">{{$val_anterioir}} al {{$val_actual}}</td>
                            @endif

                            <td>{{$detalles->cantidad_puros}}</td>
                            <td>{{$detalles->unidad}}</td>
                            <td><b>{{$detalles->cantidad_cajas}}</b></td>
                            <td>{{$detalles->total_tabacos}}</td>
                            <td>{{$detalles->capas}}</td>
                            <td>{{$detalles->cantidad_por_caja}}</td>
                            <td style="width: 300px">{{$detalles->producto}}</td>
                            <td>{{$detalles->codigo}}</td>
                            <td>{{$detalles->codigo_item}}</td>
                            <td>{{$detalles->orden}}</td>
                            <td>{{$detalles->orden_total}}</td>
                            <td>{{$detalles->orden_restante}}</td>
                            <td>{{$detalles->total_bruto}}</td>
                            <td>{{$detalles->total_neto}}</td>
                            <td>{{$detalles->precio_producto}}</td>


                            <td>{{number_format($detalles->costo,4)}}</td>
                            <td>{{number_format($detalles->valor_total,4)}}</td>
                            <td>
                                <a data-toggle="modal" data-target="#borrar_detalles" href="" wire:click="borrar_detalles({{$detalles->id_detalle}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg></a>


                                <a style=" width:10px; height:10px;" data-toggle="modal" href=""
                                    wire:click="editar_detalles({{$detalles->id_detalle}})">
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




                <table class="table table-light" style="font-size:10px;display:none;" id="pendiente_factura">
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
                            <th>ANILLO</th>
                            <th>CELLO</th>
                            <th>UPC</th>
                            <th>PENDIENTE</th>
                            <th>SALDO</th>
                            <th>PT</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach($datos_pendiente as $datos)



                        <tr>
                            <td style="width:100px; max-width: 400px;overflow-x:auto;">{{$datos->categoria}}</td>
                            <td>{{$datos->item}}</td>
                            <td>{{$datos->orden_del_sitema}}</td>
                            <td>{{$datos->observacion}}</td>
                            <td>{{$datos->presentacion}}</td>
                            <td>{{$datos->mes}}</td>
                            <td>{{$datos->orden}}</td>
                            <td>{{$datos->marca}}</td>
                            <td>{{$datos->vitola}}</td>
                            <td>{{$datos->nombre}}</td>
                            <td>{{$datos->capa}}</td>
                            <td>{{$datos->tipo_empaque}}</td>
                            <td>{{$datos->anillo}}</td>
                            <td>{{$datos->cello}}</td>
                            <td>{{$datos->upc}}</td>
                            <td>{{$datos->pendiente}}</td>
                            <td>{{$datos->saldo}}</td>
                            <td>{{$datos->PT}}</td>
                            <td style="text-align:center;">

                                {{-- @if ($datos->PT>0 || isset($datos->PT))

                                <a data-toggle="modal" wire:click="abrir_modal({{$datos->id_pendiente}})" href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z" />
                                    </svg>
                                </a>
                                @endif --}}
                                <a data-toggle="modal" wire:click="abrir_modal({{$datos->id_pendiente}})" href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z" />
                                    </svg>
                                </a>


                            </td>
                        </tr>




                        @endforeach
                    </tbody>
                </table>

            </div>


            <br>
            <div class="row">
                <div class="col-sm-3 input-group mb-3">
                    <span id="de" class="input-group-text form-control "
                        style="background:rgba(174, 0, 255, 0.432);color:white;">Total Bultos</span>
                    <input type="number" class="form-control  mr-sm-4" placeholder="0"
                        wire:model="total_cantidad_bultos" readonly>

                    <span id="de" class="input-group-text form-control"
                        style="background:rgba(174, 0, 255, 0.432);color:white;">Total Puros</span>
                    <input type="number" class="form-control  mr-sm-4" placeholder="0" wire:model="total_total_puros"
                        readonly>


                    <span id="de" class="input-group-text form-control"
                        style="background:rgba(174, 0, 255, 0.432);color:white;">Peso Bruto Total</span>
                    <input type="number" class="form-control  mr-sm-4" placeholder="0.00" wire:model="total_peso_bruto"
                        readonly>

                    <span id="de" class="input-group-text form-control"
                        style="background:rgba(174, 0, 255, 0.432);color:white;">Peso Neto Total</span>
                    <input type="number" class="form-control " placeholder="0.00" wire:model="total_peso_neto" readonly>
                </div>
            </div>




            <script type="text/javascript">
                function mostrarPendiente() {

                    document.getElementById('pendiente_factura').style.display = 'block';
                    document.getElementById('boton_regresar').style.display = 'block';
                    document.getElementById('fecha_de').style.display = 'block';
                    document.getElementById('ordenb').style.display = 'block';
                    document.getElementById('itemb').style.display = 'block';
                    document.getElementById('honb').style.display = 'block';


                    document.getElementById('busqueda_pendiente2').style.display = 'block';


                    document.getElementById('editable').style.display = 'none';
                    document.getElementById('tipo_orden').style.display = 'none';
                    document.getElementById('btn_guardar').style.display = 'none';
                    document.getElementById('boton_agregar').style.display = 'none';
                    document.getElementById('lbl_cliente').style.display = 'none';
                    document.getElementById('lbl_fecha').style.display = 'none';
                    document.getElementById('lbl_contenedor').style.display = 'none';
                    document.getElementById('txt_cliente').style.display = 'none';
                    document.getElementById('txt_fecha').style.display = 'none';
                    document.getElementById('txt_contenedor').style.display = 'none';
                }

                function mostrarDetalleFactura() {
                    document.getElementById('pendiente_factura').style.display = 'none';
                    document.getElementById('boton_regresar').style.display = 'none';
                    document.getElementById('fecha_de').style.display = 'none';
                    document.getElementById('ordenb').style.display = 'none';
                    document.getElementById('itemb').style.display = 'none';
                    document.getElementById('honb').style.display = 'none';
                    document.getElementById('busqueda_pendiente2').style.display = 'none';


                    document.getElementById('fecha_de').value = "";

                    document.getElementById('editable').style.display = 'block';
                    document.getElementById('tipo_orden').style.display = 'block';
                    document.getElementById('btn_guardar').style.display = 'block';
                    document.getElementById('boton_agregar').style.display = 'block';
                    document.getElementById('lbl_cliente').style.display = 'block';
                    document.getElementById('lbl_fecha').style.display = 'block';
                    document.getElementById('lbl_contenedor').style.display = 'block';
                    document.getElementById('txt_cliente').style.display = 'block';
                    document.getElementById('txt_fecha').style.display = 'block';
                    document.getElementById('txt_contenedor').style.display = 'block';
                }
            </script>


            <!-- INICIO MODAL INSERTAR DATOS DETALLES FACTURA -->

            <form action="{{Route('insertar_detalle_factura')}}" method="POST" id="actualizar_pendiente"
                name="actualizar_pendiente">
                <div class="modal fade" role="dialog" id="modal_actualizar" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
                    style="opacity:.9;background:#212529;width=900px;">
                    <div class="modal-dialog modal-dialog-centered modal-lg"
                        style="opacity:.9;background:#212529;width=40%">
                        <div class="modal-content">
                            @csrf
                            <div class="modal-header">
                                <h5 id="staticBackdropLabel"><strong>Descripción del producto: </strong><span
                                        id="titulo" name="titulo">{{$descripcion_producto}}</span></h5>
                            </div>

                            <div class="modal-body">
                                <div class="row">

                                    <input name="id_pendi" id="id_pendi" wire:model="id_pendiente" hidden />

                                    <div class="mb-3 col">
                                        <label for="txt_bultos" class="form-label">Cantidad de Bultos:</label>
                                        <input id="cantidad_bultos" name="cantidad_bultos" class="form-control"
                                            type="number" min="1" autocomplete="off" required>
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="txt_unidades" class="form-label">Unidades de Puros por
                                            Bulto:</label>
                                        <input id="unidades_bultos" name="unidades_bultos" class="form-control"
                                        type="number" min="1"  autocomplete="off" required>
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="txt_unidad_cajon" class="form-label">Unidad por Cajon:</label>
                                        <input id="unidades_cajon" name="unidades_cajon" class="form-control"
                                        type="number" min="1" autocomplete="off" required>
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="txt_peso_bruto" class="form-label">Preso Bruto (Lbs)</label>
                                        <input id="peso_bruto" name="peso_bruto" class="form-control" type="number" min="1"
                                            autocomplete="off" required>
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="txt_peso_neto" class="form-label">Preso Neto (Lbs)</label>
                                        <input id="peso_neto" name="peso_neto" class="form-control" type="number" min="1"
                                            autocomplete="off" required>
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="bmodal_no" data-dismiss="modal">
                                    <span>Cancelar</span>
                                </button>
                                <button type="submit" class="bmodal_yes">
                                    <span>Agregar</span>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>


            <!-- INICIO MODAL ACTUALIZAR DATO PENDIENTE -->

            <form  action="{{Route('actualizar_detalle_factura')}}" method="POST">
                <div class="modal fade" role="dialog" id="modal_editar_detalles" data-backdrop="static"
                    data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
                    style="opacity:.9;background:#212529;width=900px;">
                    <div class="modal-dialog modal-dialog-centered modal-lg"
                        style="opacity:.9;background:#212529;width=40%">
                        <div class="modal-content">
                            @csrf
                            <div class="modal-header">
                                <h5 id="staticBackdropLabel"><strong>Descripción del producto: </strong><span
                                        id="titulo" name="titulo">{{$id_editar." ".$editar_descripcion_producto}}</span></h5>
                            </div>

                            <div class="modal-body">
                                <div class="row">

                                    <input type="text" name="id_pendi" id="id_pendi" value="{{$id_editar}}" hidden />

                                    <div class="mb-3 col">
                                        <label for="txt_bultos" class="form-label">Cantidad de Bultos:</label>
                                        <input id="cantidad_bultos" name="cantidad_bultos" value="{{$editar_cantidad_bultos}}" class="form-control"
                                            type="text" autocomplete="off">
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="txt_unidades" class="form-label">Unidades de Puros por
                                            Bulto:</label>
                                        <input id="unidades_bultos" name="unidades_bultos" value="{{$editar_unidades_bultos}}" class="form-control"
                                            type="text" autocomplete="off">
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="txt_unidad_cajon" class="form-label">Unidad por Cajon:</label>
                                        <input  id="unidades_cajon" name="unidades_cajon" value="{{$editar_unidades_cajon}}" class="form-control"
                                            type="text" autocomplete="off">
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="txt_peso_bruto" class="form-label">Preso Bruto (Lbs)</label>
                                        <input id="peso_bruto" name="peso_bruto" value="{{$editar_peso_bruto}}" class="form-control" type="text"
                                            autocomplete="off">
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="txt_peso_neto" class="form-label">Preso Neto (Lbs)</label>
                                        <input id="peso_neto" name="peso_neto" value="{{$editar_peso_neto}}" class="form-control" type="text"
                                            autocomplete="off">
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="bmodal_no" data-dismiss="modal">
                                    <span>Cancelar</span>
                                </button>
                                <button type="submit" class="bmodal_yes">
                                    <span>Agregar</span>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>


            <!-- INICIO MODAL ELMINAR DETALLE -->
            <form wire:submit.prevent="borrar_detalles_datos({{$id_eliminar}})">


                <div class="modal fade" id="modal_eliminar_detalle" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
                    style="opacity:.9;background:#212529;">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Eliminar a <strong><input value=""
                                            id="txt_usuarioE" name="txt_usuarioE" style="border:none;"></strong> </h5>
                                <button type="button" class="btn-close" data-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro que quieres eliminar este producto de la factura?
                            </div>
                            <div class="modal-footer">
                                <button style=" background: #b39f64; color: #ecedf1;" type="button"
                                    class=" btn-info-claro " data-dismiss="modal">
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


                <div class="modal fade" id="modal_advertencia" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
                    style="opacity:.9;background:#212529;">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Advertencia</h5>
                                <button type="button" class="btn-close" data-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Rellene los campos del Cliente y Contenedor
                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class=" btn-info ">
                                    <span>OK</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


            <script>
                window.addEventListener('abrir', event => {
                    $("#modal_actualizar").modal('show');
                    mostrarPendiente();
                })

                window.addEventListener('pendiente', event => {
                    mostrarPendiente();
                })

                window.addEventListener('cerrar', event => {
                    $("#modal_actualizar").modal('hide');
                })


                window.addEventListener('editar_detalless', event => {
                    $("#modal_editar_detalles").modal('show');
                })

                window.addEventListener('advertencia_mensaje', event => {
                    $("#modal_advertencia").modal('show');
                })


                window.addEventListener('cerrar_editar_detalles', event => {
                    $("#modal_editar_detalles").modal('hide');
                })

                window.addEventListener('borrar', event => {
                    $("#modal_eliminar_detalle").modal('show');
                })

                window.addEventListener('cerrar_modal_borrar', event => {
                    $("#modal_eliminar_detalle").modal('hide');
                })
            </script>

            <!-- FIN MODAL ACTUALIZAR DATO PENDIENTE -->


        </div>

    </div>
</div>
