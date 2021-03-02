<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getProyectosCicloEscolarActual()");
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_proyectos_ciclo_escolar = array();
            $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
                $informacion_proyectos_ciclo_escolar[$i] = $row;
                $i++;
				
			}
			$mensaje_proyectos_ciclo_escolar = true;
		}
		else
		{
			$mensaje_proyectos_ciclo_escolar = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}


	if(isset($error))
	{
	   $data = compact("error");  
	}
    else if(isset($mensaje_proyectos_ciclo_escolar))
    {
         $data = compact("informacion_proyectos_ciclo_escolar", "mensaje_proyectos_ciclo_escolar");
    }