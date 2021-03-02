<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getCarpetasProyectos()");

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_carpetas_proyectos = array();
            $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_carpetas_proyectos[$i] = $row;
                $i++;
				
			}
			$mensaje_carpetas_proyectos = true;
		}
		else
		{
			$mensaje_carpetas_proyectos = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}


	if(isset($error))
	{
	   $data = compact("error");  
	}

    else if($mensaje_carpetas_proyectos === false)
	{
		$data = compact("mensaje_carpetas_proyectos");
	}
	else
	{
		$data = compact("informacion_carpetas_proyectos", "mensaje_carpetas_proyectos");
	}