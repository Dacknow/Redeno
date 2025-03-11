<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    
<p>Querido {{$client->username}}</p>
<p>
    Tu clave ha sido reestablecida satisfactoriamente.
    Tus nuevas credenciales son:
    <br>
    <b>Usuario/Correo eletronico: </b>{{ $client->username}} / {{$client->email}}
    <br>
    <b>Clave: </b>{{$new_password}}
</p>
<br>
Por favor mantenga sus credenciales seguras. Su usuario y clave son personales en intrasferibles
<p>
    Techzone no se hara responsable del mal uso de tu usuario y clave.
</p>
<br>
-----------------------------------------------------------------------------
</body>
</html>