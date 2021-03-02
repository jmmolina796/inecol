<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getGrupos()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_grupos = array();
            $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$informacion_grupos[$i] = $row;
                $i++;
				
			}
			$mensaje_grupos = true;
		}
		else
		{
			$mensaje_grupos = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}


	if(isset($error))
	{
	   $data = compact("error");  
	}
    else if($mensaje_grupos === false)
    {
         $data = compact("mensaje_grupos");
    }
    else
    {
    	$data = compact("informacion_grupos", "mensaje_grupos");
    }