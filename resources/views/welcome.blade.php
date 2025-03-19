<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redeno</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/images/site/logo_favicon/favicon_Redeno.png">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        body {
            background-image: url('/images/site/welcome/welcome.png');
            background-size: cover;
            background-position: center;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            height: 100vh;
            padding-right: 5%;
            overflow: hidden;
            transition: background 0.3s ease;
        }
        .container {
            position: relative;
            text-align: center;
            z-index: 10;
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.1);
            width: 450px;
        }
        h1 {
            font-size: 2rem;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 4px;
            text-shadow: 0px 0px 10px rgba(255, 255, 255, 0.8);
        }
        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            font-size: 1.2rem;
            color: #fff;
            text-decoration: none;
            border-radius: 50px;
            transition: 0.3s;
            position: relative;
            overflow: hidden;
            text-align: center;
            margin-top: 10px;
        }
        .btn::before {
            content: "";
            position: absolute;
            width: 200%;
            height: 200%;
            top: -50%;
            left: -50%;
            background: rgba(255, 255, 255, 0.2);
            transition: 0.3s;
            transform: rotate(45deg);
        }
        .btn:hover::before {
            top: 0;
            left: 0;
        }
        .btn-primary {
            background: #1e88e5;
        }
        .btn-primary:hover {
            background: #1565c0;
        }
        .btn-success {
            background: #43a047;
        }
        .btn-success:hover {
            background: #2e7d32;
        }

        /* Estilos para móviles */
        @media (max-width: 768px) {
            body {
                background-image: url('/images/site/welcome/mobile_welcome.png');
                justify-content: center;
                padding-right: 0;
                padding-bottom: 5%;
                margin-top: ;
            }
            .container {
                width: 90%;
                margin-top: 200px;
            }
            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Bienvenido</h1>
        <a href="{{ url('/admin/login') }}" class="btn btn-primary">Soy Administrador</a>
        <a href="{{ url('/technician/login') }}" class="btn btn-success">Soy Técnico</a>
    </div>

</body>
</html>
