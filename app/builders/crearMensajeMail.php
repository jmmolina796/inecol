
<?php

$contentHtml = "
<html>
<head>
<title>Pasevic solicitud de cambio de contraseña</title>
</head>
<body>
<h2>¿Has olvidado tu contraseña?</h2>
<div style='font-size:20px'>
Se ha recibido una solicitud de cambio de contraseña de tu cuenta de <strong> Pasevic</strong> con el correo (".$correo.") 
</div><br><br>
<div style='font-size:20px'>
Si quieres restablecer tu contraseña, pulsa el enlace que aparece a continuación, o bien cópialo y pégalo en la barra de direcciones de tu navegador:
</div><br><br>
<div style='font-size:20px'>
".URL_SERVER."restablecer-clave/".$token."
</div><br><br>
<div style='font-size:20px'>
<strong>Atención</strong>: este enlace es de un solo uso.
</div>
<div style='font-size:20px'>
Si no quieres restablecer tu contraseña, ignora este mensaje y tu contraseña no cambiará. Si tienes alguna duda o pregunta, ponte en contacto con <strong>Pasevic. </strong>
</div>
</body>
</html>
";