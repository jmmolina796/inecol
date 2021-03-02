<?php

	$mod = $_POST["mod"];

	if($mod == "p")
	{
		$urlProyecto = $_POST["urlWall"];
		$data = model("buscarInformacionProyecto", compact("urlProyecto"));
		extract($data);
		$nombre = "Proyecto: ".$nombre;
		$link = userProjectLink($urlProyecto);
	}
	else if($mod == "m")
	{
		$urlModulo = $_POST["urlWall"];
		$data = model("buscarInformacionModulo", compact("urlModulo"));
		extract($data);
		$nombre = "Módulo: ".$nombre;
		$link = userModuleLink($urlModulo);
	}

	if(isset($error))
	{

	}
	else
	{
		$mensaje_informacion_wall = isset($mensaje_informacion_proyecto) ? $mensaje_informacion_proyecto : $mensaje_informacion_modulo;

		if($mensaje_informacion_wall === false)
		{

		}
		else
		{
        	view("modalQrProyectoDocente",compact("nombre","link"));
			
		}
	}