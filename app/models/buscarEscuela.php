<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getInfoEscuela('".$clave."')"); 
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
			while($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$clave_escuela = $row["clave_escuela"];
				$escuela = $row["escuela"];
				$nivel_educativo = $row["nivel_educativo"];
				$id_nivel_educativo = $row["id_nivel_educativo"];
				$entidad = $row["entidad"];
				$id_entidad = $row["id_entidad"];
				$municipio = $row["municipio"];
				$id_municipio = $row["id_municipio"];
				$localidad = $row["localidad"];
				$estatus = $row["estatus"];
			}
			$mensaje_escuela = true;
		}
		else
		{
			$mensaje_escuela = false;
		}
	}
	catch(Exception $e) 
	{
		$error = "@%@#".$e->getMessage();
	}


	if(isset($error))
	{
	   $data= compact("error");
            
	}
    else if($mensaje_escuela === true)
    {
         $data = compact("mensaje_escuela","clave_escuela","escuela","nivel_educativo","id_nivel_educativo","entidad","id_entidad","municipio","id_municipio","localidad","estatus");
    }
    else
    {
         $data = compact("mensaje_escuela");
    }