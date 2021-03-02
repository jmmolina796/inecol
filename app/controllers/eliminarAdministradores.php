<?php

	setPermission("root");
	endPermissions();

	$id_administrador = $_POST["id_administrador"];
	$data = model("eliminarAdministradores",compact("id_administrador"));
	
	extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos";
        echo json_encode(compact("error","resultado"));
	}
	else
	{
        $resultado = "Administrador dado de baja correctamente";
        echo json_encode(compact("mensaje","resultado"));
	}