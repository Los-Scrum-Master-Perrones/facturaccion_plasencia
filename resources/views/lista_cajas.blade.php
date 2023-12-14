@extends('principal')
@section('content')

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">


    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a style="color:#E5B1E2; font-size:12px;" href="{{ route('inventario_cajas') }}"><strong>Catálogo Cajas</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="{{ route('index_importar_cajas') }}"><strong>Importar Cajas</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="{{ route('materiales.index') }}"><strong>Materiales</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="{{ route('materiales.relacionar')}}"><strong>Materiales Productos</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white;  font-size:12px;" href="{{ route('entradas.salidas') }}"><strong>Entrada/Salida</strong></a>
        </li>
    </ul>



    <div class="container" style="max-width:100%; ">
        <div class="row" style="text-align:center;">
            <div class="col">
                <div class="input-group mb-3">
                    <form action="{{Route('buscar_lista_cajas')}}" method="POST">
                        @csrf
                        <input name="nombre" class="form-control mr-sm-2" style="width:300px;"
                            placeholder="buscar tipo de caja (Código,Producto/Servicio,Marca)">

                        <button type="submit" class=" mr-sm-2 botonprincipal " style="width:40px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button>
                    </form>
                    <form action="{{Route('inventario_cajas')}}" method="get">
                        <button class="botonprincipal  mr-sm-2 " style="width:40px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path
                                    d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z" />
                            </svg>
                        </button>
                    </form>
                    <button class="botonprincipal  mr-sm-2 " style="width:120px;" data-bs-toggle="modal"
                        data-bs-target="#modal_agregar_lista">Agregar</button>
                    <form action="{{Route('exportar_cajas')}}">
                        @csrf
                        <button type="submit" class="botonprincipal" style="width:120px;">Exportar</button>
                    </form>
                </div>
            </div>
        </div>


        <div class="panel-body" style="padding:0px;">
            <div style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;
     height:450px;">
                <table class="table table-light table-hover" style="font-size:10px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Código</th>
                            <th>Producto/Servicio</th>
                            <th>Marca</th>
                            <th>Existencia</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $c = 0;
                              $total = 0;
                        ?>
                        @foreach($listacajas as $caja)
                        <tr>
                            <td> <?php $c = $c + 1;  echo $c ?> </td>
                            <td>{{$caja->codigo}}</td>
                            <td>{{$caja->productoServicio}}</td>
                            <td>{{$caja->marca}}</td>
                            <td>{{$caja->existencia}}</td>
                            <td style=" text-align:center;">
                                <a data-bs-toggle="modal" data-bs-target="#modal_editar_caja"
                                    onclick="datos_modal_editar({{$id_usuario_basicoE= $caja->id}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width=25 height="25" fill="black"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @php
                            $total += $caja->existencia;
                        @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Total</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{$total}}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        function datos_modal_editar(id) {
            var data = @json($mostrar_lista_cajas);

            for (var i = 0; i < data.length; i++) {
                if (data[i].id === id) {
                    document.formulario_mostrarEC.id_cajaE.value = data[i].id;
                    document.formulario_mostrarEC.existencia_cajaE.value = data[i].existencia;
                }
            }
        }
    </script>

    <!-- INICIO MODAL CAMBIAR EXISTENCIA -->

    <form id="formulario_mostrarEC" name="formulario_mostrarEC" action="{{Route('editar_existencia')}}" method="POST">
        @csrf
        <div class="modal fade" id="modal_editar_caja" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <input type="text" name="busca" id="busca" value="{{isset($busca)?$busca:null}}" hidden>
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Editar existencia </h5>
                    </div>

                    <div class="modal-body">
                        <input id="id_cajaE" name="id_cajaE" value="" hidden />
                        <label for="existencia_cajaE">Existencia</label>
                        <input class="form-control" id="existencia_cajaE" name="existencia_cajaE" value="" />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button type="submit" class="btn btn-success">
                            <span>Actualizar</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </form>
    <!-- FIN MODAL CAMBIAR EXISTENCIA -->

    <!-- INICIO MODAL AGREGAR LISTA CAJA -->
    <form id="formulario_mostrarE" name="formulario_mostrarE" action="{{Route('agregar_lista_caja')}}" method="POST">
        @csrf
        <div class="modal fade " id="modal_agregar_lista" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Agregar caja </h5>

                    </div>
                    <div class="modal-body">


                        <div class="row">
                            <div class="mb-3 col">
                                <input name="codigo" class="form-control " style="width:100%;" placeholder="Código">
                            </div>
                            <div class="mb-3 col">
                                <input name="producto" class="form-control " style="width:100%;"
                                    placeholder="Producto/Servicio">
                            </div>
                            <div class="mb-3 col">
                                <input name="marca" class="form-control " style="width:100%;" placeholder="Marca">
                            </div>
                            <div class="mb-3 col">
                                <input name="existencia" class="form-control " style="width:100%;"
                                    placeholder="Existencia">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            <span>Cancelar</span>
                        </button>
                        <button type="submit" class="btn btn-success">
                            <span>Agregar</span>
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- FIN MODAL AGREGAR LISTA CAJA -->

    @endsection
