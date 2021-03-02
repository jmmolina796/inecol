<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getCicloEscolarUrlProyecto('".$url."')");

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

            if(isset($peticion->num_rows) && $peticion->num_rows > 0)
            {

			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$id_proyecto = $row["id_proyecto"];
				$id_ciclo_escolar = $row["id_ciclo_escolar"];
				
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
             $data = compact("id_proyecto","id_ciclo_escolar","mensaje_proyecto");
        }
        else
        {
             $data = compact("mensaje_proyecto");
        }
    }	