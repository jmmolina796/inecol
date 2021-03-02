<?php

	$requesUrl = explode("/", $_SERVER['REQUEST_URI']);     //Cambiar al subir al servidor
	
	$tama = count($requesUrl);

	$url = $requesUrl[$tama-1];

	$cssPublicaciones = "";

	if(isSessionStarted())
	{
		$id_usuario = $_SESSION["id_usuario"];
		$rol = $_SESSION["rol"];
	}
	else
	{
		$id_usuario = "-1";
		$rol = "-1";
	}

	$data = model("buscarModuloDocente",compact("url", "id_usuario", "rol"));

	extract($data);

	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_modulo_docente === false)
	{
		var_dump("expression");
	}
	else
	{
		
		$nombre_docente_iniciales = $nombre_docente." ".$ape_paterno_docente[0].". ".$ape_materno_docente[0].".";
		$nombre_docente_completo = $nombre_docente." ".$ape_paterno_docente." ".$ape_materno_docente;
		
		$urlModulo = $requesUrl[$tama-1];

		$id_publicacion_modulo_docente = 0;
		$condicion= '1';
		$ordenamiento = 'desc';
		$limit1 = 0;
		$limit2 = 5;
		$tipoBusqueda = 'AllPublicaciones';
		$data2 = model("conseguirInfoPublicacionesModulo",compact("urlModulo","id_publicacion_modulo_docente","condicion","ordenamiento","limit1","limit2","tipoBusqueda","id_usuario","rol")); 


		extract($data2);

		if(isset($error))
		{
			var_dump($error);
		}
		else if($mensaje_publicaciones_modulos === false)
		{
			$contenidoPublicacion = "";
			$cssPublicaciones = "cntDcMuroVc";
		}
		else
		{
			$mensaje = $mensaje_publicaciones_modulos;
			$informacion = $informacion_publicaciones_modulos;
			$loader_section = builder("loader-section");
			$type = "0";

			$contenidoPublicacion = builder("crearPublicacionesProyectos",compact("mensaje","informacion","tipoBusqueda","loader_section","id_usuario","imagen_usuario","rol","type"));

			$data3 = model("conseguirCantidadPublicacionesMod",compact("urlModulo","tipoBusqueda"));
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

			view("moduloDocenteGestion",compact("id_rel_modulo_docente", "id_modulo", "url_rel_modulo", "rel_estatus_modulo_docente", "rel_estatus_modulo", "cant_likes", "css_likes" ,"nombre_docente_completo", "nombre_docente_iniciales", "nombre_usuario", "imagen_docente", "nombre_modulo", "descripcion", "rel_estatus_fecha_modulo", "css_estatus_modulo", "imagen_portada", "url_modulo", "estatus_modulo", "nombre_ciclo_escolar", "clave_escuela", "nombre_escuela", "nombre_grado", "nombre_grupo","contenidoPublicacion","loader_section","urlModulo","cssPublicaciones", "color"));
		}
		else
		{
			view("moduloDocenteUsuario",compact("id_rel_modulo_docente", "id_modulo", "url_rel_modulo", "rel_estatus_modulo_docente", "rel_estatus_modulo", "cant_likes", "css_likes" ,"nombre_docente_completo", "nombre_docente_iniciales", "nombre_usuario", "imagen_docente", "nombre_modulo", "descripcion", "rel_estatus_fecha_modulo", "css_estatus_modulo", "imagen_portada", "url_modulo", "estatus_modulo", "nombre_ciclo_escolar", "clave_escuela", "nombre_escuela", "nombre_grado", "nombre_grupo","contenidoPublicacion","urlModulo","cssPublicaciones", "color"));
		}
	}