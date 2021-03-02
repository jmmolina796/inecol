<?php

	$url = $_POST["urlModulo"];

	$dataCiclosEscolares = model("conseguirTodosLosCiclosEscolares");
	extract($dataCiclosEscolares);

	if(isset($error))
	{

	}
	else
	{
		$mensaje = $mensaje_ciclos_escolares;
	  	$informacion = $informacion_ciclos_escolares;
	   	$nombre = "el ciclo escolar";

	   	$id_usuario = "-1";
		$rol = "-1";
	   	$dataCicloModulo = model("buscarModuloDocente",compact("url", "id_usuario", "rol"));

	   	extract($dataCicloModulo);

	   	if(isset($error))
	   	{
	   		//ERROR
	   	}
	   	else if($mensaje_modulo_docente === false)
	   	{
	   		$valor = "none";
	   	}
	   	else
	   	{	
	   		$valor = $id_ciclo_escolar;
	   	}


		if($mensaje_ciclos_escolares === false)
		{
			$valor = "none";
		   	$id_ciclo_escolar = "-1";
		}
		
		
	   	$selectCiclosEscolares = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

		$type = 0;

		$data = model("conseguirDocentesModulosRelacionados",compact("url","id_ciclo_escolar","type"));

		extract($data);

		if(isset($error))
		{

		}
		else if($mensaje_modulo_docente_relacionados === false)
		{
			$docentesRelacionados = "<div class='docentesRelacionados-vacio'>".
											"<p>No hay docentes participando.</p>".
										"</div>";
		}
		else
		{
			$mensaje = $mensaje_modulo_docente_relacionados;
			$informacion = $informacion_modulo_docente_relacionados;
			$docentesRelacionados = builder("crearContenidoModuloDocentesRelacionado",compact("informacion","mensaje"));
		}
			view("moduloDocenteRelacionados",compact("docentesRelacionados","selectCiclosEscolares"));
	}