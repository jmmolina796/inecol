<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getInfoAsesor('".$id_asesor."')");
		
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {

			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$id_asesor = $row["id_asesor"];
				$nombre_asesor = $row["nombre"];
				$ape_paterno = $row["ape_paterno"];
				$ape_materno = $row["ape_materno"];
                $email = $row["email"];
                $password = $row["password"];
                $nombre_usuario = $row["nombre_usuario"];
                $telefono = $row["telefono"];
				$imagen = $row["imagen"];
				$id_funcion = $row["id_funcion"];
                $nombre_funcion = $row["nombre_funcion"];
                $estatus = $row["estatus"];
                $rol = $row["rol"];
                $color = $row["color"];
			}
			$mensaje_asesor = true;
		}
		else
		{
			$mensaje_asesor = false;
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
        if($mensaje_asesor === true)
        {
             $data = compact("mensaje_asesor", "id_asesor","nombre_asesor","ape_paterno","ape_materno","email","password","nombre_usuario","telefono","imagen","id_funcion","nombre_funcion","estatus","rol","color");
        }
        else
        {
             $data = compact("mensaje_asesor");
        }
    }	