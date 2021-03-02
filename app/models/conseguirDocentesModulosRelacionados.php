<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getDocentesModulosRelacionados('".$url."','".$id_ciclo_escolar."','".$type."')");
		
		

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_modulo_docente_relacionados = array();
            $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_modulo_docente_relacionados[$i] = $row;
                $i++;
				
			}
			$mensaje_modulo_docente_relacionados = true;
		}
		else
		{
			$mensaje_modulo_docente_relacionados = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}


	if(isset($error))
	{
	   $data = compact("error");  
	}
    else if($mensaje_modulo_docente_relacionados === true)
    {
         $data = compact("informacion_modulo_docente_relacionados", "mensaje_modulo_docente_relacionados");
    }
    else
    {
         $data = compact("mensaje_modulo_docente_relacionados");
    }