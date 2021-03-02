<?php

	$nombre_usuario = $_REQUEST['nombre_usuario'];
	$id_ciclo_escolar = $_REQUEST['id_ciclo_escolar'];
	$modulosCss = "";

	$dataModulosDocentes = model("conseguirModulosDocenteFiltroPerfil",compact("nombre_usuario","id_ciclo_escolar"));
	extract($dataModulosDocentes);

	if(isset($error))
	{

	}
	else if($mensaje_modulos_docente === false)
	{
		$modulosCss = "empty";
		$contenidoModulosDocente = "";
	}
	else
	{
		$mensaje = $mensaje_modulos_docente;
		$informacion = $informacion_modulos_docente;
		$contenidoModulosDocente = builder("crearContenidoModulosDocente",compact("mensaje","informacion"));
	}

	view("obtenerModulosDocente",compact("contenidoModulosDocente","modulosCss"));
