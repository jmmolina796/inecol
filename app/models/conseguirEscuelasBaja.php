<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getEscuelasBaja()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_escuelas_baja = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_escuelas_baja[$i] = $row;
                $i++;
				
			}
			$mensaje_escuelas_baja = true;
		}
		else
		{
			$mensaje_escuelas_baja = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_escuelas_baja))
    {
         $data = compact("informacion_escuelas_baja", "mensaje_escuelas_baja");

    }
