<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_alianza = $_POST["id_alianza"];
	
	$data = model("altaAlianzas",compact("id_alianza"));
	
	extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos";
        sendToClient(compact("error","resultado"));
	}
	else
	{
        $resultado = "Alianza dada de alta correctamente";
        sendToClient(compact("mensaje","resultado"));
	}