<?php

	$clave = $_POST["clave"];

	$data1 = model("buscarEscuela",  compact("clave"));

	extract($data1);

	if(isset($error))
	{
		//ERRROR
	}
	else if($mensaje_escuela === false)
	{
		//NO hay registro
	}
	else
	{
		$data2 = model("conseguirGrados",  compact("id_nivel_educativo"));

		extract($data2);

		if(isset($error))
		{
			//ERRROR
		}
		else if($mensaje_grados === false)
		{
			//NO hay registro
		}
		else
		{
			$data3 = model("conseguirGrupos");
			extract($data3);

			if(isset($error))
			{
				//ERRROR
			}
			else if($mensaje_grupos === false)
			{
				//NO hay registro
			}
			else
			{
				$mensaje = $mensaje_grados;
				$informacion = $informacion_grados;
				$nombre = "el grado";
				$valor = "none";
				$selectGrados = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

				$mensaje = $mensaje_grupos;
				$informacion = $informacion_grupos;
				$nombre = "el grupo";
				$valor = "none";
				$selectGrupos = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

				view("agregarEscuelasDocente",compact("clave_escuela","escuela","nivel_educativo","selectGrados","selectGrupos"));
			}
		}
	}
