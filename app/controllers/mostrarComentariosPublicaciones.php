<?php

	$id_publicacion_proyecto_docente = $_POST["id_publicacion"];
	$url = $_POST["urlProyecto"];
	$limit1 = $_POST["limit1"];
	$limit2 = $_POST["limit2"];
	$type = ($_POST["type"] == "p") ? "1" : "0";
	$imagen_usuario = "";

	if(isSessionStarted())
	{
		if($_SESSION["rol"] == "0")
		{
			$imagen_usuario = URL_SERVER.URL_DOC_IMG.$_SESSION["imagen"];
		}
		else
		{
			$imagen_usuario = URL_SERVER.URL_ADM_IMG.$_SESSION["imagen"];
		}
	}

	$data5 = model("conseguirCantidadComentariosPublicacion",compact("id_publicacion_proyecto_docente","type")); 
	extract($data5);

	if($limit1 == 0)
	{
		$cantidad_comentarios_publicacion = $cantidad_comentarios_publicacion - $limit2;
		$campoComentario = true;
	}
	else
	{
		$cantidad_comentarios_publicacion = $cantidad_comentarios_publicacion - ($limit1+5);
		$campoComentario = false;
	}

	$data6 = model("conseguirInfoComentariosPublicaciones",compact("url","id_publicacion_proyecto_docente","limit1","limit2","type")); 
	extract($data6);


	if(isset($error))
	{
        // vista error
	}
	else
	{
		if($mensaje_comentarios_publicaciones === false)
		{
			$informacion = "";
		}
		else
		{
			$informacion = $informacion_comentarios_publicaciones;
		}
		
		$cargarComentarios = true;

		$contenidoComentariosPublicacion =  builder("crearComentariosPublicacion",compact("informacion","campoComentario","cargarComentarios","cantidad_comentarios_publicacion","imagen_usuario"));

		view("comentariosPublicacion",compact("contenidoComentariosPublicacion"));
	}