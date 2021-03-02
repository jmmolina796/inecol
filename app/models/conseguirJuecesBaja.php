<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getJuecesBaja()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_jueces_baja = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_jueces_baja[$i] = $row;
                $i++;
				
			}
			$mensaje_jueces_baja = true;
		}
		else
		{
			$mensaje_jueces_baja = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_jueces_baja))
    {
         $data = compact("informacion_jueces_baja", "mensaje_jueces_baja");

    }
