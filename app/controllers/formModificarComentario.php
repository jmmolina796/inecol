<?php

	$id_comentario_publicacion = $_POST["id_comn"];
	$id_publicacion = $_POST["id_pub"];
	$url_proyecto = $_POST["urlProyecto"];
	$id_usuario = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : "0"; //Es decir ninguno
	$rol = $_SESSION["rol"];
	$type = ($_POST["type"] == "p") ? "1" : "0";

	$imagen_usuario = "";

	if(isset($_SESSION["id_usuario"]))
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

	$data = model("verificarComentarios",compact("id_comentario_publicacion","id_publicacion","url_proyecto","id_usuario","rol","type")); 
	extract($data);

	if(isset($error))
	{
        // vista error
	}
	else if($mensaje_verificar_comentarios === false)
	{
		// no hay nada que borrar (no creo que suceda esto);
	}
	else if($mensaje == '1')
	{
		$data2 = model("buscarComentario",compact("url_proyecto","id_publicacion","id_comentario_publicacion","rol","type"));
		extract($data2);

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
			$comentario_publicacion = $informacion_comentario_publicacion[0]["comentario_publicacion"];
			view("formModificarComentario",compact("imagen_usuario","id_comentario_publicacion","comentario_publicacion"));
		}
	}
	else
	{
		//Vacío
	}	