<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getAsesores()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_asesores = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_asesores[$i] = $row;
                $i++;
				
			}
			$mensaje_asesores = true;
		}
		else
		{
			$mensaje_asesores = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_asesores))
    {
         $data = compact("informacion_asesores", "mensaje_asesores");

    }
