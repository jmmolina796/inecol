<?php

	setPermission("root");
	endPermissions();

	$id_administrador = $_POST["id_administrador"];
	
	$data = model("altaAdministradores",compact("id_administrador"));
	
	extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos";
        sendToClient(compact("error","resultado"));
	}
	else
	{
        $resultado = "Administrador dado de alta correctamente";
        sendToClient(compact("mensaje","resultado"));
	}