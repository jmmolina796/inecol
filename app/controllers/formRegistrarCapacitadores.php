<?php

	setPermission("root");
	endPermissions();

	$data1 = model("conseguirInstituciones");

	extract($data1);

	if(isset($error))
	{
		//ERRROR
    }
	else 
	{

        $data2 = model("conseguirCapSesiones");

        extract($data2);

        if(isset($error))
        {
            //ERRROR
        }
        else 
        {
            $mensaje = $mensaje_instituciones;
            $informacion = $mensaje_instituciones ? $informacion_instituciones : array();
            $nombre = "una opción";
            $valor = "none";
            $selectInstituciones = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

            $mensaje = $mensaje_cap_sesiones;
            $informacion = $mensaje_cap_sesiones ? $informacion_cap_sesiones : array();
            $nombre = "una opción";
            $valor = "none";
            $selectCapSesiones = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));
    
            view("formRegistrarCapacitadores",compact("selectInstituciones","selectCapSesiones"));
        }
	}