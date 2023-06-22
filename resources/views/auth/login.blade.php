<title> Asistencia Tabacos de Oriente</title>
<link rel="shortcat icon" href="favicon.ico">


<html>
<head>
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
</head>

<body style="background: url('fondologin.jpg') center center no-repeat;    background-size:100% 100%;">
    <div style="  display: flex;justify-content: center;align-items: center;height: 100%;">
        <div style=" -webkit-background-size: cover;  -moz-background-size: cover;  background-repeat:no-repeat;  -o-background-size: cover;  background-size: cover;  width: 350px;height:350px; background-size: 100% 100%;">



            <div style="text-align:center;">
                <img src="pblanca.png" style="color:yellow;" />
            </div>
            <br>

            <form method="POST" action="{{ route('login') }}" class="go-right">
                @csrf

                <div>
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" style="color:black;" required>
                    <label for="email"><span style="margin-top:5px;color:white;"> CORREO</span></label>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <br>



                <div>
                    <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required>
                    <label for="password"><span style="margin-top:5px;"> CONTRASEÑA</span></label>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row">

                    <div class="col">
                    </div>

                    <div class="col">
                        <a type="checkbox" class="input-group-text" onclick="mostrarContrasena()" style=" background: transparent;color:#fff;outline: none;border: none;cursor:pointer;width:auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16" id="iconovisible" style="position:absolute;color:">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="white" class="bi bi-eye-slash-fill" viewBox="0 0 16 16" id="icononovisible">
                                <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.027 7.027 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.088z" />
                                <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6l-12-12 .708-.708 12 12-.708.707z" />
                            </svg>
                            &nbsp; Mostrar Contraseña
                        </a>
                    </div>

                    <div class="col">
                    </div>

                </div>




                <br>




                <button type="submit" class="form-control btn btn-login ">
                    <strong>{{ __('INGRESAR') }}</strong>
                </button>


                <div style="text-align:center">
                    @if (Route::has('password.request'))
                    <a class="btn" style=" color: #fff;" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu Contraseña?') }}
                    </a>
                    @endif
                </div>
            </form>

        </div>
    </div>
</body>

<script>
    function mostrarContrasena() {
        var tipo = document.getElementById("password");
        var iconovisible = document.getElementById("iconovisible");
        var icononovisible = document.getElementById("icononovisible");
        if (tipo.type == "password") {
            tipo.type = "text";
            icononovisible.style.visibility = "hidden";
            iconovisible.style.visibility = "inherit";
        } else {
            tipo.type = "password";
            icononovisible.style.visibility = "inherit ";
            iconovisible.style.visibility = "hidden";
        }

    }

</script>

</html>
