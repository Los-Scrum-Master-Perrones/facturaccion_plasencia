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
                        <td style=" text-align:center;">{{ $count }}</td>
                        <td>
                            <a data-toggle="modal" data-target="#material_actualizar" style="width:10px; height:10px;" href="#" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
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


    <div class="modal fade" id="material_actualizar" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="material_actualizar" aria-hidden="true" style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-lg">
            <!-- INICIO DEL MODAL NUEVO PRODUCTO -->
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="staticBackdropLabel"><strong>Agregar Material Producto</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </div>

                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-4 col">
                                <label for="txt_malos" class="form-label">Item</label>
                                <input class="form-control" name="factoryed" id="factoryed"
                                    style=" height:30px;">
                            </div>
                            <div class="mb-4 col">
                                <label for="txt_malos" class="form-label">Codigo Producto</label>
                                <input class="form-control" name="navisored" id="navisored"
                                    style=" height:30px;">
                            </div>
                            <div  class="mb-4 col">
                                <label for="txt_malos" class="form-label">Codigo Material</label>
                                <input class="form-control" name="navisored" id="navisored"
                                    style=" height:30px;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-4 col">
                                <label for="txt_figuraytipo" class="form-label">Tipo Empaque</label>
                                <input style=" height:30px; width: 100%;" name="branded" id="branded">
                            </div>
                            <div class="mb-4 col">
                                <label for="txt_malos" class="form-label">Cantidad</label>
                                <input style=" height:30px; width: 100%;" name="lineaed" id="lineaed">
                            </div>
                            <div class="mb-4 col">
                                <label for="txt_malos" class="form-label">UXE</label>
                                <input style=" height:30px; width: 100%;" name="lineaed" id="lineaed">
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
        <button type="button" class="btn btn-success" style="border-radius: 50%;width: 50px; height: 50px; text-align: center">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
        </button>
    </a>






    @push('scripts')
    <script>

        var control;
        window.addEventListener('tamanio_tabla', event => {
            $('#tabla_materiales').css('height', ($('#bos').height() - 160));
        });


        $(document).ready(function() {
            $('#tabla_materiales').css('height', ($('#bos').height() - 160));
            var seletscc = ["todas_fitem","todas_cp","todas_te","todas_cm","todas_Des"];
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
