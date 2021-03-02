<?php

	$limit1 = 0;
	$limit2 = 10;
	
	$data = model("conseguirCantidadRowsBusquedaPrincipal",  compact("filtroBusqueda","tipoBusqueda"));

	extract($data);


	$data = model("busqueda", compact("filtroBusqueda","tipoBusqueda","limit1","limit2"));

	extract($data);

	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_busqueda === false)
	{
		//No hay registros

		$mensaje = "No se encontraron <span class='italic'>";

		if($tipoBusqueda == "proyectos")
		{
			$mensaje .= "proyectos";
		}
		else if($tipoBusqueda == "modulos") 
		{
			$mensaje .= "módulos";
		}
		else if($tipoBusqueda == "docentes")
		{
			$mensaje .= "docentes";
		}
		else
		{
			$mensaje .= "escuelas";
		}

		$mensaje .= "</span> para tu búsqueda: <span class='bold'>".$filtroBusqueda."</span>";

		$datosMasResultadosBusquedaPrincipal = "<div class='sin-resultados-bus'>".
													"<p>".$mensaje."</p>".
												"</div>";

	}
	else
	{
        $informacion = $informacion_busqueda_principal;
        $mensaje = $mensaje_busqueda;
        $cantidadRows = $cantidadRows - $limit2;
		$datosMasResultadosBusquedaPrincipal = builder("crearDatosMasResultadosBusquedaPrincipal",compact("informacion","mensaje","tipoBusqueda","cantidadRows"));
	}
	view("busqueda",compact("datosMasResultadosBusquedaPrincipal","filtroBusqueda","tipoBusqueda"));
	
