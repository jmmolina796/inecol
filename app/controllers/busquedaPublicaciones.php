<?php

	$url = $_POST['urlProyecto'];
	$urlProyecto = $_POST['urlProyecto'];
	$tipoBusqueda = $_POST['tipoBusqueda'];
	$type = ($_POST["type"] == "p") ? "1" : "0";

	if(isset($_SESSION["id_usuario"]))
	{
		$id_usuario = $_SESSION["id_usuario"];
		$rol = $_SESSION["rol"];
	}
	else
	{
		$id_usuario = "-1";
		$rol = "-1";
	}

	if(!isset($_POST["ordenamiento"]))
	{

		$ordenamiento = 'desc';	
	} 
	else
	{
		$ordenamiento = $_POST["ordenamiento"];
	}

	if($type == "1")
	{
		$data3 = model("conseguirCantidadPublicaciones",compact("urlProyecto","tipoBusqueda"));
	}
	else
	{
		$urlModulo = $urlProyecto;
		$data3 = model("conseguirCantidadPublicacionesMod",compact("urlModulo","tipoBusqueda"));
	}

	extract($data3);

	if(isset($error))
	{

	}
	else if($mensaje_cantidad === false)
	{
		$cantidad = 0;
	}

	if(isset($_POST["limit1"]))
	{

		if(isset($_POST["limit2"]))
		{
			$limit1 = $_POST['limit1'];
			$limit2 = $_POST['limit2'];
			$cantidad = $cantidad- ($limit1 + $limit2);

		}
		else
		{
			$limit1 = 0;  // 0
			$limit2 =  5;  // 6 
			$cantidad = $cantidad- ($limit1 + $limit2);
		}
	}
	else
	{
		$limit1 = 0;  // 0
		$limit2 =  5;  // 6 
		$cantidad = $cantidad- ($limit1 + $limit2);
	} 
	
	$condicion= '1';

	if($type == "1")
	{
		$id_publicacion_proyecto_docente = 0;
		$data2 = model("conseguirInfoPublicacionesProyecto",compact("urlProyecto","id_publicacion_proyecto_docente","condicion","ordenamiento","limit1","limit2","tipoBusqueda","id_usuario","rol")); 
	}
	else
	{
		$id_publicacion_modulo_docente = 0;
		$data2 = model("conseguirInfoPublicacionesModulo",compact("urlModulo","id_publicacion_modulo_docente","condicion","ordenamiento","limit1","limit2","tipoBusqueda","id_usuario","rol"));
	}

	extract($data2);
		
	if(isset($error))
	{

	}
	else 
	{
		$mensaje = ($type == "1") ? $mensaje_publicaciones_proyectos : $mensaje_publicaciones_modulos;
		if($mensaje === false)
		{
			echo "<p class='emptyMuro'>No se encontraron resultados</p>";
		}
		else
		{
			$informacion = ($type == "1") ? $informacion_publicaciones_proyectos : $informacion_publicaciones_modulos;
			$loader_section = builder("loader-section");
			$contenidoPublicacion = builder("crearPublicacionesProyectos",compact("mensaje","informacion","tipoBusqueda","loader_section","type"));
			if($cantidad>0)
			{
				$contenidoPublicacion .= builder("paginacionPublicaciones",compact("cantidad"));
			}
	         view("filtrarPublicaciones", compact("contenidoPublicacion"));	
		}
	}