<?php

	try
	{

		$peticion = $mysqli->query("CALL SP_deleteCarpetasProyectos(".$id_carpeta.")");

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        
		// puede que falte eliminar los proyectos relacionados de la carpeta

		$mensaje_carpetas_proyectos = true;
		
	}
	catch(Exception $e) 
	{
        $error = "@%@#".$e->getMessage();
	}


	if(isset($error))
	{
	   $data = compact("error");  
	}

	else
	{
		$data = compact("mensaje_carpetas_proyectos");
	}