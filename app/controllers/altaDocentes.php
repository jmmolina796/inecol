<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_docente = $_POST["id_docente"];
	
	$data = model("altaDocentes",compact("id_docente"));
	
	extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos";
        sendToClient(compact("error","resultado"));
	}
	else
	{
        $resultado = "Docente dado de alta correctamente";
        sendToClient(compact("mensaje","resultado"));
	}