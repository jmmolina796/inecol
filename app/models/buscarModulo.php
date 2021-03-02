<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getInfoModulo('".$id_modulo."')");
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

            if(isset($peticion->num_rows) && $peticion->num_rows > 0)
            {

			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$id_modulo = $row["id_modulo"];
				$nombre_modulo = $row["nombre_modulo"];
                $nombre_administrador = $row["nombre_administrador"];
                $fecha_creacion = $row["fecha_creacion"];
                $descripcion = $row["descripcion"];
                $imagen_portada = $row["imagen_portada"];
                $estatus = $row["estatus"];
                $color = $row["color"];
			}
			$mensaje_modulo = true;
		}
		else
		{
			$mensaje_modulo = false;
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
        if($mensaje_modulo === true)
        {
             $data = compact("mensaje_modulo","id_modulo","nombre_modulo","nombre_administrador","fecha_creacion","descripcion","imagen_portada","estatus","color");
        }
        else
        {
             $data = compact("mensaje_modulo");
        }
    }	