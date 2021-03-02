<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_likeProyectoDocente('".$urlProyecto."',".$id_usuario.",'".$rol."')");
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
			$mensaje_informacion_cantidad_likes_proyecto = true;
		}
		else
		{
			$mensaje_informacion_cantidad_likes_proyecto = false;
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
        if($mensaje_informacion_cantidad_likes_proyecto === true)
        {
             $data = compact("mensaje_informacion_cantidad_likes_proyecto", "dar_like","cantidad_likes");
        }
        else
        {
             $data = compact("mensaje_informacion_cantidad_likes_proyecto");
        }
    }	