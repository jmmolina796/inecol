<?php

    try
    {
		$peticion = $mysqli->query("CALL SP_verificarRenovarProyecto(".$id_proyecto.")"); 
		
	
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

		 if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
        	$renovar_proyecto="no";
        }
        else
        {
        	$renovar_proyecto="si";
        }



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
		
		$data = compact("renovar_proyecto");
	}