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
            <a style="color:#E5B1E2; font-size:12px;" href="pendiente"><strong>Pendiente</strong></a>
        </li>

        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="import_excel"><strong>Importar pedido</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="pendiente_salida"><strong>Reporte</strong></a>
        </li>
    </ul>



    <div class="container" style="max-width:100%;">


        <div class="col" style="height:74px;" >
            <div class="row"  style="margin-bottom:2px">

                  <div class="col" > <button class="botonprincipal"  onclick="mostrar_div_AddProductoP()" type="submit" >
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                     </svg> Agregar producto al pendiente</button>  </div>

                  <div class="col" >  <input type="date" name="fecha_de" id="fecha_de" class="form-control "  style="width:100%;" placeholder="Fecha" wire:model="fede"> </div>

                  <div class="col" >  <input name="categoria" id="categoria" class="form-control mr-sm-2 " style="width:100%;"    placeholder="Categoria" wire:model="cat"> </div>

                  <div class="col" >  <input name="item" id="item" class="form-control mr-sm-2 " style="width:100%;" placeholder="Item" wire:model="item"> </div>

                  <div class="col" >  <input name="orden" id="orden" class="form-control mr-sm-2 " style="width:100%;"  placeholder="Orden del sistema" wire:model="orden"> </div>

                  <div class="col" ><input name="hon" id="hon" class="form-control mr-sm-2 " style="width:100%;"  placeholder="Orden" wire:model="hon"> </div>

            </div>

                    
            <div class="row">   
                        
            <div class="col" >
            <input type="text" class="form-input " placeholder="Buscar Marca" wire:model="marca"  style="width:100%;height:34px;"
                            wire:keydown.delete="reset_marca"
                            wire:keydown.escape="reset_marca"
                            wire:keydown.arrow-down="incrementaIluminadoMarca" 
                            wire:keydown.arrow-up="decrementarIluminadoMarca"
                            wire:keydown.enter="seleccionarMarca()">
                            
                        @if ($oculto_marca == 0)
                                    @if (!empty($marca))
                                    <div style="overflow-y: scroll; height:200px;"  class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                                        @if (!empty($marcas_p))

                                        @foreach($marcas_p as $i => $m)
                                        <a href="" wire:click.prevent="seleccionarMarca()" class="list-group-item  {{$iluminadoIndiceMarca === $i ? 'active' : ''}}">{{$m->marca}}</a>
                                        @endforeach

                                        @else

                                        <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">No Resultados</div>

                                        @endif
                                    </div>
                                    @endif
                        @endif
            </div>
                        
            <div class="col" >
            <input type="text" class="form-input " placeholder="Buscar Vitola" wire:model="vito" style="width:100%;height:34px;"
                            wire:keydown.escape="reset_vitola"
                            wire:keydown.delete="reset_vitola"
                            wire:keydown.arrow-down="incrementaIluminadoVitola" 
                            wire:keydown.arrow-up="decrementarIluminadoVitola"
                            wire:keydown.enter="seleccionarVitola()">
                            
                        @if ($oculto_vitola == 0)
                                    @if (!empty($vito))
                                    <div style="overflow-y: scroll; height:200px;"  class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                                        @if (!empty($vitolas_p))

                                        @foreach($vitolas_p as $i => $m)
                                        <a href="" wire:click.prevent="seleccionarVitola()" class="list-group-item  {{$iluminadoIndiceVitola === $i ? 'active' : ''}}">{{$m->vitola}}</a>
                                        @endforeach

                                        @else

                                        <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">No Resultados</div>

                                        @endif
                                    </div>
                                    @endif
                        @endif 
             </div>

            <div class="col" >
            <input type="text" class="form-input " placeholder="Buscar Nombre" wire:model="nom" style="width:100%;height:34px;"
                            wire:keydown.escape="reset_nombre"
                            wire:keydown.delete="reset_nombre"
                            wire:keydown.arrow-down="incrementaIluminadoNombre()" 
                            wire:keydown.arrow-up="decrementarIluminadoNombre()"
                            wire:keydown.enter="seleccionarNombre()">
                            
                        @if ($oculto_nombre == 0)
                                    @if (!empty($nom))
                                    <div style="overflow-y: scroll; height:200px;"  class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                                        @if (!empty($nombre_p))

                                        @foreach($nombre_p as $i => $m)
                                        <a href="" wire:click.prevent="seleccionarNombre()" class="list-group-item  {{$iluminadoIndiceNombre === $i ? 'active' : ''}}">{{$m->nombre}}</a>
                                        @endforeach

                                        @else

                                        <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">No Resultados</div>

                                        @endif
                                    </div>
                                    @endif
                        @endif 
            </div>
                        
            <div class="col" >
            <input type="text" class="form-input " placeholder="Buscar Capa" wire:model="capa" style="width:100%;height:34px;"
                            wire:keydown.escape="reset_capa"
                            wire:keydown.delete="reset_capa"
                            wire:keydown.arrow-down="incrementaIluminadoCapa()" 
                            wire:keydown.arrow-up="decrementarIluminadoCapa()"
                            wire:keydown.enter="seleccionarCapa()">
                            
                        @if ($oculto_capa == 0)
                                    @if (!empty($capa))
                                    <div style="overflow-y: scroll; height:200px;"  class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                                        @if (!empty($capas_p))

                                        @foreach($capas_p as $i => $m)
                                        <a href="" wire:click.prevent="seleccionarCapa()" class="list-group-item  {{$iluminadoIndiceCapa === $i ? 'active' : ''}}">{{$m->capa}}</a>
                                        @endforeach

                                        @else

                                        <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">No Resultados</div>

                                        @endif
                                    </div>
                                    @endif
                        @endif 
             </div>

            <div class="col" >
            <input type="text" class="form-input " placeholder="Buscar Tipo Empaque" wire:model="empa" style="width:100%;height:34px;"
                            wire:keydown.escape="reset_empaque"
                            wire:keydown.delete="reset_empaque"
                            wire:keydown.arrow-down="incrementaIluminadoEmpaque()" 
                            wire:keydown.arrow-up="decrementarIluminadoEmpaque()"
                            wire:keydown.enter="seleccionarEmpaque()">
                            
                        @if ($oculto_empaque == 0)
                                    @if (!empty($empa))
                                    <div style="overflow-y: scroll; height:200px;"  class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                                        @if (!empty($empaques_p))

                                        @foreach($empaques_p as $i => $m)
                                        <a href="" wire:click.prevent="seleccionarEmpaque()" class="list-group-item  {{$iluminadoIndiceEmpaque === $i ? 'active' : ''}}">{{$m->empaque}}</a>
                                        @endforeach

                                        @else

                                        <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">No Resultados</div>

                                        @endif
                                    </div>
                                    @endif
                        @endif 
             </div>
            
            <div class="col" >
            <form wire:submit.prevent="exportPendiente()">
                <input type="text" value="{{isset($nom)?$nom:null}}" name="nombre" id="nombre" hidden
                wire:model="nom">
                <input type="date" value="{{isset($fede)?$fede:null}}" name="fecha_de" id="fecha_de" hidden
                wire:model="fede">
                <button class="botonprincipal" type="submit" >
                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z"/>
                </svg> Exportar
                </button>
            </form>
             </div>     
            </div>
            </div>
            </div>



    <div style="  display: none;justify-content: center;align-items: center;height: 100%;position:fixed;top:0px;width:50%;left:25%;" id="div_AddProductoPendiente"   >
    <!-- INICIO DEL MODAL NUEVO PRODUCTO -->
    
    <form action="{{Route('nuevo_pendiente')}} " method="POST">
        <div  data-backdrop="static" data-keyboard="false" tabindex="-1" 
        aria-labelledby="staticBackdropLabel" aria-hidden="true"  style="background:#212529;width=800px;">
            <div >
                <div class="modal-content" >

                    <div class="modal-header">
                        <h5 id="staticBackdropLabel"><strong>Agregar producto</strong></h5>
                        <button type="button" class="btn-close"  aria-label="Close" onclick="ocultar_div_AddProductoP()" ></button>
                    </div>

                    <div class="modal-body">


                        <div class="card-body">
                            <div class="row">

                                <label for="txt_figuraytipo" class="form-label">Categoria</label>

                                <select class="form-control" name="categoria" id="categoria"
                                    placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;"
                                    required>
                                    <option value="1">NEW ROLL</option>
                                    <option value="2">CATALOGO</option>
                                    <option value="3">TAKE FROM EXISTING INVENT</option>
                                    <option value="4">INTERNATIONAL SALES</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="txt_figuraytipo" class="form-label">Item</label>
                                    <input name="itemn" id="itemn" style="font-size:16px" class="form-control" required
                                        type="text" autocomplete="off">
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_figuraytipo" class="form-label">Orden del sistema</label>
                                    <input name="ordensis" id="ordensis" style="font-size:16px" class="form-control"
                                        type="text" autocomplete="off">
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_figuraytipo" class="form-label">Observacion</label>
                                    <input name="observacionn" id="observacionn" style="font-size:16px"
                                        class="form-control" type="text" autocomplete="off">
                                </div>
                            </div>


                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="txt_malos" class="form-label">Presentación</label>

                                    <select class="form-control" name="presentacionn" id="presentacionn"
                                        placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;"
                                        required>
                                        <option value="Puros Tripa Larga" style="overflow-y: scroll;">Puros Tripa Larga
                                        </option>
                                        <option value="Puros Tripa Corta" style="overflow-y: scroll;">Puros Tripa Corta
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_figuraytipo" class="form-label">Fecha</label>
                                    <input name="fechan" id="fechan" style="font-size:12px" class="form-control"
                                        required type="date" autocomplete="off">
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_figuraytipo" class="form-label">Orden</label>
                                    <input name="ordenn" id="ordenn" style="font-size:16px" class="form-control"
                                        required type="text" autocomplete="off">
                                </div>
                            </div>


                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="txt_vitola" class="form-label">Marca</label>
                                    <select class=" mi-selector"  style=" height:30px; width: 100%; " name="marca" id="marca" placeholder="Ingresa figura y tipo" required>
                                        @foreach($marcas as $mar)
                                        <option style="overflow-y: scroll;"> {{$mar->marca}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col">
                                    <label for="vitola" class="form-label">Vitola</label>
                                    <select class=" mi-selector"  style=" height:30px; width: 100%; "  name="vitola" id="vitola" placeholder="Ingresa figura y tipo"  required>
                                        @foreach($vitolas as $vitola)
                                        <option style="overflow-y: scroll;"> {{$vitola->vitola}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_total" class="form-label">Nombre</label>

                                    <select class=" mi-selector"  style=" height:30px; width: 100%; " name="nombre" id="nombre" placeholder="Ingresa figura y tipo" required>
                                        @foreach($nombres as $nombre)
                                        <option style="overflow-y: scroll;"> {{$nombre->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="row">

                                <div class="mb-3 col">
                                    <label for="txt_figuraytipo" class="form-label">Capa</label>
                                    <select class=" mi-selector"  style=" height:30px; width: 100%; " name="capa" id="capa"placeholder="Ingresa figura y tipo" required>
                                        @foreach($capas as $capa)
                                        <option style="overflow-y: scroll;"> {{$capa->capa}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_malos" class="form-label">Tipo de
                                        empaque</label>
                                    <select class=" mi-selector"  style=" height:30px; width: 100%; " name="tipo" id="tipo" placeholder="Ingresa figura y tipo" required>
                                        @foreach($tipo_empaques as $tipo_empaque)
                                        <option style="overflow-y: scroll;"> {{$tipo_empaque->tipo_empaque}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="mb-3 col">
                                <div class="row">
                                     <div class="col">
                                    <input type="checkbox" name="cello" id="cello" style="font-size:20px" value="si">
                                    <label for="cello" class="form-label">Cello</label>
                                    </div>

                                    <div class="col">
                                    <input type="checkbox" name="anillo" id="anillo" style="font-size:20px" value="si">
                                    <label for="anillo" class="form-label">Anillo</label>
                                    </div>

                                    <div class="col">
                                    <input type="checkbox" name="upc" id="upc" style="font-size:20px" value="si">
                                    <label for="upc" class="form-label">UPC</label>
                                    </div>
                                </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="txt_total" class="form-label">Pendiente</label>
                                    <input name="pendienten" id="pendienten" class="form-control" required type="number"
                                        autocomplete="off">
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_buenos" class="form-label">Saldo</label>
                                    <input name="saldon" id="saldon" class="form-control" required type="number"
                                        autocomplete="off">
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_total" class="form-label">Paquetes</label>
                                    <input name="paquetes" id="paquetes" class="form-control" required type="number"
                                        autocomplete="off">
                                </div>
                            </div>


                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="txt_total" class="form-label">Unidades</label>
                                    <input name="unidades" id="unidades" class="form-control" required type="number"
                                        autocomplete="off">
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_buenos" class="form-label">Codigo precio</label>
                                    <input name="c_precion" id="c_precion" class="form-control" type="text"
                                        autocomplete="off">
                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_total" class="form-label">precio</label>
                                    <input name="precion" id="precion" class="form-control" type="number"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class=" bmodal_no" onclick="ocultar_div_AddProductoP()" ><span>Cancelar</span>
                            @csrf
                        </button>
                        <button onclick="agregarproducto()" class=" bmodal_yes "> <span>Guardar</span> </button>
                    </div>

                </div>
            </div>
        </div>
    </form>
    <!-- FIN DEL MODAL NUEVO PRODUCTO -->
    </div>







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
                            <th>ANILLO</th>
                            <th>CELLO</th>
                            <th>UPC</th>
                            <th>COD.PRECIO</th>
                            <th>PRECIO</th>
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
                            <td>{{$datos->serie_precio}}</td>
                            <td>{{$datos->precio}}</td>
                            <td>{{$datos->pendiente}}</td>
                            <td>{{$datos->saldo}}</td>


                            <td style="text-align:center;">
                                <a data-toggle="modal" data-target="#modal_eliminar_detalle"
                                    onclick="datos_modal_eliminar({{$datos->id_pendiente}})" href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg></a>


                                <a style=" width:10px; height:10px;" data-toggle="modal" href=""
                                    data-target="#modal_actualizar" type="submit"
                                    onclick="datos_modal_actualizar({{$datos->id_pendiente}},{{$datos->item}})">
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
            </div>
        </div>
    </div>



    <!-- INICIO MODAL ELMINAR DATO PENDIENTE -->
    <form action="{{Route('borrarpendiente')}}" id="formulario_mostrarE" name="formulario_mostrarE" method="POST">

        @csrf
        <?php use App\Http\Controllers\UserController; ?>

        <input name="id_pendiente" id="id_pendiente" value="" hidden />

        <div class="modal fade" id="modal_eliminar_detalle" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Eliminar <strong><input value=""
                                    id="txt_usuarioE" name="txt_usuarioE" style="border:none;"></strong> </h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro que quieres eliminar este registro del pendiente?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="bmodal_no " data-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button type="submit" class=" bmodal_yes ">
                            <span>Eliminar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <!-- FIN MODAL ELMINAR DATO PENDIENTE -->


    <!-- INICIO MODAL ACTUALIZAR DATO PENDIENTE -->



    <form action="{{Route('actualizar_pendiente')}}" method="POST" id="actualizar_pendiente"
        name="actualizar_pendiente">
        <div class="modal fade" role="dialog" id="modal_actualizar" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
            style="opacity:.9;background:#212529;width=800px;">
            <div class="modal-dialog modal-dialog-centered modal-lg" style="opacity:.9;background:#212529;width=80%">
                <div class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 id="staticBackdropLabel"><strong>Descripción del producto: </strong><span id="titulo"
                                name="titulo"></span></h5>
                    </div>


                    <div class="modal-body">
                        <div class="row">

                            <input name="id_pendientea" id="id_pendientea" value="" hidden />

                            <input name="itema" id="itema" value="" hidden />
                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Orden del sistema</label>
                                <input name="orden_sistema" id="orden_sistema" class="form-control" \ type="text"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Orden</label>
                                <input name="orden" id="orden" class="form-control" type="text" autocomplete="off">
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Presentación</label>
                                <input name="presentacion" id="presentacion" class="form-control" type="text"
                                    autocomplete="off">
                            </div>
                        </div>


                        <div class="row">


                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Pendiente</label>
                                <input name="pendiente" id="pendiente" class="form-control" type="text"
                                    autocomplete="off">


                            </div>

                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Código precio</label>
                                <input name="cprecio" id="cprecio" class="form-control" type="text" autocomplete="off">


                            </div>

                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Precio</label>
                                <input name="precio" id="precio" class="form-control" type="text" autocomplete="off">


                            </div>



                        </div>

                        <div class="row">

                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Observación</label>
                                <input name="observacion" id="observacion" class="form-control" type="text"
                                    autocomplete="off">
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

   

    <script type="text/javascript">
        function ocultar_div_AddProductoP() {             
           document.getElementById('div_AddProductoPendiente').style.display = "none";
        }     
        function mostrar_div_AddProductoP() {               
            document.getElementById('div_AddProductoPendiente').style.display = "flex";
        }

    </script>


    <script type="text/javascript">
        function datos_modal_eliminar(id) {
            var datas = '<?php echo json_encode($datos_pendiente);?>';

            var data = JSON.parse(datas);



            for (var i = 0; i < data.length; i++) {
                if (data[i].id_pendiente === id) {
                    document.formulario_mostrarE.id_pendiente.value = data[i].id_pendiente;


                }
            }

        }
    </script>




    <script type="text/javascript">
        function datos_modal_actualizar(id, item) {
            var datas = '<?php echo json_encode($datos_pendiente);?>';

            var data = JSON.parse(datas);

            var producto = "";

            for (var i = 0; i < data.length; i++) {
                if (data[i].id_pendiente === id) {
                    document.actualizar_pendiente.id_pendientea.value = data[i].id_pendiente;

                    document.actualizar_pendiente.itema.value = data[i].item;

                    producto =
                        document.getElementById("titulo").innerHTML = "".concat(data[i].marca, " ", data[i].nombre, " ",
                            data[i].capa, " ", data[i].vitola);;


                    document.actualizar_pendiente.presentacion.value = data[i].presentacion;

                    document.actualizar_pendiente.observacion.value = data[i].observacion;

                    document.actualizar_pendiente.orden_sistema.value = data[i].orden_del_sitema;

                    document.actualizar_pendiente.pendiente.value = data[i].pendiente;
                    document.actualizar_pendiente.cprecio.value = data[i].serie_precio;

                    document.actualizar_pendiente.precio.value = data[i].precio;

                    document.actualizar_pendiente.orden.value = data[i].orden;




                }
            }

        }
    </script>



    <script type="text/javascript">
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $("input[name=_token]").val()
                }
            });

            $('#editable').Tabledit({
                url: '{{ route("tabledit.action") }}',
                method: 'POST',
                dataType: "json",
                columns: {
                    identifier: [0, 'id'],
                    editable: [
                        [1, 'first_name'],
                        [2, 'last_name'],
                        [3, 'gender']
                    ]
                },
                restoreButton: false,

                onSuccess: function (data, textStatus, jqXHR) {
                    if (data.action == 'delete') {
                        $('#' + data.id).remove();
                    }
                }

            });

        });
    </script>



</div>