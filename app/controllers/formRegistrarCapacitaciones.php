<?php

	setPermission("administrator");
	setPermission("root");
    endPermissions();
    
    $data = model("conseguirProyectosCicloEscolarActual");

	extract($data);

	if(isset($error))
	{
		//ERRROR
	}
	else 
	{
		$mensaje = $mensaje_proyectos_ciclo_escolar;
		$informacion = $mensaje_proyectos_ciclo_escolar ? $informacion_proyectos_ciclo_escolar : array();
		$nombre = "una opción";
		$valor = "none";
		$selectProyectos = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

        view("formRegistrarCapacitaciones",compact("selectProyectos"));
	}
