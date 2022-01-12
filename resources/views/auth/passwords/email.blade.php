<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Bootstrap CSS CDN -->
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
       <!-- Our Custom CSS -->
       <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
<script src="/jquery.js"></script>
<script src="/build/jquery.datetimepicker.full.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}" />



<div style="  display: flex;justify-content: center;align-items: center;height: 100%;
 background: linear-gradient(0deg, rgba(9,14,7,1) 6%, rgba(25,31,21,1) 28%, rgba(85,64,59,1) 51%, rgba(139,87,101,1) 75%,rgba(231,139,188,1) 100%);"   > 
<div style=" -webkit-background-size: cover;  -moz-background-size: cover;  background-repeat:no-repeat;  -o-background-size: cover;  background-size: cover;  width: 400px;height:220px; background-size: 100% 100%;" >





<div class="card-header" style="color:white;text-align:center;">  <strong>Recuperación de Contraseña</strong></div>
   @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
<div class="card-body" >
 

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group row">
            <label for="email"  style="padding-left:0px;">  <strong>Correo Electrónico</strong> </label>
                <input style="text-align:center;border-radius:20px;"   id="email" type="email" class="  form-control @error('email') is-invalid @enderror"
                 name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Escriba correo"  autofocus >

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
                <button type="submit" class="form-control btn btn-login ">
                      Enviar link de recuperación de contraseña
                </button>
    </form>
</div>





</div>
</div>    