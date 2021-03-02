<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getInformacionModulo('".$urlModulo."')");
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

            if(isset($peticion->num_rows) && $peticion->num_rows > 0)
            {

			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
                $nombre = $row["nombre"];
                $descripcion = $row["descripcion"];
                $imagen_portada = $row["imagen_portada"];
                $ciclo_escolar = $row["ciclo_escolar"];
                $nombre_docente = $row["nombre_docente"];
                $ape_paterno = $row["ape_paterno"];
                $ape_materno = $row["ape_materno"];
                $nombre_usuario = $row["nombre_usuario"];
                $nombre_escuela = $row["nombre_escuela"];
                $clave_escuela = $row["clave_escuela"];
                $grado = $row["grado"];
                $grupo = $row["grupo"];
			}
			$mensaje_informacion_modulo = true;
		}
		else
		{
			$mensaje_informacion_modulo = false;
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
        if($mensaje_informacion_modulo === true)
        {
             $data = compact("mensaje_informacion_modulo","nombre","descripcion","imagen_portada","ciclo_escolar","nombre_docente","ape_paterno","ape_materno","nombre_usuario","nombre_escuela","clave_escuela","grado","grupo");
        }
        else
        {
             $data = compact("mensaje_informacion_modulo");
        }
    }	