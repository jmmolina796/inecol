<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getAsesoresBaja()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_asesores_baja = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_asesores_baja[$i] = $row;
                $i++;
				
			}
			$mensaje_asesores_baja = true;
		}
		else
		{
			$mensaje_asesores_baja = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_asesores_baja))
    {
         $data = compact("informacion_asesores_baja", "mensaje_asesores_baja");

    }
