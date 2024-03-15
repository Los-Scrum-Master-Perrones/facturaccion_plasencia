@extends('layouts.Main')
@section('content')
    <style>
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

        html {
            font-family: sans-serif;
        }

        .lineatemp {
            position: relative;
            width: 600px;
            margin: 0 auto;
            border: 1px solid lightgray;
            border-radius: 10px;
        }

        .fila {
            display: flex;
            justify-content: start;
            border-bottom: 1px solid lightgray;
            position: relative;
        }

        .fila .disco {
            width: 36px;
            display: flex;
            flex-direction: column;
            position: relative;
            justify-content: center;
            align-items: center;
        }

        .fila .disco:after {
            content: '';
            position: absolute;
            top: 0;
            left: calc(505 - 2px);
            height: 100%;
            width: 3px;
            background: #80DEEA;
            z-index: -1;
        }

        .fila:first-child .disco:after {
            height: 50%;
            top: 50%;
        }

        .fila:last-child .disco:after {
            height: 50%;
        }

        .fila .disco>div {

            aspect-ratio: 1/1;
            border-radius: 50%;
            background: lightblue;
            box-sizing: border-box;
        }

        .fila:hover .disco>div {
            border: 3px solid red;
            background: white;
        }

        .fila div:nth-of-type(2) {
            width: 20%;
            padding: 4px;
            display: flex;
            align-items: center;
        }

        .fila div:nth-of-type(3) {
            width: 60%;
            padding: 4px;
        }

    </style>



    @php
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $path = $_SERVER['REQUEST_URI'];
        $url = $protocol . '://' . $host . $path;
    @endphp


    <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item">
            <a @if (!Auth::user()->hasRole(['ADMIN', 'PRODUCCION', 'PRODUCCION MATERIALES'])) hidden @endif
                class="nav-link @if ($url == route('produccion.catalogo')) active fs-7 "
            @else
            fs-7 "
            style="color: white" @endif href="{{ route('produccion.catalogo') }}"><strong>Catalogo</strong></a>
        </li>

        <li class="nav-item">
            <a @if (!Auth::user()->hasRole(['ADMIN', 'PRODUCCION', 'PRODUCCION MATERIALES'])) hidden @endif
                class="nav-link @if ($url == route('produccion.materiales')) active fs-7 "
            @else
            fs-7 "
            style="color: white" @endif href="{{ route('produccion.materiales') }}"><strong>Materiales</strong></a>
        </li>
        <li class="nav-item">
            <a @if (!Auth::user()->hasRole(['ADMIN', 'PRODUCCION', 'PRODUCCION MATERIALES'])) hidden @endif
                class="nav-link @if ($url == route('produccion.catalogo.materiales')) active fs-7 "
            @else
            fs-7 "
            style="color: white" @endif href="{{ route('produccion.catalogo.materiales') }}"><strong>Ficha
                    M.</strong></a>
        </li>
        <li class="nav-item">
            <a @if (!Auth::user()->hasRole(['ADMIN', 'PRODUCCION', 'PRODUCCION MATERIALES'])) hidden @endif
                class="nav-link @if ($url == route('produccion.pendiente.index')) active fs-7 "
            @else
            fs-7 "
            style="color: white" @endif aria-current="page"
                href="{{ route('produccion.pendiente.index') }}"><strong>Pendiente</strong></a>
        </li>
        <li class="nav-item">
            <a @if (!Auth::user()->hasRole(['ADMIN', 'PRODUCCION', 'PRODUCCION MATERIALES'])) hidden @endif
                class="nav-link @if ($url == route('produccion.producir.marca')) active fs-7 "
            @else
            fs-7 "
            style="color: white" @endif href="{{ route('produccion.producir.marca') }}"><strong>Planificacion</strong></a>
        </li>
        <li class="nav-item">
            <a @if (!Auth::user()->hasRole(['ADMIN', 'PRODUCCION'])) hidden @endif
                class="nav-link @if ($url == route('produccion.empleados')) active fs-7 "
            @else
            fs-7 "
            style="color: white" @endif href="{{ route('produccion.empleados') }}"><strong>Empleados</strong></a>
        </li>
        <li class="nav-item">
            <a @if (!Auth::user()->hasRole(['ADMIN', 'PRODUCCION'])) hidden @endif
                class="nav-link @if ($url == route('produccion.index')) active fs-7 "
            @else
            fs-7 "
            style="color: white" @endif href="{{ route('produccion.index') }}"><strong>Entradas</strong></a>
        </li>
        <li class="nav-item">
            <a @if (!Auth::user()->hasRole(['ADMIN', 'PRODUCCION'])) hidden @endif
                class="nav-link @if ($url == route('produccion.pendiente.salida')) active fs-7 "
            @else
            fs-7 "
            style="color: white" @endif href="{{ route('produccion.pendiente.salida') }}"><strong>Salidas</strong></a>
        </li>
        <li class="nav-item">
            <a @if (!Auth::user()->hasRole(['ADMIN', 'PRODUCCION'])) hidden @endif
                class="nav-link @if ($url == route('produccion.empleados.rendimiento')) active fs-7 "
            @else
            fs-7 "
            style="color: white" @endif href="{{ route('produccion.empleados.rendimiento') }}"><strong>Estadisticas</strong></a>
        </li>
        @if (Auth::user()->hasRole(['ADMIN', 'PRODUCCION']))
            @livewire('produccion.componentes.produccion-notificaciones')
        @endif

    </ul>
    @yield('contenido')
@endsection
