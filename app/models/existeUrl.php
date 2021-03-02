<?php

	try
	{
		if($action == "modulo")
		{
			$peticion = $mysqli->query("CALL SP_verifyUrlModulo('".$link."')");
		}
		else if($action == "moduloDocente")
		{
			$peticion = $mysqli->query("CALL SP_verifyUrlModuloDocente('".$link."')");
		}
		else if($action == "proyecto")
		{
			$peticion = $mysqli->query("CALL SP_verifyUrlProyecto('".$link."')");
		}
		else if($action == "proyectoDocente")
		{
			$peticion = $mysqli->query("CALL SP_verifyUrlProyectoDocente('".$link."')");
		}
		else if($action == "escuela")
		{
			$peticion = $mysqli->query("CALL SP_verifyUrlEscuela('".$link."')");
		}
		else if($action == "carpeta")
		{
			$peticion = $mysqli->query("CALL SP_verifyUrlCarpeta('".$link."')");
		}

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
		if(isset($peticion->num_rows))
		{

			if($row = $peticion->fetch_array(MYSQLI_ASSOC))
			{
				$id = $row["mensaje"];
				$title = $row["title"];
			}
		}
		else
		{
			$id = "-1";
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
	else if(isset($id))
	{
		$data = compact("id","title");
	}