<?php

    try
    {
		$peticion = $mysqli->query("CALL SP_bajaProyectoDeCarpeta(".$id_carpeta.",".$id_proyecto.")"); 
		
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

		$mensaje_baja_proyectos_carpetas=true;

	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}


	if(isset($error))
	{
	   $data = compact("error");  
	}

    
	else
	{
		$data = compact("mensaje_baja_proyectos_carpetas");
	}