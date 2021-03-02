<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getJueces()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_jueces = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_jueces[$i] = $row;
                $i++;
				
			}
			$mensaje_jueces = true;
		}
		else
		{
			$mensaje_jueces = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_jueces))
    {
         $data = compact("informacion_jueces", "mensaje_jueces");

    }
