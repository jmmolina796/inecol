<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_updateAlianzas(".$id_alianza.",'".$nombre."','".$descripcion."')");
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
	else if(isset($mensaje))
	{
		$data = compact("mensaje");
	}