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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">




<ul class="nav justify-content-center">
<li class="nav-item">
    <a style="color:#E5B1E2; font-size:12px;"  href="index_lista_productos"><strong>Productos Terminado </strong></a>
  </li>
  <li class="nav-item">
    <a style="color:white;  font-size:12px;" href="importar_productos_terminado"><strong>Importar Productos Terminado</strong></a>
  </li>
</ul>



<div class="container" style="max-width:100%; "> 
<div class="row"  style="width:100%%; text-align:right;">
<div class="col">

<input   data-toggle="modal"  style="width:20%; font-size:12px " class=" botonprincipal mr-sm-2 "  data-target="#modal_actualizar" type="submit"  value="Agregar producto al inventario">
                  
</div>
</div>

<br>
               
<div class="panel-body" style="padding:0px;">   
            <div style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;
     height:500px;">
                        <table class="table table-light"
                        style="font-size:10px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Lote</th>
                                    <th>Marca</th>
                                    <th>Alias Vitola</th>
                                    <th>Vitola</th>
                                    <th>Nombre capa</th>
                                    <th>Existencia</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php $c = 0;?>
                            @foreach($listaproductos as $producto)

                            <tr>

                            <td> <?php $c = $c + 1;  echo $c ?>  </td>
                            <td>{{$producto->lote}}</td>
                            <td>{{$producto->marca}}</td>
                            <td>{{$producto->nombre}}</td>
                            <td>{{$producto->vitola}}</td>
                            <td>{{$producto->capa}}</td>
                            <td>{{$producto->Existencia}}</td>
                            <td style=" text-align:center;">

                            <a data-toggle="modal" data-target="#modal_editar_producto" onclick ="datos_modal_editar({{$id_producto_basicoE= $producto->id}})">
                            <svg xmlns="http://www.w3.org/2000/svg" width=25 height="25" fill="black" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
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


          

        <script type="text/javascript">
    function datos_modal_editar(id){ 

var datas = '<?php echo json_encode($listaproductoseditar);?>';
var data = JSON.parse(datas);

for (var i = 0; i < data.length; i++) {  
  if(data[i].id === id){    
     document.formulario_mostrarEP.id_productoE.value = data[i].id;
     document.formulario_mostrarEP.existencia_productoE.value = data[i].Existencia;
  
    }
    }
    }   
