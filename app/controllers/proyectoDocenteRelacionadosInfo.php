<?php

	$id_docente = $_POST["id_docente"];
	$id_ciclo_escolar = $_POST["id_ciclo_escolar"];
	$type = $_POST["type"];

	if($type == 0)
	{
		$urlProyecto = $_POST["url"];
		
		$data2 = model("buscarUrlProyectoCicloEscolar",compact("urlProyecto","id_ciclo_escolar"));
		extract($data2);
		if(isset($error))
		{
			//Error	
		}
		else if($mensaje_proyecto === false)
		{
			//Tiene que haber url del proyecto
		}
		else
		{
			//Se obtiene la url del proyecto
		}
	}
	else
	{
		$url = $_POST["url"];
	}

	$data = model("buscarInformacionProyectoDocenteRelacionado",compact("url","id_docente"));

	extract($data);

	if(isset($error))
	{
	}
	else if($mensaje_info_docente_proyecto === false)
	{

	}
	else
	{
		$nombre_completo = $informacion_info_docente_proyecto[0][2]." ".$informacion_info_docente_proyecto[0][3]." ".$informacion_info_docente_proyecto[0][4];

		$mensaje = $mensaje_info_docente_proyecto;
		$informacion = $informacion_info_docente_proyecto;
		$element = "p";
		$tablaInfoProyecto = builder("crearTablaInfoDocenteProyecto",compact("mensaje","informacion","element")) ;

		view("proyectoDocenteRelacionadosInfo",compact("nombre_completo","tablaInfoProyecto"));
	}