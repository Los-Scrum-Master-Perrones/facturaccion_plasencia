<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="{{ route('index_lista_cajas') }}"><strong>Catálogo Cajas</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="{{ route('index_importar_cajas') }}"><strong>Importar Cajas</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="{{ route('materiales.index') }}"><strong>Materiales</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:#E5B1E2; font-size:12px;" href="{{ route('materiales.relacionar')}}"><strong>Materiales Productos</strong></a>
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
                    @for ($i = 0; $i < $tuplas_conteo ; $i+=250) <li class="page-item"><a class="page-link" href="#" wire:click="paginacion_numerica({{$i}})">{{$cantida}}</a></li>
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
                        <th colspan="2" wire:ignore style=" text-align:center;">
                            <select name="todas_fitem" id="todas_fitem" onchange="buscar_io()">
                                <option value="">Item</option>
                                @foreach ($items as $v)
                                <option value="{{$v}}">{{$v}}</option>
                                @endforeach
                            </select>
                        </th>
                        <th wire:ignore style=" text-align:center;">
                            <select name="todas_cp" id="todas_cp" onchange="buscar_io()">
                                <option value="">Codigo Productos</option>
                                @foreach ($codigo_productos as $v)
                                <option value="{{$v}}">{{$v}}</option>
                                @endforeach
                            </select>
                        </th>
                        <th wire:ignore style=" text-align:center;">
                            <select name="todas_te" id="todas_te" onchange="buscar_io()">
                                <option value="">Tipo Empaque</option>
                                @foreach ($tipo_empaques as $v)
                                <option value="{{$v}}">{{$v}}</option>
                                @endforeach
                            </select>
                        </th>
                        <th wire:ignore style=" text-align:center;">
                            <select name="todas_cm" id="todas_cm" onchange="buscar_io()">
                                <option value="">Codigo Material</option>
                                @foreach ($codigo_materials as $v)
                                <option value="{{$v}}">{{$v}}</option>
                                @endforeach
                            </select>
                        </th>
                        <th wire:ignore>
                            <select name="todas_Des" id="todas_Des" onchange="buscar_io()">
                                <option value="">Descripción</option>
                                @foreach ($des_materials as $v)
                                <option value="{{$v}}">{{$v}}</option>
                                @endforeach
                            </select>
                        </th>
                        <th style=" text-align:center;">Cantidad</th>
                        <th style=" text-align:center;">UXE</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $count = 1;
                    @endphp

                    @foreach($materiales as $material)
                    <tr>
                        <td style="text-align:center;">{{ $count }}</td>
                        <td>
                            <a data-toggle="modal" data-target="#material_actualizar" style="width:10px; height:10px;" href="#"
                                         onclick="editar_material({{$material->id}},
                                                                            '{{$material->item}}',
                                                                            '{{$material->codigo_producto}}',
                                                                            '{{$material->id_tipo_empaque}}',
                                                                            '{{$material->codigo_material}}',
                                                                            '{{$material->des_material}}',
                                                                            {{$material->cantidad}},
                                                                            '{{$material->uxe}}')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </a>
                            <a onclick="eliminar_material({{$material->id}})" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    clcass="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                </svg>
                            </a>
                        </td>
                        <td style=" text-align:center;">{{ $material->item }}</td>
                        <td style="font-size: 9px">{{ $material->product }}</td>
                        <td style=" text-align:center;">{{ $material->codigo_producto }}</td>
                        <td style=" text-align:center;">{{ $material->tipo_empaque }}</td>
                        <td style=" text-align:center;">{{ $material->codigo_material }}</td>
                        <td>{{ $material->des_material }}</td>
                        <td style=" text-align:center;">{{ $material->cantidad }}</td>
                        <td style=" text-align:center;">{{ $material->uxe }}</td>
                    </tr>
                    <?php $count++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
    </div>

    <div wire:ignore class="modal fade" id="material_actualizar" data-backdrop="static" data-keyboard="false"
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
                        <input type="text" hidden name="actu_id" id="actu_id">
                        <div class="mb-4 col">
                            <label for="txt_malos" class="form-label">Item</label>
                            <input class="form-control" name="actu_item" id="actu_item"
                                style=" height:30px;" value="">
                        </div>
                        <div class="mb-4 col">
                            <label for="txt_malos" class="form-label">Codigo Producto</label>
                            <input class="form-control" name="actu_codigo_producto" id="actu_codigo_producto"
                                style=" height:30px;">
                        </div>
                        <div  class="mb-4 col">
                            <label for="txt_malos" class="form-label">Codigo Material</label>
                            <input class="form-control" name="actu_codigo_material" id="actu_codigo_material"
                                style=" height:30px;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-4 col">
                            <label for="txt_figuraytipo" class="form-label">Tipo Empaque</label>
                            <select class="tipo_emapque_buscador" name="actu_tipo_empaque" id="actu_tipo_empaque" style="height:30px;z-index: 999;" required>
                                <option value="">Todos los tipo Empaque</option>
                                @foreach($empaques as $empa)
                                    <option value="{{ $empa->id_tipo_empaque }}">
                                        {{ $empa->tipo_empaque }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4 col">
                            <label for="txt_malos" class="form-label">Cantidad</label>
                            <input type="number" style=" height:30px; width: 100%;" name="actu_cantidad" id="actu_cantidad">
                        </div>
                        <div class="mb-4 col">
                            <label for="txt_malos" class="form-label">UxE</label>
                            <select class="tipo_uxe" name="actu_uxe" id="actu_uxe" style="height:30px;z-index: 999;" required>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-12 col">
                            <label for="txt_figuraytipo" class="form-label">Descripción</label>
                            <input name="actu_des_material" id="actu_des_material" style="font-size:16px" class="form-control" type="text"
                                autocomplete="off">
                        </div>
                    </div>
                    <br>
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
        <div wire:loading>
            <span class="spinner-border spinner-border-sm"  role="status" aria-hidden="true"></span>
        </div>
        <div wire:loading.attr="hidden">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
        </div>
    </button>
</a>



<div wire:ignore class="modal fade" id="material_nuevo" data-backdrop="static" data-keyboard="false"
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
                            <label for="txt_malos" class="form-label">Item</label>
                            <input class="form-control" name="new_item" id="new_item"
                                style=" height:30px;" value="">
                        </div>
                        <div class="mb-4 col">
                            <label for="txt_malos" class="form-label">Codigo Producto</label>
                            <input class="form-control" name="new_codigo_producto" id="new_codigo_producto"
                                style=" height:30px;">
                        </div>
                        <div  class="mb-4 col">
                            <label for="txt_malos" class="form-label">Codigo Material</label>
                            <input class="form-control" name="new_codigo_material" id="new_codigo_material"
                                style=" height:30px;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-4 col">
                            <label for="txt_figuraytipo" class="form-label">Tipo Empaque</label>
                            <select class="tipo_emapque_buscador" name="new_tipo_empaque" id="new_tipo_empaque" style="height:30px;z-index: 999;" required>
                                <option value="">Todos los tipo Empaque</option>
                                @foreach($empaques as $empa)
                                    <option value="{{ $empa->id_tipo_empaque }}">
                                        {{ $empa->tipo_empaque }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4 col">
                            <label for="txt_malos" class="form-label">Cantidad</label>
                            <input type="number" style=" height:30px; width: 100%;" name="new_cantidad" id="new_cantidad">
                        </div>
                        <div class="mb-4 col">
                            <label for="txt_malos" class="form-label">UxE</label>
                            <select class="tipo_uxe" name="new_uxe" id="new_uxe" style="height:30px;z-index: 999;" required>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-12 col">
                            <label for="txt_figuraytipo" class="form-label">Descripción</label>
                            <input name="new_des_material" id="new_des_material" style="font-size:16px" class="form-control" type="text"
                                autocomplete="off">
                        </div>
                    </div>
                    <br>
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
        var control2;
        var control3;
        var control4;
        window.addEventListener('tamanio_tabla', event => {
            $('#tabla_materiales').css('height', ($('#bos').height() - 160));
        });


        $(document).ready(function() {
            $('#tabla_materiales').css('height', ($('#bos').height() - 160));
            var seletscc = ["todas_fitem","todas_cp","todas_te","todas_cm","todas_Des"];
            seletscc.forEach(element => {
                selects(element);
            });

            control =  new TomSelect("#new_tipo_empaque", {
                create: false,
                plugins: ['change_listener'],
                sortField: {
                    field: "text"
                    , direction: "asc"
                }
            });

            control2 =  new TomSelect("#actu_tipo_empaque", {
                create: false,
                plugins: ['change_listener'],
                sortField: {
                    field: "text"
                    , direction: "asc"
                }
            });

            control3 =  new TomSelect("#new_uxe", {
                create: false,
                plugins: ['change_listener'],
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });

            control4 =  new TomSelect("#actu_uxe", {
                create: false,
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
            @this.item = $('#todas_fitem').val();
            @this.codigo_producto = $('#todas_cp').val();
            @this.tipo_empaque = $('#todas_te').val();
            @this.codigo_material = $('#todas_cm').val();
            @this.des_material = $('#todas_Des').val();
            @this.paginacion = 0;
        }

        function eliminar_material(id){
            Swal.fire({
                title: 'Esta seguro?',
                text: "No se puede revertir este cambio!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.eliminar_ficha(id);
                }
            })
        }

        window.addEventListener('eliminacion_exitoso', event => {
            Swal.fire('Eliminado con exito!', '', 'success');

            $('#tabla_materiales').css('height', ($('#bos').height() - 180));
        })



        async function insertar_material() {

            if ($('#new_item').val() == "" || $('#new_codigo_producto').val() == "" ||
                $('#new_tipo_empaque').val() == "" ||
                $('#new_codigo_material').val() == "" || $('#new_des_material').val() == "" ||
                $('#new_cantidad').val() == "" || $('#new_uxe').val() == "") {
                toastr.info('Hay compos requeridos vacios.', 'Advertencia!');
            } else {

            await @this.nuevo_material({
                        'item': $('#new_item').val(),
                        'codigo_producto': $('#new_codigo_producto').val(),
                        'tipo_empaque': $('#new_tipo_empaque').val(),
                        'codigo_material': $('#new_codigo_material').val(),
                        'des_material': $('#new_des_material').val(),
                        'cantidad': $('#new_cantidad').val(),
                        'uxe': $('#new_uxe').val()
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
            , actu_item
            , actu_codigo_producto
            , actu_tipo_empaque
            , actu_codigo_material
            , actu_des_material
            , actu_cantidad
            , actu_uxe) {


            $('#actu_id').val(id);
            $('#actu_item').val(actu_item);
            $('#actu_codigo_producto').val(actu_codigo_producto);
            control2.setValue(actu_tipo_empaque);
            $('#actu_codigo_material').val(actu_codigo_material);
            $('#actu_des_material').val(actu_des_material);
            $('#actu_cantidad').val(actu_cantidad);
            control3.setValue(actu_uxe);


        }


        async function actulizar_material() {


            if ($('#actu_item').val() == "" || $('#actu_codigo_producto').val() == "" ||
                $('#actu_tipo_empaque').val() == "" ||
                $('#actu_codigo_material').val() == "" || $('#actu_des_material').val() == "" ||
                $('#actu_cantidad').val() == "" || $('#actu_uxe').val() == "") {
                toastr.info('Hay compos requeridos vacios.', 'Advertencia!');
            } else {

            await @this.actualizar_material({
                        'item': $('#actu_item').val(),
                        'codigo_producto': $('#actu_codigo_producto').val(),
                        'tipo_empaque': $('#actu_tipo_empaque').val(),
                        'codigo_material': $('#actu_codigo_material').val(),
                        'des_material': $('#actu_des_material').val(),
                        'cantidad': $('#actu_cantidad').val(),
                        'uxe': $('#actu_uxe').val(),
                        'id': $('#actu_id').val()
                });
            }

        }

        window.addEventListener('actualiza_exitoso', event => {
            Swal.fire('Actualizado con exito!', '', 'success');

            $('#material_actualizar').modal('hide');
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
