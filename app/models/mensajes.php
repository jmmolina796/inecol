<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getChats('".$id_usuario."','".$rol."')"); 
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
		if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_chats = array();
            $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_chats[$i] = $row;
                $i++;
				
			}
			$mensaje_chats = true;
		}
		else
		{
			$mensaje_chats = false;
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
		$data = compact("mensaje_chats","informacion_chats");       
    }