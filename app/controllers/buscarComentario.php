<?php

	$id_comentario_publicacion = $_POST["idC"];
	$id_publicacion = $_POST["idP"];
	$usr = $_POST["usr"];
	$url_proyecto = $_POST["url"];
	$type = ($_POST["type"] == "p") ? "1" : "0";

	if($usr == "tch")
	{
		$rol = "0";
	}
	else
	{
		$rol = "1";
	}

	$data = model("buscarComentario",compact("url_proyecto","id_publicacion","id_comentario_publicacion","rol","type"));
	extract($data);

	if(isset($error))
	{
        // vista error
	}
	else if($mensaje_comentario_publicacion === false)
	{
		// no hay nada que borrar (no creo que suceda esto);
	}
	else
	{
		$informacion = $informacion_comentario_publicacion;
        $campoComentario = false;
        $cargarComentarios = false;
        $cantidad_comentarios_publicacion = 0;

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

		$contenidoComentario =  builder("crearComentariosPublicacion",compact("informacion","campoComentario","cargarComentarios","cantidad_comentarios_publicacion","imagen_usuario"));

		view("comentarioPublicacion",compact("contenidoComentario"));
	}