<?php
	
	try
	{
		$peticion = $mysqli->query("CALL SP_getGradosModulo(".$id_modulo.")");
	    
        if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
		if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
                    
            $informacion_grados_modulo = array();
            $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_ASSOC))
			{
				$informacion_grados_modulo[$i] = $row["id_grado"];
                $i++;
				
			}
			$mensaje_grados_modulo = true;
		}
		else
		{
			$mensaje_grados_modulo = false;
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
	 else if($mensaje_grados_modulo === false)
    {
         $data = compact("mensaje_grados_modulo");
    }
    else
    {
    	$data = compact("mensaje_grados_modulo","informacion_grados_modulo");
    }



