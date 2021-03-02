<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_proyecto = $_POST["id_proyecto"];
	$data = model("eliminarProyectos",compact("id_proyecto"));
	
	extract($data);

	if(isset($error))
	{
		$resultado = "Hubo un error en la base de datos";
        sendToClient(compact("error","resultado"));
	}
	else
	{
		$resultado = "El desafío ha sido dado de baja correctamente";
        sendToClient(compact("mensaje","resultado"));
	}