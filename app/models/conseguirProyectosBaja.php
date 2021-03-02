<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getProyectosBaja()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_proyectos_baja = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_proyectos_baja[$i] = $row;
                $i++;
				
			}
			$mensaje_proyectos_baja = true;
		}
		else
		{
			$mensaje_proyectos_baja = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_proyectos_baja))
    {
         $data = compact("informacion_proyectos_baja", "mensaje_proyectos_baja");

    }
