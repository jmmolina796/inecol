<?php
	
	try
	{
		$peticion = $mysqli->query("CALL SP_insertMensaje('".$id_emisor."','".$rol_emisor."','".$nombre_usuario."','".$mensaje."')");
	    if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
		
		if(isset($peticion->num_rows))
		{
			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$id_comentario = $row["id_comentario"];
				$comentario = $row["comentario"];
				$css_mensaje = $row["css_mensaje"];
				$fecha_comentario = $row["fecha_comentario"];
				$dia = $row["dia"];
				$ultimo_dia_mensaje = $row["ultimo_dia_mensaje"];
				$visto_receptor = $row["visto_receptor"];
			}
			$mensaje = true;
		}
		else
		{
			$mensaje = false;
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
	else if(isset($mensaje))
	{
		$data = compact("id_comentario","comentario","css_mensaje","fecha_comentario","dia","ultimo_dia_mensaje","visto_receptor","mensaje");
	}
