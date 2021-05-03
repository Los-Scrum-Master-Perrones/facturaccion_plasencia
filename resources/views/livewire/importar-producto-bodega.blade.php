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
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}" />


    </br>

    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="pendiente_empaque"><strong>Pendiente</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="importar_c"><strong>Existencia en bodega</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="inventario_cajas"><strong>Existencia de cajas</strong></a>
        </li>
    </ul>
    </br>









    <div class="" style="width:1150px; padding-left:100px;">
        <div class="row">

            <div class="col-sm">
                <form wire:submit.prevent="import">
                    @csrf
                    <div class="row">
                        <div class="col-sm">
                            <input type="file" name="select_file" id="select_file" wire:model="select_file" 
                                class="btn botonprincipal form-control" style="width:350px;" />
                        </div>
                        <div class="col-sm">
                            <input type="submit" name="upload" style="width:130px;"
                                class="btn botonprincipal form-control" value="Importar">

                        </div>
                    </div>
                </form>
            </div>

           


        </div>
    </div>


    </br>






    <div class="" style="width:1100px; padding-left:100px;">

        <div class="row">

            <div class="col-sm">
                <form action="{{Route('buscar_pedido')}}" method="POST" class="form-inline" style="margin-bottom:0px;">
                    @csrf
                    <div class="row">

                        <div class="col-sm">
                            <input name="busqueda" id="busqueda" class="btn botonprincipal form-control"
                                placeholder="Búsqueda por descripción u orden" style="width:350px;">
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
                        <th style=" text-align:center;">Código sistema</th>
                        <th style=" text-align:center;">Marca</th>
                        <th style=" text-align:center;">Alias vitola</th>
                        <th style=" text-align:center;">Vitola</th>
                        <th style=" text-align:center;">Capa</th>
                        <th style=" text-align:center;">Ubicación</th>
                        <th style=" text-align:center;">Existencia</th>
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
