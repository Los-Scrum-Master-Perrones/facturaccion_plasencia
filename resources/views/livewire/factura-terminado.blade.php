<div xmlns:wire="http://www.w3.org/1999/xhtml">


    <meta name="viewport" content="width=device-width, initial-scale=1">

    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}" />

    <br>
    <div class="container" style="width:auto; align-content: center">
        <div class="row">
            <div class="form-group col-sm-12">
                <h2 wire:model="titulo_cliente">{{$titulo_factura." ".$titulo_cliente." ". $contenedor." ".$titulo_mes}}
                </h2>
            </div>
        </div>
        <div class="row">

            <div class="form-group col-sm-3">
                <br>
                <label>
                    <h4>Factura N#: {{$num_factura_sistema}}</h4>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label>Cliente</label>
                <input type="text" class="form-control" wire:model="cliente" placeholder="Rocky,  Hatsa">
            </div>
            <div class="form-group col-sm-3">
                <label>Fecha</label>
                <input type="date" class="form-control" wire:model="fecha_factura">
            </div>
            <div class="form-group col-sm-3">
                <label>Contenedor</label>
                <input type="text" class="form-control" wire:model="contenedor" placeholder="Primer Contenedor">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-3">
                <label for="exampleInputEmail1">Total Bultos</label>
                <input type="number" class="form-control" placeholder="0" wire:model="total_cantidad_bultos" readonly>
            </div>
            <div class="form-group col-sm-3">
                <label for="exampleInputEmail1">Total Puros</label>
                <input type="number" class="form-control" placeholder="0" wire:model="total_total_puros" readonly>
            </div>
            <div class="form-group col-sm-3">
                <label for="exampleInputEmail1">Peso Bruto Total</label>
                <input type="number" class="form-control" placeholder="0.00" wire:model="total_peso_bruto" readonly>
            </div>
            <div class="form-group col-sm-3">
                <label for="exampleInputEmail1">Peso Neto Total</label>
                <input type="number" class="form-control" placeholder="0.00" wire:model="total_peso_neto" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3" id="boton_agregar" name="boton_agregar">
                <button onclick="mostrarPendiente()" class="form-control mr-sm-2 botonprincipal"
                    style="width:200px;">Agregar Producto
                </button>
            </div>
            <div class="col-sm-3" style="display: none" id="boton_regresar" name="boton_regresar">
                <button onclick="mostrarDetalleFactura()" class="form-control mr-sm-2 botonprincipal"
                    style="width:200px;">Regresar
                </button>
            </div>

            <div class="col-sm-3" id="tipo_orden" name="tipo_orden">
                <select class="form-control" wire:model="tipo_factura" style="overflow-y: scroll; height:40px;" >
                    <option style="overflow-y: scroll;">HON</option>
                    <option style="overflow-y: scroll;">FTT</option>
                    <option style="overflow-y: scroll;">INT-H</option>
                </select>
            </div>

            <div class="col-sm-3"  id="vacio1" name="vacio1">
                
            </div>

            <div class="col-sm-3" id="vacio2" name="vacio2">
                
            </div>


        </div>

    </div>

    <br>

    <div class="panel-body" id="facura_cliente" name="facura_cliente">
        <div style="overflow-x: none; overflow-y: noe;
 height:device-height" class="table-responsive">
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
                    </tr>
                </thead>
                <tbody>

                    @foreach($detalles_venta as $detalles)
                    <tr style="font-size:10px;">
                        <td style="width:100px; max-width: 400px;overflow-x:auto;">Bultos</td>
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
                        <td>hola</td>
                        <td>hola</td>
                        <td>hola</td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div class="panel-body" style="display: none;" id="pendiente_factura">
        <div style="overflow-x: display; overflow-y: auto;
 height:device-height" class="table-responsive">

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
                        <th>ANILLO</th>
                        <th>CELLO</th>
                        <th>UPC</th>
                        <th>PENDIENTE</th>
                        <th>SALDO</th>
                        <th>OPERACIONES</th>
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

                        <td style="text-align:center;">
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
    </div>


    <script type="text/javascript">
        function mostrarPendiente() {
            document.getElementById('pendiente_factura').style.display = 'block';
            document.getElementById('facura_cliente').style.display = 'none';
            document.getElementById('boton_regresar').style.display = 'block';
            document.getElementById('boton_agregar').style.display = 'none';
            document.getElementById('tipo_orden').style.display = 'none';
            document.getElementById('vacio1').style.display = 'none';
            document.getElementById('vacio2').style.display = 'none';
        }

        function mostrarDetalleFactura() {
            document.getElementById('pendiente_factura').style.display = 'none';
            document.getElementById('facura_cliente').style.display = 'block';
            document.getElementById('boton_regresar').style.display = 'none';
            document.getElementById('boton_agregar').style.display = 'block';
            document.getElementById('tipo_orden').style.display = 'block';
            document.getElementById('vacio1').style.display = 'block';
            document.getElementById('vacio2').style.display = 'block';
        }
    </script>


    <!-- INICIO MODAL ACTUALIZAR DATO PENDIENTE -->

    <form action="{{Route('insertar_detalle_factura')}}" method="POST" id="actualizar_pendiente" name="actualizar_pendiente">
        <div class="modal fade" role="dialog" id="modal_actualizar" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
            style="opacity:.9;background:#212529;width=900px;">
            <div class="modal-dialog modal-dialog-centered modal-lg" style="opacity:.9;background:#212529;width=40%">
                <div class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 id="staticBackdropLabel"><strong>Descripción del producto: </strong><span id="titulo"
                                name="titulo">{{$descripcion_producto}}</span></h5>
                    </div>

                    <div class="modal-body">
                        <div class="row">

                            <input name="id_pendi" id="id_pendi" wire:model="id_pendiente" hidden />

                            <div class="mb-3 col">
                                <label for="txt_bultos" class="form-label">Cantidad de Bultos:</label>
                                <input id="cantidad_bultos" name="cantidad_bultos" class="form-control" type="text" autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                                <label for="txt_unidades" class="form-label">Unidades de Puros por Bulto:</label>
                                <input id="unidades_bultos" name="unidades_bultos" class="form-control" type="text" autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                                <label for="txt_unidad_cajon" class="form-label">Unidad por Cajon:</label>
                                <input id="unidades_cajon" name="unidades_cajon" class="form-control" type="text" autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                                <label for="txt_peso_bruto" class="form-label">Preso Bruto (Lbs)</label>
                                <input id="peso_bruto" name="peso_bruto"  class="form-control" type="text" autocomplete="off">
                            </div>     
                            <div class="mb-3 col">
                                <label for="txt_peso_neto" class="form-label">Preso Neto (Lbs)</label>
                                <input id="peso_neto" name="peso_neto" class="form-control" type="text" autocomplete="off">
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


    <script>
        window.addEventListener('abrir', event => {
            $("#modal_actualizar").modal('show');
            mostrarPendiente();
        })

        window.addEventListener('cerrar', event => {
            $("#modal_actualizar").modal('hide');
        })
    </script>

    <!-- FIN MODAL ACTUALIZAR DATO PENDIENTE -->


</div>