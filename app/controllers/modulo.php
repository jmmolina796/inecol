<?php

	$data = model("buscarModulo",compact("id_modulo"));
	extract($data);
	if(isset($error))
	{
		view("notfound");
	}
	else if($mensaje_modulo === false)
	{
		view("notfound");
	}
	else
	{

		$dataCiclosEscolares = model("conseguirTodosLosCiclosEscolares");
		extract($dataCiclosEscolares);

		if(isset($error))
		{

		}
		else if($mensaje_ciclos_escolares === false)
		{
			$id_ciclo_escolar = "-1";
			$selectCiclosEscolares = "";
		}
		else
		{
			$mensaje = $mensaje_ciclos_escolares;
		  	$informacion = $informacion_ciclos_escolares;
		   	$nombre = "el ciclo escolar";

			if($mensaje_ciclos_escolares === false)
			{
				$valor = "none";
			   	$id_ciclo_escolar = "-1";
			}
			else
			{
			   	$valor = $informacion_ciclos_escolares[0][0];
			   	$id_ciclo_escolar = $informacion_ciclos_escolares[0][0];
			}

		   	$contentSelect = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

		   	$selectCiclosEscolares = "<select class='sgl' id='slCicloEscolar' data-label='Campo requerido' data-require='true' name='slCicloEscolar' data-name='Ciclo Escolar:'>".
										$contentSelect.
									"</select>";
		}
			
		$type = 1;
		$url = $link;  //De helpers

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


		view("modulo",compact("id_modulo","nombre_modulo","nombre_administrador","fecha_creacion","descripcion","imagen_portada","color","contentDocentesRelacionados","selectCiclosEscolares"));
	}