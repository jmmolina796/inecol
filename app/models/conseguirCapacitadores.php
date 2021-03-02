<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getCapacitadores()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_capacitadores = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_capacitadores[$i] = $row;
                $i++;
				
			}
			$mensaje_capacitadores = true;
		}
		else
		{
			$mensaje_capacitadores = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_capacitadores))
    {
         $data = compact("informacion_capacitadores", "mensaje_capacitadores");

    }
