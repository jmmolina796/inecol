<?php

	$proyectosCss = "";

	$dataCiclosEscolares = model("conseguirTodosLosCiclosEscolares");
	extract($dataCiclosEscolares);

	if(isset($error))
	{

	}
	else if($mensaje_ciclos_escolares === false)
	{

	}
	else
	{
		
		$mensaje = $mensaje_ciclos_escolares;
			
	  	$informacion = $informacion_ciclos_escolares;
	   	$nombre = "el ciclo escolar";
	   	$valor = $informacion_ciclos_escolares[0][0];
	   	$id_ciclo_escolar = $informacion_ciclos_escolares[0][0];

	   
	    $selectCiclosEscolares = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

		// crear los proyectos activos y ciclo escolar actual 

		$dataDocente = model("buscarDocente",compact("id_docente"));
		extract($dataDocente);

		
		//$estadoProyectos='Activos';
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
		view("proyectosDocente",compact("nombre_docente","contenidoProyectosDocente","selectCiclosEscolares","proyectosCss"));
	}
