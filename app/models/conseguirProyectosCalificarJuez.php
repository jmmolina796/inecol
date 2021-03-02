<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getProyectosCalificarJuez('".$id_juez."','".$id_ciclo_escolar."')");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_proyectos_calificar_juez = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_proyectos_calificar_juez[$i] = $row;
                $i++;
				
			}
			$mensaje_proyectos_calificar_juez = true;
		}
		else
		{
			$mensaje_proyectos_calificar_juez = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_proyectos_calificar_juez))
    {
         $data = compact("informacion_proyectos_calificar_juez", "mensaje_proyectos_calificar_juez");

    }
