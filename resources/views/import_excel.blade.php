<!DOCTYPE html>
<html>

@extends('principal')
@section('content')



<head>
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



</head>

<body style=" background-size:100% 100%;">

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









    <div class="container" style="width:1100px; padding-left:30px;">
        <div class="row">

            <div class="col-sm">
                <form method="post" enctype="multipart/form-data" action="{{ url('/producto') }}">
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
                            <h5 style="width: 130px;0px; color: #ffffff;"><strong>Fecha de pedido</strong></h5>
                        </div>
                        <div class="col-sm">
                            <input type="date" value="" name="fecha" id="fecha" style="width: 170px;"
                                class="btn botonprincipal form-control" required>
                        </div>
                        <div class="col-sm">
                            <button type="submit" style="width:150px;" class="btn botonprincipal form-control">Agregar a
                                pendiente</button>
                        </div>



                        @csrf

                    </div>
                </form>

            </div>


            </div>
            </div>








    <div class="container">
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">

                <form action="{{Route('buscar')}}" method="POST" class="form-inline" style="margin-bottom:0px;">
                    @csrf
                    <input name="txt_name" class="form-control mr-sm-2" placeholder="Nombre" style="width:150px;">
                    <button class="btn-dark form-control mr-sm-2" type="submit">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </span>
                    </button>
                </form>
            </div>







            <div class="panel-body">
                <div class="table-responsive">
                    @csrf
                    <table id="editable" class="table table-striped table-secondary table-bordered border-primary ">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Paquetes</th>
                                <th>Descripción</th>
                                <th>Total</th>
                                <th>Unidades</th>
                                <th>#Orden</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedido_completo as $pedido)
                            <tr>
                                <td>{{$pedido->item}}</td>
                                <td>{{$pedido->cant_paquetes}}</td>
                                <td>{{$pedido->desccripcion}}</td>
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
</body>

</html>
