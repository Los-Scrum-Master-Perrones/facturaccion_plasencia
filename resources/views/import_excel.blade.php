
  @extends('principal')


@section('content')

<!DOCTYPE html>
<html>
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
    <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>



 </head>
  <body style=" background-size:100% 100%;">

  <br />

  
  
  <form action="{{Route('productos')}}" method="POST">
               @csrf
               <button type="submit"   style="width:15%;   padding-left: 90em;	top: 10%;  padding: .4em 1em; ">Productos</button>
  </form>  





  <div class="container">
   <h3>Importación de pedidos para la producción </h3>
    <br />
   @if(count($errors) > 0)
    <div class="alert alert-danger">
     Upload Validation Error<br><br>
     <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
     </ul>
    </div>
   @endif

   @if(isset($success))
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $success }}</strong>
   </div>
   @endif

   <form method="post" enctype="multipart/form-data" action="{{ url('/importar_clase') }}">
   @csrf
<h4>Fecha de pedido</h4>
   <input type="date" value="" onKeyDown="copiar('fecha_fin','fechafin');" name="fecha_fin"
                        id="fecha_fin" style="width:150px;" class="form-control mr-sm-2" placeholder="Fecha final"
                        onchange="obtenerFechaFin(this)" required>
    <div class="form-group">
     <table class="table">
      <tr>
       <td width="40%"><label>Select File for Upload</label></td>
       <td width="30">
        <input type="file" name="select_file" id="select_file" />
       </td>
       <td width="30%" >
        <input type="submit" name="upload" class="btn btn-primary" value="Upload">
       </td>
      </tr>
      <tr>
       <td width="40%" ></td>
       <td width="30"><span class="text-muted">.xls, .xslx</span></td>
       <td width="30%"></td>
      </tr>
     </table>
     
    </div>
   </form>

    <div class="container">
      <br />
      <div class="panel panel-default">
        <div class="panel-heading">

          <form action=  "{{Route('buscar')}}" method= "POST" class="form-inline" style="margin-bottom:0px;">
          @csrf
          <input name="txt_name"  class="form-control mr-sm-2"  placeholder="Nombre" style="width:150px;">
          <button class="btn-dark form-control mr-sm-2" type="submit">
          <span>
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg>
          </span>
          </button>
          </form>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            @csrf
            <table id="editable" class="table table-striped table-secondary table-bordered border-primary ">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Edad</th>
                </tr>
              </thead>
              <tbody>

                  <?php $c = 0;?>

               
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

<script type="text/javascript">
$(document).ready(function(){
   
  $.ajaxSetup({
    headers:{
      'X-CSRF-Token' : $("input[name=_token]").val()
    }
  });

  $('#editable').Tabledit({
    url:'{{ route("tabledit.action") }}',
    method : 'POST',
    dataType:"json",
    columns:{
      identifier:[0, 'id'],
      editable:[[1, 'first_name'], [2, 'last_name'], [3, 'gender']]
    },
    restoreButton:false,

    onSuccess:function(data, textStatus, jqXHR){
      if(data.action == 'delete'){
        $('#'+data.id).remove();}
    }

  });

});  
</script>

@endsection
 </body>
</html>