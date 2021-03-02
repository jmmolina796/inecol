<?php

	setPermission("administrator");
	setPermission("root");
    endPermissions();
	
	$cssClassElements = "";

	$data = model("conseguirInstituciones");
    extract($data);


	if(isset($error))
	{
		exit();
		//ERRROR
	}
	else if($mensaje_instituciones === false)
	{
		$contenidoTablaInstituciones = "";
		$cssClassElements = "noActive";
	}
	else
	{
		$mensaje = $mensaje_instituciones;
		$informacion = $informacion_instituciones;
		$seleccionable = true;
		$excepcion_col = array("3");

		$contenidoTablaInstituciones = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col"));
	}

	$data2 = model("conseguirInstitucionesBaja");
    extract($data2);

	if(isset($error))
	{
		exit();
		//ERROR
	}
	else if($mensaje_instituciones_baja === false)
	{
		$contenidoTablaInstitucionesBaja = "";
		$cssClassElements .= " noInactive";
	}
	else
	{
		$mensaje = $mensaje_instituciones_baja;
		$informacion = $informacion_instituciones_baja;
		$seleccionable = true;
		$excepcion_col = array("3");

		$contenidoTablaInstitucionesBaja = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col"));
	}
	
	view("formInstituciones",compact("contenidoTablaInstituciones","contenidoTablaInstitucionesBaja","cssClassElements"));