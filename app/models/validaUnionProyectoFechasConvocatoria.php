<?php
	try
	{
		$peticion = $mysqli->query("CALL SP_getFechasConvocatoriaProyecto(".$id_proyecto.")");
	    
        if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
		 if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            while($row = $peticion->fetch_array(MYSQLI_BOTH))
            {
                $fecha_inicio_inscripcion = $row["fecha_inicio_inscripcion"];
                $fecha_fin_inscripcion = $row["fecha_fin_inscripcion"];
            }
            $mensaje = true;
		}
		else
		{
			$mensaje = false;
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
	else if(isset($mensaje))
	{
		$data = compact("mensaje","fecha_inicio_inscripcion","fecha_fin_inscripcion");
	}

