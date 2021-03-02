<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();
	
	$data = model("conseguirProyectosSinCarpetas",compact("id_carpeta_proyecto","filtro_proyectos","busqueda_nombre_proyecto"));
	extract($data);

	if(isset($error))
	{
		exit();
		//ERROR
	}
	else if($mensaje_proyectos === false)
	{
		$contenidoTablaProyectos = "";
		$cssClassElements = "noActive";
	}
	else
	{
		$mensaje = $mensaje_proyectos;
		$informacion = $informacion_proyectos;
		$seleccionable = true;
		$excepcion_col = array("9","10","11","12","13");

		$contenidoTablaProyectos = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col"));
	}

	
	
	view("formRegistrarCarpetasProyectos",compact("contenidoTablaProyectos"));