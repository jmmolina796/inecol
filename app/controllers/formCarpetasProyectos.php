<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$cssClassElements = "";

	$filtro_proyectos="Todos";
	$id_carpeta_proyecto="0";
	$busqueda_nombre_proyecto="0";
	
	$data = model("conseguirCarpetasProyectos");
	extract($data);

	if(isset($error))
	{
		exit();
		//ERRROR
	}
	else
	{
		if($mensaje_carpetas_proyectos === false)
		{
			$contenidoTablaCarpetasProyectos = "";
			$cssClassElements = "noActive";
		}
		else
		{
			$mensaje = $mensaje_carpetas_proyectos;
			$informacion = $informacion_carpetas_proyectos;
			$seleccionable = true;
			$link = "carpetas";
			$positionLink = "3";

			$contenidoTablaCarpetasProyectos = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","link","positionLink"));			
		}

		$data = model("conseguirCarpetasProyectosBaja");
		extract($data);

		if(isset($error))
		{
			exit();
			//ERRROR
		}
		else
		{
			if($mensaje_baja_carpetas_proyectos === false)
			{
				$contenidoTablaBajaCarpetasProyectos = "";	
				$cssClassElements = " noInactive";
			}
			else
			{
				$mensaje = $mensaje_baja_carpetas_proyectos;
				$informacion = $informacion_baja_carpetas_proyectos;
				$seleccionable = true;
				$link = "carpetas";
				$positionLink = "3";

				$contenidoTablaBajaCarpetasProyectos = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","link","positionLink"));
			}
		}
			view("formCarpetasProyectos",compact("contenidoTablaCarpetasProyectos","contenidoTablaBajaCarpetasProyectos","cssClassElements"));
	}