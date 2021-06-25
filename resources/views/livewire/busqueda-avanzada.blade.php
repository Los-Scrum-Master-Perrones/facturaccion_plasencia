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
                <div class="input-group mb-3" style="height: 30px;">

                    <input type="date" name="fecha" id="fecha" class="form-control  mr-sm-2 " style="width:auto;"
                        placeholder="Nombre" wire:model="fecha">


                    <div class="relative">
                        
                        <input type="text" class="form-input  mr-sm-2 " placeholder="Buscar Marca" wire:model="marca" style="height:34px"
                            wire:keydown.escape="reset_marca"
                            wire:keydown.delete="reset_marca"
                            wire:keydown.ArrowUp="incrementaIluminadoMarca()" 
                            wire:keydown.ArrowDown="decrementarIluminadoMarca()"
                            wire:keydown.enter="seleccionarMarca()">
                            
                        @if ($oculto_marca == 0)
                                    @if (!empty($marca))
                                    <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                                        @if (!empty($marcas_p))

                                        @foreach($marcas_p as $i => $m)
                                        <a href="" class="list-group-item  {{$iluminadoIndice === $i ? 'active' : ''}}">{{$m->marca}}</a>
                                        @endforeach

                                        @else

                                        <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">No Resultados</div>

                                        @endif
                                    </div>
                                    @endif
                        @endif
                      


                    </div>


                    <div class="relative">
                        <input type="text" class="form-input  mr-sm-2 " placeholder="Buscar Nombre" wire:model="nombre" style="height:34px"
                            wire:keydown.escape="reset_nombre"
                            wire:keydown.delete="reset_nombre"
                            wire:keydown.ArrowUp="incrementaIluminadoNombre()" 
                            wire:keydown.ArrowDown="decrementarIluminadoNombre()"
                            wire:keydown.enter="seleccionarNombre()">
                            
                        @if ($oculto_nombre == 0)
                                    @if (!empty($nombre))
                                    <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                                        @if (!empty($nombre_p))

                                        @foreach($nombre_p as $i => $m)
                                        <a href="" class="list-group-item  {{$iluminadoIndiceNombre === $i ? 'active' : ''}}">{{$m->nombre}}</a>
                                        @endforeach

                                        @else

                                        <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">No Resultados</div>

                                        @endif
                                    </div>
                                    @endif
                        @endif
                    </div>

                    <div class="relative">
                        <input type="text" class="form-input  mr-sm-2 " placeholder="Buscar Capa" wire:model="capasss" style="height:34px"
                            wire:keydown.escape="reset_capa"
                            wire:keydown.delete="reset_capa"
                            wire:keydown.ArrowUp="incrementaIluminadoCapa()" 
                            wire:keydown.ArrowDown="decrementarIluminadoCapa()"
                            wire:keydown.enter="seleccionarCapa()">
                            
                        @if ($oculto_capa == 0)
                                    @if (!empty($capasss))
                                    <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                                        @if (!empty($capa_p))

                                        @foreach($capa_p as $i => $m)
                                        <a href="" class="list-group-item  {{$iluminadoIndiceCapa === $i ? 'active' : ''}}">{{$m->capas}}</a>
                                        @endforeach

                                        @else

                                        <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">No Resultados</div>

                                        @endif
                                    </div>
                                    @endif
                        @endif
                    </div>

                    <div class="relative">
                        <input type="text" class="form-input  mr-sm-2 " placeholder="Buscar Vitola" wire:model="vitolasss" style="height:34px"
                            wire:keydown.escape="reset_vitola"
                            wire:keydown.delete="reset_vitola"
                            wire:keydown.ArrowUp="incrementaIluminadoVitola()" 
                            wire:keydown.ArrowDown="decrementarIluminadoVitola()"
                            wire:keydown.enter="seleccionarVitola()">
                            
                        @if ($oculto_vitola == 0)
                                    @if (!empty($vitolasss))
                                    <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                                        @if (!empty($vitola_p))

                                        @foreach($vitola_p as $i => $m)
                                        <a href="" class="list-group-item  {{$iluminadoIndiceVitola === $i ? 'active' : ''}}">{{$m->vitolas}}</a>
                                        @endforeach

                                        @else

                                        <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">No Resultados</div>

                                        @endif
                                    </div>
                                    @endif
                        @endif
                    </div>

                    <input name="nombre" id="nombre" class="form-control mr-sm-2 " style="width:auto;"
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
                            <th >VITOLA</th>
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
                            <td>{{$producto->vitola}}</td>
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
