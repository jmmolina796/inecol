<?php

	setPermission("root");
	endPermissions();

	$cssClassElements = "";

	$data = model("conseguirAdministradores");
	extract($data);

	if(isset($error))
	{
		exit();
		//ERROR
	}
	else if($mensaje_administradores === false)
	{
		$contenidoTablaAdministradores = "";
		$cssClassElements = "noActive";
	}
	else
	{
		$mensaje = $mensaje_administradores;
		$informacion = $informacion_administradores;
		$seleccionable = true;
		$excepcion_col = array("5","8","9","10");
		$link = "administradores";
		$positionLink = "11";

		$contenidoTablaAdministradores = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col","link","positionLink"));
	}

	$data2 = model("conseguirAdministradoresBaja");
	extract($data2);

	if(isset($error))
	{
		exit();
		//ERROR
	}
	else if($mensaje_administradores_baja === false)
	{
		$contenidoTablaAdministradoresBaja = "";
		$cssClassElements .= " noInactive";
	}
	else
	{
		$mensaje = $mensaje_administradores_baja;
		$informacion = $informacion_administradores_baja;
		$seleccionable = true;
		$excepcion_col = array("5","8","9","10");
		$link = "administradores";
		$positionLink = "11";

		$contenidoTablaAdministradoresBaja = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col","link","positionLink"));
	}
	
	view("formAdministradores",compact("contenidoTablaAdministradores","contenidoTablaAdministradoresBaja","cssClassElements"));