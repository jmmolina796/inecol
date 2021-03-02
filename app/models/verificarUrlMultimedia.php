<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_verifyMultimedia('".$type."','".$link."')");
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
            if(isset($peticion->num_rows) && $peticion->num_rows > 0)
            {

			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
                $existe_url_multimedia= $row["mensaje"];
                
			}
			$mensaje_url_multimedia = true;
		}
		else
		{
			$mensaje_url_multimedia = false;
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
        if($mensaje_url_multimedia === true)
        {
             $data = compact("mensaje_url_multimedia","existe_url_multimedia");
        }
        else
        {
             $data = compact("mensaje_url_multimedia");
        }
    }	