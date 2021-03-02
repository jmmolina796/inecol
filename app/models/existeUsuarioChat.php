<?php

	$url = $action2;
	try
	{
		$peticion = $mysqli->query("CALL SP_getUserChat('".$url."')");
		$mensaje = false;
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
		if(isset($peticion->num_rows))
		{
			if($row = $peticion->fetch_array(MYSQLI_ASSOC))
			{

				$nombre = $row["nombre"];
				$ape_paterno = $row["ape_paterno"];
				$ape_materno = $row["ape_materno"];
				$nombre_usuario = $row["nombre_usuario"];
				$imagen = $row["imagen"];
				$rol = $row["rol"];
				$mensaje = true;
			}
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
		$data = compact("nombre","ape_paterno","ape_materno","nombre_usuario","imagen","rol","mensaje");
	}
	else
	{
		$data = compact("mensaje");
	}