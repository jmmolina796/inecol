<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$clave = $_POST["clave"];

	$data = model("eliminarEscuelas",compact("clave")); 

	extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos";
        echo json_encode(compact("error","resultado"));
	}
	else
	{
        $resultado = "Escuela dada de baja correctamente";
        echo json_encode(compact("mensaje","resultado"));
	}