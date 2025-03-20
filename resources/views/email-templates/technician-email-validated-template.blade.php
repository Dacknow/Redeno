<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin: 0 auto;
            max-width: 600px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #6250A2;
            color: #ffffff;
            padding: 20px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }
        .header img {
            max-width: 100px;
        }
        .body-content {
            padding: 20px;
            text-align: center;
        }
        .body-content h1 {
            color: #6250A2;
        }
        .footer {
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 0 0 10px 10px;
            text-align: center;
        }
        .btn-custom {
            background-color: #28a745;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }
        .terms {
            margin-top: 20px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{logo()}}" alt="Logo">
            <h2>{{$technician->name}}Bienvenido a Nuestra Plataforma Redeno!</h2>
        </div>
        <div class="body-content">
            <h1>Te damos la bienvenida!</h1>
            <p>Estamos emocionados de tenerte con nosotros.</p>
            <a href="{{$actionLink}}" class="btn btn-custom">Confirmar correo</a>
            <div class="terms">
                <h4>Terminos y Condiciones</h4>
                <p>Al usar nuestra plataforma, aceptas nuestros terminos y condiciones. Te invitamos a leerlos con detenimiento.</p>
                <h4>Tratamiento de Datos</h4>
                <p>Conforme a la Ley de Habeas Data, tus datos seran tratados con la maxima confidencialidad y seguridad. Puedes conocer mas sobre nuestra politica de privacidad <a href="#">aqui</a>.</p>
            </div>
        </div>
        <div class="footer">
            <p>Si tienes alguna pregunta, no dudes en <a href="#">contactarnos</a>.</p>
            <p>&copy; 2025 Redeno. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