</script>
       
       
       
    <!-- INICIO DEL MODAL NUEVO PRODUCTO -->

    <form action="{{Route('insertar_pro')}} " method="POST">
        <div class="modal fade" role="dialog" id="modal_actualizar" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
            style="opacity:.9;background:#212529;width=800px;">
            <div class="modal-dialog modal-dialog-centered modal-lg" style="opacity:.9;background:#212529;width=80%">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="staticBackdropLabel"><strong>Agregar producto</strong></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="card-body">
                            <div class="row">
                            <div class="mb-3 col">
                                    <label  for="txt_figuraytipo" class="form-label">Lote</label>
                                    <input name="lote" id="lote" style="font-size:16px; height:30px;" class="form-control" required
                                        type="text" autocomplete="off">
                                </div>
                         

                            

                            <div class="mb-3 col">
                                    <label for="txt_vitola" class="form-label">Marca</label>
                                    <select class="form-control" name="marca" id="marca"
                                        placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;"
                                        required>
                                        @foreach($marcas as $marca)
                                        <option style="overflow-y: scroll;"> {{$marca->marca}}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="mb-3 col">
                                    <label for="txt_total" class="form-label">Nombre</label>

                                    <select class="form-control" name="nombre" id="nombre"
                                        placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;"
                                        required>
                                        @foreach($nombres as $nombre)
                                        <option style="overflow-y: scroll;"> {{$nombre->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                               

                                </div>

                                <div class="row">
                               

                            

                                <div class="mb-3 col">
                                    <label for="txt_buenos" class="form-label">Vitola</label>

                                    <select class="form-control" name="vitola" id="vitola"
                                        placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;"
                                        required>
                                        @foreach($vitolas as $vitola)
                                        <option style="overflow-y: scroll;"> {{$vitola->vitola}}</option>
                                        @endforeach
                                    </select>

                                </div>


                                <div class="mb-3 col">
                                    <label for="txt_figuraytipo" class="form-label">Capa</label>
                                    <select class="form-control" name="capa" id="capa"
                                        placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;"
                                        required>
                                        @foreach($capas as $capa)
                                        <option style="overflow-y: scroll;"> {{$capa->capa}}</option>
                                        @endforeach
                                    </select>
                                </div>


                    

                                <div class="mb-3 col">
                                    <label for="txt_total" class="form-label">Existencia</label>
                                    <input name="existencia" id="existencia"  style="height:30px;"
                                        class="form-control" required type="text" autocomplete="off">
                                </div>
                               
                            </div>



                        </div>
                    </div>

                    <div class="modal-footer">
                        <button  type="button" class=" bmodal_no"
                            data-dismiss="modal"><span >Cancelar</span>
                            @csrf
                        </button>
                        <button onclick="agregarproducto()"class=" bmodal_yes "> <span>Guardar</span> </button>
                    </div>

                </div>
            </div>
        </div>
    </form>
    <!-- FIN DEL MODAL NUEVO PRODUCTO -->

 <!-- INICIO MODAL CAMBIAR EXISTENCIA -->
 
 <form id = "formulario_mostrarEP" name = "formulario_mostrarEP" action = "{{Route('editar_existencia_producto')}}"  method="POST">
@csrf
<?php use App\Http\Controllers\ImportExcelController; ?>
<div hidden>{{$id_producto_basicoE=0}}</div>  

<div class="modal fade" id="modal_editar_producto" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
  <div class="modal-dialog modal-dialog-centered" >
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar existencia Producto</h5>
      </div>
      
      <div class="modal-body">
        <input id="id_productoE" name = "id_productoE"   value ="" hidden />
        <label for="existencia_productoE" >Existencia</label>
        <input  class="form-control"id="existencia_productoE" name = "existencia_productoE" value =""  />
      </div>

      <div class="modal-footer" >
        <button  type="button" class=" bmodal_no " data-dismiss="modal" >
        <span>Cancelar</span>
        </button>
        <button type="submit" class="bmodal_yes"   >
        <span>Actualizar</span>
        </button>
      </div>

    </div>
  </div>
</div>
</form>
<!-- FIN MODAL CAMBIAR EXISTENCIA -->





<!-- INICIO MODAL AGREGAR LISTA CAJA -->
<form id = "formulario_mostrarE" name = "formulario_mostrarE" action = "{{Route('agregar_lista_caja')}}"  method="POST">
@csrf
<div class="modal fade " id="modal_agregar_lista" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
  <div class="modal-dialog modal-dialog-centered modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar caja <strong><input  id="txt_usuarioE" name= "txt_usuarioE" style="border:none;"></strong> </h5>
       
      </div>
      <div class="modal-body">
    

      <div class="row">
        <div class="mb-3 col">
        <input name="codigo"  class="form-control " style="width:100%;"   placeholder="Código" >
        </div>
        <div class="mb-3 col">
        <input name="producto"  class="form-control " style="width:100%;"   placeholder="Producto/Servicio" >
        </div>
        <div class="mb-3 col">
        <input name="marca"  class="form-control " style="width:100%;"   placeholder="Marca" >
        </div>  
        <div class="mb-3 col">
        <input name="existencia"  class="form-control " style="width:100%;"   placeholder="Existencia" >
        </div>
    </div>



      </div>
      <div class="modal-footer" >
        <button  type="button" class=" btn botonprincipal " data-dismiss="modal" >
            <span>Cancelar</span>
        </button>
        <button type="submit" class=" btn botonprincipal  "   >
            <span>Agregar</span>
        </button>   
      
      </div>
    </div>
  </div>
</div>
</form>
<!-- FIN MODAL AGREGAR LISTA CAJA -->

        @endsection


