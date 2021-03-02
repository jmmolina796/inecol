<?php
	
	try
	{
		$peticion = $mysqli->query("CALL SP_verifyGradosEscuelaDocente('".$id_docente."','".$id_modulo."','0')");
	    
                if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
		if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
                            
            $informacion_registro_docente = array();
            $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_registro_docente[$i] = $row;
                $i++;
				
			}
			$mensaje_registro_docente = true;
		}
		else
		{
			$mensaje_registro_docente = false;
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
	else if(isset($mensaje_registro_docente))
	{
		$data = compact("mensaje_registro_docente","informacion_registro_docente");
	}
