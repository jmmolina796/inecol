<?php

	if(isset($_POST["opt"]))
	{
		$opt = $_POST["opt"];

		if($opt == "municipios")
		{
			$id_entidad = $_POST["id_entidad"];
			$data = model("conseguirEntidadesMunicipios",compact("opt","id_entidad"));
			extract($data);

			$mensaje = $mensaje_municipios;
			$informacion = $informacion_municipios;
			$nombre = "el municipio";
			$valor = "none";
		}
		else if($opt == "entidades")
		{
			$data = model("conseguirEntidadesMunicipios",compact("opt"));
			extract($data);

			$mensaje = $mensaje_entidades;
			$informacion = $informacion_entidades;
			$nombre = "el estado";
			$valor = "none";
		}
		
		$contenidoSelect = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));
		
		view("conseguirEntidadesMunicipios", compact("contenidoSelect"));	
	}