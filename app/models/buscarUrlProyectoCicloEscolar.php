<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getUrlProyectoCicloEscolar('".$urlProyecto."','".$id_ciclo_escolar."')");

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

            if(isset($peticion->num_rows) && $peticion->num_rows > 0)
            {

			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$url = $row["url"];
				
			}
			$mensaje_proyecto = true;
		}
		else
		{
			$mensaje_proyecto = false;
		}
	}
	catch(Exception $e) 
    {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
	}
    else
    {
        if($mensaje_proyecto === true)
        {
             $data = compact("url","mensaje_proyecto");
        }
        else
        {
             $data = compact("mensaje_proyecto");
        }
    }	