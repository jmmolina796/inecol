<?php

	$url = $_POST["urlProyecto"];

	$data7 = model("obtenerCicloEscolarUrlProyecto",compact("url"));
	extract($data7);

	if(isset($error))
	{

	}
	else
	{
		$dataCiclosEscolares = model("conseguirCiclosEscolaresProyecto",compact("id_proyecto"));
		extract($dataCiclosEscolares);

		if(isset($error))
		{

		}
		else
		{
			$mensaje = $mensaje_ciclos_escolares;
		  	$informacion = $informacion_ciclos_escolares;
		   	$nombre = "el ciclo escolar";

			if($mensaje_ciclos_escolares === false)
			{
				//No puede entrar aquí
			}
			else
			{
			   	$valor = $id_ciclo_escolar;
			}

		   	$selectCiclosEscolares = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

		}

		$urlProyecto = $url;

		$data = model("buscarUrlProyectoCicloEscolar",compact("urlProyecto","id_ciclo_escolar"));
		extract($data);

		if(isset($error))
		{
			// view("notfound");
		}
		if($mensaje_proyecto === false)
		{
			/*$docentesRelacionados ="No se encontraron docentes";
			view("proyectoDocenteRelacionados",compact("docentesRelacionados","selectCiclosEscolares"));*/
		}
		else
		{
			$type = 1;

			$data = model("conseguirDocentesProyectosRelacionados",compact("url","type"));

			extract($data);

			if(isset($error))
			{

			}
			else if($mensaje_proyecto_docente_relacionados === false)
			{
				$docentesRelacionados = "<div class='docentesRelacionados-vacio'>".
											"<p>No hay docentes participando.</p>".
										"</div>";
			}
			else
			{
				$mensaje = $mensaje_proyecto_docente_relacionados;
				$informacion = $informacion_proyecto_docente_relacionados;
				$docentesRelacionados = builder("crearContenidoProyectoDocentesRelacionado",compact("informacion","mensaje"));
			}
				view("proyectoDocenteRelacionados",compact("docentesRelacionados","selectCiclosEscolares"));
		}
	}