<?php

	if(isSessionStarted())
	{
		$modulosCss = "";

		$filtro_modulos=$_POST['filtro_modulos'];
		$busqueda_nombre_modulo = $_POST['busqueda_nombre_modulo'];
		$data = model("conseguirModulosFiltro",compact("filtro_modulos","busqueda_nombre_modulo"));
		extract($data);

		if($mensaje_modulos===false)
		{
			$modulosCss = "empty";
		}
		else
		{
			$mensaje = $mensaje_modulos;
			$informacion = $informacion_modulos;
			$contenidoModulos = builder("crearSeleccionadorModulos",compact("informacion","mensaje"));
		}
		
		view("seleccionar-modulos_filtro",compact("contenidoModulos","modulosCss"));

	}
	