<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();
	
	$cssClassElements = "";

	$data = model("conseguirAlianzas");
	extract($data);

	if(isset($error))
	{
		exit();
		//ERRROR
	}
	else if($mensaje_alianzas === false)
	{
		$contenidoTablaAlianzas = "";
		$cssClassElements = "noActive";
	}
	else
	{
		$mensaje = $mensaje_alianzas;
		$informacion = $informacion_alianzas;
		$seleccionable = true;
		$excepcion_col = array("3");

		$contenidoTablaAlianzas = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col"));
	}

	$data2 = model("conseguirAlianzasBaja");
	extract($data2);

	if(isset($error))
	{
		exit();
		//ERROR
	}
	else if($mensaje_alianzas_baja === false)
	{
		$contenidoTablaAlianzasBaja = "";
		$cssClassElements .= " noInactive";
	}
	else
	{
		$mensaje = $mensaje_alianzas_baja;
		$informacion = $informacion_alianzas_baja;
		$seleccionable = true;
		$excepcion_col = array("3");

		$contenidoTablaAlianzasBaja = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col"));
	}
	
	view("formAlianzas",compact("contenidoTablaAlianzas","contenidoTablaAlianzasBaja","cssClassElements"));