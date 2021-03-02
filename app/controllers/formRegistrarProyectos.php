<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$data = model("conseguirCiclosEscolaresActivos");

	extract($data);

	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_ciclos_escolares_activos === false)
	{
		//No hay registros
		view("formRegistrarProyectosVacioCiclosEscolares");
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
			$data3 = model("conseguirAlianzas");

			extract($data3);

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

				$mensaje = $mensaje_alianzas;
				$informacion = $informacion_alianzas;
				$nombre = "una alianza";
				$valor = "none";
				$selectAlianzas = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

				$mensaje = $mensaje_grados_niveles_educativos;
				$informacion = $informacion_grados_niveles_educativos;
				$checkboxGrados = builder("crearCheckboxGrados",compact("informacion","mensaje"));

				$nombre_ciclo_escolar = $informacion_ciclos_escolares_activos[0][1];

				view("formRegistrarProyectos", compact("nombre_ciclo_escolar","checkboxGrados","selectAlianzas"));
			}
		}
	}