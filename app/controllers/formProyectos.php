<?php

	setPermission("administrator");
	setPermission("adviser");
	setPermission("root");
	endPermissions();

	$cssClassElements = "";

	$data = model("conseguirProyectos");
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
		$excepcion_col = array("9","10","11","13");
		$link = "proyectos";
		$positionLink = "12";

		$contenidoTablaProyectos = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col","link","positionLink"));
	}

	$data2 = model("conseguirProyectosBaja");
	extract($data2);

	if(isset($error))
	{
		exit();
		//ERROR
	}
	else if($mensaje_proyectos_baja === false)
	{
		$contenidoTablaProyectosBaja = "";
		$cssClassElements .= " noInactive";
	}
	else
	{
		$mensaje = $mensaje_proyectos_baja;
		$informacion = $informacion_proyectos_baja;
		$seleccionable = true;
		$excepcion_col = array("9","10","11","13");
		$link = "proyectos";
		$positionLink = "12";

		$contenidoTablaProyectosBaja = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col","link","positionLink"));
	}
	
	view("formProyectos",compact("contenidoTablaProyectos","contenidoTablaProyectosBaja","cssClassElements"));