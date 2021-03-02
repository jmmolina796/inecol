<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getCapacitacionesBaja()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_capacitaciones_baja = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_capacitaciones_baja[$i] = $row;
                $i++;
				
			}
			$mensaje_capacitaciones_baja = true;
		}
		else
		{
			$mensaje_capacitaciones_baja = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_capacitaciones_baja))
    {
         $data = compact("informacion_capacitaciones_baja", "mensaje_capacitaciones_baja");

    }
