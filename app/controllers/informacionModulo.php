<?php

	$urlModulo = $_POST["urlModulo"];
        
	$data1 = model("buscarInformacionModulo", compact("urlModulo"));

	extract($data1);

	if(isset($error))
	{
		//ERRROR
	}
	else if($mensaje_informacion_modulo === false)
	{
		//NO hay registros
	}
	else
	{    
        $nombre_docente_completo = $nombre_docente." ".$ape_materno." ".$ape_paterno;
        
        view("informacionModulo",compact("mensaje_informacion_modulo","nombre","nombre_docente_completo","descripcion","imagen_portada","ciclo_escolar","nombre_docente","ape_paterno","ape_materno","nombre_usuario","nombre_escuela","clave_escuela","grado","grupo"));
	}
