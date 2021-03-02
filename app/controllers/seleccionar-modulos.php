<?php

	if(isSessionStarted())
	{
		$modulosCss = "";

		$filtro_modulos="Todos";
		$busqueda_nombre_modulo="0";
		$data = model("conseguirModulosFiltro",compact("filtro_modulos","busqueda_nombre_modulo"));
		extract($data);

		if(isset($error))
		{

		}
		else if($mensaje_modulos===false)
		{
			$modulosCss = "empty";
		}
		else
		{
			$mensaje = $mensaje_modulos;
			$informacion = $informacion_modulos;
			$contenidoPosts = builder("crearSeleccionadorModulos",compact("informacion","mensaje"));
		}

		view("seleccionar-modulos",compact("contenidoPosts","modulosCss"));
	}
	else
	{
		view("notfound");
	}