<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getEscuelas()");
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_escuelas = array();
            $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_escuelas[$i] = $row;
                $i++;
				
			}
			$mensaje_escuelas = true;
		}
		else
		{
			$mensaje_escuelas = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}


	if(isset($error))
	{
	   $data = compact("error");  
	}
    else if(isset($mensaje_escuelas))
    {
         $data = compact("informacion_escuelas", "mensaje_escuelas");
    }