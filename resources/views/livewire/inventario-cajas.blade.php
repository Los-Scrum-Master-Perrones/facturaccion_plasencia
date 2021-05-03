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
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}" />



    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="pendiente_empaque"><strong>Pendiente</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="importar_ca"><strong>Existencia en bodega</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="inventario_cajas"><strong>Existencia de cajas</strong></a>
        </li>
    </ul>
    </br>
<div class="container">

    <div class="row" style="width:100%;">
        <div class="col-md-8">
            <input name="nombre" class="form-control mr-sm-2 botonprincipal" style="width:100%;"
                placeholder="buscar tipo de caja (Código,Producto/Servicio,Marca)" wire:model="busqueda">
        </div>

    </div>

</div>
</br>
<div style="width:1250px; padding-left:100px;">
        <div class="table-responsive">
          
        <table class="table table-light" id="editable" style="font-size:10px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Producto/Servicio</th>
                    <th>Marca</th>
                </tr>
            </thead>
            <tbody>

                <?php $c = 0;?>
                @foreach($listacajas as $caja)

                <tr>
                    <td> <?php $c = $c + 1;  echo $c ?> </td>
                    <td>{{$caja->codigo}}</td>
                    <td>{{$caja->productoServicio}}</td>
                    <td>{{$caja->marca}}</td>

                </tr>
                @endforeach
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
                url: '{{ route("editaryeliminarlista") }}',
                method: 'POST',
                dataType: "json",
                columns: {
                    identifier: [0, 'id'],
                    editable: [
                        [1, 'codigo'],
                        [2, 'productoServicio'],
                        [3, 'marca']
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
