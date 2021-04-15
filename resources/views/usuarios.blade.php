@extends('principal')


@section('content')
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

<!-- Libreria de las alertas -->
<script src= "{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css') }}">

  
  </head>

<button type="button" class=" btn-info float-right"   data-toggle="modal" data-target="#modal_agregar_usuarios"  style="margin-right: 10px; margin-bottom: 10px;">
      <span> Agregar Usuarios</span>
  </button>

<!-- INICIO DEL TABLA USUARIOS -->
<table class="table table-striped table-secondary table-bordered border-primary ">
        <thead class= "table-dark">
        <tr>
            <th scope="col">Código</th>
            <th scope="col">Nombre</th>
            <th scope="col">Correo</th>  
            <th scope="col">Rol</th>  
            <th scope="col">Editar</th>            
         </thead>
         <tbody>
        
         @foreach($users as $usuario)
            <tr> 
                  <td>{{$usuario->codigo}}</td>
                  <td>{{$usuario->name}}</td>
                  <td>{{$usuario->email}}</td>
                  <?php if($usuario->rol == 0): ?>
                  <td>Administrador</td>
                  <?php endif; ?>

                  <?php if($usuario->rol == 1): ?>
                  <td>Usuario</td>
                  <?php endif; ?>
                 

                  <td style="padding:0px; text-align:center;    vertical-align: inherit;" >
                  <a data-toggle="modal" data-target="#modal_editar_usuario" onclick ="datos_modal({{ $id_usuario_basico = $usuario->id }})">
                  <svg xmlns="http://www.w3.org/2000/svg" width=25 height="25" fill="black" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg>
                  </a>

                  <a data-toggle="modal" data-target="#modal_eliminar_usuario" onclick ="datos_modal_eliminar({{ $id_usuario_basicoE = $usuario->id }})">
                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="black" class="bi bi-x-square" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                  </svg>
                  </a>



                  <a data-toggle="modal" data-target="#modal_cambiar_contrasenia" onclick ="datos_modal_contra({{ $id_usuario_contrasenia = $usuario->id }})">
                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="black" class="bi bi-key" viewBox="0 0 16 16">
                  <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                  <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                </svg>
                </a>
                  
            </td>

            
             </tr>
             
            @endforeach
           
          <tbody>
    </table>
<!-- FIN DEL TABLA USUARIOS -->




<!-- INICIO MODAL ELMINAR USUARIO -->
<form id = "formulario_mostrarE" name = "formulario_mostrarE" action = "{{Route('eliminar_usuario')}}"  method="POST">

@csrf
<?php use App\Http\Controllers\UserController; ?>
<div hidden>{{$id_usuario_basicoE=0}}</div>
  
<input name = "id_usuarioE" id="id_usuarioE" value ="" hidden />

<div class="modal fade" id="modal_eliminar_usuario" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
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


<!-- FIN MODAL ELMINAR USUARIO -->
<script type="text/javascript">

    function eliminar_usuario(){ 
      
      var theFormE = document.forms['formulario_mostrarE'];

      toastr.success( 'El usuario se eliminó correctamente','BIEN',{"progressBar": true,"closeButton": false} );
      theFormE.addEventListener('submit', function (event) {
    });
 }

  </script>

















