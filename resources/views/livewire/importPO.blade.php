<div xmlns:wire="http://www.w3.org/1999/xhtml">

    <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item">
            <a class="nav-link fs-7" style="font-size:12px;" href="pendiente"><strong>Pendiente</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link fs-7" style="font-size:12px;" href="import_excel"><strong>Importar Pedido</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link fs-7 active" style="font-size:12px;" href="poimport"><strong>Importar PO</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link fs-7" style="font-size:12px;" href="pendiente_salida"><strong>Reporte</strong></a>
        </li>
    </ul>

    <br>

    <div class="container" style="max-width:100%;">
        <div class="row" style="text-align:center; padding-left: 15px">
            <div class="col">
                <form method="post" enctype="multipart/form-data" action="{{ url('/poimport/import') }}" class="form-inline" >
                    @csrf
                    <div class="btn-group">
                        <input type="file" name="select_file" id="select_file" class="form-control" style="width:500px;" required />
                        <input type="submit" name="upload" class="btn btn-success" value="Importar">
                        <button data-bs-toggle="modal" data-bs-target="#modal_eliminar_detalle" class="btn btn-warning">Limpiar</button>
                        <button wire:click='pasarPedido()' type="button" class="btn btn-info">Pasar a Pendiente</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <input class="form-control mr-sm-2" placeholder="Búsqueda por Item" wire:model="b_item">
                <input class="form-control mr-sm-2" placeholder="Búsqueda por Marca" wire:model="b_marca">
                <input class="form-control mr-sm-2" placeholder="Búsqueda por Nombre" wire:model="b_nombre">
                <input class="form-control mr-sm-2" placeholder="Búsqueda por Vitola" wire:model="b_vitola">
                <input class="form-control mr-sm-2" placeholder="Búsqueda por Capa" wire:model="b_capa">
                <input class="form-control mr-sm-2" placeholder="Búsqueda por Tipo Empaque" wire:model="b_tipo_empaque">
                <input class="form-control mr-sm-2" placeholder="Búsqueda por Orden" wire:model="b_orden">
            </div>
        </div>

        <div class="panel-body" style="padding:0px;">
            <div style="width:100%; padding-left:0px; font-size:10px; overflow-x: display; overflow-y: auto; height:70%;">
                <table class="table table-light table-hover" style="font-size:10px; ">
                    <thead>
                        <tr style="font-size:16px; text-align:center;">
                            <th style="text-align:center;">N#</th>
                            <th style="text-align:center;">RP Item#</th>
                            <th style="text-align:center;">Codigo P.</th>
                            <th style="text-align:center;">Marca</th>
                            <th style="text-align:center;">Nombre</th>
                            <th style="text-align:center;">Vitola</th>
                            <th style="text-align:center;">Capa</th>
                            <th style="text-align:center;">Tipo de Empaque</th>
                            <th style="text-align:center;">Paquetes</th>
                            <th style="text-align:center;">Unidades</th>
                            <th style="text-align:center;">Total</th>
                            <th style="text-align:center;">PO#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                            $totall = 0;
                        @endphp

                        @foreach ($Po as $pedido)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $pedido->item }}</td>
                                <td>{{ $pedido->codigo_producto }}</td>
                                @php
                                    if ($pedido->sampler == 'si') {
                                        $todo = DB::select(
                                            'SELECT item,
                                                    tipo_empaques.tipo_empaque as descripcioncoc,
                                                    tipo_empaques.por_caja from clase_productos
                                            inner join tipo_empaques on tipo_empaques.id_tipo_empaque = clase_productos.id_tipo_empaque
                                            where item = ?', [$pedido->item],
                                        );
                                    } else {
                                        $todo = DB::select(
                                            "SELECT item,
                                                    vitola_productos.vitola,
                                                    marca_productos.marca,
                                                    nombre_productos.nombre,
                                                    capa_productos.capa,
                                                    tipo_empaques.tipo_empaque,
                                                    tipo_empaques.por_caja
                                            from clase_productos
                                                inner join marca_productos on marca_productos.id_marca = clase_productos.id_marca
                                                inner join tipo_empaques on tipo_empaques.id_tipo_empaque = clase_productos.id_tipo_empaque
                                                inner join capa_productos on capa_productos.id_capa = clase_productos.id_capa
                                                inner join vitola_productos on vitola_productos.id_vitola = clase_productos.id_vitola
                                                inner join nombre_productos on nombre_productos.id_nombre = clase_productos.id_nombre
                                            where item = ?", [$pedido->item],
                                        );
                                    }
                                @endphp
                                @if ($todo != null)
                                    @if ($pedido->sampler == 'si')
                                        <td colspan="4">{{ $pedido->descripcion }}</td>
                                        <td>{{ $todo[0]->descripcioncoc }}</td>
                                    @else
                                        <td>{{ $todo[0]->marca }}</td>
                                        <td>{{ $todo[0]->nombre }}</td>
                                        <td>{{ $todo[0]->vitola }}</td>
                                        <td>{{ $todo[0]->capa }}</td>
                                        <td>{{ $todo[0]->tipo_empaque }}</td>
                                    @endif
                                    <td>{{ $pedido->cantidad }}</td>
                                    <td>{{ $todo[0]->por_caja }}</td>
                                    <td>{{ $pedido->cantidad * $todo[0]->por_caja }}</td>
                                    @php
                                        $totall += $pedido->cantidad * $todo[0]->por_caja;
                                    @endphp
                                @else
                                    <td>{{ $pedido->descripcion }}</td>
                                    <td>{{ $pedido->cantidad }}</td>
                                    <td>0</td>
                                    <td>0</td>
                                @endif
                                <td>{{ $pedido->hon }}</td>

                            </tr>
                            <?php $count++; ?>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="input-group" style="width:30%; position: fixed;right: 0px;bottom:0px; height:30px;">
            <span class="form-control input-group-text fs-7">Total</span>
            <input type="text" class="form-control fs-7" id="sumap" value="{{ number_format($totall, 0) }}">
        </div>

        <form wire:submit.prevent="deletePO()">
            <div wire:ignore class="modal fade" id="modal_eliminar_detalle" data-backdrop="static" data-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
                style="opacity:.9;background:#212529;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Eliminar </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Seleccione el HON a eliminar
                            <br>
                            <br>
                            <input class="col-md-3" wire:model="hondelete" name="hon" id="HON" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                <span>Cancelar</span>
                            </button>
                            <button type="submit" class="btn btn-success">
                                <span>Eliminar</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <script>
            window.addEventListener('exito', event => {
                toastr.success('Operacion con exito.', 'Completado!');
                $(".modal-backdrop").remove();
                $("#modal_eliminar_detalle").modal('hide');
            })
        </script>

    </div>

</div>
