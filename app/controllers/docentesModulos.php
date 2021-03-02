<?php

	$urlModulo = $_REQUEST["urlModulo"];
	$id_ciclo_escolar = $_REQUEST["id_ciclo_escolar"];
	
	
	$type = 1;
	$url = $urlModulo;  //De helpers

	$data2 = model("conseguirDocentesModulosRelacionados",compact("url","id_ciclo_escolar","type"));

	extract($data2);

	$contentDocentesRelacionados = "";



	if(isset($error))
	{

	}
	else if($mensaje_modulo_docente_relacionados === false)
	{
		$contentDocentesRelacionados = "<div class='docentesRelacionados-vacio'>".
											"<p>No hay docentes participando.</p>".
										"</div>";
	}
	else
	{
		$mensaje = $mensaje_modulo_docente_relacionados;
		$informacion = $informacion_modulo_docente_relacionados;
		$contentDocentesRelacionados = builder("crearContenidoModuloDocentesRelacionado",compact("informacion","mensaje"));
	}

	view("docentesModulos",compact("contentDocentesRelacionados"));
	