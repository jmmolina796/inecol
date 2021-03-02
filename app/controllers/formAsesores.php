<?php

	setPermission("root");
	endPermissions();

	$cssClassElements = "";

	$data = model("conseguirAsesores");
	extract($data);

	if(isset($error))
	{
		exit();
		//ERROR
	}
	else if($mensaje_asesores === false)
	{
		$contenidoTablaAsesores = "";
		$cssClassElements = "noActive";
	}
	else
	{
		$mensaje = $mensaje_asesores;
		$informacion = $informacion_asesores;
		$seleccionable = true;
		$excepcion_col = array("5","9","10","11");
		$link = "asesores";
		$positionLink = "12";

		$contenidoTablaAsesores = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col","link","positionLink"));
	}

	$data2 = model("conseguirAsesoresBaja");
	extract($data2);

	if(isset($error))
	{
		exit();
		//ERROR
	}
	else if($mensaje_asesores_baja === false)
	{
		$contenidoTablaAsesoresBaja = "";
		$cssClassElements .= " noInactive";
	}
	else
	{
		$mensaje = $mensaje_asesores_baja;
		$informacion = $informacion_asesores_baja;
		$seleccionable = true;
		$excepcion_col = array("5","9","10","11");
		$link = "asesores";
		$positionLink = "12";

		$contenidoTablaAsesoresBaja = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col","link","positionLink"));
	}
	
	view("formAsesores",compact("contenidoTablaAsesores","contenidoTablaAsesoresBaja","cssClassElements"));