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
<script src= "{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css') }}">




<div class="container" style="max-width:100%; ">
    
    <div class="row" style="text-align:center;">

            <div class="col">
                   <div class="input-group mb-3">

                <button class="mr-sm-2 botonprincipal " data-toggle="modal" data-target="#modal_marca"style="width:150px;">Agregar Marca</button>
         
                <button class="mr-sm-2 botonprincipal " data-toggle="modal" data-target="#modal_capa" style="width:150px;">Agregar Capa</button>
      
                <button class=" mr-sm-2 botonprincipal " data-toggle="modal" data-target="#modal_nombre"  style="width:150px;">Agregar Nombre</button>

                <button class="mr-sm-2 botonprincipal " data-toggle="modal" data-target="#modal_tipo" style="width:150px;">Agregar Tipo empaque</button>
      
                <button class="mr-sm-2 botonprincipal " data-toggle="modal" data-target="#modal_vitola" style="width:150px;">Agregar Vitola</button>
       
                    <input name="buscar" type="text" id="buscar" wire:model="busqueda"  class="  form-control  mr-sm-2  " placeholder="Búsqueda por item, nombre y capa" style="width:350px;">
         

                <form wire:submit.prevent="importar_excel"  hidden>
                    <div class="col-sm">
                        <input type="file" wire:model="select_file" id="select_file" class="btn  form-control"
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
                            <tr >
                                <th >Código</th>
                                <th>Marca</th>
                                <th><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16"> <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/></svg></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($marcas as $marca)
                            <tr>
                                <td>{{$marca->id_marca}}</td>
                                <td>{{$marca->marca}}</td>
                                <td> <a style=" width:10px; height:10px;"   wire:click="cargar_marca_editar({{$marca->id_marca}})" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </a>
                                </td>
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
                            <tr>
                                <th >Código</th>
                                <th >Capa</th>
                                <th><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16"> <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/></svg></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($capas as $capa)
                            <tr>
                                <td>{{$capa->id_capa}}</td>
                                <td>{{$capa->capa}}</td>
                                <td> <a style=" width:10px; height:10px;" wire:click="cargar_capa_editar({{$capa->id_capa}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </a>
                                </td>
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
                            <tr >
                                <th >Código</th>
                                <th >Nombre</th>
                                <th><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16"> <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/></svg></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nombres as $nombre)
                            <tr>
                                <td>{{$nombre->id_nombre}}</td>
                                <td>{{$nombre->nombre}}</td>
                                <td> <a style=" width:10px; height:10px;" wire:click="cargar_nombre_editar({{$nombre->id_nombre}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </a>
                                </td>
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
                            <tr >
                                <th>Código</th>
                                <th >Tipo empaque</th>
                                <th><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16"> <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/></svg></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tipos as $tipo)
                            <tr>
                                <td>{{$tipo->id_tipo_empaque}}</td>
                                <td>{{$tipo->tipo_empaque}}</td>
                                <td> <a style=" width:10px; height:10px;" wire:click="cargar_empaque_editar({{$tipo->id_tipo_empaque}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </a>
                                </td>
                               
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
                            <tr >
                                <th >Código</th>
                                <th >Vitola</th>
                                <th><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16"> <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/></svg></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vitolas as $vitola)
                            <tr>
                                <td>{{$vitola->id_vitola}}</td>
                                <td>{{$vitola->vitola}}</td>
                                <td> <a style=" width:10px; height:10px;"  wire:click="cargar_vitola_editar({{$vitola->id_vitola}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </a>
                                </td>
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
                            <input class="form-control" id="marcam" type="text" name="marcam" required
                                placeholder="Agregar marca" style="width: 440px"  autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class=" bmodal_no "  data-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button onclick="validar_marca()" class="bmodal_yes">
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


      <!-- INICIO EDITAR MODAL MARCA -->
      <form action="{{Route('editar_marca')}}" method='POST' id="formmarcaE" name="formmarcaE">
        @csrf
        <div class="modal fade" id="modal_marcaE" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><strong>Editar marca</strong></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 col">
                            <label for="txt_vitola" class="form-label">Marca</label>
                            <input class="form-control" id="marcae" type="text" name="marcae" required
                                placeholder="Editar marca" style="width: 440px"  autocomplete="off" value="{{$editar_nombre_marca}}" >
                        <input id="id_marcaE" name="id_marcaE"  value="{{$id_editar_marca}}" hidden />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class=" bmodal_no "  data-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button onclick="validar_marca()" class="bmodal_yes">
                            <span>Actualizar</span>
                        </button>
                      
                    </div>
                </div>
            </div>
        </div>

    </form>
    <!-- FIN EDITAR MODAL MARCA -->

    <!-- VALIDACION VENTANA MARCA -->
    <script type="text/javascript">
        function validar_marca() {
            var marca_mo = document.getElementById('marcam').value;
            var datas = '<?php echo json_encode($marcas);?>';
            console.log(datas);
            var data = JSON.parse(datas);
            var mar = 0;

            for (var i = 0; i < data.length; i++) {
                if (data[i].marca.toLowerCase() === marca_mo.toLowerCase()) {
                   
                    mar++;
                }
                }            

          if (mar > 0) {
                toastr.error('Esta Marca ya existe, favor ingrese una nueva', 'ERROR', {
                    "progressBar": true,
                    "closeButton": false,
                    "preventDuplicates": true,
                    "preventOpenDuplicates": true
                });
                event.preventDefault();

            } else {
                toastr.success('Tus datos se guardaron correctamente', 'BIEN', {"progressBar": true,"closeButton": false });
                theForm.addEventListener('submit', function (event) {});
        }
        }
    </script>
    <!-- FIN VALIDAR MARCA -->

    <script>
                window.addEventListener('editar_marcascript', event => {
                    $("#modal_marcaE").modal('show');
                })

                window.addEventListener('editar_capascript', event => {
                    $("#modal_capaE").modal('show');
                })
                
                window.addEventListener('editar_nombrescript', event => {
                    $("#modal_nombreE").modal('show');
                })
                
                window.addEventListener('editar_tiposcript', event => {
                    $("#modal_tipoE").modal('show');
                })
                
                window.addEventListener('editar_vitolascript', event => {
                    $("#modal_vitolaE").modal('show');
                })
     </script>















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
                            <input class="form-control" id="capam" type="text" name="capam" placeholder="Agregar marca" required
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

     <!-- INICIO MODAL EDITAR CAPA -->
     <form action="{{Route('editar_capa')}}" method='POST' id="formcapaE" name="formcapaE">
        <div class="modal fade" id="modal_capaE" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><strong>Editar capa</strong></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 col">
                            <label for="txt_vitola" class="form-label">Editar capa</label>
                            <input class="form-control" id="capamE" type="text" name="capamE" placeholder="Editar capa" required
                                style="width: 440px" maxLength="30" autocomplete="off" value="{{$editar_nombre_capa}}" >
                            <input id="id_capaE" name="id_capaE"  value="{{$id_editar_capa}}" hidden />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"class=" bmodal_no "data-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button onclick="validar_capa()" type="submit" class=" bmodal_yes " value="Actualizar">

                            <span>Guardar</span>
                        </button>
                        @csrf
                        <input name="id_planta" value='1' hidden />
                    </div>
                </div>
            </div>
        </div>

    </form>
    <!-- FIN MODAL EDITAR CAPA -->

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

          if (cap > 0) {
                toastr.error('Esta capa ya existe, favor ingrese una nueva', 'ERROR', {
                    "progressBar": true,
                    "closeButton": false,
                    "preventDuplicates": true,
                    "preventOpenDuplicates": true
                });
                event.preventDefault();

            } else
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
                            <input class="form-control" id="nombrem" type="text" name="nombrem" required
                                placeholder="Agregar marca" style="width: 440px" maxLength="100" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button  type="button" class=" bmodal_no" data-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button onclick="validar_nombre()" class=" bmodal_yes "value="Guardar">
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

     <!-- INICIO MODAL EDITAR NOMBRE -->
     <form action="{{Route('editar_nombre')}}" method='POST' id="formnombre_editar" name="formnombre_editar">
        <div class="modal fade" id="modal_nombreE" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><strong>Editar nombre</strong></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 col">
                            <label for="txt_vitola" class="form-label">Editar nombre</label>
                            <input class="form-control" id="nombremE" type="text" name="nombremE" required
                                placeholder="Editar nombre" style="width: 440px" maxLength="100" autocomplete="off" value="{{$editar_nombre_nombre}}" >
                            <input id="id_nombreE" name="id_nombreE"  value="{{$id_editar_nombre}}"  hidden/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button  type="button" class=" bmodal_no" data-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button onclick="validar_nombre()" class=" bmodal_yes "value="Actualizar">
                            <span>Actualizar</span>
                        </button>
                        @csrf
                    </div>
                </div>
            </div>
        </div>

    </form>
    <!-- FIN MODAL EDITAR NOMBRE -->



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

          if (nom > 0) {
                toastr.error('Este nombre ya existe, favor ingrese uno nuevo', 'ERROR', {
                    "progressBar": true,
                    "closeButton": false,
                    "preventDuplicates": true,
                    "preventOpenDuplicates": true
                });
                event.preventDefault();

            } else

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
                            <input class="form-control" id="tipom" type="text" name="tipom" required 
                                placeholder="Agregar tipo de empaque" style="width: 440px" maxLength="100" autocomplete="off">
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

      <!-- INICIO MODAL EDITAR TIPO -->
      <form action="{{Route('editar_tipo')}}" method='POST' id="formtipoE" name="formtipoE">
        <div class="modal fade" id="modal_tipoE" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><strong>Editar tipo de empaque</strong></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 col">
                            <label for="txt_vitola" class="form-label">Editar tipo de empaque</label>
                            <input class="form-control" id="tipomE" type="text" name="tipomE" required
                                placeholder="Editar tipo de empaque" style="width: 440px" maxLength="100"  autocomplete="off" value="{{$editar_nombre_empaque}}" >
                            <input id="id_tipoE" name="id_tipoE"  value="{{$id_editar_empaque}}" hidden  />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button  type="button" class=" bmodal_no " data-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button onclick="validar_tipo()" type="submit"class=" bmodal_yes " value="Actualizar">
                            <span>Actualizar</span>
                        </button>
                        @csrf
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN MODAL EDITAR TIPO -->

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

           if (tip > 0) {
                toastr.error('Esta tipo de empaque ya existe, favor ingrese uno nuevo', 'ERROR', {
                    "progressBar": true,
                    "closeButton": false,
                    "preventDuplicates": true,
                    "preventOpenDuplicates": true
                });
                event.preventDefault();
            } else
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
                        <h5 class="modal-title" id="staticBackdropLabel"><strong>Agregar Vitola</strong></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 col">
                            <label for="txt_vitola" class="form-label">Nueva vitola</label>
                            <input class="form-control" id="vitolam" type="text" name="vitolam" required
                                placeholder="Agregar nueva vitola" style="width: 440px" maxLength="30" autocomplete="off">
                                
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button  type="button" class=" bmodal_no" data-dismiss="modal"><span>Cancelar</span></button>
                        <button onclick="validar_vitola()" class=" bmodal_yes">
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

     <!-- INICIO MODAL EDITAR VITOLA -->
     <form action="{{Route('editar_vitola')}}" method='POST' id="formvitolaE" name="formvitolaE">
        <div class="modal fade" id="modal_vitolaE" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><strong>Editar Vitola</strong></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 col">
                            <label for="txt_vitola" class="form-label">Editar vitola</label>
                            <input class="form-control" id="vitolamE" type="text" name="vitolamE" required
                                placeholder="Editar vitola" style="width: 440px" maxLength="30"  autocomplete="off" value="{{$editar_nombre_vitola}}" >
                                <input id="id_vitolaE" name="id_vitolaE"  value="{{$id_editar_vitola}}" hidden />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button  type="button" class=" bmodal_no" data-dismiss="modal"><span>Cancelar</span></button>
                        <button onclick="validar_vitola()" class=" bmodal_yes">
                            <span>Actualizar</span>
                        </button>
                        @csrf
                    </div>
                </div>
            </div>
        </div>

    </form>
    <!-- FIN MODAL EDITAR VITOLA -->

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

      if (vit > 0) {
                toastr.error('Esta vitola ya existe, favor ingrese una nueva', 'ERROR', {
                    "progressBar": true,
                    "closeButton": false,
                    "preventDuplicates": true,
                    "preventOpenDuplicates": true
                });
                event.preventDefault();

            } else{                  
            theForm.addEventListener('submit', function (event) {});             
            }
        }
    </script>

    <!-- FIN VALIDAR VITOLA -->

</div>
