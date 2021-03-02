<?php

	try
	{

		$peticion = $mysqli->query("CALL SP_altaCarpetasProyectos(".$id_carpeta.")");

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}


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