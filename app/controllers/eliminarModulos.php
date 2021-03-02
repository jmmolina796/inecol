<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_modulo = $_POST["id_modulo"];
	$data = model("eliminarModulos",compact("id_modulo"));
	
	extract($data);

	if(isset($error))
	{
		$resultado = "Hubo un error en la base de datos";
        sendToClient(compact("error","resultado"));
	}
	else
	{
		$resultado = "El módulo ha sido dado de baja correctamente";
        sendToClient(compact("mensaje","resultado"));
	}