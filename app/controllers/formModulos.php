<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$cssClassElements = "";

	$data = model("conseguirModulos");
	extract($data);

	if(isset($error))
	{
		exit();
		//ERROR
	}
	else if($mensaje_modulos === false)
	{
		$contenidoTablaModulos = "";
		$cssClassElements = "noActive";
	}
	else
	{
		$mensaje = $mensaje_modulos;
		$informacion = $informacion_modulos;
		$seleccionable = true;
		$excepcion_col = array("2","4","5","6","8");
		$link = "modulos";
		$positionLink = "7";

		$contenidoTablaModulos = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col","link","positionLink"));
	}

	$data2 = model("conseguirModulosBaja");
	extract($data2);

	if(isset($error))
	{
		exit();
		//ERROR
	}
	else if($mensaje_modulos_baja === false)
	{
		$contenidoTablaModulosBaja = "";
		$cssClassElements .= " noInactive";
	}
	else
	{
		$mensaje = $mensaje_modulos_baja;
		$informacion = $informacion_modulos_baja;
		$seleccionable = true;
		$excepcion_col = array("2","4","5","6","8");
		$link = "modulos";
		$positionLink = "7";

		$contenidoTablaModulosBaja = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col","link","positionLink"));
	}
	
	view("formModulos",compact("contenidoTablaModulos","contenidoTablaModulosBaja","cssClassElements"));