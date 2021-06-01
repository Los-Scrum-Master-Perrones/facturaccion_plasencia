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
            <a style="color:#E5B1E2; font-size:12px;" href="pendiente"><strong>Pendiente</strong></a>
        </li>

         
        
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="import_excel"><strong>Importar pedido</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="index_bodega_proceso"><strong>Reporte</strong></a>
        </li>
    </ul>


 
    <div class="container" style="max-width:100%; ">
    

    <div class="row" style="max-width:100%; text-align:right;">
    <div class="input-group mb-3" style="text-align:right;">

    <button class="botonprincipal"  data-toggle="modal" data-target="#modal_crear_nuevo"
                            onclick="" type="submit" style="width:20%; ">Agregar producto al pendiente
                        </button>
    </div> 
    </div> 
    <div class="row" style="text-align:center;">

            <div class="col">
                   <div class="input-group mb-3">
                        <span class="input-group-text form-control ">Fecha</span>
                        <input type="date" name="fecha_de" id="fecha_de" class="form-control botonprincipal"
                                style="width:200px;" placeholder="Nombre" wire:model= "fede">
                        
                       
                        <input name="nombre" id="nombre" class="form-control mr-sm-2 botonprincipal" style="width:200px;" placeholder="Nombre" wire:model= "nom">
           
                        <form wire:submit.prevent="exportPendiente()">
                        <input type="text" value= "{{isset($nom)?$nom:null}}" name="nombre" id="nombre" hidden wire:model= "nom" >
                        <input type="date" value= "{{isset($fede)?$fede:null}}" name="fecha_de" id="fecha_de" hidden wire:model= "fede">
                        <button class="botonprincipal" type="submit" style="width:120px;">Exportar
                        </button>

                       </form>
               </div>                
          </div>
    </div>

    

    <div class="panel-body" style="padding:0px;">
            <div style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;
     height:450px;">
            @csrf
            <table class="table table-light" style="font-size:10px;">
                <thead>
                    <tr>
                        <th style="width:100px;">CATEGORIA</th>
                        <th>ITEM</th>
                        <th>ORDEN DEL SISTEMA</th>
                        <th>OBSERVACÓN</th>
                        <th>PRESENTACIÓN</th>
                        <th>MES</th>
                        <th>ORDEN</th>
                        <th style="width:100px;">MARCA</th>
                        <th>VITOLA</th>
                        <th>NOMBRE</th>
                        <th>CAPA</th>
                        <th>TIPO DE EMPAQUE</th>
                        <th>ANILLO</th>
                        <th>CELLO</th>
                        <th>UPC</th>
                        <th>COD.PRECIO</th>
                        <th>PRECIO</th>
                        <th>PENDIENTE</th>
                        <th>SALDO</th>
                        <th>OPERACIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datos_pendiente as $datos)
                    <tr>
                        <td style="width:100px; max-width: 400px;overflow-x:auto;">{{$datos->categoria}}</td>
                        <td>{{$datos->item}}</td>
                        <td>{{$datos->orden_del_sitema}}</td>
                        <td>{{$datos->observacion}}</td>
                        <td>{{$datos->presentacion}}</td>
                        <td>{{$datos->mes}}</td>
                        <td>{{$datos->orden}}</td>
                        <td>{{$datos->marca}}</td>
                        <td>{{$datos->vitola}}</td>
                        <td>{{$datos->nombre}}</td>
                        <td>{{$datos->capa}}</td>
                        <td>{{$datos->tipo_empaque}}</td>
                        <td>{{$datos->anillo}}</td>
                        <td>{{$datos->cello}}</td>
                        <td>{{$datos->upc}}</td>
                        <td>{{$datos->serie_precio}}</td>
                        <td>{{$datos->precio}}</td>
                        <td>{{$datos->pendiente}}</td>
                        <td>{{$datos->saldo}}</td>
                        
                        
                        <td  style="text-align:center;">
                        <a data-toggle="modal" data-target="#modal_eliminar_detalle"
                            onclick="datos_modal_eliminar({{$datos->id_pendiente}})" href="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path
                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                            </svg></a>


                        <a style=" width:10px; height:10px;" data-toggle="modal" href=""
                            data-target="#modal_actualizar" type="submit"
                            onclick="datos_modal_actualizar({{$datos->id_pendiente}},{{$datos->item}})" >
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
    </div>


<!-- INICIO MODAL ELMINAR DATO PENDIENTE -->
<form  action ="{{Route('borrarpendiente')}}" id = "formulario_mostrarE" name = "formulario_mostrarE"   method="POST">

@csrf
<?php use App\Http\Controllers\UserController; ?>
  
<input name = "id_pendiente" id="id_pendiente" value ="" hidden />

<div class="modal fade" id="modal_eliminar_detalle" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
  <div class="modal-dialog modal-dialog-centered" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Eliminar  <strong><input value ="" id="txt_usuarioE" name= "txt_usuarioE" style="border:none;"></strong> </h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      ¿Estás seguro que quieres eliminar este registro del pendiente?
      </div>
      <div class="modal-footer" >
        <button  type="button" class="bmodal_no " data-dismiss="modal" >
            <span>Cancelar</span>
        </button>
        <button type="submit" class=" bmodal_yes "   >
            <span>Eliminar</span>
        </button>
      </div>
    </div>
  </div>
