<?php

	$proyectosCss = "";

	$id_ciclo_escolar = $_POST["id_ciclo_escolar"];
	//$estadoProyectos = $_POST["estadoProyecto"];

	$nombre_usuario = $_POST["nombre_usuario"];

	/*if($estadoProyectos=="1")
	{
		$estadoProyectos="Activos";
	}
	 if($estadoProyectos=="2")
	{
		$estadoProyectos="Finalizados";
	}
	if($estadoProyectos=="3")
	{
		$estadoProyectos="Pendientes";
	}
	*/
	
	$dataProyectosDocentes = model("conseguirProyectosDocenteFiltro",compact("nombre_usuario","id_ciclo_escolar"));
	extract($dataProyectosDocentes);

	if(isset($error))
	{

	}
	else if($mensaje_proyectos_docente === false)
	{
		$proyectosCss = "empty";
		$contenidoProyectosDocente = "";
	}
	else
	{
		$mensaje = $mensaje_proyectos_docente;
		$informacion = $informacion_proyectos_docente;
		$contenidoProyectosDocente = builder("crearContenidoProyectosDocente",compact("mensaje","informacion"));
	}
	view("proyectosDocenteFiltros",compact("contenidoProyectosDocente","proyectosCss"));