<?php

    try
    {
		$peticion = $mysqli->query("CALL SP_getInfoCarpeta(".$id_carpeta.")"); 
		
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
			while($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$id_carpeta = $row["id_carpeta"];
				$nombre_carpeta = $row["nombre"];
				$estatus = $row["estatus"];
				$url= $row["url"];             
			}
			$mensaje_carpeta = true;
		}
		else
		{
			$mensaje_carpeta = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");   
	}
    else if($mensaje_carpeta === true)
    {
         $data = compact("id_carpeta","nombre_carpeta","estatus","url","mensaje_carpeta");
    }
    else
    {
         $data = compact("mensaje_carpeta");
    }