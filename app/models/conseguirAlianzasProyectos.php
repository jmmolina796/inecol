<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getAlianzasProyecto('".$id_proyecto."')");                

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_alianzas_proyectos = array();
            $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_ASSOC))
			{
				$informacion_alianzas_proyectos[$i] = $row["id_alianza"];
                $i++;
				
			}
			$mensaje_alianzas_proyectos = true;
		}
		else
		{
			$mensaje_alianzas_proyectos = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}


	if(isset($error))
	{
	   $data = compact("error");  
	}
    else if($mensaje_alianzas_proyectos === false)
    {
         $data = compact("mensaje_alianzas_proyectos");
    }
    else
    {
    	$data = compact("mensaje_alianzas_proyectos","informacion_alianzas_proyectos");
    }