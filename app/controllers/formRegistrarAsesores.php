<?php

	setPermission("root");
	endPermissions();

	$data = model("conseguirFuncionesAsesor");

	extract($data);

	if(isset($error))
	{
		//ERRROR
	}
	else if($mensaje_adviser_functions === false)
	{
		//NO hay registro
	}
	else
	{
		$mensaje = $mensaje_adviser_functions;
		$informacion = $informacion_adviser_functions;
		$nombre = "una opción";
		$valor = "none";
		$selectTipoAsesor = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

		view("formRegistrarAsesores",compact("selectTipoAsesor"));
	}