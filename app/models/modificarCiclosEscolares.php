<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_updateCiclosEscolares('".$fecha_inicio."','".$fecha_fin."','".$nombre."',".$id_ciclo.")"); 
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