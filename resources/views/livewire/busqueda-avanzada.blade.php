<div xmlns:wire="http://www.w3.org/1999/xhtml">
    @livewireStyles
    <br>
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="pendiente"><strong>Pendiente</strong></a>
        </li>
        @if(auth()->user()->rol == -1)

        @else
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="import_excel"><strong>Importar pedido</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:#E5B1E2; font-size:12px;" href="pendiente_salida"><strong>Reporte</strong></a>
        </li>
        @endif
    </ul>
    <br>
    <div class="container" style="max-width:100%; ">
        <div class="row g-3">

            <div class="col-sm">
                <form>
                    <div class="form-row">
                        <div class="col-md-6">
                            <input type="date" name="fech1a" id="fech1a" style="width: 100%;" class="form-control" placeholder="Nombre"
                                wire:model="fecha_1">
                        </div>
                        <div class="col-md-6">
                            <input type="date" name="fech2a" id="fech2a" style="width: 100%;" class="form-control" placeholder="Nombre"
                                wire:model="fecha_2">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm" wire:ignore>
                <select name="todas_ordenes" id="todas_ordenes" class="form-control" onchange="busqueda_orden()">
                    <option value="">Todas las ordenes</option>
                    @foreach ($ordenes_p as $v)
                    <option value="{{$v->orden}}">{{$v->orden}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm" wire:ignore>
                <select name="todas_ordenes_sistema" id="todas_ordenes_sistema" class="form-control"
                    onchange="busqueda_orden()">
                    <option value="">Todas las ordenes del sistema</option>
                    @foreach ($ordenes_sis_p as $v)
                    <option value="{{$v->orden_del_sitema}}">{{$v->orden_del_sitema}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm" wire:ignore>
                <select name="todas_capas" id="todas_capas" class="form-control" onchange="busqueda_orden()">
                    <option value="">Todas las capas</option>
                    @foreach ($capa_p as $v)
                    <option value="{{$v->capa}}">{{$v->capa}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm" wire:ignore>
                <select name="todas_nombres" id="todas_nombres" class="form-control" onchange="busqueda_orden()">
                    <option value="">Todos los nombres</option>
                    @foreach ($nombre_p as $v)
                    <option value="{{$v->nombre}}">{{$v->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <div class="row g-3">
            <div class="col-sm" wire:ignore>
                <select name="todas_marcas" id="todas_marcas" class="form-control" onchange="busqueda_orden()">
                    <option value="">Todas las marcas</option>
                    @foreach ($marcas_p as $v)
                    <option value="{{$v->marca}}">{{$v->marca}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm" wire:ignore>
                <select name="todas_vitolas" id="todas_vitolas" class="form-control" onchange="busqueda_orden()">
                    <option value="">Todas las vitolas</option>
                    @foreach ($vitola_p as $v)
                    <option value="{{$v->vitola}}">{{$v->vitola}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm" wire:ignore>
                <select name="todas_tipo_empaques" id="todas_tipo_empaques" class="form-control"
                    onchange="busqueda_orden()">
                    <option value="">Todos los Tipos de Empaque</option>
                    @foreach ($tipo_empaque_p as $v)
                    <option value="{{$v->tipo_empaque}}">{{$v->tipo_empaque}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm" wire:ignore>
                <input name="nombre" id="nombre" class="form-control" placeholder="Numero Factura" wire:model="num_fac">
            </div>

            <div class="col">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle form-control" type="button"
                        id="dropdownMenuButton1" data-toggle="dropdown">
                        Presentacion
                    </button>
                    <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton1">
                        <div class="form-check ">
                            <input class="form-check-input" type="checkbox" value="Puros Tripa Larga" id="checkbox5"
                                checked name="checkbox5" wire:model="r_cinco">
                            <label class="form-check-label " for="flexCheckDefault"> Puros Tripa Larga </label>
                        </div>

                        <div class="form-check ">
                            <input class="form-check-input" type="checkbox" value="Puros Tripa Corta" id="checkbox6"
                                checked name="checkbox6" wire:model="r_seis">
                            <label class="form-check-label " for="flexCheckChecked"> Puros Tripa Corta </label>
                        </div>

                        <div class="form-check ">
                            <input class="form-check-input " type="checkbox" value="Puros Sandwich" id="checkbox7"
                                checked name="checkbox7" wire:model="r_siete">
                            <label class="form-check-label " for="flexCheckDefault"> Puros Sandwich
                            </label>
                        </div>
                        <div class="form-check ">
                            <input class="form-check-input " type="checkbox" value="Puros Brocha" id="checkbox7"
                                checked name="checkbox7" wire:model="r_mill">
                            <label class="form-check-label " for="flexCheckDefault"> Puros Brocha
                            </label>
                        </div>
                    </ul>
                </div>
            </div>

            
            <div class="col-sm">
                <button wire:click="exportar_reporte()" class=" botonprincipal">Exportar</button>
            </div>
        </div>



        <div class="row">

            <div class="panel-body">
                <div style="width:100%;   font-size:10px;   overflow-x: display; overflow-y: auto;
     height:450px;">
                    @csrf
                    <table class="table table-light" style="font-size:10px;">
                        <thead>
                            <tr>
                                <th>ITEM</th>
                                <th>MARCA</th>
                                <th>NOMBRE</th>
                                <th style="width:100px;">CAPA</th>
                                <th>VITOLA</th>
                                <th>EMPAQUE</th>
                                <th>PRESENTACION</th>
                                <th>ENVIADAS (CAJAS)</th>
                                <th>ENVIADAS (TABACO)</th>
                                <th>PRECIO ($)</th>
                                <th>ORDEN</th>
                                <th>ORDEN (SISTEMA)</th>
                                <th>FACTURA</th>
                                <th>CONTENEDOR</th>
                                <th>FECHA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $total_puros_tabla = 0;
                            $total_puros_dinero = 0;
                            $total_cajas_tabla = 0;

                            @endphp

                            @foreach($productos as $producto)
                            <tr>
                                <td>{{$producto->codigo_item}}</td>
                                <td>{{$producto->marca}}</td>
                                <td>{{$producto->nombre}}</td>
                                <td>{{$producto->capas}}</td>
                                <td>{{$producto->vitola}}</td>
                                <td>{{$producto->tipo_empaque}}</td> 
                                <td>{{$producto->presentacion}}</td>
                                <td style="text-align: center">{{$producto->cantidad_cajas}}</td>
                                <td style="text-align: center">{{(int)$producto->total_tabacos}}</td>
                                <td style="text-align: end">{{number_format($producto->total_precio_tabacos,2)}}</td>
                                <td>{{$producto->orden}}</td>
                                <td style="text-align: center">{{$producto->orden_sistema}}</td>
                                <td>{{$producto->num_factura}}</td>
                                <td>{{$producto->contenedor}}</td>
                                <td>{{$producto->fecha}}</td>
                            </tr>
                            @php
                            $total_puros_tabla += $producto->total_tabacos;
                            $total_puros_dinero += $producto->total_precio_tabacos;
                            $total_cajas_tabla += $producto->cantidad_cajas;
                            @endphp
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="input-group" style="width:45%;position: fixed;right: 0px;bottom:0px; height:30px;display:flex;"
            id="sumas1">
            <span id="de" class="input-group-text form-control "
                style="background:rgba(174, 0, 255, 0.432);color:white;">Total Cajas</span>
            <input type="number" class="form-control  mr-sm-4" placeholder="0" value="{{$total_cajas_tabla}}" readonly>

            <span id="de" class="input-group-text form-control"
                style="background:rgba(174, 0, 255, 0.432);color:white;">Total Puros</span>
            <input type="number" class="form-control  mr-sm-4" placeholder="0" value="{{$total_puros_tabla}}" readonly>

            <span id="de" class="input-group-text form-control"
                style="background:rgba(174, 0, 255, 0.432);color:white;">Total ($)</span>
            <input type="number" class="form-control  mr-sm-4" placeholder="0" value="{{$total_puros_dinero}}" readonly>
        </div>


    </div>

    <script>
        function busqueda_orden() {
            @this.orden = $("#todas_ordenes").select2('val');
            @this.orden_sistema = $("#todas_ordenes_sistema").select2('val');
            @this.marca = $("#todas_marcas").select2('val');
            @this.nombre = $("#todas_nombres").select2('val');
            @this.capasss = $("#todas_capas").select2('val');
            @this.vitolasss = $("#todas_vitolas").select2('val');
            @this.tipo_empaque = $("#todas_tipo_empaques").select2('val');
        }
    </script>

</div>
