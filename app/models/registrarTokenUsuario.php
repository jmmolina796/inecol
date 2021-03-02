<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_insertTokenUsuario('".$token."','".$rol."',".$id_usuario.")");
		
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

			$mensaje_token_usuario = true;

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
          
        $data = compact("mensaje_token_usuario");
       
    }	