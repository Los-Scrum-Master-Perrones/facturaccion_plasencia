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


        <div class="col" style="height:66px;">
            <div class="row" style="margin-bottom:2px">

                <div class="col">
                    <form wire:submit.prevent="insertar_detalle_provicional()">
                        @csrf
                        <button class="mr-sm-2 botonprincipal" style="width:200px;">Agregar Programación </button>
                    </form>
                </div>

                <div class="col"> <input type="date" name="fecha_de" id="fecha_de" class="form-control "
                        style="width:100%;" placeholder="Fecha" wire:model="fede"> </div>

                <div class="col"> <input name="categoria" id="categoria" class="form-control mr-sm-2 "
                        style="width:100%;" placeholder="Categoria" wire:model="cat"> </div>

                <div class="col"> <input name="item" id="item" class="form-control mr-sm-2 " style="width:100%;"
                        placeholder="Item" wire:model="item"> </div>

                <div class="col"> <input name="orden" id="orden" class="form-control mr-sm-2 " style="width:100%;"
                        placeholder="Orden del sistema" wire:model="orden"> </div>

                <div class="col"><input name="hon" id="hon" class="form-control mr-sm-2 " style="width:100%;"
                        placeholder="Orden" wire:model="hon"> </div>

            </div>


            <div class="row">

                <div class="col">
                    <a href="/detalles_programacion"> <button class="mr-sm-2 botonprincipal" style="width:200px;">
                            Ver</button></a>
                </div>

                <div class="col">
                    <input type="text" class="form-input " placeholder="Buscar Marca" wire:model="marca"
                        style="width:100%;height:32px;" wire:keydown.delete="reset_marca"
                        wire:keydown.escape="reset_marca" wire:keydown.arrow-down="incrementaIluminadoMarca"
                        wire:keydown.arrow-up="decrementarIluminadoMarca" wire:keydown.enter="seleccionarMarca()">

                    @if ($oculto_marca == 0)
                    @if (!empty($marca))
                    <div style="overflow-y: scroll; height:200px;"
                        class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                        @if (!empty($marcas_p))

                        @foreach($marcas_p as $i => $m)
                        <a href="" wire:click.prevent="seleccionarMarca()"
                            class="list-group-item  {{$iluminadoIndiceMarca === $i ? 'active' : ''}}">{{$m->marca}}</a>
                        @endforeach

                        @else

                        <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">No Resultados
                        </div>

                        @endif
                    </div>
                    @endif
                    @endif
                </div>

                <div class="col">
                    <input type="text" class="form-input " placeholder="Buscar Vitola" wire:model="vito"
                        style="width:100%;height:32px;" wire:keydown.escape="reset_vitola"
                        wire:keydown.delete="reset_vitola" wire:keydown.arrow-down="incrementaIluminadoVitola"
                        wire:keydown.arrow-up="decrementarIluminadoVitola" wire:keydown.enter="seleccionarVitola()">

                    @if ($oculto_vitola == 0)
                    @if (!empty($vito))
                    <div style="overflow-y: scroll; height:200px;"
                        class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                        @if (!empty($vitolas_p))

                        @foreach($vitolas_p as $i => $m)
                        <a href="" wire:click.prevent="seleccionarVitola()"
                            class="list-group-item  {{$iluminadoIndiceVitola === $i ? 'active' : ''}}">{{$m->vitola}}</a>
                        @endforeach

                        @else

                        <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">No Resultados
                        </div>

                        @endif
                    </div>
                    @endif
                    @endif
                </div>

                <div class="col">
                    <input type="text" class="form-input " placeholder="Buscar Nombre" wire:model="nom"
                        style="width:100%;height:32px;" wire:keydown.escape="reset_nombre"
                        wire:keydown.delete="reset_nombre" wire:keydown.arrow-down="incrementaIluminadoNombre()"
                        wire:keydown.arrow-up="decrementarIluminadoNombre()" wire:keydown.enter="seleccionarNombre()">

                    @if ($oculto_nombre == 0)
                    @if (!empty($nom))
                    <div style="overflow-y: scroll; height:200px;"
                        class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                        @if (!empty($nombre_p))

                        @foreach($nombre_p as $i => $m)
                        <a href="" wire:click.prevent="seleccionarNombre()"
                            class="list-group-item  {{$iluminadoIndiceNombre === $i ? 'active' : ''}}">{{$m->nombre}}</a>
                        @endforeach

                        @else

                        <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">No Resultados
                        </div>

                        @endif
                    </div>
                    @endif
                    @endif
                </div>

                <div class="col">
                    <input type="text" class="form-input " placeholder="Buscar Capa" wire:model="capa"
                        style="width:100%;height:32px;" wire:keydown.escape="reset_capa"
                        wire:keydown.delete="reset_capa" wire:keydown.arrow-down="incrementaIluminadoCapa()"
                        wire:keydown.arrow-up="decrementarIluminadoCapa()" wire:keydown.enter="seleccionarCapa()">

                    @if ($oculto_capa == 0)
                    @if (!empty($capa))
                    <div style="overflow-y: scroll; height:200px;"
                        class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                        @if (!empty($capas_p))

                        @foreach($capas_p as $i => $m)
                        <a href="" wire:click.prevent="seleccionarCapa()"
                            class="list-group-item  {{$iluminadoIndiceCapa === $i ? 'active' : ''}}">{{$m->capa}}</a>
                        @endforeach

                        @else

                        <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">No Resultados
                        </div>

                        @endif
                    </div>
                    @endif
                    @endif
                </div>

                <div class="col">
                    <input type="text" class="form-input " placeholder="Buscar Tipo Empaque" wire:model="empa"
                        style="width:100%;height:32px;" wire:keydown.escape="reset_empaque"
                        wire:keydown.delete="reset_empaque" wire:keydown.arrow-down="incrementaIluminadoEmpaque()"
                        wire:keydown.arrow-up="decrementarIluminadoEmpaque()" wire:keydown.enter="seleccionarEmpaque()">

                    @if ($oculto_empaque == 0)
                    @if (!empty($empa))
                    <div style="overflow-y: scroll; height:200px;"
                        class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                        @if (!empty($empaques_p))

                        @foreach($empaques_p as $i => $m)
                        <a href="" wire:click.prevent="seleccionarEmpaque()"
                            class="list-group-item  {{$iluminadoIndiceEmpaque === $i ? 'active' : ''}}">{{$m->empaque}}</a>
                        @endforeach

                        @else

                        <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">No Resultados
                        </div>

                        @endif
                    </div>
                    @endif
                    @endif
                </div>
            </div>

        </div>
    </div>

    <form wire:submit.prevent="exportPendiente()">
        <input type="text" value="{{isset($nom)?$nom:null}}" name="nombre" id="nombre" hidden wire:model="nom">
        <input type="date" value="{{isset($fede)?$fede:null}}" name="fecha_de" id="fecha_de" hidden wire:model="fede">

    </form>



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
                        <td>{{$datos->pendiente}}</td>
                        <td>{{$datos->saldo}}</td>
                        <td style="text-align:center;">
                            <a style=" width:10px; height:10px;" href=""
                                wire:click.prevent="insertar_detalle_provicional_sin_existencia({{$datos->id_pendiente}})">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-up-right-square-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12zM5.904 10.803 10 6.707v2.768a.5.5 0 0 0 1 0V5.5a.5.5 0 0 0-.5-.5H6.525a.5.5 0 1 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 .707.707z" />
                                </svg>
                            </a>



                        </td>
                    </tr>

                    @endforeach
            </table>
        </div>
        <br>

        <div class="input-group" style="width:30%;position: fixed;right: 0px;bottom:0px; height:30px;">
            <span class="form-control input-group-text">Total pendiente</span>
            <input type="text" class="form-control" wire:model="total_pendiente">

            <span class="form-control input-group-text">Total saldo</span>
            <input type="text" class="form-control" wire:model="total_saldo">
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
                <div class="modal-dialog modal-dialog-centered modal-lg"
                    style="opacity:.9;background:#212529;width=80%">
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


    </div>
</div>
