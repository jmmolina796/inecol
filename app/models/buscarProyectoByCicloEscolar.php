<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getProyectoByCicloEscolar('".$urlProyecto."','".$id_ciclo_escolar."')");

		

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

            if(isset($peticion->num_rows) && $peticion->num_rows > 0)
            {

			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$id_proyecto = $row["id_proyecto"];
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
             $data = compact("id_proyecto","url","mensaje_proyecto");
        }
        else
        {
             $data = compact("mensaje_proyecto");
        }
    }	