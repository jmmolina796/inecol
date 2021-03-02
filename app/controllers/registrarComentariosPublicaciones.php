<?php

	$comentario = $_POST['comentario'];
	$id_publicacion_proyecto_docente = $_POST['id_publicacion'];
	$url = $_POST['url'];
	$type = ($_POST["type"] == "p") ? "1" : "0" ;
	$id_usuario = $_SESSION["id_usuario"];
	$rol = $_SESSION["rol"];

	$data = model("registrarComentariosPublicaciones",compact("id_publicacion_proyecto_docente", "comentario", "id_usuario", "rol", "url","type"));

	extract($data);

	if(isset($error))
	{

	}
	else if($mensaje_comentarios_publicaciones === false)
	{
		
	}
	else
	{
		$mensaje = $mensaje_comentarios_publicaciones;

		$data2 = model("conseguirCantidadComentariosPublicacion",compact("id_publicacion_proyecto_docente","type"));

		extract($data2);

		if(isset($error))
		{

		}
		else if($mensaje_cantidad_comentarios_publicaciones === false)
		{
			$cantidad_comentarios = "";
		}
		else
		{
			$cantidad_comentarios = $cantidad_comentarios_publicacion;
		}

        $informacion = $informacion_comentarios_publicaciones;
        $campoComentario = false;


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
        $cargarComentarios = false;


        $com =  builder("crearComentariosPublicacion",compact("informacion","campoComentario","cargarComentarios","cantidad_comentarios_publicacion","imagen_usuario"));
        $can = $cantidad_comentarios;

        if(isTeacher())
        {
        	$usr = "tch";
        }
        else
        {
        	$usr = "adm";
        }

        sendToClient(compact("com","can","usr"));
	}