</div>
</form>


<!-- FIN MODAL ELMINAR DATO PENDIENTE -->


<!-- INICIO MODAL ACTUALIZAR DATO PENDIENTE -->



<form action="{{Route('actualizar_pendiente')}}" method="POST" id="actualizar_pendiente" name="actualizar_pendiente">
    <div class="modal fade" role="dialog" id="modal_actualizar" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
        style="opacity:.9;background:#212529;width=800px;">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="opacity:.9;background:#212529;width=80%">
            <div class="modal-content">
            @csrf
                <div class="modal-header">
                <h5  id="staticBackdropLabel"><strong>Descripción del producto: </strong><span id="titulo"   name="titulo"></span></h5>  
             </div>


<div class="modal-body">
    <div class="row">

        <input name="id_pendientea" id="id_pendientea" value="" hidden />

        <input name="itema" id="itema" value="" hidden />
        <div class="mb-3 col">
            <label for="txt_figuraytipo" class="form-label">Orden del sistema</label>
            <input name="orden_sistema" id="orden_sistema" class="form-control" \ type="text" autocomplete="off">
        </div>
        <div class="mb-3 col">
            <label for="txt_figuraytipo" class="form-label">Orden</label>
            <input name="orden" id="orden" class="form-control" type="text" autocomplete="off">
        </div>

        <div class="mb-3 col">
            <label for="txt_figuraytipo" class="form-label">Presentación</label>
            <input name="presentacion" id="presentacion" class="form-control" type="text" autocomplete="off">
        </div>
    </div>


    <div class="row">


        <div class="mb-3 col">
            <label for="txt_figuraytipo" class="form-label">Pendiente</label>
            <input name="pendiente" id="pendiente" class="form-control" type="text" autocomplete="off">


        </div>

        <div class="mb-3 col">
            <label for="txt_figuraytipo" class="form-label">Código precio</label>
            <input name="cprecio" id="cprecio" class="form-control" type="text" autocomplete="off">


        </div>

        <div class="mb-3 col">
            <label for="txt_figuraytipo" class="form-label">Precio</label>
            <input name="precio" id="precio" class="form-control" type="text" autocomplete="off">


        </div>



    </div>

    <div class="row">

        <div class="mb-3 col">
            <label for="txt_figuraytipo" class="form-label">Observación</label>
            <input name="observacion" id="observacion" class="form-control" type="text" autocomplete="off">
        </div>
    </div>
</div>

<div class="modal-footer">
        <button class="bmodal_no" data-dismiss="modal" >
            <span>Cancelar</span>
        </button>
        <button type="submit" class="bmodal_yes">
            <span>Actualizar</span>
        </button>
      </div>

            </div>
        </div>
    </div>
</form>



<!-- FIN MODAL ACTUALIZAR DATO PENDIENTE -->


<!-- INICIO DEL MODAL NUEVO PRODUCTO -->

