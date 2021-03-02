<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getGradosWithNivelesEducativos()");                

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_grados_niveles_educativos = array();
            $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_grados_niveles_educativos[$i] = $row;
                $i++;
			}
			$mensaje_grados_niveles_educativos = true;
		}
		else
		{
			$mensaje_grados_niveles_educativos = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}


	if(isset($error))
	{
	   $data = compact("error");  
	}
    else if($mensaje_grados_niveles_educativos === false)
    {
         $data = compact("mensaje_grados_niveles_educativos");
    }
    else
    {
    	$data = compact("mensaje_grados_niveles_educativos","informacion_grados_niveles_educativos");
    }