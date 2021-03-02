<?php 

	try
	{
		$peticion = $mysqli->query("CALL SP_insertAsesores('".$nombre."','".$ape_paterno."','".$ape_materno."','".$email."','".$password."','".$nombre_usuario."','".$telefono."','".$imagen."','".$tipoFuncion."','".$color."')");
		
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
