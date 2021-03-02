<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$nombre = $_POST["nombre"];
	$descripcion = $_POST["alianza-descripcion"];

	$data = model("registrarAlianzas",compact("nombre","descripcion"));

	extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos.";
        sendToClient(compact("error","resultado"));
	}
	else
	{
		$resultado = "Registro insertado correctamente.";
        sendToClient(compact("mensaje","resultado"));
	}