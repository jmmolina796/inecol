<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();
	
	$id_capacitacion = $_POST["id_capacitacion"];
	$data = model("eliminarCapacitaciones",compact("id_capacitacion"));
	
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