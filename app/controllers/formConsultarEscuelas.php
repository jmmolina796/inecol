<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$clave = $_POST["id_escuela"];

	$data = model("buscarEscuela",compact("clave"));
	extract($data);

	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_escuela === false)
	{
		//No coincide
	}
	else
	{
		view("formConsultarEscuelas",compact("clave_escuela","escuela","nivel_educativo","entidad","municipio","localidad","estatus"));
	}