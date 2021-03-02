<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_updateClaveUsuario(".$id_usuario.",'".$password."','".$rol."','".$token."') ");
		
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
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
        
        $data = compact("mensaje_update_clave_usuario");
        
    }	