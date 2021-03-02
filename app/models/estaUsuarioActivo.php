<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_verifyUsuarioActivo('".$rol."',$id_usuario)");
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
            if(isset($peticion->num_rows) && $peticion->num_rows > 0)
            {
				if($row = $peticion->fetch_array(MYSQLI_NUM))
				{
					$informacion_usuario = $row["0"];
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
    else if($mensaje_usuario === true)
    {
         $data = compact("informacion_usuario","mensaje_usuario");
    }
    else
    {
         $data = compact("mensaje_usuario");
    }