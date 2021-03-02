<?php
	
	try
	{
		$peticion = $mysqli->query("CALL SP_getGradosNivelEducativoProyecto(".$id_proyecto.")");
	    
                if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
		if(isset($peticion->num_rows) && $peticion->num_rows > 0)
                {
                            
                    $informacion_grados_proyecto = array();
                    $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_grados_proyecto[$i] = $row;
                       $i++;
				
			}
			$mensaje_grados_proyecto = true;
		}
		else
		{
			$mensaje_grados_proyecto = false;
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
	else if(isset($mensaje_grados_proyecto))
	{
		$data = compact("mensaje_grados_proyecto","informacion_grados_proyecto");
	}



