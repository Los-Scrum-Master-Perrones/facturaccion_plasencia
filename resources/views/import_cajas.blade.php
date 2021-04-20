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
</head>

<body style=" background-size:100% 100%;">

<ul class="nav justify-content-center">
  <li class="nav-item">
    <a style="color:black;"  href="#">Lista</a>
  </li>
  <li class="nav-item">
    <a style="color:black;"  href="#">Inventario</a>
  </li>
  <li class="nav-item">
    <a href="index_cajas">Importar</a>
  </li>
</ul>

    <div class="container">
      


            
       

            <form method="post" enctype="multipart/form-data" action="{{ url('/importar_cajas') }}" >
                @csrf        
                <div class="row" style="width:100%;">
                <div class="col-md-8" >
                <input type="file" name="select_file" id="select_file" class="btn btn-primary form-control" style="width:100%;" />        
          
                </div>
                <div class="col-md-2">
                <input type="submit" name="upload" class="btn btn-primary form-control" style="width:100%;"  value="Importar">
                </div>
                <div class="col-md-2">
                <input type="submit" name="upload" class="btn btn-primary form-control" style="width:100%;"  value="Añadir a inventario">
                </div>
          </div>
          </form>
  
















        

            <br />
                   
                        <table class="table table-light"
                        style="font-size:10px;">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Descripción</th>
                                    <th>Lote origen</th>
                                    <th>Lote Destino</th>
                                    <th>Cantidad</th>
                                    <th>Costo Unitario</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
@foreach($cajas as $caja)

<tr>
        <td>{{$caja->codigo}}</td>
        <td>{{$caja->descripcion}}</td>
        <td>{{$caja->lote_origen}}</td>
        <td>{{$caja->lote_destino}}</td>
        <td>{{$caja->cantidad}}</td>
        <td>{{$caja->costo_u}}</td>
        <td>{{$caja->subtotal}}</td>
        </tr>
@endforeach
                            </tbody>
                        </table>
              
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
