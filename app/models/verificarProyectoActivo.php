<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_verifyProyectoActivo('".$id_proyecto."')");
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {

			$proyecto_activo = true;
		}
		else
		{
			$proyecto_activo = false;	
		}
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
        
        $data = compact("proyecto_activo");
        
    }	