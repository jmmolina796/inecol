<?php

	$data = model("buscarDocente",compact("id_docente"));
	$modulosCss = "";

	extract($data);

	if(isset($error))
	{

	}
	else if($mensaje_docente === false)
	{

	}
	else
	{

		$data2 = model("conseguirEscuelasDocentes",compact("id_docente")); 

		extract($data2);

		if(isset($error))
		{

		}
		else if($mensaje_escuelas_docentes === false)
		{
			$escuelasDocente = "<p class='noEscuelas'>No tiene ninguna escuela.</p>";
		}
		else
		{
			$tablaEscuelasDocente = builder("crearTablaEscuelasDocentePerfil",compact("informacion_escuelas_docentes"));

			$escuelasDocente = "<table>".
									"<thead>".
										"<td>Clave</td>".
										"<td>Escuela</td>".
										"<td>Nivel educativo</td>".
										"<td>Grado</td>".
										"<td>Grupo</td>".
									"</thead>".
									$tablaEscuelasDocente.
								"</table>";
		}
		
		$nombre_completo = $nombre_docente." ".$ape_paterno." ".$ape_materno;

		if(empty($telefono))
		{
			$telefono = "Ninguno";
		}

		$data3 = model("conseguirProyectosDocente",compact("id_docente"));

		extract($data3);

		if(isset($error))
		{

		}
		else if($mensaje_proyectos_docente === false)
		{
			$proyectosDocente = "<p class='noResult'>No está participando en ningún proyecto.</p>";
		}
		else
		{
			$mensaje = $mensaje_proyectos_docente;
			$informacion = $informacion_proyectos_docente;
			$proyectosDocente = builder("crearContenidoProyectosDocente",compact("mensaje","informacion"));
		}


		$dataCiclosEscolares = model("conseguirTodosLosCiclosEscolares");
		extract($dataCiclosEscolares);

		if(isset($error))
		{

		}
		else if($mensaje_ciclos_escolares === false)
		{
			$id_ciclo_escolar = "-1";
		}
		else
		{
			
			$mensaje = $mensaje_ciclos_escolares;
				
		  	$informacion = $informacion_ciclos_escolares;
		   	$nombre = "el ciclo escolar";
		   	$valor = $informacion_ciclos_escolares[0][0];
		   	$id_ciclo_escolar = $informacion_ciclos_escolares[0][0];
		   	$selectCiclosEscolares = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));
		}


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


		if(isSessionStarted() && ($_SESSION["usuario"] == $nombre_usuario) )
		{
			view("docente",compact("nombre_completo","nombre_usuario","email","telefono","entidad","municipio","nombre_localidad","imagen","informacion_proyectos_docente","mensaje_proyectos_docente","escuelasDocente","proyectosDocente","selectCiclosEscolares","contenidoModulosDocente","modulosCss","color"));
		}
		else
		{
			$infoUsuario = "";
			$infoChat = "";
			if(isSessionStarted())
			{
				$infoUsuario = "<div class='informacion-usuario'>".
									"<div class='infoUsuario-header'>".
										"<h3>Información</h3>".
									"</div>".
									"<p>".
										"<span>Correo electrónico:</span>".
										"<span>$email</span> ".
									"</p>".
									"<p>".
										"<span>Teléfono:</span>".
										"<span>$telefono</span>".
									"</p>".
									"<p>".
										"<span>Entidad:</span>".
										"<span>$entidad</span>".
									"</p>".
									"<p>".
										"<span>Municipio:</span>".
										"<span>$municipio</span>".
									"</p>".
									"<p>".
										"<span>Localidad:</span>".
										"<span><$nombre_localidad</span>".
									"</p>".
								"</div>";

				$infoChat = "<div class='mensaje goToUrl'>".
							"<a class='no-style' href='".chatsLink($nombre_usuario)."'>".
								"<span>Mensaje</span>".
							"</a>".
						"</div>";
			}
			view("docente_invitado",compact("nombre_completo","nombre_usuario","infoUsuario","infoChat","imagen","informacion_proyectos_docente","mensaje_proyectos_docente","escuelasDocente","proyectosDocente","selectCiclosEscolares","contenidoModulosDocente","modulosCss","color"));
		}

	}