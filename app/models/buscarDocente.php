<?php

    try
    {
		$peticion = $mysqli->query("CALL SP_getInfoDocente(".$id_docente.")"); 
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
			while($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$id_docente = $row["id_docente"];
				$nombre_docente = $row["nombre_docente"];
				$ape_paterno = $row["ape_paterno"];
				$ape_materno = $row["ape_materno"];
                $email = $row["email"];
                $password = $row["password"];
                $nombre_usuario = $row["nombre_usuario"];
                $telefono = $row["telefono"];
                $entidad = $row["entidad"];
                $id_entidad = $row["id_entidad"];
                $municipio = $row["municipio"];
                $id_municipio = $row["id_municipio"];
                $nombre_localidad = $row["nombre_localidad"];
                $imagen = $row["imagen"];
                $color = $row["color"];
			}
			$mensaje_docente = true;
		}
		else
		{
			$mensaje_docente = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");   
	}
    else if($mensaje_docente === true)
    {
         $data = compact("id_docente","nombre_docente","ape_paterno","ape_materno","email","password","nombre_usuario","telefono","entidad","id_entidad","municipio","id_municipio","nombre_localidad","imagen","mensaje_docente","color");
    }
    else
    {
         $data = compact("mensaje_docente");
    }