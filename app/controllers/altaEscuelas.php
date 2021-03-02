<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$clave_escuela = $_POST["clave_escuela"];
	
	$data = model("altaEscuelas",compact("clave_escuela"));
	
	extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos";
        echo json_encode(compact("error","resultado"));
	}
	else
	{
        $resultado = "Escuela dada de alta correctamente";
        echo json_encode(compact("mensaje","resultado"));
	}