<div xmlns:wire="http://www.w3.org/1999/xhtml">

    <ul class="nav justify-content-center">
        @if (auth()->user()->rol == 0 || auth()->user()->rol == 1 )
        <li class="nav-item">
            <a class="nav-link" style="color:white; font-size:12px;" href="{{ route('inventario_cajas') }}"><strong>Catálogo
                    Cajas</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:white; font-size:12px;" href="{{ route('index_importar_cajas') }}"><strong>Importar
                    Cajas</strong></a>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" style="color:white; font-size:12px;" href="{{ route('materiales.index') }}"><strong>Materiales</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:white; font-size:12px;" href="{{ route('materiales.relacionar') }}"><strong>Materiales
                    materials</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:#E5B1E2; font-size:12px;" href="{{ route('entradas.salidas') }}"><strong>Entrada/Salida</strong></a>
        </li>

    </ul>

    <button wire:click='cambio_caja(1)' type="button" class="botonprincipal @if($cajas == 1)
    btn-success
@else

@endif" style="width:100px;height: 35;border-radius: 20%">Materiales</button>

<button wire:click='cambio_caja(2)' type="button" class="botonprincipal @if($cajas == 2)
    btn-success
@else

@endif" style="width:100px;height: 35;border-radius: 20%">Cajas</button>

    <div class="row">
        <div class="col">
            {{ $materiales->links() }}
        </div>
    </div>

    <div wire:change='tama' id="tabla_materiales" class="table-responsive">
        <div wire:loading.class='oscurecer_contenido' style="width:100%; padding-left:0px; height:100%;">
            <table class="table table-light" style="font-size:10px; ">
                <thead>
                    <tr style="font-size:16px; text-align:center;">
                        <th style=" text-align:center;">N#</th>
                        <th wire:ignore style=" text-align:center;">
                            <select name="todas_fitem" id="todas_fitem" onchange="buscar_io()">
                                <option value="">Factory Item</option>
                                @foreach ($items_factorys as $v)
                                <option value="{{$v}}">{{$v}}</option>
                                @endforeach
                            </select>
                        </th>
                        <th  wire:ignore style=" text-align:center;">
                            <select name="todas_cmaterial" id="todas_cmaterial" onchange="buscar_io()">
                                <option value="">Código Material</option>
                                @foreach ($items_codigo_materials as $v)
                                <option value="{{$v}}">{{$v}}</option>
                                @endforeach
                            </select>
                        </th>
                        <th wire:ignore style=" text-align:center;">
                            <select name="todas_nitem" id="todas_nitem" onchange="buscar_io()">
                                <option value="">Item Descripción</option>
                                @foreach ($items_descripcions as $v)
                                <option value="{{$v}}">{{$v}}</option>
                                @endforeach
                            </select>
                        </th>
                        <th wire:ignore style=" text-align:center;">
                            <select name="todas_fecha" id="todas_fecha" onchange="buscar_io()">
                                <option value="">Fecha</option>
                                @foreach ($items_fechas as $v)
                                <option value="{{$v}}">{{$v}}</option>
                                @endforeach
                            </select>
                        </th>
                        <th>Cantidad</th>
                        <th wire:ignore>
                            <select name="todas_tipos" id="todas_tipos" onchange="buscar_io()">
                                <option value="">Tipos</option>
                                @foreach ($items_tipos as $v)
                                <option value="{{$v}}">{{$v}}</option>
                                @endforeach
                            </select>
                        </th>
                        <th wire:ignore>
                            <select name="todas_notas" id="todas_notas" onchange="buscar_io()">
                                <option value="">Notas</option>
                                @foreach ($items_notas as $v)
                                <option value="{{$v}}">{{$v}}</option>
                                @endforeach
                            </select>
                        </th>
                    </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $count = 1;
                    $saldo = 0;
                    @endphp

                    @foreach($materiales as $material)
                    <tr>
                        <td style=" text-align:center;">{{ $count }}</td>
                        <td style=" text-align:center;">{{ $material->factory_item }}</td>
                        <td style=" text-align:center;">{{ $material->codigo_material }}</td>
                        <td>{{ $material->item_description }}</td>
                        <td style=" text-align:center;">{{ $material->fecha }}</td>
                        <td style=" text-align:center;">{{ number_format(abs($material->cantidad)) }}</td>
                        <td>{{ $material->tipo }}</td>
                        <td>{{ $material->descripcion }}</td>
                    </tr>
                    <?php
                        $count++;
                        $saldo += abs($material->cantidad);
                    ?>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
    </div>
    <div class="row">
        <div class="col-6"></div>
        <div class="col-3">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Total</span>
                <input style="width:150px;" type="text" class="form-control" value="{{ number_format($saldo,0)  }}">
            </div>
        </div>
        <div class="col-3">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Registros por pagina</span>
                <select name="" id="" class="form-control" wire:model='por_pagina'>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="500">500</option>
                </select>
            </div>
        </div>
    </div>


    @push('scripts')
    <script>

        var control_fitem;
        var control_cmaterial;
        var control_nitem;
        var control_tipos;
        var control_fecha;
        var control_notas;

        window.addEventListener('tamanio_tabla', event => {
            $('#tabla_materiales').css('height', ($('#bos').height() - 200));
        });


        $(document).ready(function() {

            $('#tabla_materiales').css('height', ($('#bos').height() - 200));

            control_fitem =  new TomSelect("#todas_fitem", {
                                                create: true
                                                , sortField: {
                                                    field: "text"
                                                    , direction: "asc"
                                                }
                                            });
            control_cmaterial =  new TomSelect("#todas_cmaterial", {
                                                create: true
                                                , sortField: {
                                                    field: "text"
                                                    , direction: "asc"
                                                }
                                            });
            control_nitem =  new TomSelect("#todas_nitem", {
                                                create: true
                                                , sortField: {
                                                    field: "text"
                                                    , direction: "asc"
                                                }
                                            });
            control_tipos =  new TomSelect("#todas_tipos", {
                                                create: true
                                                , sortField: {
                                                    field: "text"
                                                    , direction: "asc"
                                                }
                                            });
            control_fecha =  new TomSelect("#todas_fecha", {
                                                create: true
                                                , sortField: {
                                                    field: "text"
                                                    , direction: "asc"
                                                }
                                            });

            control_notas =  new TomSelect("#todas_notas", {
                                                create: true
                                                , sortField: {
                                                    field: "text"
                                                    , direction: "asc"
                                                }
                                            });


        });



        function buscar_io() {
            @this.items_factory = $('#todas_fitem').val();
            @this.items_fecha = $('#todas_fecha').val();
            @this.items_codigo_material = $('#todas_cmaterial').val();
            @this.items_descripcion = $('#todas_nitem').val();
            @this.items_tipo = $('#todas_tipos').val();
            @this.todas_nota = $('#todas_notas').val();
            @this.paginacion = 0;
        }




        window.addEventListener('eliminacion_exitoso', event => {
            Swal.fire('Eliminado con exito!', '', 'success');

            $('#tabla_materiales').css('height', ($('#bos').height() - 180));
        })

    </script>
    @endpush

</div>
