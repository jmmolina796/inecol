<?php

	if(isset($_SESSION["enter"]) && $_SESSION["enter"] === true)
	{
		unset($_SESSION["enter"]);

		$opt = "entidades";

		$data = model("conseguirEntidadesMunicipios",compact("opt"));

		extract($data);

		if(isset($error))
		{
		    //ERRROR
		}
		else
		{
			$mensaje = $mensaje_entidades;
			$informacion = $informacion_entidades;
			$nombre = "el estado";
			$valor = "none";
			$selectEntidad = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

			view("registro-docentes",compact("selectEntidad"));
		}
	}
	else
	{
		view("formIngresarLlave");
	}
