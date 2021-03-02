<?php

	$filtroBusqueda = $_POST['filtroBusqueda'];
	$tipoBusqueda = $_POST['tipoBusqueda'];

	$data = model("obtenerBusquedaPrincipal",  compact("filtroBusqueda","tipoBusqueda"));

	extract($data);

	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_busqueda === false)
	{
		//No hay registros

		view("crearDatosBusquedaPrincipalVacio");
	}
	else
	{
        $informacion = $informacion_busqueda_principal;
        $mensaje = $mensaje_busqueda;
		$datosBusquedaPrincipal = builder("crearDatosBusquedaPrincipal",compact("informacion","mensaje","tipoBusqueda","filtroBusqueda"));
		view("crearDatosBusquedaPrincipal",compact("datosBusquedaPrincipal"));
	}
	