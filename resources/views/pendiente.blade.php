
@extends('principal')


@section('content')

<!DOCTYPE html>
<html>

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
    <script src="{{ URL::asset('css/tabla.js') }}"></script>



</head>

<body style=" background-size:100% 100%;">

    <br />
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
                                    <th>CATEGORIA</th>
                                    <th>ITEM</th>
                                    <th>ORDEN DEL SISTEMA</th>
                                    <th>OBSERVACÓN</th>
                                    <th>PRESENTACIÓN</th>
                                    <th>MES</th>
                                    <th>ORDEN</th>
                                    <th>MARCA</th>
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

                            @foreach($datos_pendiente as $datos)
<tr>
<td>{{$datos->categoria}}</td>
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

        @endsection
</body>

</html>
