<?php

	if(isset($_SESSION["id_usuario"]))
	{
		$proyectosCss = "";

		$filtro_proyectos=$_POST['filtro_proyectos'];
		$id_carpeta_proyecto = $_POST['id_carpeta_proyecto'];
		$busqueda_nombre_proyecto = $_POST['busqueda_nombre_proyecto'];
		$data = model("conseguirProyectosFiltro",compact("id_carpeta_proyecto","filtro_proyectos","busqueda_nombre_proyecto"));
		extract($data);

		if($mensaje_proyectos===false)
		{
			$proyectosCss = "empty";
		}
		else
		{
			$mensaje = $mensaje_proyectos;
			$informacion = $informacion_proyectos;
			$contenidoPosts = builder("crearSeleccionadorPosts",compact("informacion","mensaje"));
		}
		
		view("seleccionar-proyectos_filtro",compact("contenidoPosts","proyectosCss"));

	}
	