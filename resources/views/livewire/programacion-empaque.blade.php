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
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}"/>

    </br>
    <ul class="nav justify-content-center">
    <li class="nav-item">
            <a style="color:black; font-size:16px;" href="pendiente_empaque"><strong>Pendiente</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="importar_c"><strong>Existencia en bodega</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="{{ route('inventario_cajas') }}"><strong>Existencia de cajas</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="historial_programacion"><strong>Programaciones</strong></a>
        </li>
    </ul>
    </br>
    <h3 style="	text-align:center;  width:auto;"><strong>Inventario de productos Plasencia</strong></h3>
    <br />

    <div class="" style="width:1100px; padding-left:200px;">

        <div class="row">

            <div class="col-sm">


                <div class="row">
                    <div class="col-sm">
                        <input name="buscar" id="buscar" class="btn botonprincipal form-control" wire:model="busqueda"
                            placeholder="Búsqueda por Marca, Nombre y Vitola" style="width:350px;">
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-sm">
                    <button class="btn botonprincipal form-control" data-toggle="modal"
                        data-target="#modal_nuevoproducto" style="width:200px;">Nuevo
                        producto</button>
                </div>

                <div class="col-sm">

                    <a class="btn botonprincipal form-control" href="{{Route('datos_producto')}}"
                        style="width:200px;">Datos adicionales</a>
                </div>
            </div>

        </div>
    </div>

    </br>


    <div style="width:1250px; padding-left:100px;">
        <div class="table-responsive">
            @csrf
            <table class="table table-light" id="editable" style="font-size:10px;m">
                <thead>
                    <tr style="font-size:16px; text-align:center;">
                    <th># ORDEN</th>
                                            <th  style=" text-align:center;">ORDEN</th>
                                            <th  style=" text-align:center;">MARCA</th>
                                            <th style=" text-align:center;">VITOLA</th>
                                            <th style=" text-align:center;">NOMBRE</th>
                                            <th style=" text-align:center;">CAPA</th>
                                            <th style=" text-align:center;">TIPO DE EMPAQUE</th>
                                            <th style=" text-align:center;">ANILLO</th>
                                            <th style=" text-align:center;">CELLO</th>
                                            <th style=" text-align:center;">UPC</th>
                                            <th style=" text-align:center;">SALDO</th>


                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>






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
                        [1, 'Marca'],
                        [2, 'Nombre'],
                        [3, 'Vitola'],
                        [4, 'Orden'],
                        [5, 'Tipo de empaque']
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
