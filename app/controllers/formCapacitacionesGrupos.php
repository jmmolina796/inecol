<?php

	setPermission("administrator");
	setPermission("root");
    endPermissions();
	
	$cssClassElements = "";

	$data = model("conseguirCapSesiones");
    extract($data);

	if(isset($error))
	{
		exit();
		//ERRROR
	}
	else if($mensaje_cap_sesiones === false)
	{
		$contenidoTablaCapSesiones = "";
		$cssClassElements = "noActive";
	}
	else
	{
		$mensaje = $mensaje_cap_sesiones;
		$informacion = $informacion_cap_sesiones;
		$seleccionable = true;
		$excepcion_col = array("4", "8");

		$contenidoTablaCapSesiones = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col"));
	}

	// $data2 = model("conseguirCapacitacionesBaja");
	// extract($data2);

	// if(isset($error))
	// {
	// 	exit();
	// 	//ERROR
	// }
	// else if($mensaje_cap_sesiones_baja === false)
	// {
	// 	$contenidoTablaCapacitacionesBaja = "";
	// 	$cssClassElements .= " noInactive";
	// }
	// else
	// {
	// 	$mensaje = $mensaje_cap_sesiones_baja;
	// 	$informacion = $informacion_cap_sesiones_baja;
	// 	$seleccionable = true;
	// 	$excepcion_col = array("2", "5");

	// 	$contenidoTablaCapacitacionesBaja = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col"));
	// }
	
	view("formCapacitacionesGrupos",compact("contenidoTablaCapSesiones","cssClassElements"));