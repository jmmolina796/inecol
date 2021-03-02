<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getModulosDocenteFiltro(".$id_docente.",".$id_ciclo_escolar.")");                
		

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_modulos_docente = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_modulos_docente[$i] = $row;
                $i++;
				
			}
			$mensaje_modulos_docente = true;
		}
		else
		{
			$mensaje_modulos_docente = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if($mensaje_modulos_docente === true)
    {
         $data = compact("informacion_modulos_docente", "mensaje_modulos_docente");
    }
    else
    {
    	$data = compact("mensaje_modulos_docente");
    }
