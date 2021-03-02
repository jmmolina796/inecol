<?php

	$id_publicacion_proyecto_docente = $_POST["id_pub"];
	$url_proyecto = $_POST["urlProyecto"];
	$id_usuario = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : "0";
	$rol = $_SESSION["rol"];
	$type = ($_POST["type"] == "p") ? "1" : "0";

	$data3 = model("validaEliminarPublicacion",compact("id_publicacion_proyecto_docente","url_proyecto","id_usuario","type")); 
	extract($data3);

	if(isset($error))
	{
        // vista error
	}
	else if($mensaje_valida_eliminar_publicaciones === false)
	{
		// no hay nada que borrar (no creo que suceda esto);
	}
	else if($mensaje == 'OK') 
	{
		$data5 = model("conseguirNombresImagenesPublicaciones",compact("id_publicacion_proyecto_docente","type")); 
		extract($data5);

		if(isset($error))
		{
	        // vista error
		}
		else if($mensaje_nombres_images_publicaciones === false)
		{
			$informacion = "No hubo imagenes";
		}
		else
		{
			$fldr = ($type == "1") ? "imgPub" : "imgPubMod";
			foreach ($informacion_nombres_images_publicaciones as $key => $link) 
	        {
	            $nameFileToDelete = $link[0];
	            load("gestionarArchivos",$fldr,$nameFileToDelete);
	        }
		}

		$data6 = model("conseguirNombresArchivosPublicaciones",compact("id_publicacion_proyecto_docente","type")); 
		extract($data6);

		if(isset($error))
		{
	        // vista error
		}
		else if($mensaje_nombres_files_publicaciones === false)
		{
			$informacion = "No hubo archivos";
		}
		else
		{
			$fldr = ($type == "1") ? "filPub" : "filPubMod" ;
			foreach ($informacion_nombres_files_publicaciones as $key => $link) 
	        {
	            $nameFileToDelete = $link[0];
	            load("gestionarArchivos",$fldr,$nameFileToDelete);
	        }
		}

		$data10 = model("eliminarPublicacion",compact("id_publicacion_proyecto_docente","url_proyecto","id_usuario","type")); 
		extract($data10);

		if(isset($error))
		{
	        // vista error
		}
		else if($mensaje_eliminar_publicaciones === true)
		{
			sendToClient(compact('mensaje'));
		}
	}
	else
	{
		//$mensaje = "Eso que esta haciendo no esta permitido";
		sendToClient(compact('mensaje'));
	}