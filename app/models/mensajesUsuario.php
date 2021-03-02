<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getMessages('".$id_usuario."','".$rol."','".$nombre_usuario."')"); 
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        
        $informacion_mensajes = array();

		if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $i=0;

            $flagMen = false;
            $mensaje_mensajes = "";

            if($row = $peticion->fetch_array(MYSQLI_BOTH))
            {
            	if(isset($row["mensaje"]))
            	{
            		if($row["mensaje"] == "user")
            		{
            			$flagMen = true;
            			$mensaje_mensajes = "user";
            		}
            		else
            		{
            			$mensaje_mensajes = "nuevoChat";
            		}
            	}
            }

            if(!$flagMen)
            {
	            $peticion->data_seek(0);

				while($row = $peticion->fetch_array(MYSQLI_NUM))
				{
					$informacion_mensajes[$i] = $row;
	                $i++;
				}
				if($mensaje_mensajes != "nuevoChat")
				{
					$mensaje_mensajes = "true";
				}
            }
		}
		else
		{
			$mensaje_mensajes = "false";
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
		$data = compact("mensaje_mensajes","informacion_mensajes");       
    }