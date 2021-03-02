<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_deleteCiclosEscolares(".$id_ciclo.")"); 
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
		$mensaje = true;
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
        
		$data = compact("mensaje");
    }