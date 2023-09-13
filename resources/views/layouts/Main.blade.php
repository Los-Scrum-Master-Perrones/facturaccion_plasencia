<html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Facturación Plasencia</title>

    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}" />

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/cssadicional.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.3/dist/css/tom-select.css" rel="stylesheet">

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

    <link rel="stylesheet" href="{{ asset('css/selectmultiple.css') }}">

</head>

<!-- <body    style="background: linear-gradient(0deg, rgba(9,14,7,1) 6%, rgba(25,31,21,1) 28%, rgba(85,64,59,1) 51%, rgba(139,87,101,1) 75%,rgba(231,139,188,1) 100%);"> -->

<body id="bos" style="background: url({{ "http://" . $_SERVER["HTTP_HOST"] . "/fondologin.jpg"}}) center center no-repeat;    background-size:100% 100%;">



    @yield('content')
    <br><br><br><br><br>
    <div class="all" style="padding-bottom: 10px">
        <div @if (auth()->user()->rol == -1)
            class="lefter"
            @else
            class="lefter3"
            @endif>
            <button type="submit" class="buttonsubmit" data-toggle="modal" data-target="#modal_cerrarsesion">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-power"
                    viewBox="0 0 16 16">
                    <path d="M7.5 1v7h1V1h-1z" />
                    <path
                        d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z" />
                </svg>
            </button>
            <div class="text">CERRAR</div>
        </div>

        @if (auth()->user()->rol != -1)


        <div class="lefter2">
            <form action="{{Route('usuarios')}}" method="GET">
                @csrf
                <?php if (  auth()->user()->rol == 0): ?>
                <button type="submit" class="buttonsubmit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white"
                        class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        <path fill-rule="evenodd"
                            d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" />
                        <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                    </svg>
                </button>
                <div class="text">USUARIOS</div>
                <?php else: ?>
                <button type="submit" class="buttonsubmit" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="gray" class="bi bi-people-fill"
                        viewBox="0 0 16 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        <path fill-rule="evenodd"
                            d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" />
                        <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                    </svg>
                </button>
                <div class="text" style="color:gray;">USUARIOS</div>
                <?php endif; ?>
            </form>
        </div>


        <div class="lefter">
            <form action="{{Route('productos')}}" method="GET">
                @csrf
                <?php if (  auth()->user()->rol == 0 || auth()->user()->rol == 2 || auth()->user()->rol == 1): ?>
                <button type="submit" class="buttonsubmit" aria-placeholder="Hola">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-card-list"
                        viewBox="0 0 16 16">
                        <path
                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                        <path
                            d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                    </svg>
                </button>
                <div class="text">PRODUCTOS</div>
                <?php else: ?>
                <button type="submit" class="buttonsubmit" aria-placeholder="Hola" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="gray" class="bi bi-card-list"
                        viewBox="0 0 16 16">
                        <path
                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                        <path
                            d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                    </svg>
                </button>
                <div class="text" style="color:gray;">PRODUCTOS</div>
                <?php endif; ?>
            </form>
        </div>
        @endif
        <div class="left">
            <form action="{{Route('pendiente')}}" method="GET">
                @csrf
                @if(auth()->user()->rol == 0 || auth()->user()->rol == 2 || auth()->user()->rol == 1)
                <button type="submit" class="buttonsubmit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-archive"
                        viewBox="0 0 16 16">
                        <path
                            d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                    </svg>
                </button>
                <div class="text">PENDIENTE</div>
                @elseif (auth()->user()->rol == -1)

                <button type="submit" class="buttonsubmit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-archive"
                        viewBox="0 0 16 16">
                        <path
                            d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                    </svg>
                </button>
                <div class="text">PENDIENTE</div>

                @else

                <button type="submit" class="buttonsubmit" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="gray" class="bi bi-archive"
                        viewBox="0 0 16 16">
                        <path
                            d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                    </svg>
                </button>
                <div class="text" style="color:gray;">PENDIENTE</div>
                @endif
            </form>
        </div>

        <div class="center">
            <div class="explainer">
                <form action="{{Route('principal')}}" method="GET">
                    @csrf
                    <button type="submit" class="buttonsubmit" style="margin-bottom: -10px;">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white"
                                class="bi bi-list" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                            </svg>

                        </span>

                    </button>
                </form>
            </div>
            <div class="text">INICIO</div>
        </div>

        <div class="right">
            <form action="{{Route('pendiente_empaque')}}" method="GET">
                @csrf
                @if ( auth()->user()->rol == 0 || auth()->user()->rol == 1 || auth()->user()->rol == 4 || auth()->user()->rol == 2  )
                <button type="submit" class="buttonsubmit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white"
                        class="bi bi-card-checklist" viewBox="0 0 16 16">
                        <path
                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                        <path
                            d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                    </svg>
                </button>
                <div class="text">PENDIENTE EMPAQUE</div>
                @elseif ( auth()->user()->rol == -1)
                <button type="submit" class="buttonsubmit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white"
                        class="bi bi-card-checklist" viewBox="0 0 16 16">
                        <path
                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                        <path
                            d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                    </svg>
                </button>
                <div class="text">PENDIENTE EMPAQUE</div>
                @else

                <button type="submit" class="buttonsubmit" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="gray"
                        class="bi bi-card-checklist" viewBox="0 0 16 16">
                        <path
                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                        <path
                            d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                    </svg>
                </button>
                <div class="text" style="color:gray;">PENDIENTE EMPAQUE</div>


                @endif
            </form>
        </div>


        @if (auth()->user()->rol != -1)

        <div class="righter">
            <form @if(auth()->user()->rol == 4)
                    action="{{Route('materiales.index')}}"
                @else
                    action="{{ route('inventario_cajas') }}"
                @endif  method="GET">
                @csrf
                @if (auth()->user()->rol == 0 || auth()->user()->rol == 1 || auth()->user()->rol == 4 )
                <button type="submit" class="buttonsubmit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-box"
                        viewBox="0 0 16 16">
                        <path
                            d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                    </svg>
                </button>
                <div class="text">MATERIALES</div>
                @else
                <button type="submit" class="buttonsubmit" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="gray" class="bi bi-box"
                        viewBox="0 0 16 16">
                        <path
                            d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                    </svg>
                </button>
                <div class="text" style="color:gray;">MATERIALES</div>
                @endif
            </form>
        </div>

        <div class="righter2">


            <form action="{{Route('programacionterminado')}}" method="GET">
                @csrf
                <?php if (  auth()->user()->rol == 0 || auth()->user()->rol == 2  ): ?>
                <button type="submit" class="buttonsubmit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-truck"
                        viewBox="0 0 16 16">
                        <path
                            d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                    </svg>
                </button>
                <div class="text">TERMINADO</div>
                <?php else: ?>
                <button type="submit" class="buttonsubmit" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="gray" class="bi bi-truck"
                        viewBox="0 0 16 16">
                        <path
                            d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                    </svg>
                </button>
                <div class="text" style="color:gray;">TERMINADO</div>
                <?php endif; ?>
            </form>
        </div>
        @endif
        <div @if (auth()->user()->rol == -1)
            class="righter"
            @else
            class="righter3"
            @endif>
            <form action="{{Route('f_terminado')}}" method="GET">
                @csrf
                @if ( auth()->user()->rol == 0 || auth()->user()->rol == 2 || auth()->user()->rol == 4)
                <button type="submit" class="buttonsubmit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white"
                        class="bi bi-card-checklist" viewBox="0 0 16 16">
                        <path
                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                        <path
                            d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                    </svg>
                </button>
                <div class="text">FACTURACION</div>
                @elseif ( auth()->user()->rol == -1)
                <button type="submit" class="buttonsubmit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white"
                        class="bi bi-card-checklist" viewBox="0 0 16 16">
                        <path
                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                        <path
                            d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                    </svg>
                </button>
                <div class="text">FACTURACION</div>
                @else
                <button type="submit" class="buttonsubmit" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="gray"
                        class="bi bi-card-checklist" viewBox="0 0 16 16">
                        <path
                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                        <path
                            d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                    </svg>
                </button>
                <div class="text" style="color:gray;">FACTURACION</div>
                @endif
            </form>
        </div>

    </div>

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
                    <button type="button" class="bmodal_no" data-dismiss="modal">
                        <span>Cancelar</span>
                    </button>
                    <button onclick="event.preventDefault();
           document.getElementById('logout-form').submit();" class="bmodal_yes">
                        <span>Cerrar Sesión</span>
                    </button>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

    <script src="{{ asset('js/app.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>

    <script src="{{ URL::asset('css/tabla.js') }}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.mi-selector').select2();

        });
    </script>

    <script>
        $(document).ready(function () {
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

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js">
    </script>
    <script src="{{ asset('js/selectmultiple.js') }}"></script>

    @toastr_js
    @toastr_render
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.3/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/js/bootstrap-multiselect.js"></script>
    @stack('scripts')



</body>

</!DOCTYPE>
