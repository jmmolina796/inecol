<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_modulo = $_POST["id_modulo"];
	
	$data = model("altaModulos",compact("id_modulo"));
	
	extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos";
        sendToClient(compact("error","resultado"));
	}
	else
	{
        $resultado = "Módulo dada de alta correctamente";
        sendToClient(compact("mensaje","resultado"));
	}