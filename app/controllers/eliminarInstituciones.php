<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();
	
	$id_institucion = $_POST["id_institucion"];
	$data = model("eliminarInstituciones",compact("id_institucion"));
	
	extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos";
        sendToClient(compact("error","resultado"));
	}
	else
	{
        $resultado = "Institución dada de baja correctamente";
        sendToClient(compact("mensaje","resultado"));
	}