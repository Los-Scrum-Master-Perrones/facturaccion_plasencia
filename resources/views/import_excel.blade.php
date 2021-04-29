
@extends('principal')


@section('content')

    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hola</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/principal.css') }}" />



    </br>
    <ul class="nav justify-content-center">

        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="productos"><strong>Productos</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="pendiente"><strong>Pendiente</strong></a>
        </li>

    </ul>
    </br>









    <div class="" style="width:1150px; padding-left:100px;">
        <div class="row">

            <div class="col-sm">
                <form method="post" enctype="multipart/form-data" action="{{ url('/importar_pedido') }}">
                    @csrf
                        <div class="row">
                            <div class="col-sm">
                                <input type="file" name="select_file" id="select_file"
                                    class="btn botonprincipal form-control" style="width:350px;" />
                            </div>
                            <div class="col-sm">
                                <input type="submit" name="upload" style="width:130px;"
                                    class="btn botonprincipal form-control" value="Importar">

                            </div>
                            </div>
                </form>
                            </div>

                            <div class="col-sm">

                                <form action="{{Route('pendiente')}}" method="POST">
                                    <div class="row">
                                        <div class="col-sm">
                                            <a style="width: 130px;0px; color: #ffffff; font-size:16px; text-align:center"><strong>Fecha de
                                                    pedido</strong></a>
                                        </div>
                                        <div class="col-sm">
                                            <input type="date" value="" name="fecha" id="fecha" style="width: 160px;"
                                                class="btn botonprincipal form-control" required>
                                        </div>
                                        <div class="col-sm">
                                            <button type="submit" style="width:160px;"
                                                class="btn botonprincipal form-control">Agregar a
                                                pendiente</button>
                                        </div>



                                        @csrf

                                    </div>
                                </form>

                            </div>


                            </div>
                            </div>


                            </br>






                            <div class="" style="width:1100px; padding-left:100px;">

                                <div class="row">

                                    <div class="col-sm">
                                        <form action="{{Route('buscar_pedido')}}" method="POST" class="form-inline"
                                            style="margin-bottom:0px;">
                                            @csrf
                                            <div class="row">

                                                <div class="col-sm">
                                                    <input name="busqueda" id="busqueda" class="btn botonprincipal form-control"
                                                        placeholder="Búsqueda por descripción u orden" style="width:350px;">
                                                </div>
                                                <div class="col-sm">
                                                    <button class="btn botonprincipal form-control" type="submit">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="50"
                                                                height="20" fill="currentColor" class="bi bi-search"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                                            </svg>
                                                        </span>
                                                    </button>
                                                </div>
                                        </form>
                                    </div>

                                </div>

                            </div>

                            </br>
                            <div style="width:1150px; padding-left:0px;">
                                <div class="table-responsive">
                    @csrf
                    <table class="table table-light" id="editable" style="font-size:10px; ">
                        <thead>
                            <tr style="font-size:16px; text-align:center;">
                                <th  style=" text-align:center;">Item</th>
                                <th  style=" text-align:center;">Paquetes</th>
                                <th style=" text-align:center;">Descripción</th>
                                <th style=" text-align:center;">Total</th>
                                <th style=" text-align:center;">Unidades</th>
                                <th style=" text-align:center;">#Orden</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedido_completo as $pedido)
                            <tr>
                                <td>{{$pedido->item}}</td>
                                <td>{{$pedido->cant_paquetes}}</td>
                                <td>{{$pedido->descripcion}}</td>
                                <td>{{$pedido->unidades*$pedido->cant_paquetes}}</td>
                                <td>{{$pedido->unidades}}</td>
                                <td>{{$pedido->numero_orden}}</td>

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

   
@endsection

