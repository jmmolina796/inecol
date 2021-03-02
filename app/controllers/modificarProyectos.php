<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_proyecto = $_POST["id_proyecto"];

	$data = model("buscarProyecto",compact("id_proyecto"));

	$grados = $_POST["grados"];

  $alianzas = ($_POST["alianzas"] == "") ? array() : $_POST["alianzas"];

	extract($data);

	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_proyecto === false)
	{
		//No hay registros
	}
	else
	{
		$imagenBaseDatos = $imagen_portada; //Del modelo

		$nombre = $_POST["proyecto-nombre"];
		$descripcion = $_POST["proyecto-descripcion"];

		$fecha_inicio_inscripcion = $_POST["proyecto-fechaInicioInscripcion"];
		$fecha_fin_inscripcion = $_POST["proyecto-fechaFinInscripcion"];
		$fecha_inicio = $_POST["proyecto-fechaInicio"];
		$fecha_fin = $_POST["proyecto-fechaFin"];


		$fecha_inicio_inscripcion1 = str_replace('/', '-',$fecha_inicio_inscripcion);
		$fecha_fin_inscripcion1 = str_replace('/', '-',$fecha_fin_inscripcion);

		$fecha_inicio1 = str_replace('/', '-',$fecha_inicio);
		$fecha_fin1 = str_replace('/', '-',$fecha_fin);

		$fecha_inicio_ciclo_escolar = str_replace('/', '-',$fecha_inicio_ciclo_escolar);
		$fecha_fin_ciclo_escolar = str_replace('/', '-',$fecha_fin_ciclo_escolar);

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

			$data = model("modificarProyectos", compact("id_proyecto","id_categoria","nombre","descripcion","fecha_inicio_inscripcion","fecha_fin_inscripcion","fecha_inicio","fecha_fin","imagen_portada","grados","alianzas","color"));

			extract($data);

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
				if($imagen_portada != $imagenBaseDatos)
				{
					$fldr = "imgPro";
					$nameFileToDelete = $imagenBaseDatos;
					load("gestionarArchivos",$fldr,$nameFileToDelete);
				}

				$resultado = "Registro modificado correctamente.";
		        sendToClient(compact("mensaje","resultado"));
			}

		}
	}
