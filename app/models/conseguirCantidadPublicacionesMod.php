<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getCantidadPublicacionesMod('".$urlModulo."','".$tipoBusqueda."')");
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

            if(isset($peticion->num_rows) && $peticion->num_rows > 0)
            {

			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
                $cantidad = $row["cantidad"];
                
                
			}
			$mensaje_cantidad = true;
		}
		else
		{
			$mensaje_cantidad = false;
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
        if($mensaje_cantidad === true)
        {
             $data = compact("mensaje_cantidad", "cantidad");
        }
        else
        {
             $data = compact("mensaje_cantidad");
        }
    }	