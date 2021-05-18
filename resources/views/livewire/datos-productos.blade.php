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




<div class="container" style="max-width:100%; ">
    
    <div class="row" style="text-align:center;">

            <div class="col">
                   <div class="input-group mb-3">

                <button class="mr-sm-2 botonprincipal " data-toggle="modal" data-target="#modal_marca"style="width:150px;">Agregar Marca</button>
         
                <button class="mr-sm-2 botonprincipal " data-toggle="modal" data-target="#modal_capa" style="width:150px;">Agregar Capa</button>
      
                <button class=" mr-sm-2 botonprincipal " data-toggle="modal" data-target="#modal_nombre"  style="width:150px;">Agregar Nombre</button>

                <button class="mr-sm-2 botonprincipal " data-toggle="modal" data-target="#modal_tipo" style="width:150px;">Agregar Tipo empaque</button>
      
                <button class="mr-sm-2 botonprincipal " data-toggle="modal" data-target="#modal_vitola" style="width:150px;">Agregar Vitola</button>
       
                    <input name="buscar" type="text" id="buscar" wire:model="busqueda"  class="btn botonprincipal form_control" placeholder="Búsqueda por item, nombre y capa" style="width:350px;">
         

                <form wire:submit.prevent="importar_excel"  hidden>
                    <div class="col-sm">
                        <input type="file" wire:model="select_file" id="select_file" class="btn botonprincipal form-control"
                            style="width:350px;" />

                    </div>
                    <div class="col-sm">
                        <button type="submit" name="upload" style="width:130px;" class="btn botonprincipal form-control"
                            value="Importar">
                    </div>
                </form>

        </div> 
         </div>
    </div>



  






    <div style="width:100%;">
        <div class="">
            <div class="row">
                <div class="col-sm" style="font-size:10px; overflow:scroll;height:500px;">
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
     height:500px;">
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
     height:500px;">
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
     height:500px;">
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
     height:500px;">
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
                        <h5 class="modal-title" id="staticBackdropLabel"><strong>Agregar marca</strong></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 col">
                            <label for="txt_vitola" class="form-label">Nueva marca</label>
                            <input class="form-control" id="marcam" type="text" name="marcam"
                                placeholder="Agregar marca" style="width: 440px" maxLength="30" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class=" bmodal_no "  data-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button onclick="validar_marca()" type="submit" class=" bmodal_yes " value="Guardar">
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

                if (marca[i].marca.toLowerCase() === marca_mo.toLowerCase()) {
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






    <!-- INICIO MODAL CAPA -->
    <form action="{{Route('insertar_capa')}}" method='POST' id="formcapa" name="formcapa">
        <div class="modal fade" id="modal_capa" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><strong>Agregar capa</strong></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 col">
                            <label for="txt_vitola" class="form-label">Nueva capa</label>
                            <input class="form-control" id="capam" type="text" name="capam" placeholder="Agregar marca"
                                style="width: 440px" maxLength="30" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"class=" bmodal_no "data-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button onclick="validar_capa()" type="submit" class=" bmodal_yes " value="Guardar">

                            <span>Guardar</span>
                        </button>
                        @csrf
                        <input name="id_planta" value='1' hidden />
                    </div>
                </div>
            </div>
        </div>

    </form>
    <!-- FIN MODAL CAPA -->



    <!-- VALIDACION VENTANA CAPA -->


    <script type="text/javascript">
        function validar_capa() {
            var capa_m = document.getElementById('capam').value;

            var capas = '<?php echo json_encode($capas);?>';

            var capa = JSON.parse(capas);

            var cap = 0;
            var theForm = document.forms['formcapa'];


            for (var i = 0; i < capa.length; i++) {


                if (capa[i].capa.toLowerCase() === capa_m.toLowerCase()) {
                    cap++;
                }
            }

            if (capa_m === "") {
                toastr.error('Llene el nombre de la vitola', 'ERROR', {
                    "progressBar": true,
                    "closeButton": false,
                    "preventDuplicates": true,
                    "preventOpenDuplicates": true
                });
                event.preventDefault();

            } else if (cap > 0) {
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

    <!-- FIN VALIDAR CAPA -->




    <!-- INICIO MODAL NOMBRE -->
    <form action="{{Route('insertar_nombre')}}" method='POST' id="formnombre" name="formnombre">
        <div class="modal fade" id="modal_nombre" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><strong>Agregar nombre</strong></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 col">
                            <label for="txt_vitola" class="form-label">Nueva nombre</label>
                            <input class="form-control" id="nombrem" type="text" name="nombrem"
                                placeholder="Agregar marca" style="width: 440px" maxLength="30" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button  type="button" class=" bmodal_no" data-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button onclick="validar_nombre()" type="submit" class=" bmodal_yes "value="Guardar">
                            <span>Guardar</span>
                        </button>
                        @csrf
                        <input name="id_planta" value='1' hidden />
                    </div>
                </div>
            </div>
        </div>

    </form>
    <!-- FIN MODAL NOMBRE -->



    <!-- VALIDACION VENTANA NOMBRE -->


    <script type="text/javascript">
        function validar_nombre() {
            var nombre_m = document.getElementById('nombrem').value;

            var nombres = '<?php echo json_encode($nombres);?>';

            var nombre = JSON.parse(nombres);
            var nom = 0;
            var theForm = document.forms['formnombre'];


            for (var i = 0; i < nombre.length; i++) {


                if (nombre[i].nombre.toLowerCase() === nombre_m.toLowerCase()) {
                    nom++;
                }
            }

            if (nombre_m === "") {
                toastr.error('Llene el nombre de la vitola', 'ERROR', {
                    "progressBar": true,
                    "closeButton": false,
                    "preventDuplicates": true,
                    "preventOpenDuplicates": true
                });
                event.preventDefault();

            } else if (nom > 0) {
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

    <!-- FIN VALIDAR NOMBRE -->




    <!-- INICIO MODAL TIPO -->
    <form action="{{Route('insertar_tipo')}}" method='POST' id="formtipo" name="formtipo">
        <div class="modal fade" id="modal_tipo" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><strong>Agregar tipo de empaque</strong></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 col">
                            <label for="txt_vitola" class="form-label">Nuevo tipo de empaque</label>
                            <input class="form-control" id="tipom" type="text" name="tipom"
                                placeholder="Agregar tipo de empaque" style="width: 440px" maxLength="30"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button  type="button" class=" bmodal_no " data-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button onclick="validar_tipo()" type="submit"class=" bmodal_yes " value="Guardar">
                            <span>Guardar</span>
                        </button>
                        @csrf
                        <input name="id_planta" value='1' hidden />
                    </div>
                </div>
            </div>
        </div>

    </form>
    <!-- FIN MODAL TIPO -->



    <!-- VALIDACION VENTANA TIPO -->


    <script type="text/javascript">
        function validar_tipo() {
            var tipo_m = document.getElementById('tipom').value;

            var tipos = '<?php echo json_encode($tipos);?>';

            var tipo = JSON.parse(tipos);
            var tip = 0;
            var theForm = document.forms['formtipo'];


            for (var i = 0; i < tipo.length; i++) {


                if (tipo[i].tipo_empaque.toLowerCase() === tipo_m.toLowerCase()) {
                    tip++;
                }
            }

            if (tipo_m === "") {
                toastr.error('Llene el nombre de la vitola', 'ERROR', {
                    "progressBar": true,
                    "closeButton": false,
                    "preventDuplicates": true,
                    "preventOpenDuplicates": true
                });
                event.preventDefault();

            } else if (tip > 0) {
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

    <!-- FIN VALIDAR TIPO -->





    <!-- INICIO MODAL VITOLA -->
    <form action="{{Route('insertar_vitola')}}" method='POST' id="formvitola" name="formvitola">
        <div class="modal fade" id="modal_vitola" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><strong>Agregar tipo de empaque</strong></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 col">
                            <label for="txt_vitola" class="form-label">Nuevo tipo de empaque</label>
                            <input class="form-control" id="vitolam" type="text" name="vitolam"
                                placeholder="Agregar tipo de empaque" style="width: 440px" maxLength="30"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button  type="button" class=" bmodal_no" data-dismiss="modal"><span>Cancelar</span></button>
                        <button onclick="validar_vitola()" type="submit" class=" bmodal_yes" value="Guardar">
                            <span>Guardar</span>
                        </button>
                        @csrf
                        <input name="id_planta" value='1' hidden />
                    </div>
                </div>
            </div>
        </div>

    </form>
    <!-- FIN MODAL VITOLA -->



    <!-- VALIDACION VENTANA VITOLA -->


    <script type="text/javascript">
        function validar_vitola() {
            var vitola_m = document.getElementById('vitolam').value;

            var vitolas = '<?php echo json_encode($vitolas);?>';

            var vitola = JSON.parse(vitolas);
            var vit = 0;
            var theForm = document.forms['formvitola'];


            for (var i = 0; i < vitola.length; i++) {


                if (vitola[i].vitola.toLowerCase() === vitola_m.toLowerCase()) {
                    vit++;
                }
            }

            if (vitola_m === "") {
                toastr.error('Llene el nombre de la vitola', 'ERROR', {
                    "progressBar": true,
                    "closeButton": false,
                    "preventDuplicates": true,
                    "preventOpenDuplicates": true
                });
                event.preventDefault();

            } else if (vit > 0) {
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

    <!-- FIN VALIDAR VITOLA -->

</div>
