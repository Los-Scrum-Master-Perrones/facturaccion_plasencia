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
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}"/>




    </br>
       <ul class="nav justify-content-center">
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="pendiente-empaque"><strong>Pendiente</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="import_excel"><strong>Importar pedido</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="inventario_cajas"><strong>Reporte</strong></a>
        </li>
    </ul>
    </br>



    <div class="container" style="width:1400px; padding-left:30px">
        <div class="row">
            <div class="col-10">
                <form action="{{Route('buscar_pendiente')}}" method="POST" class="form-inline"
                    style="margin-bottom:0px;" style="width:1100px;">
                    @csrf
                    <div class="row">
                        <div class="col-sm">
                            <label>De</label>
                        </div>
                        <div class="col-sm">
                            <input type="date" name="fecha_de" id="fecha_de" class="form-control mr-sm-2 botonprincipal"
                                style="width:200px;" placeholder="Nombre">
                        </div>
                        <div class="col-sm">
                            <label>Hasta</label>
                        </div>
                        <div class="col-sm">
                            <input type="date" name="fecha_hasta" id="fecha_hasta"
                                class="form-control mr-sm-2 botonprincipal" style="width:200px;" placeholder="Nombre">
                        </div>
                        <div class="col-sm">
                            <input name="nombre" id="nombre" class="form-control mr-sm-2 botonprincipal"
                                style="width:200px;" placeholder="Nombre">
                        </div>
                        <div class="col-sm">
                            <button class="form-control mr-sm-2 botonprincipal" type="submit" style="width:60px;">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </span>
                            </button>
                        </div>

                    </div>
                </form>
            </div>
            <div class="col">
                <form action="{{Route('exportar_pendiente')}}">
                    <input type="text" value= "{{isset($nom)?$nom:null}}" name="nombre" id="nombre" hidden >
                    <input type="date" value= "{{isset($fede)?$fede:null}}" name="fecha_de" id="fecha_de" hidden>
                    <input type="date" value= "{{isset($feha)?$feha:null}}" name="fecha_hasta" id="fecha_hasta" hidden>
                    <button class="form-control mr-sm-2 botonprincipal" type="submit" style="width:120px;">Exportar
                    </button>
                </form>
            </div>
        </div>


    </div>

    <div class="panel-body">
        <div class="table-responsive">
            @csrf
            <table class="table table-light" id="editable" style="font-size:10px;">
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
                        <th>PENDIENTE</th>
                        <th>MARZO 2021 FACTURA #17976(Warehouse)</th>
                        <th>ENVIADO MES</th>
                        <th>SALDO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datos_pendiente_empaque as $datos)
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
                        <td>{{$datos->pendiente}}</td>
                        <td>{{$datos->factura_del_mes}}</td>
                        <td>{{$datos->cantidad_enviada_mes}}</td>
                        <td>{{$datos->saldo}}</td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
