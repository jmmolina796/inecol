<?php

	if(isset($_SESSION["id_usuario"]))
	{
		$proyectosCss = "";

		$filtro_proyectos="Todos";
		$id_carpeta_proyecto="0";
		$busqueda_nombre_proyecto="0";
		$data = model("conseguirProyectosFiltro",compact("id_carpeta_proyecto","filtro_proyectos","busqueda_nombre_proyecto"));
		extract($data);

		if(isset($error))
		{

		}
		else if($mensaje_proyectos===false)
		{
			$proyectosCss = "empty";
		}
		else
		{
			$mensaje = $mensaje_proyectos;
			$informacion = $informacion_proyectos;
			$contenidoPosts = builder("crearSeleccionadorPosts",compact("informacion","mensaje"));
		}

		view("seleccionar-proyectos",compact("contenidoPosts","proyectosCss"));
	}
	else
	{
		view("notfound");
	}