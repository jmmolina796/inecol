<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_carpeta = $_POST["id_carpeta"];

	$data = model("altaCarpetasProyectos",compact("id_carpeta"));
	extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos";
        sendToClient(compact("error","resultado"));
	}
	else
	{
        $resultado = "Carpeta dada de alta correctamente";
        $mensaje = $mensaje_carpetas_proyectos;
        sendToClient(compact("mensaje","resultado"));
	}