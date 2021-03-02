<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_updateAsesores('".$nombre."','".$ape_paterno."','".$ape_materno."','".$email."','".$passwordNew."','".$nombre_usuario."','".$func_asesor."','".$telefono."','".$imagen."','".$id_asesor."','".$rol."','".$color."')");

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
		if(isset($peticion->num_rows))
		{

			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$mensaje = $row["mensaje"];
			}

			if($mensaje == "true")
			{
				$mensaje = true;
			}
			else if($mensaje == "false")
			{
				$mensaje = false;
			}
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
		$data = compact("mensaje");
	}