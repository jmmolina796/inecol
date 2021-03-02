<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getInfoJuez('".$id_juez."')");
		
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {

			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$id_juez = $row["id_juez"];
				$nombre_juez = $row["nombre"];
				$ape_paterno = $row["ape_paterno"];
				$ape_materno = $row["ape_materno"];
                $email = $row["email"];
                $password = $row["password"];
                $nombre_usuario = $row["nombre_usuario"];
                $telefono = $row["telefono"];
				$imagen = $row["imagen"];
                $estatus = $row["estatus"];
                $rol = $row["rol"];
                $color = $row["color"];
			}
			$mensaje_juez = true;
		}
		else
		{
			$mensaje_juez = false;
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
        if($mensaje_juez === true)
        {
             $data = compact("mensaje_juez", "id_juez","nombre_juez","ape_paterno","ape_materno","email","password","nombre_usuario","telefono","imagen","estatus","rol","color");
        }
        else
        {
             $data = compact("mensaje_juez");
        }
    }	