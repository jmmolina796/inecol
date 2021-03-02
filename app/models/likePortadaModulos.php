<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_likeModuloDocente('".$urlModulo."',".$id_usuario.",'".$rol."')");
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
                $cantidad_likes = $row["cantidad_likes"];
                $dar_like = $row["dar_like"];
			}
			$mensaje_informacion_cantidad_likes_modulo = true;
		}
		else
		{
			$mensaje_informacion_cantidad_likes_modulo = false;
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
        if($mensaje_informacion_cantidad_likes_modulo === true)
        {
             $data = compact("mensaje_informacion_cantidad_likes_modulo", "dar_like","cantidad_likes");
        }
        else
        {
             $data = compact("mensaje_informacion_cantidad_likes_modulo");
        }
    }	