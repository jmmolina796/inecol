<?php

	$id_carpeta = $id;

	$data_carpeta = model("buscarCarpeta",compact("id_carpeta"));

	extract($data_carpeta);

	if(isset($error))
	{

    }
    else if($mensaje_carpeta===false)
    {
        
    }
    else
    {
		$data_proyectos = model("conseguirProyectosCarpeta",compact("id_carpeta"));

		extract($data_proyectos);

		if(isset($error))
		{

	    }
	    else if($mensaje_carpetas_proyectos===false)
	    {
	        $proyectosCarpetas = "No hay";
	    }
	    else
	    {

	    	$mensaje = $mensaje_carpetas_proyectos;
	    	$informacion = $informacion_carpetas_proyectos;
	    	$proyectosCarpetas = builder("crearProyectosCarpetas",compact("mensaje","informacion"));
	    }

		view("carpeta",compact("nombre_carpeta","proyectosCarpetas"));
    }