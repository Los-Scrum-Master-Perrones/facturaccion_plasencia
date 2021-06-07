<div xmlns:wire="http://www.w3.org/1999/xhtml">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <br>
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="pendiente"><strong>Pendiente</strong></a>
        </li>

        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="import_excel"><strong>Importar pedido</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:#E5B1E2; font-size:12px;" href="pendiente_salida"><strong>Reporte</strong></a>
        </li>
    </ul>
    <br>

    <div class="container" style="max-width:100%; ">
        <div class="row" style="text-align:center;">

            <div class="col">
                <div class="input-group mb-3">

                    <input type="date" name="fecha" id="fecha" class="form-control botonprincipal"
                        style="width:auto;" placeholder="Nombre" wire:model="fecha">


                    <div class="relative">
                        <input type="text"
                        class="form-input"
                        placeholder="Buscar Marca"

                        wire:model="marca"
                        wire:keydown.escape="reset"
                        wire:keydown.tab="reset"
                        wire:keydown.ArrowUp="decrementHighlight"
                        wire:keydown.ArrowDown="incrementHighlight">
                        
                        @if (!empty($marca))
                            <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                                @foreach($marcas_p as $m)
                                    <a  href="">{{$m->marca}}</a>
                                @endforeach
                            </div>
                        @else

                            <div class="list-item">No Resultados</div>

                        @endif
                        
                    </div>

                    <select class="form-control" wire:model="nombre">
                        <option value="">Todo</option>
                        @foreach($nombre_p as $m)
                            <option value="{{$m->nombre}}">{{$m->nombre}}</option>
                        @endforeach
                    </select>
                    <select class="form-control mi-selector" wire:model="capasss">
                        <option value="">Todo</option>
                        @foreach($capa_p as $m)
                            <option value="{{$m->capas}}">{{$m->capas}}</option>
                        @endforeach
                    </select>

                    <input name="nombre" id="nombre" class="form-control mr-sm-2 botonprincipal" style="width:auto;"
                        placeholder="Numero Factura" wire:model="num_fac">
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
                            <th>ITEM</th>
                            <th>MARCA</th>
                            <th>NOMBRE</th>
                            <th style="width:100px;">CAPA</th>
                            <th>EMPAQUE</th>
                            <th>ENVIADAS (CAJAS)</th>
                            <th>ENVIADAS (TABACO)</th>
                            <th>ORDEN</th>
                            <th>FACTURA</th>
                            <th>CONTENEDOR</th>
                            <th>FECHA</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($productos as $producto)
                        <tr>
                            <td>{{$producto->codigo_item}}</td>
                            <td>{{$producto->marca}}</td>
                            <td>{{$producto->nombre}}</td>
                            <td>{{$producto->capas}}</td>
                            <td>{{$producto->tipo_empaque}}</td>
                            <td>{{$producto->cantidad_cajas}}</td>
                            <td>{{$producto->total_tabacos}}</td>
                            <td>{{$producto->orden}}</td>
                            <td>{{$producto->num_factura}}</td>
                            <td>{{$producto->contenedor}}</td>
                            <td>{{$producto->fecha}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    

</div>
