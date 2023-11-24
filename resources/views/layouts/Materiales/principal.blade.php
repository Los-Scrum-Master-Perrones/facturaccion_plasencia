<html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Facturación Plasencia</title>


    <!-- Our Custom CSS -->

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins.bundle.css') }}">
    @livewireStyles
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">


    <style>
        /* admite una sola linea en una fila */
        tr {
            width: 1% !important;
            white-space: nowrap !important;
        }

        /* Quita  subrayado con puntos en estas etiquetas */
        abbr[title] {
            border-bottom: none !important;
            cursor: inherit !important;
            text-decoration: none !important;
        }

        .oscurecer_contenido {
            justify-content: center;
            align-items: center;
            background-color: black;
            top: 0px;
            left: 0px;
            z-index: 9999;
            width: 100%;
            height: 100%;
            opacity: 0.5;
        }
    </style>

</head>

<!-- <body    style="background: linear-gradient(0deg, rgba(9,14,7,1) 6%, rgba(25,31,21,1) 28%, rgba(85,64,59,1) 51%, rgba(139,87,101,1) 75%,rgba(231,139,188,1) 100%);"> -->

<body id="bos"
    style="background: url({{ 'http://' . $_SERVER['HTTP_HOST'] . '/fondoRocky.jpg' }}) center center no-repeat;    background-size:100% 100%;">

    @yield('content')

    <div class="modal fade" id="modal_cerrarsesion" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity:.9;background:#212529;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Cerrar Sesión </h5>
                </div>
                <div class="modal-body">
                    ¿Esta seguro(a) de que quiere cerrar sesión?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <span>Cancelar</span>
                    </button>
                    <button
                        onclick="event.preventDefault();
           document.getElementById('logout-form').submit();"
                        class="btn btn-success">
                        <span>Cerrar Sesión</span>
                    </button>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>

    <script>
        $(document).ready(function() {
            $('.mi-selector').select2();

        });
    </script>

    <script>
        $(document).ready(function() {
            $('.todas_item').select2();
            $('#todas_ordenes').select2();
            $('#todas_marcas').select2();
            $('#todas_nombres').select2();
            $('#todas_capas').select2();
            $('#todas_vitolas').select2();
            $('#todas_tipo_empaque').select2();
            $('#todas_tipo_empaques').select2();
            $('#todas_ordenes_sistema').select2();
            $('.mi-selector').select2();
        });
    </script>

    <script>
        window.addEventListener('abrir_faltalte', event => {
            $("#productos_faltantes").modal('show');
        })
        window.addEventListener('cerrar_faltalte', event => {
            $("#productos_faltantes").modal('hide');
        })
        window.addEventListener('abrir_modal_eliminar', event => {
            $("#modal_eliminar_tabla_progra").modal('show');
        })
        window.addEventListener('cerrar_modal_eliminar', event => {
            $("#modal_eliminar_tabla_progra").modal('hide');
        })
        window.addEventListener('cerrar_eliminar_datelles_clase', event => {
            $("#modal_ver_detalle_producto").modal('hide');
        })
    </script>

    @livewireScripts

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>


    <script src="{{ asset('js/datatables.js') }}"></script>
    <script src="{{ asset('js/selectmultiple.js') }}"></script>
    @stack('scripts')


    <script>

        const Toast2 = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        window.addEventListener('error_general', event => {
            Toast2.fire({
                icon: event.detail.icon,
                title: event.detail.errorr
            })
        })

    </script>

</body>
