<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();
	
	$id_alianza = $_POST['id_alianza'];
	$nombre = $_POST["nombre"];
	$descripcion = $_POST["alianza-descripcion"];

	$data = model("modificarAlianzas",compact("id_alianza","nombre","descripcion"));

	extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos.";
        sendToClient(compact("error","resultado"));
	}
	else
	{
		$resultado = "Registro modificado correctamente.";
        sendToClient(compact("mensaje","resultado"));
	}