<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_verifyTokenUsuario('".$token."')");
		
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
		if($row = $peticion->fetch_array(MYSQLI_BOTH))
		{
			$respuesta = $row["respuesta"];   
			$token = $row["token"];
			$id_docente = $row["id_docente"];
			$id_administrador = $row["id_administrador"];
			$rol = $row["rol"];
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
    else
    {
        
        $data = compact("respuesta","token","id_docente","id_administrador","rol");
        
    }	