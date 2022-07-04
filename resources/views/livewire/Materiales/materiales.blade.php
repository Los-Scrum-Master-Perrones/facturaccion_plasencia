<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="{{ route('index_lista_cajas') }}"><strong>Catálogo
                    Cajas</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="{{ route('index_importar_cajas') }}"><strong>Importar
                    Cajas</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:#E5B1E2; font-size:12px;" href="{{ route('materiales.index') }}"><strong>Materiales</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="{{ route('materiales.relacionar') }}"><strong>Materiales
                    materials</strong></a>
        </li>
    </ul>
    <div class="row">
        <div class="col">
            <nav>
                <ul class="pagination justify-content-center">

                    <li class="page-item">
                        <a class="page-link" href="#" tabindex="-1" wire:click="mostrar_todo(0)">Dividir</a>
                    </li>
                    @php
                    $cantida = 1;
                    @endphp
                    @for ($i = 0; $i < $tuplas_conteo ; $i+=100) <li class="page-item"><a class="page-link" href="#" wire:click="paginacion_numerica({{$i}})">{{$cantida}}</a></li>
                        @php
                        $cantida++;
                        @endphp

                        @endfor
                        @php
                        $cantida = 1;
                        @endphp
                        <li class="page-item">
                            <a class="page-link" href="#" wire:click="mostrar_todo(1)">Mostrar Todo</a>
                        </li>
                </ul>
            </nav>
        </div>
    </div>

    <div wire:change='tama' id="tabla_materiales" class="table-responsive">
        <div style="width:100%; padding-left:0px; height:100%;">
            <table class="table table-light" style="font-size:10px; ">
                <thead>
                    <tr style="font-size:16px; text-align:center;">
                        <th style=" text-align:center;">N#</th>
                        <th style=" text-align:center;"></th>
                        <th wire:ignore style=" text-align:center;">
                            <select name="todas_fitem" id="todas_fitem" onchange="buscar_io()">
                                <option value="">Factory Item</option>
                                @foreach ($items_factory as $v)
                                <option value="{{$v}}">{{$v}}</option>
                                @endforeach
                            </select>
                        </th>
                        <th wire:ignore style=" text-align:center;">
                            <select name="todas_nitem" id="todas_nitem" onchange="buscar_io()">
                                <option value="">Navision Item</option>
                                @foreach ($items_navisor as $v)
                                <option value="{{$v}}">{{$v}}</option>
                                @endforeach
                            </select>
                        </th>
                        <th wire:ignore style=" text-align:center;">
                            <select name="todas_cmaterial" id="todas_cmaterial" onchange="buscar_io()">
                                <option value="">Codigo Material</option>
                                @foreach ($items_codigo as $v)
                                <option value="{{$v}}">{{$v}}</option>
                                @endforeach
                            </select>
                        </th>
                        <th wire:ignore>
                            <select name="todas_Des" id="todas_Des" onchange="buscar_io()">
                                <option value="">Descripción</option>
                                @foreach ($descripcion as $v)
                                <option value="{{$v}}">{{$v}}</option>
                                @endforeach
                            </select>
                        </th>
                        <th wire:ignore>
                            <select name="todas_Brand" id="todas_Brand" onchange="buscar_io()">
                                <option value="">Brand</option>
                                @foreach ($brand as $v)
                                <option value="{{$v}}">{{$v}}</option>
                                @endforeach
                            </select>
                        </th>
                        <th>Linea</th>
                        <th style=" text-align:center;">Saldo Minimo</th>
                        <th style=" text-align:center;">Saldo</th>
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
                        <td>
                            <a data-toggle="modal" data-target="#material_actualizar" style="width:10px; height:10px;" href="#" onclick="editar_material({{$material->id}},
                                                                            '{{$material->factory_item}}',
                                                                            '{{$material->navision_item}}',
                                                                            '{{$material->codigo_material}}',
                                                                            '{{$material->item_description}}',
                                                                            '{{$material->brand}}',
                                                                            '{{$material->linea}}',
                                                                            '{{$material->saldo_minimo}}',
                                                                            '{{$material->saldo}}')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </a>
                        </td>
                        <td style=" text-align:center;">{{ $material->factory_item }}</td>
                        <td style=" text-align:center;">{{ $material->navision_item }}</td>
                        <td style=" text-align:center;">{{ $material->codigo_material }}</td>
                        <td>{{ $material->item_description }}</td>
                        <td>{{ $material->brand }}</td>
                        <td>{{ $material->linea }}</td>
                        <td style=" text-align:center;">{{ $material->saldo_minimo }}</td>
                        <td style=" text-align:center;">{{ $material->saldo }}</td>
                    </tr>
                    <?php
                        $count++;
                        $saldo += $material->saldo;
                    ?>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
    </div>
    <div class="col-sm-9">
    </div>
    <div class="col-sm-1">
        <span style="width:50px;" class="form-control input-group-text">Total</span>
    </div>
    <div class="col-sm-2">
        <input style="width:150px;" type="text" class="form-control" value="{{ number_format($saldo,0)  }}">
    </div>

    <div class="modal fade" id="material_actualizar" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="material_actualizar" aria-hidden="true" style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-lg">
            <!-- INICIO DEL MODAL ACTUALIZAR MATERIAL -->
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="staticBackdropLabel"><strong>Actualizar Material</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </div>

                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-4 col">
                                <label for="txt_malos" class="form-label">Factory Item</label>
                                <input class="form-control" name="factoryed" id="factoryed"
                                    style=" height:30px;">
                            </div>
                            <div class="mb-4 col">
                                <label for="txt_malos" class="form-label">Navisor Item</label>
                                <input class="form-control" name="navisored" id="navisored"
                                    style=" height:30px;">
                            </div>
                            <div  class="mb-4 col">

                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-4 col">
                                <label for="txt_figuraytipo" class="form-label">Brand</label>
                                <input style=" height:30px; width: 100%;" name="branded" id="branded">
                            </div>
                            <div class="mb-4 col">
                                <label for="txt_malos" class="form-label">Linea</label>
                                <input style=" height:30px; width: 100%;" name="lineaed" id="lineaed">
                            </div>
                            <div class="mb-4 col">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-12 col">
                                <label for="txt_figuraytipo" class="form-label">Descripción</label>
                                <input name="desed" id="desed" style="font-size:16px" class="form-control" type="text"
                                    autocomplete="off">
                            </div>
                        </div>
                        <br>

                        <div wire:ignore class="row">
                            <div class="mb-12 col">
                                <label for="txt_figuraytipo" style="z-index: 999">Código Material</label>
                                <select class="codigobus" name="codigoed" id="codigoed" style="height:30px;" required>
                                    <option value="">Todos los codigos</option>
                                    @foreach($items_codigo_existentes as $codigo_existentes)
                                        <option value="{{ $codigo_existentes->codigo_material }}">
                                            {{ $codigo_existentes->codigo_material.' '.$codigo_existentes->des_material }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="mb-3 col">

                            </div>
                            <div class="mb-3 col">
                                <label for="txt_total" class="form-label">Saldo Minimo</label>
                                <input name="saldo_med" id="saldo_med" class="form-control" required type="number"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                                <label for="txt_buenos" class="form-label">Saldo</label>
                                <input name="saldo_ed" id="saldo_ed" class="form-control" required type="number"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                            </div>
                            <div class="mb-3 col">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class=" bmodal_no" data-dismiss="modal"><span>Cancelar</span>
                        @csrf
                    </button>
                    <button onclick="actulizar_material()" class=" bmodal_yes "> <span>Guardar</span> </button>
                </div>
            </div>
        </div>
    </div>


    <a style='display:scroll;
                position:fixed;
                top:20px;
                left: 20px;' href='#' >
        <button type="button" data-toggle="modal" data-target="#material_nuevo" class="btn btn-info" style="border-radius: 50%;width: 50px; height: 50px; text-align: center">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
        </button>
    </a>



    <div class="modal fade" id="material_nuevo" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="material_nuevo" aria-hidden="true" style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-lg">
            <!-- INICIO DEL MODAL NUEVO PRODUCTO -->
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="staticBackdropLabel"><strong>Nuevo Material</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </div>

                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-4 col">
                                <label for="txt_malos" class="form-label">Factory Item</label>
                                <input class="form-control" name="new_factoryed" id="new_factoryed"
                                    style=" height:30px;" value="{{ 'RP-0'.(intval(substr($factoryItemUltimo, 3))+1) }}" readonly>
                            </div>
                            <div class="mb-4 col">
                                <label for="txt_malos" class="form-label">Navisor Item</label>
                                <input class="form-control" name="new_navisored" id="new_navisored"
                                    style=" height:30px;">
                            </div>
                            <div  class="mb-4 col">

                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-4 col">
                                <label for="txt_figuraytipo" class="form-label">Brand</label>
                                <input style=" height:30px; width: 100%;" name="new_branded" id="new_branded">
                            </div>
                            <div class="mb-4 col">
                                <label for="txt_malos" class="form-label">Linea</label>
                                <input style=" height:30px; width: 100%;" name="new_lineaed" id="new_lineaed">
                            </div>
                            <div class="mb-4 col">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-12 col">
                                <label for="txt_figuraytipo" class="form-label">Descripción</label>
                                <input name="new_desed" id="new_desed" style="font-size:16px" class="form-control" type="text"
                                    autocomplete="off">
                            </div>
                        </div>
                        <br>

                        <div wire:ignore class="row">
                            <div class="mb-12 col">
                                <label for="txt_figuraytipo" style="z-index: 999">Código Material</label>
                                <select class="codigobus" name="new_codigoed" id="new_codigoed" style="height:30px;" required>
                                    <option value="">Todos los codigos</option>
                                    @foreach($items_codigo_existentes as $codigo_existentes)
                                        <option value="{{ $codigo_existentes->codigo_material }}">
                                            {{ $codigo_existentes->codigo_material.' '.$codigo_existentes->des_material }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="mb-3 col">

                            </div>
                            <div class="mb-3 col">
                                <label for="txt_total" class="form-label">Saldo Minimo</label>
                                <input name="new_saldo_med" id="new_saldo_med" class="form-control" required type="number"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                                <label for="txt_buenos" class="form-label">Saldo</label>
                                <input name="new_saldo_ed" id="new_saldo_ed" class="form-control" required type="number"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                            </div>
                            <div class="mb-3 col">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class=" bmodal_no" data-dismiss="modal"><span>Cancelar</span>
                        @csrf
                    </button>
                    <button onclick="insertar_material()" class=" bmodal_yes "> <span>Guardar</span> </button>
                </div>
            </div>
        </div>
    </div>



    @push('scripts')
    <script>

        var control;
        var new_control;
        window.addEventListener('tamanio_tabla', event => {
            $('#tabla_materiales').css('height', ($('#bos').height() - 180));
        });


        $(document).ready(function() {
            $('#tabla_materiales').css('height', ($('#bos').height() - 180));
            var seletscc = ["todas_Brand", "todas_Des", "todas_cmaterial", "todas_nitem", "todas_fitem"];
            seletscc.forEach(element => {
                selects(element);
            });


            control =  new TomSelect("#codigoed", {
                create: true,
                plugins: ['change_listener'],
                sortField: {
                    field: "text"
                    , direction: "asc"
                }
            });

            new_control =  new TomSelect("#new_codigoed", {
                create: true,
                plugins: ['change_listener'],
                sortField: {
                    field: "text"
                    , direction: "asc"
                }
            });
        });

        function selects(nombre) {
            new TomSelect("#" + nombre, {
                create: false
                , sortField: {
                    field: "text"
                    , direction: "asc"
                }
            });

        }

        function buscar_io() {
            @this.factory = $('#todas_fitem').val();
            @this.navisor = $('#todas_nitem').val();
            @this.codigo = $('#todas_cmaterial').val();
            @this.br = $('#todas_Brand').val();
            @this.descrip = $('#todas_Des').val();
            @this.paginacion = 0;
        }



        async function insertar_material() {

            if ($('#new_factoryed').val() == "" || $('#new_navisored').val() == "" ||
                $('#new_desed').val() == "" ||
                $('#new_branded').val() == "" || $('#new_lineaed').val() == "" ||
                $('#new_saldo_med').val() == "" || $('#new_saldo_ed').val() == "") {
                toastr.info('Hay compos requeridos vacios.', 'Advertencia!');
            } else {

            await @this.insertar_material({
                        'factoryed': $('#new_factoryed').val(),
                        'navisored': $('#new_navisored').val(),
                        'desed': $('#new_desed').val(),
                        'branded': $('#new_branded').val(),
                        'saldo_med': $('#new_saldo_med').val(),
                        'saldo_ed': $('#new_saldo_ed').val(),
                        'codigoed': $('#new_codigoed').val(),
                        'lineaed': $('#new_lineaed').val(),
                });

            }
        }

        window.addEventListener('insercion_exitoso', event => {
            Swal.fire('Insertado con exito!', '', 'success');

            $('#material_nuevo').modal('hide')
            $('#tabla_materiales').css('height', ($('#bos').height() - 180));
        })

        window.addEventListener('insercion_falta', event => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text:   'Hay campos erroneos.\n'+event.detail.mensaje
            });
        });





        function editar_material(id
            , factory_item
            , navision_item
            , codigo_material
            , item_description
            , brand, linea
            , saldo_minimo, saldo) {


            $('#factoryed').val(factory_item);
            $('#navisored').val(navision_item);
            control.setValue(codigo_material);
            $('#desed').val(item_description);
            $('#branded').val(brand);
            $('#lineaed').val(linea);
            $('#saldo_med').val(saldo_minimo);
            $('#saldo_ed').val(saldo);


        }


        async function actulizar_material() {

            if ($('#factoryed').val() == "" || $('#navisored').val() == "" ||
                $('#desed').val() == "" ||
                $('#branded').val() == "" || $('#lineaed').val() == "" ||
                $('#saldo_med').val() == "" || $('#saldo_ed').val() == "") {
                toastr.info('Hay compos requeridos vacios.', 'Advertencia!');
            } else {
               await @this.actualizar_material({
                        'factoryed': $('#factoryed').val(),
                        'navisored': $('#navisored').val(),
                        'desed': $('#desed').val(),
                        'branded': $('#branded').val(),
                        'saldo_med': $('#saldo_med').val(),
                        'saldo_ed': $('#saldo_ed').val(),
                        'codigoed': $('#codigoed').val(),
                        'lineaed': $('#lineaed').val(),
                });

            }
        }

        window.addEventListener('actualiza_exitoso', event => {
            Swal.fire('Actualizado con exito!', '', 'success');

            $('#material_actualizar').modal('hide')
            $('#tabla_materiales').css('height', ($('#bos').height() - 180));
        })

        window.addEventListener('actualiza_falta', event => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text:   'Hay campos erroneos.\n'+event.detail.mensaje
            });
        });

    </script>
    @endpush

</div>
