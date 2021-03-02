<?php

	$id_publicacion_proyecto_docente = $_POST["id_pub"];
	$url_proyecto = $_POST["urlP"];
	$id_usuario = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : "0";
	$type = $_POST["type"];

	if($type == "p")
	{
		$type = "1";
	}
	else
	{
		$type = "0";
	}

	$data = model("buscarInfoPublicacionProyecto",compact("url_proyecto","id_publicacion_proyecto_docente","id_usuario","type"));
	extract($data);

	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_publicacion_proyecto === false)
	{
		echo "NO";
	}
	else
	{
		$mensaje = $mensaje_publicacion_proyecto;
		$informacion = $informacion_publicacion_proyecto;
		$propietario = true;
		$contenidoMultimedia = builder("crearContenedorEditarPublicacion",compact("mensaje","informacion","propietario","type"));

		$loader_section = builder("loader-section");
		view("editarPublicacion",compact("contenidoMultimedia","id_publicacion_proyecto_docente","loader_section"));
	}