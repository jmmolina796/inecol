<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getCapSesiones('-1')");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_cap_sesiones = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_cap_sesiones[$i] = $row;
                $i++;
				
			}
			$mensaje_cap_sesiones = true;
		}
		else
		{
			$mensaje_cap_sesiones = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_cap_sesiones))
    {
         $data = compact("informacion_cap_sesiones", "mensaje_cap_sesiones");

    }
