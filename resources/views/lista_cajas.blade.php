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
    
<link rel="stylesheet" href="{{ asset('css/principal.css') }}" />
</head>

<body style=" background-size:100% 100%;">

<ul class="nav justify-content-center">
  <li class="nav-item">
    <a style="color:white;"  href="index_lista_cajas">Lista</a>
  </li>
  <li class="nav-item">
    <a style="color:black;"  href="index_inventario_cajas">Inventario</a>
  </li>
  <li class="nav-item">
    <a style="color:black;" href="index_importar_cajas">Importar</a>
  </li>
</ul>

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
                <button class="btn botonprincipal">Agregar</button>
                </div>
          </div>

        

            <br />
                   
                        <table class="table table-light"
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
        
      

        @endsection
</body>

</html>