<!-- INICIO DEL MODAL AGREGAR USUARIO -->
<form   method="POST" action="{{ route('register') }}" id ="FormRegistroUsuario" name="FormRegistroUsuario">
@csrf
<div class="modal fade" role="dialog" id="modal_agregar_usuarios" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;width=800px;">
  <div class="modal-dialog modal-dialog-centered modal-lg"  style="opacity:.9;background:#212529;width=80%">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar Usuarios</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" ></button>
      </div>
     
      <div class="modal-body">
          <div class="card-body">  
            

      <div class="row">
        <div class="mb-3 col">
        <label for="name" class="form-label">Nombre Completo</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
 </div>

        <div class="mb-3 col">
        <label for="txt_correo_electronico" class="form-label">Correo Electrónico</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off">
          @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
 </div>
      </div>

      <div class="row">
        <div class="mb-3 col">
        <label for="codigo" class="form-label">Código</label>
        <input id="codigo" type="codigo" class="form-control @error('codigo') is-invalid @enderror" name="codigo" value="{{ old('codigo') }}" required autocomplete="off">
        @error('codigo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
       </div>

        <div class="mb-3 col">
        <label for="rol" class="form-label">Rol</label>
        <select id="rol" type="rol" class="form-control @error('rol') is-invalid @enderror" name="rol" value="{{ old('rol') }}" required autocomplete="rol">
        <option value =  "0" >Administrador</option>
        <option value =  "1" >Usuario</option>
        </select> 
        @error('rol')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
      </div>


      <div class="row" >
        <div class="mb-3 col">
        <label for="password" class="form-label">Contraseña</label>

        <div class="row"style="margin-left:0px;    margin-right: 0px;">
        <div class="input-group ">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
 <a type="button"  class="input-group-text" onclick="mostrarContrasena()" >
      
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16" id="iconovisible" style="position:absolute;">
  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
</svg>
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16" id="icononovisible"> 
  <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.027 7.027 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.088z"/>
  <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6l-12-12 .708-.708 12 12-.708.707z"/>
</svg>
</a>
        </div>
        </div>
     
      </div>

        

        <div class="mb-3 col">
        <label for="password-confirm" class="form-label">Confirmación contraseña</label>
        <div class="row"style="margin-left:0px;    margin-right: 0px;">
        
        <div class="input-group ">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
         <a type="button" onclick="mostrarConfirmacion()"  class="input-group-text">
      
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16" id="iconovisibleC" style="position:absolute;">
<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
<path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
</svg>
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16" id="icononovisibleC"> 
<path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.027 7.027 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.088z"/>
<path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6l-12-12 .708-.708 12 12-.708.707z"/>
</svg>
</a>
       
       
        </div>
        </div>
        </div>
      </div>   




</div>
</div>

<div class="modal-footer" >
        <button style=" background: #b39f64; color: #ecedf1;" type="button" class=" btn-info-claro " data-dismiss="modal" >
            <span>Cancelar</span>
        </button>
        <button  class=" btn-info " onclick="v_agregarusuario()" >
            <span>Guardar</span>
        </button>

        
      </div>
    </div>
  </div>
</div>

</form>
<!-- FIN DEL MODAL AGREGAR MOLDE-->

<script>
  function mostrarContrasena(){
      var tipo = document.getElementById("password");
      var iconovisible = document.getElementById("iconovisible");
      var icononovisible = document.getElementById("icononovisible");



      if(tipo.type == "password"){
          tipo.type = "text";      
          icononovisible.style.visibility= "hidden";
      iconovisible.style.visibility= "inherit";
      }else{
          tipo.type = "password";
          icononovisible.style.visibility= "inherit ";
        iconovisible.style.visibility= "hidden";
      }
      
  }

  
  
  function mostrarConfirmacion(){
      var tipo = document.getElementById("password-confirm");
      var iconovisible = document.getElementById("iconovisibleC");
      var icononovisible = document.getElementById("icononovisibleC");
      if(tipo.type == "password"){
          tipo.type = "text";      
          icononovisible.style.visibility= "hidden";
      iconovisible.style.visibility= "inherit";
      }else{
          tipo.type = "password";
          icononovisible.style.visibility= "inherit ";
        iconovisible.style.visibility= "hidden";
      }
  }

      function nueva_contrasena(){
      var tipo = document.getElementById("contraseniaA");
      var iconovisible = document.getElementById("iconovisiblen");
      var icononovisible = document.getElementById("icononovisiblen");
      if(tipo.type == "password"){
          tipo.type = "text";      
          icononovisible.style.visibility= "hidden";
      iconovisible.style.visibility= "inherit";
      }else{
          tipo.type = "password";
          icononovisible.style.visibility= "inherit ";
        iconovisible.style.visibility= "hidden";


      }}


      function c_nueva_contrasena(){
      var tipo = document.getElementById("confirmacion_contraseniaA");
      var iconovisible = document.getElementById("iconovisiblecn");
      var icononovisible = document.getElementById("icononovisiblecn");
      if(tipo.type == "password"){
          tipo.type = "text";      
          icononovisible.style.visibility= "hidden";
      iconovisible.style.visibility= "inherit";
      }else{
          tipo.type = "password";
          icononovisible.style.visibility= "inherit ";
        iconovisible.style.visibility= "hidden";


      }

     


      }


      
  




</script>

 <script type="text/javascript">

    function v_agregarusuario(){ 
        var v_contrasenia = document.getElementById('password').value;
        var v_confirmacion_contrasenia = document.getElementById('password-confirm').value;
        var v_codigo = document.getElementById('codigo').value;
        var v_nombre = document.getElementById('name').value;
        var v_correo = document.getElementById('email').value;
  
  
  var usuario = '<?php echo json_encode($users);?>';
  var usuarios = JSON.parse(usuario);
   var unico_codigo = 0;
   var unico_nombre = 0;
   var unico_correo = 0;

  for (var i = 0; i < usuarios.length; i++) {   
    if(usuarios[i].codigo.toLowerCase() === v_codigo.toLowerCase()){ 
      unico_codigo++;
      } 
    if(usuarios[i].name.toLowerCase() === v_nombre.toLowerCase()){ 
      unico_nombre++;
      } 
    if(usuarios[i].email.toLowerCase() === v_correo.toLowerCase()){ 
      unico_correo++;
      } 
  }
        
if(v_confirmacion_contrasenia != v_contrasenia){
  toastr.error( 'Las contraseñas no coinciden ','ERROR',{"progressBar": true,"closeButton": false });
    event.preventDefault();
}else  if(unico_codigo> 0){
    toastr.error( 'Este código ya existe','ERROR',{"progressBar": true,"closeButton": false,"preventDuplicates": true
    , "preventOpenDuplicates": true} );
    event.preventDefault();

  }else if(unico_nombre> 0){
    toastr.error( 'Este nombre ya existe','ERROR',{"progressBar": true,"closeButton": false,"preventDuplicates": true
    , "preventOpenDuplicates": true} );
    event.preventDefault();

  }else if(unico_correo> 0){
    toastr.error( 'Este correo ya existe','ERROR',{"progressBar": true,"closeButton": false,"preventDuplicates": true
    , "preventOpenDuplicates": true} );
    event.preventDefault();

  }else{
  toastr.success( 'El usuario se registró correctamente','BIEN',{"progressBar": true,"closeButton": false} );
    theForm.addEventListener('submit', function (event) {
    });
       document.getElementById('password').value =" ";
       document.getElementById('password-confirm').value = " ";
       document.getElementById('codigo').value= " ";
      document.getElementById('name').value= " ";
       document.getElementById('email').value = " ";
}
 }
   </script>


<!-- INICIO MODAL CAMBIAR CONTRASENIA -->

<form id = "formulario_mostrar_email" name = "formulario_mostrar_email" action =  "{{Route('actualizar_usuario_contrasenia')}}" method= "POST">
<div hidden>{{$id_usuario_contrasenia=0}}</div>
<input name = "txt_id_usuario" id="txt_id_usuario" value =" " hidden />
@csrf
<div class="modal fade" id="modal_cambiar_contrasenia" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
  <div class="modal-dialog modal-dialog-centered modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Cambio de contraseña de <strong><input value ="" id="txt_empleado" name= "txt_empleado" style="border:none;"></strong></h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
     
      <div class="row">
        <div class="mb-3 col">
        <label for="emailcontra" class="form-label">Correo</label>
        <input class="form-control @error('password') is-invalid @enderror" id="emailcontra" name = "emailcontra"   placeholder="Ingresa nuevo correo" required  autocomplete= "off">        
        </div>       
      </div>
      
     
      <div class="row">
        <div class="mb-3 col">
        <label for="contraseniaA" class="form-label">Nueva Contraseña</label>
        
       
        <div class="row"style="margin-left:0px;    margin-right: 0px;">
        <div class="input-group ">
        <input class="form-control @error('password') is-invalid @enderror" id="contraseniaA" name="contraseniaA" type="password" placeholder="Ingresa contraseña"  minLength="5" maxLength="50" autocomplete= "off" required>        
         @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
 <a type="button"  class= "input-group-text" onclick="nueva_contrasena()" >
      
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16" id="iconovisiblen" style="position:absolute;">
  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
</svg>
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16" id="icononovisiblen"> 
  <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.027 7.027 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.088z"/>
  <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6l-12-12 .708-.708 12 12-.708.707z"/>
</svg>
</a>
        </div>
        </div>
        </div>

        <div class="mb-3 col">
        <label for="confirmacion_contraseniaA" class="form-label">Confirmación contraseña</label>
         <div class="row"style="margin-left:0px;    margin-right: 0px;">
        <div class="input-group ">
        <input class="form-control" id="confirmacion_contraseniaA" type="password" name="confirmacion_contraseniaA" placeholder="Confirma tu contraseña" autocomplete= "off"  minLength="5" maxLength="50" required>        
         @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
 <a type="button"  class="input-group-text" onclick="c_nueva_contrasena()" >
      
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16" id="iconovisiblecn" style="position:absolute;">
  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
</svg>
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16" id="icononovisiblecn"> 
  <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.027 7.027 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.088z"/>
  <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6l-12-12 .708-.708 12 12-.708.707z"/>
</svg>
</a>
        </div>
        </div>
        </div>
      </div>
      </div>
      <div class="modal-footer" >
        <button style=" background: #b39f64; color: #ecedf1;" type="button" class=" btn-info-claro " data-dismiss="modal" >
            <span>Cancelar</span>
        </button>
        <button  class=" btn-info " onclick="validar_actualizar_contrasenia()">
            <span>Cambiar</span>
        </button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- FIN MODAL CAMBIAR CONTRASENIA -->


<script type="text/javascript">

    function validar_actualizar_contrasenia(){ 
        var contraseniaA = document.getElementById('contraseniaA').value;
        var confirmacion_contraseniaA = document.getElementById('confirmacion_contraseniaA').value;        
        var correo = document.getElementById('emailcontra').value;
        var theForm = document.forms['formulario_mostrar_email'];
        
  var usuario = '<?php echo json_encode($users);?>';
  var usuarios = JSON.parse(usuario);
   var unico_correo = 0;

  for (var i = 0; i < usuarios.length; i++) {     
    if(usuarios[i].email.toLowerCase() === correo.toLowerCase()){ 
      unico_correo++;
      }
  }
  
if(contraseniaA != confirmacion_contraseniaA ){
    toastr.error( 'Las contrasenias no coinciden','ERROR',{"progressBar": true,"closeButton": false,"preventDuplicates": true
    , "preventOpenDuplicates": true} );
    event.preventDefault();
  }else if(theForm.valid()){
  toastr.success( 'Las credenciales se actualizaron correctamente','BIEN',{"progressBar": true,"closeButton": false} );
    theForm.addEventListener('submit', function (event) {
    });
} 
}
  </script>





<!-- INICIO DEL MODAL EDITAR USUARIO -->

<form id = "formulario_mostrar" name = "formulario_mostrar" action =  "{{Route('actualizar_usuario')}}" method= "POST">

<div hidden>{{$id_usuario_basico=0}}</div>
  
<input name = "id_usuario" id="id_usuario" value =" " hidden />


<div class="modal fade" role="dialog" id="modal_editar_usuario" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;width=800px;">
  <div class="modal-dialog modal-dialog-centered modal-lg"  style="opacity:.9;background:#212529;width=80%">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar Usuario</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" ></button>
      </div>
     
      <div class="modal-body">
          <div class="card-body">  
            

      <div class="row">
        <div class="mb-3 col">
        <label for="txt_nombre_completo" class="form-label">Nombre Completo</label>        
        <input type="text" class="form-control" id="txt_nombre_completo" name="txt_nombre_completo" placeholder="Ingresa el nombre completo" required > 
        </div>
      </div>

      <div class="row">
        <div class="mb-3 col">
        <label for="txt_codigo" class="form-label">Código</label>
        <input class="form-control" type= "number" id="txt_codigo" name="txt_codigo" placeholder="Ingresa código de empleado" minLength="1" maxLength="10" required>
        </div>

        <div class="mb-3 col">
        <label for="txt_sucursales" class="form-label">Rol</label>
  
  <select id="txt_rol" type="rol" class="form-control" name="txt_rol" required autocomplete="rol">
        <?php if($usuario->rol == 0): ?>
        <option value =  "0" >Administrador</option>
        <option value =  "1" >Usuario</option>
        <?php endif; ?>

        <?php if($usuario->rol == 1): ?>
        <option value =  "1" >Usuario</option>
        <option value =  "0" >Administrador</option>
        <?php endif; ?>
       
        </select> 
        </div>
      </div>       
</div>
</div>
      <div class="modal-footer" >
        <button style=" background: #b39f64; color: #ecedf1;" type="button" class=" btn-info-claro " data-dismiss="modal" >
            <span>Cancelar</span>
            @csrf
        </button>
        <button  class=" btn-info " onclick="validar_actualizar_usuario()" >
            <span>Guardar</span>
        </button>
      </div>
    </div>
  </div>
</div>

</form>
<!-- FIN DEL MODAL EDITAR USUARIO -->

<script type="text/javascript">

    function validar_actualizar_usuario(){ 
        var v_id_planta = document.getElementById('txt_sucursales').value;
        var v_codigo = document.getElementById('txt_codigo').value;
        var v_nombre = document.getElementById('txt_nombre_completo').value;
        var v_correo = document.getElementById('txt_correo_electronico').value;  

        
 if(unico_codigo> 0){
    toastr.error( 'Este código ya existe','ERROR',{"progressBar": true,"closeButton": false,"preventDuplicates": true
    , "preventOpenDuplicates": true} );
    event.preventDefault();

  }else if(unico_nombre> 0){
    toastr.error( 'Este nombre ya existe','ERROR',{"progressBar": true,"closeButton": false,"preventDuplicates": true
    , "preventOpenDuplicates": true} );
    event.preventDefault();

  }else if(unico_correo> 0){
    toastr.error( 'Este correo ya existe','ERROR',{"progressBar": true,"closeButton": false,"preventDuplicates": true
    , "preventOpenDuplicates": true} );
    event.preventDefault();

  }else{
  toastr.success( 'El usuario se registró correctamente','BIEN',{"progressBar": true,"closeButton": false} );
    theForm.addEventListener('submit', function (event) {
    });
}
 }
  </script>













<script type="text/javascript">

    function datos_modal(id){ 
var datas = '<?php echo json_encode($users);?>';
var data = JSON.parse(datas); 

for (var i = 0; i < data.length; i++) {  
  if(data[i].id === id){  
     document.formulario_mostrar.txt_nombre_completo.value = data[i].name;
     document.formulario_mostrar.txt_codigo.value = data[i].codigo;
     document.formulario_mostrar.id_usuario.value = data[i].id;     
     document.formulario_mostrar.txt_rol.value = data[i].rol;     
    }
}
}   
</script>

<script type="text/javascript">

    function datos_modal_contra(id){ 
var datas = '<?php echo json_encode($users);?>';
var data = JSON.parse(datas); 

for (var i = 0; i < data.length; i++) {  
  if(data[i].id === id){  
     document.formulario_mostrar_email.emailcontra.value = data[i].email; 
     document.formulario_mostrar_email.txt_empleado.value = data[i].name; 
     document.formulario_mostrar_email.txt_id_usuario.value = data[i].id; 
    }
}
}   
</script>




<script type="text/javascript">
    function datos_modal_eliminar(id){ 
var datas = '<?php echo json_encode($users);?>';

var data = JSON.parse(datas);
 

for (var i = 0; i < data.length; i++) {  
  if(data[i].id === id){  
     document.formulario_mostrarE.id_usuarioE.value = data[i].id;
     document.formulario_mostrarE.txt_usuarioE.value = data[i].name;
  
     
    }
}

    }   
</script>








@endsection