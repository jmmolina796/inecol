<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getInfoUsuario('".$correo."')");
		
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

            if(isset($peticion->num_rows) && $peticion->num_rows > 0)
            {

				if($row = $peticion->fetch_array(MYSQLI_BOTH))
				{
					$id_usuario = $row["id_usuario"];
					$rol = $row["rol"];
					$nombre = $row["nombre"];
					$ape_paterno = $row["ape_paterno"];
					$ape_materno = $row["ape_materno"];
	                $email = $row["email"];
	                
	               

				}
				
				$mensaje_usuario = true;
			}
			else
			{
				$mensaje_usuario = false;
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
        if($mensaje_usuario === true)
        {
             $data = compact("id_usuario", "rol","nombre","ape_paterno","ape_materno","email","mensaje_usuario");
        }
        else
        {
             $data = compact("mensaje_usuario");
        }
    }	