<form action="{{Route('nuevo_pendiente')}} " method="POST">
    <div class="modal fade" role="dialog" id="modal_crear_nuevo" data-backdrop="static" data-keyboard="false"
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

                            <label for="txt_figuraytipo" class="form-label">Categoria</label>

                            <select class="form-control" name="categoria" id="categoria"
                                placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;" required>
                                <option value="1">NEW ROLL</option>
                                <option value="2">CATALOGO</option>
                                <option value="3">TAKE FROM EXISTING INVENT</option>
                                <option value="4">INTERNATIONAL SALES</option>

                            </select>
                        </div>
                        <div class="row">

                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Item</label>
                                <input name="itemn" id="itemn" style="font-size:16px" class="form-control" required
                                    type="text" autocomplete="off">
                            </div>


                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Orden del sistema</label>
                                <input name="ordensis" id="ordensis" style="font-size:16px" class="form-control"
                                    type="text" autocomplete="off">
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Observacion</label>
                                <input name="observacionn" id="observacionn" style="font-size:16px" class="form-control"
                                    type="text" autocomplete="off">
                            </div>




                        </div>


                        <div class="row">


                            <div class="mb-3 col">
                                <label for="txt_malos" class="form-label">Presentación</label>

                                <select class="form-control" name="presentacionn" id="presentacionn"
                                    placeholder="Ingresa figura y tipo" style="overflow-y: scroll; height:30px;"
                                    required>

                                    <option value="Puros Tripa Larga" style="overflow-y: scroll;">Puros Tripa Larga
                                    </option>
                                    <option value="Puros Tripa Corta" style="overflow-y: scroll;">Puros Tripa Corta
                                    </option>

                                </select>
                            </div>


                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Fecha</label>
                                <input name="fechan" id="fechan" style="font-size:12px" class="form-control" required
                                    type="date" autocomplete="off">
                            </div>




                            <div class="mb-3 col">
                                <label for="txt_figuraytipo" class="form-label">Orden</label>
                                <input name="ordenn" id="ordenn" style="font-size:16px" class="form-control" required
                                    type="text" autocomplete="off">
                            </div>



                        </div>




                        <div class="row">
                            <div class="mb-3 col">
                                <label for="txt_vitola" class="form-label">Marca</label>
                                <select class="form-control" name="marca" id="marca" placeholder="Ingresa figura y tipo"
                                    style="overflow-y: scroll; height:30px;" required>
                                    @foreach($marcas as $mar)
                                    <option style="overflow-y: scroll;"> {{$mar->marca}}</option>
                                    @endforeach
                                </select>

                            </div>

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
                                <label for="txt_figuraytipo" class="form-label">Capa</label>
                                <select class="form-control" name="capa" id="capa" placeholder="Ingresa figura y tipo"
                                    style="overflow-y: scroll; height:30px;" required>
                                    @foreach($capas as $capa)
                                    <option style="overflow-y: scroll;"> {{$capa->capa}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_malos" class="form-label">Tipo de
                                    empaque</label>
                                <select class="form-control" name="tipo" id="tipo" placeholder="Ingresa figura y tipo"
                                    style="overflow-y: scroll; height:30px;" required>
                                    @foreach($tipo_empaques as $tipo_empaque)
                                    <option style="overflow-y: scroll;"> {{$tipo_empaque->tipo_empaque}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-3 col">
                                <input type="checkbox" name="cello" id="cello" style="font-size:20px" value="si">
                                <label for="cello" class="form-label">Cello</label>


                                <input type="checkbox" name="anillo" id="anillo" style="font-size:20px" value="si">
                                <label for="anillo" class="form-label">Anillo</label>


                                <input type="checkbox" name="upc" id="upc" style="font-size:20px" value="si">
                                <label for="upc" class="form-label">UPC</label>
                            </div>

                        </div>


                        <div class="row">



                            <div class="mb-3 col">
                                <label for="txt_total" class="form-label">Pendiente</label>
                                <input name="pendienten" id="pendienten" class="form-control" required type="number"
                                    autocomplete="off">
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_buenos" class="form-label">Saldo</label>
                                <input name="saldon" id="saldon" class="form-control" required type="number"
                                    autocomplete="off">
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_total" class="form-label">Paquetes</label>
                                <input name="paquetes" id="paquetes" class="form-control" required type="number"
                                    autocomplete="off">
                            </div>




                        </div>


                        <div class="row">



                            <div class="mb-3 col">
                                <label for="txt_total" class="form-label">Unidades</label>
                                <input name="unidades" id="unidades" class="form-control" required type="number"
                                    autocomplete="off">
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_buenos" class="form-label">Codigo precio</label>
                                <input name="c_precion" id="c_precion" class="form-control" type="text"
                                    autocomplete="off">
                            </div>

                            <div class="mb-3 col">
                                <label for="txt_total" class="form-label">precio</label>
                                <input name="precion" id="precion" class="form-control" type="number"
                                    autocomplete="off">
                            </div>




                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class=" bmodal_no" data-dismiss="modal"><span>Cancelar</span>
                        @csrf
                    </button>
                    <button onclick="agregarproducto()" class=" bmodal_yes "> <span>Guardar</span> </button>
                </div>

            </div>
        </div>
    </div>
</form>
<!-- FIN DEL MODAL NUEVO PRODUCTO -->


<script type="text/javascript">
    function datos_modal_eliminar(id){ 
var datas = '<?php echo json_encode($datos_pendiente);?>';

var data = JSON.parse(datas);

 

for (var i = 0; i < data.length; i++) {  
  if(data[i].id_pendiente === id){  
     document.formulario_mostrarE.id_pendiente.value = data[i].id_pendiente;
  
     
    }
}

    }   
</script>




<script type="text/javascript">
    function datos_modal_actualizar(id,item){ 
var datas = '<?php echo json_encode($datos_pendiente);?>';

var data = JSON.parse(datas);

var producto ="";

for (var i = 0; i < data.length; i++) {  
  if(data[i].id_pendiente === id){  
     document.actualizar_pendiente.id_pendientea.value = data[i].id_pendiente;

     document.actualizar_pendiente.itema.value = data[i].item;

     producto = 
     document.getElementById("titulo").innerHTML ="".concat(data[i].marca, " ", data[i].nombre , " ", data[i].capa, " ", data[i].vitola);;

     
     document.actualizar_pendiente.presentacion.value = data[i].presentacion;
     
     document.actualizar_pendiente.observacion.value = data[i].observacion;
     
     document.actualizar_pendiente.orden_sistema.value = data[i].orden_del_sitema;
     
     document.actualizar_pendiente.pendiente.value = data[i].pendiente;
     document.actualizar_pendiente.cprecio.value = data[i].serie_precio;
     
     document.actualizar_pendiente.precio.value = data[i].precio;
     
     document.actualizar_pendiente.orden.value = data[i].orden;

    
     
     
    }
}

    }   
</script>



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