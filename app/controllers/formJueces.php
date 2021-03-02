<?php

	setPermission("root");
	endPermissions();

	$cssClassElements = "";

	$data = model("conseguirJueces");
	extract($data);

	if(isset($error))
	{
		exit();
		//ERROR
	}
	else if($mensaje_jueces === false)
	{
		$contenidoTablaJueces = "";
		$cssClassElements = "noActive";
	}
	else
	{
		$mensaje = $mensaje_jueces;
		$informacion = $informacion_jueces;
		$seleccionable = true;
		$excepcion_col = array("5","8","9","10");
		$link = "jueces";
		$positionLink = "11";

		$contenidoTablaJueces = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col","link","positionLink"));
	}

	$data2 = model("conseguirJuecesBaja");
	extract($data2);

	if(isset($error))
	{
		exit();
		//ERROR
	}
	else if($mensaje_jueces_baja === false)
	{
		$contenidoTablaJuecesBaja = "";
		$cssClassElements .= " noInactive";
	}
	else
	{
		$mensaje = $mensaje_jueces_baja;
		$informacion = $informacion_jueces_baja;
		$seleccionable = true;
		$excepcion_col = array("5","8","9","10");
		$link = "jueces";
		$positionLink = "11";

		$contenidoTablaJuecesBaja = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col","link","positionLink"));
	}
	
	view("formJueces",compact("contenidoTablaJueces","contenidoTablaJuecesBaja","cssClassElements"));