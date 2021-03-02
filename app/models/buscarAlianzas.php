<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getInfoAlianza('".$id_alianza."')");
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

            if(isset($peticion->num_rows) && $peticion->num_rows > 0)
            {

			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$id_alianza = $row["id_alianza"];
				$nombre = $row["nombre"];
				$descripcion = $row["descripcion"];
				$ape_paterno = $row["estatus"];
			}
			$mensaje_alianza = true;
		}
		else
		{
			$mensaje_alianza = false;
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
        if($mensaje_alianza === true)
        {
             $data = compact("id_alianza","nombre","descripcion","estatus","mensaje_alianza");
        }
        else
        {
             $data = compact("mensaje_alianza");
        }
    }	