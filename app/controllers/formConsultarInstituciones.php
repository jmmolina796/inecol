<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_institucion = $_POST["id_institucion"];

	$data = model("buscarInstituciones",compact("id_institucion"));

	extract($data);

	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_institucion === false)
	{
		//Registro no encontrado
	}
	else
	{
		view("formConsultarInstituciones",compact("nombre","descripcion"));
	}