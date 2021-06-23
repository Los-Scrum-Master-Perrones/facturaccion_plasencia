<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">


    <br>

    <div class="" style="width:100%; ">

        <div class="row" style="width:100%;">


            <div class="col-sm-5" style="text-align:right;">

                <input type="date" class="form-control" wire:model="fecha_mes" style="width:400px; padding:right;">

            </div>
            <div class="col-sm-4" style="text-align:right;">
                <input name="buscar" id="buscar" class="  form-control" wire:model="busqueda"
                    placeholder="Búsqueda número factura" style="width:400px; padding:right;">
            </div>
            <div class="col-sm-3" style="text-align:right;">
                <button class="botonprincipal" style="width:120px;" wire:click="exportar_factura()">Exportar  </button>
            </div>

        </div>

        <br>





        <div style="width:100%; padding-left:25px; padding-right:10px;">

            <div class="row">
                <div class="col-sm"
                    style="width:20%; padding-left:0px; height: 200px;  overflow-x: display; overflow-y: auto;">

                    <table class="table table-light" id="editable" style="font-size:10px;height: 200px">
                        <thead>
                            <tr style="text-align:center;">
                                <th style=" text-align:center;">#-No. Factura</th>
                                <th style=" text-align:center;">Cliente</th>
                                <th style=" text-align:center;">Contenedor</th>
                                <th style=" text-align:center;">Bultos</th>
                                <th style=" text-align:center;">Puros</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($factura_mes as $factur)
                            <tr>
                                <td>{{$factur->numero_factura}}</td>
                                <td>{{$factur->cliente}}</td>
                                <td>{{$factur->contenedor}}</td>
                                <td>{{$factur->cantidad_bultos}}</td>
                                <td>{{$factur->total_puros}}</td>
                                <td style="width:100">
                                    <a  wire:click.prevent="editar_factura({{$factur->id}})" href=""
                                        style="text-decoration:none">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </a>
                                    <a style=" width:10px; height:10px; text-decoration:none;"
                                        wire:click.prevent="detalles_ventas({{$factur->id}},'{{$factur->numero_factura}}')"
                                        href="">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                            <path
                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
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
            <div class="row">

                <div class="col-sm" style="width:80%; padding-left:0px; ">
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
                            <?php  $bultos = 0;
                                    $val_anterioir=0;
                                   $val_actual=0 ?>

                            @foreach($detalles_venta as $detalles)
                            <tr style="font-size:10px;">
                                <?php  
                                $val_anterioir= $bultos+1;
                                $bultos += $detalles->cantidad_puros;
                                
                               $val_actual=$bultos ?>

                                @if ($val_actual == $val_anterioir)
                                <td style="width:100px; max-width: 400px;overflow-x:auto;">{{$val_actual}}</td>
                                @else
                                <td style="width:100px; max-width: 400px;overflow-x:auto;">{{$val_anterioir}} al
                                    {{$val_actual}}</td>
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

                                <td>{{$detalles->costo}}</td>
                                <td>{{$detalles->valor_total}}</td>
                               


                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>


    <!-- INICIO MODAL ACTUALIZAR SALDO-->
    <form action="{{Route('editar_venta_factura')}}" method="POST" id="form_saldo" name="form_saldo">
        <div class="modal fade" id="modal_actualizar_ventas" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"
                            style="width:450px; text-align:center; font-size:20px;">Actualizar Venta</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 col">
                            <label class="form-label"
                                style="width:440px; text-align:center; font-size:20px;">No. Factura</label>
                            <input class="form-control" id="num_factura" name="num_factura" placeholder=""
                                style="width: 440px" maxLength="30" value="{{$num_factura_editar}}" autocomplete="off" type="text">
                        </div>
                        <div class="mb-3 col">  
                            <label for="txt_figuraytipo" class="form-label"
                                style="width:440px; text-align:center; font-size:20px;">Cliente</label>
                            <input class="form-control" id="cliente" name="cliente" placeholder=""
                                style="width: 440px" maxLength="30" value="{{$cliente_editar}}" autocomplete="off" type="text">
                        </div>
                        <div class="mb-3 col">
                            <label for="txt_figuraytipo" class="form-label"
                                style="width:440px; text-align:center; font-size:20px;">Contenedor</label>
                            <input class="form-control" id="contenedor" name="contenedor" placeholder=""
                                style="width: 440px" maxLength="30" value="{{$contenedor_editar}}" autocomplete="off" type="text">
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
                        <input name="id_venta" wire:model="id_factura_editar" hidden />
                    </div>
                </div>
            </div>
        </div>

    </form>
    <!-- FIN MODAL  ACTUALIZAR SALDO -->

    <script>
        window.addEventListener('abrir', event => {
            $("#modal_actualizar_ventas").modal('show');
        })

      
    </script>

</div>
