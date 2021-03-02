<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_proyecto = $_POST["id_proyecto"];
	
	$data = model("altaProyectos",compact("id_proyecto"));
	
	extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos";
        sendToClient(compact("error","resultado"));
	}
	else
	{
		if($result == "Error")
		{
			$resultado = "No se puede dar de alta el desafío seleccionado debido a que hay otro desafío que se renovó de éste en el mismo ciclo escolar";
        	sendToClient(compact("error","resultado"));
		}
		else
		{
			$resultado = "Desafío dado de alta correctamente";
        	sendToClient(compact("mensaje","resultado"));
		}
        
	}