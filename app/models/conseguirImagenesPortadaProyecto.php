<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getImagenesPortadaProyecto('".$id_rel_proyecto_docente."','".$type."')");

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_imagenes_portada_proyecto = array();
            $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_imagenes_portada_proyecto[$i] = $row;
                $i++;
				
			}
			$mensaje_imagenes = true;
		}
		else
		{
			$mensaje_imagenes = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");  
	}
    else if($mensaje_imagenes === false)
    {
         $data = compact("mensaje_imagenes");
    }
    else
    {
    	$data = compact("informacion_imagenes_portada_proyecto", "mensaje_imagenes");
    }