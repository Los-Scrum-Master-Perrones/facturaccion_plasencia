
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
    <a style="color:white; font-size:12px;"  href="index_lista_productos"><strong>Productos Terminado </strong></a>
  </li>
  <li class="nav-item">
    <a style="color:#E5B1E2; font-size:12px;"   href="importar_productos_terminado"><strong>Importar Productos Terminado</strong></a>
  </li>
</ul>

  <div class="container" style="max-width:100%; ">


  <ul class="nav"  >

  <form method="post" enctype="multipart/form-data" action="{{ url('/importar_archivoproductos_terminados') }}" >
      @csrf
<div class="row">
<div class="col">
   <input type="file" name="select_file" id="select_file" class=" botonprincipal" style="width:300px;" />
  </div>
<div class="col">
<input type="submit" name="upload" class=" botonprincipal " value="Importar" style="width:100px;" />
</div>
</div>
      </form>

      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

  <li class="nav-item">
  <form method="get" enctype="multipart/form-data" action="{{ url('/reemplazar_productos_terminado') }}" >
      @csrf
      <input type="submit" name="upload" class=" botonprincipal " value="Actualizar producto terminado">
      </form>
     </li>
  </ul>






 <div class="panel-body" style="padding:0px;">
            <div style="width:100%; padding-left:0px;   font-size:10px;   overflow-x: display; overflow-y: auto;
     height:450px;">

<table class="table table-light table-hover"
style="font-size:10px;">
<thead>
<tr>
<th>Lote</th>
<th>Marca</th>
<th>Alias Vitola</th>
<th>Vitola</th>
<th>Nombre Capa</th>
<th>Existencia</th>
</tr>

</thead>
<tbody>
@foreach($productos as $producto)

        <tr>
        <td>{{$producto->Lote}}</td>
        <td>{{$producto->Marca}}</td>
        <td>{{$producto->Alias_vitola}}</td>
        <td>{{$producto->Vitola}}</td>
        <td>{{$producto->Nombre_capa}}</td>
        <td>{{$producto->Existencia_total}}</td>
        </tr>
        @endforeach
        </tbody>
        </table>
        </div>
        </div>
        </div>







        @endsection
