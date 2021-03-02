<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getInstitucionesBaja()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_instituciones_baja = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_instituciones_baja[$i] = $row;
                $i++;
				
			}
			$mensaje_instituciones_baja = true;
		}
		else
		{
			$mensaje_instituciones_baja = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_instituciones_baja))
    {
         $data = compact("informacion_instituciones_baja", "mensaje_instituciones_baja");

    }
