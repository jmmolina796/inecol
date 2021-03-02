<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getNivelesEducativos()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_niveles_educativos = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$informacion_niveles_educativos[$i] = $row;
                $i++;
				
			}
			$mensaje_niveles_educativos = true;
		}
		else
		{
			$mensaje_niveles_educativos = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if($mensaje_niveles_educativos === true)
    {
         $data = compact("informacion_niveles_educativos", "mensaje_niveles_educativos");
    }
    else
    {
		$data = compact("mensaje_niveles_educativos");
    }