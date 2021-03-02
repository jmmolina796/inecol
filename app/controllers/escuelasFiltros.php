<?php

	$numero_docentes = $_POST["numero_docentes"];
	$tipo = $_POST["tipo"];

	$data = model("conseguirEscuelasUsuarios",compact("numero_docentes","tipo"));
	extract($data);

	if(isset($error))
	{
		//ERRROR
	}
	else if($mensaje_escuelas_usuarios === false)
	{
		$htmlTabla = "<p class='noEscuelas'>No se encontraron escuelas.</p>";
	}
	else
	{
		$mensaje = $mensaje_escuelas_usuarios;
		$informacion = $informacion_escuelas_usuarios;
		$seleccionable = false;
		$excepcion_col = array("7");
		$link = "escuelas";
		$positionLink = "8";

		$contenidoTablaEscuelas = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col","link","positionLink"));

		$htmlTabla = builder("crearTablaEscuelas",compact("contenidoTablaEscuelas"));
		
	}

	view("escuelasFiltros",compact("htmlTabla"));