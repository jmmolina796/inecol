<?php

	$data = model("buscarEscuela",compact("clave"));

	extract($data);

	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_escuela === false)
	{
		//No coincide
	}
	else
	{


		$data2 = model("conseguirDocentesEscuelas",compact("clave"));

		extract($data2);

		if(isset($error))
		{
			//ERROR
		}
		else if($mensaje_docentes_escuelas === false)
		{
			$docentesRelacionados = "<p class='noResult'>No hay docentes participando.</p>";
		}
		else
		{
			$mensaje = $mensaje_docentes_escuelas;
			$informacion = $informacion_docentes_escuelas;
			$docentesRelacionados = builder("crearContenidoDocentesEscuelas",compact("informacion","mensaje"));
		}

		view("escuela",compact("clave_escuela","escuela","nivel_educativo","entidad","municipio","localidad","estatus","docentesRelacionados"));

	}