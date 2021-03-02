<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();
	
	$id_alianza = $_POST["id_alianza"];
	$data = model("eliminarAlianzas",compact("id_alianza"));
	
	extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos";
        sendToClient(compact("error","resultado"));
	}
	else
	{
        $resultado = "Alianza dada de baja correctamente";
        sendToClient(compact("mensaje","resultado"));
	}