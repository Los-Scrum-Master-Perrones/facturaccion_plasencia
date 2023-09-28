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
    <script src="{{ URL::asset('css/tabla.js') }}"></script>



</head>

<body style=" background-size:100% 100%;">
</br>
</br>
<form action="{{Route('programacion')}}" method="POST">
<button style="width:20%;  padding-left:20px;" class="btn-dark form-control mr-sm-2" type="submit">Crear programación</button>
</form>

    <br />
<div class="" style="padding-left:20px; padding-right:20px;">
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
<table id="editable" class="table table-striped table-secondary table-bordered border-primary " style="overflow-x:auto;">
                            <thead>
                                <tr>
                                    <th>SO # ORDEN</th>
                                    <th>ORDEN</th>
                                    <th>MARCA</th>
                                    <th>NOMBRE</th>
                                    <th>VITOLA</th>
                                    <th>CAPA</th>
                                    <th>TIPO DE EMPAQUE</th>
                                    <th>ANILLO</th>
                                    <th>CELLO</th>
                                    <th>UPC</th>
                                    <th>SALDO</th>
                                </tr>
                            </thead>
                            <tbody>


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


</body>
@endsection
</html>

