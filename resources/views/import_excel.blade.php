<!DOCTYPE html>
<html>
 <head>
  <title>Import Excel File in Laravel HOLA MELVIN</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />

<<<<<<< Updated upstream
  <form action="{{Route('productos')}}" method="POST">
                @csrf
    <button type="submit"  class="btn-info" style="width:100%;" >Productos</button> 
       </form>
=======

>>>>>>> Stashed changes
  
  <form action="{{Route('productos')}}" method="POST">
               @csrf
               <button type="submit"   >Productos</button>
  </form>  





  <div class="container">
   <h3 >Import Excel File in Laravel </h3>
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

   <form method="get" enctype="multipart/form-data" action="{{ url('/import') }}">
    {{ csrf_field() }}
    <button>hola</button>
    @csrf
   </form>
   
   <br />
   <div class="panel panel-default">
    <div class="panel-heading">
     <h3 class="panel-title">Customer Data</h3>
    </div>
    <div class="panel-body">
     <div class="table-responsive">
      <table class="table table-bordered table-striped">
       <tr>
        <th>Customer Name</th>
        <th>Gender</th>
        <th>Address</th>
        <th>City</th>
        <th>Postal Code</th>
        <th>Country</th>
       </tr>
      </table>
     </div>
    </div>
   </div>
  </div>
 </body>
</html>