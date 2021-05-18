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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">


    


    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a style="color:white;  font-size:12px;" href="pendiente_empaque"><strong>Pendiente</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white;  font-size:12px;" href="importar_c"><strong>Existencia en bodega</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:#E5B1E2; font-size:12px;" href="inventario_cajas"><strong>Existencia de cajas</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white; font-size:12px; " href="historial_programacion"><strong>Programaciones</strong></a>
        </li>
    </ul>


    <div class="container" style="max-width:100%; ">
    
    <div class="row" style="text-align:center;">

        <div class="col">

            <div class="input-group mb-3">
            <input name="nombre" class="form-control mr-sm-2 botonprincipal" style="width:100%;" placeholder="buscar tipo de caja (Código,Producto/Servicio,Marca)" wire:model="busqueda">
            </div>

</div>
</div>


<div class="panel-body" style="padding:0px;">
            <div style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;
     height:450px;">
          
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
