<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();
	
	$id_carpeta = $_POST['id_carpeta'];

	$data = model("buscarCarpeta",compact("id_carpeta"));
	extract($data);

	if(isset($error))
	{

    }
    else if($mensaje_carpeta===false)
    {
        
    }
    else
    {

    	$data = model("conseguirProyectosCarpeta",compact("id_carpeta"));
		extract($data);	
	
    	if(isset($error))
		{
			exit();
			//ERROR
		}
		
		else
		{

			if($mensaje_carpetas_proyectos === false)
			{
				$contenidoTablaProyectosDeCarpeta = "";
			
			}
			else
			{

				$mensaje = $mensaje_carpetas_proyectos;
				$informacion = $informacion_carpetas_proyectos;
				$seleccionable = true;
				$excepcion_col = array("9","10","11","12","13");

				$contenidoTablaProyectosDeCarpeta = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col"));
			}			
			$data = model("conseguirProyectosSinCarpetas");
			extract($data);

			if(isset($error))
			{
				exit();
				//ERROR
			}
			else if($mensaje_proyectos === false)
			{
				$contenidoTablaProyectos = "";
				$cssClassElements = "noActive";
			}
			else
			{
				$mensaje = $mensaje_proyectos;
				$informacion = $informacion_proyectos;
				$seleccionable = true;
				$excepcion_col = array("9","10","11","12","13");

				$contenidoTablaProyectos = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col"));
			}
			view("formModificarCarpetasProyectos",compact("contenidoTablaProyectosDeCarpeta","contenidoTablaProyectos","nombre_carpeta","id_carpeta"));
		}
    }