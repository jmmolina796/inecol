<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getInfoCapacitacion('".$id_capacitacion."')");
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

            if(isset($peticion->num_rows) && $peticion->num_rows > 0)
            {

			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$id_capacitacion = $row["id_capacitacion"];
                $nombre_capacitacion = $row["nombre"];
                $descripcion_capacitacion = $row["descripcion"];
				$id_proyecto_capacitacion = $row["id_proyecto"];
				$estatus_capacitacion = $row["estatus"];
			}
			$mensaje_capacitacion = true;
		}
		else
		{
			$mensaje_capacitacion = false;
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
        if($mensaje_capacitacion === true)
        {
             $data = compact("id_capacitacion","nombre_capacitacion","descripcion_capacitacion","id_proyecto_capacitacion","estatus_capacitacion","mensaje_capacitacion");
        }
        else
        {
             $data = compact("mensaje_capacitacion");
        }
    }	