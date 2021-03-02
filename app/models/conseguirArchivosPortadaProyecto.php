<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getArchivosPortadaProyecto('".$id_rel_proyecto_docente."','".$type."')");


		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_archivos_portada_proyecto = array();
            $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_archivos_portada_proyecto[$i] = $row;
                $i++;
				
			}
			$mensaje_archivos = true;
		}
		else
		{
			$mensaje_archivos = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");  
	}
    else if($mensaje_archivos === false)
    {
         $data = compact("mensaje_archivos");
    }
    else
    {
    	$data = compact("informacion_archivos_portada_proyecto", "mensaje_archivos");
    }