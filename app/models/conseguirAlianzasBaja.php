<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getAlianzasBaja()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_alianzas_baja = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_alianzas_baja[$i] = $row;
                $i++;
				
			}
			$mensaje_alianzas_baja = true;
		}
		else
		{
			$mensaje_alianzas_baja = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_alianzas_baja))
    {
         $data = compact("informacion_alianzas_baja", "mensaje_alianzas_baja");

    }
