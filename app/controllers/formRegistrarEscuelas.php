<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();
	
	$data = model("conseguirNivelesEducativos");
	extract($data);
	if(isset($error))
	{
		//ERRROR
	}
	else
	{
		$opt = "entidades";
		$data2 = model("conseguirEntidadesMunicipios",compact("opt"));
		extract($data2);
		if(isset($error))
		{
			//ERRROR
		}

		$mensaje = $mensaje_niveles_educativos;
		$informacion = $informacion_niveles_educativos;
		$nombre = "el nivel educativo";
		$valor = "none";
		$selectNivel = builder("crearSelect",compact("informacion","mensaje","nombre","valor")); 

		$mensaje = $mensaje_entidades;
		$informacion = $informacion_entidades;
		$nombre = "el estado";
		$valor = "none";
		$selectEntidad = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

		view("formRegistrarEscuelas",compact("selectNivel","selectEntidad"));
	}
