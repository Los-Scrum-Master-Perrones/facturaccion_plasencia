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
                    <span class="input-group-text form-control ">Fecha</span>
                    <input type="date" name="fecha_de" id="fecha_de" class="form-control botonprincipal"
                        style="width:200px;" placeholder="Nombre" wire:model="fede">


                    <input name="nombre" id="nombre" class="form-control mr-sm-2 botonprincipal" style="width:200px;"
                        placeholder="Nombre" wire:model="nom">

                    <form wire:submit.prevent="exportPendiente()">
                        <input type="text"  name="nombre" id="nombre" hidden
                            wire:model="nom">
                        <input type="date" name="fecha_de" id="fecha_de" hidden
                            wire:model="fede">
                    </form>
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
                            <th>SALIDA</th>
                            <th>MES FACTURA</th>
                            <th>NUM. FACTURA</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
