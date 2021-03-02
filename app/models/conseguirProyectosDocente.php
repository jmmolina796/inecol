<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getProyectosDocente(".$id_docente.")");

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_proyectos_docente = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_proyectos_docente[$i] = $row;
                $i++;
				
			}
			$mensaje_proyectos_docente = true;
		}
		else
		{
			$mensaje_proyectos_docente = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if($mensaje_proyectos_docente === true)
    {
         $data = compact("informacion_proyectos_docente", "mensaje_proyectos_docente");
    }
    else
    {
    	$data = compact("mensaje_proyectos_docente");
    }
