<?php

	$modulosCss = "";

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

		// crear los modulos activos y ciclo escolar actual 

		$dataDocente = model("buscarDocente",compact("id_docente"));
		extract($dataDocente);

		$dataModulosDocentes = model("conseguirModulosDocenteFiltro",compact("id_docente","id_ciclo_escolar"));
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
		view("modulosDocente",compact("nombre_docente","contenidoModulosDocente","selectCiclosEscolares","modulosCss"));
	}
