<?php

	if(isSessionStarted())
	{
		$data = model("conseguirCiclosEscolaresActivos");
		extract($data);

		if(isset($error))
		{
		    exit();
		    // aqui el codigo de Error
		}
		else if($mensaje_ciclos_escolares_activos === false)
		{   
		    $contenidoTablaCiclos = "";
		    $cssClassElements = "noActive";
		}
		else
		{
		    $mensaje = $mensaje_ciclos_escolares_activos;
		    $informacion = $informacion_ciclos_escolares_activos;
		    $seleccionable = true;
		    $excepcion_col = array("4");
		    $cssClassElements = "";

		    $contenidoTablaCiclos = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col"));
		}

		view("homeUsuario",compact("contenidoTablaCiclos","cssClassElements"));
	}
	else
	{
		view("home");
	}