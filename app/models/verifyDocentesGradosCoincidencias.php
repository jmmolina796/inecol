<?php
	
	try
	{    
		$peticion = $mysqli->query("CALL SP_verifyDocentesGradosCoincidencias('".$id_docente."','".$id_proyecto."','".$id_grado."','".$clave_escuela."','".$tipo."')");
	    
        if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
		if(isset($peticion->num_rows) && $peticion->num_rows > 0)
		{
            if($row = $peticion->fetch_array(MYSQLI_BOTH))
            {
                $id_grado = $row["id_grado"];
                $mensaje = true;
            }
		}
		else
		{
			$mensaje = false;
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
	else if(isset($mensaje))
	{
		$data = compact("mensaje");
	}