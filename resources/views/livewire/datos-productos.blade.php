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




    <br />

    <div style="width:1250px; padding-left:130px;">
        <div class="row">

            <div class="col-sm">
                <button class="btn botonprincipal form-control" data-toggle="modal" data-target="#modal_marca"
                    style="width:180px;">Agregar Marca</button>
            </div>
            <div class="col-sm">
                <button class="btn botonprincipal form-control" data-toggle="modal" data-target="#modal_capa"
                    style="width:180px;">Agregar Capa</button>
            </div>

            <div class="col-sm">
                <button class="btn botonprincipal form-control" data-toggle="modal" data-target="#modal_nombre"
                    style="width:180px;">Agregar Nombre</button>
            </div>

            <div class="col-sm">

                <button class="btn botonprincipal form-control" data-toggle="modal" data-target="#modal_tipo"
                    style="width:180px;">Agregar Tipo empaque</button>
            </div>
            <div class="col-sm">

                <button class="btn botonprincipal form-control" data-toggle="modal" data-target="#modal_vitola"
                    style="width:180px;">Agregar Vitola</button>
            </div>



        </div>
    </div>

    </br>


    <div class="" style="width:1250px; padding-left:130px;">

        <div class="row">

            <div class="col-sm">
                <input name="buscar" type="text" id="buscar" wire:model="busqueda"
                    class="btn botonprincipal form_control" placeholder="Búsqueda por item, nombre y capa"
                    style="width:350px;">
            </div>
            <div class="col-sm">
            </div>
        </div>

    </div>
    </br>
    <div style="width:1250px; padding-left:100px;">
        <div class="">
            <div class="row">
                <div class="col-sm" style="font-size:10px; overflow:scroll;
     height:450px;">
                    @csrf
                    <table class="table table-light" id="editable" style="font-size:10px;m">
                        <thead>
                            <tr style="font-size:16px; text-align:center;">
                                <th style=" text-align:center;">Código</th>
                                <th style=" text-align:center;">Marca</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($marcas as $marca)
                            <tr>
                                <td>{{$marca->id_marca}}</td>
                                <td>{{$marca->marca}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>

                <div class="col-sm" style="font-size:10px; overflow:scroll;
     height:450px;">
                    @csrf
                    <table class="table table-light" id="editable" style="font-size:10px; overflow:scroll;
     height:50px;">
                        <thead>
                            <tr style="font-size:16px; text-align:center;">
                                <th style=" text-align:center;">Código</th>
                                <th style=" text-align:center;">Capa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($capas as $capa)
                            <tr>
                                <td>{{$capa->id_capa}}</td>
                                <td>{{$capa->capa}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>

                <div class="col-sm" style="font-size:10px; overflow:scroll;
     height:450px;">
                    @csrf
                    <table class="table table-light" id="editable" style="font-size:10px;m">
                        <thead>
                            <tr style="font-size:16px; text-align:center;">
                                <th style=" text-align:center;">Código</th>
                                <th style=" text-align:center;">Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nombres as $nombre)
                            <tr>
                                <td>{{$nombre->id_nombre}}</td>
                                <td>{{$nombre->nombre}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>

                <div class="col-sm" style="font-size:10px; overflow:scroll;
     height:450px;">
                    @csrf
                    <table class="table table-light" id="editable" style="font-size:10px;m">
                        <thead>
                            <tr style="font-size:16px; text-align:center;">
                                <th style=" text-align:center;">Código</th>
                                <th style=" text-align:center;">Tipo empaque</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tipos as $tipo)
                            <tr>
                                <td>{{$tipo->id_tipo_empaque}}</td>
                                <td>{{$tipo->tipo_empaque}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>

                <div class="col-sm" style="font-size:10px; overflow:scroll;
     height:450px;">
                    @csrf
                    <table class="table table-light" id="editable" style="font-size:10px;m">
                        <thead>
                            <tr style="font-size:16px; text-align:center;">
                                <th style=" text-align:center;">Código</th>
                                <th style=" text-align:center;">Vitola</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vitolas as $vitola)
                            <tr>
                                <td>{{$vitola->id_vitola}}</td>
                                <td>{{$vitola->vitola}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>

            </div>
        </div>
    </div>





    <!-- INICIO MODAL MARCA -->
<form action="{{Route('insertar_marca')}}" method='POST' id="formmarca" name="formmarca">
    <div class="modal fade" id="modal_marca" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"
                        style="width:450px; text-align:center; font-size:20px;"><strong>Agregar marca</strong></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 col">
                        <label for="txt_vitola" class="form-label"
                            style="width:440px; text-align:center; font-size:20px;">Nueva marca</label>
                        <input class="form-control" id="marcam" type="text" name="marcam" placeholder="Agregar marca"
                            style="width: 440px" maxLength="30" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button style=" background: #b39f64; color: #ecedf1;" type="button" class=" btn-info-claro "
                        data-dismiss="modal">
                        <span>Cancelar</span>
                    </button>
                    <button onclick="validar_marca()"  type="submit"
                        class=" btn-info float-right" value="Guardar" style="margin-right: 10px">

                        <span>Guardar</span>
                    </button>
                    @csrf
                    <input name="id_planta" value='1' hidden />
                </div>
            </div>
        </div>
    </div>

</form>
    <!-- FIN MODAL MARCA -->



<!-- VALIDACION VENTANA MARCA -->


<script type="text/javascript">
    function validar_marca() {
        var marca_mo = document.getElementById('marcam').value;

        var marcas = '<?php echo json_encode($marcas);?>';

        var marca = JSON.parse(marcas);
        var mar = 0;
        var theForm = document.forms['formmarca'];


        for (var i = 0; i < marca.length; i++) {


            console.info(marca[i]);

            if (marca[i].marca === marca_mo) {
                mar++;
            }



        }

        if (marca_mo === "") {
            toastr.error('Llene el nombre de la vitola', 'ERROR', {
                "progressBar": true,
                "closeButton": false,
                "preventDuplicates": true,
                "preventOpenDuplicates": true
            });
            event.preventDefault();

        } else if (mar > 0) {
            toastr.error('Esta vitola ya existe, favor ingrese una nueva', 'ERROR', {
                "progressBar": true,
                "closeButton": false,
                "preventDuplicates": true,
                "preventOpenDuplicates": true
            });
            event.preventDefault();

        } else

            toastr.success('Tus datos se guardaron correctamente', 'BIEN', {
                "progressBar": true,
                "closeButton": false
            });
        theForm.addEventListener('submit', function (event) {});

    }
</script>

<!-- FIN VALIDAR MARCA -->

    <script src="{{ asset('js/app.js') }}"></script>
    @livewireScripts
</div>
