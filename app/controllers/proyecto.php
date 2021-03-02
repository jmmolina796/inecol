<?php

	
	$data = model("buscarProyecto",compact("id_proyecto"));
	extract($data);
	if(isset($error))
	{
		view("notfound");
	}
	else if($mensaje_proyecto === false)
	{
		view("notfound");
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
				$valor = "none";
			   	//$id_ciclo_escolar = "-1";
			}
			else
			{
			   	$valor = $id_ciclo_escolar;
			   	// $id_ciclo_escolar = $informacion_ciclos_escolares[0][0];
			}
		   	$selectCiclosEscolares = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));
		}
		

		$type = 1;
		$url = $link;  //De helpers

		$data = model("conseguirDocentesProyectosRelacionados",compact("url","type"));

		extract($data);

		$contentDocentesRelacionados = "";

		if(isset($error))
		{

		}
		else if($mensaje_proyecto_docente_relacionados === false)
		{
			$contentDocentesRelacionados = "<div class='docentesRelacionados-vacio'>".
												"<p>No hay docentes participando.</p>".
											"</div>";
		}
		else
		{
			$mensaje = $mensaje_proyecto_docente_relacionados;
			$informacion = $informacion_proyecto_docente_relacionados;
			$contentDocentesRelacionados = builder("crearContenidoProyectoDocentesRelacionado",compact("informacion","mensaje"));
		}
		
		$botonUnirse = "";
		$fecha1 = formatDate_dmy($fecha_inicio_inscripcion);
		$fecha2 = formatDate_dmy($fecha_fin_inscripcion);
		if(isTeacher() && joinToProyect($fecha1,$fecha2))
		{

			$botonUnirse = "<div class='contenedorBotonUnirse'>".
								"<div class='mt-button-magenta unirse-proyecto' data-IdProyecto='".$id_proyecto."'>Unirse</div>".
							"</div>";
		}

		$loader = builder("loader-section");

		view("proyecto",compact("mensaje_proyecto", "id_proyecto","nombre_proyecto","fecha_inicio_inscripcion","fecha_fin_inscripcion","fecha_inicio","fecha_fin","fecha_ini_ins_tex","fecha_fin_ins_tex","fecha_ini_tex","fecha_fin_tex","nombre_ciclo_escolar","nombre_administrador","fecha_creacion","descripcion","imagen_portada","estatus","fecha_inicio_ciclo_escolar","fecha_fin_ciclo_escolar","estado","css_estado","contentDocentesRelacionados","botonUnirse","selectCiclosEscolares","color","loader"));
	}