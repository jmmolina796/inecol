<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_administrador = $_SESSION["id_usuario"];
	
	$grados = $_POST["grados"];

	$tipo_proyecto = $_POST["tipo_proyecto"];
	$id_proyecto_renovacion = $_POST["id_proyecto_renovacion"];

    $alianzas = ($_POST["alianzas"] == "") ? array() : $_POST["alianzas"];

	$data = model("conseguirCiclosEscolaresActivos");

	extract($data);

	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_ciclos_escolares_activos === false)
	{
		$resultado = "No se pueden guardar los datos debido a que no hay un ciclo escolar activo";
		$mensaje = $mensaje_ciclos_escolares_activos;
	    sendToClient(compact("resultado","mensaje"));
	}
	else
	{
		$id_ciclo = $informacion_ciclos_escolares_activos[0][0];
		$nombre	= $_POST["proyecto-nombre"];
		$descripcion = $_POST["proyecto-descripcion"];

		$fecha_inicio_inscripcion = $_POST["proyecto-fechaInicioInscripcion"];
		$fecha_fin_inscripcion = $_POST["proyecto-fechaFinInscripcion"];
		$fecha_inicio = $_POST["proyecto-fechaInicio"];
		$fecha_fin = $_POST["proyecto-fechaFin"];

		$fecha_inicio_inscripcion1 = str_replace('/', '-',$fecha_inicio_inscripcion);
		$fecha_fin_inscripcion1 = str_replace('/', '-',$fecha_fin_inscripcion);

		$fecha_inicio1 = str_replace('/', '-',$fecha_inicio);
		$fecha_fin1 = str_replace('/', '-',$fecha_fin);

		$fecha_inicio_ciclo_escolar = str_replace('/', '-',$informacion_ciclos_escolares_activos[0][2]);
		$fecha_fin_ciclo_escolar = str_replace('/', '-',$informacion_ciclos_escolares_activos[0][3]);



			//      21/09/2015	15/07/2016	Activo


		$errorFechas = false;
		$mensajeValidacion = "";
		$inputFecha="";

		if(strtotime($fecha_inicio_inscripcion1) < strtotime($fecha_inicio_ciclo_escolar) )
		{
			$errorFechas = true;
			$tituloValidacion = "Fecha de inicio de convocatoria";
			$mensajeValidacion = "La fecha de inicio de convocatoria no debe ser menor a la fecha de inicio del ciclo escolar.";
			$inputFecha= "#proyecto-fechaInicioInscripcion";
		}
		else
		{
			if(strtotime($fecha_inicio_inscripcion1) >  strtotime($fecha_fin_ciclo_escolar))
			{
				$errorFechas = true;
				$tituloValidacion = "Fecha de inicio de convocatoria";
				$mensajeValidacion = "La fecha de inicio de convocatoria no debe ser mayor a la fecha de fin del ciclo escolar.";
				$inputFecha= "#proyecto-fechaInicioInscripcion";
			}
			else
			{
				if(strtotime($fecha_fin_inscripcion1) < strtotime($fecha_inicio_ciclo_escolar))
				{
					$errorFechas = true;
					$tituloValidacion = "Fecha de fin de convocatoria";
					$mensajeValidacion = "La fecha de fin de convocatoria no debe ser menor a la fecha de inicio del ciclo escolar.";
					$inputFecha= "#proyecto-fechaFinInscripcion";

				}
				else
				{
					if(strtotime($fecha_fin_inscripcion1) > strtotime($fecha_fin_ciclo_escolar))
					{
						$errorFechas = true;
						$tituloValidacion = "Fecha de fin de convocatoria";
						$mensajeValidacion = "La fecha de fin de convocatoria no debe ser mayor a la fecha de fin del ciclo escolar.";
						$inputFecha= "#proyecto-fechaFinInscripcion";
					}
				}
			}
		}

		if($errorFechas === false)
		{
			if(strtotime($fecha_inicio1) < strtotime($fecha_inicio_ciclo_escolar) )
			{
				$errorFechas = true;
				$tituloValidacion = "Fecha de inicio";
				$mensajeValidacion = "La fecha de inicio no debe ser menor a la fecha de inicio del ciclo escolar.";
				$inputFecha= "#proyecto-fechaInicio";
			}
			else
			{
				if(strtotime($fecha_inicio1) >  strtotime($fecha_fin_ciclo_escolar))
				{
					$errorFechas = true;
					$tituloValidacion = "Fecha de inicio";
					$mensajeValidacion = "La fecha de inicio no debe ser mayor a la fecha de fin del ciclo escolar.";
					$inputFecha= "#proyecto-fechaInicio";
				}
				else
				{
					if(strtotime($fecha_fin1) < strtotime($fecha_inicio_ciclo_escolar))
					{
						$errorFechas = true;
						$tituloValidacion = "Fecha de fin";
						$mensajeValidacion = "La fecha de fin no debe ser menor a la fecha de inicio del ciclo escolar.";
						$inputFecha= "#proyecto-fechaFin";

					}
					else
					{
						if(strtotime($fecha_fin1) > strtotime($fecha_fin_ciclo_escolar))
						{
							$errorFechas = true;
							$tituloValidacion = "Fecha de fin";
							$mensajeValidacion = "La fecha de fin no debe ser mayor a la fecha de fin del ciclo escolar.";
							$inputFecha= "#proyecto-fechaFin";
						}
					}
				}
			}

		}


		$fecha_inicio_inscripcion_partes = explode("/", $fecha_inicio_inscripcion);
		$fecha_inicio_inscripcion = $fecha_inicio_inscripcion_partes[2]."/".$fecha_inicio_inscripcion_partes[1]."/".$fecha_inicio_inscripcion_partes[0];

		
		$fecha_fin_inscripcion_partes = explode("/", $fecha_fin_inscripcion);
		$fecha_fin_inscripcion = $fecha_fin_inscripcion_partes[2]."/".$fecha_fin_inscripcion_partes[1]."/".$fecha_fin_inscripcion_partes[0];

		
		$fecha_inicio_partes = explode("/", $fecha_inicio);
		$fecha_inicio = $fecha_inicio_partes[2]."/".$fecha_inicio_partes[1]."/".$fecha_inicio_partes[0];

		
		$fecha_fin_partes = explode("/", $fecha_fin);
		$fecha_fin = $fecha_fin_partes[2]."/".$fecha_fin_partes[1]."/".$fecha_fin_partes[0];


		$imagen_portada = ($_POST["imagen"] != "#" && $_POST["imagen"] != "") ? $_POST["imagen"] : "";
		$color = $_POST["color"];


		if($errorFechas === true)
		{
			$titulo = $tituloValidacion;
			$resultado = $mensajeValidacion;
			$validaFechas = $errorFechas;
			sendToClient(compact("resultado","validaFechas","inputFecha","titulo"));
		}
		else
		{
			$data3 = model("generarLink");

			extract($data3);

			


			$data2 = model("registrarProyectos",compact("id_administrador","id_ciclo","nombre","descripcion","fecha_inicio_inscripcion","fecha_fin_inscripcion","fecha_inicio","fecha_fin","imagen_portada","grados","link_proyecto","alianzas","tipo_proyecto","id_proyecto_renovacion","color"));
			
			extract($data2);

			if(isset($error))
			{
		        $resultado = "Hubo un error en la base de datos.";
		        sendToClient(compact("error","resultado"));
			}
			else if($mensaje === false)
			{
				$resultado = "Hubo un error en la base de datos.";
		        sendToClient(compact("mensaje","resultado"));
			}
			else
			{
				$resultado = "Registro insertado correctamente.";
		        sendToClient(compact("mensaje","resultado"));
			}
		}
	}