<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    
<p>Querido {{$admin->name}}</p>
<p>
    Tu clave ha sido reestablecida satisfactoriamente.
    Tus nuevas credenciales son:
    <br>
    <b>Usuario/Correo eletronico: </b>{{ $admin->username}} / {{$admin->email}}
    <br>
    <b>Clave: </b>{{$new_password}}
</p>
<br>
Por favor mantenga sus credenciales seguras. Tu usuario y clave son personales en intrasferible
<p>
    Techzone no se hará responsable del mal uso de tu usuario y clave.
</p>
<br>
-----------------------------------------------------------------------------
</body>
</html>