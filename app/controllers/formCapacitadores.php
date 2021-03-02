<?php

	setPermission("root");
	endPermissions();

	$cssClassElements = "";

	$data = model("conseguirCapacitadores");
	extract($data);

	if(isset($error))
	{
		exit();
		//ERROR
	}
	else if($mensaje_capacitadores === false)
	{
		$contenidoTablaCapacitadores = "";
		$cssClassElements = "noActive";
	}
	else
	{
		$mensaje = $mensaje_capacitadores;
		$informacion = $informacion_capacitadores;
		$seleccionable = true;
		$excepcion_col = array("5","8","9","10");
		$link = "capacitadores";
		$positionLink = "11";

		$contenidoTablaCapacitadores = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col","link","positionLink"));
	}

	$data2 = model("conseguirCapacitadoresBaja");
	extract($data2);

	if(isset($error))
	{
		exit();
		//ERROR
	}
	else if($mensaje_capacitadores_baja === false)
	{
		$contenidoTablaCapacitadoresBaja = "";
		$cssClassElements .= " noInactive";
	}
	else
	{
		$mensaje = $mensaje_capacitadores_baja;
		$informacion = $informacion_capacitadores_baja;
		$seleccionable = true;
		$excepcion_col = array("5","8","9","10");
		$link = "capacitadores";
		$positionLink = "11";

		$contenidoTablaCapacitadoresBaja = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col","link","positionLink"));
	}
	
	view("formCapacitadores",compact("contenidoTablaCapacitadores","contenidoTablaCapacitadoresBaja","cssClassElements"));