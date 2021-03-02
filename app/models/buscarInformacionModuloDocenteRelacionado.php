<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getInfoDocentesModulosRelacionados('".$url."','".$id_docente."','".$type."',".$id_ciclo_escolar.")");


		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_info_docente_modulo = array();
            $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_info_docente_modulo[$i] = $row;
                $i++;
				
			}
			$mensaje_info_docente_modulo = true;
		}
		else
		{
			$mensaje_info_docente_modulo = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}


	if(isset($error))
	{
	   $data = compact("error");  
	}
    else if($mensaje_info_docente_modulo === false)
    {
         $data = compact("mensaje_info_docente_modulo");
    }
    else
    {
    	$data = compact("informacion_info_docente_modulo", "mensaje_info_docente_modulo");
    }