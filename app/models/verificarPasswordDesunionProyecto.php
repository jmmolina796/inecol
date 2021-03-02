<?php
	
	try
	{
		$peticion = $mysqli->query("CALL SP_verifyPasswordDesunionProyecto('".$password."','".$id_usuario."','".$urlProyecto."','".$type."')");
	    
        if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
		if(isset($peticion->num_rows) && $peticion->num_rows > 0)
		{

            if($row = $peticion->fetch_array(MYSQLI_BOTH))
            {
                $id_rel_proyecto_docente = $row["id_rel_proyecto_docente"];
                $mensaje_verificar_password = true;
            }
                    
		}
		else
		{
			$mensaje_verificar_password = false;
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
	else if(isset($mensaje_verificar_password))
	{
		$data = compact("mensaje_verificar_password","id_rel_proyecto_docente");
	}
