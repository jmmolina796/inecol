<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getAdviserFunctions()");    
		 
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_adviser_functions = array();
            $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$informacion_adviser_functions[$i] = $row;
                $i++;
				
			}
			$mensaje_adviser_functions = true;
		}
		else
		{
			$mensaje_adviser_functions = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}


	if(isset($error))
	{
	   $data = compact("error");  
	}
    else if($mensaje_adviser_functions === false)
    {
         $data = compact("mensaje_adviser_functions");
    }
    else
    {
    	$data = compact("informacion_adviser_functions", "mensaje_adviser_functions");
    }