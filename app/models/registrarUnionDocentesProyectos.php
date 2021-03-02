<?php
	
	try
	{
		$peticion = $mysqli->query("CALL SP_insertRelProyectoDocente('".$id_proyecto."','".$id_docente."','".$clave_escuela."','".$id_grado."','".$id_grupo."','".$url."')");
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
