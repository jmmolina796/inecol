<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_alianza = $_POST["id_alianza"];

	$data = model("buscarAlianzas",compact("id_alianza"));

	extract($data);

	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_alianza === false)
	{
		//Registro no encontrado
	}
	else
	{
		view("formModificarAlianzas",compact("id_alianza","nombre","descripcion"));
	}