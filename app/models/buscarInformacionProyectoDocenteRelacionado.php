<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getInfoDocentesProyectosRelacionados('".$url."','".$id_docente."')");

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_info_docente_proyecto = array();
            $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_info_docente_proyecto[$i] = $row;
                $i++;
				
			}
			$mensaje_info_docente_proyecto = true;
		}
		else
		{
			$mensaje_info_docente_proyecto = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}


	if(isset($error))
	{
	   $data = compact("error");  
	}
    else if($mensaje_info_docente_proyecto === false)
    {
         $data = compact("mensaje_info_docente_proyecto");
    }
    else
    {
    	$data = compact("informacion_info_docente_proyecto", "mensaje_info_docente_proyecto");
    }