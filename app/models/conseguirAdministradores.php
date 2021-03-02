<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getAdministradores()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_administradores = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_administradores[$i] = $row;
                $i++;
				
			}
			$mensaje_administradores = true;
		}
		else
		{
			$mensaje_administradores = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_administradores))
    {
         $data = compact("informacion_administradores", "mensaje_administradores");

    }
