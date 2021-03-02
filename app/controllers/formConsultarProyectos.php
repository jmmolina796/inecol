<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_proyecto = $_POST["id_proyecto"];

	$data = model("buscarProyecto",compact("id_proyecto"));

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
		$data2 = model("conseguirGradosConNivelesEducativos");

		extract($data2);

		if(isset($error))
		{
			//ERROR
		}
		else if($mensaje_grados_niveles_educativos === false)
		{
			//No hay registros
		}
		else
		{
			$data3 = model("conseguirGradosProyectos",compact("id_proyecto"));

			extract($data3);

			if(isset($error))
			{
				//ERROR
			}
			else if($mensaje_grados_proyectos === false)
			{
				//No hay registros
			}
			else
			{
				$data4 = model("conseguirAlianzas");

				extract($data4);

				if(isset($error))
				{
					//ERROR
				}
				else if($mensaje_alianzas === false)
				{
					//No hay alianzas
				}
				else
				{

					$data5 = model("conseguirAlianzasProyectos",compact("id_proyecto"));

					extract($data5);

					if(isset($error))
					{
						//ERROR
					}
					else if($mensaje_alianzas_proyectos === false)
					{
						$alianzas_seleccionadas = "";
					}
					else
					{
						$alianzas_seleccionadas = implode(",", $informacion_alianzas_proyectos);
					}

					$mensaje = $mensaje_alianzas;
					$informacion = $informacion_alianzas;
					$nombre = "una opción ";
					$valor = "none";
					$selectAlianzas = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

					$mensaje = $mensaje_grados_niveles_educativos;
					$informacion = $informacion_grados_niveles_educativos;
					$type = "disabled";
					$values = $informacion_grados_proyectos;
					$checkboxGrados = builder("crearCheckboxGrados",compact("informacion","mensaje","type","values"));

					view("formConsultarProyectos", compact("id_proyecto","nombre_proyecto","fecha_inicio_inscripcion","fecha_fin_inscripcion","fecha_inicio","fecha_fin","nombre_categoria","nombre_ciclo_escolar","nombre_administrador","fecha_creacion","descripcion","imagen_portada","estatus","alianzas_seleccionadas","selectAlianzas","checkboxGrados"));
				}
			}
		}
	}