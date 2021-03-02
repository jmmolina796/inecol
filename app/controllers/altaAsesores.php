<?php

	setPermission("root");
	endPermissions();

	$id_asesor = $_POST["id_asesor"];
	
	$data = model("altaAsesores",compact("id_asesor"));
	
	extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos";
        sendToClient(compact("error","resultado"));
	}
	else
	{
        $resultado = "Asesor dado de alta correctamente";
        sendToClient(compact("mensaje","resultado"));
	}