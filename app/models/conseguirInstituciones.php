<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getInstituciones()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_instituciones = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_instituciones[$i] = $row;
                $i++;
				
			}
			$mensaje_instituciones = true;
		}
		else
		{
			$mensaje_instituciones = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_instituciones))
    {
         $data = compact("informacion_instituciones", "mensaje_instituciones");

    }
