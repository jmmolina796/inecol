<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getAdministradoresBaja()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_administradores_baja = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_administradores_baja[$i] = $row;
                $i++;
				
			}
			$mensaje_administradores_baja = true;
		}
		else
		{
			$mensaje_administradores_baja = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_administradores_baja))
    {
         $data = compact("informacion_administradores_baja", "mensaje_administradores_baja");

    }
