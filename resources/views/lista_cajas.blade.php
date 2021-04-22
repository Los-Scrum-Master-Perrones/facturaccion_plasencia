<!DOCTYPE html>
<html>
    
@extends('principal')
@section('content')



<head>
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
<link rel="stylesheet" href="{{ asset('css/principal.css') }}" />
</head>

<body style=" background-size:100% 100%;">

<ul class="nav justify-content-center">
  <li class="nav-item">
    <a style="color:white; font-size:16px;"  href="index_lista_cajas"><strong>Lista</strong></a>
  </li>
  <li class="nav-item">
    <a style="color:black; font-size:16px;" href="index_importar_cajas"><strong>Importar</strong></a>
  </li>
  <li class="nav-item">
    <a style="color:black; font-size:16px;"  href="index_bodega"><strong>Bodega</strong></a>
  </li>
  <li class="nav-item">
    <a style="color:black; font-size:16px;"  href="index_bodega_proceso"><strong>Bodega Proceso</strong></a>
  </li>  
  <li class="nav-item">
    <a style="color:black; font-size:16px;"  href="index_inventario_cajas"><strong>Total Bodega</strong></a>
  </li>
</ul>
</br>


    <div class="container">
      
 
               
                <div class="row" style="width:100%;">
                <div class="col-md-8" >

             <form action=  "{{Route('buscar_lista_cajas')}}" method= "POST" class="form-inline" style="margin-bottom:0px;">
                    @csrf
                    <input name="nombre"  class="form-control mr-sm-2 botonprincipal" style="width:100%;"   placeholder="buscar tipo de caja (Código,Producto/Servicio,Marca)" >
                 
                </div>
                <div class="col-md-1">
                       <button class="btn botonprincipal form-control mr-sm-2" type="submit">
                    <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                    </span>
                    </button>
                </div>
             </form>  
                
               
                <div class="col-md-3">
                <button class="btn botonprincipal" data-toggle="modal" data-target="#modal_agregar_lista" >Agregar</button>
                </div>
          </div>

        

            <br />
                   
                        <table class="table table-light"  id="editable"
                        style="font-size:10px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Código</th>
                                    <th>Producto/Servicio</th>
                                    <th>Marca</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php $c = 0;?>
                            @foreach($listacajas as $caja)

                            <tr>

                            <td> <?php $c = $c + 1;  echo $c ?>  </td>
                            <td>{{$caja->codigo}}</td>
                            <td>{{$caja->productoServicio}}</td>
                            <td>{{$caja->marca}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
              
                </div>
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
                    url: '{{ route("editaryeliminarlista") }}',
                    method: 'POST',
                    dataType: "json",
                    columns: {
                        identifier: [0, 'id'],
                        editable: [
                            [1, 'codigo'],
                            [2, 'productoServicio'],
                            [3, 'marca']
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








<!-- INICIO MODAL AGREGAR LISTA CAJA -->
<form id = "formulario_mostrarE" name = "formulario_mostrarE" action = "{{Route('agregar_lista_caja')}}"  method="POST">

@csrf
  

<div class="modal fade " id="modal_agregar_lista" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
  <div class="modal-dialog modal-dialog-centered modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar caja <strong><input value ="" id="txt_usuarioE" name= "txt_usuarioE" style="border:none;"></strong> </h5>
       
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










        
        
      

        @endsection
</body>

</html>
