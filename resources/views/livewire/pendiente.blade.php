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




    </br>
    <ul class="nav justify-content-center">
    <li class="nav-item">
            <a style="color:black; font-size:16px;" href="pendiente"><strong>Pendiente</strong></a>
        </li>

         <li class="nav-item">
            <a style="color:black; font-size:16px;" href="productos"><strong>Productos</strong></a>
        </li>
        
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="import_excel"><strong>Importar pedido</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:black; font-size:16px;" href="index_bodega_proceso"><strong>Reporte</strong></a>
        </li>
    </ul>
    </br>



    <div class="container" style="width:1400px; padding-left:30px">
        <div class="row">
            <div class="col-10">
                
                    <div class="row">
                        <div class="col-sm">
                            <label>De</label>
                        </div>
                        <div class="col-sm">
                            <input type="date" name="fecha_de" id="fecha_de" class="form-control mr-sm-2 botonprincipal"
                                style="width:200px;" placeholder="Nombre" wire:model= "fede">
                        </div>
                        <div class="col-sm">
                            <label>Hasta</label>
                        </div>
                        <div class="col-sm">
                            <input type="date" name="fecha_hasta" id="fecha_hasta" wire:model= "fecha"
                                class="form-control mr-sm-2 botonprincipal" style="width:200px;" placeholder="Nombre">
                        </div>
                        <div class="col-sm">
                            <input name="nombre" id="nombre" class="form-control mr-sm-2 botonprincipal"
                                style="width:200px;" placeholder="Nombre" wire:model= "nom">
                        </div>
                        

                    </div>
               
            </div>

            <div class="col">
                <form action="{{Route('exportar_pendiente')}}">
                    <input type="text" value= "{{isset($nom)?$nom:null}}" name="nombre" id="nombre" hidden wire:model= "nom" >
                    <input type="date" value= "{{isset($fede)?$fede:null}}" name="fecha_de" id="fecha_de" hidden wire:model= "fede">
                    <input type="date" value= "{{isset($feha)?$feha:null}}" name="fecha_hasta" id="fecha_hasta" hidden wire:model= "fecha">
                    <button class="form-control mr-sm-2 botonprincipal" type="submit" style="width:120px;">Exportar
                    </button>
                </form>
            </div>
        </div>


    </div>

    <div class="panel-body">
        <div class="table-responsive">
            @csrf
            <table class="table table-light" id="editable" style="font-size:10px;">
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


<!-- INICIO MODAL ELMINAR DATO PENDIENTE -->
<form  action ="{{Route('borrarpendiente')}}" id = "formulario_mostrarE" name = "formulario_mostrarE" action = ""  method="POST">

@csrf
<?php use App\Http\Controllers\UserController; ?>
  
<input name = "id_pendiente" id="id_pendiente" value ="" hidden />

<div class="modal fade" id="modal_eliminar_detalle" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
  <div class="modal-dialog modal-dialog-centered" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Eliminar a <strong><input value ="" id="txt_usuarioE" name= "txt_usuarioE" style="border:none;"></strong> </h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      ¿Estás seguro que quieres eliminar este usuario?
      </div>
      <div class="modal-footer" >
        <button style=" background: #b39f64; color: #ecedf1;" type="button" class=" btn-info-claro " data-dismiss="modal" >
            <span>Cancelar</span>
        </button>
        <button type="submit" class=" btn-info "   >
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

                <div class="modal-header">

                   
                       
                            <h5 style="font-size:20px; width:3000px; text-align:center; font:bold" class=""
                                id="staticBackdropLabel"><strong>Descripción del producto</strong></h5>
                       
                        
                   

                        <h5 style="font-size:20px; width:3000px; text-align:center; font:bold" class="" id="titulo"
                            name="titulo"><strong>hola</strong></h5>

                    
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        
                    


                </div>

                <div class="modal-body">

                    <div class="card-body">

                        <div class="row">

                        <input name = "id_pendientea" id="id_pendientea" value ="" hidden />
                        
                        <input name = "itema" id="itema" value ="" hidden />
                            <div class="mb-3 col">
                                <label style="font-size:16px" for="txt_figuraytipo" class="form-label">Orden del
                                    sistema</label>
                                <input name="orden_sistema" id="orden_sistema" style="font-size:16px"
                                    class="form-control" \ type="text" autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                                <label style="font-size:16px" for="txt_figuraytipo"
                                    class="form-label">Observación</label>
                                <input name="observacion" id="observacion" style="font-size:16px" class="form-control"
                                     type="text" autocomplete="off">
                            </div>

                            <div class="mb-3 col">
                                <label style="font-size:16px" for="txt_figuraytipo"
                                    class="form-label">Presentación</label>
                                <input name="presentacion" id="presentacion" style="font-size:16px" class="form-control"
                                   type="text" autocomplete="off">
                            </div>

                        </div>



                    </div>
                </div>

                <div class="modal-footer">
                    <button style=" background: #b39f64; color: #ecedf1;" type="button" class=" btn-info-claro "
                        data-dismiss="modal">
                        <span style="font-size:16px">Cancelar</span>
                        @csrf
                    </button>
                    <button class="submit">
                        <span style="font-size:16px">Actualizar</span>
                    </button>
                </div>

            </div>
        </div>
    </div>
</form>



<!-- FIN MODAL ACTUALIZAR DATO PENDIENTE -->

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