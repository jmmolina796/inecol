<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getGrados(".$id_nivel_educativo.")");                

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_grados = array();
            $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$informacion_grados[$i] = $row;
                $i++;
				
			}
			$mensaje_grados = true;
		}
		else
		{
			$mensaje_grados = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}


	if(isset($error))
	{
	   $data = compact("error");  
	}
    else if($mensaje_grados === false)
    {
         $data = compact("mensaje_grados");
    }
    else
    {
    	$data = compact("mensaje_grados","informacion_grados");
    }