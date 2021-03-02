<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getDocentes()");                
		if(!$peticion)
		{
			throw new exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_docentes = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_docentes[$i] = $row;
                $i++;
				
			}
			$mensaje_docentes = true;
		}
		else
		{
			$mensaje_docentes = false;
		}
	}
	catch(exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_docentes))
    {
         $data = compact("informacion_docentes", "mensaje_docentes");
    }
