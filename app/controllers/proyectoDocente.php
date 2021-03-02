<?php

	$requesUrl = explode("/", $_SERVER['REQUEST_URI']);     //Cambiar al subir al servidor
	
	$tama = count($requesUrl);

	$url = $requesUrl[$tama-1];

	$cssPublicaciones = "";

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

	$data = model("buscarProyectoDocente",compact("url", "id_usuario", "rol"));

	extract($data);

	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_proyecto_docente === false)
	{
		var_dump("expression");
	}
	else
	{
			$nombre_docente_iniciales = $nombre_docente." ".$ape_paterno_docente[0].". ".$ape_materno_docente[0].".";
			$nombre_docente_completo = $nombre_docente." ".$ape_paterno_docente." ".$ape_materno_docente;
			
			$urlProyecto = $requesUrl[$tama-1];

			$id_publicacion_proyecto_docente = 0;
			$condicion= '1';
			$ordenamiento = 'desc';
			$limit1 = 0;
			$limit2 = 5;
			$tipoBusqueda = 'AllPublicaciones';
			$data2 = model("conseguirInfoPublicacionesProyecto",compact("urlProyecto","id_publicacion_proyecto_docente","condicion","ordenamiento","limit1","limit2","tipoBusqueda","id_usuario","rol")); 

			extract($data2);

			if(isset($error))
			{
				var_dump($error);
			}
			else if($mensaje_publicaciones_proyectos === false)
			{
				$contenidoPublicacion = "";
				$cssPublicaciones = "cntDcMuroVc";
			}
			else
			{
				$mensaje = $mensaje_publicaciones_proyectos;
				$informacion = $informacion_publicaciones_proyectos;
				$loader_section = builder("loader-section");
				$type = "1";

				$contenidoPublicacion = builder("crearPublicacionesProyectos",compact("mensaje","informacion","tipoBusqueda","loader_section","id_usuario","imagen_usuario","rol","type"));

				$data3 = model("conseguirCantidadPublicaciones",compact("urlProyecto","tipoBusqueda"));
				extract($data3);
				$cantidad = $cantidad-$limit2;

				if($cantidad>0)
				{
					$contenidoPublicacion .= builder("paginacionPublicaciones",compact("cantidad"));
				}

			}

			if(isSessionStarted() && $nombre_usuario == $_SESSION["usuario"])
			{
				$loader_section = builder("loader-section");

				view("proyectoDocenteGestion",compact("id_rel_proyecto_docente", "id_proyecto", "url_rel_proyecto", "rel_estatus_proyecto_docente", "rel_estatus_proyecto", "cant_likes", "css_likes" ,"nombre_docente_completo", "nombre_docente_iniciales", "nombre_usuario", "imagen_docente", "nombre_proyecto", "descripcion", "rel_estatus_fecha_proyecto", "css_estatus_proyecto", "imagen_portada", "url_proyecto", "estatus_proyecto", "nombre_ciclo_escolar", "clave_escuela", "nombre_escuela", "nombre_grado", "nombre_grupo","contenidoPublicacion","loader_section","urlProyecto","cssPublicaciones","color"));
			}
			else
			{
				view("proyectoDocenteUsuario",compact("id_rel_proyecto_docente", "id_proyecto", "url_rel_proyecto", "rel_estatus_proyecto_docente", "rel_estatus_proyecto", "cant_likes", "css_likes" ,"nombre_docente_completo", "nombre_docente_iniciales", "nombre_usuario", "imagen_docente", "nombre_proyecto", "descripcion", "rel_estatus_fecha_proyecto", "css_estatus_proyecto", "imagen_portada", "url_proyecto", "estatus_proyecto", "nombre_ciclo_escolar", "clave_escuela", "nombre_escuela", "nombre_grado", "nombre_grupo","contenidoPublicacion","urlProyecto","cssPublicaciones","color"));
			}

	}