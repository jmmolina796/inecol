<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getDocentesBaja()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_docentes_baja = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_docentes_baja[$i] = $row;
                $i++;
				
			}
			$mensaje_docentes_baja = true;
		}
		else
		{
			$mensaje_docentes_baja = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if(isset($mensaje_docentes_baja))
    {
         $data = compact("informacion_docentes_baja", "mensaje_docentes_baja");

    }