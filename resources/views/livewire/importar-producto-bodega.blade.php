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
            <a style="color:white;font-size:12px;" href="pendiente_empaque"><strong>Pendiente</strong></a>
        </li>
        <li class="nav-item">
            <a  style="color:#E5B1E2; font-size:12px;" href="importar_c"><strong>Existencia en bodega</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="inventario_cajas"><strong>Existencia de cajas</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="historial_programacion"><strong>Programaciones</strong></a>
        </li>
    </ul>


    <div class="container" style="max-width:100%; ">
    
            <div class="row" style="text-align:center;">

                <div class="col">

                    <div class="input-group mb-3">
                    <form wire:submit.prevent="import">
                    @csrf
                    <input type="file" name="select_file" id="select_file" wire:model="select_file" class=" botonprincipal form-control mr-sm-2" style="width:450px;" />
                    <input type="submit" name="upload" style="width:130px;" class="botonprincipal mr-sm-2 " value="Importar">
                    </form>

                    <form wire:submit.prevent="vaciar" >
                    @csrf 
                    <input type="submit" style="width:130px;" class=" botonprincipal mr-sm-2 "  value="Vaciar tabla">
                    </form>

                    <input name="busqueda" id="busqueda"  wire:model= "busqueda" class="botonprincipal  form-control"    placeholder="Búsqueda por Marca, Nombre y Capa" >
                    </div>

                </div>
            </div>
               
     

 
            <div class="panel-body" style="padding:0px;">
            <div style="width:100%; padding-left:0px;    overflow-x: display; overflow-y: auto;
     height:450px;">
            @csrf
            <table class="table table-light">
                <thead>
                    <tr>
                        <th>Código sistema</th>
                        <th >Marca</th>
                        <th >Alias vitola</th>
                        <th >Vitola</th>
                        <th >Capa</th>
                        <th >Ubicación</th>
                        <th >Existencia</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($existencias as $existencia)
                    <tr>
                        <td>{{$existencia->codigo_producto}}</td>
                        <td>{{$existencia->marca}}</td>
                        <td>{{$existencia->nombre}}</td>
                        <td>{{$existencia->vitola}}</td>
                        <td>{{$existencia->capa}}</td>
                        <td>{{$existencia->ubicacion}}</td>
                        <td>{{$existencia->total}}</td>
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
