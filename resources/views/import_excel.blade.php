
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
            <a style="color:white; font-size:12px;" href="pendiente"><strong>Pendiente</strong></a>
        </li>

         <li class="nav-item">
            <a style="color:white;  font-size:12px;" href="productos"><strong>Productos</strong></a>
        </li>
        
        <li class="nav-item">
            <a style="color:#E5B1E2; font-size:12px;"  href="import_excel"><strong>Importar pedido</strong></a>
        </li>
        <li class="nav-item">
            <a style="color:white; font-size:12px;" href="index_bodega_proceso"><strong>Reporte</strong></a>
        </li>
    </ul>





    <div class="container" style="max-width:100%; ">




    <div class="row" >
            <div class="col">
                   <div class="input-group mb-3">
    
                <form method="post" enctype="multipart/form-data" action="{{ url('/importar_pedido') }}" class="form-inline">
                    @csrf
                    <input type="file" name="select_file" id="select_file" class="form-control  botonprincipal mr-sm-2 " style="width:350px;" />
                      <input type="submit" name="upload" style="width:130px;" class=" botonprincipal mr-sm-2 " value="Importar">
                  </form>

                    <form method="post"  action="{{ url('/vaciar_import_excel') }}" >
                    @csrf 
                    <input type="submit" style="width:130px;" class=" botonprincipal mr-sm-2 "  value="Vaciar tabla">
                    </form>

                    <form action="{{Route('pendiente_insertar')}}" method="POST">
                    @csrf
                    <input type="date" value="" name="fecha" id="fecha" style="width: 160px;color:white;text-align:center;"  class=" form-control  botonprincipal mr-sm-2 " required>
                    <button  onclick="agregarpendiente()" style="width:160px;" class="botonprincipal mr-sm-2 ">Agregar a pendiente</button>
                    </form>

                         
                    <form action="{{Route('buscar_pedido')}}" method="POST"style="margin-bottom:0px;">
                    @csrf
                    <input name="busqueda" id="busqueda" class=" form-control botonprincipal mr-sm-2" placeholder="Búsqueda por descripción u orden" style="width:250px;">
                   
                    <button class="botonprincipal mr-sm-2 " style="width: 50px" type="submit">
                    <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20"   height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                    </span>
                    </button>                                            
                    </form>

                    

              
         </div>
    </div> 
    </div>


                               

                        




 <div class="panel-body" style="padding:0px;">
    <div style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;
     height:450px;">
                    @csrf
                    <table class="table table-light" style="font-size:10px; ">
                        <thead>
                            <tr style="font-size:16px; text-align:center;">
                                <th  style=" text-align:center;">Item</th>
                                <th  style=" text-align:center;">Paquetes</th>
                                <th style=" text-align:center;">Descripción</th>
                                <th style=" text-align:center;">Total</th>
                                <th style=" text-align:center;">Unidades</th>
                                <th style=" text-align:center;">#Orden</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedido_completo as $pedido)
                            <tr>
                                <td>{{$pedido->item}}</td>
                                <td>{{$pedido->cant_paquetes}}</td>
                                <td>{{$pedido->descripcion}}</td>
                                <td>{{$pedido->unidades*$pedido->cant_paquetes}}</td>
                                <td>{{$pedido->unidades}}</td>
                                <td>{{$pedido->numero_orden}}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                      
                </div>

                </div>

    </div>
    </div>




    <div class="modal fade" id="datos_faltantes" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
  <div class="modal-dialog modal-dialog-centered" >
    <div class="modal-content">

      <div class="modal-header">          
          <h5 class="modal-title" id="staticBackdropLabel">Eliminar Usuario  </h5>  
                            </div>

      <div class="modal-body">
      ¿Estás seguro que quieres eliminar a  <strong><input value ="" id="txt_usuarioE" name= "txt_usuarioE" style="border:none;text-align:center;" readonly></strong>?
      <input name = "id_usuarioE" id="id_usuarioE" value ="" hidden />
      </div>

      <div class="modal-footer" >
        <button class="bmodal_no" data-dismiss="modal" >
            <span>Cancelar</span>
        </button>
        <button type="submit" class="bmodal_yes">
            <span>Eliminar</span>
        </button>
      </div>

    </div>
  </div>







    <script type="text/javascript">

function agregarpendiente(){ 

var datas = '<?php echo json_encode($verificar);?>';
var data = JSON.parse(datas);





 if( data.length > 0){
    var bool=confirm('Necesitas agregar los productos correspondientes a los siguientes item: \n @foreach($verificar as $v) \n{{$v->item}} @endforeach ');
  if(bool){
    location.href ="/productos";
  }
     event.preventDefault();
   

}else{
theForm.addEventListener('submit', function (event) {
}); 
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

   
@endsection

