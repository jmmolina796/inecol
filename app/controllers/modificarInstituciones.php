<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();
	
	$id_institucion = $_POST['id_institucion'];
	$nombre = $_POST["nombre"];
	$descripcion = $_POST["institucion-descripcion"];

	$data = model("modificarInstituciones",compact("id_institucion","nombre","descripcion"));

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