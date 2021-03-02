<?php

	setPermission("administrator");
	setPermission("adviser");
	setPermission("root");
	endPermissions();

	$cssClassElements = "";

	$data = model("conseguirDocentes");
	extract($data);

	if(isset($error))
	{
		exit();
		//ERRROR
	}
	else if($mensaje_docentes === false)
	{
		$contenidoTablaDocentes = "";
		$cssClassElements = "noActive";
	}
	else
	{ //6
		$mensaje = $mensaje_docentes;
		$informacion = $informacion_docentes;
		$seleccionable = true;
		$excepcion_col = array("5","11","12","13");
		$link = "docentes";
		$positionLink = "14";

		$contenidoTablaDocentes = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col","link","positionLink"));
	}

	$data2 = model("conseguirDocentesBaja");
	extract($data2);

	if(isset($error))
	{
		exit();
		//ERROR
	}
	else if($mensaje_docentes_baja === false)
	{
		$contenidoTablaDocentesBaja = "";
		$cssClassElements .= " noInactive";
	}
	else
	{
		$mensaje = $mensaje_docentes_baja;
		$informacion = $informacion_docentes_baja;
		$seleccionable = true;
		$excepcion_col = array("5","11","12","13");
		$link = "docentes";
		$positionLink = "15";

		$contenidoTablaDocentesBaja = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col","link","positionLink"));
	}

	view("formDocentes",compact("contenidoTablaDocentes","contenidoTablaDocentesBaja","cssClassElements"));