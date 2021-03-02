<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_enter('".$llave."')");
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0) // cambio
        {
			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$mensaje = $row["mensaje"];
			}

			$mensaje = $mensaje == "true" ? true : false;
		}
		else
		{
			$mensaje = false;
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
    	$data = compact("mensaje");
    }