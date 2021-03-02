<?php

	setPermission("administrator");
	setPermission("root");
    endPermissions();
	
	$cssClassElements = "";

	$data = model("conseguirCapacitaciones");
    extract($data);

	if(isset($error))
	{
		exit();
		//ERRROR
	}
	else if($mensaje_capacitaciones === false)
	{
		$contenidoTablaCapacitaciones = "";
		$cssClassElements = "noActive";
	}
	else
	{
		$mensaje = $mensaje_capacitaciones;
		$informacion = $informacion_capacitaciones;
		$seleccionable = true;
		$excepcion_col = array("2", "5");

		$contenidoTablaCapacitaciones = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col"));
	}

	$data2 = model("conseguirCapacitacionesBaja");
	extract($data2);

	if(isset($error))
	{
		exit();
		//ERROR
	}
	else if($mensaje_capacitaciones_baja === false)
	{
		$contenidoTablaCapacitacionesBaja = "";
		$cssClassElements .= " noInactive";
	}
	else
	{
		$mensaje = $mensaje_capacitaciones_baja;
		$informacion = $informacion_capacitaciones_baja;
		$seleccionable = true;
		$excepcion_col = array("2", "5");

		$contenidoTablaCapacitacionesBaja = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col"));
	}
	
	view("formCapacitaciones",compact("contenidoTablaCapacitaciones","contenidoTablaCapacitacionesBaja","cssClassElements"));