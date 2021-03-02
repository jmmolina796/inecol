<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getCapacitadoresBaja()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_capacitadores_baja = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_capacitadores_baja[$i] = $row;
                $i++;
				
			}
			$mensaje_capacitadores_baja = true;
		}
		else
		{
			$mensaje_capacitadores_baja = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_capacitadores_baja))
    {
         $data = compact("informacion_capacitadores_baja", "mensaje_capacitadores_baja");

    }
