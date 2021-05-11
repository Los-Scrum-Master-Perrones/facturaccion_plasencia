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

    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}" />

    <br>

    <div class="container" style="width:auto; align-content: center">
        <div class="row">
            <div class="form-group col-sm-12">
                <h1 wire:model="titulo_cliente">{{$titulo_factura." ".$titulo_cliente." ". $contenedor." ".$titulo_mes}}</h1>
            </div>
        </div>
    <div class="row">
            <div class="form-group col-sm-12">
                <label><h3>Factura N#: {{$num_factura_sistema}}</h3></label>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label>Cliente</label>
                <input type="text" class="form-control" wire:model="cliente"
                    placeholder="Rocky,  Hatsa">
            </div>
            <div class="form-group col-sm-3">
                <label>Fecha</label>
                <input type="date" class="form-control" wire:model="fecha_factura" >
            </div>
            <div class="form-group col-sm-3">
                <label>Contenedor</label>
                <input type="text" class="form-control" wire:model="contenedor"
                    placeholder="Primer Contenedor">
            </div>

        </div>
        <div class="row">
            <div class="form-group col-sm-3">
                <label for="exampleInputEmail1">Total Bultos</label>
                <input type="number" class="form-control" placeholder="0" wire:model="total_cantidad_bultos" readonly>
            </div>
            <div class="form-group col-sm-3">
                <label for="exampleInputEmail1">Total Puros</label>
                <input type="number" class="form-control" placeholder="0" wire:model="total_total_puros" readonly>
            </div>
            <div class="form-group col-sm-3">
                <label for="exampleInputEmail1">Peso Bruto Total</label>
                <input type="number" class="form-control" placeholder="0.00" wire:model="total_peso_bruto" readonly>
            </div>
            <div class="form-group col-sm-3">
                <label for="exampleInputEmail1">Peso Neto Total</label>
                <input type="number" class="form-control" placeholder="0.00" wire:model="total_peso_neto" readonly>
            </div>

        </div>
    </div>

    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-light" id="editable">
                <thead style=" position: static;">
                    <tr style="font-size:12px; text-align:center;">
                        <th style="text-align:center;">Bulto<br>Package<br>No.
                        </th>
                        <th style="text-align:center;">Cant.<br>Quant.
                        </th>
                        <th style="text-align:center;">Unidad<br>Unit.
                        </th>
                        <th style="text-align:center;">Total<br>Tabacos<br>Cigars
                        </th>
                        <th style="text-align:center;">Capa<br>Wrappar
                        </th>
                        <th style="text-align:center;">Clase<br>Class
                        </th>
                        <th style="text-align:center;">CODIGO #<br>ITEM #
                        </th>
                        <th style="text-align:center;">YOUR<br>ORDER #
                        </th>
                        <th style="text-align:center;">ORDER<br>AMOUNT
                        </th>
                        <th style="text-align:center;">BACK<br>ORDER<br>AMOUNT
                        </th>
                        <th style="text-align:center;">Bruto<br>Gross
                        </th>
                        <th style="text-align:center;">Neto<br>Net
                        </th>
                        <th style="text-align:center;">Precio FOB<br>Fob Price<br>per 1000
                        </th>
                        <th style="text-align:center;">Valor<br>Value
                        </th>
                    </tr>
                </thead>
                <tbody>
                   {{-- @foreach($detalles_venta as $detalle)
                        <tr>
                            <td>{{$detalle->item}}</td>
                    <td>{{$detalle->marca}}</td>
                    <td>{{$detalle->nombre}}</td>
                    <td>{{$detalle->vitola}}</td>--}}

                    {{-- </tr>
                        @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>