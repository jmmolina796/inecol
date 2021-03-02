<?php

	setPermission("root");
	endPermissions();

	$id_juez = $_POST["id_juez"];
	
	$data = model("altaJueces",compact("id_juez"));
	
	extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos";
        sendToClient(compact("error","resultado"));
	}
	else
	{
        $resultado = "Juez dado de alta correctamente";
        sendToClient(compact("mensaje","resultado"));
	}