<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getInfoInstitucion('".$id_institucion."')");
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

            if(isset($peticion->num_rows) && $peticion->num_rows > 0)
            {

			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$id_institucion = $row["id_institucion"];
				$nombre = $row["nombre"];
				$descripcion = $row["descripcion"];
				$ape_paterno = $row["estatus"];
			}
			$mensaje_institucion = true;
		}
		else
		{
			$mensaje_institucion = false;
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
        if($mensaje_institucion === true)
        {
             $data = compact("id_institucion","nombre","descripcion","estatus","mensaje_institucion");
        }
        else
        {
             $data = compact("mensaje_institucion");
        }
    }	