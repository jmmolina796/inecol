<?php

	
	$urlProyecto = $_POST["urlProyecto"];
	$id_ciclo_escolar = $_POST["id_ciclo_escolar"];

	$data = model("buscarUrlProyectoCicloEscolar",compact("urlProyecto","id_ciclo_escolar"));
	extract($data);

	if(isset($error))
	{
		// view("notfound");
	}
	else if($mensaje_proyecto === false)
	{
		$docentesRelacionados = "<div class='docentesRelacionados-vacio'>".
												"<p>No hay docentes participando.</p>".
											"</div>";

		view("obtenerDocentesProyectoCicloEsc",compact("docentesRelacionados"));
	}
	else
	{

		$type = 1;

		$data2 = model("conseguirDocentesProyectosRelacionados",compact("url","type"));

		extract($data2);

		if(isset($error))
		{

		}
		else if($mensaje_proyecto_docente_relacionados === false)
		{
			$docentesRelacionados = "<div class='docentesRelacionados-vacio'>".
												"<p>No hay docentes participando.</p>".
											"</div>";

			view("obtenerDocentesProyectoCicloEsc",compact("docentesRelacionados"));
		}
		else
		{	
		   	$mensaje = $mensaje_proyecto_docente_relacionados;
			$informacion = $informacion_proyecto_docente_relacionados;
			$docentesRelacionados = builder("crearContenidoProyectoDocentesRelacionado",compact("informacion","mensaje"));

			view("obtenerDocentesProyectoCicloEsc",compact("docentesRelacionados"));
		}	
	}