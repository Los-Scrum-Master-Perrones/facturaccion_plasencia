<!DOCTYPE html>
<html>
<head>
    <title>Acceso no autorizado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 100px auto;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
        }

        .message-box {
            border: 2px solid #e74c3c;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            text-decoration: none;
            color: #fff;
            background-color: #e74c3c;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="message-box">
            <h1>Acceso no autorizado</h1>
            <p>Lo siento, no tienes permisos para acceder a esta página.</p>
            <a href="/" class="btn">Volver al inicio</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"  class="btn btn-success">Cerrar Sesion</button>
            </form>
        </div>
    </div>
</body>
</html>
