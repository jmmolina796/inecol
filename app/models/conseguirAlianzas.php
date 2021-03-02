<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getAlianzas()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_alianzas = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_alianzas[$i] = $row;
                $i++;
				
			}
			$mensaje_alianzas = true;
		}
		else
		{
			$mensaje_alianzas = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_alianzas))
    {
         $data = compact("informacion_alianzas", "mensaje_alianzas");

    }
