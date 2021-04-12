




<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Live Table Edit Delete Mysql Data using Tabledit Plugin in Laravel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>            
   
   
    <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>
  
<!-- Bootstrap CSS CDN -->
<link rel="stylesheet"
    href="{{ URL::asset('https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css') }}"
    integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<!-- Our Custom CSS -->
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>

  
  </head>
  <body>
    <div class="container">
      <br />
      <h3 style="	text-align:center; font-size:35px; font:bold; width:1160px;" >Inventario de productos Plasencia</h3>
      <br />
      
      <div class="panel panel-default">
        <div class="panel-heading">



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
      editable:[ [1, 'Marca'], [2, 'Nombre'],[3,'Vitola'],[4,'Orden'],[5,'Tipo de empaque']]
    },
    restoreButton:false,

    onSuccess:function(data, textStatus, jqXHR){
      if(data.action == 'delete'){
        $('#'+data.id).remove();}
    }

  });

});  
</script>
          <form action=  "{{Route('buscar')}}" method= "POST" class="form-inline">
          @csrf
          <input name="vitolabuscar" id="vitolabuscar" class="form-control mr-sm-2"  placeholder="Vitola" style="width:150px;">
          <button class="btn-dark" type="submit">
          <span>
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
          <path d="11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg>
          </span>
          </button>
           </form>

           <button style="text-align: right;"   data-toggle="modal" data-target="#modal_nuevoproducto">Nuevo producto</button>
        
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            @csrf
            <table id="editable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Marca</th>
                  <th>Nombre</th>
                  <th>Vitola</th>
                  <th>Tipo de empaque</th>
                  <th>Detalles</th>

                </tr>
              </thead>
              <tbody>
                @foreach($productos as $producto)
                <tr>
                  <td>{{$producto->item}}</td>
                  <td>{{$producto->marca}}</td>
                  <td>{{$producto->nombre}}</td>
                  <td>{{$producto->vitola}}</td>
                  <td>{{$producto->tipo_empaque}}</td>
                  <td><button>Agregar detalle</td></button>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- <script src="{{ asset('js/app.js') }}" ></script> -->
  </body>
  
</html>





<!-- INICIO DEL MODAL NUEVO MOLDE -->

<form action="{{Route('nuevo_producto')}} "   method="POST"  >
    <div class="modal fade" role="dialog" id="modal_nuevoproducto" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
        style="opacity:.9;background:#212529;width=800px;">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="opacity:.9;background:#212529;width=80%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-size:20px; width:3000px; text-align:center; font:bold" class="" id="staticBackdropLabel">Agregar producto</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                
                    <div class="card-body">
                   
                   
                    

                        <div class="row">
                        <div class="mb-3 col">
                                <label style="font-size:16px"for="txt_figuraytipo" class="form-label">Item</label>
                                <input   name="item" id="item"style="font-size:16px" class="form-control" required
                                    type="text"  autocomplete="off">
                            </div>
                            <div class="mb-3 col">
                                <label style="font-size:16px"for="txt_figuraytipo" class="form-label">Capa</label>
                                <input   name="capa" id="capa"style="font-size:16px" class="form-control" required
                                    type="text"  autocomplete="off">
                            </div>

                            <div class="mb-3 col">
                                <label  style="font-size:16px"for="txt_vitola" class="form-label">Marca</label>
                                <input   name="marca" id="marca"style="font-size:16px" class="form-control" required
                                    type="text"  autocomplete="off"> </div>


                        </div>

                        <div class="row">



                        <div class="mb-3 col">
                                <label for="txt_total"style="font-size:16px" class="form-label">Nombre</label>
                                <input   name="nombre" id="nombre"style="font-size:16px" class="form-control" required
                                    type="text"  autocomplete="off">  </div>
                            <div class="mb-3 col">
                                <label style="font-size:16px" for="txt_buenos" class="form-label">Vitola</label>
                                <input   name="vitola" id="vitola"style="font-size:16px" class="form-control" required
                                    type="text"  autocomplete="off">  </div>
                                    <div class="mb-3 col">
                                <label style="font-size:16px" for="txt_malos" class="form-label">Tipo de empaque</label>
                                <input   name="tipo" id="tipo"style="font-size:16px" class="form-control" required
                                    type="text"  autocomplete="off">  </div>

                        </div>


                        </div>

                        <div class="row">
                            <div class="mb-3 col">
                                <input type="checkbox" name="cello" id="cello"style="font-size:20px" value="si">
                                <label  style="font-size:16px" for="cello" class="form-label">Cello</label>
                                </div>
                                 <div class="mb-3 col">
                               
                                <input type="checkbox" name="anillo" id="anillo"style="font-size:20px" value="si"> 
                                <label  style="font-size:16px" for="anillo" class="form-label">Anillo</label>
                                </div>
                                 <div class="mb-3 col">
                                
                                <input type="checkbox" name="upc" id="upc"style="font-size:20px" value="si"> 
                                <label  style="font-size:16px" for="upc" class="form-label">UPC</label>
                                </div>
                           

                    </div>
                </div>

                <div class="modal-footer">
                    <button style=" background: #b39f64; color: #ecedf1;" type="button" class=" btn-info-claro "
                        data-dismiss="modal">
                        <span style="font-size:16px">Cancelar</span>
                        @csrf
                    </button>
                    <button class="submit" >
                        <span style="font-size:16px">Guardar</span>
                    </button>


                </div>
            </div>
        </div>
    </div>

</form>
<!-- FIN DEL MODAL NUEVO MOLDE -->