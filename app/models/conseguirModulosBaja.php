<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getModulosBaja()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_modulos_baja = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_modulos_baja[$i] = $row;
                $i++;
				
			}
			$mensaje_modulos_baja = true;
		}
		else
		{
			$mensaje_modulos_baja = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_modulos_baja))
    {
         $data = compact("informacion_modulos_baja", "mensaje_modulos_baja");

    }
