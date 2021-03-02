<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getCapacitaciones()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_capacitaciones = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_capacitaciones[$i] = $row;
                $i++;
				
			}
			$mensaje_capacitaciones = true;
		}
		else
		{
			$mensaje_capacitaciones = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_capacitaciones))
    {
         $data = compact("informacion_capacitaciones", "mensaje_capacitaciones");

    }
