<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getProyectos()");
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_proyectos = array();
            $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_proyectos[$i] = $row;
                $i++;
				
			}
			$mensaje_proyectos = true;
		}
		else
		{
			$mensaje_proyectos = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}


	if(isset($error))
	{
	   $data = compact("error");  
	}
    else if(isset($mensaje_proyectos))
    {
         $data = compact("informacion_proyectos", "mensaje_proyectos");
    }