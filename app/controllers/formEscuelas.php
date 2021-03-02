<?php

	setPermission("administrator");
	setPermission("adviser");
	setPermission("root");
	endPermissions();

	$cssClassElements = "";

	$data = model("conseguirEscuelas");
	extract($data);

	if(isset($error))
	{
		//ERRROR
	}
	else if($mensaje_escuelas === false)
	{
		$contenidoTablaEscuelas = "";
		$cssClassElements = "noActive";
	}
	else
	{
		$mensaje = $mensaje_escuelas;
		$informacion = $informacion_escuelas;
		$seleccionable = true;
		$excepcion_col = array("6");
		$link = "escuelas";
		$positionLink = "7";

		$contenidoTablaEscuelas = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col","link","positionLink"));
	}

	$data2 = model("conseguirEscuelasBaja");
	extract($data2);

	if(isset($error))
	{
		exit();
		//ERROR
	}
	else if($mensaje_escuelas_baja === false)
	{
		$contenidoTablaEscuelasBaja = "";
		$cssClassElements .= " noInactive";
	}
	else
	{
		$mensaje = $mensaje_escuelas_baja;
		$informacion = $informacion_escuelas_baja;
		$seleccionable = true;
		$excepcion_col = array("6");

		$contenidoTablaEscuelasBaja = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col"));
	}

	view("formEscuelas",compact("contenidoTablaEscuelas","contenidoTablaEscuelasBaja","cssClassElements"));