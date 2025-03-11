<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    
<p>Querido {{$admin->name}}</p>
<p>
    Hemos recibido su solicitud de recuperar su clave para su cuenta de Administrador en Redeno.
    Puede cambiarla haciendo click en el siguiente link:
    <br>
    <a href="{{$actionLink}}" target="_blank" style="color:#fff; border-color:#6250A2; border-style:solid;
    border-width:5px 10px; background-color:#6250A2; display:inline-block; text-decoration:none;border-radius:3px;
    box-shadow:0 2px 3px rgba(0,0,0,0.16);-webkit-text-size-adjust:none;box-sizing:border-box">Cambiar clave
    </a>
    <br>
    <b>NB:</b> Este link estara valido por 15 minutos
    <br>
    Si no solicitaste recuperar tu clave, por favor ignora este mensaje.
</p>
</body>
</html>