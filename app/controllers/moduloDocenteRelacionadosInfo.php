<?php

	$id_docente = $_POST["id_docente"];
	$url = $_POST["url"];
	$type = $_POST["type"];
	$id_ciclo_escolar = $_POST["id_ciclo_escolar"];
	

	$data = model("buscarInformacionModuloDocenteRelacionado",compact("url","id_docente","type","id_ciclo_escolar"));

	extract($data);

	if(isset($error))
	{
	}
	else if($mensaje_info_docente_modulo === false)
	{

	}
	else
	{
		
		$nombre_completo = $informacion_info_docente_modulo[0][2]." ".$informacion_info_docente_modulo[0][3]." ".$informacion_info_docente_modulo[0][4];

		$mensaje = $mensaje_info_docente_modulo;
		$informacion = $informacion_info_docente_modulo;
		$element = "m";
		$tablaInfoModulo = builder("crearTablaInfoDocenteProyecto",compact("mensaje","informacion","element"));

		view("moduloDocenteRelacionadosInfo",compact("nombre_completo","tablaInfoModulo"));
	}