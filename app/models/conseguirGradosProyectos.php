<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getGradosProyecto(".$id_proyecto.")");                

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_grados_proyectos = array();
            $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_ASSOC))
			{
				$informacion_grados_proyectos[$i] = $row["id_grado"];
                $i++;
				
			}
			$mensaje_grados_proyectos = true;
		}
		else
		{
			$mensaje_grados_proyectos = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}


	if(isset($error))
	{
	   $data = compact("error");  
	}
    else if($mensaje_grados_proyectos === false)
    {
         $data = compact("mensaje_grados_proyectos");
    }
    else
    {
    	$data = compact("mensaje_grados_proyectos","informacion_grados_proyectos");
    }