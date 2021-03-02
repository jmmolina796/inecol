<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_login('".$logueoUsuario."','".$logueoPassword."')");
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

		if(isset($peticion->num_rows) && $peticion->num_rows > 0) // cambio
		{

			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$email = $row["email"];
				$nombre_usuario = $row["nombre_usuario"];
				$id_usuario = $row["id_usuario"];
				$imagen = $row["imagen"];
				$rol = $row["rol"];
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
    else if($mensaje === true)
    {
         $data = compact("mensaje","error","email","nombre_usuario","id_usuario","rol","imagen");
    }
    else
    {
         $data = compact("mensaje");
    }